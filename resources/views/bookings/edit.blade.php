@extends('layouts.adminlte')

@section('title', 'แก้ไขการจอง')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">แก้ไขการจอง</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('bookings.index') }}">การจอง</a></li>
                        <li class="breadcrumb-item active">แก้ไขการจอง</li>
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">เพิ่มการจอง</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <!-- User Selection -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="user_id">ชื่อผู้จอง <span><strong>*</strong></span></label>
                                            <select name="user_id" id="user_id"
                                                class="form-control @error('user_id') is-invalid @enderror"
                                                @if (auth()->user()->role == 'user') disabled @endif>
                                                @if (auth()->user()->role == 'user')
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}"
                                                            {{ old('user_id') == $user->id || auth()->user()->id == $user->id ? 'selected' : '' }}>
                                                            {{ $user->name }}
                                                        </option>
                                                    @endforeach
                                                @elseif ( (auth()->user()->role == 'admin'))
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}"
                                                            {{ old('user_id') == $user->id || $booking->user_id == $user->id ? 'selected' : '' }}>
                                                            {{ $user->name }}
                                                        </option>
                                                    @endforeach
                                                @endif

                                            </select>
                                            @error('user_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Car Selection -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="car_id">รถที่ต้องการจอง <span><strong>*</strong></span></label>
                                            <select name="car_id" id="car_id"
                                                class="form-control @error('car_id') is-invalid @enderror">
                                                <option>--- กรุณาเลือกรถ ---</option>
                                                @foreach ($cars as $car)
                                                    <option value="{{ $car->id }}"
                                                        {{ $car->id == $booking->car_id ? 'selected' : '' }}>
                                                        {{ $car->model }}</option>
                                                @endforeach
                                            </select>
                                            @error('car_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Usage Type -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="usage_type">ประเภทการใช้งาน <span><strong>*</strong></span></label>
                                            <input type="text" name="usage_type" id="usage_type"
                                                class="form-control @error('usage_type') is-invalid @enderror"
                                                value="{{ old('usage_type', $booking->usage_type) }}">
                                            @error('usage_type')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Purpose -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="purpose">วัตถุประสงค์ <span><strong>*</strong></span></label>
                                            <input type="text" name="purpose" id="purpose"
                                                class="form-control @error('purpose') is-invalid @enderror"
                                                value="{{ old('purpose', $booking->purpose) }}">
                                            @error('purpose')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Subject -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="subject">หัวข้อการจอง <span><strong>*</strong></span></label>
                                            <input type="text" name="subject" id="subject"
                                                class="form-control @error('subject') is-invalid @enderror"
                                                value="{{ old('subject', $booking->subject) }}">
                                            @error('subject')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Location -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="location">สถานที่ <span><strong>*</strong></span></label>
                                            <input type="text" name="location" id="location"
                                                class="form-control @error('location') is-invalid @enderror"
                                                value="{{ old('location', $booking->location) }}">
                                            @error('location')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Start Date -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="start_date">วันที่เริ่มต้นการจอง <span><strong>*</strong></span></label>
                                            <input type="date" name="start_date" id="start_date"
                                                class="form-control @error('start_date') is-invalid @enderror"
                                                value="{{ old('start_date', $booking->start_date) }}">
                                            @error('start_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- End Date -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="end_date">วันที่สิ้นสุดการจอง <span><strong>*</strong></span></label>
                                            <input type="date" name="end_date" id="end_date"
                                                class="form-control @error('end_date') is-invalid @enderror"
                                                value="{{ old('end_date', $booking->end_date) }}">
                                            @error('end_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Start Time -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="start_time">เวลาเริ่มต้นการจอง <span><strong>*</strong></span></label>
                                            <input type="time" name="start_time" id="start_time"
                                                class="form-control @error('start_time') is-invalid @enderror"
                                                value="{{ old('start_time', $booking->start_time) }}">
                                            @error('start_time')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- End Time -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="end_time">เวลาสิ้นสุดการจอง <span><strong>*</strong></span></label>
                                            <input type="time" name="end_time" id="end_time"
                                                class="form-control @error('end_time') is-invalid @enderror"
                                                value="{{ old('end_time', $booking->end_time) }}">
                                            @error('end_time')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Number of People -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="count_people">จำนวนคน <span><strong>*</strong></span></label>
                                            <input type="number" name="count_people" id="count_people"
                                                class="form-control @error('count_people') is-invalid @enderror"
                                                value="{{ old('count_people', $booking->count_people) }}">
                                            @error('count_people')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Note -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="note">หมายเหตุ <span><strong>*</strong></span></label>
                                            <textarea name="note" id="note" class="form-control @error('note') is-invalid @enderror">{{ old('note', $booking->note) }}</textarea>
                                            @error('note')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    @if (auth()->user()->role == 'admin')
                                        <!-- Car Status -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="status">สถานะการจอง</label>
                                                <select name="status"
                                                    class="form-control @error('status') is-invalid @enderror" required>
                                                    <option value="pending">รอการอนุมัติ</option>
                                                    <option value="approved"
                                                        @if (auth()->user()->role == 'admin') selected @endif>อนุมัติแล้ว
                                                    </option>
                                                    <option value="rejected">ไม่อนุมัติ</option>
                                                </select>
                                                @error('status')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">บันทึก</button>
                                    <a href="{{ route('bookings.index') }}" class="btn btn-secondary">ย้อนกลับ</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
