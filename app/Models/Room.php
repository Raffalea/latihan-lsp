<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    // Tambahkan baris di bawah ini
    protected $fillable = [
        'room_number',
        'type',
        'price_per_night',
        'facilities',
        'status',
        'image',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
