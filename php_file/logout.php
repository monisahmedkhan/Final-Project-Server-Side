<?php
	header('Content-Type: application/json'); 
	if( !isset($_SESSION) ){ 
		ob_start(); session_start(); ob_end_flush();
	}

	require('user_page.php');
	if( session_destroy() ){
			$v_return["text"] = user_page::print_login();
			$v_return["check"] = true;	
	}else
		$v_return["check"] = false;	
	$myJSON = json_encode( $v_return );     
	echo $myJSON;
?>