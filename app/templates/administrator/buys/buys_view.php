
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
				
				
				<form action="/administrator/buys/" method="POST">	
				
					<table class="page-table">
							<tr class="titles">
								<th></th>
								<th>ID</th>
								<th>Имя</th>
								<th>Телефон</th>
								<th>Описание заказа</th>
								<th>Активно</th>
								
								
							</tr>
						<? foreach($array['content']['buys'] as $key => $val){?>
							<?if($val["model"] != 'administrator'){ ?>
								<tr>
									<td><input name="id[]" type="checkbox" value="<?=$val['id']?>" /></td>
									<td><?=$val['id']?></td>
									<td><?=$val['name']?></td>
									<td><?=$val['phone']?></td>
									<td><?=$val['desc']?></td>
									<?=($val['active'] == 'Y') ? '<td class="activate" id="'. $val['id'] .'"><a href="/administrator/buys/deactivate/'. $val['id'] .'/">Обработано</a></td>' : '<td class="deactivate" id="'. $val['id'] .'"><a href="/administrator/buys/activate/'. $val['id'] .'/">не обработано</a></td>'?>
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
					</select>
					
					<input type="submit" name="do_action" value="выполнить"/>
				</form>
				<? } ?>
				</div>
			