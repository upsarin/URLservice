
	<?
	$params = array("iblock" => 'users', 'field_type' => 'alter');
	$sort = array("sort", "asc");
	$data['alter'] = DBConnect::init()->getFeilds($params, $sort);
	?>
	<form id="alter-fields" method="POST" type="">
				<input type="hidden" name="action" value="save_fields" />
				<input type="hidden" name="module" value="form" /> 
				<input type="hidden" name="page_id" value="users" />
				<input type="hidden" name="iblock" value="users" />
				<table style="color: black; margin-bottom: 50px; background: rgba(255,255,255,0.7)">
					<tbody  id="fieldtable">
						<tr>
							<th></th>
							<th>ID</th>
							<th>name</th>
							<th>input_type</th>
							<th>active</th>
							<th>required</th>
							<th>read</th>
							<th>sort</th>
							<th>code</th>
							<th></th>
						</tr>
				<? if(isset($data['alter']) && count($data['alter']) > 0) { ?>
					<? foreach($data['alter'] as $key => $val){ 
					?>
						<tr>
							<td><input type="checkbox" name="alter[<?=$val['id']?>][del]" value="Y" /></td>
							<td class="input-label">
								<?=$val['id']?>
								
							</td>
							<td class="input-label">
								<input type="text" name="alter[<?=$val['id']?>][name]" value="<?=$val['name']?>" />
							</td>
							<td class="input-label">
								<select name="alter[<?=$val['id']?>][input_type]"> 
									<option value="text" <?=($val['input_type'] == 'text') ? 'selected="selected"' : ''?>>text</option>
									<option value="html" <?=($val['input_type'] == 'html') ? 'selected="selected"' : ''?>>html</option>
									<option value="select" <?=($val['input_type'] == 'select') ? 'selected="selected"' : ''?>>select</option>
									<option value="file" <?=($val['input_type'] == 'file') ? 'selected="selected"' : ''?>>file</option>
									<option value="checkbox" <?=($val['input_type'] == 'checkbox') ? 'selected="selected"' : ''?>>checkbox</option>
									<option value="textarea" <?=($val['input_type'] == 'textarea') ? 'selected="selected"' : ''?>>textarea</option>
									<option value="hidden" <?=($val['input_type'] == 'hidden') ? 'selected="selected"' : ''?>>hidden</option>
									<option value="date" <?=($val['input_type'] == 'date') ? 'selected="selected"' : ''?>>date</option>
								</select>
							</td>
							<td class="input-label">
								<input type="checkbox" name="alter[<?=$val['id']?>][active]" value="<?=$val['active']?>" <?=($val['active'] == 'Y') ? 'checked="checked"' : ''?>/>								
							</td>
							<td class="input-label">
								<input type="checkbox" name="alter[<?=$val['id']?>][required]" value="<?=$val['required']?>" <?=($val['required'] == 'Y') ? 'checked="checked"' : ''?>/>								
							</td>
							<td class="input-label">
								<input type="checkbox" name="alter[<?=$val['id']?>][readonly]" value="<?=$val['readonly']?>" <?=($val['readonly'] == 'Y') ? 'checked="checked"' : ''?>/>								
							</td>
							<td class="input-label">
								<input type="text" name="alter[<?=$val['id']?>][sort]" value="<?=$val['sort']?>" style="width: 35px;"/>								
							</td>
							<td class="input-label">
								<input type="text" name="alter[<?=$val['id']?>][code]" value="<?=$val['code']?>" />
							</td>
							<td><span id="<?=$val['id']?>" class="settings">настройки</span></td>
						</tr>
					<? } ?>	
					
				<? } ?>
					</tbody>
				</table>
						<span class="new-field-users">добавить</span>
				<select name="action_fields">
					<option value=""></option>
					<option value="del">удалить</option>
					<option value="deactivate">не активны</option>
					<option value="activate">активны</option>
				</select>
				</div>
				
				<div class="right" style="width: 27% !important;">
				
				<? foreach($data['alter'] as $key => $val){ ?>
					<div id="settingsup<?=$val['id']?>" class="settingsup">
						
							
							<h4 style="color: orange;">Настройки доп поля ID<?=$val['id']?></h4>
							
							<table style="margin-left: 25px;">
							<tr>
								<td class="input-label">VALUES</td>
								<td><input type="text" name="alter[<?=$val['id']?>][default_value]" value="<?=$val['default_value']?>" /></td>
							</tr>
							<tr>
								<td class="input-label">labels</td>
								<td><input type="text" name="alter[<?=$val['id']?>][default_names]" value="<?=$val['default_names']?>" /></td>
							</tr>
							<tr>
								<td class="input-label">Тип</td>
								<td><input type="text" name="alter[<?=$val['id']?>][default_type]" value="<?=$val['default_type']?>" placeholder="системная настройка"/></td>
							</tr>
							<tr>
								<td class="input-label">Значение</td>
								<td><input type="text" name="alter[<?=$val['id']?>][default_type_value]" value="<?=$val['default_type_value']?>" placeholder="системная настройка"/></td>
							</tr>
						</table>
					</div>
				<? } ?>
				</div>
				
				<div class="submit" style="clear">
					<input class="section-btn send" type="submit" name="send" value="Сохранить"/> 
				</div>
			</form>