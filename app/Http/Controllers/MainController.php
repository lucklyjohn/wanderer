<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Providers\Feature\FeatureService;
use DB;
class MainController extends Controller
{
    function render(FeatureService $feature){
        $render_config = ['feature_part'=>['nav','descriptor'],'version'=>['1.0','1.0']];
        //$test = json_encode(['title'=>['精选'=>'aaa','故事'=>'bbb']]);
        //DB::table('features')->where('id',1)->update(['config'=>$test]);
        $getFeature = $feature->getFeature($render_config);
        echo json_encode($getFeature);
    }
}