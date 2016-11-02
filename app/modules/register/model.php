<?php

class RegModel
{

	// метод выборки данных
	public function get_data($array)
	{
		$params = array("type" => "register", "active" => "Y");
		$sort = array("sort", "asc");
		$array = DBConnect::init()->getFeilds($params, $sort);
		return $array;
	}
	
	public function activate($page=null, $array, $post=null)
	{
		if(isset($_REQUEST['hesh'])){
			$params = array('hesh' => $_REQUEST['hesh'], "active" => "N");
			$array['user'] = DBConnect::init()->get_user(array(), $params, array());
			
			if(count($array['user']) > 0){
				// $params = array("id" => $array[0]['id']);
				// $upd_array = array("active" => "Y");
				// $upd = DBConnect::init()->upd_user($params, $upd_array);
				
				$where = array('id' => $array['user'][0]['id']);
				$what = array("active" => "Y");
				$table = 'users';
				if(Element::Update($where, $what, $table) == true){
				
				//if($upd['mess'] == true){
					$array['mess'] = "Успешная активация";
				} else {
					$array['mess'] = "Произошла ошибка";
					$array['error'] = $upd['error'];
				}
			} else {
				$array['mess'] = "Произошла ошибка";
				$array['error'] = "Такого пользователя не существует или данный аккаунт уже активирован.";
			}
		}
		
		return $array;
	}
	
	public function save_data($page=null, $array, $post=null)
	{
		if(isset($post['register'])){
			//метод добавляющий пользователя в БД, и все его доп поля...
			$post['register']['main']['hesh'] = md5($post['register']['main']['login']);
			$mess = DBConnect::init()->register_user($post['register']['main'], $post['register']['alter']);
			//конец метода
			if($mess == "ok"){
				
				$array['message'] = "Регистрация прошла успешно, вам на email отослано письмо с подтверждением регистрации.";
				$mail = array(
					"message" => '
							<html>
							<head>
							 <title>Подтверждение регистрации на сайте '. $_SERVER['HTTP_HOST'] .'</title>
							</head>
							<body>
							<p>Данное письмо содержит ссылку для активации вашего аккаунта на сайте '. $_SERVER['HTTP_HOST'] .'</p>
							<p>Ваш емейл был использован при регистрации на сайте '. $_SERVER['HTTP_HOST'] .', если вы понимаете о чем идет речь, то перейдите по  <a href="http://'. $_SERVER['HTTP_HOST'] .'/register/?hesh='. $post['register']['main']['hesh'] .'">ссылке</a> <br />
							Если вы не регистрировались на сайте '. $_SERVER['HTTP_HOST'] .', не обращайте внимание на это письмо.</p>
							<p>Данное письмо было сформировано и отослано автоматически системой сайта, не отвечайте на данное письмо, если у вас есть вопросы, пишите нам в тех. поддержку: support@protobox.ru</p>
							</body>
							</html>
							',
				"name" => $post['register']['main']['first_name'], 
				"email" => $post['register']['main']['email'],
				"subject" => "Подтверждение регистрации на сайте ". $_SERVER['HTTP_HOST'],
				);
				
				DBConnect::init()->send_email($mail);
			} else {
				$array['message'] = $mess;
			}
			return $array;
		}
		
	}

}