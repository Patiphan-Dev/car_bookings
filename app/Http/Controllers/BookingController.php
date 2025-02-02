<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon; // ต้องเพิ่ม use Carbon เพื่อใช้ในการคำนวณ
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        // ตรวจสอบบทบาทของผู้ใช้งาน
        if (Auth::user()->role === 'admin') {
            // ถ้าเป็น Admin ให้ดึงข้อมูลทั้งหมด
            $bookings = Booking::with(['car', 'user'])->get();
        } else {
            // ถ้าเป็น User ให้ดึงข้อมูลการจองของตัวเองเท่านั้น
            $bookings = Booking::with(['car', 'user'])->where('user_id', Auth::user()->id)->get();
        }
        
        // ส่งข้อมูลไปยังวิว
        return view('bookings.index', compact('bookings'));
    }


    public function create()
    {
        $cars = Car::all(); // ดึงข้อมูลรถยนต์ทั้งหมด
        $users = User::all(); // ดึงข้อมูลผู้ใช้งานทั้งหมด
        return view('bookings.create', compact('cars', 'users')); // หน้าเพิ่มข้อมูลการจอง
    }

    // ฟังก์ชันสำหรับบันทึกข้อมูลการจองใหม่
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'car_id' => 'required|exists:cars,id',
            'usage_type' => 'required|string',
            'purpose' => 'required|string',
            'subject' => 'required|string',
            'location' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'count_people' => 'required|integer',
            'note' => 'nullable|string',
        ]);

        // แปลงวันที่และเวลา
        $startDatetime = Carbon::parse("{$request->start_date} {$request->start_time}");
        $endDatetime = Carbon::parse("{$request->end_date} {$request->end_time}");

        // ✅ คำนวณจำนวนวัน (รวมวันแรกและวันสุดท้าย)
        $countDays = round($startDatetime->diffInDays($endDatetime)) + 1;

        // ✅ คำนวณชั่วโมงต่อวัน
        $dailyHours = Carbon::parse($request->start_time)->diffInHours(Carbon::parse($request->end_time));

        // ✅ คำนวณจำนวนชั่วโมงทั้งหมด
        $countHours = $dailyHours * $countDays;

        // ✅ ใช้ diff() เพื่อดึงชั่วโมงและนาทีแยกกัน
        $diff = $startDatetime->diff($endDatetime);
        $countHours = $diff->h; // ดึงเฉพาะชั่วโมง
        $countMinutes = $diff->i; // ดึงเฉพาะนาที

        // ✅ Debug เช็คค่าก่อนบันทึก
        // dd("จำนวนวัน: $countDays", "ชั่วโมงต่อวัน: $dailyHours", "ชั่วโมงรวม: $countHours", "ชั่วโมงรวม:$countMinutes");

        // ตรวจสอบว่ามีการจองรถยนต์คันเดียวกันในช่วงเวลานี้หรือไม่
        $existingBooking = Booking::where('car_id', $request->car_id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                    ->orWhereBetween('end_date', [$request->start_date, $request->end_date])
                    ->orWhere(function ($query) use ($request) {
                        $query->where('start_date', '<=', $request->start_date)
                            ->where('end_date', '>=', $request->end_date);
                    });
            })
            ->where(function ($query) use ($request) {
                $query->whereTime('start_time', '<', $request->end_time)
                    ->whereTime('end_time', '>', $request->start_time);
            })
            ->exists();

        // หากมีการจองซ้ำ แจ้งเตือนและไม่ให้บันทึก
        if ($existingBooking) {
            return redirect()->back()->withErrors(['error' => 'รถคันนี้ถูกจองในช่วงวันและเวลาที่เลือกแล้ว'])->withInput();
        }

        // บันทึกข้อมูล
        Booking::create([
            'user_id' => $request->user_id,
            'car_id' => $request->car_id,
            'usage_type' => $request->usage_type,
            'purpose' => $request->purpose,
            'subject' => $request->subject,
            'location' => $request->location,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'count_days' => $countDays,
            'start_time' => $request->start_time, // ✅ เก็บเป็น TIME
            'end_time' => $request->end_time, // ✅ เก็บเป็น TIME
            'count_hours' => $countHours, // ✅ ชั่วโมงที่คำนวณได้
            'count_minutes' => $countMinutes, // ✅ นาทีที่คำนวณได้
            'count_people' => $request->count_people,
            'note' => $request->note,
            'status' => 'pending',
        ]);

        return redirect()->route('bookings.index')->with('success', 'เพิ่มข้อมูลการจองสำเร็จ');
    }



    public function edit(Booking $booking)
    {
        $cars = Car::all(); // ดึงข้อมูลรถยนต์ทั้งหมด
        $users = User::all(); // ดึงข้อมูลผู้ใช้งานทั้งหมด
        return view('bookings.edit', compact('booking', 'cars', 'users')); // หน้าแก้ไขข้อมูลการจอง
    }

    // ฟังก์ชันสำหรับอัพเดตข้อมูลการจอง
    public function update(Request $request, Booking $booking)
    {
        // ✅ ตรวจสอบการจองซ้ำ
        $existingBooking = Booking::where('car_id', $request->car_id)
            ->where('id', '!=', $booking->id) // ยกเว้นตัวเอง
            ->where(function ($query) use ($request) {
                // เช็คช่วงเวลาเวลาเริ่มต้นถึงสิ้นสุด
                $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                    ->orWhereBetween('end_date', [$request->start_date, $request->end_date])
                    ->orWhere(function ($query) use ($request) {
                        $query->where('start_date', '<=', $request->start_date)
                            ->where('end_date', '>=', $request->end_date);
                    });
            })
            ->where(function ($query) use ($request) {
                // เช็คเวลาเริ่มต้นและสิ้นสุด
                $query->whereTime('start_time', '<', $request->end_time)
                    ->whereTime('end_time', '>', $request->start_time);
            })
            ->exists();

        if ($existingBooking) {
            return redirect()->back()->withErrors(['error' => 'รถคันนี้ถูกจองในช่วงวันและเวลาที่เลือกแล้ว'])->withInput();
        }

        // Validation
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'car_id' => 'required|exists:cars,id',
            'usage_type' => 'required|string',
            'purpose' => 'required|string',
            'subject' => 'required|string',
            'location' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'start_time' => 'required|date_format:H:i', // ตรวจสอบรูปแบบ
            'end_time' => 'required|date_format:H:i|after:start_time',
            'count_people' => 'required|integer',
            'note' => 'nullable|string',
        ]);

        // แปลงวันที่และเวลา
        $startDatetime = Carbon::parse("{$request->start_date} {$request->start_time}");
        $endDatetime = Carbon::parse("{$request->end_date} {$request->end_time}");

        // ✅ คำนวณจำนวนวัน (รวมวันแรกและวันสุดท้าย)
        $countDays = $startDatetime->diffInDays($endDatetime) + 1;

        // ✅ คำนวณชั่วโมงต่อวัน
        $dailyHours = $startDatetime->diffInHours($endDatetime);

        // ✅ คำนวณจำนวนชั่วโมงทั้งหมด
        $totalHours = $dailyHours * $countDays;

        // ✅ ใช้ diff() เพื่อดึงชั่วโมงและนาทีแยกกัน
        $diff = $startDatetime->diff($endDatetime);
        $countHours = $diff->h; // ดึงเฉพาะชั่วโมง
        $countMinutes = $diff->i; // ดึงเฉพาะนาที

        // ✅ Debug เช็คค่าก่อนบันทึก
        // dd("จำนวนวัน: $countDays", "ชั่วโมงต่อวัน: $dailyHours", "ชั่วโมงรวม: $countHours", "ชั่วโมงรวม:$countMinutes");

        // อัพเดตการจอง
        $booking->update([
            'user_id' => $request->user_id,
            'car_id' => $request->car_id,
            'usage_type' => $request->usage_type,
            'purpose' => $request->purpose,
            'subject' => $request->subject,
            'location' => $request->location,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'count_days' => $countDays, // ใส่จำนวนวันที่คำนวณ
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'count_hours' => $countHours, // ใส่จำนวนชั่วโมงที่คำนวณ
            'count_minutes' => $countMinutes, // นาทีที่คำนวณได้
            'count_people' => $request->count_people,
            'note' => $request->note,
            'status' => $request->status,
        ]);

        return redirect()->route('bookings.index')->with('success', 'อัพเดตข้อมูลการจองสำเร็จ');
    }


    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'ลบข้อมูลการจองสำเร็จ');
    }

    public function show($id)
    {
        // ดึงข้อมูลการจองตาม ID
        $booking = Booking::with(['car', 'user'])->findOrFail($id);

        // ส่งข้อมูลการจองไปยัง View
        return view('bookings.show', compact('booking'));
    }
}
