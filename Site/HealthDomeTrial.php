<html>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="Trial.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
   $(function()
    {
        $.get("searchcodes.txt" , function(data)
        {
        var searchedwords = data.split('\n');
        $("#tags").autocomplete({ source: searchedwords});
        });
    });

	function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
    x.innerHTML = "Geolocation is not supported by this browser.";
  }

}

function showPosition(position) {
	document.getElementById('lat').value=position.coords.latitude;
	document.getElementById('long').value=position.coords.longitude;
	alert(document.getElementById('lat').value);
	alert(document.getElementById('long').value);
}

  </script>
<body>

    <head>
  <nav class="navbar navbar-light bg-light">
	<a class="navbar-brand" href="#">
		<img src="Images/healthdomeman.jpg" width="30" height="30" class="d-inline-block align-top" alt="">
		HealthDome
	</a>
	</nav>
	<head>

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
   							 <span class="input-group-text" id="basic-addon1">ZipCode</span>
  							</div>
							 <input type="text" name="location_input" class="form-control" placeholder="Example:24424 or 'California' " aria-label="Username" aria-describedby="basic-addon1">
							</div>

							<div class="form-row">
							<div class="col-auto my-1">
								<label class="mr-sm-2" for="inlineFormCustomSelect">Distance Range</label>
								<select class="custom-select name="range_input" mr-sm-2" id="inlineFormCustomSelect">
									<option selected>Distance Range</option>
									<option value="20">20 Miles</option>
									<option value="50">50 Miles</option>
									<option value="100">100 Miles</option>
									<option value="250">250 Miles</option>
									<option value="500">500 Miles</option>
									<option value="999">999 Miles</option>
									<option value="0">No Limit</option>
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
							<button onclick="getLocation()">Get my location</button>
							</div>


</body>


</html>
