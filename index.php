<!DOCTYPE html>
<html>
<?php
	if(!isset($_SESSION) ) { 
		ob_start(); session_start(); ob_end_flush();
    } 
?>
<head>
	<title>Web APP</title>
	<link rel="stylesheet" type="text/css" href="css/myStyle.css" media="all">
	<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.3.1/css/solid.css' integrity='sha384-VGP9aw4WtGH/uPAOseYxZ+Vz/vaTb1ehm1bwx92Fm8dTrE+3boLfF1SpAtB1z7HW' crossorigin='anonymous'>
	<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.3.1/css/regular.css' integrity='sha384-ZlNfXjxAqKFWCwMwQFGhmMh3i89dWDnaFU2/VZg9CvsMGA7hXHQsPIqS+JIAmgEq' crossorigin='anonymous'>
	<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.3.1/css/brands.css' integrity='sha384-rf1bqOAj3+pw6NqYrtaE1/4Se2NBwkIfeYbsFdtiR6TQz0acWiwJbv1IM/Nt/ite' crossorigin='anonymous'>
	<link rel='stylesheet' href='./css/fontawesome.css'  type='text/css'  />
</head>
<body>
		<div class='myBlock' >
			<h1>My Web App</h1>
		</div>
		<div class='myBlock' id='block_form' >
			<?php  
				    require('php_file/user_page.php');
				    $v_post= false;
				    if( isset($_SESSION["id"]) && $_SESSION["id"] ){ 

			   			$v_item =user_page::get_items();

			   			echo user_page::print_items($v_item);		

			        }else{ 
		   		 		echo user_page::print_login();
		   		 	} 
		   		 	?>
		</div>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="js_file/myJquery.js"></script>
</body>
</html>