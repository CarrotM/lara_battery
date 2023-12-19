<?php

namespace App\Models\Cars;

use App\Models\Batteries\models_battery_links;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class models extends Model
{
    protected $table = 'models';
    protected $fillable = [
        'name'
    ];

    public function links() {
        return $this->hasMany(brands_models_links::class, 'model_id');
    }

    public function battery() {
        return $this->hasMany(models_battery_links::class, 'model_id');
    }
}
