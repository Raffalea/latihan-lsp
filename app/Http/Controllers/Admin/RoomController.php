<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    /**
     * Menampilkan daftar semua kamar.
     */
    public function index()
    {
        $rooms = Room::latest()->get();
        return view('admin.rooms.index', compact('rooms'));
    }

    /**
     * Menampilkan form untuk menambah kamar baru.
     */
    public function create()
    {
        return view('admin.rooms.create');
    }

    /**
     * Menyimpan data kamar baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'room_number' => 'required|unique:rooms,room_number',
            'type' => 'required|in:Superior,Deluxe,Signature Suite',
            'price_per_night' => 'required|numeric|min:0',
            'facilities' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Opsional: Upload foto
        ]);

        $data = $request->all();

        // Logika upload gambar jika ada
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('rooms', 'public');
        }

        Room::create($data);

        return redirect()->route('rooms.index')
            ->with('success', 'Suite baru berhasil ditambahkan ke koleksi The Stone Hotel.');
    }

    /**
     * Menampilkan detail kamar tertentu (Opsional).
     */
    public function show(Room $room)
    {
        return view('admin.rooms.show', compact('room'));
    }

    /**
     * Menampilkan form edit kamar.
     */
    public function edit(Room $room)
    {
        return view('admin.rooms.edit', compact('room'));
    }

    /**
     * Memperbarui data kamar di database.
     */
    public function update(Request $request, Room $room)
    {
        $request->validate([
            'room_number' => 'required|unique:rooms,room_number,' . $room->id,
            'type' => 'required|in:Superior,Deluxe,Signature Suite',
            'price_per_night' => 'required|numeric|min:0',
            'facilities' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($room->image) {
                Storage::disk('public')->delete($room->image);
            }
            $data['image'] = $request->file('image')->store('rooms', 'public');
        }

        $room->update($data);

        return redirect()->route('rooms.index')
            ->with('success', 'Data suite berhasil diperbarui.');
    }

    /**
     * Menghapus kamar dari database.
     */
    public function destroy(Room $room)
    {
        if ($room->image) {
            Storage::disk('public')->delete($room->image);
        }

        $room->delete();

        return redirect()->route('rooms.index')
            ->with('success', 'Kamar telah berhasil dihapus dari sistem.');
    }
}
