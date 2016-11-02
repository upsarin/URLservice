<?
//data - содержит данные
//array - содержит инфо модуля
//page - содержит id текущей страницы (полезно для менюх) , но в этом шаблоне приходит не id а name страницы
?>

					<?if(isset($_GET['phrase']) && !empty($_GET['phrase'])) { ?>
						<h3><?=$_GET['phrase']?></h3>
					<? } ?>
<?$routes = explode('/', $_SERVER['REQUEST_URI']);?>
<?if(isset($routes[4]) && is_numeric($routes[4])) {
	$page = Element::Page(null, $routes[4]);
	$params = array("type" => "base_fields", "active" => "Y");
	$sort = array("sort", "asc");
	$data['FIELDS'] = DBConnect::init()->getFeilds($params, $sort);
} ?>

					<form action="" method="POST" class="form" enctype=multipart/form-data>
						<input type="hidden" name="action" value="save_data" />
						<input type="hidden" name="module" value="form" />
						<input type="hidden" name="page_id" value="<?=$page['name']?>" />
						<table>
						<?foreach($data['FIELDS'] as $key => $val){?>
						<tr>
							<td class="input-label">
								<?=($val['required'] == 'Y') ? '*' : '' ?> <?=$val['name']?>
							</td>
							<td class="input-content">
								<?=Element::inputShow($val)?>
							</td>
						</tr>
						<? } ?>
						</table>
						<div class="submit">
							<input class="section-btn send" type="submit" name="send" value="Сохранить"/> 
						</div>
                    </form>
