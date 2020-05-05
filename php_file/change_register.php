<?php

	echo   "<form id='my_form' >
			
				<p> Username: </p> 
				<p> <input type='text' id='username' name='username' /> </p>
				
				<p>The password must lenght minimun 8 characters, it must contains a symbol, a number, a lower character and a upper character </p>

				<p> Password: </p> 
				<p> <input type='password' id='password' name='password' /> </p>
				<p> Repeat Password: </p>
				<p> <input type='password' id='password2' name='password2' /> </p>
				<p> <input type='button' id='do_register' name='do_register' value='Save' /> </p>
				<hr/>
				<p> Return to login: <input type='button' id='return_login' name='return_login' value='Return' /> 	</p>
				<br/>
			</form>";

?>