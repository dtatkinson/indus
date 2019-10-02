var projected, avg, projectedval;
var pera, perb, perc, perd, pere, perf;
function getPercent(yeara,yearb){
    var projected;
    projected = (yeara/yearb)*100;
    projected = 100-projected;
    return projected;
}

function calculate(){
    
    //pera = getPercent(a,b);
    //perb = getPercent(b,c);
    //perc = getPercent(c,d);
    perd = getPercent(d,e);
    pere = getPercent(e,f);
    perf = getPercent(f,g);

    var sum = perd+pere+perf;
    avg = sum/3;
   
    projectedval = g * ((100+avg)/100);
    projectedval = projectedval.toFixed(2);

}