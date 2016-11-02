<html>
<head>
<title><?=$array['title']?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
	
	<link rel="stylesheet" type="text/css"  href="/css/style-admin.css">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script async="" src="/js/jscript.js"></script>
	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
	
	<script>
tinymce.init({
  selector: 'textarea.desc',
  toolbar: 'fontsizeselect',
  fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt',
  height: 500,
  theme: 'modern',
  plugins: [
    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
    'searchreplace wordcount visualblocks visualchars code fullscreen',
    'insertdatetime media nonbreaking save table contextmenu directionality',
    'emoticons template paste textcolor colorpicker textpattern imagetools'
  ],
  toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
  toolbar2: 'print preview media | forecolor backcolor emoticons',
  image_advtab: true,
  templates: [
    { title: 'Test template 1', content: 'Test 1' },
    { title: 'Test template 2', content: 'Test 2' }
  ],
  content_css: [
    '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
    '//www.tinymce.com/css/codepen.min.css'
  ]
});
	</script>
	
	<script src="/js/jquery.easytabs.js" type="text/javascript"></script>  
	
	<style>
	#list li{
		display: block !important;
		border: 1px solid black;
		max-width: 180px;
		margin-top: 10px;
	}
	#list li img {
		height: 100px;
		width: 180px;
	}
	#list li .close{
		position: relative;
		top: -100px;
		color: black;
		right: 0px;
		float: right;
		cursor: pointer;
	}
	</style>
	<link rel="icon" type="image/png" href="favicon.png" />
	
</head>
<body>
	<div class="admin-menu">
		<?=minc::pos('admin-top-menu', $array['id'])?>
	</div>
	
	<div class="main-block">
		<div class="left-menu">
			<ul class="parent-admin">
				<li><a href="#" id="pages">Страницы</a>  |  <a href="/administrator/pages/">все</a></li>
				<ul class="child-admin" style="display: none" id="pages-child-admin">
					<li><a href="/administrator/pages/create/">Создать</a></li>
					<!--<li><a href="/administrator/pages/settings/">настройки полей</a></li>-->
									
				</ul>
			</ul>
			<ul class="parent-admin">
				<li><a href="#" id="cats">Категории</a>  |  <a href="/administrator/cats/">все</a></li>
				<ul class="child-admin" style="display: none" id="cats-child-admin">
					<li><a href="/administrator/cats/create/">Создать</a></li>
					<!--<li><a href="/administrator/cats/settings/">настройки полей</a></li>-->		
									
				</ul>
			</ul>
			<ul class="parent-admin">
				<li><a href="#" id="modules">Modules</a>  |  <a href="/administrator/modules/">все</a></li>
				<ul class="child-admin" style="display: none" id="modules-child-admin">
					<li><a href="/administrator/modules/create/">Создать</a></li>
								
				</ul>
			</ul>
			<ul class="parent-admin">
				<li><a href="#" id="users">Users</a>  |  <a href="/administrator/users/">все</a></li>
				<ul class="child-admin" style="display: none" id="users-child-admin">
					<li><a href="/administrator/users/create/">Создать</a></li>					
					<li><a href="/administrator/users/settings/">настройки полей</a></li>					
				</ul>
			</ul>
			
			<ul class="parent-admin">
				<li><a href="#" id="content">Content</a>  |  <a href="/administrator/content/">все</a></li>
				<ul class="child-admin" style="display: none" id="content-child-admin">
					<li><a href="/administrator/content/">все</a></li>					
				</ul>
			</ul>
			
			<ul class="parent-admin">
				<li><a href="#" id="buys">Заказы</a>  |  <a href="/administrator/buys/">все</a></li>
				<ul class="child-admin" style="display: none" id="buys-child-admin">
					<li><a href="/administrator/buys/">все</a></li>					
				</ul>
			</ul>
			<!--
			<ul class="parent-admin">
				<li><a href="#" id="fields">Fields</a>  |  <a href="/fields/">все</a></li>
				<ul class="child-admin" style="display: none" id="fields-child-admin">
					<li><a href="/administrator/fields/create/">Создать</a></li>					
				</ul>
			</ul>
			-->
		</div>
		<div class="content">
			<? include $content; ?>
		</div>
	</div>
</body>

</html>