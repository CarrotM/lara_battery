<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Battery extends Model
{
    protected $table = 'batteries';
    protected $fillable = [
        'name',
    ];
}
