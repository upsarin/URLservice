<style>
.busket a#busketPlace{
	display: none !important;
}
</style>
			<div class="sicky-wrapper-free-space"></div>
				<div class="container main-block" id="joinOurTeamFull" style="margin-bottom:0;min-height: 550px;">
				<? if($_GET['phrase'] && !empty($_GET['phrase'])){ ?>
					<h3>Корзина</h3>
					<p><?=$_GET['phrase']?>
				
				<?} else if(count($_SESSION['user']['busket'])>0) { ?>
					<h2><?=$array["title"]?></h2>
					
					
					<div class="busket-wrapper">
						<table>
						<tr>
							<th></th>
							<th></th>
							<th>Название</th>
							
							<th>Цена</th>
							<th>Количество</th>
							
						</tr>
							<?foreach($_SESSION['user']['busket'] as $key => $val){?>
							<?
								$element = Element::GetByID($val['id'], $return=null, "content");
								
								$filter = array("content_id" => $element['id']);
								$images = Element::SelectAll('files', $filter, null, null);
							?>
							
								<tr id="element<?=$key?>">
									<td>
										<a href="" id="<?=$key?>" class="deleteElement">удалить</a>
									</td>
									<td><img src="<?=($images[0]['path'] != "") ? "/". $images[0]['path'] : "/images/nophoto.png"?>"/></td>
									<td id="name<?=$key?>"><?=$element['name']?></td>
									
									<td><?=$val['price']?> руб.</td>
									<td><input id="<?=$key?>" class="elementcount" type"text" name="count<?=$key?>" value="<?=$val['count']?>" style="width: 100px;"/></td>
									
								</tr>
							<? } ?>
						</table>
					</div>
					<div class="userInfo">
						<form class="userInfoForm">
							<table>
								<tr>
									<td></td>
									<td class="error"></td>
									
								</tr>
								<tr>
									<td>Адрес доставки:</td>
									<td><input id="userAdress" type="text" name="user_adress" value="" required="required" /></td>
								</tr>
								<tr>
									<td>Имя:</td>
									<td><input id="userName" type="text" name="user_name" value="" required="required" /></td>
								</tr>
								<tr>
									<td>Контактный телефон:</td>
									<td><input id="userPhone" type="text" name="user_phone" value="" required="required" /></td>
								</tr>
							</table>
							<div class="busket-summ">
								Итого: <span id="busketPlaceSumm" style="color:#6ab42f;font-weight: bold;"><?=$_SESSION['user']['summ']?> руб. </span> <input type="submit" id="getElements" value="Оформить заказ" />
							</div>
						</form>
					</div>
					<?if(isset($array["content"]) && !empty($array["content"])) {
						include $html_temp;
					} else if($array["action"] == "create") { ?>
						<div class="add_form">
							<?=minc::pos("form", $array["name"])?>
						</div>	
					<? } ?>
				<? } else { ?>
					<h3>Корзина</h3>
					<p>Выбраных товаров нет!</p>
				<? } ?>
				</div>
	<script>
		
		
		jQuery('.elementcount').blur(function(){
			var id = this.id;
			var count = this.value;
			console.log(id + " | " + count);
			console.log(count);
			var data = "id=" + id + "&count=" + count;
				jQuery.ajax({
					url: "/ajax/busket_update.php",
					type: "POST",
					data: data,
					success: function(html){
						jQuery('#busketPlaceSumm').html(html);
					}
				});
		});
		jQuery('.deleteElement').click(function(){
			var id = this.id;
			
			var data = "id=" + id;
				jQuery.ajax({
					url: "/ajax/busket_delete.php",
					type: "POST",
					data: data,
					success: function(html){
						jQuery('#element' + id).css('display', 'none');
						console.log(jQuery('#element' + id));
						jQuery('#busketPlaceSumm').html(html);
					}
				});
			return false;
		});
		jQuery('#getElements').click(function(){
			var adress = jQuery('#userAdress').val();
			var name = jQuery('#userName').val();
			var phone = jQuery('#userPhone').val();
			if(adress == ""){
				jQuery('.error').html("Заполните адрес");
			} else if(name == ""){
				jQuery('.error').html("Заполните имя");
			}else if( phone == ""){
				jQuery('.error').html("Заполните телефон");
			} else {
				var data = jQuery('.userInfoForm').serialize();
				console.log(data);
				jQuery.ajax({
					url: "/ajax/busket_submit.php",
					type: "POST",
					data: data,
					success: function(html){
						console.log(html)
						jQuery('.busket-wrapper').html(html);
						jQuery('.userInfo').css('display', 'none');
					}
				});
			}
			
			return false;
		});
	</script>
	
				