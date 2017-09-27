<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Model\Cars\Member;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $request;

    protected $members;

    protected $member_id = null;

    protected $data = array();

    public function __construct(Request $request)
    {

        $this->request = $request;
        $member = session_member();
        if(empty($member) === false){
            $this->member = $member;
            /**
             * @var Member
             */
            $this->data['member'] = $member;
            $this->member_id =$member->id;
        }else{
            $cookie = $this->request->cookie('member_id');
            if (empty($cookie) === false){
                $member = Member::find($cookie);
                session_member($member);
                $this->member = $member;
                /**
                 * @var Member
                 */
                $this->data['member'] = $member;
                $this->member_id =$member->id;
            }
        }
    }


    protected function jsonResult($code, $ret)
    {
    	//0表示输出字符信息，1表示输出数据
    	if ($code==0) {
    		echo json_encode(['code'=>0,'msg'=>$ret]);
    	}else{
    		echo json_encode(['code'=>1,'data'=>$ret]);
    	}
    }
}