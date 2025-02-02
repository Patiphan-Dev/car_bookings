@extends('layouts.adminlte')

@section('title', 'รายละเอียดรถ')

@section('content-header')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">รายละเอียดรถ</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">หน้าหลัก</a></li>
                    <li class="breadcrumb-item active">รายละเอียดรถ</li>
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
                    <h3 class="card-title">รายละเอียดรถ</h3>
                </div>
                <div class="card-body">
                    <!-- แสดงรูปภาพรถ -->
                    <div class="row mb-4">
                        <div class="col-md-5">
                            <!-- เริ่มต้น Carousel สำหรับแสดงรูปภาพ -->
                            <div id="carGallery" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach (json_decode($car->images, true) as $index => $image)
                                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                            <img src="{{ asset($image) }}" class="d-block w-100 img-fluid" alt="Car Image">
                                        </div>
                                    @endforeach
                                </div>
                                <!-- ปุ่มควบคุมสไลด์ -->
                                <a class="carousel-control-prev" href="#carGallery" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carGallery" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>

                        <div class="col-md-7">
                            <!-- ข้อมูลทั่วไปของรถ -->
                            <p><strong>ยี่ห้อ:</strong> {{ $car->brand }}</p>
                            <p><strong>รุ่น:</strong> {{ $car->model }}</p>
                            <p><strong>ทะเบียน:</strong> {{ $car->license_plate }}</p>
                            <p><strong>หมายเลขตัวถัง (VIN):</strong> {{ $car->vin }}</p>
                            <p><strong>จำนวนที่นั่ง:</strong> {{ $car->seat_count }} ที่นั่ง</p>
                            <p><strong>สถานะรถ:</strong> {{ ucfirst($car->status) }}</p>

                            <hr>

                            <!-- ข้อมูลเอกสารรถ -->
                            <h5 class="font-weight-bold">ข้อมูลเอกสาร</h5>
                            <p><strong>หมดอายุการรับประกัน:</strong> {{ \Carbon\Carbon::parse($car->warranty_expiration_date)->format('d-m-Y') }}</p>
                            <p><strong>หมดอายุภาษีรถยนต์:</strong> {{ \Carbon\Carbon::parse($car->tax_act_expiration_date)->format('d-m-Y') }}</p>

                            <hr>
                        </div>
                    </div>

                    <hr>

                    <a href="{{ route('cars.index') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-left"></i> กลับไปยังรายการรถ
                    </a>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
