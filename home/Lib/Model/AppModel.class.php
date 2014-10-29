<?php
class AppModel extends Model
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function addApp($appId){
		$condition['appid'] = $appId;
		$query = $this->where($condition)->find();
		if($query){
			return 'Id已被注册';
		}
		$time = time();
		$appKey = md5($appId.$time); //用接收的appId和时间戳 生成appKey
		
		$datas['appid'] = $appId;
		$datas['appkey'] = $appKey;
		$datas['applytime'] = date('Y-m-d H:i:s',$time);
		$res = $this->add($datas);
		if($res) return $appKey;
	}

	public function appCheck($appId,$appKey){
		$flag = -1;
		$condition = array('appid'=>$appId,'appkey'=>$appKey);
		$query = $this->where($condition)->find();
		//var_dump($query['status']);
		$result = $query['status'];
		if($query){
			if($result==0){
				$flag = 0;	//应用密钥审核中
			}else{
				$flag = 1;	//密钥正常使用
			}
		}
		return $flag;	
	}
}
?>