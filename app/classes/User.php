<?
class User 
{
	static function login($user){
			foreach($user as $key => $val){
				$_SESSION['user'][$key] = $val;
				$_SESSION['user']['sess_id'] = md5($user['login'] ."proto". $user['id'] ."box");
			}
		$params = array("id" => $_SESSION['user']['id']);
		$upd_array = array("sess_id" => $_SESSION['user']['sess_id']);
		DBConnect::init()->upd_user($params, $upd_array);
	}
	
	static function check(){
		if(!isset($_SESSION['user']['sess_id'])) {
			$_SESSION['user']['id'] = 'guest';
			$_SESSION['user']['permissions'] = '11';
		}
	}
	
	static function permission($permission){
		if($_SESSION['user']['permissions'] > $permission){
			header("Location: /");
		}
	} 
	
	static function logout(){
		$params = array("id" => $_SESSION['user']['id']);
		$upd_array = array("sess_id" => "offline");
		DBConnect::init()->upd_user($params, $upd_array);
		session_destroy();
	}
	
}
?>