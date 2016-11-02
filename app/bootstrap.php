<?php

session_start();
			
	require_once ("app/classes/User.php");
	require_once ("app/classes/Main_classes.php");
	require_once ("app/core/dbo.php");
	
	
	
	//описать и вывести все параметры сайта из БД fields {system}, ну а пока что так
	ini_set('display_errors', '0');


	require_once ("app/core/model.php");
	require_once ("app/core/view.php");
	require_once ("app/core/module_router.php");
	require_once ("app/core/controller.php");
	require_once ("app/core/router.php");

	User::check();
	Router::start();


