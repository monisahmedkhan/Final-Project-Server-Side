<?php
     header('Content-Type: application/json'); 
	ob_start(); session_start(); ob_end_flush();

     class do_register{
     	var $error=false;
     	var $v_response=false;
          var $v_cat = false, $v_post = false;

     	function __construct( $v ){ 
     		$this->v = $v;
     	}

     	function connDB(){
     		include "connect.php";
     		if( $this->v["password"] == $this->v["password2"] ){
      			if( !user_page::get_username($dbh, $this->v["username"] ) ){
                          if( user_page::save_data_user($dbh, $this->v) ){
                              $uid= user_page::lastID($dbh);
          				if( !$this->error ){
          						$this->v_user_data = user_page::get_data($dbh, $uid);    
          				}
          			}else $this->error=true;	
     		     }else
                         $this->error = true;
               }		
     	}

     	function print_data(){
     		if( !$this->error ){
                         
                    $v_return["check"] = true;
     			$v_return["text"] = html_file::print_confirm_registration();
     		}
     		else
     			$v_return["check"] = false;	

     		$myJSON = json_encode( $v_return );
	    	     echo $myJSON;
     	}

     } 

     require('user_page.php');
     require('../html_file/html_file.php');
     $safePost = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

     $do = new do_register($safePost);
     $do->connDB();
     $do->print_data();
?>