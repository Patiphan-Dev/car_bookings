<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ระบบจองรถยนต์ในสำนักงาน</title>

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

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="/home">
                <img src="{{ asset('assets/car_logo.png') }}" alt="AdminLTE Logo" class="brand-image"
                    style="width: 15%">
                <b>ระบบจองรถยนต์</b>
            </a>
        </div>
        <div class="card">
            <div class="card-body ">
                @if (session('error'))
                    <div class="text-danger text-center">{{ session('error') }}</div>
                @endif
                @if (session('success'))
                    <div class="text-success text-center">{{ session('success') }}</div>
                @endif

                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <input type="text" name="email" class="form-control" placeholder="email" required>
                    </div>
                    @error('email')
                        <div class="text-danger mb-3">{{ $message }}</div>
                    @enderror
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <input type="password" id="password" name="password" class="form-control"
                            placeholder="password" required>
                        <div class="input-group-append">
                            <button type="button" id="showPassword" class="btn btn-outline-secondary"
                                onclick="togglePassword()">
                                <i class="fas fa-eye"></i> 
                            </button>
                        </div>
                    </div>
                    @error('password')
                        <div class="text-danger mb-3">{{ $message }}</div>
                    @enderror
                    <div class="row">
                        <div class="col-7">
                            <div class="icheck-primary">
                                <input type="checkbox" name="remember" id="remember">
                                <label for="remember">
                                    จดจำฉัน
                                </label>
                            </div>
                        </div>
                        <div class="col-5">
                            <button type="submit" class="btn btn-primary btn-block">เข้าสู่ระบบ</button>
                        </div>
                    </div>
                </form>

                <p class="mb-1 text-center mt-3">
                    <a href="{{ route('register') }}">ยังไม่บัญชี? สมัครสมาชิก</a>
                </p>
            </div>
        </div>

    </div>
    <script>
        // ฟังก์ชันสำหรับแสดง/ซ่อนรหัสผ่าน
        function togglePassword() {
            var passwordField = document.getElementById('password');
            var showPasswordButton = document.getElementById('showPassword');
            if (passwordField.type === "password") {
                passwordField.type = "text";
                showPasswordButton.innerHTML = '<i class="fas fa-eye-slash"></i>'; // เปลี่ยนเป็น icon ของการซ่อนรหัสผ่าน
            } else {
                passwordField.type = "password";
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
