$(document).ready(function(event){
	// $('#link-login').click(function(e){
		// if($('#ajax-login').css('display') == "block"){
			// $('#ajax-login').slideUp('5000');
		// } else {
			// $('#ajax-login').slideDown('5000');
		// }
		// //$.ajax
		// return false;
	// });
	
	$('#link-logout2').click(function(){
		
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
	$('#link-logout').click(function(){
		
		var data = "action=logout_user&module=login"
		data = data + '&ajax=Y';
		console.log("click");
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
	
	// $('#login').submit(function(e){
		// var data = $(this).serialize();
		// data = data + '&ajax=Y';
		// console.log(data);
		// $.ajax({
		  // url: "/login/",
		  // type: "POST",
		  // data: data,
		  // success: function(html){
			  // $('#ajax-login').html(html)
				// setTimeout(function(){
					// $('#ajax-login').slideDown('5000');
				// }, 1000)
				// setTimeout(function(){
					
					// if(document.getElementById('errors')) { 
						// location.href='/login/?error=Y'; 					
					// } else {
						// location.href='/personal/projects/';
					// }
					 
					
				// }, 1000)
		  // }
		// });
		// return false;
	// })
	$('.low-menu-but').click(function(){
		console
		if($('#menu-v').val() == '0'){
			$('#menu-v').val('1');
			$('.navbar-top').animate({right: '0px', }, 1000);
		} else {
			$('#menu-v').val('0');
			$('.navbar-top').animate({right: '-100%', }, 500);
		}
		
	})
	$('.parent a').click(function(){
		var obj = $('#'+this.id+'-child')
		if(obj.css('display') == 'none'){
			obj.css('display', 'block')
		} else {
			obj.css('display', 'none')
		}
		return false;
	})
});

