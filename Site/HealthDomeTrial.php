<html>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="Trial.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
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
									<option value="1">20 Miles</option>
									<option value="2">40 Miles</option>
									<option value="3">40+ Miles</option>
								</select>

							</div>


							<div class="col-auto my-1">
							<label for="inlineFormCustomSelect">Max Price</label>
							<input class="custom-select mr-sm-2" type="number" name="price_input" id="inlineFormCustomSelect">
							</div>
							<div class="col-auto my-1">
							<div class="form-check">
							<input type="checkbox" name="medicare_input" class="inline-form-check-input" id="exampleCheck1">
							<label class="form-check-label" for="exampleCheck1">I have Medicare</label>
								</div>
								</div>

							</div>
							<div class="Searchbutton">
							<input type="submit" class="btn btn-primary btn-block" value="Search"></button>
							</div>

					</form>
 		 		</div>
  		  </div>
	</div>

	<div class ="Infobox1">
		<div class="card border-primary mb-3" style="max-width: 18rem;">
  			<div class="card-header">Random info</div>
 				 <div class="card-body text-primary">
   					 <h5 class="card-title">Primary card title</h5>
    					<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  			</div>
		</div>
	</div>

		<div class ="Infobox2">
		<div class="card border-primary mb-3" style="max-width: 18rem;">
  			<div class="card-header">Random info</div>
 				 <div class="card-body text-primary">
   					 <h5 class="card-title">Primary card title</h5>
    					<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  			</div>
		</div>
	</div>

		<div class ="Infobox3">
		<div class="card border-primary mb-3" style="max-width: 18rem;">
  			<div class="card-header">Random info</div>
 				 <div class="card-body text-primary">
   					 <h5 class="card-title">Primary card title</h5>
    					<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  			</div>
		</div>
	</div>



</body>


</html>
