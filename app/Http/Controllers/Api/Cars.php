<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\brands;
use App\Models\brands_models_links;
use Illuminate\Http\Request;

class Cars extends Controller
{
    public function GetBrands() {
        $result = [];

        foreach(brands::get() as $brand) {
            array_push($result, [
                'brand_id' => $brand->id,
                'brand_name' => $brand->name,
                'created_at' => date('d.m.Y', (strtotime($brand->created_at))),
            ]);
        }

        return $result;
    }
    public function GetBrandModels(Request $request) {
        if(isset($request->all()['brand_id']))
        {
            $brand = brands::where('id', $request->all()['brand_id'])->first();
            if(!is_null($brand)) {
                $result = [
                    'brand_id' => $brand->id,
                    'brand_title' => $brand->name,
                    'models' => []
                ];
                foreach($brand->links as $link) {
                    array_push($result['models'], [
                        'model_id' => $link->model->id,
                        'model_title' => $link->model->name
                    ]);
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
}
