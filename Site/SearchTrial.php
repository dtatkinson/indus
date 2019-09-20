
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

$injury = $_POST["injury_input"];
$location = $_POST["location_input"];
$range = $_POST["range_input"];
$price = $_POST["price_input"];
$medicare = $_POST["medicare_input"];

//query stuff
//hardcoded input, this will need to change so user inoput is taken
$description = "other";
//var storing the query
$sql = ("SELECT * FROM 2019indteam2db.codes_info WHERE description LIKE '%".$injury."%';");

//$result stores the result of the query, you can convert this to use in javascript, see david for this
$result = mysqli_query($conn,$sql);
$results = [];
while($row = mysqli_fetch_array($result))
{
 //   echo $row["code"];
    $results[] = $row;

}
echo $results[0][0];
echo $results[0][1];
//echo "<script type='text\javascript'> var locations = ".$jsarray."; <script>";
//closes connection to the database
 //mysqli_close($conn);
}
?>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="Trial.css" rel="stylesheet" type="text/css">
<script src="https://maps.googleapis.com/maps/api/js?key="
            type="text/javascript"></script>

            <script type="text/javascript">
            var i;
            var locations = <?php echo(json_encode($results));?>

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

<body>
<div class = "resultholder">

    <div class = "searchresult">
        <script type="text/javascript">

 for(i = 0;i<locations.length;i++)
        {
            document.write("<div class='card'>");
                    document.write("<div class='card-body'>");
                        document.write( "<h1>" + locations[i]["code"] + "</h1>");
                        document.write(locations[i]["description"] + "<br>");
                        document.write("<br>");

                    document.write("</div>");
            document.write("</div>");
        }
        </script>
    </div>


  <div id="map">

<script type="text/javascript">

        var map = new google.maps.Map(document.getElementById('map'),
        {
            zoom: 10,
            center: new google.maps.LatLng(-33.92, 151.25),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var infowindow = new google.maps.InfoWindow();

        var marker, i;

        for (i = 0; i < locations.length; i++)
        {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map,
                label: "H",
            });

            google.maps.event.addListener(marker, 'click', (function (marker, i) {
                return function () {
                    infowindow.setContent("<p>" + locations[i][0] + "<br/>" + locations[i][4] + "<br/>" + "<a href=" + locations[i][5]+" > More Info</a > ");
                    //alert(locations[i][4])
                    infowindow.open(map, marker);
                }
            })(marker, i));
        }
    </script>
    </div>
</body>
</html>
