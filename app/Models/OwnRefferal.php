<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OwnRefferal extends Model {
    use HasFactory;

    protected $fillable = [
        'user_id',
        'reff_code',
    ];

    public function user() {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function reffBy() {
        return $this->hasMany(RefferedBy::class);
    }
}
