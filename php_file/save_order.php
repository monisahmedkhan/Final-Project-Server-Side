<?php
  	 header('Content-Type: application/json'); 

    class save_item{
        var $error=false;

        function __construct($v){
             $this->v = $v;
        }

        function connDB(){
            $hour_submitted=date("H:i:s");
        		
            include "connect.php";

            $this->client = user_page::get_data($dbh, $_SESSION["id"]);

            // calculate total price
            $total = user_page::calculate_price( $this->v["ingredients"], $dbh) + user_page::sel_price_width( $this->v["width"], $dbh);
            $waiting_time = user_page::get_waiting( $dbh ) + 10;

            $risp= user_page::add_user( $this->client["name"], $this->client["address"], $this->client["city"], $dbh );
            if($risp){
              $user =  user_page::lastID($dbh);

              $risp = user_page::save_order( $this->v["width"], $total, $waiting_time, $user, $hour_submitted, $dbh);
              if($risp){
                  $pizza =  user_page::lastID($dbh); 
                  for($i=0; $this->v["ingredients"] && $i<count($this->v["ingredients"]);$i++){
                      if( user_page::add_ingredient($pizza , $this->v["ingredients"][$i], $dbh) )
                           $this->order["ingredients"][$i] = user_page::get_name_ingredient( $this->v["ingredients"][$i], $dbh); 
                      else $this->error=true;
                 }

                 $this->order["price"] = $total;
                 $this->order["id"] = $pizza;
                 $this->order["waiting_time"] = $waiting_time;
                 $this->order["hour_submitted"] = $hour_submitted;
                 $this->order["width"] = user_page::get_name_width( $this->v["width"], $dbh); 
              }else
                  $this->error = true;
            }else
                $this->error = true;
        }

        function print_data(){
        		if( !$this->error ){
              $v_return["check"] = true;
        			  $v_return["text"] = html_file::print_order( $this->order );
        		}else
        			$v_return["check"] = false;	

        		$myJSON = json_encode( $v_return );
          	echo $myJSON;
        }
     } 

      require('user_page.php');
      require('../html_file/html_file.php');
      

      $safePost = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
 

      $do = new save_item($safePost);
     $do->connDB();
       $do->print_data();
 
?>