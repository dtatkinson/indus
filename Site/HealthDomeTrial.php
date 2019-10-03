<?php include_once('header.php');?>
<html>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="Trial.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://maps.googleapis.com/maps/api/js?key=&libraries=Geocoder"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://kit.fontawesome.com/caf1c83931.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script>

   $(function()
    {
        $.get("searchcodes.txt" , function(data)
        {
        var searchedwords = data.split('\n');
        $("#tags").autocomplete({ source: searchedwords, scroll:true});
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

function findAddress(){
	if(document.getElementById("address").disabled == false){
		//Switch statement to set the position
		var addressValue = document.getElementById("address").value;
		switch(addressValue){
			case "":
			valid = false;
			break;
			case "My location":
			dataValidation();
			break;
			default:
			findLocation();
			break;
		}
	}else{
		document.getElementById("search_form").submit();
	}
}

function dataValidation(){
  var valid = true;

  //Check the positions are set

  if(document.getElementById('lat').value=="" || document.getElementById('long').value==""){
    valid = false;
    alert("Coordinates invalid");
  }else{

  }

  if(valid){
    document.getElementById("search_form").submit();
  }else{

  }
}

function showPosition(position)
{
	document.getElementById('lat').value=position.coords.latitude;
	document.getElementById('long').value=position.coords.longitude;
	document.getElementById("address").value="My location";
}

function findLocation()
{
	var address = document.getElementById('address').value;
  var geocoder = new google.maps.Geocoder();

	geocoder.geocode({address: address}, function(results, status)
	{
		if(status ===google.maps.GeocoderStatus.OK)
		{
      document.getElementById('lat').value=results[0].geometry.location.lat();
  		document.getElementById('long').value=results[0].geometry.location.lng();
      dataValidation();
		}else{
      alert("Failed to retrieve coordinates of specified address.");
    }
	}
	)
}
  </script>


<head>
<title>HealthDome</title>


</head>

<body onload="locationChange()">
	<div class="backgroundimage">
		<img src="images/bgimg.jpg" alt="" height="" width="">
	</div>

	<div class="searchbox">
			<div class="card">
  				<div class="card-body">
					<form id="search_form" class="" action="SearchTrial.php" method="post">
						<h1> Compare Prices! </h1>
   						<div class="input-group mb-3">
  							<div class="input-group-prepend" id="igp1">
								<span class="input-group-text" id="basic-addon1">Injury</span>

								<input type="text" name="injury_input" id="tags" class="form-control" placeholder="Broken Leg" aria-label="Injury Input" aria-describedby="basic-addon1">
								<input type="text" hidden name="lat_input"  id="lat" class="form-control">
								<input type="text" hidden name="long_input" id="long" class="form-control">
							</div>
							</div>

							<div class="input-group-prepend">
								<select class="custom-select mr-sm-2" name="locselect" id="locselect" onchange="locationChange()"value="1" aria-label="Location drop down selector." data-toggle="tooltip" title="Choose Search Type">
									<option value="1" selected>Address</option>
									<option value="0">State</option>
								</select>
								<button type="button" data-toggle="tooltip" title="Get location automatically" class="btn btn-primary" onclick="getLocation()"><i class="fas fa-map-marked-alt"aria-label="Use Your own Location"></i></button>



							<input type="text" id="address" name="location_input" class="form-control" placeholder="24424 or 'California' " aria-label="Address input" aria-describedby="basic-addon1">
						</div>
						<div class="State_choice">

							<label class="mr-sm-2" for="inlineFormCustomSelect">Search By State</label>
								<select class="custom-select mr-sm-2" name="state_input" id="state_input" aria-label="Choice Of states">
									<option value="AL">Alabama</option>
									<option value="AK">Alaska</option>
									<option value="AZ">Arizona</option>
									<option value="AR">Arkansas</option>
									<option value="CA">California</option>
									<option value="CO">Colorado</option>
									<option value="CT">Connecticut</option>
									<option value="DE">Delaware</option>
									<option value="FL">Florida</option>
									<option value="GA">Georgia</option>
									<option value="HI">Hawaii</option>
									<option value="ID">Idaho</option>
									<option value="IL">Illinois</option>
									<option value="IN">Indiana</option>
									<option value="IA">Iowa</option>
									<option value="KS">Kansas</option>
									<option value="KY">Kentucky</option>
									<option value="LA">Louisiana</option>
									<option value="ME">Maine</option>
									<option value="MD">Maryland</option>
									<option value="MA">Massachusetts</option>
									<option value="MI">Michigan</option>
									<option value="MN">Minnesota</option>
									<option value="MS">Mississippi</option>
									<option value="MO">Missouri</option>
									<option value="MT">Montana</option>
									<option value="NE">Nebraska</option>
									<option value="NV">Nevada</option>
									<option value="NH">New Hampshire</option>
									<option value="NJ">New Jersey</option>
									<option value="NM">New Mexico</option>
									<option value="NY">New York</option>
									<option value="NC">North Carolina</option>
									<option value="ND">North Dakota</option>
									<option value="OH">Ohio</option>
									<option value="OK">Oklahoma</option>
									<option value="OR">Oregon</option>
									<option value="PA">Pennsylvania</option>
									<option value="RI">Rhode Island</option>
									<option value="SC">South Carolina</option>
									<option value="SD">South Dakota</option>
									<option value="TN">Tennessee</option>
									<option value="TX">Texas</option>
									<option value="UT">Utah</option>
									<option value="VT">Vermont</option>
									<option value="VA">Virginia</option>
									<option value="WA">Washington</option>
									<option value="WV">West Virginia</option>
									<option value="WI">Wisconsin</option>
									<option value="WY">Wyoming</option>
								</select>

						</div>
									<script>
										function locationChange() {

										var choice = document.getElementById("locselect").value;
										if (choice == 1) {

														document.getElementById("address").disabled = false;
														document.getElementById("state_input").disabled = true;
													   }
										else if (choice == 0)
														{

														document.getElementById("address").disabled = true;
														document.getElementById("state_input").disabled = false;
														}
										}
									</script>

						<button type="button" data-toggle="collapse" data-target="#advancesearch" class="btn btn-link">Advanced search <i class="fas fa-sort-down"></i></button>

						<div class="collapse" id="advancesearch">
							<div class="form-row">
								<div class="col-auto my-1">
									<label class="mr-sm-2" for="inlineFormCustomSelect">Distance Range</label>
									<select class="custom-select mr-sm-2" name="range_input" id="inlineFormCustomSelect">
										<option value="9999999">No Limit</option>
										<option value="20000">20 Miles</option>
										<option value="50000">50 Miles</option>
										<option value="100000">100 Miles</option>
										<option selected value="250000">250 Miles</option>
										<option value="500000">500 Miles</option>
										<option value="999999">999 Miles</option>
									</select>
								</div>

								<div class="col-auto my-1">
									<label for="inlineFormCustomSelect">Max Price</label>
									<input class="custom-select mr-sm-2" type="number" name="price_input" id="inlineFormCustomSelect" aria-label="Price Input">
								</div>
								<br>



							</div>
						</div>

						<div class="Searchbutton">
							<!--<input type="submit" class="btn btn-primary btn-block" value="Search">-->
							<button type="button" class="btn btn-primary btn-block" aria-label="Search Button" onclick="findAddress()">Search</button>

						</div>
					</form>
				</div>
	 		</div>
    </div>
</body>
</html>
