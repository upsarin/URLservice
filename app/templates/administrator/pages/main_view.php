			<div class="sicky-wrapper-free-space"></div>
				<div class="container main-block" id="joinOurTeamFull" style="margin-bottom:0">
					<h2><?=$array["title"]?></h2>

					<?if(isset($array["content"]) && !empty($array["content"])) {
						include $html_temp;
					} else if($array["action"] == "create" || $array["action"] == "edit") { ?>
						<div class="add_form">
							<?=minc::pos("admin-form", $array["name"])?>
						</div>	
					<? } else if($array["action"] == "settings"){?>
						<div class="add_form">
							<?=minc::pos("settings", $array['name'])?>
						</div>	
					<? } ?>
				</div>