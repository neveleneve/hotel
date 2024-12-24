<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model {
    use HasFactory;

    protected $fillable = [
        'user_id',
        'hotel_id',
        'check_in',
        'check_out',
        'total_room',
        'total',
    ];

    public function hotel() {
        return $this->belongsTo(Hotel::class);
    }
}
