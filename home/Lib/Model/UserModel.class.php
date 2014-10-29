<?php
class UserModel extends Model
{
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function addUser($datas){
		$condition['studentNumber'] = $datas['studentNumber'];
		$query = $this->where($condition)->find();
		if($query){
			return 'data existed';
		}else{
			$datas['recordtime'] = date('Y-m-d H:i:s',time());
			$res = $this->add($datas);
			if($res) return 'added';
		}
	}
	
	public function getUser($field){
		$query = $this->where($field)->find();
		return $query;
	}
}