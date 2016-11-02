<?if(isset($array['content'])){?>
<style>
.box-top {
  min-height: 700px;
}
.fotorama {
	border: 3px solid #6ab42f;
    border-radius: 10px;
}
</style>		
	<?=minc::pos("breadcrumbs", $array["name"])?>			
	<div class="elementsNews">
	<?
			$filter = array("content_id" => $array['content'][0]);
			$images = Element::SelectAll('files', $filter, null, null);
			$filter = array("alias" => $array['content'][0]['alias']);
			$double_el = Element::SelectAll('content', $filter, null, null);
			
				
				foreach($double_el as $d_key => $d_val){
					
						if(count($images)>0 || $d_val['id'] == $array['content'][0]['id']){
							
						} else {
							
							$where = array('id' => $d_val['id']);
							$table = 'content'; 
							Element::Delete($where, $table);
							unset($array['content'][$d_key]);
						}
					
				}
	?>
	<!--<h3>Стандартный шаблон движка страницы деталей</h3>-->
	<?foreach($array['content'] as $key => $element){?>
			
			<?
			$filter = array("content_id" => $element['id']);
			$images = Element::SelectAll('files', $filter, null, null);
			?>
					<div class="col-md-3 box-top">
						<style>
						.fotorama__img {
							margin: 0 auto;
						}
						</style>
							<div class="detailmages">
								<?if(count($images) > 0){?>
								<div class="fotorama" data-nav="thumbs" data-height="500" data-maxHeight="500" data-minWidht="200">
									<?foreach($images as $key => $val){?>
										<a href="/<?=$val['path']?>">
											<img src="<?=$val['id']?>_thumb.jpg" style=""/> 
										</a>
									<? } ?>
								</div>	
								<? } else { ?>
									
										<img src="/images/nophoto.png"/>
									
								
								
								<? } ?>
							</div>
							<div class="detailContent">
							<a href="<?=$_SERVER['HTTP_REFERER']?>">вернуться на страницу каталога</a>
								
								<p  style="text-align: left">
									<span style="color: #6ab42f; font-weight: bold;">Цена:</span> <?=$element['price']?> руб.
									
									
								<form action = "" method = "POST" class="buyItemForm<?=$key?>">
									<input type="hidden" name="id" value="<?=$element['id']?>" />
									<input type="hidden" name="price" value="<?=$element['price']?>" />
									<input type="text" name="count" value="1" style="float: left; width: 70px;text-align: left;"/>
									
									<a style="float: left;margin: 6px 20px;" href="/<?=$array['alias']?>/detail/<?=$element['alias']?>/" class="readmore buyItem">Купить</a>
									
								</form>
								
								</p>
								 <br />
								 <br />
								 <br />
								<div style="text-align: left; font-family: Open Sans, sans-serif !important;">
									<span style="color: #6ab42f; font-weight: bold;">Описание:</span> <?=$element['desc']?>
								</div>
								<br />
								
								<p style="text-align: left">
									<span style="color: #6ab42f; font-weight: bold;">Состав:</span> <?=$element['consist']?>
								</p>
								<? if($element['edate'] != 0) { ?>
									<p style="text-align: left">
										<span style="color: #6ab42f; font-weight: bold;">Срок годности:</span> <?=$element['edate']?> месяц(а)
									</p>
								<? } ?>
								
								
								
							</div>
						
					</div>
					
		<script>
	jQuery(document).ready(function(){
			
		
		jQuery('.buyItem').click(function(){
			var data = jQuery('.buyItemForm0').serialize();
			
			var price = jQuery('.buyItemForm input[name="price"]').val();
			var count = jQuery('.buyItemForm input[name="count"]').val();
			
			
			jQuery.ajax({
			  url: "/ajax/busket_add.php",
			  type: "POST",
			  data: data,
			  success: function(html){
					console.log(html);
					jQuery('#busketSum').html(html + " руб.");
					jQuery('#busketPlace').css('display', 'block');
			  }
			});
			return false;
		});
	});
		</script>
	<? } ?>
	</div>
<? } ?>
