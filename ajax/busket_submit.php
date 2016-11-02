<?
	
session_start();
require_once ("/home/n/nskdietru/public_html/app/classes/User.php");
require_once ("/home/n/nskdietru/public_html/app/classes/Main_classes.php");
require_once ("/home/n/nskdietru/public_html/app/core/dbo.php");

if($_POST){
	/* получатели */
$to= "academbio@mail.ru" . ", " ; //обратите внимание на запятую
$to .= "academbio@yandex.ru";

/* тема/subject */
$subject = "Заказ с сайта nsk-diet.ru";

/* сообщение */
$message = '
<html>
<head>
 <title>Новый заказ с сайта nsk-diet.ru</title>

</head>
<body>
<p>Адрес: '. $_POST["user_adress"] .'</p>
<p>Имя: '. $_POST["user_name"] .'</p>
<p>Телефон: '. $_POST["user_phone"] .'</p>
<p>Сумма заказа: '. $_SESSION['user']['summ'] .' руб.</p>
<table>
 <tr>
	<th style="padding-right: 20px;">Название</th>
	<th style="padding-right: 20px;">кол-во</th>
	<th>цена</th>
 </tr>
 ';

 foreach($_SESSION['user']['busket'] as $key => $val){ 
 $element = Element::GetByID($val['id'], $return=null, "content");
 $message .= '
 <tr style="border-bottom: 1px solid black">
	<td style="padding-right: 20px;  max-width: 360px;">'. $element['name'] .'</td>
	<td style="padding-right: 20px;">'. $val['count'] .'</td>
	<td>'. $val['price'] .'</td>
 </tr>
 ';
 }
  $message .= '
</table>
</body>
</html>
';

/* Для отправки HTML-почты вы можете установить шапку Content-type. */
$headers= "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=utf-8\r\n";

/* дополнительные шапки */
$headers .= "From: academbio@mail.ru\r\n";
//$headers .= "Cc: birthdayarchive@example.com\r\n";
//$headers .= "Bcc: birthdaycheck@example.com\r\n";

/* и теперь отправим из */
mail($to, $subject, $message, $headers);

	$array = array();
	$array[0]['main']['desc'] = "";
	foreach($_SESSION['user']['busket'] as $key => $val){ 
		$element = Element::GetByID($val['id'], $return=null, "content");
		$array[0]['main']['desc'] .= "<br />". $element['name'] ." x ". $val['count'] ." = ". ($val['price']*$val['count']);
	}
	$array[0]['main']['adress'] = $_POST["user_adress"];
	$array[0]['main']['phone'] = $_POST["user_phone"];
	$array[0]['main']['user_name'] = $_POST["user_name"];
	$array[0]['main']['summ'] = $_SESSION['user']['summ'];
	$array[0]['main']['name'] = $_POST["user_phone"] ."-". $_POST["user_name"];
	
	
	
	 Element::SaveElements($array, "buys");
	
unset($_SESSION['user']['busket']);
unset($_SESSION['user']['summ']);
unset($_POST);
echo "Ваш заказ отправлен, мы свяжемся с вами в ближайшее время, спасибо.";
}
?>