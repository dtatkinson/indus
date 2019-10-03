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
      var photos = result["photos"];
      var address = result["formatted_address"];
      var contactNumber = result["international_phone_number"];
      var website = result["website"];
      var reviews = result["reviews"];

      document.getElementById("hospital-info").innerHTML = "Contact: "+contactNumber+"<br>Address: "+address+"<br>Website: <a target='_blank' href='"+website+"'>"+website+"</a>";

      if(photos && photos.length>0){
        document.getElementById(photoContainer).innerHTML += '<div class="carousel-item active"><img class="d-block w-40" src="'+photos[0].getUrl()+'" alt="First slide"></div>';
        for(var i=1;i<photos.length;i++)
          document.getElementById(photoContainer).innerHTML += '<div class="carousel-item"><img class="d-block w-40" src="'+photos[i].getUrl()+'" alt="First slide"></div>';
      }else{
          document.getElementById(photoContainer).innerHTML += "No photos available for this hospital";
      }

      /*if(result["photos"] && result["photos"].length>0){
        document.getElementById(photoContainer).innerHTML += '<div class="carousel-item active"><img class="d-block w-40" src="'+result["photos"][0].getUrl()+'" alt="First slide"></div>';
        for(var i=1;i<result["photos"].length;i++)
          document.getElementById(photoContainer).innerHTML += '<div class="carousel-item"><img class="d-block w-40" src="'+result["photos"][i].getUrl()+'" alt="First slide"></div>';
      }else{
          document.getElementById(photoContainer).innerHTML += "No photos available for this hospital";
      }*/
    }
  });
}
