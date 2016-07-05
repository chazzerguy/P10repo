<?php
	require_once "connect.php";
	
	
	//This code will only occur after the enter button
	//has been clicked
	if (isset($_POST['mySubmit']) )
	{
		//This code will place the entered data into an
		//Associative array after cleansing
		
		$formfield['cellnumber'] = trim($_POST['cellnumber']);
		
		
		//Validates that the fields were entered
	
		if(empty($formfield['cellnumber'])) {
			$errormsg .= "<p>Your phone number is empty</p>";
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
			$sqlinsert = 'INSERT INTO phone (cellnumber) 
				VALUES (:thecellnumber)';
			
			//Prepares the SQL Statement for execution
			$stmtinsert = $db->prepare($sqlinsert);
			//Binds our associative array variables to the bound
			//variables in the sql statement
			
			$stmtinsert->bindvalue(':thecellnumber', $formfield['cellnumber']);
			//Runs the insert statement and query
			$stmtinsert->execute();
			
		}
		
		
	
	
	
	$sqlselect = "SELECT * from phone";
	$result = $db->prepare($sqlselect);
	$result->execute();
?>

<center>
<label>Enter in your cell phone number</label>	
	<fieldset><legend>Phone Number</legend>
		<form action="<?php echo $_SERVER['PHP_SELF'];?>" method = "post">
		<div>
		<table>

			<tr>
				<th>Phone Number:</th>
				<td><input type="text" name="cellnumber" id="cellnumber" 
					value = "<?php echo $formfield['cellnumber'] ?>" ></td>
			</tr>
	
		</table>
		</div>
			<input type="submit" name = "mySubmit" value="Enter">
		</form>

	</fieldset>
	</center>
	
