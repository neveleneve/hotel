<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model {
    use HasFactory;

    protected $fillable = [
        'order_code',
        'user_id',
        'hotel_id',
        'check_in',
        'check_out',
        'total_room',
        'total',
        'status_bayar',
        'status_pesan',
        'status_cancel',
    ];

    public function hotel() {
        return $this->belongsTo(Hotel::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
