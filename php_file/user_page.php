<?php
 
     if(!isset($_SESSION))  { 
		ob_start(); session_start(); ob_end_flush();
     } 

     class user_page{  	

     	public static function  encrypt_password($password){
               $password_enctrypted = password_hash($password, PASSWORD_DEFAULT);
               return $password_enctrypted;
        }

     	public static function sel_width(){
     		$v = false; $i=0;
     		include "connect.php";
			
     		$command = "SELECT * FROM `width_pizza` ORDER BY id";
			$stmt = $dbh->prepare( $command ); 
		    $success = $stmt->execute( );

		    while ( $row = $stmt->fetch()) {
			    $v[$i] = $row;
			    $i++;
			}
			return $v;
     	}

     	public static function sel_ingredients(){
     		$v = false; $i=0;
     		include "connect.php";
			
     		$command = "SELECT * FROM `ingredients` ORDER BY name";
			$stmt = $dbh->prepare( $command ); 
		    $success = $stmt->execute( );

		    while ( $row = $stmt->fetch()  ) {
			    $v[$i] = $row;
			    $i++;
			}
			return $v;
     	}

     	public static function sel_ingredient_price($ing, $dbh){
     				
     		$command = "SELECT * FROM `ingredients` WHERE id=?";
			$stmt = $dbh->prepare( $command ); 
		    
			$params = [ $ing ];
			$success = $stmt->execute( $params );

		    while ( $row = $stmt->fetch()  ) {
			    return (float)$row["price"]; 
			}
			return 0;
     	}

     	public static function calculate_price( $v, $dbh){
     		$total=0;
     		for($i=0;$i<count($v);$i++){
     				$total+= user_page::sel_ingredient_price($v[$i], $dbh);
     		}
     		return $total;
     	}

     	public static function sel_price_width( $width, $dbh){
     		$command = "SELECT * FROM `width_pizza` WHERE id=?";
			$stmt = $dbh->prepare( $command ); 
			$params = [ $width ];
			$success = $stmt->execute( $params );
		    while ( $row = $stmt->fetch()  ) {
			    return (float)$row["price"]; 
			}
     		return 0;
     	}

     	public static function get_name_width( $width, $dbh){
     		$command = "SELECT * FROM `width_pizza` WHERE id=?";
			$stmt = $dbh->prepare( $command ); 
			$params = [ $width ];
			$success = $stmt->execute( $params );
		    while ( $row = $stmt->fetch()  ) {
			    return $row["width"]; 
			}
     		return 0;
     	}

     	public static function get_waiting( $dbh ){
     		$command = "SELECT max(`waiting_time`) as max_time FROM `pizza` ";
			$stmt = $dbh->prepare( $command ); 
			$success = $stmt->execute();

		    while ( $row = $stmt->fetch()  ) {
			    return (int)$row["max_time"]; 
			}
     		return 0;	
     	}

		public static function save_order( $width, $price, $waiting_time, $user, $hour_submitted, $dbh){     
     	    $command = "INSERT INTO `pizza`( `width`, `price`, `waiting_time`,`user`, `hour_submitted` ) VALUES ( ? , ? , ?, ?, ?   )";
		
			$stmt = $dbh->prepare($command);
			$params = [ $width, $price, $waiting_time, $user, $hour_submitted ];
			$success = $stmt->execute( $params );
			if( $success ) 
     				return true;
     		return false;
		}

		public static function add_user( $name, $address, $city, $dbh ){
			$command="INSERT INTO `users`( `name`, `address`, `city`) VALUES ( ?,?,?)";
			$stmt = $dbh->prepare($command);
			$params = [ $name, $address, $city ];
			$success = $stmt->execute( $params );
			if( $success ) 
     				return true;
     		return false;
		}

		public static function add_ingredient( $pizza, $ingredient, $dbh ){
			$command="INSERT INTO `pizza_ingredients`(`pizza`, `ingredient`) VALUES ( ?, ? )";
			$stmt = $dbh->prepare($command);
			$params = [ $pizza, $ingredient ];
			$success = $stmt->execute( $params );
			if( $success ) 
     				return true;
     		return false;
		}

		public static function get_name_ingredient( $ingredient, $dbh){
			$command = "SELECT * FROM `ingredients` WHERE id=?";
			$stmt = $dbh->prepare( $command ); 
		    
			$params = [ $ingredient ];
			$success = $stmt->execute( $params );

		    while ( $row = $stmt->fetch()  ) {
			    return $row["name"]; 
			}
			return 0;
		}

		public static function lastID($db){
			return $db->lastInsertId(); 
		}

		public static function sel_pizzas($dbh){
			$v=false; $i=0;
			$command = "SELECT p.id, name,address, city, w.width, p.price, waiting_time, hour_delivered, hour_cooked, hour_submitted FROM `users` u JOIN `pizza` p ON (p.user=u.id) JOIN `width_pizza` w ON (p.width=w.id) ORDER BY waiting_time DESC ";
			$stmt = $dbh->prepare( $command ); 
			$success = $stmt->execute();

		    while ( $row = $stmt->fetch()  ) {
			    $v[$i]=$row; $i++;
			}
     		return $v;	
		}

		public static function sel_pizza_ingredient($pizza, $dbh){
			$v=false; $i=0;
			$command = "SELECT i.name as name FROM `ingredients` i JOIN `pizza_ingredients` p ON (i.id=p.ingredient) where pizza=?";
			$stmt = $dbh->prepare( $command ); 
			$params = [ $pizza ];
			$success = $stmt->execute( $params );

		    while ( $row = $stmt->fetch()  ) {
			    $v[$i]=$row["name"]; $i++;
			}
     		return $v;	
		}

		public static function set_cooked($dbh, $id){
			$now=date("H:i:s");
			$command = "UPDATE `pizza` SET `hour_cooked`=? WHERE `id`=?";
		
			$stmt = $dbh->prepare($command);
			$params = [ $now, $id ];
			$success = $stmt->execute( $params );
			if( $success ) 
     				return true;
     		return false;	
		}

		public static function set_delivered($dbh, $id){
			$now=date("H:i:s");
			$command = "UPDATE `pizza` SET `hour_delivered`=? WHERE `id`=?";
		
			$stmt = $dbh->prepare($command);
			$params = [ $now, $id ];
			$success = $stmt->execute( $params );
			if( $success ) 
     				return true;
     		return false;	
		}

		public static function total_sales($dbh){
			$command = "SELECT count(*) AS total FROM `pizza`";
			$stmt = $dbh->prepare( $command ); 
			$success = $stmt->execute();

		    while ( $row = $stmt->fetch()  ) {
			    return $row["total"];
			}
     		return 0;		
		}

		public static function total_sales_type( $dbh, $type ){
			$command = "SELECT count(*) AS total FROM `pizza` WHERE width IN (SELECT id FROM width_pizza WHERE width=? )";
			$stmt = $dbh->prepare( $command ); 
			$params = [ $type ];
			$success = $stmt->execute($params);

		    while ( $row = $stmt->fetch()  ) {
			    return $row["total"];
			}
     		return 0;		
		}

		public static function total_ingredients($dbh){
			$v=false; $i=0;	
			$command = "SELECT count(*) AS total, ingredient, name FROM `pizza_ingredients` JOIN ingredients ON (ingredient=id) GROUP BY ingredient ORDER BY total DESC ";
			$stmt = $dbh->prepare( $command );
			$success = $stmt->execute();

		    while ( $row = $stmt->fetch()  ) {
			    $v[$i] = $row;
			    $i++;
			}
     		return $v;	
		}

		public static function not_cooked( $dbh ){
			$command = "SELECT count(*) total FROM `pizza` WHERE hour_cooked is null;";
			$stmt = $dbh->prepare( $command ); 
			$success = $stmt->execute();

		    while ( $row = $stmt->fetch()  ) {
			    return $row["total"];
			}
     		return 0;		
		}

		public static function not_delivered( $dbh ){
			$command = "SELECT count(*) total FROM `pizza` WHERE hour_delivered is null;";
			$stmt = $dbh->prepare( $command ); 
			$success = $stmt->execute();

		    while ( $row = $stmt->fetch()  ) {
			    return $row["total"];
			}
     		return 0;		
		}

		public static function get_pizza_hour($dbh,$hour_min,$hour_max){
			$command = "SELECT COUNT(*) total FROM `pizza` WHERE `hour_submitted`>=? AND `hour_submitted`<=?;";
			$stmt = $dbh->prepare( $command ); 
			$params = [ $hour_min, $hour_max ];
			$success = $stmt->execute($params);

		    while ( $row = $stmt->fetch()  ) {
			    return $row["total"];
			}
     		return 0;	
		}
		
		public static function sel_pizzas_completed($dbh){
			$v=false; $i=0;
			$command = "SELECT * FROM pizza WHERE hour_delivered IS NOT NULL";
			$stmt = $dbh->prepare( $command ); 
			$success = $stmt->execute();

		    while ( $row = $stmt->fetch()  ) {
			    $v[$i]=$row; $i++;
			}
     		return $v;	
		}

		public static function get_differences_time( $firstTime, $lastTime ){
			$firstTime=strtotime($firstTime);
			$lastTime=strtotime($lastTime);
    		$timeDiff=$lastTime-$firstTime;
    		if($timeDiff<0)
    			$timeDiff = $timeDiff*(-1);
			return $timeDiff;
		}

		public static function calculate_time_order($dbh,$v){
			$time = false;
			for($i=0;$v && $i<count($v);$i++){
				$time[$i] = user_page::get_differences_time( $v[$i]["hour_submitted"], $v[$i]["hour_delivered"] );
			}
			return $time;
		}

		public static function save_data_user($dbh, $v){
			$password_enctrypted = user_page::encrypt_password( $v["password"] );     
			$command="INSERT INTO `users`( `name`, `address`, `city`, `username`, `password`) VALUES (?, ?, ?, ?, ?)";
			$stmt = $dbh->prepare($command);
			$params = [ $v["name"], $v["address"], $v["city"], $v["username"], $password_enctrypted  ];
			$success = $stmt->execute( $params );
			if( $success ) 
     				return true;
     		return false;
		}

		public static function check_data($dbh, $username, $password){
     		$command = "SELECT * FROM users WHERE username=?";
 
			$stmt = $dbh->prepare($command);
			$params = [ $username ];
			$success = $stmt->execute( $params );
			$i=0;

		    while ( $row = $stmt->fetch()  ) {
			    if( password_verify($password, $row["password"] ) ){   
			    	return $row["id"]; 
				}
			}
			return false;
		}

		public static function check_admin($dbh, $id){
     		$command = "SELECT * FROM users WHERE id=? AND admin=true";
 
			$stmt = $dbh->prepare($command);
			$params = [ $id ];
			$success = $stmt->execute( $params );

		    while ( $row = $stmt->fetch()  ) {
			    return true;
			}
			return false;
		}

		public static function get_username($dbh, $username){
     		$command = "SELECT * FROM users WHERE username=?";
 
			$stmt = $dbh->prepare($command);
			$params = [ $username ];
			$success = $stmt->execute( $params );
 
		    while ( $vett = $stmt->fetch()  ) {
		    	return true;
			}
			return false;
		}

		public static function get_data($dbh, $uid){
     		$command = "SELECT * FROM users WHERE id=?";
 
			$stmt = $dbh->prepare($command);
			$params = [ $uid ];
			$success = $stmt->execute( $params );
 
		    while ( $vett = $stmt->fetch()  ) {
		    	return $vett;
			}
			return false;
		}
		


     }

?>