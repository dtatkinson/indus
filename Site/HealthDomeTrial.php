<html>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="Trial.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAWOLJZDit5LJs6RhOe2fjY3hJUKnqJjvs&libraries=Geocoder"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://kit.fontawesome.com/caf1c83931.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/4.0.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script>
  
   $(function()
    {
        $.get("searchcodes.txt" , function(data)
        {
        var searchedwords = data.split('\n');
        $("#tags").autocomplete({ source: searchedwords});
        });
    });

	function getLocation() 
	{
  	if (navigator.geolocation) {
    	navigator.geolocation.getCurrentPosition(showPosition);
  	} 
	else 
	{
    	x.innerHTML = "Geolocation is not supported by this browser.";
  	}
	}

function showPosition(position) 
{
	document.getElementById('lat').value=position.coords.latitude;
	document.getElementById('long').value=position.coords.longitude;
	alert("Google has now access to your location (lol)");
}

function findLocation()
{
	var geocoder = new google.maps.Geocoder();
	var address = document.getElementById('address').value;
	alert(address);
	geocoder.geocode({'address': address}, function(results, status) 
	{
		if(status ==='OK')
		{
		alert(results[0].geometry.location.lat());
		alert(results[0].geometry.location.lng());
		document.getElementById('lat').value=results[0].geometry.location.lat();
		document.getElementById('long').value=results[0].geometry.location.lng();
		}
	
	}
	)
}

  </script>
<body>

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

	<div class="searchbox">
			<div class="card">
  				<div class="card-body">
					<form class="" action="SearchTrial.php" method="post">
						<h1> Compare Prices! </h1>
   						 <div class="input-group mb-3">
  							<div class="input-group-prepend">
   							 <span class="input-group-text" id="basic-addon1">Injury</span>
  							</div>
							
					    <input type="text" name="injury_input" id="tags" class="form-control" placeholder="Example: Broken Leg" aria-label="Username" aria-describedby="basic-addon1">
						<input type="text" hidden name="lat_input"  id="lat" class="form-control">
						<input type="text" hidden name="long_input" id="long" class="form-control">
							<div class="input-group-prepend">
   							 <span class="input-group-text" id="Address">Address</span>
							 <button type="button" class="btn btn-primary"onclick="getLocation()"><i class="fas fa-map-marked-alt"></i></button>
  							</div>
						<input type="text" id="address" name="location_input" class="form-control" placeholder="Example:24424 or 'California' " aria-label="Username" aria-describedby="basic-addon1">
						</div>
						
						<div>
							<button type="button" onclick="findLocation()">Find my location</button>
						</div>
						<button type="button" data-toggle="collapse" data-target="#advancesearch" class="btn btn-link">Advanced search <i class="fas fa-sort-down"></i></button>
	<div class="collapse" id="advancesearch">
						<div class="form-row">
							<div class="col-auto my-1">
								<label class="mr-sm-2" for="inlineFormCustomSelect">Distance Range</label>
								<select class="custom-select mr-sm-2" name="range_input" id="inlineFormCustomSelect">
									<option selected>Distance Range</option>
									<option value="20000">20 Miles</option>
									<option value="50000">50 Miles</option>
									<option value="100000">100 Miles</option>
									<option value="250000">250 Miles</option>
									<option value="500000">500 Miles</option>
									<option value="999999">999 Miles</option>
									<option value="9999999">No Limit</option>
								</select>

							</div>


							<div class="col-auto my-1">
								<label for="inlineFormCustomSelect">Max Price</label>
								<input class="custom-select mr-sm-2" type="number" name="price_input" id="inlineFormCustomSelect">
							</div>
							
							<div class="col-auto my-1">
								<div class="form-check">
								<input type="checkbox" name="medicare_input" class="inline-form-check-input" id="exampleCheck1">
								<label class="form-check-label" name="medicare_input" for="medicare_input">I have Medicare</label>
								<br>
									
								
								
									
								
								</div>
							</div>

						</div>
	</div>
						<div class="Searchbutton">
							<br>
							<input type="submit" class="btn btn-primary btn-block" value="Search"></button>
						</div>

					</form>
 		 		</div>
  		  </div>
	</div>


	<div>


</body>


</html>
