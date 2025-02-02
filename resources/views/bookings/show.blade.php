@extends('layouts.adminlte')

@section('title', 'รายละเอียดการจองรถ')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">รายละเอียดการจองรถ</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">หน้าหลัก</a></li>
                        <li class="breadcrumb-item active">รายละเอียดการจองรถ</li>
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
                        <h3 class="card-title">รายละเอียดการจองรถ</h3>
                    </div>
                    <div class="card-body">
                        <!-- แสดงรูปภาพรถ -->
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <!-- เริ่มต้น Carousel สำหรับแสดงรูปภาพ -->
                                <div id="carGallery" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach (json_decode($booking->car->images, true) as $index => $image)
                                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                <img src="{{ asset($image) }}" class="d-block w-100 img-fluid"
                                                    alt="Car Image">
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

                            <div class="col-md-8">
                                <!-- แสดงข้อมูลผู้ใช้ที่จอง -->
                                <p><strong>ผู้ใช้:</strong> {{ $booking->user->name }}</p>
                                <p><strong>ประเภทการใช้งาน:</strong> {{ $booking->usage_type }}</p>
                                <p><strong>เหตุผลการจอง:</strong> {{ $booking->purpose }}</p>
                                <p><strong>เรื่อง:</strong> {{ $booking->subject }}</p>
                                <p><strong>สถานที่:</strong> {{ $booking->location }}</p>

                                <hr>

                                <!-- ข้อมูลการจอง -->
                                <h5 class="font-weight-bold">วันที่และเวลา</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>วันที่เริ่มต้นการจอง:</strong>
                                            {{ \Carbon\Carbon::parse($booking->start_date)->format('d-m-Y') }}</p>
                                        <p><strong>เวลาเริ่มต้น:</strong> {{ $booking->start_time }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>วันที่สิ้นสุดการจอง:</strong>
                                            {{ \Carbon\Carbon::parse($booking->end_date)->format('d-m-Y') }}</p>
                                        <p><strong>เวลาสิ้นสุด:</strong> {{ $booking->end_time }}</p>
                                    </div>
                                </div>

                                <hr>

                                <!-- ข้อมูลเพิ่มเติม -->
                                <h5 class="font-weight-bold">ข้อมูลเพิ่มเติม</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>จำนวนวัน:</strong> {{ $booking->count_days }} วัน</p>
                                        <p><strong>จำนวนคน:</strong> {{ $booking->count_people }} คน</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>จำนวนชั่วโมง:</strong> {{ $booking->count_hours }} ชั่วโมง
                                            {{ $booking->count_minutes }} นาที</p>
                                        <p><strong>หมายเหตุ:</strong> {{ $booking->note ?? 'ไม่มีหมายเหตุ' }}</p>
                                    </div>
                                </div>

                                <hr>

                                <!-- สถานะการจอง -->
                                <h5 class="font-weight-bold">สถานะการจอง</h5>
                                <p><strong>สถานะ:</strong> {{ ucfirst($booking->status) }}</p>

                            </div>
                        </div>

                        <hr>

                        <a href="{{ route('bookings.index') }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left"></i> กลับไปยังรายการการจอง
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
