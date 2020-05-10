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

				require('html_file/html_file.php');
				if( isset($_SESSION["admin"]) && $_SESSION["admin"] ){
				    require('php_file/user_page.php');
				    include "php_file/connect.php";
	
					$pizzas["all"] = user_page::total_sales($dbh);
					$pizzas["big"] = user_page::total_sales_type($dbh,'Big');
					$pizzas["medium"] = user_page::total_sales_type($dbh,'Medium');
					$pizzas["little"] = user_page::total_sales_type($dbh,'Little');
		
					$v_ingr= user_page::total_ingredients($dbh);
					$pizzas["not_cooked"]=user_page::not_cooked($dbh);
					$pizzas["not_delivered"]=user_page::not_delivered($dbh);

					for($i=0;$i<24;$i++){
						$hour_min=$i.":00:00";
						$hour_max=$i.":59:59";
						$pizzas["hour_frame"][$i] = user_page::get_pizza_hour($dbh,$hour_min,$hour_max);
						$pizzas["hour_name"][$i] =$hour_min." - ".$hour_max;
					}
					$v = user_page::sel_pizzas_completed($dbh);
					$time=user_page::calculate_time_order($dbh,$v);
					$pizzas["max_time"]=max($time);
					$pizzas["avg_time"]=array_sum($time)/count($time);
					$pizzas["min_time"]=min($time);
				    echo html_file::print_report($pizzas, $v_ingr, $_SESSION["admin"] );
			}else echo html_file::print_error_auth();

   		 	?>
		</div>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="js_file/myJquery.js"></script>
</body>
</html>