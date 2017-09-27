<?php
use App\Model\Cars\Member;
if (! function_exists('session_member')) {
    /**
     * 获取或设置登录用户 Session
     * @param Member|null $member
     * @return mixed|Member
     */
    function session_member(Member $member = null){
        if($member == null){
            $member = session('member');
            if(empty($member) === false){
                $member->id = intval($member->id);
            }
        }else{
            session(['member' => $member]);
        }
        return $member;
    }
}

if(!function_exists('cookie_member')){
    /**
     * 获取或设置登录用户 Cookie
     * @param Member|null $member
     * @param bool $isExpired
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|Member|Member[]
     */
    function cookie_member(Member $member = null, $isExpired = false){
        if($isExpired){
            setcookie('member_id','', -1);
        }else {
            if ($member == null) {
                $cookie = Request::cookie('member_id');
                if (empty($cookie) === false) {
                    $member = Member::find($cookie);
                }
            } else {
                setcookie('member_id',$member->id,time()+60*30*24);
            }
        }
        return $member;
    }
}
