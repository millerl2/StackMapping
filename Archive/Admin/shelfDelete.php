<?php
	include ("connect.php");
	
	if (isset($_GET['ShelfNo']) && is_numeric($_GET['ShelfNo']))
	{
		$ShelfNo = $_GET['ShelfNo'];
		if ($stmt = $conn->prepare("DELETE FROM ShelfLocations1 WHERE ShelfNo = ? LIMIT 1"))
		{
			$stmt->bind_param("i",$ShelfNo);
			$stmt->execute();
			$stmt->close();
			// refresh page after deletion
			header ("Location: shelfLoc1.php");
		}
		else
		{
			echo "ERROR: Cannot complete delete request.";
		}
	}
	$conn->close();
?>