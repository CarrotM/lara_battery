<?php

namespace App\Models\Batteries;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class models_battery_links extends Model
{
    protected $table = 'models_battery_links';
    protected $fillable = [
        'model_id',
        'battery_id'
    ];

    public function info() {
        return $this->hasOne(Battery::class, 'id', 'battery_id');
    }
}
