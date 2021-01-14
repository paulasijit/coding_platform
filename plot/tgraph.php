<?php
include('connect.php');
session_start();
$id=$_SESSION['id'];

if((isset($_SESSION['id'])))
{
 $query = "SELECT * FROM cups WHERE userid = '$id';";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $dataPoints[] = array(
   'label'   => $row["date"],
   'y'  => $row["cup"]
  );
 }
}
?>
<!DOCTYPE HTML> 
<html> 
<head> 
	<script src="https://canvasjs.com/assets/script/canvasjs.min.js"> 
	</script> 
	<script> 
		window.onload = function () { 
		
			var chart = new CanvasJS.Chart("chartContainer", { 
				animationEnabled: true, 
				title:{ 
					text: "Monthly Purchased and Sold Product"
				},	 
				axisY: { 
					title: "SCORE", 
					titleFontColor: "#4F81BC", 
					lineColor: "#4F81BC", 
					labelFontColor: "#4F81BC", 
					tickColor: "#4F81BC"
				}, 	 
				toolTip: { 
					shared: true 
				}, 
				legend: { 
					cursor:"pointer", 
					itemclick: toggleDataSeries 
				}, 
				data: [{ 
					type: "line", 
					name: "SCORE", 
					legendText: "SCORE", 
					showInLegend: true, 
					dataPoints:<?php echo json_encode($dataPoints, 
							JSON_NUMERIC_CHECK); ?> 
				}, ] 
			}); 
			chart.render(); 
			
			function toggleDataSeries(e) { 
				if (typeof(e.dataSeries.visible) === "undefined"
							|| e.dataSeries.visible) { 
					e.dataSeries.visible = false; 
				} 
				else { 
					e.dataSeries.visible = true; 
				} 
				chart.render(); 
			} 
		
		} 
	</script> 
</head> 

<body> 
	<div id="chartContainer" style="height: 300px; width: 30%;"></div> 
</body> 
</html> 
