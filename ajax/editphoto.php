<?
session_start();
require_once ("/home/n/nskdietru/public_html/app/classes/User.php");
require_once ("/home/n/nskdietru/public_html/app/classes/Main_classes.php");
require_once ("/home/n/nskdietru/public_html/app/core/dbo.php");
	if($_POST && $_POST['id'] != "" && $_SESSION['user']['permissions'] < 3){
		
		$where = array('id' => $_POST['id']);
		$table = "files"; 
		
		if(Element::Delete($where, $table)){
			return true;
		} else {
			return false;
		}
	}

?>