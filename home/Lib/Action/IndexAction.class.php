<?php

class IndexAction extends Action {
	
	private $App;
	private $Api; 
	private $Gwtxz;
	private $User;
	
	public function __construct() {
        parent::__construct();
        $this->Api = new GdufsApi();
        $this->App = new AppModel();
        $this->Gwtxz = new Gwtxz();
        $this->User = new UserModel;
	}
	
    public function index(){
    	$requestType = $_POST['type'];
    	
    	switch ($requestType){
    		case "applyKey": $this->applyKey(); break;
    		case "login"   : $this->login(); break;
    		case "getUserData" : $this->getUserData(); break;
    		default : echo json_encode('unavailable request'); break;
    	}
    }
    
    function applyKey(){
    	$model = $this->App;
    	if($_POST['status']==1) {
    		$appId = $_POST['appId'];
    		if($appId){
    			$result = $model->addApp($appId);	//申请密钥时 status默认为0  需要管理员审核
    		}else{
    			$result = '请输入Appid';
    		}
    		echo $result;
    	} else {
    		$this->display('applykey');
    	}
    }
    
    /**
     * 校验项目注册的id和密钥
     * 若成功 可进行学号密码登录
     * 返回登录信息、学生信息 & 一个用于进一步查询的token
     */
    function login(){
    	$gwtxz = $this->Gwtxz;
    	$request = $this->Api;
    	$model = $this->App;
    	$user = $this->User;
    	
    	$appId =  $_POST['appId'];
    	$appKey = $_POST['appKey'];
    	$flag = $model->appCheck($appId,$appKey);
    	if($flag==1){
    		//生成一个包含appid appkey 时间戳的token 并加密
    		$code = time().$appKey;
    		$token = $request->_authcode($code,'ENCODE',APIKEY);//UCenter的加密方法
    
    		if($token){
    			$field = array(
    					'username'=>$_POST['username'],
    					'password'=>$_POST['password'],
    					'login-form-type'=> 'pwd', //$_POST['login-form-type']
    			);
    			$isLogin = $gwtxz->checkField($field);
    			$userData = $gwtxz->getUser();
    			$userData = $userData == null ? array() : $userData;
    			if ($userData){
    				$user->addUser($userData);
    			}
    			$array = array(
    					'token' => $token,
    					'userData' => $userData,
    					'isLogin' => $isLogin,
    			);
     			$res = json_encode($array);
     			echo $res;
    			//$this->ajaxReturn($array, 'success', 1);
    		}
    	}else if($flag==0){
    		$error = 'appKey is being examining';
    		$this->ajaxReturn(array(), $error, 0);
    	}else{
    		$error = 'wrong appKey';
    		$this->ajaxReturn(array(), $error, -1);
    	}
    }
    
    /**
     *
     * 接收token & 学号 & 密码
     * 在token有效期内扩展查询
     *
     */
    function getUserData(){
    	$gwtxz = $this->Gwtxz;
    	$request = $this->Api;
    	$user = $this->User;
    	
    	$token = $_POST['token'];
    	if(!$request->timeoutCheck($token)){ //优先从本地数据库拿信息
    		$field['studentNumber'] = $_POST['username']; 		
    		$userData = $user->getUser($field);
    		echo json_encode($userData);
    	}else {
    		$error = 'Token timeout!Please login again.';
    		echo json_encode($error);
    	}
    }
}