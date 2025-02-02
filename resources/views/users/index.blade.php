@extends('layouts.adminlte')

@section('title', 'ผู้ใช้งาน')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">ผู้ใช้งาน</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">หน้าหลัก</a></li>
                        <li class="breadcrumb-item active">จัดการผู้ใช้งาน</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content-body')
    <section class="content">
        <div class="container-fluid">
            <div class="d-grid gap-2 d-flex justify-content-end">
                <a href="{{ route('users.create') }}" class="btn btn-primary mb-3 mt-3">
                    <i class="fa fa-plus"></i> เพิ่มผู้ใช้งาน
                </a>
            </div>
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">ผู้ใช้งานทั้งหมด</h2>
                    </div>
                    <div class="card-body">
                        <table id="users_index" class="table table-bordered table-hover">
                            <thead class="text-center">
                                <tr>
                                    <th>ชื่อ-นามสกุล</th>
                                    <th>ตำแหน่ง</th>
                                    <th>อีเมล</th>
                                    <th>เบอร์โทรศัพท์</th>
                                    <th>บทบาท</th>
                                    <th>จัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->position }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td class="text-center">
                                            @if ($user->role == 'admin')
                                                <span class="badge bg-primary">แอดมิน</span>
                                            @elseif($user->role == 'user')
                                                <span class="badge bg-success">ผู้ใช้งาน</span>
                                            @else
                                                <span class="badge bg-danger">ไม่ระบุ</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('users.edit', $user) }}"
                                                class="btn btn-warning btn-sm mb-1"><i class="fa-solid fa-pen"></i></a>
                                            <form action="{{ route('users.destroy', $user) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm btn-delete mb-1"><i class="fa-solid fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
