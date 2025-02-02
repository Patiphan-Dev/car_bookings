@extends('layouts.adminlte')

@section('title', 'แก้ไขผู้ใช้งาน')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">แก้ไขผู้ใช้งาน</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">หน้าหลัก</a></li>
                        <li class="breadcrumb-item active">แก้ไขผู้ใช้งาน</li>
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
                        <h3>แก้ไขข้อมูลผู้ใช้</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label>ชื่อ-นามสกุล <span><strong>*</strong></span></label>
                                <input type="text" name="name" class="form-control" value="{{ $user->name }}"
                                    required>
                            </div>
                            <div class="form-group">
                                <label>ตำแหน่ง <span><strong>*</strong></span></label>
                                <input type="text" name="position" class="form-control" value="{{ $user->position }}"
                                    required>
                            </div>
                            <div class="form-group">
                                <label>อีเมล <span><strong>*</strong></span></label>
                                <input type="email" name="email" class="form-control" value="{{ $user->email }}"
                                    required>
                            </div>
                            <div class="form-group">
                                <label>เบอร์โทรศัพท์ <span><strong>*</strong></span></label>
                                <input type="text" name="phone" class="form-control" value="{{ $user->phone }}"
                                    required>
                            </div>
                            <div class="form-group">
                                <label>บทบาท <span><strong>*</strong></span></label>
                                <select name="role" class="form-control">
                                    <option selected>---กรุณาเลือกบทบาท---</option>
                                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>ผู้ใช้งาน</option>
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>แอดมิน</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">บันทึก</button>
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">ยกเลิก</a>
                        </form>
                    </div>
                </div>
            </div>
    </section>
@endsection
