<div class="container main-block" id="joinOurTeamFull" style="    width: 630px;">
	<h3 class="sitename">Авторизация</h3>
		
        <div class="row work">
			<?if(isset($_REQUEST['error']) && ($_REQUEST['error'] == "Y")) { ?>
			<div class="errors">
				<p>Неправильный логин или пароль, или неправильное сочетание логина и пароля!</p>
			</div>
			<? } ?>
			<? if(!isset($_REQUEST['action'])) { ?> 
            <div class="col-xs-12 col-lg-5 col-lg-offset-1">
				<?=minc::pos("login", $array['id'])?>
			</div>
			<? } else { ?>
				<?=minc::pos("login", $array['id'])?>
			<? } ?>
            
        </div>
 </div>