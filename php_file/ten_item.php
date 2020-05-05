<?php
 	header('Content-Type: application/json'); 
	ob_start(); session_start(); ob_end_flush();

     class save_item{
     	var $error=false;

          function __construct($v){
               $this->v = $v;
          }

           
          function getName($n) { 
              $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
              $randomString = ''; 
            
              for ($i = 0; $i < $n; $i++) { 
                  $index = rand(0, strlen($characters) - 1); 
                  $randomString .= $characters[$index]; 
              } 
            
              return $randomString; 
          } 
  


     	function connDB(){
     		include "connect.php";
               for($i=0;$i<10;$i++){
                    
                    $price=mt_rand();

                    $dim_word=mt_rand(3, 20);

                    $str=$this->getName($dim_word); 

                    $risp=user_page::save_item( $str, $price, $dbh);
                    if(!$risp){
                         $this->error=true;
                         break;
                    }
               }
             
               $this->v_items=user_page::get_items();  
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