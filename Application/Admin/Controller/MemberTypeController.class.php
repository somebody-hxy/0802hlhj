<?php
namespace Admin\Controller;
class MemberTypeController extends BaseController {
	
	public function index(){
		$model = M('member_type');
		$where['mt_del'] = 0;
		$count = $model->where($where)->count();
		$page = $this->getPage($count);
		$list = $model->where($where)->order('mt_id asc')->limit($page['first'], $page['rows'])->select();
		$this->assign('list',$list);
		$this->assign('count',$count);
		$this->assign('page',$page);
		$this->display();
	}
	
	public function add(){
		if(IS_POST){
			$model= M('member_type');
			$model->create();
			$result = $model->add();
			$this->checkResult($result, U('index'));
		}else{
			$this->display();
		}
	}
	
	public function edit(){
		if(IS_POST){
			$model= M('member_type');
			$model->create();
			$result = $model->save();
			$this->checkResult($result, U('index?curr='.I('post.curr').''));
		}else{
			$list = M('member_type')->where(array('mt_id'=>I('get.id')))->find();
			$this->assign('list', $list);
			$this->assign('curr', I('get.curr'));
			$this->display();
		}
	}
	
	public function del(){
		$result = M('member_type')->save(array('mt_id'=>I('get.id'),'mt_del'=>1));
		$this->checkResult($result, U('index?curr='.I('get.curr').''));
	}
}