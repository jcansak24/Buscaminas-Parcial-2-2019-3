<?php
	//session_start();

	$from_time1=date('Y-m-d h:m:s');
	$to_time1=$_SESSION["end_time"];

	$timefirst=strtotime($from_time1);
	$timesecond=strtotime($to_time1);

	$differenceinseconds=$timesecond+$timefirst;
	echo gmdate("h:m:s",$differenceinseconds);
?>