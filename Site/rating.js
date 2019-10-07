
var ratingFields, tempActualLocation, totalWeights;
//function that add our personal rating to the hospital array
function addRatings(){
  if(choice == 0){
    ratingFields = [
       {field:"averageTotalPayments",weight:3,order:"dsc"},
       {field:"center_distance",weight:2,order:"dsc"},
       {field:"totalDischarges",weight:1,order:"dsc"}
    ];
  }else{
    ratingFields = [
      {field:"averageTotalPayments",weight:3,order:"dsc"},
       {field:"totalDischarges",weight:1,order:"dsc"}
    ];
  }

  tempActualLocation = Object.create(actualLocation);
   totalWeights = getTotalWeights();
   for(var i=0;i<actualLocation.length;i++){
     actualLocation[i]["rating"] = getOverallRating(actualLocation[i]);
   }
}
//calculates general rating 
function getOverallRating(hospital){
   var overallRating = 0;

   for(var i=0;i<ratingFields.length;i++){
     overallRating += getSingleRating(hospital,ratingFields[i]);
   }
   return overallRating/totalWeights;
}
//calculates the rating of a single field
function getSingleRating(hospital,ratingField){
   sort(ratingField["field"],ratingField["order"]);

   var position = getPosition(tempActualLocation,hospital);

   var singleRating = position/actualLocation.length*ratingField["weight"]*10;
   //alert(position/actualLocation.length);
   return singleRating;
}
//sorts the hospitals 
function sort(field,order){
   if(order=="asc")
tempActualLocation.sort(function(a,b){return(a[field]-b[field])});
   else
tempActualLocation.sort(function(a,b){return(b[field]-a[field])});
}
//gets the position of the hospital in the array 
function getPosition(tempActualLocation,hospital){
   var counter = 1;
   for(var i=0;i<tempActualLocation.length;i++){
if(tempActualLocation[i]["providerName"]==hospital["providerName"])
       break;
     else
       counter++;
   }
   //document.write(hospital["name"]+" position is "+counter+"<br>");
   return counter
}
//calculates the total weights 
function getTotalWeights(){
   var tWeights = 0;
   for(var i=0;i<ratingFields.length;i++){
     tWeights += ratingFields[i]["weight"];
   }
   return tWeights;
}
