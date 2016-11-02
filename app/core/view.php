<?php

class View
{
	
	//public $template_view; // Р·РґРµСЃСЊ РјРѕР¶РЅРѕ СѓРєР°Р·Р°С‚СЊ РѕР±С‰РёР№ РІРёРґ РїРѕ СѓРјРѕР»С‡Р°РЅРёСЋ.
	
	/*
	$content_file - РІРёРґС‹ РѕС‚РѕР±СЂР°Р¶Р°СЋС‰РёРµ РєРѕРЅС‚РµРЅС‚ СЃС‚СЂР°РЅРёС†;
	$template_file - РѕР±С‰РёР№ РґР»СЏ РІСЃРµС… СЃС‚СЂР°РЅРёС† С€Р°Р±Р»РѕРЅ;
	$data - РјР°СЃСЃРёРІ, СЃРѕРґРµСЂР¶Р°С‰РёР№ СЌР»РµРјРµРЅС‚С‹ РєРѕРЅС‚РµРЅС‚Р° СЃС‚СЂР°РЅРёС†С‹. РћР±С‹С‡РЅРѕ Р·Р°РїРѕР»РЅСЏРµС‚СЃСЏ РІ РјРѕРґРµР»Рё.
	*/
	function generate($content_view, $template_view = null, $array = null, $page)
	{
		
 		
		
		$dir = "app/templates/". $array['temp_folder'] ."/". $array['name'];
		if(is_dir($dir)){
			$dir = $dir;
		} else {
			@mkdir($dir, "0777");
			chmod($dir, 0777);  
			$dir = $dir;
		}
		
		$content = $dir ."/". $content_view;
		if(file_exists($content)){
			if(isset($array['content'])) {
				$html_temp = "app/templates/" . $array['temp_folder'] ."/html/". $array['content_type'] ."/". $array['content_temp'] .".php";
				if(!file_exists($html_temp)){
					$html_temp = "app/templates/html/". $array['content_type'] ."/". $array['content_temp'] .".php";
				}
		
			}
		} else {
			$fp = @fopen($content, "w+"); // ("r" - СЃС‡РёС‚С‹РІР°С‚СЊ "w" - СЃРѕР·РґР°РІР°С‚СЊ "a" - РґРѕР±РѕРІР»СЏС‚СЊ Рє С‚РµРєСЃС‚Сѓ), РјС‹ СЃРѕР·РґР°РµРј С„Р°Р№Р»
			fwrite($fp, '
			<div class="sicky-wrapper-free-space"></div>
				<div class="container main-block" id="joinOurTeamFull" style="margin-bottom:0">
					<h2><?=$array["title"]?></h2>

					<?if(isset($array["content"]) && !empty($array["content"])) {
						include $html_temp;
					} else if($array["action"] == "create") { ?>
						<div class="add_form">
							<?=minc::pos("form", $array["name"])?>
						</div>	
					<? } ?>
				</div>
			'
			);
			fclose ($fp);
			
		}
		if((isset($_REQUEST['ajax'])) && ($_REQUEST['ajax'] == "Y")) {
			minc::pos($_REQUEST['module'], $array['id']);
		} else {
			
			$parent_temp = 'app/templates/' . $array['temp_folder'] ."/". $template_view;
			if(!file_exists($parent_temp)){
				$fp = @fopen($parent_temp, "w+"); // ("r" - СЃС‡РёС‚С‹РІР°С‚СЊ "w" - СЃРѕР·РґР°РІР°С‚СЊ "a" - РґРѕР±РѕРІР»СЏС‚СЊ Рє С‚РµРєСЃС‚Сѓ), РјС‹ СЃРѕР·РґР°РµРј С„Р°Р№Р»
				fwrite($fp, "Р”РµС„Р°Р»СЊС‚РЅС‹Р№ С€Р°Р±Р»РѕРЅ");
				fclose ($fp);
				include $parent_temp;
			} else {
				include $parent_temp;
			}
		}
		
		
		
	}
}
