<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefferedBy extends Model {
    use HasFactory;

    protected $fillable = [
        'user_id',
        'own_refferal_id',
    ];

    public function user() {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function ownReff() {
        return $this->belongsTo(OwnRefferal::class, 'own_refferal_id', 'id');
    }
}
