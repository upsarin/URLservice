<?if(isset($array['content'])){?>
	
	<div class="elementsNews">
	<?foreach($array['content']['content'] as $element){?>
		<div class="elementNews">
			
			<h4 class="element_title"><a class="tomaqetta" href="/maqetta/cmd/configProject?configOnly=true&project=<?=$element['alias']?>"><?=$element['title']?></a></h4> 
			<div class="element_img">
				<img src="/images/no-photo.png" /> 
			</div>
			<div class="status">
				прототипирование
			</div>
			<div class="element_content">
			<?=$element['preview_desc']?>  
			</div>
			<div class="controls">
				
				
					<ul>
						<li class="round"><a href="#" class="round_a" title="title1" alt="alt1"></a></li>
						<li class="round"><a href="#" class="round_a" title="title2" alt="alt2"></a></li>
						<li class="round"><a href="#" class="round_a" title="title3" alt="alt3"></a></li>
						<li class="round"><a href="#" class="round_a" title="title4" alt="alt4"></a></li>
						<li data-id="<?=$element['id']?>" class="round del"><a href="#" class="round_a" title="title5" alt="alt5"></a></li>
					</ul>
				
			</div> 
			<div class="element_btn_create">
				<a href="/<?=$array['alias']?>/edit/<?=$element['id']?>/">Редактировать</a>
			</div> 
		</div>
	<? } ?>
						
		<div class="elementNews">
			<h4 class="element_title"></h4>
			<div class="element_img">
				<a href="/personal/<?=$array['model']?>/create/"><img src="/images/no-photo.png" /> </a>
			</div>
			<div class="status">
				
			</div>
			<div class="element_content">
				
			</div>
			<div class="controls">
			
			</div>
			<div class="element_btn_create">
				
			</div>
		</div>
		
	</div>
<? } ?>

<script>
	$('.tomaqetta').click(function(){
		
		var mypostrequest = new XMLHttpRequest();
		mypostrequest.onreadystatechange = function() {
			if (mypostrequest.readyState === 4) {
				if (mypostrequest.status !== 200 && window.location.href.indexOf("http") !== -1) {
					var responseObject = JSON.parse(mypostrequest.responseText);
					showErrorMessage(responseObject.error);
					window.location = $('.tomaqetta').attr('href');
				} else {
					window.location = $('.tomaqetta').attr('href');
				}
			}
		};

		var parameters = "email="+encodeURIComponent('<?=$_SESSION['user']['email']?>')+"&password="+encodeURIComponent('<?=$_SESSION['user']['password']?>');
		mypostrequest.open("POST", "http://protobox.ru/login/form", true);
		mypostrequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		mypostrequest.setRequestHeader("Orion-Version", "1");
		mypostrequest.send(parameters);
		return false;
	});
</script>