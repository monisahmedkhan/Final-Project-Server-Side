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
						if( msg.check==true ){
							block_form.html( msg.text );
						}else 
							alert("Error!!!"); 
				});
			}else alert("Error! The passwords are different");
		}else alert("Error! Password is wrong");
	});

	$("body").on('click', "#save",function(){
		var block_form = $("#block-body");
		var url = "php_file/save_order.php";
		value_form = $("#my_form").serialize();
		$.post(url, value_form, function ( msg ) {
				if( msg.check==true ){
					block_form.html( msg.text );
				}else 
					alert("Error!!!"); 
		});

	});

	$("body").on('click', ".set_cooked",function(){
		puls = $(this);
		var block_form = $("#block_form");
		var url = "php_file/set_cooked.php";
		id = puls.prev().val();
		var data = { "id":id };
		$.post(url, data, function ( msg ) {
				if( msg.check==true ){
					block_form.html( msg.text );
				}else 
					alert("Error!!!"); 
		});

	});

	$("body").on('click', ".set_delivered",function(){
		puls = $(this);
		var block_form = $("#block_form");
		var url = "php_file/set_delivered.php";
		id = puls.prev().val();
		var data = { "id":id };
		$.post(url, data, function ( msg ) { 
				if( msg.check==true ){
					block_form.html( msg.text );
				}else alert("Error!!!"); 
		});
	});

	$("body").on('click', "#logout",function(){
		var block_form = $("#block_form");
		var url = "php_file/logout.php";
		$.post(url, function ( msg ) { 
				if( msg.check==true ){
					block_form.html( msg.text );
				}else alert("Error!!!"); 
		});
	});
 

});