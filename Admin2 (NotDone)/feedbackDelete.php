<?php
	include ("connect.php");
	
	if (isset($_GET['CallNo']) && is_numeric($_GET['CallNo']))
	{
		$CallNo = $_GET['CallNo'];
		if ($stmt = $conn->prepare("DELETE FROM FeedBack WHERE CallNo = ? LIMIT 1"))
		{
			$stmt->bind_param("i",$CallNo);
			$stmt->execute();
			$stmt->close();
			// refresh page after deletion
			header ("Location: feedback.php");
		}
		else
		{
			echo "ERROR: Cannot complete delete request.";
		}
	}
	$conn->close();
?>