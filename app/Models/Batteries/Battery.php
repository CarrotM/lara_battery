<?php

namespace App\Models\Batteries;

use App\Models\Batteries\Params\battery_params;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Battery extends Model
{
    protected $table = 'batteries';
    protected $fillable = [
        'name',
    ];

    public function params() {
        return $this->hasMany(battery_params::class, 'battery_id', 'id');
    }
}
