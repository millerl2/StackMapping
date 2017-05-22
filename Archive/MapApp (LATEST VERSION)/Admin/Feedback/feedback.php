<!DOCTYPE html>
<html lang = "en">
	<head>
		<meta charset = "UTF-8">
		<link rel="stylesheet" type="text/css" href="../Admin.css">
		<title> View FeedBack Statistics</title>
	</head>
	
	<body>
		<div id = "wrapper">
			<div id = "header-div">
				<h1> View FeedBack Statistics</h1>
			</div>
			
			<div id = "nav-div">
				<ul>
					<li><a href = "../adminPanel.html">Main</a></li>
					<li><a href = "../Book Locations/bookLocations.php">Book Locations</a></li>
					<li><a href = "../Shelf Locations/shelfLocations.php">Shelf Locations</a></li>
					<li><a href = "feedback.php">Feedback Statistics</a></li>
					<li><a href = "../../index.html">Logout</a></li>
				</ul>
			</div>
			
			<div id = "main">
				<br><button type = "button" onClick = "window.location.href = 'fb_graphs.php';">Click here for visualization.</button><br>
	<?php
		include ("../connect.php");
		//get records from database
		if ($data = $conn->query ("SELECT * FROM FeedBack ORDER BY ID"))
		{
			//create and display table of records if there are entries
			if ($data->num_rows > 0)
			{
				echo "<table><tr><th>ID</th><th>Call No.</th><th>Found?</th><th>Time</th>";
				while ($row = $data->fetch_object())
				{
					echo "<tr><td>" . $row->ID . "</td>";
					echo "<td>" . $row->CallNo . "</td>";
					echo "<td>" . $row->Found . "</td>";
					echo "<td>" . $row->Time . "</td>";
				}
			}
			else
			{
				echo "The database is curently empty!";
			}
			echo "</table>";
		}
		$conn->close();
	?>
		</div>
	</div>	 		 
</body>
</html>