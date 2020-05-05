<?php
 
     if(!isset($_SESSION))  { 
		ob_start(); session_start(); ob_end_flush();
     } 

     class user_page{  	

     	public static function  encrypt_password($password){
               $password_enctrypted = password_hash($password, PASSWORD_DEFAULT);
               return $password_enctrypted;
        }

     	public static function  save_data($dbh, $username, $password){
            $password_enctrypted = user_page::encrypt_password( $password );     
     	    $command = "INSERT INTO `users`(  `username`, `password`) VALUES (  ?, ? )";

			$stmt = $dbh->prepare($command);
			$params = [ $username, $password_enctrypted ];
			$success = $stmt->execute( $params );

			if( $success ) 
     			return true;
     		return false;
     	}

     	public static function get_username($dbh, $username ){
              $command = "SELECT * FROM `users` WHERE `username`= ? ";
              $stmt = $dbh->prepare($command);
              $params = [ $username ];
              $success = $stmt->execute($params);

              while ( $user_data = $stmt->fetch()  ) {
                   return true;
               }
               return false;
        }

        public static function last_insert($dbh){
		 	return $dbh->lastInsertId();
		}

     	public static function get_data($dbh, $username){
     		$command = "SELECT * FROM `users` WHERE username= ? ";
	
		    $stmt = $dbh->prepare($command);
		    $params = [ $username ];
		    $success = $stmt->execute($params);

		    while ( $user_data = $stmt->fetch()  ) {
			    return $user_data;
			}
			return false;
     	}

     	public static function get_single_item($id){
     		$v = false; $i=0;
     		include "connect.php";
     		$command = "SELECT * FROM `StockUpdates` WHERE StockId = ?";
			$stmt = $dbh->prepare( $id );
		    $params = [ $id ];
		    $success = $stmt->execute($params);
		    while ( $row = $stmt->fetch()  ) {
			    $v = $row;
			}
			return $v;
     	}

     	public static function get_items(){
     		$v = false; $i=0;
     		include "connect.php";
			
     		$command = "SELECT * FROM `StockUpdates` ORDER by `UpdateDateTime` DESC LIMIT 10;";
			$stmt = $dbh->prepare( $command ); 
		    $success = $stmt->execute( );

		    while ( $row = $stmt->fetch()  ) {
			    $v[$i] = $row;
			    $i++;
			}
			return $v;
     	}

     	public static function check_data($dbh, $username, $password){
     		$command = "SELECT * FROM users WHERE username=?";
 
			$stmt = $dbh->prepare($command);
			$params = [ $username ];
			$success = $stmt->execute( $params );
			$i=0;

		    while ( $shop = $stmt->fetch()  ) {
			    if( password_verify($password, $shop["password"] ) ){   
			    	return $shop["username"]; 
				}
			}
			return false;
		}

		public static function save_item( $stockname, $currentprice, $dbh){     
     	    $command = "INSERT INTO `StockUpdates`(`stockname`,`currentprice`,`updatedatetime`) VALUES (?, ?, NOW() )";
		
			$stmt = $dbh->prepare($command);
			$params = [ $stockname, $currentprice ];
			$success = $stmt->execute( $params );
			if( $success ) 
     				return true;
     		return false;
		}

     	public static function menu_user(){
     		$html="<p>
						<a href='index.php'><input type='button' value='Home' /></a>
						<input type='button' class='f11' id='add_item' name='add_item' value='Add Item' />
						<a href='index.php'><input type='button' id='view_items' name='view_items' value='Items' /></a>
					</p>
					<p>";
			    $html.="
						";
		        $html.="<input type='button' id='ten_item' name='ten_item' value='10 item' />
						<input type='button' id='logout' name='logout' value='Logout' />
					</p>";
     		return $html;
     	}

     	public static function print_error(){
     		return "<p>Error the data are wrong</p>";
     	}

     	public static function print_confirm_registration(){
     		return " <h2>Registration confirmed</h2> 
					 <form>
						<p>Log-in</p>
						<p> <input type='text' placeholder='Insert Username' id='user' name='user' /> </p>
						<p> <input type='password' placeholder='Insert Password'  id='password' name='password' /> </p>
						<p> <input type='button' id='login' name='login' value='Login' /> </p>
				   </form>";
     	}	

     	public static function print_login(){
     		return "<form>
						<p>Log-in</p>
						<p> <input type='text' placeholder='Insert Username' id='user' name='user' /> </p>
						<p> <input type='password' placeholder='Insert Password'  id='password' name='password' /> </p>
						<p> <input type='button' id='login' name='login' value='Login' /> </p>
						<p>You are not registered? Do it now!!! <input type='button' id='change_register' name='change_register' value='Register' /> </p>
				   </form>";
     	}


     	// print last 10 data in stock
     	public static function print_items( $v ){
     			$html=user_page::menu_user();
				if($v){
					for( $i=0;$i<count($v);$i++ ){
						$html.="<div class='box_post' >
								  <div class='title_post' >
								  	<span class='bolder'> ".$v[$i]["stockname"]."</span>
								  	<input type='hidden'  value=".$v[$i]["stockid"]." /> 
							  	     
							  	  </div>
								  <p> ".$v[$i]["currentprice"]."</p>								 
								  
								  <div class='whois_post pRight10'>
								  	<span></span>
								  </div>
							   	  
							   	  <div class='footer_post' >
							   	  		<span class='float_left pLeft10' > ".$v[$i]["updatedatetime"]."  </span>
							   	  </div>	
							   </div>";
					}
				}else $html.="<p id='list_item' >No Items!!!</p>";
				return $html;
     	}

     	public static function print_data( $v ){
     			$my_html = user_page::menu_user();
     			$my_html.="
						<hr/>
						<p> 
							<p> <span class='bolder'>Username:</span> ".$v["username"]."</p>
						</p>";
				return $my_html;
     	}

     	public static function print_form_update($v){
     			$html = user_page::menu_user();
     			$html.= "<hr/>
						<form id='update_form' >
							<p>
								<p> <span class='bolder'>Username:</span> <br/>
									<input type='text' id='username' name='username' value='".$v["username"]."' /></p>
								<p> 
									<input type='button' id='do_update' name='do_update' value='Save' />
									
								</p>
							</p>
						</form>";
				return $html;
     	}

     	public static function print_form_add_item(){
     			$html = user_page::menu_user();
     			$html.= "<form id='add_item_form' > 
							<p> 
								<p> 
									<span class='bolder'>Stockname:</span> <br/> 
									<input type='text' id='stockname' name='stockname' /> 
								</p> 
								<p>  
									<span class='bolder'>Current price:</span> <br/> 
									<input type='text' id='currentprice' name='currentprice' /> 
								</p> 
								<p>  
									<input type='button' id='save_new_item' name='save_new_item' value='Save' /> 
									<a href='index.php'>
										<input type='button' id='undo_item' name='undo_item' value='Undo' /> 
									</a>
								</p> 
							</p>
					   </form>";
				return $html;
     	}

     }

?>