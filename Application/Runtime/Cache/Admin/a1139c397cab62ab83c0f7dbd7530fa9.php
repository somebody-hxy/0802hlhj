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

<body >
	<div class="place">
    	<span>位置：</span>
	    <ul class="placeul">
		    <li>视频管理</li>
		    <li>视频列表</li>
	    </ul>
    </div>
    
    <div class="rightinfo">
	    <div class="tools">
	    	<ul class="toolbar">
	        	<a href="<?php echo U('add');?>"><li class="click"><span><img src="/Public/admin/images/t01.png" /></span>添加</li></a>
	       </ul>
	    </div>
	    <table class="tablelist">
	    	<thead>
		    	<tr>
		        <th>编号</th>
		        <th>视频分类</th>
		        <th>讲师名称</th>
		        <th>视频名称</th>
		        <th>观看次数</th>
		        <th>添加时间</th>
		        <th>操作</th>
		        </tr>
	        </thead>
	        <tbody>
	        	<?php if(is_array($list)): foreach($list as $key=>$v): ?><tr>
			        <td><?php echo ($v["v_id"]); ?></td>
			        <td><?php echo ($v["vt_name"]); ?></td>
			        <td><?php echo ($v["l_name"]); ?></td>
			        <td><?php echo ($v["v_title"]); ?></td>
			        <td><?php echo ($v["v_views"]); ?></td>
			        <td><?php echo (date("Y-m-d",$v["v_addtime"])); ?></td>
			        <td>
			        	<a href="<?php echo U('edit?id='.$v['v_id'].'&curr='.$page['curr'].'');?>" class="tablelink1">修改</a>     
			        	<a class="tablelink2 del">删除</a>
			        </td>
		        </tr><?php endforeach; endif; ?>
	        </tbody>
	    </table>
	    <div class="pagin">
	    	<div class="message">共<i class="blue">&nbsp;<?php echo ($count); ?>&nbsp;</i>条记录，当前显示第&nbsp;<i class="blue"><?php echo ($page["curr"]); ?>&nbsp;</i>页</div>
	        <div id="page"></div>
	    </div>
    </div>
</body>
</html>
<script>
$('.tablelist tbody tr:odd').addClass('odd');
layui.use(['laypage', 'layer'], function(){
	//分页
	var laypage = layui.laypage;
  	laypage({
        cont:'page', skin:'#1E9FFF',
        first:false, last:false,
        pages:<?php echo ($page["pages"]); ?>, groups:<?php echo ($page["groups"]); ?>, curr:<?php echo ($page["curr"]); ?>,
        jump:function(obj, first){
            if(!first){
            	location.href = "<?php echo U('index');?>?curr="+obj.curr;
            }
        }
    });
    //删除
    $(".del").click(function(){
		var id = $(this).parent().parent().find('td').eq(0).text();
		var curr = <?php echo ($page["curr"]); ?>;
		layer.confirm("是否确认删除", function(){
			location.href = "<?php echo U('del');?>".replace(".html", "?id="+id+"&curr="+curr);
		});
	});
});
</script>