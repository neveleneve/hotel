<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'country_id',
        'price',
        'image',
        'rating',
        'description',
        'promo',
        'discount'
    ];

    public function country() {
        return $this->belongsTo(country::class);
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }
}
