
			<div class="sicky-wrapper-free-space"></div>
				<div class="container main-block" id="joinOurTeamFull" style="margin-bottom:0">
					<h2><?=$array["title"]?></h2>
					<?if(isset($array["content"]) && !empty($array["content"])) {
						include $html_temp;
					} else if($array['action'] == "create") { ?>
						<div class="add_form">
							<?=minc::pos("form-admin", $array['name'])?>
						</div>	
					<? } ?>
				</div>
			