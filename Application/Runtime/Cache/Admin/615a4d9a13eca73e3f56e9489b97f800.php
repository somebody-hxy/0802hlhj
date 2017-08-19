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
		    <li>办理会员</li>
	    </ul>
   </div>
    <div class="formbody">
    	<div class="formtitle"><span>办理会员</span></div>
	    <form action="<?php echo U('edit');?>" method="post" class="layui-form">
	    	<input type="hidden" name="curr" value="<?php echo ($curr); ?>">
	    	<input type="hidden" name="m_id" value="<?php echo ($list["m_id"]); ?>">
			<div class="layui-form-item">
				<div class="layui-inline">
					<label class="layui-form-label">微信昵称</label>
					<div class="layui-input-inline"><input type="text" value="<?php echo ($list["m_nickname"]); ?>" readonly="readonly" class="layui-input"></div>
				</div>
			</div>
			<div class="layui-form-item">
				<div class="layui-inline">
					<label class="layui-form-label">真实姓名</label>
					<div class="layui-input-inline"><input type="text" value="<?php echo ($list["m_truename"]); ?>" readonly="readonly" class="layui-input"></div>
				</div>
			</div>
			<div class="layui-form-item">
				<div class="layui-inline">
					<label class="layui-form-label">手机号</label>
					<div class="layui-input-inline"><input type="text" value="<?php echo ($list["m_phone"]); ?>" readonly="readonly" class="layui-input"></div>
				</div>
			</div>
			<div class="layui-form-item">
				<div class="layui-inline">
					<label class="layui-form-label">会员类型</label>
					<div class="layui-input-inline">
						<select name="m_type_id" lay-filter="type">
							<?php if(is_array($type)): foreach($type as $key=>$v): ?><option value="<?php echo ($v["mt_id"]); ?>"><?php echo ($v["mt_name"]); ?></option><?php endforeach; endif; ?>
						</select>
					</div>
				</div>
			</div>
			<div class="layui-form-item">
				<div class="layui-inline">
					<label class="layui-form-label">会员天数</label>
					<div class="layui-input-inline"><input id="day" name="day" type="text" value="<?php echo ($type[0]['mt_day']); ?>" class="layui-input"></div>
					<div id="video" class="layui-form-mid layui-word-aux">天</div>
				</div>
			</div>
			<div class="layui-form-item">
	            <div class="layui-input-block">
	                <button class="layui-btn layui-btn-small layui-btn-normal" lay-submit  lay-filter="sub">办理会员</button>
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
	var typeJson = <?php echo ($json); ?>;
	form.on('select(type)', function(data){
		$.each(typeJson,function(k,v){
			if(v.mt_id==data.value){
				$("#day").val(v.mt_day);
			}
		});
		
		
		
		
		
//		console.log(data.elem); //得到select原始DOM对象
//		console.log(data.value); //得到被选中的值
//		console.log(data.othis); //得到美化后的DOM对象
	});
	
	
});
</script>