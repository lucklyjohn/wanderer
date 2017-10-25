<?php

namespace App\Model\Cars;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    //
    protected $table = 'car_members';

    public static function addOrUpdateMember(Member &$member)
    {
    	return $member->save();
    }

    public static function login($phone,$password)
    {
        $member = Member::where('phone','=',$phone)->take(1)->first();

        if(empty($member) or md5("$password")!=$member->password){

            return ['code'=>0,'msg'=>'密码输入错误,请检查账号密码是否正确'];
        }

        return ['code'=>1,'data'=>$member];
    }

}