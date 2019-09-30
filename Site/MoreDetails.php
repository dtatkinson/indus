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
//this query is ruining everything
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
mysqli_close($conn); 
?>
<html>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="Trial.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://kit.fontawesome.com/caf1c83931.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
  <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/4.0.0/jquery.min.js"></script>-->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
  <script type="text/javascript" src="placephoto.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=&libraries=places" type="text/javascript"></script>


<script  type="text/javascript">
	 financial_info = <?php echo(json_encode($results_Information));?>;
	 
</script>


 
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
<div class="container">

  <!-- Portfolio Item Heading -->
  <h1 class="my-4">More Information<br>
    <small>
	<script>document.write(financial_info[0]["providername"])</script>
	</small>
  </h1>

  <!-- Portfolio Item Row -->
  <div class="row">

    <div class="col-md-8">

  <div id='photo-container' >

	<img src="Images/spinnergif.gif" id="spinner"></img>
	</div>
	

    </div>

    <div class="col-md-4">
      <h3 class="my-3">Graph</h3>
	  <div class="chartjs-wrapper">
<canvas id="myChart" class="chartjs" width="500" height="250"></canvas>
</div>
      
      <h3 class="my-3">
	  <div class="pictureinfo">
		<script type="text/javascript">
		//document.write(financial_info[0]["providername"]+ "</h3>" + "<p>" + "Table of average prices over the last x years" + "</p>");	 
		

		</script>
<div>
	  
	  
	  </h3>
      <ul>

      </ul>
    </div>

  </div>

<div hidden id="map">

</div>
<script type="text/javascript">
//var a = parseFloat(financial_info[0]['averageTotalPayments2011']);
	//var b = parseFloat(financial_info[0]['averageTotalPayments2012']);
	//var c = parseFloat(financial_info[0]['averageTotalPayments2013']);
	//var d = parseFloat(financial_info[0]['averageTotalPayments2014']);
	//var e = parseFloat(financial_info[0]['averageTotalPayments2015']);
	var f = parseFloat(financial_info[0]['averageTotalPayments2016']);
	var g = parseFloat(financial_info[0]['averageTotalPayments2017']);

		var ctx = document.getElementById('myChart').getContext('2d');
		var chart = new Chart(ctx, {
			// The type of chart we want to create
			type: 'line',

			// The data for our dataset
			data: {
				labels: ['2011', '2012', '2013', '2014', '2015', '2016', '2017'],
				datasets: [{
					label: 'Average Price ($)',
					backgroundColor: 'rgb(255, 99, 132)',
					borderColor: 'rgb(255, 99, 132)',
					fill: false,
					data: [4500, 3900, 5000, 2450, 2240, f, g]
				}]
			},

			// Configuration options go here
			options: {
				maintainAspectRatio: false,
				responsive:false,
			}
		});
</script>
<script type="text/javascript">
		getPhotos(financial_info[0]["providername"]);
		</script>



    <script type ="text/javascript">
 window.onload = function(){
 document.getElementById("spinner").hidden = true;}
</script>
</body>


</html>