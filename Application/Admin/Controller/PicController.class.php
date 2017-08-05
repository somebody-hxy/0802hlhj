<?php
namespace Admin\Controller;
class PicController extends BaseController {
	
	public function index(){
		$model = M('pic');
		$where['p_del'] = 0;
		$count = $model->where($where)->count();
		$page = $this->getPage($count);
		$list = $model->where($where)->order('p_id asc')->limit($page['first'], $page['rows'])->select();
		$this->assign('list',$list);
		$this->assign('count',$count);
		$this->assign('page',$page);
		$this->display();
	}
	
	public function add(){
		if(IS_POST){
			$model=M('pic');
			$model->create();
			$data['p_name'] = I('post.p_name');
			$data['p_pic'] = I('post.p_pic');
			$data['p_detail'] = htmlspecialchars_decode(I('post.p_detail'));
			$data['p_del'] = 0;
			
			$result = $model->add($data);
			$this->checkResult($result, U('index'));
		}else{
			$this->display();
		}
	}
	
	public function edit(){
		if(IS_POST){
			$model=M('pic');
			$model->create();
			$data['p_id'] = I('post.p_id');
			$data['p_name'] = I('post.p_name');
			$data['p_pic'] = I('post.p_pic');
			$data['p_detail'] = htmlspecialchars_decode(I('post.p_detail'));
			$data['p_del'] = 0;
			
			$result = $model->save($data);
			$this->checkResult($result, U('index?curr='.I('post.curr').''));
		}else{
			$list = M('pic')->where(array('p_id'=>I('get.id')))->find();
			$this->assign('list', $list);
			$this->assign('curr', I('get.curr'));
			$this->display();
		}
	}
	
	public function del(){
		$result = M('pic')->save(array('p_id'=>I('get.id'),'p_del'=>1));
		$this->checkResult($result, U('index?curr='.I('get.curr').''));
	}
}