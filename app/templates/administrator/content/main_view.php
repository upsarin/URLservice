
	<div class="sicky-wrapper-free-space"></div>
	

				<?if($array["action"] == "create" || $array["action"] == "edit") { ?>
	<div class="container main-block" id="joinOurTeamFull" style="float: left;">
					<h2><?=$array["title"]?></h2>
						<div class="add_form">
							<?=minc::pos("admin-form", $array["name"])?>
						</div>	
	</div>	
				<? } else if($array["action"] == "settings"){?>
	<div class="container main-block" id="joinOurTeamFull" style="float: left;">
					<div class="add_form">
						<?=minc::pos("settings", $array['name'])?>
					</div>	
	</div>	
				<? } else { ?>
	<div class="container main-block" id="joinOurTeamFull" style="width: 60%;
    float: left;">
					<h2><?=$array["title"]?></h2>
					<? if(isset($_GET['phrase']) && !empty($_GET['phrase'])){ ?>
						<h4 class="phrase">Сообщение для HUSTON: Полет нормальный, <?=$_GET['phrase']?></h4>
					<? } ?>
				<a class="createA" href="/administrator/pages/">создать</a> 
				<form action="/administrator/content/" method="POST">
				<!--<input type="text" name="filter[name]" value="" /> -->
				
				
				</form>
				<form action="/administrator/content/" method="POST">	
				
					<table class="page-table">
							<tr class="titles">
								<th></th>
								<th>ID</th>
								<th>Название</th>
								<th>Активно</th>
								<th>Категория</th>
								<th>Картинки</th>
								
								
							</tr>
						<? foreach($array['content']['content'] as $key => $val){?>
							<?if($val["model"] != 'administrator'){ ?>
								<tr>
									<td><input name="id[]" type="checkbox" value="<?=$val['id']?>" /></td>
									<td><?=$val['id']?></td>
									<td><a href="/administrator/content/edit/<?=$val['id']?>/"><?=$val['title']?></a></td>
									<?=($val['active'] == 'Y') ? '<td class="activate" id="'. $val['id'] .'"><a href="/administrator/content/deactivate/'. $val['id'] .'/">Да</a></td>' : '<td class="deactivate" id="'. $val['id'] .'"><a href="/administrator/content/activate/'. $val['id'] .'/">Нет</a></td>'?>
									<td><?=Element::GetByID($val['cat'], 'name', 'cats');?></td>
									<?
										$filter = array("content_id" => $val['id']);
										$images = Element::SelectAll('files', $filter, null, null);
									?>
									<td><?=count($images)?></td>
									
									
									
								</tr>
							<? } ?>
						<? } ?>
						
					</table>
					<? if(isset($array['pagination']['list_limit']) && isset($array['pagination']['page_num'])){ ?>
						<?=minc::pos("pagination", $array['name'], $array['pagination'])?>
					<? } ?>
					<select name="action">
						<option value=""></option>
						<option value="del">удалить</option>
						<option value="deactivate">не активные</option>
						<option value="activate">активные</option>
						<option value="delete_all">удалить вместе с данными</option>
					</select>
					
					<input type="submit" name="do_action" value="выполнить"/>
				</form>
				
	
	</div>
<div class="left-menu-cats" style="
margin-top: 110px;
    float: right;
    width: 39%;
    color: black;
    height: auto;
    border-left: 3px solid #6ab42f;" >
	<ul style="margin-left: 0px;">
		<li <?=($_SESSION['user']['filter']['cat'] == 0) ? "class='active'" : ""?>><a href="/<?=$array['model']?>/content/?c=0" id="0">Все <span class="count">(<?=Element::countElements(null, null, null)?>)</span></a></li>
	<?
		$filter = array("active" => "Y", "parent" => 1);
		$cats = Element::SelectAll('cats', $filter, null, null);
	?>
	<? foreach($cats as $c_count => $cat){ ?>
		<li <?=($_SESSION['user']['filter']['cat'] == $cat['id']) ? "class='active'" : ""?>><a href="/<?=$array['model']?>/content/?c=<?=$cat['id']?>" id="<?=$cat['id']?>"><?=$cat['name']?> <span class="count">(<?=Element::countElements(null, null, array("cat" => $cat['id']))?>)</span></a></li>
		<?
		$filter = array("active" => "Y", "parent" => $cat['id']);
		$cats_child = Element::SelectAll('cats', $filter, null, null);
		if(count($cats_child) > 0){ ?>
		
			<ul class="child" id="child-<?=$cat['id']?>" <?=($_SESSION['user']['filter']['cat'] == $cat['id']) ? "style='display:block'" : ""?>>
			
			<?foreach($cats_child as $child_count => $child_cat){?>
			
				<li <?=($_SESSION['user']['filter']['cat'] == $child_cat['id']) ? "class='active'" : ""?>><a href="/<?=$array['model']?>/content/?c=<?=$child_cat['id']?>" id="<?=$child_cat['id']?>"><?=$child_cat['name']?> <span class="count">(<?=Element::countElements(null, null, array("cat" => $child_cat['id']))?>)</span></a></li>
					<?if($_SESSION['user']['filter']['cat'] == $child_cat['id']){?>
						<style>
							#child-<?=$cat['id']?> { 
								display: block !important;
							}
						</style>
					<? } ?>
				<?
				$filter = array("active" => "Y", "parent" => $child_cat['id']);
				$cats_child = Element::SelectAll('cats', $filter, null, null);
				if(count($cats_child) > 0){ ?>
					<ul class="child" id="child-<?=$child_cat['id']?>" <?=($_SESSION['user']['filter']['cat'] == $child_cat['id']) ? "style='display:block'" : ""?>>
					
					<?foreach($cats_child as $child_count2 => $child_cat2){?>
						<li <?=($_SESSION['user']['filter']['cat'] == $child_cat2['id']) ? "class='active'" : ""?>><a href="/<?=$array['model']?>/content/?c=<?=$child_cat2['id']?>" id="<?=$child_cat2['id']?>"><?=$child_cat2['name']?> <span class="count">(<?=Element::countElements(null, null, array("cat" => $child_cat2['id']))?>)</span></a></li>
						<?if($_SESSION['user']['filter']['cat'] == $child_cat2['id']){?>
							<style>
								#child-<?=$child_cat['id']?> { 
									display: block !important;
								}
							</style>
						<? } ?>
					<? } ?>
					</ul>
				<? } ?>
			<? } ?>
			</ul>
			
		<? } ?>
	<? } ?>
		
		
	</ul>
</div>
<? } ?>
<script>

</script>
			