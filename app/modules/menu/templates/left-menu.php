<?
//data - содержит данные
//array - содержит инфо модуля
//page - содержит id текущей страницы (полезно для менюх)
?>

<div class="left-menu">
	<ul>
	<?foreach($data as $key => $val){ ?>
		<li><a href="/personal/<?=$val['alias']?>/"><?=$val['menu_name']?></a><?=($val['id'] != 20) ? ' | <a href="/personal/'. $val["alias"] .'/create/">новый</a>' : ''?></li>
	<? } ?>
	</ul>
</div>
<?//if(isset($array['chain_modules']) && (count($array['chain_modules']) > 0)){?>
	<?//foreach($array['chain_modules'] as $key => $val){?>
		<?//=minc::pos($val['pos'], $array['id'])?> 
	<?// } ?>
<?// } ?>