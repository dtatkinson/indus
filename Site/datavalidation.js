var valid_numbers = "012345679";
var valid_chars_injury = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789:/ ";
var valid_chars_address = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789 ";

function validateInput(){

  var valid = true;
  var searchType = document.getElementById("locselect").value;
  var address = document.getElementById("address").value
  var price = document.getElementsByName("price_input")[0].value;
  var injury = document.getElementsByName("injury_input")[0].value;
  var issues = "Please fix the following issues before continuing:";

  //Injury
  if(!searchedwords.includes(injury) || injury == ""){
    valid = false;
    issues += "\n-You must select an injury from the injuries list";
  }

  //Address
  if(searchType == 1 && (address == "" || !validate(address,valid_chars_address))){
    valid = false;
    issues += "\n-You must enter a valid address";
  }else{
    //Location coordinates
    if(searchType == 1 && (document.getElementById('lat').value=="" || document.getElementById('long').value=="")){
      valid = false;
      issues += "\n-Could not find specified address";
    }
  }

  //Price
  if(!validate(price,valid_numbers)){
    valid = false;
    issues += "\n-You must enter a valid maximum price";
  }

  if(valid){
    document.getElementById("search_form").submit();
  }else{
    alert(issues);
  }
}

function validate(input,valid_lib){
  for(var i in input.split("")){
    if(!valid_lib.includes(input[i])){
      return false;
    }
  }
  return true;
}
