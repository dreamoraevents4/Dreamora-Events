<?php
include("header.php");
$sql = "SELECT * FROM event_package WHERE status='Active' AND eventpackage_id='$_GET[event_package_id]'";
$qsql = mysqli_query($con,$sql);
echo mysqli_error($con);
$rs = mysqli_fetch_array($qsql);
if($rs['images'] == "")
{
	$fileName = "images/defaultimages.png";
}
else if(file_exists("imgevent/".$rs['images']))
{
    $fileName = "imgevent/$rs[images]";
}
else
{
    $fileName = "images/defaultimages.png";
}
?>

<!-- start about -->
<section id="about">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
			<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s"><?php echo $rs['packagetitle']; ?></h2>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-12 wow fadeInLeft" data-wow-offset="50" data-wow-delay="0.6s">
				<div class="media">
					<div class="media-body">
						<img src="<?php echo $fileName; ?>" style="width:100%; height:250px;" />
					</div>
				</div>
			</div>
			<div class="col-md-8 col-sm-8 col-xs-12 wow fadeInUp" data-wow-offset="50" data-wow-delay="0.9s">
				<div class="media">
					<div class="media-heading-wrapper">
						<div class="media-object pull-left">
							<i class="fa fa-comment-o"></i>
						</div>
						<p><?php echo $rs['eventdescription']; ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- end about -->

<!-- start team -->
<section id="team">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s"><span><?php echo $rs['packagetitle']; ?> highlights...</span></h2>
			</div>
			<div class="col-md-8 col-sm-8 col-xs-12 wow fadeIn" data-wow-offset="50" data-wow-delay="1.3s">
				<div class="team-wrapper">
						<div class="team-des">
							<p><?php echo $rs['highlights']; ?></p>
						</div>
				</div>
			</div>
			
			<div class="col-md-4 col-sm-4 col-xs-12 wow fadeIn" data-wow-offset="50" data-wow-delay="1.6s">
				<div class="team-wrapper">
						<div class="team-des">    								
							<center><h4>Cost</h4>
							<span> ₹ <?php echo $rs['eventcost']; ?></span>
							<br>
<?php
if(isset($_SESSION['customer_id']))
{
?>							
		<a href='eventbooking.php?locationid=<?php echo $_GET['locationid']; ?>&eventtypeid=<?php echo $_GET['eventtypeid']; ?>&event_package_id=<?php echo $_GET['event_package_id']; ?>' style="color: #FFFFFF;width:230px;font-size: 16px;font-weight: 600;text-decoration: none;border: solid 2px #095880;background: #095880;padding: 	.7em 3em;border-radius: 20px;-webkit-border-radius: 26px;">Click here to Book</a>
<?php
}
else
{
?>
		<a href='custlogin.php?locationid=<?php echo $_GET['locationid']; ?>&eventtypeid=<?php echo $_GET['eventtypeid']; ?>&event_package_id=<?php echo $_GET['event_package_id']; ?>' style="color: #FFFFFF;width:230px;font-size: 16px;font-weight: 600;text-decoration: none;border: solid 2px #095880;background: #095880;padding: 	.7em 3em;border-radius: 20px;-webkit-border-radius: 26px;">Login to Book</a>
<?php
}
?>
							</center>
						</div>
				</div>
			</div>
			
		</div>
	</div>
</section>
<!-- end team -->
<?php
include("footer.php");
?>