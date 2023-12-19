<?php

namespace App\Models\Batteries\Params;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class params extends Model
{
    protected $table = 'params';
    protected $fillable = [
        'name',
        'unit',
        'block'
    ];
}
