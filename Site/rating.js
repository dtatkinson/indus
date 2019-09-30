var ratingFields = [
   {field:"averageTotalPayments",weight:4,order:"dsc"},
   {field:"center_distance",weight:3,order:"dsc"},
   {field:"totalDischarges",weight:2,order:"dsc"}
];

var tempActualLocation = Object.create(actualLocation);

var totalWeights;

function addRatings(){
   totalWeights = getTotalWeights();
   for(var i=0;i<actualLocation.length;i++){
     actualLocation[i]["rating"] = getOverallRating(actualLocation[i])*10;
   }
}

function getOverallRating(hospital){
   var overallRating = 0;

   for(var i=0;i<ratingFields.length;i++){
     overallRating += getSingleRating(hospital,ratingFields[i]);
   }

   return overallRating/totalWeights;
}

function getSingleRating(hospital,ratingField){
   sort(ratingField["field"],ratingField["order"]);

   var singleRating =
getPosition(tempActualLocation,hospital)/actualLocation.length*ratingField["weight"];

   return singleRating;
}

function sort(field,order){
   if(order=="asc")
tempActualLocation.sort(function(a,b){return(a[field]-b[field])});
   else
tempActualLocation.sort(function(a,b){return(b[field]-a[field])});
}

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

function getTotalWeights(){
   var tWeights = 0;
   for(var i=0;i<ratingFields.length;i++){
     tWeights += ratingFields[i]["weight"];
   }
   return tWeights;
}

/*function display(hospList){
   for(var i=0;i<hospList.length;i++){
     alert(hospList[i]["providerName"]+"\tAverage Price:
"+hospList[i]["averageTotalPayments"]+"\tDischarges:
"+hospList[i]["totalDischarges"]+"\tDistance:
"+hospList[i]["center_distance"]+"\n");
   }
}*/