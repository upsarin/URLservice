
<ul>
<div class="title"><?=$array['name']?></div>
<?foreach($data as $key => $val){ ?>
	<li><a href="/personal/<?=$val['alias']?>/"><?=$val['menu_name']?></a></li>
<? } ?>
</ul>