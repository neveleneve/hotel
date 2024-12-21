<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class country extends Model {
    use HasFactory;

    protected $fillable = [
        'name',
        'phone_code',
        'flag_code',
    ];

    public function hotel() {
        return $this->hasMany(Hotel::class);
    }
}
