<?php
	require_once "connect.php";
	
	
	//This code will only occur after the enter button
	//has been clicked
	if (isset($_POST['mySubmit']) )
	{
		//This code will place the entered data into an
		//Associative array after cleansing

		$formfield['eaddress'] = trim($_POST['address']);
		$formfield['ecity'] = trim($_POST['city']);
		$formfield['estate'] = trim($_POST['state']);
		$formfield['ezip'] = trim($_POST['zip']);
		
		
		//Validates that the fields were entered

		if(empty($formfield['eaddress'])) {
			$errormsg .= "<p>Your address is empty</p>";
		}
		if(empty($formfield['ecity'])) {
			$errormsg .= "<p>Your city is empty</p>";
		}
		if(empty($formfield['estate'])) {
			$errormsg .= "<p>Your state empty</p>";
		}

		//This could check two fields to see if they were the same
		//Good for passwords and emails
		/*
		if ($formfield['myname'] == $formfield['myaddress']) {
			$errormsg .= "<p>Your Whatevers do not match</p>";
		}
		*/
		
		if ($errormsg != "") {
			echo "YOU HAVE ERRORS!!!!";
			echo $errormsg;
		}		
			//echo $securepwd;
			//Creates the sql query
			$sqlinsert = 'INSERT INTO address (address, city, state, zipcode) 
				VALUES (:theaddress, :thecity, :thestate, :thezip)';
			
			//Prepares the SQL Statement for execution
			$stmtinsert = $db->prepare($sqlinsert);
			//Binds our associative array variables to the bound
			//variables in the sql statement

			$stmtinsert->bindvalue(':theaddress', $formfield['eaddress']);
			$stmtinsert->bindvalue(':thecity', $formfield['ecity']);
			$stmtinsert->bindvalue(':thestate', $formfield['estate']);
			$stmtinsert->bindvalue(':thezip', $formfield['ezip']);

			//Runs the insert statement and query
			$stmtinsert->execute();
			
		}
		
		
	
	
	
	$sqlselect = "SELECT * from address";
	$result = $db->prepare($sqlselect);
	$result->execute();
?>

<center>

	<fieldset><legend>Employee Info</legend>
		<form action="<?php echo $_SERVER['PHP_SELF'];?>" method = "post">
		<div>
		<table>


			<tr>
				<th>Address:</th>
				<td><input type="text" name="address" id="address" 
					value = "<?php echo $formfield['eaddress'] ?>" ></td>
			</tr>
			<tr>
				<th>City:</th>
				<td><input type="text" name="city" id="city" 
					value = "<?php echo $formfield['ecity'] ?>" ></td>
			</tr>
			<tr>
				<th>State:</th>
				<td><input type="text" name="state" id="state" 
					value = "<?php echo $formfield['estate'] ?>" ></td>
			</tr>
			<tr>
				<th>Zip Code:</th>
				<td><input type="text" name="zip" id="zip" 
					value = "<?php echo $formfield['ezip'] ?>" ></td>
			</tr>				

	
		</table>
		</div>
			<input type="submit" name = "mySubmit" value="Enter">
		</form>

	</fieldset>
	</center>
	
