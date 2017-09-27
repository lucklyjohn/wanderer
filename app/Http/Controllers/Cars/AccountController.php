<?php

namespace App\Http\Controllers\Cars;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Cars\Member;
use Mockery\Exception;

class AccountController extends Controller
{
    //
    public function getVerifyCode(Request $request)
    {
        $get = $request->input();
        $ret = ['code' => 1, 'msg' => 'success'];
        echo json_encode($ret);
    }

    public function testVerifyCode(Request $request)
    {
        $get = $request->input();
        $ret = ['code' => 1, 'msg' => 'success'];
        if (!$request->input('phonenumber')) {
            $ret = ['code' => 0, 'msg' => 'failed'];
        }
        echo json_encode($ret);
    }

    public function passagerRegister(Request $request)
    {
        $phone = $this->request->input('phone');
        $password = $this->request->input('pswd');
        $confirm_password = $this->request->input("pswdconfirm");
        if ($password!=$confirm_password){
            echo json_encode(['code'=>0,'msg'=>'请确认密码输入一致']);
            die();
        }

        $member = new Member();
        $member->phone = $phone;
        $member->password = md5($password);
        $verify = Member::where('phone',$member->phone)->get();
        if ($verify){
            echo json_encode(['code'=>0,'msg'=>'手机号已经存在']);
            die();
        }
        try{
            Member::addOrUpdateMember($member);
            echo json_encode(['code'=>1,'data'=>$request->input()]);
            die();
        }catch(Exception $e){
            echo json_encode(['code'=>0,'msg'=>$e->getMessage()]);
            die();
        }
    }

    public function driverRegister()
    {


        echo json_encode(['code'=>1,'data'=>'success']);
    }

    public function login(Request $request)
    {

        $phone = $request->input('phone');

        $password = $request->input('passwd');

        if (empty($phone) or strlen($phone) > 20 or strlen($phone) < 3) {
            $this->jsonResult(0, '手机号格式有误');
        }
        if (empty($password)) {

            $this->jsonResult(0, '密码不能为空');
        }

        $member = Member::login($phone, $password);

        if ($member['code'] == 0) {

            $this->jsonResult(0, $member['msg']);

        } else {

            session_member($member['data']);

            cookie_member($member['data']);

            $this->jsonResult(1, $member);

        }

    }

    /**
     * 退出登录
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function logout()
    {
        $this->request->session()->flush();

        cookie_member(null,true);


        echo json_encode(['code'=>1,'msg'=>'logout']);
    }


    public function is_login(Request $request){
        if(empty($this->member_id)===false){
            $member = $this->data['member'];
            echo json_encode(['code'=>1,'data'=>$member]);
        }else{
            echo json_encode(['code'=>0,'msg'=>'you have not login']);
        }
    }
}