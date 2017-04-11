$(document).ready(function(){
	
	$('#form-new').submit(function(event){
		event.preventDefault();
		
		var form = $(this);
		//get callNum from textbox
		var data = form.serialize();
		//console.log(callNum);
		
		$.ajax({
			
			url: 'test.php',
			data: data
			
		});
	});
	
});