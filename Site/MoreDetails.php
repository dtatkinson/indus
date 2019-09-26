<?php
//set up connection to DB
$servername = "silva.computing.dundee.ac.uk";
$username = "2019indteam2";
$password = "9364.ind2.4639";

$conn = mysqli_connect($servername, $username, $password);
//outputs if you are connected or not, not massively important
if(!$conn){
	die("Connection failed: " . mysqli_connect_error());
	}
//if($conn){
//echo "connected <br>";
$hospitalID = $_POST["hosIdInput"];
$code = $_POST["codeInput"];




$sql_query = "SELECT hos.providerId,hos.providername,hos.latitude,hos.longitude,f2017.code,f2017.averageTotalPayments as 'averageTotalPayments2017',f2016.averageTotalPayments  as 'averageTotalPayments2016'
FROM 2019indteam2db.financial_info_2017 f2017
INNER JOIN 2019indteam2db.hospital_information hos
ON hos.providerId = f2017.providerId
AND f2017.code=".$code."
AND hos.providerId = ".$hospitalID."
inner join 2019indteam2db.financial_info_2016 f2016
ON hos.providerId = ".$hospitalID."
and f2016.code=".$code."
;";
$result_Information = mysqli_query($conn,$sql_query);

$results_Information = [];
while($row = mysqli_fetch_array($result_Information))
{
		$results_Information[] = $row;
}

?>
<html>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="Trial.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDFuSON-6LCX7ZZ6wynMcfwG_UEfb1KxOA &libraries=Geocoder"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://kit.fontawesome.com/caf1c83931.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
  <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/4.0.0/jquery.min.js"></script>-->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


<script  type="text/javascript">
	 financial_info = <?php echo(json_encode($results_Information));?>;
	 
</script>


    <head>
  <nav class="navbar navbar-expand navbar-light bg-light">
	<a class="navbar-brand" href="#">
		<img src="Images/healthdomeman.jpg" width="30" height="30" class="d-inline-block align-top" alt="">
		HealthDome

  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    	<span class="navbar-toggler-icon"></span>
 		</button>
  		<div class="collapse navbar-collapse" id="navbarNav">
   		 <ul class="navbar-nav">
    	  	<li class="nav-item active">
     	   	<a class="nav-link" href="#"></a>
     	 	</li>
     	 	<li class="nav-item active">
        	<a class="nav-link" href="Healthdometrial.php">Home</a>
      		</li>
	   		<li class="nav-item">
       	 	<a class="nav-link" href="#">About Us</a>
      		</li>
      		<li class="nav-item">
       	 	<a class="nav-link" href="#">Contact
			</a>
    	    </li>
    	 </ul>
  		</div>
		</a>
	</nav>

</head>


<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script>
window.onload = function()
{
	
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Simple Line Chart"
	},
	axisY:{
		includeZero: false
	},
	data: [{        
		type: "line",       
		dataPoints: [
			financial_info[0]['averageTotalPayments2017']
		]
	}]
});
chart.render();
}
</script>

<script type="text/javascript">
document.write(financial_info[0]["providername"]);	 
</script>
</body>


</html>
