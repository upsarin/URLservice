<?
//data - содержит данные
//array - содержит инфо модуля
//page - содержит id текущей страницы (полезно для менюх)
?>
<script type="text/javascript"> 
  $(document).ready(function(){ $('#tab-container').easytabs(); });
</script> 

<h3><?=(isset($data['VALUES'][0]['id'])) ? "Настройка элемента ID". $data['VALUES'][0]['id'] : "Создание нового элемента"?></h3>
<style>
#tab-base table td{
	    padding-bottom: 20px;
		border-bottom: 1px solid rgba(154, 152, 152, 0.47);
		padding-top: 10px;
}
</style>

<?$routes = explode('/', $_SERVER['REQUEST_URI']);?>
<?
		$page = Element::Page(null, $routes[4]);
		
foreach($data['FIELDS'] as $key => $val){
	if($val['field_type'] == 'main'){
		if($val['code'] == 'metakeys' || $val['code'] == 'keywords' || $val['code'] == 'index' || $val['code'] == 'metakeys'){
			$val['value'] = $data['VALUES'][0][$val['code']]; 
			$val['code'] = 'main['. $val['code'] .']';
			$seo[$key] = $val;
		} else if($val['code'] == 'name' || $val['code'] == 'model' || $val['code'] == 'title' || $val['code'] == 'active' || $val['code'] == 'alias' || $val['code'] == 'fields' || $val['code'] == 'active_from' || $val['code'] == 'active_to' || $val['code'] == 'user' || $val['code'] == 'first_name' || $val['code'] == 'last_name' || $val['code'] == 'middle_name' || $val['code'] == 'login' || $val['code'] == 'active' || $val['code'] == 'status' || $val['code'] == 'email' || $val['code'] == 'phone' || $val['code'] == 'site' || $val['code'] == 'group' || $val['code'] == 'active' || $val['code'] == 'list_limit' || $val['code'] == 'parent' || $val['code'] == 'cat' || $val['code'] == 'desc' || $val['code'] == 'preview_desc' || $val['code'] == 'desc'){
			if($val['code'] == 'page_id'){
				$val['value'] =  Element::GetByID($_GET['model'], 'id', 'pages');
			} else {
				$val['value']= $data['VALUES'][0][$val['code']];
			}
			$val['code'] = 'main['. $val['code'] .']';
			$base[$key] = $val;
		} else if($val['code'] == 'menu_active' || $val['code'] == 'menu_type' || $val['code'] == 'menu_name'){
			$val['value'] = $data['VALUES'][0][$val['code']];
			$val['code'] = 'main['. $val['code'] .']';
			$menu[$key] = $val;
		} else if($val['code'] == 'temp' || $val['code'] == 'temp_folder' || $val['code'] == 'template_type' || $val['code'] == 'content_type' || $val['code'] == 'content_temp' || $val['code'] == 'parent_temp' || $val['code'] == 'child_temp' || $val['code'] == 'temp_folder'){
			$val['value'] = $data['VALUES'][0][$val['code']];
			$val['code'] = 'main['. $val['code'] .']';
			$shablon[$key] = $val;
		} else if(($val['code'] == 'permission')){
			$val['value'] = $data['VALUES'][0][$val['code']];
			$val['code'] = 'main['. $val['code'] .']';
			$perm[$key] = $val;
		} else if($val['code'] == 'modules'){
			$val['value'] = $data['VALUES'][0][$val['code']];
			$val['code'] = 'main['. $val['code'] .']';
			$modules[$key] = $val;
		}
		// else if(){
			// $val['value'] = $data['VALUES'][0][$val['code']];
			// $val['code'] = 'main['. $val['code'] .']';
			// $desc[$key] = $val;
		// }
		// else if($val['code'] == 'parent' || $val['code'] == 'cat'){
			// $val['value'] = $data['VALUES'][0][$val['code']];
			// $val['code'] = 'main['. $val['code'] .']';
			// $parent[$key] = $val;
		// }
	} else {
		$params = array('element_id' => $routes[4], 'code' => $val['code']);
		$field_value = Element::GetFeildsValues($params, null, 'field_value');
		
		$val['value'] = $field_value[0]['value']; 
		$val['code'] = 'alter['. $val['code'] .']';
		$base[$key] = $val;
	}
}
?>

					<?if(isset($_GET['phrase']) && !empty($_GET['phrase'])){?>
						<h3><?=$_GET['phrase']?></h3>
					<?}?>
	
	<form action="" method="POST" class="form" enctype=multipart/form-data>
		<input type="hidden" name="action" value="<?=($routes[3] == 'edit') ? 'update_data' : 'save_data'?>" />
		<input type="hidden" name="module" value="form" /> 
		<?if($routes[1] == 'administrator' && $routes[2] == 'content'){
			$iblock_name = $routes[2];
		?>
		<input type="hidden" name="iblock_name" value="<?=$iblock_name?>" />
		<?
		} else if($routes[1] == 'administrator' && $routes[2] == 'cats'){
			$iblock_name = $routes[2];
		?>
		<input type="hidden" name="iblock_name" value="<?=$iblock_name?>" />
		<?	
		} else if($routes[1] == 'administrator' && $routes[2] == 'pages'){
			$iblock_name = $routes[2];
		?>
		<input type="hidden" name="iblock_name" value="<?=$iblock_name?>" />
		<?	
		} else {
			if(is_numeric($routes[4])){
				$id = $routes[4];
				$con_info = Element::GetByID($id,null,'content');
				
				$iblock_name = $con_info['page_id'];
				
			} else {
				if(is_numeric($routes[3])){
					$id = $routes[3];
					$con_info = Element::GetByID($id,null,'content');
					
					$iblock_name = $con_info['page_id'];
				} else {
					$iblock_name = $routes[1];
				}
			}
			
		?>
		<input type="hidden" name="main[page_id]" value="<?=$iblock_name?>" />
		<? } ?>
		
		<div id="tab-container">
			<ul>
	
			<?if(isset($base) && count($base) > 0){?>
				<li><a href="#tab-base">Общие настройки</a></li>
			<? } ?>
			<?if(isset($seo) && count($seo) > 0){?>
				<li><a href="#tab-seo">SEO</a></li>
			<? } ?>
			<?if(isset($shablon) && count($shablon) > 0){?>
				<li><a href="#tab-shablon">Шаблоны</a></li>
			<? } ?>
			<?if(isset($desc) && count($desc) > 0){?>
				<li><a href="#tab-desc">Детальная</a></li>
			<? } ?>
			<?if(isset($menu) && count($menu) > 0){?>
				<li><a href="#tab-menu">Настройки меню</a></li>
			<? } ?>
			<?if(isset($perm) && count($perm) > 0){?>
				<li><a href="#tab-perm">Настройки доступа</a></li>
			<? } ?>
			<?if(isset($modules) && count($modules) > 0){?>
				<li><a href="#tab-modules">Модули</a></li>
			<? } ?>
			<?if($iblock_name == 'pages'){?>
				<li><a href="#tab-alter">Свойства</a></li>
			<? } ?>
			<?if(isset($parent) && count($parent) > 0){?>
				<li><a href="#tab-parent">Категории</a></li>
			<? } ?>
			</ul>
			
			<?if(isset($base) && count($base) > 0){?>
			<div id="tab-base" class="container-block">
				<table>
				<? foreach($base as $key => $val){ ?>
					<? if($val['input_type'] != 'hidden'){
						
						
					?>
						<tr>
							<td class="input-label">
								<?=($val['required'] == 'Y') ? '*' : '' ?> <?=$val['name']?>
							</td>
							<td class="input-content">
								<?=Element::inputShow($val)?>
							</td>
						</tr>
					<? } else { ?>
						<?=Element::inputShow($val)?>
					<? } ?>
				<? } ?>	
				
				</table>
				<div class="submit">
					<input class="section-btn send" type="submit" name="send" value="Сохранить"/> 
				</div>
			</div>
			<? } ?>
			<?if(isset($seo) && count($seo) > 0){?>
			<div id="tab-seo" class="container-block">
				<table>
				<? foreach($seo as $key => $val){ ?>
					<? if($val['input_type'] != 'hidden'){?>
						<tr>
							<td class="input-label">
								<?=($val['required'] == 'Y') ? '*' : '' ?> <?=$val['name']?>
							</td>
							<td class="input-content">
								<?=Element::inputShow($val)?>
							</td>
						</tr>
					<? } else { ?>
						<?=Element::inputShow($val)?>
					<? } ?>
				<? } ?>	
				</table>	
				<div class="submit">
					<input class="section-btn send" type="submit" name="send" value="Сохранить"/> 
				</div>				
			</div>
			<? } ?>
			<?if(isset($shablon) && count($shablon) > 0){?>
			<div id="tab-shablon" class="container-block">
				<table>
				<? foreach($shablon as $key => $val){ ?>
					<? if($val['input_type'] != 'hidden'){?>
						<tr>
							<td class="input-label">
								<?=($val['required'] == 'Y') ? '*' : '' ?> <?=$val['name']?>
							</td>
							<td class="input-content">
								<?=Element::inputShow($val)?>
							</td>
						</tr>
					<? } else { ?>
						<?=Element::inputShow($val)?>
					<? } ?>	
				<? } ?>	
				</table>
				<div class="submit">
					<input class="section-btn send" type="submit" name="send" value="Сохранить"/> 
				</div>
			</div>
			<? } ?>
			<?if(isset($desc) && count($desc) > 0){?>
			<div id="tab-desc" class="container-block">
				<table>
				<? foreach($desc as $key => $val){ ?>
					<? if($val['input_type'] != 'hidden'){?>
						<tr>
							<td class="input-label">
								<?=($val['required'] == 'Y') ? '*' : '' ?> <?=$val['name']?>
							</td>
							<td class="input-content">
								<?=Element::inputShow($val)?>
							</td>
						</tr>
					<? } else { ?>
						<?=Element::inputShow($val)?>
					<? } ?>	
				<? } ?>
				</table>
				<div class="submit">
					<input class="section-btn send" type="submit" name="send" value="Сохранить"/> 
				</div>
			</div>
			<? } ?>
			<?if(isset($menu) && count($menu) > 0){?>
			<div id="tab-menu" class="container-block">
				<table>
				<? foreach($menu as $key => $val){ ?>
					<? if($val['input_type'] != 'hidden'){ 
					
						if($val['code'] == 'main[menu_type]'){
							$params = array("type" => "menu");
							$array = DBConnect::init()->getMemu(null, $params, $table="modules");
							
							$names = "";
							$values = "";
							foreach($array as $cur => $val_menu){
								$names .= ",". $val_menu['name'];
								$values .= ",". $val_menu['pos'];
							}
							$val['default_value'] = $values;
							$val['default_names'] = $names;
							
						}
					?>
						<tr>
							<td class="input-label">
								<?=($val['required'] == 'Y') ? '*' : '' ?> <?=$val['name']?>
							</td>
							<td class="input-content">
								<?=Element::inputShow($val)?>
							</td>
						</tr>
					<? } else { ?>
						<?=Element::inputShow($val)?>
					<? } ?>
				<? } ?>	
				</table>
				<div class="submit">
					<input class="section-btn send" type="submit" name="send" value="Сохранить"/> 
				</div>
			</div>
			<? } ?>
			<?if(isset($perm) && count($perm) > 0){?>
			<div id="tab-perm" class="container-block">
				<table>
				<? foreach($perm as $key => $val){ ?>
					<? if($val['input_type'] != 'hidden'){?>
						<tr>
							<td class="input-label">
								<?=($val['required'] == 'Y') ? '*' : '' ?> <?=$val['name']?>
							</td>
							<td class="input-content">
								<?=Element::inputShow($val)?>
							</td>
						</tr>
					<? } else { ?>
						<?=Element::inputShow($val)?>
					<? } ?>	
				<? } ?>	
				</table>
				<div class="submit">
					<input class="section-btn send" type="submit" name="send" value="Сохранить"/> 
				</div>
			</div>
			<? } ?>
			<?if(isset($modules) && count($modules) > 0){?>
			<div id="tab-modules" class="container-block">
				<table>
				<? foreach($modules as $key => $val){ ?>
					<? if($val['input_type'] != 'hidden'){?>
						<tr>
							<td class="input-label">
								<?=($val['required'] == 'Y') ? '*' : '' ?> <?=$val['name']?>
							</td>
							<td class="input-content">
								<?=Element::inputShow($val)?>
							</td>
						</tr>
					<? } else { ?>
						<?=Element::inputShow($val)?>
					<? } ?>	
				<? } ?>
				</table>
				<div class="submit">
					<input class="section-btn send" type="submit" name="send" value="Сохранить"/> 
				</div>
			</div>
			<? } ?>
			<?if(isset($parent) && count($parent) > 0){?>
			<div id="tab-parent" class="container-block">
				<table>
				<? foreach($parent as $key => $val){ ?>
					<? if($val['input_type'] != 'hidden'){?>
						<tr>
							<td class="input-label">
								<?=($val['required'] == 'Y') ? '*' : '' ?> <?=$val['name']?>
							</td>
							<td class="input-content">
								<?=Element::inputShow($val)?>
							</td>
						</tr>
					<? } else { ?>
						<?=Element::inputShow($val)?>
					<? } ?>	
				<? } ?>
				</table>
				<div class="submit">
					<input class="section-btn send" type="submit" name="send" value="Сохранить"/> 
				</div>
			</div>
			<? } ?>
			
	</form>
	<?if($iblock_name == 'pages'){?>
			<div id="tab-alter" class="container-block" style="background: none !important;">
			
			<?
			$params = array("type" => $page['name']);
			$sort = array("sort", "asc");
			$data['alter'] = DBConnect::init()->getFeilds($params, $sort);
			?>
			
				<div class="left">
				<form id="alter-fields" method="POST" type="">
				<input type="hidden" name="action" value="save_fields" />
				<input type="hidden" name="module" value="form" /> 
				<input type="hidden" name="page_id" value="<?=$page['name']?>" />
				<input type="hidden" name="iblock" value="content" />
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
						<span class="new-field">добавить</span>
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
			</div>
	<? } ?>
		</div>
		
