@extends('layouts.adminlte')

@section('title', 'เพิ่มรถในสำนักงาน')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">เพิ่มรถในสำนักงาน</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">หน้าหลัก</a></li>
                        <li class="breadcrumb-item active">เพิ่มรถในสำนักงาน</li>
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
                        <h3>เพิ่มรถในสำนักงาน</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">ชื่อรถ <span><strong>*</strong></span></label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="license_plate">ทะเบียนรถ <span><strong>*</strong></span></label>
                                <input type="text" name="license_plate" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="brand">ยี่ห้อ <span><strong>*</strong></span></label>
                                <input type="text" name="brand" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="model">รุ่น <span><strong>*</strong></span></label>
                                <input type="text" name="model" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="seat_count">จำนวนที่นั่ง <span><strong>*</strong></span></label>
                                <input type="number" name="seat_count" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="vin">เลขตัวถัง (VIN) <span><strong>*</strong></span></label>
                                <input type="text" name="vin" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="warranty_expiration_date">วันหมดอายุประกัน <span><strong>*</strong></span></label>
                                <input type="date" name="warranty_expiration_date" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="tax_act_expiration_date">วันหมดอายุภาษี/พรบ. <span><strong>*</strong></span></label>
                                <input type="date" name="tax_act_expiration_date" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="status">สถานะรถ <span><strong>*</strong></span></label>
                                <select name="status" class="form-control" required>
                                    <option value="available">พร้อมใช้งาน</option>
                                    <option value="in_use">กำลังใช้งาน</option>
                                    <option value="maintenance">ซ่อมบำรุง</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="note">หมายเหตุ <span><strong>*</strong></span></label>
                                <textarea name="note" class="form-control"></textarea>
                            </div>

                            <!-- อัปโหลดรูปภาพ -->
                            <div class="form-group">
                                <label for="images">รูปภาพรถ <span><strong>*</strong></span></label>
                                <input type="file" name="images[]" class="form-control" multiple accept=".jpg,.png" id="imageInput">
                            </div>

                            <!-- แสดงตัวอย่างรูปภาพที่เลือก -->
                            <div class="form-group">
                                <label>รูปภาพที่เลือก</label>
                                <div id="imagePreview" class="row"></div>
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
        document.getElementById('imageInput').addEventListener('change', function(event) {
            let imagePreview = document.getElementById('imagePreview');
            imagePreview.innerHTML = ""; // ล้างภาพก่อนหน้า

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
                            imagePreview.appendChild(imgElement);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }
        });
    </script>
@endsection
