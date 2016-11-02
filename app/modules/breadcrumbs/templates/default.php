
<div class="breadcrumbs">
<?
$routes = explode('/', $_SERVER['REQUEST_URI']);
if($routes[1] == "administrator"){
	
	
} else {
	if($routes[2] == "detail"){
		$bread[0]['page_alias'] = $routes[1];
		$bread[0]['page_type'] = "list";
		
		$bread[1]['page_alias'] = $routes[3];
		$bread[1]['page_type'] = "detail";
	} else {
		$bread[0]['page_alias'] = $routes[1];
		$bread[0]['page_type'] = "list";
	}
	foreach($bread as $key => $val){
		if($val['page_type'] == "list"){
			$page = Element::GetOne($alias = $val['page_alias'], $filter = NULL, $fields = NULL, $table = "pages");
			$really_bread[0]['alias'] = "/". $page[0]['alias'] ."/?filter=N";
			$really_bread[0]['title'] = $page[0]['title'];
		} else {
			$content = Element::GetOne($alias = $val['page_alias'], $filter = NULL, $fields = NULL, $table = "content");
			$really_bread[2]['alias'] = "/". $content[0]['alias'] ."/";
			$really_bread[2]['title'] = $content[0]['title'];
		}
		if($content[0]['cat']){
			$cat = Element::GetByID($content[0]['cat'], $return=null, $table="cats");
			$really_bread[1]['alias'] = "/". $page[0]['alias'] ."/?c=". $cat['id'] ."&filter=N";
			$really_bread[1]['title'] = $cat['name'];
		}
	}
	
}
?>

<span><a href="/?filter=N">Главная</a></span>

<?if($really_bread[0]){ ?>
		<span> / </span> <span>
		<?if($really_bread[1]){?>
		<a href="<?=$really_bread[0]['alias']?>">
		<? } ?>
			<?=$really_bread[0]['title']?>
		<?if($really_bread[1]){?>
			</a>
		<? } ?>
		</span>
<? } ?>
<?if($really_bread[1]){ ?>
		<span> / </span> <span>
		<a href="<?=$really_bread[1]['alias']?>"><?=$really_bread[1]['title']?></a></span>
<? } ?>
<?if($really_bread[2]){ ?>
		<span> / </span> <span><?=$really_bread[2]['title']?></span>
<? } ?>
</div>