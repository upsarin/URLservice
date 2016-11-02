<?
//data - содержит данные
//array - содержит инфо модуля
//page - содержит id текущей страницы (полезно для менюх)
?>


<ul class="lk-nav">
						
						<li style="background:url(/images/gallery/protobox.png) no-repeat center"><a href="/">&nbsp;</a></li>
                    
					
						<li class=""><a id="link-logout" href="/logout/">Выход</a></li>
						
					  
</ul>

<ul class="lk-nav">
	<?$page_info = Element::Page(NULL, $page); ?>
	<li class="active"><a class="lk-active" href="#"><?=$page_info['title']?></a></li>
	
</ul>
