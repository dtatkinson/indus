<?php
$servername = "silva.computing.dundee.ac.uk";
$username = "2019indteam2";
$password = "9364.ind2.4639";

$conn = mysqli_connect($servername, $username, $password);

if(!$conn){
	die("Connection failed: " . mysqli_connect_error());
	}
if($conn){
echo "connected";
}
?>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="Trial.css" rel="stylesheet" type="text/css"> 
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
				<h1> Compare Prices! </h1>
   						 <div class="input-group mb-3">
  							<div class="input-group-prepend">
   							 <span class="input-group-text" id="basic-addon1">Injury</span>
  							</div>
 							 <input type="text" class="form-control" placeholder="Example: Broken Leg" aria-label="Username" aria-describedby="basic-addon1">
							 <div class="input-group-prepend">
   							 <span class="input-group-text" id="basic-addon1">ZipCode</span>
  							</div>
							 <input type="text" class="form-control" placeholder="Example:24424 or 'California' " aria-label="Username" aria-describedby="basic-addon1">
							</div>
							
							<div class="Searchbutton">
							<button type="button" class="btn btn-primary btn-block">Search</button>
							</div>
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