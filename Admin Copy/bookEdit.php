<?php
	include ("connect.php");
	function showData($ShelfNo = '', $First ='', $Last = '', $Map = '')
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
			<label>Shelf No:</label><input type = "text" name = "ShelfNo" value = "<?php echo $ShelfNo; ?>" readonly><br>
			<br><label>First Book:</label><input type = "text" name = "First" value = "<?php echo $First; ?>"><br>
			<br><label>Last Book:</label><input type = "text" name = "Last" value = "<?php echo $Last; ?>"><br>
			<br><label>Map:</label><input type = "text" name = "Map" value = "<?php echo $Map; ?>"><br>
			<br><input type = "submit" name = "submit" value = "Submit">
			</form>
		</div>
<?php 
	}
	// if submit is pressed, submit the form with updated data
	if (isset($_POST['submit']))
	{
		$ShelfNo = $_GET['ShelfNo'];
		$First = $conn->real_escape_string($_POST['First']);
		$Last = $conn->real_escape_string($_POST['Last']);
		$Map = $conn->real_escape_string($_POST['Map']);
		//check that all fields are filled
		if (($ShelfNo || $First || $Last || $Map) == null)
		{
			echo "Error: Please fill in all fields.";
		}
		else
		{
			if ($stmt = $conn->prepare("UPDATE BookLocations1 SET First = ?, Last = ?, Map = ? WHERE ShelfNo = $ShelfNo"))
			{
				$stmt->bind_param("sss",$First,$Last,$Map);
				$stmt->execute();
				$stmt->close();
				header("Location: bookLoc1.php");
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
		$ShelfNo = $_GET['ShelfNo'];
		if ($stmt = $conn->prepare("SELECT * FROM BookLocations1 WHERE ShelfNo = ?"))
		{
			$stmt->bind_param("i",$ShelfNo);
			$stmt->execute();
			$stmt->bind_result($ShelfNo,$First,$Last,$Map);
			$data = $stmt->fetch();
			$stmt->close();
		}
		showData($ShelfNo,$First,$Last,$Map);
	}	
	$conn->close();
?>	
	</body>
</html>