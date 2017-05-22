<?php
	include ("connect.php");
	// check if submit is pressed, then process inputs
	if (isset($_POST['submit']))
	{
		$Username = $conn->real_escape_string($_GET['uname']);
		$Password = $conn->real_escape_string($_GET['psw']);
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