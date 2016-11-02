<?
session_start();
if($_POST){
	
	$_SESSION['user']['summ'] = 0;
	foreach($_SESSION['user']['busket'] as $key => $val){
		if($key == $_POST['id']){
			$_SESSION['user']['busket'][$key]['count'] = $_POST['count'];
			$_SESSION['user']['summ'] = $_SESSION['user']['summ'] + ($val['price'] * $_POST['count']);
		} else {
			$_SESSION['user']['summ'] = $_SESSION['user']['summ'] + ($val['count'] * $val['price']);
		}
		
	}
	echo $_SESSION['user']['summ'] ." руб.";
}
?>