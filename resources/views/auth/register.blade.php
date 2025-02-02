<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>สมัครสมาชิก - ระบบจองรถยนต์ในสำนักงาน</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin-lte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('admin-lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin-lte/dist/css/adminlte.min.css') }}">
    <!-- Ionicons -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/car_logo.png') }}">

</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo">
            <a href="/home">
                <img src="{{ asset('assets/car_logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="width: 15%">
                <b>ระบบจองรถยนต์</b>
            </a>
        </div>

        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">สมัครสมาชิก</p>

                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user-plus"></span>
                            </div>
                        </div>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="ชื่อ" required>
                    </div>
                    @error('name')
                        <div class="text-danger mb-3">{{ $message }}</div>
                    @enderror
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <input type="text" name="position" class="form-control @error('position') is-invalid @enderror" placeholder="ตำแหน่ง" required>
                    </div>
                    @error('position')
                        <div class="text-danger mb-3">{{ $message }}</div>
                    @enderror
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="อีเมล" required>
                    </div>
                    @error('email')
                        <div class="text-danger mb-3">{{ $message }}</div>
                    @enderror
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-phone"></span>
                            </div>
                        </div>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="เบอร์โทรศัพน์" required>
                    </div>
                    @error('phone')
                        <div class="text-danger mb-3">{{ $message }}</div>
                    @enderror
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="รหัสผ่าน" required>
                        <div class="input-group-append">
                            <button type="button" id="showPassword" class="btn btn-outline-secondary" onclick="togglePassword()">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    @error('password')
                        <div class="text-danger mb-3">{{ $message }}</div>
                    @enderror

                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="ยืนยันรหัสผ่าน" required>
                    </div>

                    <div class="row">
                        <div class="col-7">
                            <div class="icheck-primary">
                                <input type="checkbox" name="terms" id="terms">
                                <label for="terms">
                                    ยอมรับข้อตกลง
                                </label>
                            </div>
                        </div>
                        <div class="col-5">
                            <button type="submit" class="btn btn-primary btn-block">สมัครสมาชิก</button>
                        </div>
                    </div>
                </form>

                <p class="mb-1 text-center mt-3">
                    <a href="{{ route('login') }}">มีบัญชีอยู่แล้ว? เข้าสู่ระบบ</a>
                </p>
            </div>
        </div>

    </div>

    <script>
        // ฟังก์ชันสำหรับแสดง/ซ่อนรหัสผ่าน
        function togglePassword() {
            var passwordField = document.getElementById('password');
            var passwordConfirmationField = document.getElementById('password_confirmation');
            var showPasswordButton = document.getElementById('showPassword');
            if (passwordField.type === "password") {
                passwordField.type = "text";
                passwordConfirmationField.type = "text";
                showPasswordButton.innerHTML = '<i class="fas fa-eye-slash"></i>'; // เปลี่ยนเป็น icon ของการซ่อนรหัสผ่าน
            } else {
                passwordField.type = "password";
                passwordConfirmationField.type = "password";
                showPasswordButton.innerHTML = '<i class="fas fa-eye"></i>'; // เปลี่ยนเป็น icon ของการแสดงรหัสผ่าน
            }
        }
    </script>

    <!-- jQuery -->
    <script src="{{ asset('admin-lte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin-lte/dist/js/adminlte.min.js') }}"></script>
</body>

</html>
