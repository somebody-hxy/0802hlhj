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
		    <li>视频管理</li>
		    <li>视频分类</li>
		    <li>新增分类</li>
	    </ul>
   </div>
    <div class="formbody">
    	<div class="formtitle"><span>新增分类</span></div>
	    <form action="<?php echo U('add');?>" method="post" class="layui-form">
	    	<!--<input type="hidden" id="vt_pic" name="vt_pic" />-->
			<div class="layui-form-item">
				<div class="layui-inline">
					<label class="layui-form-label">分类名称</label>
					<div class="layui-input-inline"><input type="text" name="vt_name" lay-verify="required" class="layui-input"></div>
				</div>
			</div>
			<!--<div class="layui-form-item">
				<div class="layui-inline">
					<label class="layui-form-label">上传图片</label>
		            <div class="layui-input-inline"><input type="file" name="upload_pic" class="layui-upload-file"></div>
				</div>
			</div>
		    <div class="layui-form-item">
		    	<div class="layui-inline">
		            <label class="layui-form-label"></label>
		            <div class="layui-input-inline"><img id="pic" src="" style="max-width: 320px;max-height: 200px;" /></div>
		        </div>
		    </div>-->
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
layui.use(['form','upload'], function(){
	//上传图片
//  layui.upload({
//      url: "<?php echo U('Base/upload');?>" ,success: function(res){
//          if(res.result_code==100){
//              $("#vt_pic").val(res.file);
//              $("#pic").attr("src", res.file);
//          }
//      }
//  });
    
    var form = layui.form();
	form.on('submit(sub)', function(data){
        
	});
});
</script>