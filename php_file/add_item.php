<?php
 	
	if(!isset($_SESSION)) 
    { 
		ob_start(); session_start(); ob_end_flush();
    } 


	require("user_page.php");
	if( isset($_SESSION["id"]) && $_SESSION["id"] ){
		echo user_page::print_form_add_item();
	}else echo "Error";

?>