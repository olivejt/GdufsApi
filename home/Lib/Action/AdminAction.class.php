<?php

class AdminAction extends Action {
	
	private $Admin;
	private $App;
	
	public function __construct() {
		parent::__construct();
		$this->Admin = D('admin');
		$this->App = D('app');
	}
	
	public function index(){
		$this->login();
	}
	
	public function login(){
		if($_POST['status']==1) {
			$field['admin'] = 'admin';//$_POST['username'];
			$field['password'] = 'zhimakaimen';//$_POST['password'];
			$field['status'] = 1;
			if ($this->Admin->where($field)->find()) {
				session('apiadmin',$field['admin']);
				$this->redirect('Admin/record');
			} else {
				echo '账号或密码错误';
			}
		} else {
			$this->display('adminlogin');
		}
	}
	
	public function record(){
		if(!session('apiadmin')){
			$this->redirect('Admin/login');
		}else{
			$data = $this->App->select();
			$this->assign('record',$data);
			$this->display('adminrecord',$data);
		}
	}
	
	public function examine(){
		if(!session('apiadmin')){
			$this->redirect('Admin/login');
		}else{
			$condition['id'] = $_GET['id'];
			$field['status'] = 1;
			$this->App->where($condition)->save($field);
			$this->redirect('Admin/record');
		}
	}
	
	public function delete(){
		if(!session('apiadmin')){
			$this->redirect('Admin/login');
		}else{
			$condition['id'] = $_GET['id'];
			$this->App->where($condition)->delete();
			$this->redirect('Admin/record');
		}
	}
}