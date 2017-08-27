<?php

namespace App\Http\Controllers\Cars;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CarInfosController extends Controller
{
    //
    public function index(Request $request){
	$get = $request->input();
    return json_encode(['code'=>1,'msg'=>'success',$get['id'],$get['name']]);
	}
}
