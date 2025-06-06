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
        'is_hot_sale',
        'member_message_id',
    ];

    public function hotel() {
        return $this->belongsTo(Hotel::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function memberMessage() {
        return $this->belongsTo(MemberMessage::class, 'member_message_id')
            ->withTrashed()
            ->when($this->is_hot_sale, function ($query) {
                return $query->where('active', true);
            });
    }
}
