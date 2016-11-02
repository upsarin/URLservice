function AjaxFunc(url, type, data, params){
		$.ajax({
		  url: url,
		  type: type,
		  data: data,
		  success: function(html){
			  if(params['resBlock'] != 'undefined') {
				$('#'+params['resBlock']).html(html);
			  }
			}
		});
	};
$(document).ready(function(event){
		
	$('#shortlinkForm').submit(function(e){
		var link = $("input[name='main[orig_url]']").val();
		if(link != "" && link != "undefined"){
			var data = "action=save_data&module=shortlink&iblock_name=shortlink&main[orig_url]=" + link;
			data = data + '&ajax=Y';
			
			$.ajax({
			  url: "/katalog/",
			  type: "POST",
			  data: data,
			  success: function(html){
					console.log("123");			
			  }
			});
		} else {
			$('shortlinkForm').append('<div class="error_mess">Заполните "Оригинальная ссылка"</div>');
			link.focus();
		}
		return false;
	});	

	$('#edit-list li a').click(function(){
		var question = "Вы уверены в том, что хотите удалить эту фотографию?";
		confirmQ = confirm(question);
		
		var id = this.id;
		if(confirmQ == true){
			var data = "id=" + this.id + "&action=delete";
			$.ajax({
			  url: "/ajax/editphoto.php",
			  type: "POST",
			  data: data,
			  success: function(html){
					
					if(html == true){
						$('a#' + id).css('display', 'none');
					} 
					
			  }
			});
		}
		return false;
	});
				
	
	$('#link-logout').click(function(e){
		console.log(this)
		var data = "action=logout_user&module=login"
		data = data + '&ajax=Y';
		
		$.ajax({
		  url: "/login/",
		  type: "POST",
		  data: data,
		  success: function(html){
				location.href='/';
				
		  }
		});
		return false;
	});
	$('#link-logout-admin').click(function(e){
		var data = "action=logout_user&module=login"
		data = data + '&ajax=Y';
		
		$.ajax({
		  url: "/login/",
		  type: "POST",
		  data: data,
		  success: function(html){
				location.href='/administrator/';
				
		  }
		});
		return false;
	});
	
	$('.low-menu-but').click(function(){
		
		if($('#menu-v').val() == '0'){
			$('#menu-v').val('1');
			$('.navbar-top').animate({right: '0px', }, 1000);
		} else {
			$('#menu-v').val('0');
			$('.navbar-top').animate({right: '-100%', }, 500);
		}
		
	})
	$('.parent-admin a').click(function(){
		var obj = $('#'+this.id+'-child-admin')
		if(obj.css('display') == 'none'){
			obj.css('display', 'block')
		} else {
			obj.css('display', 'none')
		}
		
	})
	$('.child-admin a').click(function(){
		var url = this.href;
		var urlSplits = url.split('/');
		if(urlSplits[3] == 'administrator' && urlSplits[4] != '' && urlSplits[5] != ''){
			var pageName = urlSplits[4];
			var actionName = urlSplits[5];
			if(urlSplits[6] != '' && urlSplits[5] != 'create'){
				var contentId = urlSplits[6];
			}
			var type = "POST";
			var moduleName = 'element';
			url = '/administrator/';
			var data = "page_id="+ pageName +"&action="+ actionName +"&content_id="+ contentId +"&module=&ajax=Y&overload=Y";
			params = {resBlock: 'joinOurTeamFull'};
			//AjaxFunc(url, type, data, params);
		}
		
		//return false;
	})
	
	$('.settings').click(function(){
		var id = this.id;
		$('.settingsup').css('display', 'none');
		$('#settingsup'+id).css('display', 'block');
		console.log($('.settingsup #'+id).css())
	})
	$('.new-field').click(function(){
		
		var newTr = document.createElement('tr');
		var lowTimeId = $('tr').length;
		newTr.innerHTML = '<td></td><td><input type="hidden" name="new['+lowTimeId+'][iblock]" value="content"/></td><td><input type="text" name="new['+lowTimeId+'][name]" value="" /></td><td><select name="alter['+lowTimeId+'][input_type]"><option value="text">text</option><option value="html">html</option><option value="select">select</option><option value="file">file</option><option value="checkbox">checkbox</option><option value="textarea">textarea</option><option value="date">date</option><option value="hidden">hidden</option></select></td><td><input type="checkbox" name="new['+lowTimeId+'][active]" value="Y" checked="checked"/></td><td><input type="checkbox" name="new['+lowTimeId+'][required]" value="Y" /></td><td><input type="checkbox" name="new['+lowTimeId+'][read]" value="Y" /></td><td><input type="text" name="new['+lowTimeId+'][sort]" value="100" /></td><td><input type="text" name="new['+lowTimeId+'][code]" value="" /></td><td></td>';
		
		fieldtable.appendChild(newTr);
	})
	$('.new-field-users').click(function(){
		
		var newTr = document.createElement('tr');
		var lowTimeId = $('tr').length;
		newTr.innerHTML = '<td></td><td><input type="hidden" name="new['+lowTimeId+'][iblock]" value="users"/></td><td><input type="text" name="new['+lowTimeId+'][name]" value="" /></td><td><select name="alter['+lowTimeId+'][input_type]"><option value="text">text</option><option value="html">html</option><option value="select">select</option><option value="file">file</option><option value="checkbox">checkbox</option><option value="textarea">textarea</option><option value="date">date</option><option value="hidden">hidden</option></select></td><td><input type="checkbox" name="new['+lowTimeId+'][active]" value="Y" checked="checked"/></td><td><input type="checkbox" name="new['+lowTimeId+'][required]" value="Y" /></td><td><input type="checkbox" name="new['+lowTimeId+'][read]" value="Y" /></td><td><input type="text" name="new['+lowTimeId+'][sort]" value="100" /></td><td><input type="text" name="new['+lowTimeId+'][code]" value="" /></td><td></td>';
		
		fieldtable.appendChild(newTr);
	})
	
	
});
