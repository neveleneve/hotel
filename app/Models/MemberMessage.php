<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberMessage extends Model {
    use HasFactory;

    protected $fillable = [
        'user_id',

        'hotel_id',
        'price',
        'active'
    ];

    public function hotel() {
        return $this->belongsTo(Hotel::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
