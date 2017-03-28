<!DOCTYPE html>
<html lang = "en">
	<head>
		<meta charset = UTF-8">
		<title> View/Edit Shelf Locations </title>
		<script type = "text/javascript">
			function confirmDelete(ShelfNo)
			{
				if (confirm("Are you sure you want to delete this record?"))
				{
					window.location.href = "shelfDelete.php?ShelfNo=" + ShelfNo;
				}
			} 
			function editForm(ShelfNo)
			{
				window.open("shelfEdit.php?ShelfNo=" + ShelfNo, "Edit Record", "height = 400, width = 500");
			}
			function add()
			{
				window.open("shelfAdd.php", "Add Record", "height = 400, width = 500");
			}
		</script>
		<link rel = "stylesheet" type = "text/css" href = "admin.css">
	</head>

	<body>
		<div id = "container">
		<h1> View and Edit Shelf Locations</h1>
		<button type = "button" onClick = "add()">Click here to add new record.</button><br>
	<?php
		include ("connect.php");
		//get records from database
		if ($data = $conn->query ("SELECT * FROM ShelfLoc ORDER BY ShelfNo"))
		{
			//create and display table of records if there are entries
			if ($data->num_rows > 0)
			{
				echo "<table><tr><th>Shelf No.</th><th>X</th><th>Y</th><th>Width</th><th>Height</th><th>Map</th><th></th><th></th>";
				while ($row = $data->fetch_object())
				{
					echo "<tr><td>" . $row->ShelfNo . "</td>";
					echo "<td>" . $row->X . "</td>";
					echo "<td>" . $row->Y . "</td>";
					echo "<td>" . $row->Width . "</td>";
					echo "<td>" . $row->Height . "</td>";
					echo "<td>" . $row->Map . "</td>";
					echo "<td><a href = 'javascript:editForm(". $row->ShelfNo .")'>Edit<a/></td>";
					echo "<td><a href = 'javascript:confirmDelete(". $row->ShelfNo .")'>Delete</a></td></tr>";
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
		<br><button type = "button" onClick = "add()">Click here to add new record.</button><br>
		</div>	 		 
	</body>
</html>