<?php
	/*session_start();
	$link=mysql_connect("localhost","root","");
	mysqli_select_db($link,"keyur");
	$duration="";
	$res=mysqli_query($link,"select + from table");
	while($row=mysqli_fetch_array($res)){
		$duration=$row["duration"];
	}

	$_SESSION["duration"]=$duration;
	$_SESSION["start_time"]=date("Y-m-d h:m:s");

	$end_time=$end_time=date("Y-m-d h:m:s",strtotime('+'.$_SESSION['duration'].'minutes',strtotime($_SESSION['start_time'])));
	$_SESSION['end_time']=$end_time;

	/*	$seg=$diff;
				
		echo "0",$hora;
		echo "0",$min;
		echo "0",$seg;

		$_SESSION['time']=$_SESSION['time']+1;
		$seg=$_SESSION['time'];
		if ($hora==23 || $min==59 || $seg==59) {
			echo "<br>time up";
			unset($_SESSION['time']);
		}

		if ($hora==23) {
			if ($min==59) {
				if ($seg==59) {
					unset($_SESSION['time']);
				}
				else  {
					$seg=0;
				}
			}
			else{
				if ($seg==59) {
					$seg=0;
					echo $seg;
					$min++;
				}
				else{
					$seg++;
					$min++;
				}
			}
			
		}

		else{
			if ($min==59){
				if($seg==59) {
					$min=0;
					$seg=0;
					$hora++;
				}
				else{
					$seg++;
					$min++;
				}
			}			
			else{
				if ($seg==59) {
					$seg=0;
				}
				else{
					$seg++;
				}
			}
		}
	}*/
		
function tiempo(){
	noCanvas();
	var counter=0;
	var timer = select('#timer');
	timer.html('0');

	function timeIt(){
		conter++;
		timer.html(conter);
	}
	setInterval=0(timeIt,1000);
}	
?>
<script type="text/javascript">
	window.location="index.php";
</script>
<script>
	$(document).ready(function () {
		var isPaused = false;
		var time = 0;
		var t = window.setInterval(function)
		{
			if(!isPaused) $("$result_shops").load('time.php');
		},1000); 
	
		$('.pause').on('click',function(e)) {
			e.preventDefault();
			isPaused= true;
		});

		$(',play').on('click',function(e)){
			e.preventDefault();
			isPaused= false;
		});
	});
</script>>