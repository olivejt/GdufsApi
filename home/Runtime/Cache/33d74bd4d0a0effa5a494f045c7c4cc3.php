<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--[if lt IE 7 ]><html lang="en" class="ie6 ielt7 ielt8 ielt9"><![endif]--><!--[if IE 7 ]><html lang="en" class="ie7 ielt8 ielt9"><![endif]--><!--[if IE 8 ]><html lang="en" class="ie8 ielt9"><![endif]--><!--[if IE 9 ]><html lang="en" class="ie9"> <![endif]--><!--[if (gt IE 9)|!(IE)]><!--> 
<html lang="en"><!--<![endif]--> 
  <head>
    <meta charset="utf-8">
    <title>Appkey申请</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="__CSS__/bootstrap.min.css" rel="stylesheet">
    <link href="__CSS__/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="__CSS__/site.css" rel="stylesheet">
    <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
  </head>
  <body>
    <div id="login-page" class="container">
      <h1>Appkey申请</h1>
      <form id="login-form" class="well" action="" method="post">
      <input type="text" class="span3" placeholder="应用ID" name="appId" id="appid"/><br />
      <input type="text" class="span3" placeholder="请记录此处显示的APPKEY" id="appkey" readonly="readonly"/><br />
      <input type="hidden" value="1" name="status" />
      <input type="hidden" value="applyKey" name="type" />
      <button type="submit" class="btn btn-primary" id="apply">申请</button>
      <button type="button" class="btn btn-primary" id="copy">复制APPKEY</button>
      </form>
    </div>
    <script src="__JS__/jquery.min.js"></script>
    <script src="__JS__/bootstrap.min.js"></script>
    <script src="__JS__/site.js"></script>
    <script type="text/javascript">
    	$(document).ready(function(){
    		var $apply = $('#apply');
    		var $copy = $('#copy');
    		var $appkey = $('#appkey');
    		var $appid = $('#appid');
    		var $form = $('#login-form');
    		
    		$form.submit(function(){
    			if($appid.val()!=''){
    				$.post("Index/appkey",$(this).serialize(),function(data){
    					$appkey.val(data).attr('readonly',false);
    				});
    			}
    			return false;
    		});
    		$copy.click(function(){
    			$appkey.val();
    		});
    	});
    </script>
  </body>
</html>