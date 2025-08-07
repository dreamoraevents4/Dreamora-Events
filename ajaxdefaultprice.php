<?php
include("dbconnection.php");
error_reporting(0);
$sql = "SELECT * FROM editography where editographytypeid='$_GET[defaultcostid]'";
$qsql = mysqli_query($con,$sql);
$rs = mysqli_fetch_array($qsql);
?>
<?php  echo $rs['defaultcost']; ?>