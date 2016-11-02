
<div class="sicky-wrapper-free-space"></div>
	<div class="container main-block" id="joinOurTeamFull" style="margin-bottom:0">
		<h2><?=$array["title"]?></h2>
		
		<?if($array["action"] == "create" || $array["action"] == "edit") { ?>
			<div class="add_form">
				<?=minc::pos("admin-form-users", $array['name'])?>
			</div>	
		<? } else if($array["action"] == "settings"){?>
			<div class="add_form">
				<?=minc::pos("settings", $array['name'])?>
			</div>	
		<? } else { ?>
					<? if(isset($_GET['phrase']) && !empty($_GET['phrase'])){ ?>
						<h4 class="phrase"><?=$_GET['phrase']?></h4>
					<? } ?>
				<a class="createA" href="/administrator/users/create/">создать</a>
				<form action="/administrator/users/" method="POST">
					<table class="page-table">
							<tr class="titles">
								<th></th>
								<th>ID</th>
								<th>Логин</th>
								<th>Контакты</th>
								<th>Активный</th>
								<th>статус</th>
								<th>Email</th>
								<th>Группа</th>
							</tr>
						<? foreach($array['content']['users'] as $key => $val){?>
							<?if($val["model"] != 'administrator'){ ?>
								<tr>
									<td><input name="id[]" type="checkbox" value="<?=$val['id']?>" /></td>
									<td><?=$val['id']?></td>
									<td><a href="/administrator/users/edit/<?=$val['id']?>/"><?=$val['login']?></a></td>
									<td><?=$val['last_name']?> <?=substr($val['first_name'], 0, 2)?>. <?=substr($val['middle_name'], 0, 2)?>.</td>
									<?=($val['active'] == 'Y') ? '<td class="activate" id="'. $val['id'] .'"><a href="/administrator/users/deactivate/'. $val['id'] .'/">Да</a></td>' : '<td class="deactivate" id="'. $val['id'] .'"><a href="/administrator/users/activate/'. $val['id'] .'/">Нет</a></td>'?>
									<td><?=$val['status']?></td>
									<td><?=$val['email']?></td>
									<td><?=$val['group']?></td>
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
		
			