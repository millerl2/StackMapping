<!DOCTYPE html>
<html lang = "en">
	<head>
		<meta charset = "UTF-8">

		<!-- Bootstrap -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- Font Awesome -->
		<script src="https://use.fontawesome.com/d193df2c43.js"></script>

		<!-- jQuery -->
		<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

		<title> View/Edit Book Locations </title>
		<script type = "text/javascript">
			function confirmDelete(ShelfNo)
			{
				if (confirm("Are you sure you want to delete this record?"))
				{
					window.location.href = "bookDelete.php?ShelfNo=" + ShelfNo;
				}
			} 
			function edit(ShelfNo)
			{
				document.getElementById('edit').style.display = 'block';
				document.getElementById('ShelfNo').value = ShelfNo;
			}
			function add()
			{
				document.getElementById('add').style.display = 'block';
			}
		</script>
	</head>

	<body>
		<div id = "wrapper">
			<div id = "header-div">
				<h1> View and Edit Book Locations</h1>
			</div>
			
			<div id = "nav-div">
				<ul>
					<li><a href = "../adminPanel.html">Main</a></li>
					<li><a href = "bookLocations.php">Book Locations</a></li>
					<li><a href = "../Shelf Locations/shelfLocations.php">Shelf Locations</a></li>
					<li><a href = "../Feedback/feedback.php">Feedback Statistics</a></li>
					<li><a href = "../../index.html">Logout</a></li>
				</ul>
			</div>
			
			<div id = "main">
				<br><button type = "button" onClick = "add()">Click here to add new record.</button><br>
	<?php
		include ("../connect.php");
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
					echo "<td><a href = 'javascript:edit(". $row->ShelfNo .")'>Edit<a/></td>";
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
			
		</div>
		
		<div id = "add" class = "modal">
			<form class = "modal-content animate" action = "bookAdd.php" method = "post">
				<div class = "imgcontainer">
					<span onclick = "document.getElementById('add').style.display = 'none'" class = "close" title = "Close Modal">&times;</span>
				</div>
				<div class = "container">
					<h1 class = "modalh1"> Add Entry </h1>
					<label>Shelf No</label><input type = "text" name = "ShelfNo" value = "" required><br>
					<br><label>First Book</label><input type = "text" name = "First" value = "" required><br>
					<br><label>Last Book</label><input type = "text" name = "Last" value = "" required><br>
					<br><label>Map</label><input type = "text" name = "Map" value = "" required><br>
					<br><input class = "modalbutton" type = "submit" name = "submit" value = "Submit">
				</div>
				<div class = "container" style = "background-color: #f1f1f1">
					<button class = "modalbutton cancelbtn" type = "button" onclick = "document.getElementById('add').style.display = 'none'">Cancel</button>
				</div>
			</form>
		</div>	
		
		<div id = "edit" class = "modal">
			<form class = "modal-content animate" action = "bookEdit.php" method = "post">
				<div class = "imgcontainer">
					<span onclick = "document.getElementById('edit').style.display = 'none'" class = "close" title = "Close Modal">&times;</span>
				</div>
				<div class = "container">
					<h1 class = "modalh1"> Edit Record </h1>
					<label>Shelf No</label><input id = "ShelfNo" type = "text" name = "ShelfNo" value = "" readonly><br>
					<br><label>First Book</label><input type = "text" name = "First" value = "" required><br>
					<br><label>Last Book</label><input type = "text" name = "Last" value = "" required><br>
					<br><label>Map</label><input type = "text" name = "Map" value = "" required><br>
					<br><input class = "modalbutton" type = "submit" name = "submit" value = "Submit">
				</div>
				<div class = "container" style = "background-color: #f1f1f1">
					<button class = "modalbutton cancelbtn" type = "button" onclick = "document.getElementById('edit').style.display = 'none'">Cancel</button>
				</div>
			</form>
		</div>
		
		<script>
		var modal1 = document.getElementById('add');
		var modal2 = document.getElementById('edit');
		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) 
		{
			if (event.target == modal1 || event.target == modal2) 
			{
				modal1.style.display = "none";
				modal2.style.display = "none";
			}
		}
		</script>

		<!-- Bootstrap JS -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	</body>
</html>