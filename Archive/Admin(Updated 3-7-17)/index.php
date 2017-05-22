<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
	<link rel = "stylesheet" type = "text/css" href = "admin.css">   
    </head>
	
	<body>
	<div id = "container">
		<h1> Administrator Login </h1>
		<form action = "" method = "post">
		<label>Username:</label><input type = "text" name = "Username" value = ""><br>
		<br><label>Password:</label><input type = "password" name = "Password" value = ""><br>
		<br><input type = "submit" name = "submit" value = "Enter">
		</form>
	</div>

<?php
	include ("connect.php");
	// check if submit is pressed, then process inputs
	if (isset($_POST['submit']))
	{
		$Username = $conn->real_escape_string($_POST['Username']);
		$Password = $conn->real_escape_string($_POST['Password']);
		$stmt = $conn->query("SELECT * FROM login WHERE Username = '{$Username}' AND Password = '{$Password}' LIMIT 1");
		// if a match is found, direct to admin controls page
		if ($stmt->num_rows == 1)
		{
			header ("Location: admin.html");
		}
		//check that all fields are filled
		else if (($Username || $Password) == null)
		{
			echo "Error: Please fill in all fields.";
		}
		else
		{
			echo "Error: Invalid Login Credentials.";
		}
	}
	$conn->close();
?>
	</body>
</html>