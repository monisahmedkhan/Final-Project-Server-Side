<?php ob_start(); session_start(); ob_end_flush(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Web APP</title>
	<link rel="stylesheet" type="text/css" href="css/myStyle.css" media="all">
</head>
<body>
		<div class='myBlock' >
			<h1>List orders</h1>
		</div>
		<div class='myBlock' id='block_form' >
			<?php  
				 require('html_file/html_file.php');
				 if( isset($_SESSION["admin"]) && $_SESSION["admin"] ){
				    require('php_file/user_page.php');
					include "php_file/connect.php";
					$v = user_page::sel_pizzas($dbh);
					for($i=0;$v && $i<count($v);$i++)		 		 	
						$v_ingredients[$i] = user_page::sel_ingredients($v[$i]["id"], $dbh);
				    echo html_file::print_list_order($v,$v_ingredients,$_SESSION["admin"]);
				 }else echo html_file::print_error_auth();    
   		 	?>
		</div>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="js_file/myJquery.js"></script>
</body>
</html>