<div class="container main-block" id="joinOurTeamFull">
	<h3 class="sitename"><?=$array['title']?></h3>
		
        <div class="row work">
			<?if(isset($_GET['error']) && ($_GET['error'] == "Y")) { ?>
			<div class="errors">
				<p>При регистрации произошла ошибка</p>
			</div>
			<? } ?>
			
			<?if(isset($_GET['hesh'])){ ?>
				
					<?=minc::pos("pos-register-activate", $array['id'])?>
				
			<? } else { ?>
					<?=minc::pos("pos-register", $array['id'])?>
            <? } ?>
			</div>
            
        
 </div>