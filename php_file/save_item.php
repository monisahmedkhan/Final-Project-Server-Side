<?php
 	header('Content-Type: application/json'); 
	ob_start(); session_start(); ob_end_flush();

     class save_item{
     	var $error=false;

          function __construct($v){
               $this->v = $v;
          }

     	function connDB(){
     		include "connect.php";
               $risp = user_page::save_item( $this->v["stockname"], $this->v["currentprice"], $dbh);
               if($risp)
                       $this->v_items=user_page::get_items();  
               else 
                    $this->error = true;
     	}

     	function print_data(){

     		if( !$this->error ){
                    
                    $v_return["check"] = true;
     			$v_return["text"] = user_page::print_items( $this->v_items );
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

          $do = new save_item($safePost);
          $do->connDB();
          $do->print_data();
     }else{ 
          $v_return["check"] = false;  
          $myJSON = json_encode( $v_return );
          echo $myJSON;
     }
?>