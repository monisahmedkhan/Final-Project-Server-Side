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

				if( user_page::check_admin($dbh, $uid) )
							$_SESSION["admin"] = 1;
					else
						$_SESSION["admin"] = 0;

				$this->v_width = user_page::sel_width();		 		 	
				$this->v_ingredients = user_page::sel_ingredients();

				$this->check = true;
			}
		}

		function printing(){
			if( $this->check ){ 
				
				$v["text"] = html_file::order_now_page($this->v_width,$this->v_ingredients, $_SESSION["admin"]);
				$v["check"] = true;
			}else{
				$v["check"]=false;
				$v["text"] = html_file::print_error();
			}

			$myJSON = json_encode( $v );
    		echo $myJSON;
		}

	}

	require("user_page.php");
	require("../html_file/html_file.php");

	$username=filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING); // filter the input
	$password=filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING); // filter the input

	$do = new do_login( $username, $password );
	$do->connDB(); 
	$do->printing();

?>