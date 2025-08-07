<?php
error_reporting(0);
$date1 = date_create($_GET['fdate']);
$date2 = date_create($_GET['tdate']);

//difference between two dates
$diff = date_diff($date1,$date2);

//count days
echo $diff->format("%a")+1;
/*
if($diff->format("%a") == 1)
{
	echo " Day";
}
else
{
	echo " Days";
}
*/
?>