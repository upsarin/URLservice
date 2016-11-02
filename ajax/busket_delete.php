<?
session_start();
if($_POST){
	$_SESSION['user']['summ'] = 0;
	unset($_SESSION['user']['busket'][$_POST['id']]);
	foreach($_SESSION['user']['busket'] as $key => $val){
		$_SESSION['user']['summ'] = $_SESSION['user']['summ'] + ($val['count'] * $val['price']);
	}
	echo $_SESSION['user']['summ'] ." руб.";
}
?>