<?php
include("header.php");
?>

    	<!-- start team -->
    	<section id="team">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-12">
    					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s"><span>Editography</span> services</h2>
    				</div>
					
<?php
$sql ="SELECT * FROM editography where status='Active'";					
$qsql = mysqli_query($con,$sql);
while($rs = mysqli_fetch_array($qsql))
{
	if(file_exists("imgemp/".$rs['img']))
	{
		$img = "imgemp/".$rs['img'];
	}
	else
	{
		$img = "images/event.png";
	}
?>
	<div class="col-md-3 col-sm-6 col-xs-12 wow fadeIn" data-wow-offset="50" data-wow-delay="1.3s" onclick="window.location='editographyorder.php?locationid=<?php echo $_GET['locationid']; ?>&eventtypeid=<?php echo $rs[0]; ?>';" >
		<div class="team-wrapper">
			<img src="<?php echo $img; ?>" class="img-responsive" alt="team img 1">
				<div class="team-des">
					<h4><?php echo $rs['editography_type']; ?></h4>
					<p><?php echo $rs['description']; ?></p>
					<span>Cost - ₹<?php echo $rs['default_cost']; ?></span>
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