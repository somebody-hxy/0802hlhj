<?php
namespace Home\Controller;
use Think\Controller;
class ApiController extends Controller {
	
	public function _initialize(){
		//session('memberid', 1);
		if(session('memberid')==""){
			$this->ajaxReturn(array('result_code'=>999,'message'=>'登录信息已过期'));
		}	
	}
   
    //更新会员信息
    public function updateUserInfo(){
    	$data['m_id'] = session('memberid');
	  	$data['m_nickname'] = I('post.nickName');
	    $data['m_avatarurl'] = I('post.avatarUrl');
	    $result = M('member')->save($data);
	    if($result!==false){
	    	$this->ajaxReturn(array('result_code'=>100,'message'=>'操作成功'));
	    }else{
	    	$this->ajaxReturn(array('result_code'=>101,'message'=>'操作失败'));
	    }
	}
	
	//用户中心
	public function getUserInfo(){
		$this->checkMember();
		$member = M('member')->where(array('m_id'=>session('memberid')))->find();
		$member['m_days'] = ceil(($member['m_etimes']-time())/86400);
		if($member){
			$this->ajaxReturn(array('result_code'=>100, 'message'=>'操作成功', 'data'=>array('list'=>$member)));
		}else{
			$this->ajaxReturn(array('result_code'=>101, 'message'=>'操作失败'));
		}
	}
	
	//设置用户信息
	public function setUserInfo(){
		$mid = session('memberid');
		$data['m_id'] = $mid;
		$data['m_phone'] = I('post.phone');
		$data['m_truename'] = I('post.truename');
		$result = M('member')->save($data);
		
		if($result!==false){
			$member = M('member')->where(array('m_id'=>$mid))->find();
			$this->ajaxReturn(array('result_code'=>100, 'message'=>'操作成功', 'data'=>array('member'=>$member)));
		}else{
			$this->ajaxReturn(array('result_code'=>101, 'message'=>'操作失败'));
		}
		
	}
	
	//邮寄地址列表
	public function getMemberAddress(){
		$list = M('member_address')->where(array('ma_member_id'=>session('memberid')))->order('ma_id desc')->select();
		$this->ajaxReturn(array('result_code'=>100, 'message'=>'操作成功', 'data'=>array('list'=>$list)));
	}
	
	//新增邮寄地址
	public function addMemberAddress(){
		if(I('post.id')==''){
			$data['ma_member_id'] = session('memberid');
			$data['ma_phone'] = I('post.phone');
			$data['ma_truename'] = I('post.truename');
			$data['ma_detail'] = I('post.detail');
			$data['ma_state'] = 0;
			$result = M('member_address')->add($data);
		}else{
			$data['ma_id'] = I('post.id');
			$data['ma_member_id'] = session('memberid');
			$data['ma_phone'] = I('post.phone');
			$data['ma_truename'] = I('post.truename');
			$data['ma_detail'] = I('post.detail');
			$result = M('member_address')->save($data);
		}
		if($result!==false){
			$this->ajaxReturn(array('result_code'=>100, 'message'=>'操作成功'));
		}else{
			$this->ajaxReturn(array('result_code'=>101, 'message'=>'操作失败'));
		}
	}
	
	//设置默认邮寄地址
	public function setDefaultAddress(){
		M('member_address')->where(array('ma_member_id'=>session('memberid')))->setField('ma_state', 0);
		$result = M('member_address')->save(array('ma_id'=>I('post.id'), 'ma_state'=>1));
		if($result!==false){
			$this->ajaxReturn(array('result_code'=>100, 'message'=>'操作成功'));
		}else{
			$this->ajaxReturn(array('result_code'=>101, 'message'=>'操作失败'));
		}
	}
	
	//删除邮寄地址
	public function delMemberAddress(){
		$result = M('member_address')->where(array('ma_id'=>I('post.id')))->delete();
		if($result!==false){
			$this->ajaxReturn(array('result_code'=>100, 'message'=>'操作成功'));
		}else{
			$this->ajaxReturn(array('result_code'=>101, 'message'=>'操作失败'));
		}
	}
	
	//讲师风采
	public function getLecturer(){
		$curr = I('post.curr');
		$num = 20;
//		$list = M('lecturer')->where(array('l_del'=>0))->limit(($curr-1)*$num ,$num)->select();
		$list = M('lecturer')->where(array('l_del'=>0))->order('l_id desc')->limit(($curr-1)*$num ,$num)->select();
//		$model = M('lecturer')->where(array('l_del'=>0))->order('l_id desc')->limit(($curr-1)*$num ,$num)->select();
		$count = M('lecturer')->where(array('l_del'=>0))->count();
		if($list){
//			$this->ajaxReturn(array('result_code'=>100,'message'=>'获取成功', 'data'=>array('list'=>$list, 'total'=>$count,'model'=>$model)));
			$this->ajaxReturn(array('result_code'=>100,'message'=>'获取成功', 'data'=>array('list'=>$list, 'total'=>$count)));
		}else{
			$this->ajaxReturn(array('result_code'=>101,'message'=>'获取失败'));
		}
	}
	
	//讲师详情
	public function getLecturerDetail(){
		$list = M('lecturer')->where(array('l_id'=>I('post.id')))->find();
		if($list){
			$this->ajaxReturn(array('result_code'=>100,'message'=>'获取成功', 'data'=>array('list'=>$list)));
		}else{
			$this->ajaxReturn(array('result_code'=>101,'message'=>'获取失败'));
		}
	}
	
	//视频分类
	public function getVideo(){
		$where['v_del'] = 0;
		if(I('post.id')){
			$where['v_type_id'] = I('post.id');
		}
		if(I('post.search')){
			$where['v_title'] = array('like','%'.I('post.search').'%');
		}
		
		$curr = I('post.curr');
		$num = 20;
		
		
		$list = M('video')->where($where)->order('v_id desc')->limit(($curr-1)*$num ,$num)->select();
		$count = M('video')->where($where)->count();
		$this->ajaxReturn(array('result_code'=>100,'message'=>'获取成功', 'data'=>array('list'=>$list, 'total'=>$count)));
	}
	
	//观看视频
	public function getVideoDetail(){
		$this->checkMember();
		$member = M('member')->where(array('m_id'=>session('memberid')))->find();
		if($member['m_type_id']!=0){
			$where['v_id'] = I('post.id');
			$model = M('video');
			$model->where($where)->where($where)->setInc('v_views');
			$list = $model->Field('v_id,v_title,v_pic,v_video,v_views,l_pic,l_name,vt_id')
			->join('longhai_video_type on longhai_video.v_type_id = longhai_video_type.vt_id','left')
			->join('longhai_lecturer on longhai_video.v_lecturer_id = longhai_lecturer.l_id','left')
			->where($where)->find();
			$order = $model->where(array('v_type_id'=>$list['vt_id'], 'v_id'=>array('neq', $list['v_id'])))->order('v_id desc')->limit(6)->select();
			if($list){
				$this->ajaxReturn(array('result_code'=>100,'message'=>'操作成功', 'data'=>array('detail'=>$list, 'order'=>$order)));
			}else{
				$this->ajaxReturn(array('result_code'=>101,'message'=>'操作失败'));
			}
		}else{
			$this->ajaxReturn(array('result_code'=>998,'message'=>'会员已过期，无法观看'));
		}
	}
	
	//重置会员信息
	public function checkMember(){
		$model = M('member');
		$member = $model->where(array('m_id'=>1))->find();
		if(time()>$member['m_etimes']){
			$data['m_id'] = $member['m_id'];
			$data['m_type_id'] = 0;
			$data['m_stimes'] = 0;
			$data['m_etimes'] = 0;
			$model->save($data);
		}
	}
	
	//发送短信
	public function sendMessage(){
		$phone = I('post.phone');
		$code = rand(100000,999999);
		$api = new \Org\Tool\Api();
		$result = $api->sendMesg($phone, $code);
		if($result){
			$this->ajaxReturn(array('result_code'=>100,'message'=>'操作成功', 'data'=>array('phone'=>$phone, 'code'=>$code)));
		}else{
			$this->ajaxReturn(array('result_code'=>101,'message'=>'操作失败'));
		}
		
	}
}