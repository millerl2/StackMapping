<!DOCTYPE html>
<html lang = "en">
	<head>
		<meta charset = "UTF-8">
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<link rel="stylesheet" type="text/css" href="../Admin.css">
	</head>
		
	<body>
	<div id = "wrapper">
			<div id = "header-div">
				<h1> Visualization Based on Subjects </h1>
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
			
			<div id = "graphmain">
				<img src = "legend.png" height = "40px" style = "position: fixed; right: 0px; z-index: 1; border: 1px solid #ccc; box-shadow: -5px 6px 8px #A9A9A9;"></img>
	
<?php
	function draw ($subject = '', $chart = '', $yes = '', $no = '', $size = '')
	{
?>		
		<script type="text/javascript">
			
			google.charts.load('current', {'packages':['corechart']});
			google.charts.setOnLoadCallback(drawChart);
			
			function drawChart() 
			{
				var data = google.visualization.arrayToDataTable([
				['Feedback', 'Count', { role: 'style' }],
				['Found', <?php echo $yes ?>, '#96d1ea'],
				['Not Found', <?php echo $no ?>, '#ffb1aa']
				]);

				var pie_options = {
				width: <?php echo $size ?>,
                height: <?php echo $size ?>,
				colors: ['#96d1ea','#ffb1aa'],
				legend: 'none',
				pieSliceTextStyle: {fontSize: 12},
				tooltip: {textStyle: {fontSize: 12}},
				chartArea: {width: '80%', height: '80%'}
				};
				
				var pie_chart = new google.visualization.PieChart(document.getElementById('pie_<?php echo $chart ?>'));
				pie_chart.draw(data, pie_options);
				
				var bar_options = {
				title: '<?php echo $subject ?>',
				titleTextStyle: {fontSize: 18, bold: true},
			    width: 800,
				height: 300,
				hAxis: {textStyle: {color: 'gray'}, ticks: [0,10,20,30,40,50,60,70,80,90,100]},
				vAxis: {textStyle: {color: 'gray', bold: true}},
				legend: 'none',
				chartArea: {left: '120', width: '70%'}
				};
				
				var bar_chart = new google.visualization.BarChart(document.getElementById('bar_<?php echo $chart ?>'));
				bar_chart.draw(data, bar_options);		
			}
		</script>
<?php
}
?>
				<table id = "graphs">
					<tr>
						<td><div id = "bar_total_chart"></div></td>
						<td><div id = "pie_total_chart"></div></td>
					</tr>
					<tr>
						<td><div id = "bar_anthro_chart"></div></td>
						<td><div id = "pie_anthro_chart"></div></td>
					</tr>
					<tr>
						<td><div id = "bar_finearts_chart"></div></td>
						<td><div id = "pie_finearts_chart"></div></td>
					</tr>
					<tr>
						<td><div id = "bar_bio_chart"></div></td>
						<td><div id = "pie_bio_chart"></div></td>
					</tr>
					<tr>
						<td><div id = "bar_bus_chart"></div></td>
						<td><div id = "pie_bus_chart"></div></td>
					</tr>
					<tr>
						<td><div id = "bar_chem_chart"></div></td>
						<td><div id = "pie_chem_chart"></div></td>
					</tr>
					<tr>
						<td><div id = "bar_commmed_chart"></div></td>
						<td><div id = "pie_commmed_chart"></div></td>
					</tr>
					<tr>
						<td><div id = "bar_commdis_chart"></div></td>
						<td><div id = "pie_commdis_chart"></div></td>
					</tr>
					<tr>
						<td><div id = "bar_cs_chart"></div></td>
						<td><div id = "pie_cs_chart"></div></td>
					</tr>
					<tr>
						<td><div id = "bar_econ_chart"></div></td>
						<td><div id = "pie_econ_chart"></div></td>
					</tr>
					<tr>
						<td><div id = "bar_edu_chart"></div></td>
						<td><div id = "pie_edu_chart"></div></td>
					</tr>
					<tr>
						<td><div id = "bar_engineer_chart"></div></td>
						<td><div id = "pie_engineer_chart"></div></td>
					</tr>
					<tr>
						<td><div id = "bar_eng_chart"></div></td>
						<td><div id = "pie_eng_chart"></div></td>
					</tr>
					<tr>
						<td><div id = "bar_geog_chart"></div></td>
						<td><div id = "pie_geog_chart"></div></td>
					</tr>
					<tr>
						<td><div id = "bar_geol_chart"></div></td>
						<td><div id = "pie_geol_chart"></div></td>
					</tr>
					<tr>
						<td><div id = "bar_hist_chart"></div></td>
						<td><div id = "pie_hist_chart"></div></td>
					</tr>
					<tr>
						<td><div id = "bar_music_chart"></div></td>
						<td><div id = "pie_music_chart"></div></td>
					</tr>
					<tr>
						<td><div id = "bar_nurse_chart"></div></td>
						<td><div id = "pie_nurse_chart"></div></td>
					</tr>
					<tr>
						<td><div id = "bar_phys_chart"></div></td>
						<td><div id = "pie_phys_chart"></div></td>
					</tr>
					<tr>
						<td><div id = "bar_polsci_chart"></div></td>
						<td><div id = "pie_polsci_chart"></div></td>
					</tr>
					<tr>
						<td><div id = "bar_psy_chart"></div></td>
						<td><div id = "pie_psy_chart"></div></td>
					</tr>
					<tr>
						<td><div id = "bar_relig_chart"></div></td>
						<td><div id = "pie_relig_chart"></div></td>
					</tr>
					<tr>
						<td><div id = "bar_socio_chart"></div></td>
						<td><div id = "pie_socio_chart"></div></td>
					</tr>
					<tr>
						<td><div id = "bar_thea_chart"></div></td>
						<td><div id = "pie_thea_chart"></div></td>
					</tr>
					<tr>
						<td><div id = "bar_unknown_chart"></div></td>
						<td><div id = "pie_unknown_chart"></div></td>
					</tr>
				</table>
			</div>
		</div>
	</body>
</html>
<?php
	include ("../connect.php");
	function setRadius ($total)
	{
		$minR = 100;
		$maxR = 400;
		$maxT = 20;
		if ($total > $maxT)
		{
			$total = $maxT;
		}
		$r = $total * ($maxR/$maxT);
		if ($r < $minR)
		{
			$r = $minR;
		}
		return $r;		
	}
	// ycount and ncount will count total number of yes's and no's, to be used to calculate the unknown subjects
	$ycount = 0;
	$ncount = 0;
	// find all CallNo that starts with the string 'GN'
	if ($data = $conn->query ("SELECT Found FROM FeedBack"))
	{	
		$yes = 0;
		$no = 0;
		$subject = 'Total';
		$chart = 'total_chart';
		if ($data->num_rows > 0)
		{
			while ($row = $data->fetch_object())
			{
				if ($row->Found == '1'){$yes++;}
				else if ($row->Found == '0'){$no++;}
			}
		}
		$radius = setRadius($yes+$no);
		draw($subject,$chart,$yes,$no,$radius);
	}
	if ($data = $conn->query ("SELECT Found FROM FeedBack WHERE CallNo REGEXP '^GN'"))
	{	
		// yes and no will count what's found or not found based on the query
		$yes = 0;
		$no = 0;
		// if CallNo starts with 'GN', subject has to be anthropology
		$subject = 'Anthropology';
		$chart = 'anthro_chart';
		// check that data exists
		if ($data->num_rows > 0)
		{
			// fetch the Found values and increment variables
			while ($row = $data->fetch_object())
			{
				if ($row->Found == '1'){$yes++; $ycount++;}
				else if ($row->Found == '0'){$no++; $ncount++;}
			}
		}
		// send all the data to google chart function
		$radius = setRadius($yes+$no);
		draw($subject,$chart,$yes,$no,$radius);
	}
	if ($data = $conn->query ("SELECT Found FROM FeedBack WHERE CallNo BETWEEN 'N' and 'NY'"))
	{	
		$yes = 0;
		$no = 0;
		$subject = 'Arts, Fine Arts';
		$chart = 'finearts_chart';
		if ($data->num_rows > 0)
		{
			while ($row = $data->fetch_object())
			{
				if ($row->Found == '1'){$yes++; $ycount++;}
				else if ($row->Found == '0'){$no++; $ncount++;}
			}
		}
		$radius = setRadius($yes+$no);
		draw($subject,$chart,$yes,$no,$radius);
	}
	if ($data = $conn->query ("SELECT Found FROM FeedBack WHERE CallNo BETWEEN 'QH' and 'QS'"))
	{	
		$yes = 0;
		$no = 0;
		$subject = 'Biology';
		$chart = 'bio_chart';
		if ($data->num_rows > 0)
		{
			while ($row = $data->fetch_object())
			{
				if ($row->Found == '1'){$yes++; $ycount++;}
				else if ($row->Found == '0'){$no++; $ncount++;}
			}
		}
		$radius = setRadius($yes+$no);
		draw($subject,$chart,$yes,$no,$radius);
	}
	if ($data = $conn->query ("SELECT Found FROM FeedBack WHERE CallNo BETWEEN 'HF' and 'HK'"))
	{	
		$yes = 0;
		$no = 0;
		$subject = 'Business';
		$chart = 'bus_chart';
		if ($data->num_rows > 0)
		{
			while ($row = $data->fetch_object())
			{
				if ($row->Found == '1'){$yes++; $ycount++;}
				else if ($row->Found == '0'){$no++; $ncount++;}
			}
		}
		$radius = setRadius($yes+$no);
		draw($subject,$chart,$yes,$no,$radius);
	}
	if ($data = $conn->query ("SELECT Found FROM FeedBack WHERE CallNo REGEXP '^QD'"))
	{	
		$yes = 0;
		$no = 0;
		$subject = 'Chemistry';
		$chart = 'chem_chart';
		if ($data->num_rows > 0)
		{
			while ($row = $data->fetch_object())
			{
				if ($row->Found == '1'){$yes++; $ycount++;}
				else if ($row->Found == '0'){$no++; $ncount++;}
			}
		}
		$radius = setRadius($yes+$no);
		draw($subject,$chart,$yes,$no,$radius);
	}
	if ($data = $conn->query ("SELECT Found FROM FeedBack WHERE CallNo BETWEEN 'P87' and 'P97'"))
	{	
		$yes = 0;
		$no = 0;
		$subject = 'Communication & Media';
		$chart = 'commmed_chart';
		if ($data->num_rows > 0)
		{
			while ($row = $data->fetch_object())
			{
				if ($row->Found == '1'){$yes++; $ycount++;}
				else if ($row->Found == '0'){$no++; $ncount++;}
			}
		}
		$radius = setRadius($yes+$no);
		draw($subject,$chart,$yes,$no,$radius);
	}
	if ($data = $conn->query ("SELECT Found FROM FeedBack WHERE CallNo BETWEEN 'RC423' and 'RC429'"))
	{	
		$yes = 0;
		$no = 0;
		$subject = 'Communication Disorders';
		$chart = 'commdis_chart';
		if ($data->num_rows > 0)
		{
			while ($row = $data->fetch_object())
			{
				if ($row->Found == '1'){$yes++; $ycount++;}
				else if ($row->Found == '0'){$no++; $ncount++;}
			}
		}
		$radius = setRadius($yes+$no);
		draw($subject,$chart,$yes,$no,$radius);
	}
	if ($data = $conn->query ("SELECT Found FROM FeedBack WHERE CallNo REGEXP '^QA'"))
	{	
		$yes = 0;
		$no = 0;
		$subject = 'Computer Science & Mathematics';
		$chart = 'cs_chart';
		if ($data->num_rows > 0)
		{
			while ($row = $data->fetch_object())
			{
				if ($row->Found == '1'){$yes++; $ycount++;}
				else if ($row->Found == '0'){$no++; $ncount++;}
			}
		}
		$radius = setRadius($yes+$no);
		draw($subject,$chart,$yes,$no,$radius);
	}
	if ($data = $conn->query ("SELECT Found FROM FeedBack WHERE CallNo BETWEEN 'HB' and 'HD'"))
	{	
		$yes = 0;
		$no = 0;
		$subject = 'Economics';
		$chart = 'econ_chart';
		if ($data->num_rows > 0)
		{
			while ($row = $data->fetch_object())
			{
				if ($row->Found == '1'){$yes++; $ycount++;}
				else if ($row->Found == '0'){$no++; $ncount++;}
			}
		}
		$radius = setRadius($yes+$no);
		draw($subject,$chart,$yes,$no,$radius);
	}
	if ($data = $conn->query ("SELECT Found FROM FeedBack WHERE CallNo BETWEEN 'L' and 'LU'"))
	{	
		$yes = 0;
		$no = 0;
		$subject = 'Education';
		$chart = 'edu_chart';
		if ($data->num_rows > 0)
		{
			while ($row = $data->fetch_object())
			{
				if ($row->Found == '1'){$yes++; $ycount++;}
				else if ($row->Found == '0'){$no++; $ncount++;}
			}
		}
		$radius = setRadius($yes+$no);
		draw($subject,$chart,$yes,$no,$radius);
	}
	if ($data = $conn->query ("SELECT Found FROM FeedBack WHERE CallNo REGEXP '^TK'"))
	{	
		$yes = 0;
		$no = 0;
		$subject = 'Engineering';
		$chart = 'engineer_chart';
		if ($data->num_rows > 0)
		{
			while ($row = $data->fetch_object())
			{
				if ($row->Found == '1'){$yes++; $ycount++;}
				else if ($row->Found == '0'){$no++; $ncount++;}
			}
		}
		$radius = setRadius($yes+$no);
		draw($subject,$chart,$yes,$no,$radius);
	}
	if ($data = $conn->query ("SELECT Found FROM FeedBack WHERE CallNo REGEXP '^P'"))
	{	
		$yes = 0;
		$no = 0;
		$subject = 'English/Language/Literature';
		$chart = 'eng_chart';
		if ($data->num_rows > 0)
		{
			while ($row = $data->fetch_object())
			{
				if ($row->Found == '1'){$yes++; $ycount++;}
				else if ($row->Found == '0'){$no++; $ncount++;}
			}
		}
		$radius = setRadius($yes+$no);
		draw($subject,$chart,$yes,$no,$radius);
	}
	if ($data = $conn->query ("SELECT Found FROM FeedBack WHERE CallNo BETWEEN 'G' and 'GG'"))
	{	
		$yes = 0;
		$no = 0;
		$subject = 'Geography';
		$chart = 'geog_chart';
		if ($data->num_rows > 0)
		{
			while ($row = $data->fetch_object())
			{
				if ($row->Found == '1'){$yes++; $ycount++;}
				else if ($row->Found == '0'){$no++; $ncount++;}
			}
		}
		$radius = setRadius($yes+$no);
		draw($subject,$chart,$yes,$no,$radius);
	}
	if ($data = $conn->query ("SELECT Found FROM FeedBack WHERE CallNo REGEXP '^QE'"))
	{	
		$yes = 0;
		$no = 0;
		$subject = 'Geology';
		$chart = 'geol_chart';
		if ($data->num_rows > 0)
		{
			while ($row = $data->fetch_object())
			{
				if ($row->Found == '1'){$yes++; $ycount++;}
				else if ($row->Found == '0'){$no++; $ncount++;}
			}
		}
		$radius = setRadius($yes+$no);
		draw($subject,$chart,$yes,$no,$radius);
	}
	if ($data = $conn->query ("SELECT Found FROM FeedBack WHERE CallNo BETWEEN 'D' and 'G'"))
	{	
		$yes = 0;
		$no = 0;
		$subject = 'History';
		$chart = 'hist_chart';
		if ($data->num_rows > 0)
		{
			while ($row = $data->fetch_object())
			{
				if ($row->Found == '1'){$yes++; $ycount++;}
				else if ($row->Found == '0'){$no++; $ncount++;}
			}
		}
		$radius = setRadius($yes+$no);
		draw($subject,$chart,$yes,$no,$radius);
	}
	if ($data = $conn->query ("SELECT Found FROM FeedBack WHERE CallNo BETWEEN 'M' and 'MU'"))
	{	
		$yes = 0;
		$no = 0;
		$subject = 'Music';
		$chart = 'music_chart';
		if ($data->num_rows > 0)
		{
			while ($row = $data->fetch_object())
			{
				if ($row->Found == '1'){$yes++; $ycount++;}
				else if ($row->Found == '0'){$no++; $ncount++;}
			}
		}
		$radius = setRadius($yes+$no);
		draw($subject,$chart,$yes,$no,$radius);
	}
	if ($data = $conn->query ("SELECT Found FROM FeedBack WHERE CallNo REGEXP '^RT'"))
	{	
		$yes = 0;
		$no = 0;
		$subject = 'Nursing';
		$chart = 'nurse_chart';
		if ($data->num_rows > 0)
		{
			while ($row = $data->fetch_object())
			{
				if ($row->Found == '1'){$yes++; $ycount++;}
				else if ($row->Found == '0'){$no++; $ncount++;}
			}
		}
		$radius = setRadius($yes+$no);
		draw($subject,$chart,$yes,$no,$radius);
	}
	if ($data = $conn->query ("SELECT Found FROM FeedBack WHERE CallNo REGEXP '^QC'"))
	{	
		$yes = 0;
		$no = 0;
		$subject = 'Physics';
		$chart = 'phys_chart';
		if ($data->num_rows > 0)
		{
			while ($row = $data->fetch_object())
			{
				if ($row->Found == '1'){$yes++; $ycount++;}
				else if ($row->Found == '0'){$no++; $ncount++;}
			}
		}
		$radius = setRadius($yes+$no);
		draw($subject,$chart,$yes,$no,$radius);
	}
	if ($data = $conn->query ("SELECT Found FROM FeedBack WHERE CallNo BETWEEN 'J' and 'JY'"))
	{	
		$yes = 0;
		$no = 0;
		$subject = 'Political Science';
		$chart = 'polsci_chart';
		if ($data->num_rows > 0)
		{
			while ($row = $data->fetch_object())
			{
				if ($row->Found == '1'){$yes++; $ycount++;}
				else if ($row->Found == '0'){$no++; $ncount++;}
			}
		}
		$radius = setRadius($yes+$no);
		draw($subject,$chart,$yes,$no,$radius);
	}
	if ($data = $conn->query ("SELECT Found FROM FeedBack WHERE CallNo REGEXP '^BF'"))
	{	
		$yes = 0;
		$no = 0;
		$subject = 'Psychology';
		$chart = 'psy_chart';
		if ($data->num_rows > 0)
		{
			while ($row = $data->fetch_object())
			{
				if ($row->Found == '1'){$yes++; $ycount++;}
				else if ($row->Found == '0'){$no++; $ncount++;}
			}
		}
		$radius = setRadius($yes+$no);
		draw($subject,$chart,$yes,$no,$radius);
	}
	if ($data = $conn->query ("SELECT Found FROM FeedBack WHERE CallNo BETWEEN 'BL' and 'BY'"))
	{	
		$yes = 0;
		$no = 0;
		$subject = 'Religion';
		$chart = 'relig_chart';
		if ($data->num_rows > 0)
		{
			while ($row = $data->fetch_object())
			{
				if ($row->Found == '1'){$yes++; $ycount++;}
				else if ($row->Found == '0'){$no++; $ncount++;}
			}
		}
		$radius = setRadius($yes+$no);
		draw($subject,$chart,$yes,$no,$radius);
	}
	if ($data = $conn->query ("SELECT Found FROM FeedBack WHERE CallNo BETWEEN 'HM' and 'HY'"))
	{	
		$yes = 0;
		$no = 0;
		$subject = 'Sociology';
		$chart = 'socio_chart';
		if ($data->num_rows > 0)
		{
			while ($row = $data->fetch_object())
			{
				if ($row->Found == '1'){$yes++; $ycount++;}
				else if ($row->Found == '0'){$no++; $ncount++;}
			}
		}
		$radius = setRadius($yes+$no);
		draw($subject,$chart,$yes,$no,$radius);
	}
	if ($data = $conn->query ("SELECT Found FROM FeedBack WHERE CallNo BETWEEN 'PN2000' and 'PN3300'"))
	{	
		$yes = 0;
		$no = 0;
		$subject = 'Theatre Arts';
		$chart = 'thea_chart';
		if ($data->num_rows > 0)
		{
			while ($row = $data->fetch_object())
			{
				if ($row->Found == '1'){$yes++; $ycount++;}
				else if ($row->Found == '0'){$no++; $ncount++;}
			}
		}
		$radius = setRadius($yes+$no);
		draw($subject,$chart,$yes,$no,$radius);
	}
	if ($data = $conn->query ("SELECT Found FROM FeedBack"))
	{	
		$yes = 0;
		$no = 0;
		$subject = 'Unknown';
		$chart = 'unknown_chart';
		if ($data->num_rows > 0)
		{
			while ($row = $data->fetch_object())
			{
				if ($row->Found == '1'){$yes++;}
				else if ($row->Found == '0'){$no++;}
			}
		}
		$ycount = $yes - $ycount;
		$ncount = $no - $ncount;
		$radius = setRadius($ycount+$ncount);
		draw($subject,$chart,$ycount,$ncount,$radius);
	}
?>