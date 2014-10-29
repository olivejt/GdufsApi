<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--[if lt IE 7 ]><html lang="en" class="ie6 ielt7 ielt8 ielt9"><![endif]--><!--[if IE 7 ]><html lang="en" class="ie7 ielt8 ielt9"><![endif]--><!--[if IE 8 ]><html lang="en" class="ie8 ielt9"><![endif]--><!--[if IE 9 ]><html lang="en" class="ie9"> <![endif]--><!--[if (gt IE 9)|!(IE)]><!--> 
<html lang="en"><!--<![endif]--> 
  <head>
    <meta charset="utf-8">
    <title>Api后台管理</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="__CSS__/bootstrap.min.css" rel="stylesheet">
    <link href="__CSS__/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="__CSS__/site.css" rel="stylesheet">
    <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
  </head>
  <body>
    <div id="login-page" class="container">
      <h1>Api后台登录</h1>
      <form id="login-form" class="well" action="Admin/login" method="post">
      <input type="text" class="span3" placeholder="账号" name="user_name" /><br />
      <input type="password" class="span3" placeholder="密码" name="password"/><br />
      <input type="hidden" value="1" name="status" />
      <button type="submit" class="btn btn-primary" id="sub">确定</button>
      </form>
    </div>
    <script src="__JS__/jquery.min.js"></script>
    <script src="__JS__/bootstrap.min.js"></script>
    <script src="__JS__/site.js"></script>
  </body>
</html>