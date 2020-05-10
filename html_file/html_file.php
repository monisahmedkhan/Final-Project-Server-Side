<?php

	  class html_file{

	  	public static function menu_user( $admin = 0 ){
     		$html="<p>
						<a href='index.php'><input type='button' value='Order Now!' /></a>";
			if( $admin ){
				$html.="<a href='list_orders.php'><input type='button' id='list_orders' name='list_orders' value='List Orders' /></a>
						<a href='report.php'><input type='button' id='report' name='report' value='Report' /></a>";
			}	
				$html.="<input type='button' id='logout' name='logout' value='Logout' />	
					</p>";
     		return $html;
     	}

     	public static function order_now_page($v_width,$v_ingredients,$admin = 0){
     		$html= html_file::menu_user($admin);
     		$html.="<div id='block-body' >
     					<form id='my_form' >
	     					
	     					<div class='block-body-child bordAll padd5' >
	     						<h2>Choose Weight</h2>
	     						<p>
	     							<select name='width' id='width' >";
	     		for($i=0;$v_width && $i<count($v_width);$i++){
	     				$html.="<option value='".$v_width[$i]["id"]."' >".$v_width[$i]["width"]."</option>";
	     		}
			    $html.="		
			    					</select>
			    				</p>
			    			</div>

			    			<div class='block-body-child bordAll padd5 mTop10' >
			    				<h2>Choose Ingredients</h2>
	     						<p>
	     							<table class='margin_auto bordAll' >";
	     		for($i=0;$v_ingredients && $i<count($v_ingredients);$i++){
	     				$html.="<tr>
	     							<td class='bordAll padd5' >
		     							<input type='checkbox' name='ingredients[]' value='".$v_ingredients[$i]["id"]."' />
		     						</td>
		     						<td class='bordAll padd5' >
		     							<span>".$v_ingredients[$i]["name"]."</span>
		     						</td>
		     						<td class='bordAll padd5' >
		     							<span>".$v_ingredients[$i]["price"]." $</span>
	     							</td>	
	     						</tr>";
	     		}
			    $html.="			</table>
			    				</p>	
			    			</div>
			    			<br/>

			    			<div class='block-body-child bordAll padd5 mTop10' >
			    				<input type='button' id='save' value='Save' />
			    				<input type='reset' id='reset' value='Reset' /> 
			    			</div>	

			    		</form>	
		    		</div>";
     		return $html;
     	}

     	public static function print_order($v){
     		$html="     <div class='block-body-child bordAll padd5' >
     						<h2>You order is ok</h2>
     						<p>ID: ".$v["id"]."</p>
     						<p>Waiting time: ".$v["waiting_time"]." minutes</p>
     						<p>Price: ".$v["price"]." $</p>
     						<p>Pizza: ".$v["width"]."</p> 
     						<p>Submitted at: ".$v["hour_submitted"]."</p>
     						<br/>
     						<p>Ingredients:</p>
     						<ul>";
				for($i=0; $v["ingredients"] && $i<count($v["ingredients"]);$i++ ){
					$html.="<li>".$v["ingredients"][$i]."</li>";
				}
					$html.="</ul>
     					</div> ";
     		return $html;	
     	}

     	public static function print_list_order($v, $v_ingredients, $admin = 0){
     		$html= html_file::menu_user($admin);
     		$html.="<div id='block-body' >";
     		if( $v ){	
     			for($i=0;$i<count($v);$i++){	
     		     		$html.=" 	<div class='block-body-child bordAll padd5' >
     		     						<h2>Order id: ".$v[$i]["id"]."</h2>
     		     						<input type='hidden' value='".$v[$i]["id"]."' />";
     		     		if( !$v[$i]["hour_cooked"] || $v[$i]["hour_cooked"]==NULL || $v[$i]["hour_cooked"]=='' )
     		     				$html.="<input type='button' class='set_cooked' name='set_cooked' value='Cooked' />";
     		     		else if( !$v[$i]["hour_delivered"] || $v[$i]["hour_delivered"]==NULL || $v[$i]["hour_delivered"]=='' )
     		     				$html.="<input type='button' class='set_delivered' name='set_delivered' value='Delivered' />";


	     						$html.="<p>Waiting time: ".$v[$i]["waiting_time"]." minutes</p>
     		     						<p>Price: ".$v[$i]["price"]." $</p>
     		     						<p>Pizza: ".$v[$i]["width"]."</p>
	     								<p>Delivered at: ".$v[$i]["hour_delivered"]."</p>
			     						<p>Cooked at: ".$v[$i]["hour_cooked"]."</p>
			     						<p>Submitted at: ".$v[$i]["hour_submitted"]."</p>
			     						<br/>
     		     						<p>Ingredients:</p>
     		     						<ul>";
     						for($j=0; $v_ingredients[$i] && $j<count($v_ingredients[$i]);$j++ ){
     							$html.="<li>".$v_ingredients[$i][$j]["name"]."</li>";
     						}
     							$html.="</ul>
     		     					</div>";
     			}     		
     		}
     		$html.="</div>";
     		return $html;	
     	}

     	public static function print_error(){
     		return "<p>Error the data are wrong</p>";
     	}

		public static function print_error_auth(){
     		return "<p>Error you don't have permission to see this page</p>";
     	}

     	public static function print_report($pizzas, $v_ingr, $admin){
     		$html= html_file::menu_user($admin);
     		$html.="<h1>Report</h1>
     			   <p>Total Pizzas: ".$pizzas["all"]." </p>
     			   <p>Total Pizzas Big: ".$pizzas["big"]." </p>
     			   <p>Total Pizzas Medium: ".$pizzas["medium"]." </p>
     			   <p>Total Pizzas Little: ".$pizzas["little"]." </p>	
     			   <p>Total Pizzas not cooked: ".$pizzas["not_cooked"]." </p>
     			   <p>Total Pizzas not delivered: ".$pizzas["not_delivered"]." </p>
     			   <p>Max time order: ".$pizzas["max_time"]." minutes</p>
     			   <p>Min time order: ".$pizzas["min_time"]." minutes</p>
     			   <p>Average time order: ".$pizzas["avg_time"]." minutes</p>
     			   <br/><br/>
     			   <h2>Ingredients</h2>";
     		for($i=0;$v_ingr && $i<count($v_ingr);$i++){
     			$html.="<p>".$v_ingr[$i]["name"].": ".$v_ingr[$i]["total"]." </p>";
     		}
     		$html.="<br/><br/>
     				<h2>Hour Range</h2>";		
     		for($i=0;$i<24;$i++){
     			$html.="<p>".$pizzas["hour_name"][$i].": <strong>".$pizzas["hour_frame"][$i]."</strong> </p>";
     		}
     		return $html;
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

     	public static function change_register(){
     		return "<form id='my_form' >
     					<p> <input type='text' placeholder='Insert name' name='name' id='name' /> </p>
	    				<p> <input type='text' placeholder='Insert address' name='address' id='address' /> </p>
	    				<p> <input type='text' placeholder='Insert city' name='city' id='city' /> </p>
						<p> Username: </p> 
						<p> <input type='text' id='username' name='username' placeholder='username' /> </p>
						<p>The password must lenght minimun 8 characters, it must contains a symbol, a number, a lower character and a upper character </p>
						<p> Password: </p> 
						<p> <input type='password' id='password' name='password' placeholder='Insert password' /> </p>
						<p> Repeat Password: </p>
						<p> <input type='password' id='password2' name='password2'  placeholder='Repeat password' /> </p>
						<p> <input type='button' id='do_register' name='do_register' value='Save' /> </p>
						<hr/>
						<p> Return to login: <a href='index.php' id='return_login' name='return_login'>Return</a> 	</p>
						<br/>
					</form>";
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



	  }

?>