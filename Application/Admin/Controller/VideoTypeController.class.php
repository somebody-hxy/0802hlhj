<?php
namespace Admin\Controller;
class VideoTypeController extends BaseController {
	
	public function index(){
		$model = M('video_type');
		$where['vt_del'] = 0;
		$count = $model->where($where)->count();
		$page = $this->getPage($count);
		$list = $model->where($where)->order('vt_id asc')->limit($page['first'], $page['rows'])->select();
		$this->assign('list',$list);
		$this->assign('count',$count);
		$this->assign('page',$page);
		$this->display();
	}
	
	public function add(){
		if(IS_POST){
			$model = M('video_type');
			$model->create();
			
			$result = $model->add();
			$this->checkResult($result, U('index'));
		}else{
			$this->display();
		}
	}
	
	public function edit(){
		if(IS_POST){
			$model = M('video_type');
			$model->create();
			
			$result = $model->save();
			$this->checkResult($result, U('index?curr='.I('post.curr').''));
		}else{
			$list = M('video_type')->where(array('vt_id'=>I('get.id')))->find();
			$this->assign('list', $list);
			$this->assign('curr', I('get.curr'));
			$this->display();
		}
	}
	
	public function del(){
		$result = M('video_type')->save(array('vt_id'=>I('get.id'),'vt_del'=>1));
		$this->checkResult($result, U('index?curr='.I('get.curr').''));
	}
}