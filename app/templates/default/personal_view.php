<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	<meta name="robots" content="index, follow">
	<meta name="keywords" content="заказ услуг, запрос услуг, доска объявлений, найти исполнителя, подрядчика, поиск заказов">
	<meta name="description" content="Ищите исполнителя для оказания услуг по хозяйству, ремонту, грузоперевозкам,сиделку, репетитора? Дайте объявление ЗАПРОС на УСЛУГУ на нашем сайте.">
	
    <meta name="description" content="">
    <meta name="author" content="">
    

    <title>SibService | <?=$array['title']?></title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/additional.js"></script>
    <!-- Custom styles for this template -->
    <link href="/css/starter-template.css" rel="stylesheet">
	
	<link rel="shortcut icon" href="/favicon.ico">

  </head>
	
<body>

	<div class="site-wrapper">

		<div class="site-wrapper-inner">
			<div class="user_interface">
				<?if(is_numeric($_SESSION['user']['id']) && $_SESSION['user']['id']){ ?>
					<a href="/logout/" class="" id="link-logout"><span class="glyphicon glyphicon-share"></span> Выход</a> | 
					<a href="/personal/" class=""><span class="glyphicon glyphicon-registration-mark"></span> Личный кабинет</a>
				<? } else { ?>
					<a href="/login/" class=""><span class="glyphicon glyphicon-share"></span> Вход</a> | 
					<a href="/register/" class=""><span class="glyphicon glyphicon-registration-mark"></span> Регистрация</a>
				<? } ?>
			</div>
			<div class="cover-container" style="position: fixed;
    padding-left: 15%;
    z-index: 100000;
    background-color: #333;
    width: 100%;
    top: 0px;
    height: 70px;
    margin-top: -30px;">

				  <div class="masthead clearfix">
					<div class="inner">
					  <h3 class="masthead-brand"><a href="/"><span class="orange logoleft">Sib</span><img class="logoimg" style="width: 35px;" src="/images/icn02.png" /><span class="green logoright">S</span><span class="logoright">ervice</span></a> <span style="color: orange; font-weight: bold; font-size: 12px;">INFO</span></h3>
					  <ul class="nav masthead-nav">
						<li class="<?=($array['model'] == "sibservice") ? "active" : ""?>"><a href="/">Главная</a></li>
						<li class="<?=($array['model'] == "katalog") ? "active" : ""?>"><a href="/katalog/">Сервис</a></li>
						<li class="<?=($array['model'] == "contacts") ? "active" : ""?>"><a href="/contacts/">Контакты</a></li>
						<li class="<?=($array['model'] == "about") ? "active" : ""?>"><a href="/about/">О сервисе</a></li>
						<li class="<?=($array['model'] == "tarif") ? "active" : ""?>"><a href="/tarif/">Тарифы</a></li>
					  </ul>
					</div>
				  </div>
			</div>
			

<? include $content; ?>		

        </div>

      </div>
	<div class="mastfoot">
		<div class="inner">
		  <p>SibService <span class="glyphicon glyphicon-copyright-mark"></span> 2010 - 2016 | by <a href="https://vk.com/id8762161">@upsarin</a>.</p>
		</div>
	</div>
<script>
	$(".mastfoot").css("display", "none");
	$("body").append("<div class='loading_overlay'><img src='/images/loader.gif' /></div>");
	var loaderWidth = $('.loading_overlay').width();
	
	$(document).ready(function(){
		logoMove(loaderWidth);
	});
</script>
</body>

</html>