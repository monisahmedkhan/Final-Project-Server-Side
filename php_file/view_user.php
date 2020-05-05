<?php
 	header('Content-Type: application/json'); 
	ob_start(); session_start(); ob_end_flush();

     class view_user{
     	var $error=false;
     	var $v_response=false; 

     	function connDB(){
     		include "connect.php";
               if( isset($_SESSION["id"]) && $_SESSION["id"] )
			       $this->v_user_data=user_page::get_data( $dbh, $_SESSION["id"] );
               else $this->error = false;
     	}

     	function print_data(){
     		if( !$this->error ){
                    
                    $v_return["check"] = true;
     			$v_return["text"] =user_page::print_data( $this->v_user_data );
     		}
     		else
     			$v_return["check"] = false;	

     		$myJSON = json_encode( $v_return );
	    	     echo $myJSON;
     	}

     } 

     if( isset($_SESSION["id"]) && $_SESSION["id"] ){
          require('user_page.php');
          $safePost = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

          $do = new view_user($safePost);
          $do->connDB();
          $do->print_data();
     }else{ 
          $v_return["check"] = false;  
          $myJSON = json_encode( $v_return );
          echo $myJSON;
     }
?>