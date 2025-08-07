<?php
include("header.php");
?>

    	<!-- start team -->
    	<section id="team">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-12">
    					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s"><span>PHOTOGRAPHER</span> </h2>
    				</div>
					
<?php
$sql ="SELECT * FROM employee where status='Active' AND employeetype='Photographer'";					
$qsql = mysqli_query($con,$sql);
while($rs = mysqli_fetch_array($qsql))
{
	if($rs['empimage'] == "")
	{
		$img = "images/photo.jpg";
	}
	else if(file_exists("imgemp/".$rs['empimage']))
	{
		$img = "imgemp/".$rs['empimage'];
	}
	else
	{
		$img = "images/photo.jpg";
	}
?>
	<div class="col-md-4 col-sm-6 col-xs-12 wow fadeIn" data-wow-offset="50" data-wow-delay="1.3s"  onclick="window.location='photographerprofile.php?photographerid=<?php echo $rs[0]; ?>&locationid=<?php echo $_GET['locationid']; ?>'">
		<div class="team-wrapper">
			<!-- Display Photographer -->
			<img src="<?php echo $img; ?>" class="img-responsive" style="height: 250px;width: 100%;">
				<div class="team-des">
					<h4><?php echo $rs['employeename']; ?></h4>
					<p><?php echo $rs['empprofile']; ?></p>
    				<span>₹<?php echo $rs['photographycost']; ?> per day</span>
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