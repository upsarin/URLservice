<?
//data - содержит данные
//array - содержит инфо модуля
//page - содержит id текущей страницы (полезно для менюх)
?>
<section id="sp-top-bar">
	<div class="container">
		<div class="row">
			<div id="sp-top1" class="col-sm-6 col-md-6">
				
			</div>
			<div id="sp-top2" class="col-sm-6 col-md-6">
				<div class="sp-column ">
					<ul class="sp-contact-info">
						
						<li class="sp-contact-phone">
							
							<a style="font-weight: bold;font-size: 15px;" href="tel:+7 913 488 2666">8 (913) 488 26 66</a>
						</li>
						<li class="sp-contact-email">
							
							<a href="mailto:contact@email.com">academbio@mail.ru</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>


<div id="sp-header-sticky-wrapper" class="sticky-wrapper" style="height: 60px;">

	<header id="sp-header">
		<div class="container">
			<div class="row" style="position: relative;">
				<div id="sp-logo" class="col-xs-8 col-sm-3 col-md-3" style="width: 40%;">
					<div class="sp-column ">
						<a class="logo" href="/">
							<h1>
								<img class="sp-default-logo" src="/images/logotip.jpg" alt="Academ BIO" style="height: 60px;
    width: 130px;">
								<img class="sp-retina-logo" src="/images/logotip.jpg" alt="Academ BIO" style= "    width: 130px;
    height: 48px;">
								
								<!--<span>nsk</span><span>-diet</span>-->
							</h1>
						</a>
						<div class="sp-column busket" style="float: right;margin-top: -35px;">
							<a  href="/busket/" style="<?=($_SESSION['user']['summ'] == "" || !$_SESSION['user']['summ']) ? "display:none" : "display:block"?>" id="busketPlace"><img src="/images/busket.png" style="    width: 40px;float: left; margin-top: -12px;"/>заказано на сумму: <span id="busketSum"><?=$_SESSION['user']['summ']?> руб.</span></a>
						</div>
					</div>
				</div>
				<div id="sp-menu" class="col-xs-4 col-sm-9 col-md-9" style="position: static;width: 60%;">
					<div class="sp-column ">			
						<div class="sp-megamenu-wrapper">
							<a id="offcanvas-toggler" href="#"><img src="/images/325957.png" style="width: 45px;height: 45px; margin-top: 8px; margin-left: 20px;"/></a>
							
							

							<ul class="sp-megamenu-parent menu-fade hidden-xs">
							<? $middle = count($data)/2;?>
								<? foreach($data as $key => $val){ ?>
									<? if($val['alias'] == 'login' && isset($_SESSION['user']['sess_id'])) { 
											$val['alias'] = "/logout/";
											$val['name'] = "logout";
											$val['menu_name'] = "Выход";
									?>
										<li class="sp-menu-item <?=($page == $val['id']) ? "current-item active" : ""?>">
											<a href="<?=$val['alias']?>?filter=N"><?=$val['menu_name']?></a>
										</li>
									<? } else if($val['alias'] == 'register' && isset($_SESSION['user']['sess_id'])){ ?>
										
									<? } else if($val['alias'] == 'personal' && !isset($_SESSION['user']['sess_id'])){ ?>
										
									<? } else if($val['alias'] == '/'){ ?>
										<li class="sp-menu-item <?=($page == $val['id']) ? "current-item active" : ""?>">
											<a href="/?filter=N"><?=$val['menu_name']?></a>
										</li>
									<? } else { ?>
										<li class="sp-menu-item <?=($page == $val['id']) ? "current-item active" : ""?>">
											<a href="/<?=$val['alias']?>/?filter=N"><?=$val['menu_name']?></a>
										</li>
									<? } ?>
									
								<? } ?>
								
								
							</ul>			
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
</div>


