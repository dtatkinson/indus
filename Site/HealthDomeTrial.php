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
if($conn){
echo "connected <br>";

//query stuff
//hardcoded input, this will need to change so user inoput is taken
$description = "heart";
//var storing the query
$sql = ("SELECT * FROM 2019indteam2db.codes_info WHERE description LIKE '%".$description."%';");
//$result stores the result of the query, you can convert this to use in javascript, see david for this
$result = mysqli_query($conn,$sql);
//this if basically checks if theres a result and prints them, purely for testing purposses
 if(mysqli_num_rows($result)>0){
	 while($row = mysqli_fetch_assoc($result))
	 {
		 echo "Code" .$row["code"]." - Description: " . $row["description"]."<br>";
	 }
 }else
 {
	echo "0 Results";
}
//closes connection to the database
 mysqli_close($conn);
}
?>
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
				<h1> Compare Prices! </h1>
   						 <div class="input-group mb-3">
  							<div class="input-group-prepend">
   							 <span class="input-group-text" id="basic-addon1">Injury</span>
  							</div>
 							 <input type="text" input id="tags" class="form-control" placeholder="Example: Broken Leg" aria-label="Username" aria-describedby="basic-addon1">
							 <div class="input-group-prepend">
   							 <span class="input-group-text" id="basic-addon1">ZipCode</span>
  							</div>
							 <input type="text" class="form-control" placeholder="Example:24424 or 'California' " aria-label="Username" aria-describedby="basic-addon1">
							</div>
							
							<div class="form-row">
							<div class="col-auto my-1">
								<label class="mr-sm-2" for="inlineFormCustomSelect">Distance Range</label>
								<select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
									<option selected>Distance Range</option>
									<option value="1">20 Miles</option>
									<option value="2">40 Miles</option>
									<option value="3">40+ Miles</option>
								</select>						

							</div>


							<div class="col-auto my-1">
							<label for="inlineFormCustomSelect">Price Range</label>
							<select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
									<option selected>Price Range</option>
									<option value="1">>$9000</option>
									<option value="2">>$15000</option>
									<option value="3">>$30000</option>
									<option value="4">$30000+</option>
								</select>
							</div>
							<div class="col-auto my-1">
							<div class="form-check">
							<input type="checkbox" class="inline-form-check-input" id="exampleCheck1">
							<label class="form-check-label" for="exampleCheck1">I have Medicare</label>
								</div>
								</div>
							
							</div>
							<div class="Searchbutton">
							<button type="button" input type="submit" class="btn btn-primary btn-block">Search</button>
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
