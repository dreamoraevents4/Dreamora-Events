<?php
include("header.php");
?>
    	<!-- start team -->
    	<section id="team">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-12">
    					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s"><span>SELECT LOCATION</span></h2>
    				</div>
<?php
$sql ="SELECT * FROM location where status='Active'";					
$qsql = mysqli_query($con,$sql);
while($rs = mysqli_fetch_array($qsql))
{
?>
	<div class="col-md-4 col-sm-4 col-xs-4 wow fadeIn" data-wow-offset="50" data-wow-delay="1.3s" <?php
if($_GET['selected'] == "Event")
{
?>
onclick="window.location='displayevent.php?locationid=<?php echo $rs[0]; ?>';"
<?php
}
if($_GET['selected'] == "Photographer")
{
?>
onclick="window.location='displayphotographer.php?locationid=<?php echo $rs[0]; ?>';" 
<?php
}
if($_GET['selected'] == "Editography")
{
?>
onclick="window.location='displayeditography.php?locationid=<?php echo $rs[0]; ?>';" 
<?php
}
?> >
		<div class="team-wrapper">
			<iframe src="<?php echo $rs['locationmap']; ?>" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
			<div class="team-des">
				<h4><?php echo $rs['locationname']; ?></h4>
				<p><?php echo $rs['locationdetail']; ?></p>
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