<?
$params = array("menu_active" => "Y", "menu_type" => "main-menu", "active" => "Y");
$data = DBConnect::init()->getMemu($array['type'], $params);
?>
<div class="offcanvas-menu">
	<a href="#" class="close-offcanvas"><img src="/images/325957.png" style="width: 45px;height: 45px; margin-top: 8px; margin-left: 20px;"></a>
	<div class="offcanvas-inner">
	<div class="sp-module "><div class="sp-module-content">
	
	<ul class="nav menu">
	
	<? foreach($data as $key => $val){ ?>
		<? if($val['alias'] == 'login' && isset($_SESSION['user']['sess_id'])) { 
				$val['alias'] = "/logout/";
				$val['name'] = "logout";
				$val['menu_name'] = "Выход";
		?>
			<li class="item-<?=$val['id']?> <?=($page == $val['id']) ? "current active" : ""?>">
				<a href="<?=$val['alias']?>"><?=$val['menu_name']?></a>
			</li>
		<? } else if($val['alias'] == 'register' && isset($_SESSION['user']['sess_id'])){ ?>
			
		<? } else if($val['alias'] == 'personal' && !isset($_SESSION['user']['sess_id'])){ ?>
			
		<? } else if($val['alias'] == '/'){ ?>
			<li class="item-<?=$val['id']?> <?=($page == $val['id']) ? "current active" : ""?>">
				<a href="/"><?=$val['menu_name']?></a>
			</li>
		<? } else { ?>
			<li class="item-<?=$val['id']?> <?=($page == $val['id']) ? "current active" : ""?>">
				<a href="/<?=$val['alias']?>/"><?=$val['menu_name']?></a>
			</li>
		<? } ?>
		
	<? } ?>
		

	</ul>
	</div>
	</div>
	</div>
</div>