<?php
include_once('header.php');
//set up connection to DB
$servername = "silva.computing.dundee.ac.uk";
$username = "2019indteam2";
$password = "9364.ind2.4639";

$DEFAULT_RANGE = 2500000;
$DEFAUT_PRICE = 99999999;

$conn = mysqli_connect($servername, $username, $password);
//outputs if you are connected or not, not massively important
if(!$conn){
	die("Connection failed: " . mysqli_connect_error());
	}

//echo "connected <br>";

//checks which data has been posted from the healthdometrial page
//explode splits code from description 
if(!empty($injurys = $_POST["injury_input"])){
	$injurys = $_POST["injury_input"];
	$pieces = explode(":",$injurys);
	if($pieces[1]){
		$injury = $pieces[1];
	}
}
if(isset($_POST["location_input"])){
	$location = $_POST["location_input"];
}else{
	unset($location);
}

if(isset($_POST["state_input"])){
	$statecode = $_POST["state_input"];
}else{
	unset($statecode);
}

if(isset($_POST["locselect"])){
	$choice = $_POST["locselect"];
}

if (!empty($_POST["lat_input"])){
	$lat = $_POST["lat_input"];
	$long = $_POST["long_input"];
}else{
	$lat = 10.0;
	$long = 100.0;
}

if(!empty($_POST["range_input"])){
	$range = $_POST["range_input"];
}else{
	$range = $DEFAULT_RANGE;
}

if(!empty($_POST["price_input"])){
	$price = $_POST["price_input"];
}else{
	$price = $DEFAUT_PRICE;
}

if(!empty($_POST["medicare_input"])){
	$medicare = $_POST["medicare_input"];
}

//query stuff
$description = "other";
//var storing the query
$sql_code = "SELECT * FROM 2019indteam2db.codes_info WHERE description LIKE '%".$injury."%';";

//$result stores the result of the query, you can convert this to use in javascript, see david for this
$result_code = mysqli_query($conn,$sql_code);

if(!isset($_POST["state_input"])){
	$sql_coord = "SELECT x.code,x.providerId,x.averageTotalPayments,x.averageTotalPayments - x.averageMedicarePayments as 'Insured',providerName,latitude,longitude
	FROM 2019indteam2db.financial_info_2017 x
	inner join 2019indteam2db.hosinfo y
	ON x.providerId = y.providerId
	and x.code = ".mysqli_fetch_array($result_code)["code"]."
	and averageTotalPayments <".$price."
	order by averageTotalPayments desc
	;
	";
}elseif(isset($_POST["state_input"])){
	$statesearch = true;
	$statecode = $_POST["state_input"];
	$sql_coord = "SELECT x.code,x.providerId,x.averageTotalPayments,x.averageTotalPayments - x.averageMedicarePayments as 'Insured',providerName,latitude,longitude
	FROM 2019indteam2db.financial_info_2017 x
	inner join 2019indteam2db.hosinfo y
	ON x.providerId = y.providerId
	and x.code = ".mysqli_fetch_array($result_code)["code"]."
	and averageTotalPayments <".$price."
	and y.providerState ='".$statecode."'
	order by averageTotalPayments desc
	;
	";

}else{
	header('Location:healthdometrial.php');
	exit;
}

$result_coord = mysqli_query($conn,$sql_coord);

$results_coord = [];

while($row = mysqli_fetch_array($result_coord))
{
		$results_coord[] = $row;

}
//closes connection to the database
mysqli_close($conn);
?>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="Trial.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<script src="https://maps.googleapis.com/maps/api/js?key=&libraries=geometry" type="text/javascript"></script>
            <script type="text/javascript">
			var markers = [];
			var actualLocation=[];
			var i,j;
			var counter = 0;
			var x;
			var map;
			var locations = <?php echo(json_encode($results_coord));?>;
			var sortAscend = false;
			j=0;
			var infowindow = new google.maps.InfoWindow();
			var searchres;
			var cityCircle;
			var bool;
			var choice = <?php echo $choice; ?>;
            </script>

<script type="text/javascript" src="pagination.js"></script>
<script type="text/javascript" src="rating.js"></script>

<head>
<title>Price Search</title>


</head>

<body>
	<div class="resultmanager">
		<div class="sorting-container">
			<select class="sorting-list mr-sm-2" id="sort_select" onchange="sortHospitals()" aria-label="Sorting Selector">
				<option value="upriceLH">Uninsured price - Low to High</option>
   			<option value="upriceHL">Uninsured price - High to Low</option>
				<option value="ipriceLH">Insured price - Low to High</option>
   			<option value="ipriceHL">Insured price - High to Low</option>
   			<option value="ratingLH">Rating - Low to High</option>
   			<option value="ratingHL">Rating - High to Low</option>
				<script type="text/javascript">
				if(choice==1){
	   			document.write('<option value="distanceLH">Distance - Low to High</option>');
	   			document.write('<option value="distanceHL">Distance - High to Low</option>');
				}
				</script>
			</select>
		</div>

		<div class="markers-container">
			<select class="sorting-list mr-sm-2" id="num_of_entries" onchange="numOfEntries()"aria-label="Select Amount of Markers">
			<option value=10>10</option>
			<option value=20>20</option>
			<option value=50>50</option>
			<option value=100>100</option>
			</select>

				<div class="pagination-buttons-holder">
					<ul class="pagination" aria-label="Next and Previous Buttons">
						<li class="page-item"><a class="page-link" id="btn_prev" style="visibility:hidden;" href="javascript:prevPage()">Previous</a></li>
						<li class="page-item"><a class="page-link" id="btn_next" href="javascript:nextPage()">Next</a></li>
					</ul>
				</div>

		</div>
	</div>

	<div class = "resultholder">
		<div class ="w3-animate-opacity">
			<div id="searchres" class = "searchresult"></div>
		</div>
	</div>

	<div id="map"></div>

	<script type="text/javascript">
//sort the array 
			function sortHospitals(){

				var sortValue = document.getElementById("sort_select").value;

				switch(sortValue){
					case "upriceLH":
						actualLocation = actualLocation.sort(function(a,b){return(a["averageTotalPayments"]-b["averageTotalPayments"])});
						break;
					case "upriceHL":
						actualLocation = actualLocation.sort(function(a,b){return(b["averageTotalPayments"]-a["averageTotalPayments"])});
						break;
					case "ipriceLH":
						actualLocation = actualLocation.sort(function(a,b){return(a["Insured"]-b["Insured"])});
						break;
					case "ipriceHL":
						actualLocation = actualLocation.sort(function(a,b){return(b["Insured"]-a["Insured"])});
						break;
					case "ratingLH":
						actualLocation = actualLocation.sort(function(a,b){return(a["rating"]-b["rating"])});
						break;
					case "ratingHL":
						actualLocation = actualLocation.sort(function(a,b){return(b["rating"]-a["rating"])});
						break;
					case "distanceLH":
						actualLocation = actualLocation.sort(function(a,b){return(a["center_distance"]-b["center_distance"])});
						break;
					case "distanceHL":
						actualLocation = actualLocation.sort(function(a,b){return(b["center_distance"]-a["center_distance"])});
						break;
				}
				clearHospitals();
				display();
			}
//changes the number of cards and markers on a map at one time
				function numOfEntries()
					{
					var entries = document.getElementById("num_of_entries").value;
					records_per_page = entries;
					clearHospitals();
					display();
					}
//wipe the div
			function clearHospitals(){
				document.getElementById("searchres").innerHTML = "";
			}
//create the basic map
			function mapInit()
			{
					 map = new google.maps.Map(document.getElementById('map'),
					{
						zoom: 4,
						center: new google.maps.LatLng(30.0902, -85.7129),
						mapTypeId: google.maps.MapTypeId.ROADMAP
					});
			}
			//create a circle for radius searching
			function circleInit()
			{
				cityCircle = new google.maps.Circle({
							 strokeColor: '#FF0000',
							 strokeOpacity: 0.8,
							 strokeWeight: 1,
							 fillColor: '#FF0000',
							 fillOpacity: 0.005,
							 map: map,
							 center: {lat:<?php echo($lat);?>,lng:<?php echo($long);?>},
							 radius: <?php echo($range);?>
					 });

			}
			//place markers on the map if inside the circle 
			function assignLocations()
			{

				if(<?php var_export( isset($_POST["location_input"])); ?> == true)
				{
					for (var i = 0; i < locations.length; i++)
					{

						var center_distance = google.maps.geometry.spherical.computeDistanceBetween(cityCircle.center, new google.maps.LatLng(locations[i]["latitude"], locations[i]["longitude"]));

						if(center_distance < <?php echo($range);?>)
						{
							actualLocation[counter] = locations[i];
							actualLocation[counter]["center_distance"] = center_distance;
							counter++;
						}
					}
				}
				if(<?php var_export(isset($_POST["state_input"])); ?> == true)
				{
					for (var i = 0; i < locations.length; i++)
					{
							actualLocation[counter] = locations[i];
							actualLocation[counter]["center_distance"] = center_distance;
							counter++;
					}
				}
				actualLocation.sort(function(a,b){return(a["averageTotalPayments"]-b["averageTotalPayments"])});//Sorts ascending
			}

//function to create cards and display them in the div
				function display()
				{
				searchres = document.getElementById("searchres");
				
				if(actualLocation.length<=0){
					searchres.innerHTML = "<p style='text-align:center;'>No hospitals match your criteria<br><a href='HealthDomeTrial.php'>Go back</a></p>";
					return;
				}
				j=0;
				for(var i=0; i <markers.length;i++){
					markers[i].setMap(null);
				}
				markers = [];
				var upperbound;
				if(current_page == numPages())
				{
					upperbound = counter;
				}
				else
				{
					upperbound = current_page*records_per_page;
				}
				for(var a=(records_per_page*(current_page-1));a<upperbound;a++)
					{
								var marker = new google.maps.Marker({
								position: new google.maps.LatLng(actualLocation[a]["latitude"],actualLocation[a]["longitude"]),
								animation: google.maps.Animation.DROP,
								map: map
								});
								if(<?php var_export(isset($_POST["location_input"])); ?> == true)
								{
									searchres.innerHTML += "<div class='card' value='i.value' onclick='show("+j+")'>"+"<div  class='card-body result-cards'>"+"<form id='map_form' action='MoreDetails.php' method='post' target='_blank'>"+ "<div class='card-header'>" + actualLocation[a]["providerName"] + "</div>"+ "Uninsured price: $" + actualLocation[a]["averageTotalPayments"] +"<br>Insured price: $"+actualLocation[a]["Insured"] +"<br>Distance: " + Math.round(actualLocation[a]["center_distance"]*0.00062371) + " miles<br>"+"Rating: "+actualLocation[a]["rating"].toFixed(1)+"/10"+"<input type='text' hidden id='hosId' name='hosIdInput' class='form-control' value="+actualLocation[a]["providerId"]+">"+"<input type='text' hidden id='hosId' name='hosIdInput' class='form-control' value="+actualLocation[a]["providerId"]+">"+"<input type='text' hidden id='code' class='form-control' name='codeInput' value="+actualLocation[a]['code']+">"+"<button id='btmoredet' class='btn btn-primary'>More Details</button>"+"</form>"+ "</div>"+"</div>";
								}
								else
								{
									searchres.innerHTML += "<div class='card' value='i.value' onclick='show("+j+")'>"+"<div  class='card-body result-cards'>"+"<form id='map_form' action='MoreDetails.php' method='post' target='_blank'>"+ "<div class='card-header'>" + actualLocation[a]["providerName"] + "</div>"+"Uninsured price: $" + actualLocation[a]["averageTotalPayments"]+"<br>Insured price: $"+actualLocation[a]["Insured"]  +"<br>"+"Rating: "+actualLocation[a]["rating"].toFixed(1)+"/10"+"<input type='text' hidden id='hosId' name='hosIdInput' class='form-control' value="+actualLocation[a]["providerId"]+">"+"<input type='text' hidden id='hosId' name='hosIdInput' class='form-control' value="+actualLocation[a]["providerId"]+">"+"<input type='text' hidden id='code' class='form-control' name='codeInput' value="+actualLocation[a]['code']+">"+"<button id='btmoredet' class='btn btn-primary'>More Details</button>"+"</form>"+ "</div>"+"</div>";

								}
			j++;
						google.maps.event.addListener(marker, 'click', (function (marker, a)
						{
							return function ()
							{
								map.setCenter(marker.getPosition());
								map.setZoom(10);
								infowindow.setContent("<h6>" + actualLocation[a]["providerName"] + "</h6>"+"<br>");
								infowindow.open(map, marker);
							}
						})(marker, a));
						markers.push(marker);
					}
			}
//open a info box when clicked 
  	function show(id)
	  {
            google.maps.event.trigger(markers[id], 'click');
      }


//loads the scripts 
window.onload =function start()
{
	mapInit();
	if(<?php var_export(isset($_POST["location_input"])); ?> == true)
	{
		circleInit();
	}
	assignLocations();
	addRatings();
	display();
}


	</script>


</body>
</html>
