<?php
	include ("connect.php");
	function showData($CallNo = '', $ShelfNo ='', $Found = '', $Time = '')
	{ 
?>
		<!DOCTYPE html> 
		<html lang = "en">
		<head>
		<meta charset = UTF-8">
		<link rel = "stylesheet" href = "admin.css">
		</head>
	
		<body>
		<div id = "container">
			<h1> Edit Record </h1>
			<form action = "" method = "post">
			<label>CallNo:</label><input type = "text" name = "CallNo" value = "<?php echo $CallNo; ?>" readonly><br>
			<br><label>ShelfNo:</label><input type = "integer" name = "ShelfNo" value = "<?php echo $ShelfNo; ?>"><br>
			<br><label>Found:</label><input type = "integer" name = "Found" value = "<?php echo $Found; ?>"><br>
			<br><label>Time:</label><input type = "datetime" name = "Time" value = "<?php echo $Time; ?>"><br>
			<br><input type = "submit" name = "submit" value = "Submit">
			</form>
		</div>
<?php 
	}
	// if submit is pressed, submit the form with updated data
	if (isset($_POST['submit']))
	{
		$CallNo = $_GET['CallNo'];
		$ShelfNo = $conn->real_escape_string($_POST['ShelfNo']);
		$Found = $conn->real_escape_string($_POST['Found']);
		$Time = $conn->real_escape_string($_POST['Time']);
		//check that all fields are filled
		if (($CallNo || $ShelfNo || $Found || $Time) == null)
		{
			echo "Error: Please fill in all fields.";
		}
		else
		{
			if ($stmt = $conn->prepare("UPDATE FeedBack SET ShelfNo = ?, Found = ?, datetime = ? WHERE CallNo = $CallNo"))
			{
				$stmt->bind_param("sss",$ShelfNo,$Found,$Time);
				$stmt->execute();
				$stmt->close();
				header("Location: feedback.php");
			}
			else
			{
				echo "Error: Unable to complete edit request.";
			}
		}
	}
	// else if submit button is not pressed, show form with current data 
	else
	{
		$CallNo = $_GET['CallNo'];
		if ($stmt = $conn->prepare("SELECT * FROM FeedBack WHERE CallNo = ?"))
		{
			$stmt->bind_param("i",$CallNo);
			$stmt->execute();
			$stmt->bind_result($CallNo,$ShelfNo,$Found,$Time);
			$data = $stmt->fetch();
			$stmt->close();
		}
		showData($CallNo,$ShelfNo,$Found,$Time);
	}	
	$conn->close();
?>	
	</body>
</html>