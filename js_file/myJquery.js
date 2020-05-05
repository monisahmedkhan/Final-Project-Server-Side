jQuery(document).ready(function($) {

	function validatePsw(password){
		var re = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$^+=!*()@%&]).{8,}$/;
		return re.test( password );
	}

	$("body").on('click', "#login",function(){
		var puls = $(this);
		var block_form = $("#block_form");
		var user = $("#user").val();		
		var password = $("#password").val();
		var data = { "username":user, "password":password	};
		var url = "php_file/do_login.php";

		$.post(url, data, function ( msg ) { 
				if( msg.check==true ){
					block_form.html( msg.text );
				}else alert( msg.text ); 
		});
	});

	$("body").on('click', "#change_register",function(){
		var block_form = $("#block_form");
		var url = "php_file/change_register.php";
		$.post(url, function ( msg ) {
				block_form.html( msg );
		});
	});

	$("body").on('click', "#do_register",function(){
		
		var block_form = $("#block_form");
		var url = "php_file/do_register.php";
		value_form = $("#my_form").serialize();
		my_password = $("#password").val();
		my_password2 = $("#password2").val();

		if( validatePsw(my_password) ){

			if( my_password == my_password2 ){
			
				$.post(url, value_form, function ( msg ) {
						alert(msg); 
						if( msg.check==true ){
							block_form.html( msg.text );
						}else 
							alert("Error!!!"); 
				});

			}else alert("Error! The passwords are different");
		}else alert("Error! Password is wrong");
	});

	$("body").on('click', "#view",function(){

		var block_form = $("#block_form");
		var url = "php_file/view_user.php";
		
		$.post(url, function ( msg ) { 
				if( msg.check==true ){
					block_form.html( msg.text );
				}else 
					alert("Error!!!"); 
		});
	});

	$("body").on('click', "#logout",function(){
		
		var block_form = $("#block_form");
		var url = "php_file/logout.php";
		
		$.post(url, function ( msg ) {
				if( msg.check==true ){
					block_form.html( msg.text );
				}else 
					alert("Error!!!"); 
		});
	});

	$("body").on('click', "#return_login",function(){
		
		var block_form = $("#block_form");
		var url = "php_file/form_login.php";
		
		$.post(url, function ( msg ) {
			block_form.html( msg );
		});
	});

	$("body").on('click', "#add_item",function(){ 
		puls = $(this);

		var block_form = $("#block_form");
		var url = "php_file/add_item.php";
		
		$.post(url, function ( msg ) {
			block_form.html( msg );
		}); 
 
	});

	$("body").on('click', "#view_item",function(){
		
		var block_form = $("#block_form");
		var url = "php_file/view_item.php";
		
		$.post(url, function ( msg ) {
				if( msg.check==true ){
					block_form.html( msg.text );
				}else 
					alert("Error!!!"); 
		});
	});

	$("body").on('click', "#save_new_item",function(){
		
		var block_form = $("#block_form");
		value_form = $("#add_item_form").serialize();

		var url = "php_file/save_item.php";
		
		$.post(url, value_form, function ( msg ) { 
				if( msg.check==true ){
					block_form.html( msg.text );
				}else 
					alert("Error!!!"); 
		});
	});

	$("body").on('click', "#ten_item",function(){
		
		var block_form = $("#block_form");

		var url = "php_file/ten_item.php";
		
		$.post(url, function ( msg ) {  

				if( msg.check==true ){
					block_form.html( msg.text );
				}else 
					alert("Error!!!"); 
		});
	});

	$("body").on('click', "#undo_update_item",function(){
		puls = $(this); 

	});
 

});