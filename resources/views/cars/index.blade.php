@extends('layouts.adminlte')

@section('title', 'รถในสำนักงาน')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">รถในสำนักงาน</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">หน้าหลัก</a></li>
                        <li class="breadcrumb-item active">จัดการรถในสำนักงาน</li>
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
                <a href="{{ route('cars.create') }}" class="btn btn-primary mb-3 mt-3">
                    <i class="fa fa-plus"></i> เพิ่มรถ
                </a>
            </div>
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">รถทั้งหมดในสำนักงาน</h2>
                    </div>
                    <div class="card-body">
                        <table id="cars_index" class="table table-bordered table-hover">
                            <thead class="text-center">
                                <tr>
                                    <th>ชื่อรถ</th>
                                    <th>ทะเบียนรถ</th>
                                    <th>ยี่ห้อ</th>
                                    <th>รุ่น</th>
                                    <th>จำนวนที่นั่ง</th>
                                    <th>สถานะ</th>
                                    <th>หมายเหตุ</th>
                                    <th>รูปภาพ</th>
                                    <th>การจัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cars as $car)
                                    <tr>
                                        <td>{{ $car->name }}</td>
                                        <td>{{ $car->license_plate }}</td>
                                        <td>{{ $car->brand }}</td>
                                        <td>{{ $car->model }}</td>
                                        <td class="text-center">{{ $car->seat_count }}</td>
                                        <td class="text-center">
                                            @if ($car->status == 'available')
                                                <span class="badge bg-success">พร้อมใช้งาน</span>
                                            @elseif($car->status == 'in_use')
                                                <span class="badge bg-danger">ถูกใช้งาน</span>
                                            @elseif ($car->status == 'maintenance')
                                                <span class="badge bg-warning">ซ่อมบำรุง</span>
                                            @endif
                                        </td>
                                        <td>{{ $car->note }}</td>
                                        <td>
                                            @foreach (json_decode($car->images, true) as $image)
                                                <img src="{{ asset($image) }}" width="50vw" height="50vh">
                                            @endforeach
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('cars.show', $car->id) }}" class="btn btn-info btn-sm mb-1">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('cars.edit', $car) }}" class="btn btn-warning btn-sm mb-1"><i
                                                    class="fa-solid fa-pen"></i></a>
                                            <form action="{{ route('cars.destroy', $car) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm mb-1"
                                                    onclick="return confirm('คุณต้องการลบข้อมูลนี้?')"><i
                                                        class="fa-solid fa-trash"></i></button>
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
