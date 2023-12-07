<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class brands extends Model
{
    protected $table = 'brands';
    protected $fillable = [
        'name'
    ];

    public function links() {
        return $this->hasMany(brands_models_links::class, 'brand_id', 'id');
    }
}
