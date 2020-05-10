<?php
  	 header('Content-Type: application/json'); 
     ob_start(); session_start(); ob_end_flush();


    class set_cooked{
        var $error=false;

        function __construct($v){
             $this->id = $v["id"];
        }

        function connDB(){;
        		
            include "connect.php";
             if( user_page::set_cooked($dbh, $this->id) ){
              	$this->v = user_page::sel_pizzas($dbh);
				for($i=0;$this->v && $i<count($this->v);$i++)		 		 	
					$this->v_ingredients[$i] = user_page::sel_ingredients($this->v[$i]["id"], $dbh);
            }else
                $this->error = true;
        }

        function print_data(){
        		if( !$this->error ){
              $v_return["check"] = true;
        			  $v_return["text"] = html_file::print_list_order($this->v,$this->v_ingredients, $_SESSION["admin"]);
        		}else
        			$v_return["check"] = false;	

        		$myJSON = json_encode( $v_return );
          	echo $myJSON;
        }
     } 

      require('user_page.php');
      require('../html_file/html_file.php');
      

      $safePost = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $do = new set_cooked($safePost);
      $do->connDB();
      $do->print_data();
 
?>