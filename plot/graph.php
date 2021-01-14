<!--<?php
include 'connection.php';
$id=$_SESSION['id'];
$bulan = mysqli_query($db, "SELECT cup FROM cups WHERE userid='$id'");
$row = mysqli_query($db, "SELECT cups.date FROM cups WHERE userid='$id'");
$c=0;
?>
<html>
<head>
<title>CodeWar</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.js"></script>
<style type="text/css">
.container {
            width: 30%;
            margin: 15px auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <canvas id="myChart" width="40" height="23"></canvas>
    </div>
    <script>
        var ctx = document.getElementById("myChart");
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [<?php while ($p = mysqli_fetch_array($row)) { echo '"' . $p['date'] . '",';}?>],
                datasets: [{
                        label: 'SCORE',
                        data: [<?php while ($b = mysqli_fetch_array($bulan)) { echo '"' . $b['cup'] . '",';}?>],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderWidth: 1
                    }]
            },
            options: {
                scales: {
                    yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                }
            }
        } );
    </script>
</body> </html>-->
<?php
include('connect.php');
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
					text: "YOUR SCORE GRAPH"
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
<div class="container"><div id="chartContainer" style="height: 300px; width: 100%;"></div></div>
</body> 
</html> 
