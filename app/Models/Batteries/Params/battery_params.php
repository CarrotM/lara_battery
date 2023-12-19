<?php

namespace App\Models\Batteries\Params;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class battery_params extends Model
{
    protected $table = 'battery_params';
    protected $fillable = [
        'param_id',
        'battery_id',
        'value',
        'block'
    ];

    public function info() {
        return $this->hasOne(params::class, 'id', 'param_id');
    }
}
