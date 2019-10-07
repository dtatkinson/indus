var current_page = 1;
var records_per_page = 10;

//function called when previous button is clicked loads previous page of data
function prevPage()
{
    if (current_page > 1) {
        current_page--;
        changePage(current_page);
        display();
    }

}

//function called when next button is clicked loads next page of data
function nextPage()
{

    if (current_page < numPages()) {
        current_page++;
        changePage(current_page);
        display();
    }

}

//actual function to change 
function changePage(page)
{
    var btn_next = document.getElementById("btn_next");
    var btn_prev = document.getElementById("btn_prev");
    var searchres = document.getElementById("searchres");
   // var page_span = document.getElementById("page");

    // Validate page
    if (page < 1) page = 1;
    if (page > numPages()) page = numPages();

    //searchres.innerHTML = '	<ul class="pagination"><li class="page-item"><a class="page-link" id="btn_prev" href="javascript:prevPage()">Previous</a></li><li class="page-item"><a class="page-link" id="btn_next" href="javascript:nextPage()">Next</a></li></ul>';
    searchres.innerHTML = "";
    for (var i = (page) * records_per_page; i < (page * records_per_page); i++) {
        searchres.innerHTML += "<div class='card'>"+"<div class='card-body'>"+ "<h3>" + actualLocation[i]["providerName"] + "</h3>"+"$" + actualLocation[i]["averageTotalPayments"] + "<br>"+"<br>"+"<a href='#' value='i.value' onclick='show("+i+")'>View</a>"+"</div>"+"</div>";

    }
    //page_span.innerHTML = page;

    if (page == 1) {
        btn_prev.style.visibility = "hidden";
    } else {
        btn_prev.style.visibility = "visible";
    }

    if (page == numPages()) {
        btn_next.style.visibility = "hidden";
    } else {
        btn_next.style.visibility = "visible";
    }
}
function test()
{
    alert("test");
}

//rounds a  number to next whole number
function numPages()
{
    return Math.ceil(actualLocation.length / records_per_page);
}
/*
window.onload = function() {
    changePage(1);
};
*/
