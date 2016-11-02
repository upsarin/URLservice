
			<div class="sicky-wrapper-free-space"></div>
				<div class="container main-block" id="joinOurTeamFull" style="margin-bottom:0">
					<h2><?=$array["title"]?></h2>

					<?if($array["action"] == "create" || $array["action"] == "edit") { ?>
						<div class="add_form">
							<?=minc::pos("admin-form", $array["name"])?>
						</div>	
					<? } else if($array["action"] == "settings"){?>
						<div class="add_form">
							<?=minc::pos("settings", $array['name'])?>
						</div>	
					<? } else { ?>
					<? if(isset($_GET['phrase']) && !empty($_GET['phrase'])){ ?>
						<h4 class="phrase">Сообщение для HUSTON: Полет нормальный, <?=$_GET['phrase']?></h4>
					<? } ?>
				<a class="createA" href="/administrator/cats/create/">создать</a>
				<form action="/administrator/cats/" method="POST">
					<table class="page-table" style="text-align: left !important">
							<tr class="titles">
								<th></th>
								<th>ID</th>
								<th>Название</th>
								<th>Краткое писание</th>
							</tr>
						<? foreach($array['content']['cats'] as $key => $val){?>
							<?if($val["model"] != 'administrator'){ ?>
								<tr>
									<td><input name="id[]" type="checkbox" value="<?=$val['id']?>" /></td>
									<td><?=$val['id']?></td>
									<td><a href="/administrator/cats/edit/<?=$val['id']?>/"><?=$val['name']?></a></td>
									<td><?=$val['preview_desc']?></td>
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
					<? } ?>
				</div>
			