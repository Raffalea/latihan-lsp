<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    /**
     * Menampilkan Katalog Kamar
     */
    public function index()
    {
        $rooms = Room::where('status', 'available')->latest()->get();
        return view('customer.reservasi', compact('rooms'));
    }

    /**
     * FUNGSI BARU: Menampilkan Riwayat Pesanan Tamu (My Bookings)
     */
    public function history()
    {
        // Mengambil pesanan milik user yang sedang login saja
        $myReservations = Reservation::with('room')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('customer.history', compact('myReservations'));
    }

    /**
     * Menampilkan Form Booking
     */
    public function create($room_id)
    {
        $room = Room::findOrFail($room_id);
        return view('customer.create', compact('room'));
    }

    /**
     * Menyimpan Data Reservasi
     */
    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
        ]);

        $room = Room::findOrFail($request->room_id);
        $checkIn = Carbon::parse($request->check_in);
        $checkOut = Carbon::parse($request->check_out);

        // Hitung durasi minimal 1 hari jika tanggal sama/error
        $durasi = $checkIn->diffInDays($checkOut);
        if ($durasi == 0) $durasi = 1;

        Reservation::create([
            'user_id' => Auth::id(),
            'room_id' => $request->room_id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'total_price' => $durasi * $room->price_per_night,
            'status' => 'pending'
        ]);

        return redirect()->route('customer.history')->with('success', 'Reservasi berhasil dikirim! Silahkan cek status pesanan Anda di sini.');
    }
}
