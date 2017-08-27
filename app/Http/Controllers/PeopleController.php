<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Providers\Feature\FeatureService;
use DB;
class PeopleController extends Controller
{
    public function homepage(){
        return view('people.zonepage');
    }

    public function render(FeatureService $feature){
        $render_config = ['feature_part'=>['nav'],'version'=>['1.0']];
        $getFeature = $feature->getFeature($render_config);
        echo json_encode($getFeature);
    }
}
