<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="/Public/admin/css/style.css" rel="stylesheet" type="text/css" />
	<link href="/Public/layui/css/layui.css" rel="stylesheet" type="text/css" />
	<script src="/Public/admin/js/jquery.min.js" language="JavaScript" ></script>
	<script src="/Public/layui/layui.js" language="JavaScript" ></script>
	<script type="text/javascript" charset="utf-8" src="/Public/ueditor/ueditor.config.js"></script>
	<script type="text/javascript" charset="utf-8" src="/Public/ueditor/ueditor.all.min.js"> </script>
	<script type="text/javascript" charset="utf-8" src="/Public/ueditor/lang/zh-cn/zh-cn.js"></script>
</head>

<body>
	<div class="place">
	    <span>位置：</span>
	    <ul class="placeul">
		    <li>会员管理</li>
		    <li>会员分类</li>
		    <li>修改分类</li>
	    </ul>
   </div>
    <div class="formbody">
    	<div class="formtitle"><span>修改分类</span></div>
	    <form action="<?php echo U('edit');?>" method="post" class="layui-form">
	    	<input type="hidden" name="curr" value="<?php echo ($curr); ?>">
	    	<input type="hidden" name="mt_id" value="<?php echo ($list["mt_id"]); ?>">
			<div class="layui-form-item">
				<div class="layui-inline">
					<label class="layui-form-label">分类名称</label>
					<div class="layui-input-inline"><input type="text" name="mt_name" value="<?php echo ($list["mt_name"]); ?>" lay-verify="required" class="layui-input"></div>
				</div>
			</div>
			<div class="layui-form-item">
				<div class="layui-inline">
					<label class="layui-form-label">天数</label>
					<div class="layui-input-inline"><input type="text" name="mt_day" value="<?php echo ($list["mt_day"]); ?>" lay-verify="number" class="layui-input"></div>
				</div>
			</div>
			<div class="layui-form-item">
	            <div class="layui-input-block">
	                <button class="layui-btn layui-btn-small layui-btn-normal" lay-submit  lay-filter="sub">确认保存</button>
	                <button class="layui-btn layui-btn-small layui-btn-primary" onclick="history.go(-1)">返回操作</button>
	            </div>
        	</div>
	    </form>
    </div>
</body>
</html>
<script>
layui.use('form', function(){
	var form = layui.form();
});
</script>