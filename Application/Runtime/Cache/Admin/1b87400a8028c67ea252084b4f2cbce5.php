<?php if (!defined('THINK_PATH')) exit();?>﻿<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="/Public/admin/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body style="background:#f0f9fd;">
    <div class="lefttop"><span></span>后台管理</div>
    <dl class="leftmenu">
        <dd>
            <div class="title"><span><img src="/Public/admin/images/leftico01.png" /></span>系统管理</div>
            <ul class="menuson">
                <li class="active"><cite></cite><a href="<?php echo U('AdminUser/index');?>" target="rightFrame">管理员列表</a><i></i></li>
            </ul>    
        </dd>
        <dd>
            <div class="title"><span><img src="/Public/admin/images/leftico01.png" /></span>会员管理</div>
            <ul class="menuson">
            	<li><cite></cite><a href="<?php echo U('About/index');?>" target="rightFrame">设置简介</a><i></i></li>
                <li><cite></cite><a href="<?php echo U('MemberType/index');?>" target="rightFrame">会员分类</a><i></i></li>
                <li><cite></cite><a href="<?php echo U('Member/index');?>" target="rightFrame">会员列表</a><i></i></li>
            </ul>    
        </dd>
        <dd>
            <div class="title"><span><img src="/Public/admin/images/leftico01.png" /></span>视频管理</div>
            <ul class="menuson">
            	<li><cite></cite><a href="<?php echo U('Lecturer/index');?>" target="rightFrame">产品列表</a><i></i></li>
            	<li><cite></cite><a href="<?php echo U('Category/index');?>" target="rightFrame">产品分类</a><i></i></li>
                <li><cite></cite><a href="<?php echo U('VideoType/index');?>" target="rightFrame">视频分类</a><i></i></li>
                <li><cite></cite><a href="<?php echo U('Video/index');?>" target="rightFrame">视频列表</a><i></i></li>
                <li><cite></cite><a href="<?php echo U('Pic/index');?>" target="rightFrame">图片展示</a><i></i></li>
            </ul>
        </dd>
    </dl>
</body>
</html>
<script src="/Public/admin/js/jquery.min.js" language="JavaScript" ></script>
<script type="text/javascript">
$(function(){	
    $(".menuson li").click(function(){
        $(".menuson li.active").removeClass("active")
        $(this).addClass("active");
    });
    $('.title').click(function(){
        var $ul = $(this).next('ul');
        $('dd').find('ul').slideUp();
        if($ul.is(':visible')){
            $(this).next('ul').slideUp();
        }else{
            $(this).next('ul').slideDown();
        }
    });
})	
</script>