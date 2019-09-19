<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="Trial.css" rel="stylesheet" type="text/css"> 
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAWOLJZDit5LJs6RhOe2fjY3hJUKnqJjvs&callback=initMap"
            type="text/javascript"></script>
            
            <script type="text/javascript">
            var locations = [
            ['Bondi Beach', -33.890542, 151.274856, 4,'Price = 100','bondibeach'],
            ['Coogee Beach', -33.923036, 151.259052, 5,'Price = 10220','coogeebeach'],
            ['Cronulla Beach', -34.028249, 151.157507, 3,'Price = 1500','cronullabeach'],
            ['Manly Beach', -33.80010128657071, 151.28747820854187, 2,'Price = 1600','manlybeach'],
            ['Maroubra Beach', -33.950198, 151.259302, 1,'Price = 16300','maroubrabeach']
            ];
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
        for(int i = 0;i<locations.length();i++)
        {
            document.write("<div class='card'>");
                    document.write("<div class='card-body'>");
                        document.write( "<h1>" + locations[i][0] + "</h1>");                    
                        document.write(locations[i][4] + "<br>");
                        document.write("<br>");
                      
                    document.write("</div>");
            document.write("</div>");
        }
        </script>
    </div>
        

  <div id="map"> 

<script type="text/javascript">

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 10,
            center: new google.maps.LatLng(-33.92, 151.25),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var infowindow = new google.maps.InfoWindow();

        var marker, i;

        for (i = 0; i < locations.length; i++) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map,
                label: ":)",
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