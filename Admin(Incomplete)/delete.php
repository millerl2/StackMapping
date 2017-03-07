<?php
	include ("connect.php")
	
	if (isset($_GET['ShelfNo']) //&& is_numeric($_GET['ShelfNo']))
	{
		$ShelfNo = $_GET['ShelfNo'];
		if ($del = $conn->prepare("DELETE FROM BookLocations1 WHERE ShelfNo = ? LIMIT 1"))
		{
			$del->bind_param("i",$ShelfNo);
			$del->execute();
			$del->close();
		}
	}
	else
	{
		echo "ERROR: Cannot complete delete request.";
	}
	$conn->close();
	// refresh page after deletion
	header ("Location: bookLocCon.php");
?>