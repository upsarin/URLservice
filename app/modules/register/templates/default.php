<?
//data - содержит данные
//array - содержит инфо модуля
//page - содержит id текущей страницы (полезно для менюх)
?>

<style>
select{
    width: 236px;
    border-radius: 5px 0px 0px 5px;
    height: 34px;
	color: orange;
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
</style>
<h5 style="text-align: center; color: orange; font-size: 20px; font-weight: bold;">30 дней после регистрации 100% бесплатно</h5>

					
					<form action="" method="POST" class="form" style="width: 500px; margin: 0px auto;">
						<input type="hidden" name="action" value="save_register" />
						<input type="hidden" name="module" value="register" />
						<? foreach($data as $key => $val){ ?>
							<?$val['code'] = $val['field_type'] .'['. $val['code'] .']';?>
							<? if($val['input_type'] != "checkbox" && $val['input_type'] != "select" && $val['input_type'] != "radio"){ ?>
								<? if($val['code'] == "last_name" || $val['code'] == "first_name" || $val['code'] == "middle_name"){ ?>
									<span class="contact-label"><?=substr($val['name'], 0, 2)?>.</span>
									<input class="half-input" type="<?=$val['input_type']?>" name="<?=$val['code']?>" value="" <?=($val['required'] == "Y") ? "required" : ""?> placeholder = "<?=$val['name']?>"/>
								<? } else { ?>
								<div class="input-group" style="width: 450px;padding-left: 15px; margin-bottom: 5px;">
								  <input class="form-control" type="<?=$val['input_type']?>" name="<?=$val['code']?>" value="" <?=($val['required'] == "Y") ? "required" : ""?>/>
								  <span class="input-group-btn" style="<?=($val['required'] == "Y") ? "background-color: orange;" : "background-color: #3cec3c"?>">
									<?=($val['required'] == "Y") ? "*" : ""?> <?=ucfirst($val['name'])?>
								  </span>
								</div>
									
									
								<? } ?>
							<? } else { ?>
								<div class="input-group" style="width: 450px;padding-left: 15px; margin-bottom: 5px;">
								  <?=Element::inputShow($val)?>
								  <span class="input-group-btn" style="<?=($val['required'] == "Y") ? "background-color: orange;" : "background-color: #3cec3c"?>">
									<?=($val['required'] == "Y") ? "*" : ""?> <?=ucfirst($val['name'])?>
								  </span>
								</div>
								
							<? } ?>
						<? } ?>
						<br />
						<input class="btn btn-default main-search" type="submit" name="send" value="Зарегистрироваться" style="color: black"/> 
                    </form>
