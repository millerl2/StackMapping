<!DOCTYPE html>
<html lang = "en">
	<head>
		<meta charset = UTF-8">
		<title> View/Edit FeedBack Statistics </title>
		<script type = "text/javascript">
			function confirmDelete(CallNo)
			{
				if (confirm("Are you sure you want to delete this record?"))
				{
					window.location.href = "feedbackDelete.php?CallNo=" + CallNo;
				}
			} 
			function editForm(CallNo)
			{
				window.open("feedback.php?CallNo=" + CallNo, "Edit Record", "height = 400, width = 500");
			}
			function add()
			{
				window.open("feedbackAdd.php", "Add Record", "height = 400, width = 500");
			}
		</script>
		<link rel = "stylesheet" type = "text/css" href = "admin.css">
	</head>

	<body>
		<div id = "container">
		<h1> View and Edit FeedBack Statistics</h1>
		<button type = "button" onClick = "add()">Click here to add new record.</button><br>
	<?php
		 include ("connect.php");
		 //get records from database
		 if ($data = $conn->query ("SELECT * FROM FeedBack ORDER BY CallNo"))
		 {
			 //create and display table of records if there are entries
			 if ($data->num_rows > 0)
			 {
				 echo "<table><tr><th>CallNo</th><th>ShelfNo</th><th>Found</th><th>Time</th><th></th><th></th>";
				 while ($row = $data->fetch_object())
				 {
					 echo "<tr><td>" . $row->CallNo . "</td>";
					 echo "<td>" . $row->ShelfNo . "</td>";
					 echo "<td>" . $row->Found . "</td>";
					 echo "<td>" . $row->Time . "</td>";
					 echo "<td><a href = 'javascript:editForm(". $row->CallNo .")'>Edit</button></td>";
					 echo "<td><a href = 'javascript:confirmDelete(". $row->CallNo .")'>Delete</a></td></tr>";
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
		<br><button type = "button" onClick = "add()">Click here to add new record.</button><br>
		</div>	 		 
	</body>
</html>