<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\Room;

class ReservationController extends Controller
{
    // Menampilkan semua pesanan yang masuk ke Admin
    public function index()
    {
        // Eager loading 'user' dan 'room' agar tidak berat
        $reservations = Reservation::with(['user', 'room'])->latest()->get();
        return view('admin.reservations.index', compact('reservations'));
    }

    // Menyetujui Pesanan
    public function approve($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['status' => 'confirmed']);

        return back()->with('success', 'Reservasi berhasil dikonfirmasi!');
    }

    // Menolak/Membatalkan Pesanan
    public function reject($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['status' => 'cancelled']);

        return back()->with('success', 'Reservasi telah dibatalkan.');
    }

    public function report(Request $request)
    {
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        // Pastikan memanggil class Reservation dengan benar
        $query = Reservation::with(['user', 'room'])->where('status', 'confirmed');

        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        }

        $reservations = $query->latest()->get();
        $totalRevenue = $reservations->sum('total_price');

        // Menghitung performa kamar
        $roomsReport = Room::withCount(['reservations' => function ($q) use ($startDate, $endDate) {
            $q->where('status', 'confirmed');
            if ($startDate && $endDate) {
                $q->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
            }
        }])->get();

        return view('admin.reservations.report', compact('reservations', 'totalRevenue', 'roomsReport', 'startDate', 'endDate'));
    }
}
