<?php
	header('Content-Type: application/json'); 
	ob_start(); session_start(); ob_end_flush();

     class print_items{
     	var $error=false;
     	var $v_response=false;

     	function get_data($dbh){
     		$command = "SELECT * FROM `StockUpdates` ORDER by `UpdateDateTime` DESC LIMIT 10;";
	
		    $stmt = $dbh->prepare($command); 
		    $success = $stmt->execute();

		    while ( $item = $stmt->fetch()  ) {
			    $this->v_items = $item;
			}
			if( !$this->v_items ) 
                    $this->error = true;
     	}

     	function connDB(){
     		include "connect.php";
               if( isset($_SESSION["id"]) && $_SESSION["id"] )
			       $this->get_data($dbh);
               else $this->error = false;
     	}

     	function print_data(){
     		if( !$this->error ){
                    
                    $v_return["check"] = true;
     			$v_return["text"] =user_page::print_items( $this->v_items );
     		}
     		else
     			$v_return["check"] = false;	

     		$myJSON = json_encode( $v_return );
	    	     echo $myJSON;
     	}

     } 

     if( isset($_SESSION["id"]) && $_SESSION["id"] ){
          require('user_page.php');

          $do = new print_items($_POST);
          $do->connDB();
          $do->print_data();
     }else{ 
          $v_return["check"] = false;  
          $myJSON = json_encode( $v_return );
          echo $myJSON;
     }
?>