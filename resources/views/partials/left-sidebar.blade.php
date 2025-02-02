@php
    $current_route = request()->route()->getName();
@endphp

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('assets/car_logo.png') }}" alt="AdminLTE Logo" class="brand-image"
            style="opacity: .8">
        <strong class="brand-text font-weight-light">ระบบจองรถยนต์</strong>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/no-image.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ $current_route == 'home' ? 'active' : '' }}">
                        <i class="fa-sharp fa-solid fa-house-chimney"></i>
                        <p>
                            หน้าหลัก
                        </p>
                    </a>
                </li>
                <li
                    class="nav-item {{ $current_route == 'bookings.index' || request()->routeIs('bookings.*') ? 'menu-open' : '' }}">
                    <a href="{{ route('bookings.index') }}"
                        class="nav-link {{ $current_route == 'bookings.index' || request()->routeIs('bookings.*') ? 'active' : '' }}">
                        <i class="fa-sharp fa-solid fa-car"></i>
                        <p>
                            จองรถออกนอกสำนักงาน
                        </p>
                    </a>
                </li>
                @if (auth()->user()->role == 'admin')
                    <li
                        class="nav-item {{ $current_route == 'cars.index' || request()->routeIs('cars.*') ? 'menu-open' : '' }}">
                        <a href="{{ route('cars.index') }}"
                            class="nav-link {{ $current_route == 'cars.index' || request()->routeIs('cars.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-car-side"></i>
                            <p>
                                จัดการรถในสำนักงาน
                            </p>
                        </a>
                    </li>
                    <li
                        class="nav-item {{ request()->routeIs('users.index') || request()->routeIs('users.*') ? 'menu-open' : '' }}">
                        <a href="{{ route('users.index') }}"
                            class="nav-link {{ request()->routeIs('users.index') || request()->routeIs('users.*') ? 'active' : '' }}">
                            <i class="fas fa-users-cog"></i>
                            <p>จัดการผู้ใช้งาน</p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>
