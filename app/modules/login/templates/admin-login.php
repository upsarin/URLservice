<html>
<head>
<title><?=$array['title']?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
	
	<link rel="stylesheet" type="text/css"  href="/css/style-admin.css">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script async="" src="/js/jscript.js"></script>
	<link rel="icon" type="image/png" href="favicon.png" />
	<style>
		body {
			width: 99%;
			height: 90%;
		}
		.main-block {
			position: relative;
			top: 0px;
			left: 0px;
			color: black;
			width: 100%;
			min-height: 70%;
			z-index: 3;
		}	
		.content {
			position: absolute;
			top: 45%;
			left: 40%;
			width: 300px;
			height: 280px;
			float: left;
			background-color: rgba(255,255,255,0.3);
			padding: 0px 20px;
			text-align: left;
			font-family: Prosto;
		}
		input {
			height: 32px;
			width: 190px;
			font-size: 21px;
			border: none;
			font-family: Prosto;
		}
		.enter {
			background: url('../images/door.jpg') 29% 16.5%;
			background-size: 1010%;
			height: 100px;
			width: 70px;
			border-radius: 12px;
			margin-top: 59px;
			margin-left: 30px;
			border: 3px solid orange;
		}
		.enter:hover {
			background: url('../images/door.jpg') 48.5% 16.5%;
			background-size: 1010%;
			height: 100px;
			width: 70px;
			border-radius: 12px;
			margin-top: 59px;
			margin-left: 30px;
			border: 3px solid orange;
			cursor: pointer;
		}
		h2 {
			text-align:center;
		}
		.tosite{
			font-family: Prosto;
			text-decoration: none;
			color: orange;
			text-align: center;
			margin-left: 40%;
		}
	</style>
</head>
<body>
	<div class="main-block">
				<div class="content">
					<h2>Авторизация</h2>
					<a class="tosite" href="/">сайт</a>
					<form action="/administrator/" method="POST" class="form">
					<div class="left">
						<input type="hidden" name="action" value="login_user" />
						<input type="hidden" name="module" value="login" />
						<? foreach($data as $key => $val){ ?>
							<p class="contact-label"><?=($val['required'] == "Y") ? "* " : ""?><?=ucfirst($val['name'])?></p>
									<input type="<?=$val['input_type']?>" name="<?=$val['code']?>" value="" <?=($val['required'] == "Y") ? "required" : ""?>/>
						<? } ?>
					</div>
					<div class="right">
						<input class="enter" type="submit" name="send" value="" />
					</div>
                    </form>
				</div>
	</div>
</body>
</html>