<!DOCTYPE html>
<html lang = "en">
	<head>
		<meta charset = UTF-8">
		<title> View/Edit Book Locations </title>
		<script src = "/~millerl2/Project/Admin(Incomplete)/admin.js"></script>
		<link rel = "stylesheet" type = "text/css" href = "admin.css">
	</head>

	<body>
		<div id = "container">
		<h1> View and Edit Book Locations</h1>
	<?php
		 include ("connect.php");
		 //get records from database
		 if ($data = $conn->query ("SELECT ShelfNo, First, Last, Map FROM BookLocations1"))
		 {
			 //create and display table of records if there are entries
			 if ($data->num_rows > 0)
			 {
				 echo "<table><tr><th>Shelf No.</th><th>First Book</th><th>Last Book</th><th>Map</th><th></th><th></th>";
				 while ($row = $data->fetch_object())
				 {
					 echo "<tr><td>" . $row->ShelfNo . "</td>";
					 echo "<td>" . $row->First . "</td>";
					 echo "<td>" . $row->Last . "</td>";
					 echo "<td>" . $row->Map . "</td>";
					 echo "<td><a href = 'javascript:editForm(". $row->ShelfNo .")'>Edit</button></td>";
					 echo "<td><a href = 'javascript:confirmDelete(". $row->ShelfNo .")'>Delete</a></td></tr>";
				 }
			 }
			 echo "</table>";
		 }
		 else
		 {
			 echo "The database is curently empty!";
		 }
		 $conn->close();
	?>
		</div>	 		 
	</body>
</html>