<?
//data - содержит данные
//array - содержит инфо модуля
//page - содержит id текущей страницы (полезно для менюх)
?>
<script type="text/javascript"> 
  $(document).ready(function(){ $('#tab-container').easytabs(); });
</script> 

<h3><?=(isset($data['VALUES'][0]['id'])) ? "Настройка элемента ID". $data['VALUES'][0]['id'] : "Создание нового элемента"?></h3>


<?$routes = explode('/', $_SERVER['REQUEST_URI']);?>
<?
		$page = Element::Page(null, $routes[4]);
		
foreach($data['FIELDS'] as $key => $val){
	if($val['field_type'] == 'main'){
		if($val['input_type'] == 'password'){
			$val['input_type'] = 'text';
			$val['code'] = 'password_new';
		}
		if($val['input_type'] == 'check_password'){
			$val['input_type'] = 'text';
			$val['code'] = 'check_password_new';
		}
		$val['value']= $data['VALUES'][0][$val['code']];
		$val['code'] = 'main['. $val['code'] .']';
		$base[$key] = $val;
	} else {
		$params = array('element_id' => $routes[4], 'code' => $val['code'], "iblock" => 'users');
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
		<input type="hidden" name="action" value="<?=($routes[3] == 'edit') ? 'update_user' : 'save_user'?>" />
		<input type="hidden" name="module" value="form" /> 
		<input type="hidden" name="iblock_name" value="users" />
		
		
		
		<div id="tab-container">
			<ul>
	
			<?if(isset($base) && count($base) > 0){?>
				<li><a href="#tab-base">Общие сведения</a></li>
			<? } ?>
			
		
			<li><a href="#tab-base">Модули</a></li>
			
			
			<?if(isset($alter) && count($alter) > 0){?>
				<li><a href="#tab-alter">Доп поля пользователей</a></li>
			<? } ?>
			</ul>
			
			<?if(isset($base) && count($base) > 0){?>
			<div id="tab-base" class="container-block">
				<table>
				<? foreach($base as $key => $val){ ?>
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
			
			
	</form>
	
		</div>
		
