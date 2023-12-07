<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class brands_models_links extends Model
{
    protected $table = 'brands_models_links';
    protected $fillable = [
        'brand_id',
        'model_id'
    ];

    public function brand() {
        return $this->hasOne(brands::class, 'id', 'brand_id');
    }

    public function model() {
        return $this->hasOne(models::class, 'id', 'model_id');
    }
}
