var mapContainer = "map-container";
var photoContainer = "photos-container";

function getPhotos(){

    //Remove the map object and replace with the actual object
    map = new google.maps.Map(
    document.getElementById(mapContainer),{center: new google.maps.LatLng(0,0), zoom:10}
  );

  var ref = -1;
  var photosDisplay = document.getElementById(photoContainer); //Element where the picture will be

  photosDisplay.innerHTML = "";//Might not be needed (only used to clear the room to put a new picture)


  var request = {
    query: document.getElementById("name_input").value, //Plug this with the name of the hospital
    fields: ["name","photos"], //No touchy
  };

  service = new google.maps.places.PlacesService(map);//No touchy

  service.findPlaceFromQuery(request, function(results, status){
    if(status === google.maps.places.PlacesServiceStatus.OK){
      for(var i=0;i<results[0]["photos"].length;i++){
        var photoUrl = results[0]["photos"][i].getUrl();
        var photoName = results[0]["name"];
        photosDisplay.innerHTML += "<image class='profile-photo' src="+photoUrl+" title='"+photoName+"'>";
      }
    }
  });
}
