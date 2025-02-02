@extends('layouts.adminlte')

@section('title', 'เพิ่มผู้ใช้งาน')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">เพิ่มผู้ใช้งาน</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">หน้าหลัก</a></li>
                        <li class="breadcrumb-item active">เพิ่มผู้ใช้งาน</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content-body')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h3>เพิ่มผู้ใช้</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('users.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>ชื่อ-นามสกุล <span><strong>*</strong></span></label>
                                <input type="name" name="name"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                    required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>ตำแหน่ง <span><strong>*</strong></span></label>
                                <input type="position" name="position"
                                    class="form-control @error('position') is-invalid @enderror" required>
                                @error('position')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>อีเมล <span><strong>*</strong></span></label>
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>เบอร์โทรศัพท์ <span><strong>*</strong></span></label>
                                <input type="text" name="phone"
                                    class="form-control @error('phone') is-invalid @enderror" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>รหัสผ่าน <span><strong>*</strong></span></label>
                                <input type="text" name="password"
                                    class="form-control @error('password') is-invalid @enderror" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>บทบาท <span><strong>*</strong></span></label>
                                <select name="role" class="form-control">
                                    <option selected>---กรุณาเลือกบทบาท---</option>
                                    <option value="user">ผู้ใช้งาน</option>
                                    <option value="admin">แอดมิน</option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">บันทึก</button>
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">ยกเลิก</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
