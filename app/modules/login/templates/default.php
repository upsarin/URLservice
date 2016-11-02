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

					
					<form action="/login/" method="POST" class="form" id="login" style="width: 500px; margin: 0px auto;">
						<input type="hidden" name="action" value="login_user" />
						<input type="hidden" name="module" value="login" />
						<? foreach($data as $key => $val){ ?>
								<div class="input-group" style="width: 450px;padding-left: 15px; margin-bottom: 5px;">
								  <input class="form-control" type="<?=$val['input_type']?>" name="<?=$val['code']?>" value="" <?=($val['required'] == "Y") ? "required" : ""?>/>
								  <span class="input-group-btn" style="<?=($val['required'] == "Y") ? "background-color: orange;" : "background-color: #3cec3c"?>">
									<?=($val['required'] == "Y") ? "*" : ""?> <?=ucfirst($val['name'])?>
								  </span>
								</div>
							
						<? } ?>
						<br />
						<input class="btn btn-default main-search" type="submit" name="send" value="войти" style="color: black"/>
                    </form>
