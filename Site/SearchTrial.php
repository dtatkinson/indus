<?php
//set up connection to DB
$servername = "silva.computing.dundee.ac.uk";
$username = "2019indteam2";
$password = "9364.ind2.4639";

$DEFAULT_RANGE = 600000;
$DEFAUT_PRICE = 9999999;

$conn = mysqli_connect($servername, $username, $password);
//outputs if you are connected or not, not massively important
if(!$conn){
	die("Connection failed: " . mysqli_connect_error());
	}
if($conn){
//echo "connected <br>";

//Get user input from the search page
//re-add range and medicare after client meeting
$injury = $_POST["injury_input"];
$location = $_POST["location_input"];

$lat = $_POST["lat_input"];
$long = $_POST["long_input"];

$lat = 36.1278915;
$long = -86.6997864;

if($_POST["range_input"]!=null)
	$range = $_POST["range_input"];
else
	$range = $DEFAULT_RANGE;

if($_POST["price_input"]!=null)
	$price = $_POST["price_input"];
else
	$price = $DEFAUT_PRICE;

$medicare = $_POST["medicare_input"];

//query stuff
//hardcoded input, this will need to change so user inoput is taken
$description = "other";
//var storing the query
$sql_code = "SELECT * FROM 2019indteam2db.codes_info WHERE description LIKE '%".$injury."%';";

//$result stores the result of the query, you can convert this to use in javascript, see david for this
$result_code = mysqli_query($conn,$sql_code);

$sql_coord = "SELECT x.code,x.providerId,x.averageTotalPayments,providerName,latitude,longitude
FROM 2019indteam2db.financial_info_2017 x
inner join 2019indteam2db.hospital_info y
ON x.providerId = y.providerId
and x.code = ".mysqli_fetch_array($result_code)["code"]."
and averageTotalPayments <".$price."
order by averageTotalPayments asc
limit 10;
";

$result_coord = mysqli_query($conn,$sql_coord);
$results_coord = [];
while($row = mysqli_fetch_array($result_coord))
{
		$results_coord[] = $row;
}
//echo "<script type='text\javascript'> var locations = ".$jsarray."; <script>";
//closes connection to the database
 //mysqli_close($conn);
}
?>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="Trial.css" rel="stylesheet" type="text/css">
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAWOLJZDit5LJs6RhOe2fjY3hJUKnqJjvs&libraries=geometry"
            type="text/javascript"></script>

            <script type="text/javascript">
	    var markers = [];
            var i;
	    var x;
            var locations = <?php echo(json_encode($results_coord));?>

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
        	<a class="nav-link" href="#">Home</a>
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
<div class = "resultholder">

    <div class = "searchresult">
        <script type="text/javascript">
					for(let i = 0;i<locations.length;i++)
					{
						x=i;
						document.write("<div class='card'>");
						document.write("<div class='card-body'>");
						document.write( "<h1>" + locations[i]["providerName"] + "</h1>");
						document.write("$" + locations[i]["averageTotalPayments"] + "<br>");
						document.write("<br>");
						document.write("<a href='#' value='i.value' onclick='show("+i+")'>View</a>");
						document.write("</div>");
						document.write("</div>");
					}
        </script>

    </div>


		<div id="map">

			<script type="text/javascript">

        var map = new google.maps.Map(document.getElementById('map'),
        {
            zoom: 4,
            center: new google.maps.LatLng(30.0902, -85.7129),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

				var cityCircle = new google.maps.Circle({
							 strokeColor: '#FF0000',
							 strokeOpacity: 0.8,
							 strokeWeight: 1,
							 fillColor: '#FF0000',
							 fillOpacity: 0.005,
							 map: map,
							 center: {lat:<?php echo($lat);?>,lng:<?php echo($long);?>},
							 radius: <?php echo($range);?>
					 });

        var infowindow = new google.maps.InfoWindow();

        for (var i = 0; i < locations.length; i++)
        {
					var center_distance = google.maps.geometry.spherical.computeDistanceBetween(cityCircle.center, new google.maps.LatLng(locations[i]["latitude"], locations[i]["longitude"]));
					if(center_distance < <?php echo($range);?>){
						var marker = new google.maps.Marker({
							position: new google.maps.LatLng(locations[i]["latitude"], locations[i]["longitude"]),
							map: map,
							label: "H",
						});

						google.maps.event.addListener(marker, 'click', (function (marker, i) {
							return function () {
								infowindow.setContent("<p>" + locations[i]["providerName"] + "<br><a href=" + locations[i][5]+" > More Info</a > ");
								//alert(locations[i][4])
								infowindow.open(map, marker);
							}
						})(marker, i));
						markers.push(marker);
					}
        }

  	function show(id){
            google.maps.event.trigger(markers[id], 'click');
        }
    	</script>
    </div>
</body>
</html>
