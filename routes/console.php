<?php

use App\Models\Batteries\Battery;
use App\Models\Batteries\Params\battery_params;
use App\Models\Batteries\models_battery_links;
use App\Models\Batteries\Params\params;
use App\Models\Cars\brands;
use App\Models\Cars\brands_models_links;
use App\Models\Cars\models;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('create:brand {name}', function ($name) {
    $brand = brands::firstOrCreate([
        'name' => $name
    ],[]);
    print_r($brand->toArray());
});

Artisan::command('create:model {brand} {model}', function ($brand, $model) {
    $brand = brands::where('name', $brand)->first();
    if(!is_null($brand)) {
        $model = models::firstOrCreate([
            'name' => $model
        ],[]);
        $link = brands_models_links::firstOrCreate([
            'brand_id' => $brand->id,
            'model_id' => $model->id,
        ],[]);
        print_r([$model->toArray(), $link->toArray()]);
    } else {
        echo "БРЕНДА НЕТ, ДОЛБАЕБ".PHP_EOL;
    }
});

Artisan::command('create:battery {name}', function ($name) {
    $battery = Battery::firstOrCreate([
        'name' => $name
    ],[]);
    print_r($battery->toArray());
});

Artisan::command('create:link:battery {model_id} {battery_id}', function ($model_id, $battery_id) {
    $model = models::where('id', $model_id)->first();
    $battery = Battery::where('id', $battery_id)->first();
    if(!is_null($model) && !is_null($battery)) {
        $link = models_battery_links::firstOrCreate([
            'model_id' => $model->id,
            'battery_id' => $battery->id
        ],[]);
        print_r($link);
    } else {
        echo "ЧЕГО ТО НЕТ, ДОЛБАЕБ".PHP_EOL;
    }
});

Artisan::command('create:param {name} {unit=null}', function ($name, $unit) {
    if($unit == 'null') $unit = null;
    $param = params::firstOrCreate([
        'name' => $name,
        'unit' => $unit
    ],[]);
    print_r($param);
});

Artisan::command('create:battery:param {battery_id} {param_id} {value}', function ($battery_id, $param_id, $value) {
    $param = battery_params::firstOrCreate([
        'battery_id' => $battery_id,
        'param_id' => $param_id,
        'value' => $value
    ],[]);
    print_r($param);
});


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');