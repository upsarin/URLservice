<?
//data - содержит данные
//array - содержит инфо модуля
//page - содержит id текущей страницы (полезно для менюх)
?>				
				
				
					<?if(isset($_GET['phrase']) && !empty($_GET['phrase'])){?>
						<h3 style="width: 420px; text-align: right;margin-top: 50px;"><?=$_GET['phrase']?></h3>
					<?}?>
					
					<form action="" method="POST" class="form" enctype=multipart/form-data id="shortlinkForm">
						
						<table>
						
						<? foreach($data['FIELDS'] as $key => $val){ ?>
							<? if($val['siteview'] == "N"){
								$data['FIELDS'][$key]['input_type'] = 'hidden';
								$val['input_type'] = 'hidden';
							} 
							$val['code'] = $val['field_type'] .'['. $val['code'] .']';
							?>
							
							<tr>
								<?if($val['input_type'] != 'hidden'){ ?>
								<td>
									<?=$val['name']?>
								</td>
								<? } ?>
								<td>
									<?=Element::inputShow($val)?>
								</td>
							</tr>
						<? } ?>
						</table>
						
						<input type="hidden" name="action" value="save_data" />
						<input type="hidden" name="module" value="shortlink" /> 
						<input type="hidden" name="iblock_name" value="shortlink" />
						<div class="submit" style="  width: 150px;
  float: right;
  position: relative;
  top: -40px;
  left: -60px;">
							<input class="btn btn-lg btn-default orange-back" type="submit" name="send" value="Укоротить"style=""/> 
						</div>
                    </form>

					
		<div class="link_list" style="  margin-top: 100px;">
		<h3>Список сгенерированных ссылок</h3>
			<ul style="list-style:none; text-align: left;  overflow-y: auto; height: 200px;" id="linkList">
				<?if(count($data['content']['content']) > 0){ ?>
					<?foreach($data['content']['content'] as $key => $val){ ?>
						<li>
							<a href="<?=$val['orig_url']?>" id="<?=$val['id']?>" target="_blank"><i class="glyphicon glyphicon-share"></i></a>  <?=$val['edit_url']?>
						</li>
					<? } ?>
				<? } else { ?>
						<li id="noResult">Нет ссылок</li>
				<? } ?>
			</ul>
		</div>