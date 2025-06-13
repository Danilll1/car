<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reqw extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'request';

    protected $fillable = [
        'id_user',
        'id_car',
        'id_status',
        'booking_date',
        'prava',
        'adress',
        'contact',
        'prava_date',
        'oplata',
        'admin_message'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function car() {
        return $this->belongsTo(Car::class, 'id_car');
    }

    public function status() {
        return $this->belongsTo(Status::class, 'id_status');
    }
}
