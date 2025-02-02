<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    // แสดงรายชื่อผู้ใช้
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // แสดงฟอร์มเพิ่มผู้ใช้
    public function create()
    {
        return view('users.create');
    }

    // บันทึกข้อมูลผู้ใช้ใหม่
    public function store(Request $request)
    {
        // ตรวจสอบว่า email และ phone ซ้ำหรือไม่
        if (User::where('email', $request->email)->exists()) {
            return redirect()->back()->withErrors(['email' => 'อีเมลนี้ถูกใช้ไปแล้ว']);
        }

        if (User::where('phone', $request->phone)->exists()) {
            return redirect()->back()->withErrors(['phone' => 'เบอร์โทรศัพท์นี้ถูกใช้ไปแล้ว']);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:15|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|in:user,admin'
        ]);

        User::create([
            'name' => $request->name,
            'position' => $request->position,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return redirect()->route('users.index')->with('success', 'เพิ่มผู้ใช้สำเร็จ');
    }


    // แสดงฟอร์มแก้ไขผู้ใช้
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // อัปเดตข้อมูลผู้ใช้
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:15|unique:users,phone,' . $user->id,
            'role' => 'required|in:user,admin'
        ]);

        $user->update([
            'name' => $request->name,
            'position' => $request->position,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role
        ]);

        return redirect()->route('users.index')->with('success', 'อัปเดตข้อมูลสำเร็จ');
    }


    // ลบผู้ใช้
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'ลบผู้ใช้สำเร็จ');
    }
}
