<?php
include_once('header.php');
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
$sql_query = "SELECT hos.providerId,f2017.code,providername,providerStreetAddress,f2017.averageTotalPayments as '2017',f2016.averageTotalPayments as '2016',f2015.averageTotalPayments as '2015',f2014.averageTotalPayments as '2014',f2013.averageTotalPayments as '2013',f2012.averageTotalPayments as '2012',f2011.averageTotalPayments as '2011',f2017.averageTotalPayments-f2017.averageMedicarePayments as '2017IN',f2016.averageTotalPayments-f2016.averageMedicarePayments as '2016IN',f2015.averageTotalPayments-f2015.averageMedicarePayments as '2015IN',f2014.averageTotalPayments-f2014.averageMedicarePayments as '2014IN',f2013.averageTotalPayments-f2013.averageMedicarePayments as '2013IN',f2012.averageTotalPayments-f2012.averageMedicarePayments as '2012IN',f2011.averageTotalPayments-f2011.averageMedicarePayments as '2011IN'
from 2019indteam2db.hosinfo hos
left join 2019indteam2db.financial_info_2017 f2017
on hos.providerId = f2017.providerId
and f2017.code = ".$code."
and hos.providerId = ".$hospitalID."
left join 2019indteam2db.financial_info_2016 f2016
on hos.providerId = f2016.providerId
and f2016.code = ".$code."
and hos.providerId = ".$hospitalID."
left join 2019indteam2db.financial_info_2015 f2015
on hos.providerId = f2015.providerId
and f2015.code = ".$code."
and hos.providerId = ".$hospitalID."
left join 2019indteam2db.financial_info_2014 f2014
on hos.providerId = f2014.providerId
and f2014.code = ".$code."
and hos.providerId = ".$hospitalID."
left join 2019indteam2db.financial_info_2013 f2013
on hos.providerId = f2013.providerId
and f2013.code = ".$code."
and hos.providerId = ".$hospitalID."
left join 2019indteam2db.financial_info_2012 f2012
on hos.providerId = f2012.providerId
and f2012.code = ".$code."
and hos.providerId = ".$hospitalID."
left join 2019indteam2db.financial_info_2011 f2011
on hos.providerId = f2011.providerId
and f2011.code = ".$code."
and hos.providerId = ".$hospitalID."
order by f2017.code desc
limit 1
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
<meta name="viewport" content="width=device-width, initial-scale=1">
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
  <script type="text/javascript" src="placedetails.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=&libraries=places" type="text/javascript"></script>
<script type="text/javascript" src="projected.js"></script>

<script  type="text/javascript">
	 financial_info = <?php echo(json_encode($results_Information));?>;

</script>




    <head>
  

</head>

<body>






<div class="container">

  <!-- Portfolio Item Heading -->
  <h3 class="my-4">More Information<br>
    <small>
	<script>document.write(financial_info[0]["providername"])</script>
	</small>
  </h3>

<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner" id="carousel-inner">

  </div>

  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


  <!-- Portfolio Item Row -->
  <div class="row">

    <div class="col-md-8">

  <div id='photo-container' >

	<img src="Images/spinnergif.gif" id="spinner">
	</div>


    </div>



      <h3 class="my-3">
	  <div class="pictureinfo">
		<script type="text/javascript">
		//document.write(financial_info[0]["providername"]+ "</h3>" + "<p>" + "Table of average prices over the last x years" + "</p>");


		</script>
<div>

	  <div class="col-md-4">
      <h3 class="my-3"></h3>
	  <div class="chartjs-wrapper">
<canvas id="myChart" class="chartjs"></canvas>
</div>
	  </h3>
      <ul>

      </ul>
<div class="col-md-4">
<br>
<div id="hospital-info">

</div>
</div>
  </div>

<div hidden id="map">

</div>
<script type="text/javascript">
	var a = parseFloat(financial_info[0]['2011']);
	var b = parseFloat(financial_info[0]['2012']);
	var c = parseFloat(financial_info[0]['2013']);
	var d = parseFloat(financial_info[0]['2014']);
	var e = parseFloat(financial_info[0]['2015']);
	var f = parseFloat(financial_info[0]['2016']);
	var g = parseFloat(financial_info[0]['2017']);

	var ai = parseFloat(financial_info[0]['2011IN']);
	var bi = parseFloat(financial_info[0]['2012IN']);
	var ci = parseFloat(financial_info[0]['2013IN']);
	var di = parseFloat(financial_info[0]['2014IN']);
	var ei = parseFloat(financial_info[0]['2015IN']);
	var fi = parseFloat(financial_info[0]['2016IN']);
	var gi = parseFloat(financial_info[0]['2017IN']);
	calculate();
	calculatei();
	//alert(projectedval);
		var ctx = document.getElementById('myChart').getContext('2d');
		var chart = new Chart(ctx,{
			type: 'line',
			data: {
				labels: ['2011', '2012', '2013', '2014', '2015', '2016', '2017','2018 PROJECTED'],
				datasets: [{
					label: 'Average Price ($)',
					backgroundColor: 'rgb(255, 0, 0)',
					borderColor: ['rgb(255, 0, 0)','rgb(255, 0, 0)','rgb(255, 0, 0)','rgb(255, 0, 0)','rgb(255, 0, 0)','rgb(255, 0, 0)','rgb(255, 0, 0)','rgb(0, 255, 0)',],
					fill: false,
					data: [a, b, c, d, e, f, g,projectedval]				
			},
			{
					label: 'Average Price - Insured($)',
					backgroundColor: 'rgb(0, 0, 255)',
					borderColor: ['rgb(0, 0, 255)','rgb(0, 0, 255)','rgb(0, 0, 255)','rgb(0, 0, 255)','rgb(0, 0, 255)','rgb(0, 0, 255)','rgb(0, 0, 255)','rgb(255, 0, 0)',],		
					fill: false,
					data: [ai, bi, ci, di, ei, fi, gi,projectedvali]
			}
		]
		},
		options: {
				maintainAspectRatio: true,
				responsive:false,
			}
		});
			// The type of chart we want to create
			
			// The data for our dataset
		
	

</script>
<script type="text/javascript">
		getPlaceDetails(financial_info[0]["providername"]+" "+financial_info[0]["providerStreetAddress"]+" "+financial_info[0]["providerCity"]);
		</script>



    <script type ="text/javascript">
 window.onload = function(){
 document.getElementById("spinner").hidden = true;}
</script>
</body>


</html>
