
<div class="pagination">
<?if(isset($_GET['c']) && !empty($_GET['c'])){
	$page_link = $page ."/?c=". $_GET['c'] ."&p=";
} else {
	$page_link = $page ."/?p=";
}?>
	<?if($data['settings']['page_num'] > 2){ ?>
		<a href="/<?=$page_link?>1?>">1</a> || 
		<a href="/<?=$page_link?><?=$data['settings']['page_num']-2?>"><?=$data['settings']['page_num']-2?></a>
	<? } ?>
	<?if($data['settings']['page_num'] > 1){ ?>
		<a href="/<?=$page_link?><?=$data['settings']['page_num']-1?>"><?=$data['settings']['page_num']-1?></a>
	<? } ?>
	<a href="#" class="active"><?=$data['settings']['page_num']?></a>
	<?if(($data['settings']['page_num']) < $data['settings']['max_pages']){ ?>
		<a href="/<?=$page_link?><?=$data['settings']['page_num'] + 1?>"><?=$data['settings']['page_num'] + 1?></a>
	<? } ?>
	<?if(($data['settings']['page_num'] + 1) < $data['settings']['max_pages']){ ?>
		<a href="/<?=$page_link?><?=$data['settings']['page_num'] + 2?>"><?=$data['settings']['page_num'] + 2?></a>
	<? } ?>
	<?if(($data['settings']['page_num'] + 1) < $data['settings']['max_pages']){ ?>
	<?$last_page = explode(".", $data['settings']['max_pages']);
	$last_page = $last_page[0] + 1; ?>
		|| <a href="/<?=$page_link?><?=$last_page?>"><?=$last_page?></a>
	<? } ?>
</div>