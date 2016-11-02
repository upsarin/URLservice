					<? if(isset($_GET['phrase']) && !empty($_GET['phrase'])){ ?>
						<h4 class="phrase">Сообщение для HUSTON: Полет нормальный, <?=$_GET['phrase']?></h4>
					<? } ?>
					
	
				
				<a class="createA" href="/administrator/pages/create/">создать</a>
				<form action="/administrator/pages/" method="POST">
					<table class="page-table">
							<tr class="titles">
								<th></th>
								<th>ID</th>
								<th>Новый контент</th>
								<th>Название</th>
								<th>Модель</th>
								<th>активность</th>
								<th>меню</th>
								<th>название в меню</th>
								<th>Шаблон</th>
								<th>Внутренний шаблон</th>
								<th>доступ</th>
								<!--<th>начальная</th>-->
								
							</tr>
							
							
						<? foreach($array['content']['pages'] as $key => $val){?>
							
								<tr>
									<td><input name="id[]" type="checkbox" value="<?=$val['id']?>" <?=($val['id'] == 18) ? 'checked="checked"' : '' ?>/></td>
									<td><?=$val['id']?></td>
									<td><a href="/administrator/content/create/?model=<?=$val['model']?>">Создать</a></td>
									<td><a href="/administrator/pages/edit/<?=$val['id']?>/"><?=$val['title']?></a></td>
									<td><?=$val['model']?></td>
									
									<?=($val['active'] == 'Y') ? '<td class="activate" id="'. $val['id'] .'"><a href="/administrator/pages/deactivate/'. $val['id'] .'/">Да</a></td>' : '<td class="deactivate" id="'. $val['id'] .'"><a href="/administrator/pages/activate/'. $val['id'] .'/">Нет</a></td>'?>
									
									<td><?=$val['menu_type']?></td>
									<td><?=$val['menu_name']?></td>
									<td><?=$val['temp_folder']?></td>
									<td><?=$val['template_type']?></td>
									<td><?=$val['permission']?></td>
									<!--<td><?=($val['index'] == 1) ? 'Да' : 'Нет'?></td>-->
									
								</tr>
							
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