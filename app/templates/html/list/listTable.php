<span style="background: red;">
	процесс
</span>
<span style="background: green;">
	сделано
</span>
<span style="background: grey;">
	вопросы
</span>
<?if(isset($array['content'])){?>
	<div class="elementsNews">
	<?foreach($array['content']['content'] as $element){?>
		<?if($element['status'] == 'in_work'){ 
			$status	= "work-status";
		} else if($element['status'] == 'done') {
			$status	= "done-status";
		} else if($element['status'] == 'questions') {
			$status	= "questions-status";
		} ?>
		<div class="elementNews <?=$status?>">
			<div class="element_title">
				<a href="/<?=$array['alias']?>/detail/<?=$element['alias']?>/"><?=$element['title']?></a>
			</div> 
			<div class="element_content">
				<?=$element['preview_desc']?>
			</div>
			
			<div class="element_footer">
				<a href="/<?=$array['alias']?>/edit/<?=$element['id']?>/">Редактировать</a>
				<a href="/maqetta/cmd/configProject?configOnly=true&project=<?=$element['alias']?>">Войти в прототип</a>
			</div>
		</div>
	<? } ?>
	</div>
<? } ?>