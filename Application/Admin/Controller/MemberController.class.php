<?php
namespace Admin\Controller;
class MemberController extends BaseController {
	
	public function index(){
		$model = M('member');
		$count = $model->count();
		$page = $this->getPage($count);
		$list = $model->join('longhai_member_type on longhai_member.m_type_id = longhai_member_type.mt_id','left')
		->order('m_id desc')->limit($page['first'], $page['rows'])->select();
		$this->assign('list',$list);
		$this->assign('count',$count);
		$this->assign('page',$page);
		$this->display();
	}
	
	public function edit(){
		if(IS_POST){
			$data['m_id'] = I('post.m_id');
			$data['m_type_id'] = I('post.m_type_id');
			$data['m_stimes'] = time();
			$data['m_etimes'] = time() + (60*60*24*I('post.day'));
			$result = M('member')->save($data);
			$this->checkResult($result, U('index?curr='.I('post.curr').''));
		}else{
			$type = M('member_type')->where(array('mt_del'=>0))->order('mt_id asc')->select();
			$this->assign('type',$type);
			$this->assign('json',json_encode($type));
			
			$list = M('member')->where(array('m_id'=>I('get.id')))->find();
			$this->assign('list', $list);
			$this->assign('curr', I('get.curr'));
			$this->display();
		}
	}
	
	public function append(){
		if(IS_POST){
			$data['m_id'] = I('post.m_id');
			$data['m_type_id'] = I('post.m_type_id');
			$data['m_etimes'] = I('post.m_etimes') + (60*60*24*I('post.day'));
			$result = M('member')->save($data);
			$this->checkResult($result, U('index?curr='.I('post.curr').''));
		}else{
			$type = M('member_type')->where(array('mt_del'=>0))->order('mt_id asc')->select();
			$this->assign('type',$type);
			$this->assign('json',json_encode($type));
			
			$list = M('member')->where(array('m_id'=>I('get.id')))->find();
			$this->assign('list', $list);
			$this->assign('curr', I('get.curr'));
			$this->display();
		}
	}
	
	public function end(){
		$data['m_id'] = I('get.id');
		$data['m_type_id'] = 0;
		$data['m_stimes'] = 0;
		$data['m_etimes'] = 0;
		$result = M('member')->save($data);
		$this->checkResult($result, U('index?curr='.I('post.curr').''));
	}
	
	public function del(){
		$model = M('member');
		$where['m_id'] = I('id');
		$result = $model->where($where)->delete();
		$this->checkResult($result, U('index?curr='.I('get.curr').''));
	}
	
}