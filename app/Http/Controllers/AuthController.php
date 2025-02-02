<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // การตรวจสอบข้อมูลจากฟอร์ม
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8',
        ]);

         // หากการตรวจสอบข้อมูลล้มเหลว
         if ($validator->fails()) {
            return redirect()->route('login')
                ->withErrors($validator)
                ->withInput();
        }

        // ตรวจสอบข้อมูลเข้าสู่ระบบ
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect()->intended('/home'); // ปรับเส้นทางหลังจากเข้าสู่ระบบสำเร็จ
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    // ฟังก์ชันสำหรับบันทึกข้อมูลผู้ใช้
    public function register(Request $request)
    {
        // การตรวจสอบข้อมูลจากฟอร์ม
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:10|unique:users',
            'password' => 'required|string|min:6|confirmed', // ตรวจสอบรหัสผ่านและยืนยัน
            'terms' => 'accepted', // ตรวจสอบการยอมรับข้อตกลง
        ]);

        // หากการตรวจสอบข้อมูลล้มเหลว
        if ($validator->fails()) {
            return redirect()->route('register')
                ->withErrors($validator)
                ->withInput();
        }

        // บันทึกข้อมูลผู้ใช้ใหม่
        $user = User::create([
            'name' => $request->name,
            'position' => $request->position,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password), // เข้ารหัสรหัสผ่าน
        ]);

        // ทำการล็อกอินให้ผู้ใช้ใหม่
        Auth::login($user);


        // ส่งผู้ใช้ไปยังหน้าแรกหลังจากสมัครสำเร็จ
        return redirect()->route('home')->with('success', 'สมัครสมาชิกสำเร็จ');
    }
}
