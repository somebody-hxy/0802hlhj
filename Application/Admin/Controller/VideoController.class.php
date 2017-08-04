<?php
namespace Admin\Controller;
class VideoController extends BaseController {
	
	public function index(){
		$model = M('video');
		$where['v_del'] = 0;
		$count = $model->where($where)->count();
		$page = $this->getPage($count);
		$list = $model
		->join('longhai_video_type on longhai_video.v_type_id = longhai_video_type.vt_id','left')
		->join('longhai_lecturer on longhai_video.v_lecturer_id = longhai_lecturer.l_id','left')
		->where($where)->order('v_id asc')->limit($page['first'], $page['rows'])->select();
		$this->assign('list',$list);
		$this->assign('count',$count);
		$this->assign('page',$page);
		$this->display();
	}
	
	public function add(){
		if(IS_POST){
			$data['v_type_id'] = I('post.v_type_id');
			$data['v_lecturer_id'] = I('post.v_lecturer_id');
			$data['v_title'] = I('post.v_title');
			$data['v_pic'] = I('post.v_pic');
			$data['v_video'] = I('post.v_video');
			$data['v_views'] = 0;
			$data['v_addtime'] = time();
			$data['v_del'] = 0;
			
			$result = M('video')->add($data);
			$this->checkResult($result, U('index'));
		}else{
			$type = M('video_type')->where(array('vt_del'=>0))->order('vt_id asc')->select();
			$this->assign('type',$type);
			$lecturer = M('lecturer')->where(array('l_del'=>0))->order('l_id asc')->select();
			$this->assign('lecturer',$lecturer);
			$this->display();
		}
	}
	
	public function edit(){
		if(IS_POST){
			$data['v_id'] = I('post.v_id');
			$data['v_type_id'] = I('post.v_type_id');
			$data['v_lecturer_id'] = I('post.v_lecturer_id');
			$data['v_title'] = I('post.v_title');
			$data['v_pic'] = I('post.v_pic');
			$data['v_video'] = I('post.v_video');
			
			$result = M('video')->save($data);
			$this->checkResult($result, U('index?curr='.I('post.curr').''));
		}else{
			$type = M('video_type')->where(array('vt_del'=>0))->order('vt_id asc')->select();
			$this->assign('type',$type);
			$lecturer = M('lecturer')->where(array('l_del'=>0))->order('l_id asc')->select();
			$this->assign('lecturer',$lecturer);
			$list = M('video')->where(array('v_id'=>I('get.id')))->find();
			$this->assign('list', $list);
			$this->assign('curr', I('get.curr'));
			$this->display();
		}
	}
	
	public function del(){
		$result = M('video')->save(array('v_id'=>I('get.id'),'v_del'=>1));
		$this->checkResult($result, U('index?curr='.I('get.curr').''));
	}
	
	public function uploadVideo(){
		$upload = new \Think\Upload();											
		$upload->maxSize = 1024*1024*100 ;										
		$upload->exts = array('mp4');						
		$upload->rootPath = './Uploads/'; 									
		$upload->savePath = '/video/';
		$info = $upload->uploadOne($_FILES['upload_video']);
		if($info){
			$res['result_code'] = 100;
			$res['file'] = '/Uploads'.$info['savepath'].$info['savename'];
		}else{
			$res['result_code'] = 101;
			$res['error'] = $upload->getError();
		}
		$this->ajaxReturn($res);
	}
}