<?php
 	header('Content-Type: application/json');

	if(!isset($_SESSION)) 
    { 
		ob_start(); session_start(); ob_end_flush();
    } 

	class do_login{
		var $check= false;
		var $v_cat = false, $v_post = false;

		function __construct( $username, $password ){ 
			$this->username = $username; 
			$this->password = $password; 
		}

		function connDB(){
			include "connect.php";	
			$uid = user_page::check_data($dbh, $this->username, $this->password);
			if( $uid ){
				$_SESSION["id"] = $uid; 
				$this->v_item =user_page::get_items();
				$this->check = true;
			}
		}

		function printing(){
			if( $this->check ){ 
				
				$v["text"] = user_page::print_items($this->v_item);
				$v["check"] = true;
			}else{
				$v["check"]=false;
				$v["text"] = user_page::print_error();
			}

			$myJSON = json_encode( $v );
    		echo $myJSON;
		}

	}

	require("user_page.php");

	$username=filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING); // filter the input
	$password=filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING); // filter the input

	$do = new do_login( $username, $password );
	$do->connDB();
	$do->printing();

?>