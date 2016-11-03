<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	<meta name="robots" content="index, follow">
	<meta name="keywords" content="Сервис по урезанию ссылок">
	<meta name="description" content="Сервис делающий ссылки меньше">
	
    <meta name="description" content="">
    <meta name="author" content="">
    

    <title>URLService | <?=$array['title']?></title>

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
					  <h3 class="masthead-brand"><a href="/"><span class="orange logoleft">URL</span><img class="logoimg" style="width: 35px;" src="/images/icn02.png" /><span class="green logoright">S</span><span class="logoright">ervice</span></a> <span style="color: orange; font-weight: bold; font-size: 12px;">INFO</span></h3>
					  <ul class="nav masthead-nav">
						<li class="<?=($array['model'] == "urlservice") ? "active" : ""?>"><a href="/">Главная</a></li>
						<li class="<?=($array['model'] == "katalog") ? "active" : ""?>"><a href="/katalog/">Сервис</a></li>
					  </ul>
					</div>
				  </div>
			</div>
		
		
<? include $content; ?>		

        </div>

      </div>
	<div class="mastfoot">
		<div class="inner">
		  <p>URLService <span class="glyphicon glyphicon-copyright-mark"></span> <?=date("Y")?> | by <a href="https://vk.com/id8762161">@upsarin</a>.</p>
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