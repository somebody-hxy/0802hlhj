<?php
namespace Admin\Controller;
class LecturerController extends BaseController {
	
	public function index(){
		$model = M('lecturer');
		$where['l_del'] = 0;
		$count = $model->where($where)->count();
		$page = $this->getPage($count);
		$list = $model->where($where)->order('l_id asc')->limit($page['first'], $page['rows'])->select();
		$this->assign('list',$list);
		$this->assign('count',$count);
		$this->assign('page',$page);
		$this->display();
	}
	
	public function add(){
		if(IS_POST){
			$data['l_name'] = I('post.l_name');
			$data['l_pic'] = I('post.l_pic');
			$data['l_detail'] = htmlspecialchars_decode(I('post.l_detail'));
			$data['l_del'] = 0;
			dump($data);exit;
			$result = M('lecturer')->add($data);
			$this->checkResult($result, U('index'));
		}else{
			$this->display();
		}
	}
	
	public function edit(){
		if(IS_POST){
			$data['l_id'] = I('post.l_id');
			$data['l_name'] = I('post.l_name');
			$data['l_pic'] = I('post.l_pic');
			$data['l_detail'] = htmlspecialchars_decode(I('post.l_detail'));
			$data['l_del'] = 0;
			
			$result = M('lecturer')->save($data);
			$this->checkResult($result, U('index?curr='.I('post.curr').''));
		}else{
			$list = M('lecturer')->where(array('l_id'=>I('get.id')))->find();
			$this->assign('list', $list);
			$this->assign('curr', I('get.curr'));
			$this->display();
		}
	}
	
	public function del(){
		$result = M('lecturer')->save(array('l_id'=>I('get.id'),'l_del'=>1));
		$this->checkResult($result, U('index?curr='.I('get.curr').''));
	}
}