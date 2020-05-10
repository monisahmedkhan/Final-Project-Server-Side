<?php ob_start(); session_start(); ob_end_flush(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Web APP</title>
	<link rel="stylesheet" type="text/css" href="css/myStyle.css" media="all">
</head>
<body>
		<div class='myBlock' >
			<h1>Order your Pizza</h1>
		</div>
		<div class='myBlock' id='block_form' >
			<?php  
				    require('php_file/user_page.php');
				    require('html_file/html_file.php');
	
				    if( isset($_SESSION["id"]) && $_SESSION["id"] ){ 	

						$v_width = user_page::sel_width();		 		 	
						$v_ingredients = user_page::sel_ingredients();

				    	echo html_file::order_now_page($v_width,$v_ingredients, $_SESSION["admin"]);

				     }else{
				     	echo html_file::print_login();
				     }	
   		 	?>
		</div>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="js_file/myJquery.js"></script>
</body>
</html>