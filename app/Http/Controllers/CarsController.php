<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CarsController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        return view('cars.index', compact('cars'));
    }

    public function create()
    {
        return view('cars.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'license_plate' => 'required|string|unique:cars',
            'brand' => 'required|string',
            'model' => 'required|string',
            'seat_count' => 'required|integer',
            'vin' => 'required|string',
            'warranty_expiration_date' => 'required|date',
            'tax_act_expiration_date' => 'required|date',
            'status' => 'required|in:available,in_use,maintenance',
            'note' => 'nullable|string',
            'images.*' => 'image|mimes:jpg,png|max:2048' // อนุญาตเฉพาะ .jpg และ .png
        ]);

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/cars'), $imageName);
                $images[] = 'images/cars/' . $imageName;
            }
        }

        Car::create([
            'name' => $request->name,
            'license_plate' => $request->license_plate,
            'brand' => $request->brand,
            'model' => $request->model,
            'seat_count' => $request->seat_count,
            'vin' => $request->vin,
            'warranty_expiration_date' => $request->warranty_expiration_date,
            'tax_act_expiration_date' => $request->tax_act_expiration_date,
            'status' => $request->status,
            'note' => $request->note,
            'images' => json_encode($images) // เก็บเป็น JSON
        ]);

        return redirect()->route('cars.index')->with('success', 'เพิ่มข้อมูลรถสำเร็จ');
    }

    public function edit(Car $car)
    {
        return view('cars.edit', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'license_plate' => 'required|string|max:255|unique:cars,license_plate,' . $car->id,
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'seat_count' => 'required|integer',
            'vin' => 'required|string|max:255',
            'warranty_expiration_date' => 'required|date',
            'tax_act_expiration_date' => 'required|date',
            'status' => 'required|in:available,in_use,maintenance',
            'note' => 'nullable|string',
            'images.*' => 'image|mimes:jpg,png|max:2048', // อนุญาตอัปโหลดหลายไฟล์
        ]);

        $car->update([
            'name' => $request->name,
            'license_plate' => $request->license_plate,
            'brand' => $request->brand,
            'model' => $request->model,
            'seat_count' => $request->seat_count,
            'vin' => $request->vin,
            'warranty_expiration_date' => $request->warranty_expiration_date,
            'tax_act_expiration_date' => $request->tax_act_expiration_date,
            'status' => $request->status,
            'note' => $request->note,
        ]);

        if ($request->hasFile('images')) {
            // ลบรูปเก่าออกจากโฟลเดอร์
            $oldImages = json_decode($car->images, true);
            if ($oldImages) {
                foreach ($oldImages as $oldImage) {
                    if (File::exists(public_path($oldImage))) {
                        File::delete(public_path($oldImage));
                    }
                }
            }

            // อัปโหลดรูปใหม่
            $newImages = [];
            foreach ($request->file('images') as $image) {
                $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/cars'), $imageName);
                $newImages[] = 'images/cars/' . $imageName;
            }

            // อัปเดตรูปในฐานข้อมูล
            $car->update(['images' => json_encode($newImages)]);
        }

        return redirect()->route('cars.index')->with('success', 'แก้ไขข้อมูลรถสำเร็จ');
    }

    public function destroy(Car $car)
    {
        // ลบรูปภาพจากโฟลเดอร์
        $images = json_decode($car->images, true);
        if ($images) {
            foreach ($images as $image) {
                if (File::exists(public_path($image))) {
                    File::delete(public_path($image));
                }
            }
        }

        // ลบข้อมูลรถออกจากฐานข้อมูล
        $car->delete();

        return redirect()->route('cars.index')->with('success', 'ลบข้อมูลรถสำเร็จ');
    }

    public function show($id)
    {
        // ดึงข้อมูลการจองตาม ID
        $car = Car::findOrFail($id);

        // ส่งข้อมูลการจองไปยัง View
        return view('cars.show', compact('car'));
    }
}
