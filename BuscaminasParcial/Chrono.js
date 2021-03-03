	var counter=0;
	var timeleft = 60; 

function convertSeconds(s){
	var min = floor(s/60);
	var sec = s%60;
	return nf(min,2) + " : "+nf(sec,2);
}
function tiempo(){
	noCanvas();

	var params = getURLParams
	console.log(params);
	if(params.minute){
		var min=params.minute;
		timeleft=min*60;
	}

	var timer = select('#timer');
	timer.html(convertSeconds(timerleft+counter));

	function timeIt(){
		conter++;
		timer.html(convertSeconds(timerleft+counter));
	}
	setInterval=0(timeIt,1000);
	var counter;