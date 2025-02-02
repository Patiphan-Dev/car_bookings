@extends('layouts.adminlte')

@section('title', 'จองรถออกนอกสำนักงาน')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">จองรถออกนอกสำนักงาน</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">หน้าหลัก</a></li>
                        <li class="breadcrumb-item active">จองรถออกนอกสำนักงาน</li>
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
                <a href="{{ route('bookings.create') }}" class="btn btn-primary mb-3 mt-3">
                    <i class="fa fa-plus"></i> จองรถ
                </a>
            </div>
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">ประวัติการจองรถ</h2>
                    </div>
                    <div class="card-body">
                        <table id="bookings_index" class="table table-bordered table-hover">
                            <thead class="text-center">
                                <tr>
                                    <th>รหัสผู้ใช้</th>
                                    <th>รหัสรถ</th>
                                    <th>ประเภทการใช้งาน</th>
                                    <th>วันที่เริ่มต้น</th>
                                    <th>วันที่สิ้นสุด</th>
                                    <th>สถานะ</th>
                                    <th>หมายเหตุ</th>
                                    <th>การจัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $booking)
                                    <tr>
                                        <td>{{ $booking->user->name ?? 'ไม่ระบุ' }}</td>
                                        <td>{{ $booking->car->name ?? 'ไม่ระบุ' }}</td>
                                        <td>{{ $booking->usage_type }}</td>
                                        <td class="text-center">{{ $booking->start_date }}</td>
                                        <td class="text-center">{{ $booking->end_date }}</td>
                                        <td class="text-center">
                                            @if ($booking->status == 'approved')
                                                <span class="badge bg-success">อนุมัติ</span>
                                            @elseif($booking->status == 'rejected')
                                                <span class="badge bg-danger">ไม่อนุมัติ</span>
                                            @else
                                                <span class="badge bg-warning">รอการอนุมัติ</span>
                                            @endif
                                        </td>
                                        <td>{{ $booking->note ?? 'ไม่มี' }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('bookings.show', $booking->id) }}"
                                                class="btn btn-info btn-sm mb-1">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            @if ($booking->status !== 'approved' && auth()->user()->role == 'user')
                                                <!-- ถ้ายังไม่อนุมัติและผู้ใช้ไม่ใช่แอดมิน ให้แสดงปุ่มแก้ไขและลบ -->
                                                <a href="{{ route('bookings.edit', $booking->id) }}"
                                                    class="btn btn-warning btn-sm mb-1">
                                                    <i class="fa-solid fa-pen"></i>
                                                </a>
                                                <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST"
                                                    style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm mb-1">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            @elseif (auth()->user()->role == 'admin')
                                                <!-- ถ้าเป็นแอดมิน ให้สามารถแก้ไขและลบได้โดยไม่สนใจสถานะ -->
                                                <a href="{{ route('bookings.edit', $booking->id) }}"
                                                    class="btn btn-warning btn-sm mb-1">
                                                    <i class="fa-solid fa-pen"></i>
                                                </a>
                                                <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST"
                                                    style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm mb-1">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
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
