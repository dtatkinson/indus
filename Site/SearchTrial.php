<?php
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

//Get user input from the search page
//re-add range and medicare after client meeting
if(!empty($injurys = $_POST["injury_input"])){
	$injurys = $_POST["injury_input"];
}
else{
	header('Location:healthdometrial.php');
	exit;
}
$location = $_POST["location_input"];

$pieces = explode(":",$injurys);
$injury = $pieces[1];

$lat = $_POST["lat_input"];
$long = $_POST["long_input"];

/*
$lat = 36.1278915;
$long = -86.6997864;
*/
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
//hardcoded input, this will need to change so user inoput is taken
$description = "other";
//var storing the query
$sql_code = "SELECT * FROM 2019indteam2db.codes_info WHERE description LIKE '%".$injury."%';";

//$result stores the result of the query, you can convert this to use in javascript, see david for this
$result_code = mysqli_query($conn,$sql_code);

if(empty($statecode=$_POST["state_input"])){
	$sql_coord = "SELECT x.code,x.providerId,x.averageTotalPayments,providerName,latitude,longitude
	FROM 2019indteam2db.financial_info_2017 x
	inner join 2019indteam2db.hospital_information y
	ON x.providerId = y.providerId
	and x.code = ".mysqli_fetch_array($result_code)["code"]."
	and averageTotalPayments <".$price."
	order by averageTotalPayments desc
	;
	";
}elseif(!empty($statecode=$_POST["state_input"])){
	
	$statecode = $_POST["state_input"];
	$sql_coord = "SELECT x.code,x.providerId,x.averageTotalPayments,providerName,latitude,longitude
	FROM 2019indteam2db.financial_info_2017 x
	inner join 2019indteam2db.hospital_information y
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
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="Trial.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<script src="https://maps.googleapis.com/maps/api/js?key=&libraries=geometry" type="text/javascript"></script>
<script src="rating.js"></script>
            <script type="text/javascript">
							var markers = [];
							var actualLocation=[];
	            var i,j;
							var counter = 0;
					    var x;
	            var locations = <?php echo(json_encode($results_coord));?>;
				alert(locations[0]["providerName"]);
							var sortAscend = false;
            </script>

<script type="text/javascript" src="pagination.js"></script>
<script type="text/javascript" src="rating.js"></script>

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
        	<a class="nav-link" href="healthdometrial.php">Home</a>
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
	<div class="resultmanager">
		<div class="sorting-container">
			<select class="sorting-list mr-sm-2" id="sort_select" onchange="sortHospitals()">
				<option value="averageTotalPayments">Price</option>
				<option value="center_distance">Distance</option>
				<option value="rating">Rating</option>
			</select>
			<button class = "btn btn-primary" type="button" name="sort_button" onclick="sortHospitals()">Sort</button> &nbsp; &nbsp; 
		</div>
		<div class="markers-container">
	  <select class="sorting-list mr-sm-2" id="num_of_entries" onchange="numOfEntries()">
	    <option value=10>10</option>
	    <option value=20>20</option>
	    <option value=50>50</option>
	    <option value=100>100</option>

	   </select>
	   
	   		<div class="pagination-buttons-holder">
			<ul class="pagination">
				<li class="page-item"><a class="page-link" id="btn_prev" style="visibility:hidden;" href="javascript:prevPage()">Previous</a></li>
				<li class="page-item"><a class="page-link" id="btn_next" href="javascript:nextPage()">Next</a></li>
			</ul>
		</div>
	   
  	</div>

		<script type="text/javascript">

			function sortHospitals(){

				var sortValue = document.getElementById("sort_select").value;

				if(sortAscend){
					actualLocation = actualLocation.sort(function(a,b){return(a[sortValue]-b[sortValue])})//Sorts ascending
					sortAscend = false;
				}else{
					actualLocation = actualLocation.sort(function(a,b){return(b[sortValue]-a[sortValue])})//Sorts descending
					sortAscend = true;
				}
				clearHospitals();
				display();
			}

				function numOfEntries()
					{
					var entries = document.getElementById("num_of_entries").value;
					records_per_page = entries;
					clearHospitals();
					display();
					}

			function clearHospitals(){
				document.getElementById("searchres").innerHTML = "";
			}
		</script>
	</div>
	<div class = "resultholder">
		<div class ="w3-animate-opacity">
    <div id="searchres" class = "searchresult">

    </div>


		</div>
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
		j=0;
        var infowindow = new google.maps.InfoWindow();
		var searchres = document.getElementById("searchres");

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
				actualLocation = actualLocation.sort(function(a,b){return(a["averageTotalPayments"]-b["averageTotalPayments"])});//Sorts ascending
				addRatings();
		</script>

	<script>

display();
function display()
{
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

			searchres.innerHTML += "<div class='card' value='i.value' onclick='show("+j+")'>"+"<div  class='card-body result-cards'>"+"<form id='map_form' action='MoreDetails.php' method='post' target='_blank'>"+ "<h3>" + actualLocation[a]["providerName"] + "</h3>"+"Average price: $" + actualLocation[a]["averageTotalPayments"] + "<br>Distance: " + Math.round(actualLocation[a]["center_distance"]*0.00062371) + " miles<br>"+"Rating: "+actualLocation[a]["rating"].toFixed(1)+"/10<br>"+ "<br>"+"<br>"+"<input type='text' hidden id='hosId' name='hosIdInput' class='form-control' value="+actualLocation[a]["providerId"]+">"+"<input type='text' hidden id='hosId' name='hosIdInput' class='form-control' value="+actualLocation[a]["providerId"]+">"+"<input type='text' hidden id='code' class='form-control' name='codeInput' value="+actualLocation[a]['code']+">"+"<br>"+"<br>"+"<button>More Details</button>"+"</form>"+ "</div>"+"</div>";
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

  	function show(id)
	  {
            google.maps.event.trigger(markers[id], 'click');
      }
	  
    	</script>
    </div>
</body>
</html>
