@extends('layouts.adminlte')

@section('title', 'หน้าหลัก')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">หน้าหลัก</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">หน้าหลัก</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content-body')
    @if (auth()->user()->role == 'admin')
        <div class="row">
            <!-- Total Cars -->
            {{-- <div class="col-md-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalCars }}</h3>
                    <p>รถทั้งหมด</p>
                </div>
                <div class="icon">
                    <i class="fas fa-car"></i>
                </div>
                <a href="{{ route('cars.index') }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div> --}}

            <!-- Total Bookings -->
            <div class="col-md-3 col-6">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ $totalBookings }}</h3>
                        <p>ยอดจองรวม</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <a href="{{ route('bookings.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- Pending Bookings -->
            <div class="col-md-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $pendingBookings }}</h3>
                        <p>การจองที่รอดำเนินการ</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                    <a href="{{ route('bookings.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- Approved Bookings -->
            <div class="col-md-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $approvedBookings }}</h3>
                        <p>การจองที่ได้รับอนุมัติ</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <a href="{{ route('bookings.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- Rejected Bookings -->
            <div class="col-md-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $rejectedBookings }}</h3>
                        <p>การจองที่ถูกปฏิเสธ</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-times-circle"></i>
                    </div>
                    <a href="{{ route('bookings.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- Available Cars -->
            {{-- <div class="col-md-3 col-6">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $availableCars }}</h3>
                    <p>รถที่พร้อมใช้งาน</p>
                </div>
                <div class="icon">
                    <i class="fas fa-car-side"></i>
                </div>
                <a href="{{ route('cars.index') }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div> --}}
        </div>
    @endif

    <div class="container">
        <div class="row">
            <link rel="stylesheet" href="{{ asset('admin-lte/dist/css/adminlte.min.css') }}">
            <script src="{{ asset('admin-lte/plugins/jquery/jquery.min.js') }}"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <style>
                .btn {
                    color: #fff !important;
                }
            </style>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    var calendarEl = document.getElementById('calendar');
                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        locale: 'th',
                        timeZone: 'Asia/Bangkok',
                        initialView: 'dayGridMonth',
                        titleFormat: {
                            month: 'long',
                            year: 'numeric',
                            day: 'numeric'
                        },
                        buttonText: {
                            today: 'วันนี้',
                            timeGridDay: 'วัน',
                            timeGridWeek: 'สัปดาห์',
                            dayGridMonth: 'เดือน'
                        },
                        headerToolbar: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'dayGridMonth,timeGridWeek,timeGridDay'
                        },
                        themeSystem: 'bootstrap',
                        events: [
                            @foreach ($bookings as $row)
                                {
                                    id: '{{ $row->id }}',
                                    title: '{{ $row->start_time }} ถึง {{ $row->end_time }} - {{ $row->car->name }} - {{ $row->subject }}', // แสดงชื่อรถ + หัวข้อจอง
                                    start: '{{ $row->start_date }}T{{ $row->start_time }}',
                                    end: '{{ $row->end_date }}T{{ $row->end_time }}',
                                    allDay: false,
                                    url: '{{ url('bookings/' . $row->id) }}',
                                    backgroundColor: '{{ $row->randomColor() }}',
                                    borderColor: '{{ $row->randomColor() }}',
                                    textColor: 'white',
                                },
                            @endforeach
                        ],
                    });

                    calendar.render();
                });
            </script>
            <style>
                .fc-event-time {
                    display: none;
                }
            </style>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="d-grid gap-2 d-md-flex justify-content-end">
                        <a href="{{ route('bookings.create') }}" class="btn btn-success mb-2">
                            <i class="fa fa-plus"></i> จองรถ
                        </a>
                    </div>
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="card">
                                    <div class="card-body p-0">
                                        <div id="calendar"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </section>

        </div>
    </div>
@stop
