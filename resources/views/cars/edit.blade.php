@extends('layouts.adminlte')

@section('title', 'แก้ไขรถในสำนักงาน')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">แก้ไขรถในสำนักงาน</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">หน้าหลัก</a></li>
                        <li class="breadcrumb-item active">แก้ไขรถในสำนักงาน</li>
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
                        <h3>แก้ไขรถในสำนักงาน</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('cars.update', $car->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>ชื่อรถ <span><strong>*</strong></span></label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ $car->name }}" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>ทะเบียนรถ <span><strong>*</strong></span></label>
                                        <input type="text" name="license_plate" class="form-control"
                                            value="{{ $car->license_plate }}" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>ยี่ห้อรถ <span><strong>*</strong></span></label>
                                        <input type="text" name="brand" class="form-control"
                                            value="{{ $car->brand }}" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>รุ่นรถ <span><strong>*</strong></span></label>
                                        <input type="text" name="model" class="form-control"
                                            value="{{ $car->model }}" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>จำนวนที่นั่ง</label>
                                        <input type="number" name="seat_count" class="form-control"
                                            value="{{ $car->seat_count }}" required>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>เลขตัวถัง (VIN) <span><strong>*</strong></span></label>
                                        <input type="text" name="vin" class="form-control"
                                            value="{{ $car->vin }}" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>วันหมดอายุประกัน <span><strong>*</strong></span></label>
                                        <input type="date" name="warranty_expiration_date" class="form-control"
                                            value="{{ $car->warranty_expiration_date }}" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>วันหมดอายุภาษี/พรบ. <span><strong>*</strong></span></label>
                                        <input type="date" name="tax_act_expiration_date" class="form-control"
                                            value="{{ $car->tax_act_expiration_date }}" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>สถานะรถ <span><strong>*</strong></span></label>
                                        <select name="status" class="form-control">
                                            <option value="available" {{ $car->status == 'available' ? 'selected' : '' }}>
                                                ว่าง</option>
                                            <option value="in_use" {{ $car->status == 'in_use' ? 'selected' : '' }}>
                                                ถูกใช้งาน</option>
                                            <option value="maintenance"
                                                {{ $car->status == 'maintenance' ? 'selected' : '' }}>
                                                ซ่อมบำรุง</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>หมายเหตุ <span><strong>*</strong></span></label>
                                        <textarea name="note" class="form-control">{{ $car->note }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- แสดงรูปภาพปัจจุบัน -->
                                <div class="form-group">
                                    <label>รูปภาพปัจจุบัน</label>
                                    <div class="row">
                                        @foreach (json_decode($car->images, true) as $image)
                                            {{-- <div class="col-md-3"> --}}
                                                <img src="{{ asset($image) }}" class="img-thumbnail m-2" style="width: 120px;">
                                            {{-- </div> --}}
                                        @endforeach
                                    </div>
                                </div>

                                <!-- อัปโหลดรูปภาพใหม่ -->
                                <div class="form-group">
                                    <label>อัปโหลดรูปภาพใหม่ <span><strong>*</strong></span></label>
                                    <input type="file" name="images[]" class="form-control" multiple accept=".jpg,.png" id="imageInputEdit">
                                    <small class="text-muted">อัปโหลดได้หลายรูป (เฉพาะ .jpg และ .png)</small>
                                </div>

                                <!-- แสดงตัวอย่างรูปภาพที่เลือก -->
                                <div class="form-group">
                                    <label>รูปภาพที่เลือก</label>
                                    <div id="imagePreviewEdit" class="row"></div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">บันทึก</button>
                            <a href="{{ route('cars.index') }}" class="btn btn-secondary">ยกเลิก</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.getElementById('imageInputEdit').addEventListener('change', function(event) {
            let imagePreviewEdit = document.getElementById('imagePreviewEdit');
            imagePreviewEdit.innerHTML = ""; // ล้างภาพก่อนหน้า

            let files = event.target.files;
            if (files) {
                Array.from(files).forEach(file => {
                    if (file.type.startsWith('image/')) {
                        let reader = new FileReader();
                        reader.onload = function(e) {
                            let imgElement = document.createElement('img');
                            imgElement.src = e.target.result;
                            imgElement.className = 'img-thumbnail m-2';
                            imgElement.style.width = '120px';
                            imagePreviewEdit.appendChild(imgElement);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }
        });
    </script>
@endsection
