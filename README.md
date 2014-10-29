GdufsApi
========

An api for website login in gdufs by quantacenter  
Using Thinkphp

模拟登录数字广外的接口，用于quanta项目的（免注册）登录
使用前应先获取GdufsSdk.class.php文件 加入到相应项目中 并申请项目密钥
@author olivejt 
@date 2014-10-29

#项目架构 需要说明的则展开
|—— index.php 入口文件
|—— home 项目文件夹
  |—— Common
  |—— Conf
  |—— Lang
  |—— Lib
    |—— Action
      |—— AdminAction.class.php 后台管理API用户
      |—— IndexAction.class.php 接受SdkCurl请求
    |—— Behavior
    |—— Model
      |—— AdminModel.class.php  管理员模板
      |—— AppModel.class.php    应用管理模板
      |—— UserModel.class.php   学生信息模板
    |—— ORG
      |—— GdufsApi.class.php  应用密钥类
      |—— Gwtxz.class.php     数字广外模拟登录类 by yinchuandong
    |—— Widget
  |—— Runtime
  |—— Tpl
|—— public 
  |—— css
  |—— img
  |—— js
