<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'order_code',
        'user_id',
        'hotel_id',
        'check_in',
        'check_out',
        'total_room',
        'total',
        'status_bayar',
    ];

    public function hotel() {
        return $this->belongsTo(Hotel::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function cancellation() {
        return $this->hasOne(Cancellation::class);
    }
}
