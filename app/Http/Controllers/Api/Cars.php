<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cars\brands;
use Illuminate\Http\Request;

class Cars extends Controller
{
    public function GetBrands()
    {
        $result = [];

        foreach (brands::get() as $brand) {
            array_push($result, [
                'brand_id' => $brand->id,
                'brand_name' => $brand->name,
                'created_at' => date('d.m.Y', (strtotime($brand->created_at))),
            ]);
        }

        return $result;
    }

    public function GetModelsList(Request $request)
    {
        if (isset($request->all()['brand_id'])) {
            $brand = brands::where('id', $request->all()['brand_id'])->first();
            if(!is_null($brand)) {
                $result = [];
                foreach($brand->links as $link) {
                    if(!is_null($link->model)) {
                        array_push($result, [
                            'model_id' => $link->model->id,
                            'model_name' => $link->model->name,
                            'created_at' => $link->model->created_at
                        ]);
                    }
                }
                return response()->json($result, 200);
            } else {
                return response()->json([
                    'error' => true,
                    'msg' => 'brand not found'
                ], 400);
            }
        } else {
            return response()->json([
                'error' => true,
                'msg' => 'send brand id'
            ], 400);
        }
    }

    public function GetBrandModels(Request $request)
    {
        if (isset($request->all()['brand_id'])) {
            $brand = brands::where('id', $request->all()['brand_id'])->first();
            if (!is_null($brand)) {
                $result = [
                    'brand_id' => $brand->id,
                    'brand_title' => $brand->name,
                    'models' => []
                ];
                foreach ($brand->links as $link) {
                    $model = [
                        'model_id' => $link->model->id,
                        'model_title' => $link->model->name,
                        'batteries' => []
                    ];
                    foreach ($link->model->battery as $battery) {
                        $arr_battery = [
                            'battery_id' => $battery->info->id,
                            'battery_title' => $battery->info->name,
                            'params' => []
                        ];
                        foreach ($battery->info->params as $param) {
                            if (!$param->block) {
                                if (!$param->info->block) {
                                    array_push($arr_battery['params'], [
                                        'id' => $param->param_id,
                                        'title' => $param->info->name,
                                        'unit' => $param->info->unit,
                                        'value' => $param->value
                                    ]);
                                }
                            }
                        }
                        array_push($model['batteries'], $arr_battery);
                    }
                    array_push($result['models'], $model);
                }
                return response()->json($result, 200);
            } else {
                return response()->json([
                    'error' => true,
                    'msg' => 'brand not found'
                ], 400);
            }
        } else {
            return response()->json([
                'error' => true,
                'msg' => 'send brand id'
            ], 400);
        }
    }

    public function AddBrand(Request $request) {
        if (isset($request->all()['brand_title'])) {
            $brand = brands::firstOrCreate([
                'name' => $request->all()['brand_title']
            ],[]);
            return response()->json($brand, 200);
        } else {
            return response()->json([
                'error' => true,
                'msg' => 'send brand title'
            ], 400);
        }
    }
}
