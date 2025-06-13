<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class Car extends Model
{
    use HasFactory;

    protected $table = 'car';

    protected $fillable = [
        'name',
    ];

    public function request() {
        return $this->hasMany(Reqw:: class, 'id_car');
    }
}
