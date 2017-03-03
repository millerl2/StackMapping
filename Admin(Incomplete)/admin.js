function confirmDelete(ShelfNo)
{
	if (confirm("Are you sure you want to delete this entry?"))
	{
		window.location.href = "delete.php?ShelfNo=" + ShelfNo;
	}
} 
function editForm(ShelfNo)
{
	window.open("edit.php?ShelfNo=" + ShelfNo, "Edit Entry", "height = 400, width = 500");
}
	
