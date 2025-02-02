<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Booking;

class HomeController extends Controller
{
    public function index()
    {
        // ดึงข้อมูลสถิติต่างๆ
        $totalCars = Car::count();
        $totalBookings = Booking::count();
        $bookings = Booking::with(['car', 'user'])->get(); // ดึงข้อมูลการจองทั้งหมด
        $pendingBookings = Booking::where('status', 'pending')->count();
        $approvedBookings = Booking::where('status', 'approved')->count();
        $rejectedBookings = Booking::where('status', 'rejected')->count();
        $availableCars = Car::where('status', 'available')->count();

        // dd($bookings);


        return view('home', compact(
            'totalCars',
            'totalBookings',
            'pendingBookings',
            'approvedBookings',
            'rejectedBookings',
            'availableCars',
            'bookings'
        ));
    }
}
