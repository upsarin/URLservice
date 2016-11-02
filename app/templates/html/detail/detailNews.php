<?if(isset($array['content'])){?>
		
		
	
	<div class="elementsNews">
	<?foreach($array['content'] as $element){?>
	
		<div class="elementNews">
			<h1><?=$element['name']?></h1>
			<div class="element_content">
			<?=$element['desc']?>
			</div>
		</div>
	<? } ?>
	</div>
<? } ?>
