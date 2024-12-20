<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model {
    use HasFactory;

    protected $fillable = [
        'name',
        'country_id',
        'price',
        'description',
    ];

    public function country() {
        return $this->belongsTo(country::class);
    }
}
