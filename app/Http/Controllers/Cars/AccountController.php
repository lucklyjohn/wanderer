<?php

namespace App\Http\Controllers\Cars;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    //
    public function getVerifyCode(Request $request){
	$get = $request->input();
	$ret = ['code'=>1,'msg'=>'success'];
    echo json_encode($ret);
	}

    public function testVerifyCode(Request $request){
	$get = $request->input();
		$ret = ['code'=>1,'msg'=>'success'];
	if(!$request->input('phonenumber')){
		$ret = ['code'=>0,'msg'=>'failed'];
	}
    echo json_encode($ret);
	}


}
