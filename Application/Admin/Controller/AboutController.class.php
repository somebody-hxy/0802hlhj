<?php
namespace Admin\Controller;
class AboutController extends BaseController {
	
	public function index(){
		if(IS_POST){
			$data['a_id'] = I('post.a_id');
			$data['a_title'] = I('post.a_title');
			$data['a_detail'] = htmlspecialchars_decode(I('post.a_detail'));
			$result = M('about')->save($data);
			$this->checkResult($result, U('index'));
		}else{
			$list = M('about')->where(array('a_id'=>1))->find();
			$this->assign('list',$list);
			$this->display();
		}

	}
	
	
}