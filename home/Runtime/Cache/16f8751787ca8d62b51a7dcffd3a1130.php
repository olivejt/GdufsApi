<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--[if lt IE 7 ]><html lang="en" class="ie6 ielt7 ielt8 ielt9"><![endif]--><!--[if IE 7 ]><html lang="en" class="ie7 ielt8 ielt9"><![endif]--><!--[if IE 8 ]><html lang="en" class="ie8 ielt9"><![endif]--><!--[if IE 9 ]><html lang="en" class="ie9"> <![endif]--><!--[if (gt IE 9)|!(IE)]><!--> 
<html lang="en"><!--<![endif]--> 
	<head>
		<meta charset="utf-8">
		<title>Api申请记录</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="__CSS__/bootstrap.min.css" rel="stylesheet">
		<link href="__CSS__/bootstrap-responsive.min.css" rel="stylesheet">
		<link href="__CSS__/site.css" rel="stylesheet">
		<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	</head>
	<body>
		<div class="container">
			
			<div class="row">
				
				<div class="span9">
					<h1>
						记录
					</h1>
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>
									appId
								</th>
								<th>
									appKey
								</th>
								<th>
									applytime
								</th>
								<th>
									appStatus
								</th>
								<th>
									appManage
								</th>
							</tr>
						</thead>
						<tbody>
							 <?php if(is_array($record)): $i = 0; $__LIST__ = $record;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$record): $mod = ($i % 2 );++$i;?><tr>
								<td>
									<?php echo ($record["appid"]); ?>
								</td>
								<td>
									<?php echo ($record["appkey"]); ?>
								</td>
								<th>
									<?php echo ($record["applytime"]); ?>
								</th>
								<td>
									<?php echo ($record["status"]); ?>
								</td>
								<td>
									<a href="__URL__/examine/id/<?php echo ($record["id"]); ?>" style="color: #108ac6">审核</a> | 
									<a href="__URL__/delete/id/<?php echo ($record["id"]); ?>" style="color: #108ac6">删除</a>
								</td>
							</tr><?php endforeach; endif; else: echo "" ;endif; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>