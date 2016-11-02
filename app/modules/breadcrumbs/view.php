<?php

class BreadcrumbsView
{
	
	//public $template_view; // здесь можно указать общий вид по умолчанию.
	
	/*
	$content_file - виды отображающие контент страниц;
	$template_file - общий для всех страниц шаблон;
	$data - массив, содержащий элементы контента страницы. Обычно заполняется в модели.
	*/
	function generate($template_view, $page, $data, $array)
	{
		$dir = "app/modules/". $array['module_name'];
		if(is_dir($dir)){
			$dir = $dir;
		} else {
			@mkdir($dir, "0755");
			$dir = $dir;
		}
		
		
		
		$temp = $dir ."/templates/". $template_view;
		if(!file_exists($temp)){
			$fp = @fopen($temp, "w+"); // ("r" - считывать "w" - создавать "a" - добовлять к тексту), мы создаем файл
			fwrite($fp, "Дефальтный шаблон");
			fclose ($fp);
			include $temp;
		} else {
			include $temp;
		}
		
		
		
		
	}
}
