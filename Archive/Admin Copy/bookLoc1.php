<!DOCTYPE html>
<html lang = "en">
	<head>
		<meta charset = UTF-8">
		<title> View/Edit Book Locations </title>
		<script type = "text/javascript">
			function confirmDelete(ShelfNo)
			{
				if (confirm("Are you sure you want to delete this record?"))
				{
					window.location.href = "bookDelete.php?ShelfNo=" + ShelfNo;
				}
			} 
			function editForm(ShelfNo)
			{
				window.open("bookEdit.php?ShelfNo=" + ShelfNo, "Edit Record", "height = 400, width = 500");
			}
			function add()
			{
				window.open("bookAdd.php", "Add Record", "height = 400, width = 500");
			}
		</script>
		<link rel = "stylesheet" type = "text/css" href = "admin.css">
	</head>

	<body>
		<div id = "container">
		<h1> View and Edit Book Locations</h1>
		<button type = "button" onClick = "add()">Click here to add new record.</button><br>
	<?php
		include ("connect.php");
		//get records from database
		if ($data = $conn->query ("SELECT * FROM BookLocations1 ORDER BY ShelfNo"))
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
					echo "<td><a href = 'javascript:editForm(". $row->ShelfNo .")'>Edit</a></td>";
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