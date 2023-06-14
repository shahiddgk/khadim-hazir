<!-- <div class="card">
    
    <div class="card-body">
         <h1>WELCOME <span class="badge badge-secondary"><?=$this->session->userdata('user_login');?></span></h1>
     </div>
</div> -->
<?php
//  echo "<pre>"; print_r($users[0]->employees);exit;
// $dataPoints = array(
// 	array("label"=> $users[0]->category_name, "y"=> $users[0]->employees),
// 	array("label"=> "Repair", "y"=> 261),
// 	array("label"=> "Painting", "y"=> 158),
// 	array("label"=> "Plumbing", "y"=> 72),
// 	array("label"=> "Transportation", "y"=> 191),
// 	array("label"=> "Pest Control", "y"=> 573),
// 	array("label"=> "Decks and porches", "y"=> 126),
// 	array("label"=> "Autos", "y"=> 126)
// );
$dataPoints = $users;
//  echo "<pre>"; print_r($users);exit;
?>
<!DOCTYPE HTML>
<html>
<head>  
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	// exportEnabled: true,
	title:{
		text: "workers availble in different categories"
	},
	// subtitles: [{
	// 	text: "Currency Used: Thai Baht (฿)"
	// }],
	data: [{
		type: "pie",
		showInLegend: "true",
		legendText: "{label}",
		indexLabelFontSize: 16,
		// indexLabel: "{label} - #percent%",
		// yValueFormatString: "฿#,##0",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script style= "cursor:pointer" src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>
</html>  
