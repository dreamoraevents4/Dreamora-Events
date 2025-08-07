<?php
include("header.php");
?>

    	<!-- start team -->
    	<section id="team">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-12">
    					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s"><span>SELECT</span> EVENT Package</h2>
    				</div>
					
<?php
$sql ="SELECT event_package.*,eventtype.eventtype FROM event_package LEFT JOIN eventtype on event_package.eventtype_id=eventtype.eventtype_id where event_package.status='Active'  AND event_package.eventtype_id='$_GET[eventtypeid]'";					
$qsql = mysqli_query($con,$sql);
while($rs = mysqli_fetch_array($qsql))
{
	if(file_exists("imgevent/".$rs['images']))
	{
		$img = "imgevent/".$rs['images'];
	}
	else
	{
		$img = "imgevent/photo.jpg";
	}
?>
	<div class="col-md-4 col-sm-6 col-xs-12 wow fadeIn" data-wow-offset="50" data-wow-delay="1.3s"  onclick="window.location='displayeventsdetailed.php?locationid=<?php echo $_GET['locationid']; ?>&eventtypeid=<?php echo $_GET['eventtypeid']; ?>&event_package_id=<?php echo $rs[0]; ?>'">
		<div class="team-wrapper">
			<img src="<?php echo $img; ?>" class="img-responsive" style="height:225px;width:100%;">
				<div class="team-des">
					<h4><?php echo $rs['packagetitle']; ?></h4>
					<p><?php echo $rs['eventdescription']; ?></p>
    				<span>₹<?php echo $rs['eventcost']; ?> per day</span>
				</div>
		</div>
	<hr>
	</div>
<?php
}
?>
					
				</div>
    		</div>
    	</section>
    	<!-- end team -->



<?php
include("footer.php");
?>