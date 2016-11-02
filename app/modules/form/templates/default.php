<?
//data - содержит данные
//array - содержит инфо модуля
//page - содержит id текущей страницы (полезно для менюх)
?>
<style>
select{
    width: 335px;
    border-radius: 5px 0px 0px 5px;
    height: 34px;
	color: black;
}
.form-control {
	width: 300px;
}
.main-search {
	width: 200px;
	font-weight: bold;
	color: white;
}
.input-group-btn {
	width: 200px;
    color: white;
	font-size: 15px;
}
textarea {
	color: black;
}
#list img {
	    width: 50px;
}
#list {
	list-style: none;
}
</style>
<?
$page_id = Element::Page($page);
?>

					<h2>Создание короткой ссылки</h3>
					<?if(isset($_GET['phrase']) && !empty($_GET['phrase'])){?>
						<h3><?=$_GET['phrase']?></h3>
					<?}?>
					
					<form action="" method="POST" class="form" enctype=multipart/form-data>
						
						
						
						<? foreach($data['FIELDS'] as $key => $val){ ?>
							<? if($val['siteview'] == "N"){
								$data['FIELDS'][$key]['input_type'] = 'hidden';
								$val['input_type'] = 'hidden';
							} 
							if($val['code'] == "phone"){
								$val['default_value'] = $_SESSION['user']['phone'];
							} else if($val['code'] == "email"){
								$val['default_value'] = $_SESSION['user']['email'];
							}
							$val['code'] = $val['field_type'] .'['. $val['code'] .']';
							?>
							
							
								<?if($val['input_type'] != 'hidden'){ ?>
									<div class="input-group" style="width: 548px;padding-left: 15px; margin-bottom: 5px;">
									  <?=Element::inputShow($val)?>
									  <span class="input-group-btn" style="<?=($val['required'] == "Y") ? "background-color: orange;" : "background-color: #3cec3c"?>">
										<?=($val['required'] == "Y") ? "*" : ""?> <?=ucfirst($val['name'])?>
									  </span>
									</div>
								<? } else { ?>
									<?=Element::inputShow($val)?>
								<? } ?>
							
						<? } ?>
						
						<input type="hidden" name="main[cat]" value="<?=$_SESSION['user']['exe_cat']["value"]?>" />
						<input type="hidden" name="action" value="<?=$data['action']?>" />
						<input type="hidden" name="module" value="form" /> 
						<input type="hidden" name="main[page_id]" value="<?=$page_id['id']?>" />
						<div class="submit">
							<input class="btn btn-default main-search" type="submit" name="send" value="Сохранить" style="color: black"/> 
						</div>
                    </form>
<script>
	$(document).ready(function(){
		
	});
</script>