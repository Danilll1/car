<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $table = 'status';

    protected $fillabla = [
        'code',
        'name',
    ];

    public function request() {
        return $this->hasMany(Reqw:: class, 'id_status');
    }
}
