var mapContainer = "map";
var photoContainer = "carousel-inner";
var map, service, placeId, placeRating,hospitalName;

function getPlaceDetails(hospitalName){
  this.hospitalName = hospitalName;
  map = new google.maps.Map(
    document.getElementById("map"),{center: new google.maps.LatLng(0,0), zoom:10}
  );
  service = new google.maps.places.PlacesService(map);
  getPlaceId();
}

function getPlaceId(){
  var request = {
    query: hospitalName
  };

  service.textSearch(request, function(results, status){
    if(status === google.maps.places.PlacesServiceStatus.OK){
      placeId = results[0].place_id;
      placeRating = results[0]["rating"];
      getPlaceData();
    }else{
      document.getElementById(photoContainer).innerHTML = "No data found for this hospital";
    }
  });
}

function getPlaceData(){

  var request = {
    placeId: placeId
  };

  var service = new google.maps.places.PlacesService(map);//No touchy

  service.getDetails(request, function(result, status){
    if(status === google.maps.places.PlacesServiceStatus.OK){
      /*if(result["photos"] && result["photos"].length>0)
        document.getElementById(photoContainer).innerHTML = "<image class='hospital-photo' src="+result["photos"][0].getUrl()+">";
      else
        document.getElementById(photoContainer).innerHTML = "No photo available";*/

      /*if(result["opening_hours"].length>0)
        document.getElementById(photoContainer).innerHTML += "<image class='hospital-photo' src="+result["photos"][0].getUrl()+">";
      else
        document.getElementById(photoContainer).innerHTML = "No opening hours data available";*/
      if(result["photos"] && result["photos"].length>0){
        document.getElementById(photoContainer).innerHTML += '<div class="carousel-item active"><img class="d-block w-40" src="'+result["photos"][0].getUrl()+'" alt="First slide"></div>';
        for(var i=1;i<result["photos"].length;i++)
          document.getElementById(photoContainer).innerHTML += '<div class="carousel-item"><img class="d-block w-40" src="'+result["photos"][i].getUrl()+'" alt="First slide"></div>';
      }else{
          document.getElementById(photoContainer).innerHTML += "No photos available for this hospital";
      }
    }
  });
}
