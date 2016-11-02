<?
session_start();
$cur = "N";
if($_POST && $_POST['id'] != ""){
	if($_SESSION['user']['busket'] && count($_SESSION['user']['busket']) > 0){
		foreach($_SESSION['user']['busket'] as $key => $val){
			if($val['id'] == $_POST['id']) {
				$_SESSION['user']['busket'][$key]['count'] = $_SESSION['user']['busket'][$key]['count'] + $_POST['count'];
				$cur = "Y";
			} else {
				//$_SESSION['user']['busket'][] = $_POST;
			}
		}
		if($cur == "N"){
			$_SESSION['user']['busket'][] = $_POST;
		}	
	} else { 
		if($cur == "N"){
			$_SESSION['user']['busket'][] = $_POST;
		}
	}
	if($_SESSION['user']['summ'] == 0 || !$_SESSION['user']['summ'] || empty($_SESSION['user']['summ'])){
		$_SESSION['user']['summ'] = 0;
	}
	$_SESSION['user']['summ'] = $_SESSION['user']['summ'] + ($_POST['price'] * $_POST['count']);
	
	unset($_POST);
	//unset($_SESSION['user']['busket']);
	//unset($_SESSION['user']['summ']);
	echo $_SESSION['user']['summ'];
	
}
?>