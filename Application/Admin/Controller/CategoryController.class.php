<?php
namespace Admin\Controller;
class CategoryController extends BaseController {
	
	public function index(){
		$model = M('category');
		$where['c_del'] = 0;
		$count = $model->where($where)->count();
		$page = $this->getPage($count);
		$list = $model->where($where)->order('c_id asc')->limit($page['first'], $page['rows'])->select();
		$this->assign('list',$list);
		$this->assign('count',$count);
		$this->assign('page',$page);
		$this->display();
	}
	
	public function add(){
        if(IS_POST){
            $model=M('category');
            $model->create();
            $data['c_name'] = I('post.c_name');
            $data['c_pic'] = I('post.c_pic');
            $data['c_del'] = 0;
            //dump($data);exit;
            $result = $model->add($data);
            $this->checkResult($result, U('index'));
//            $model = M('video_type');
//            $result = $model->add();
        }else{
            $this->display();
        }
	}
	
	public function edit(){
        if(IS_POST){
            $model = M('category');
            $model->create();
            $data['c_id'] = I('post.c_id');
            $data['c_name'] = I('post.c_name');
            $data['c_pic'] = I('post.c_pic');
            $data['c_del'] = 0;

            $result =$model ->save($data);
            $this->checkResult($result, U('index?curr='.I('post.curr').''));
        }else{
            $list = M('category')->where(array('c_id'=>I('get.id')))->find();
            $this->assign('list', $list);
            $this->assign('curr', I('get.curr'));
            $this->display();
        }
	}
	
	public function del(){
		$result = M('category')->save(array('c_id'=>I('get.id'),'c_del'=>1));
		$this->checkResult($result, U('index?curr='.I('get.curr').''));
	}
}