<?php
include("header.php");
if(isset($_POST['submit']))
{
	$iframeCode = $_POST["locationmap"];
	$dom = new DOMDocument();
	$dom->loadHTML($iframeCode);
	$locationmap = $dom->getElementsByTagName('iframe')->item(0)->getAttribute('src');
	if(isset($_GET['editid']))
	{
		$sql ="UPDATE location set locationname='$_POST[locationname]',locationdetail='$_POST[locationdetail]',locationmap='" . mysqli_real_escape_string($con,$locationmap) . "',status='$_POST[status]' WHERE locationid='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Location record updated successfully..')</script>";
		}
	}
	else
	{
		$sql = "INSERT INTO location(locationname,locationdetail,locationmap,status) VALUES('$_POST[locationname]','$_POST[locationdetail]','" . mysqli_real_escape_string($con,$locationmap) . "','$_POST[status]')";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Location record inserted successfully..');</script>";
			echo "<script>window.location='location.php';</script>";
		}
	}
}
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM location WHERE locationid='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	echo mysqli_error($con);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>    	 	
<!-- start contact -->
    	<section id="contact">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-12">
    					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s"> <span>Location</span></h2>
    				</div>
<?php
//include("sidebar.php");
?>
    				<div class="col-md-12 col-sm-12 col-xs-12 wow fadeInLeft" data-wow-offset="50" data-wow-delay="0.9s">
						<form action="" method="post" enctype="multipart/form-data">
							<div class="form-left" >
								<label>Location Name</label>
								<input type="text" name="locationname" placeholder="Location Name" value="<?php echo $rsedit['locationname']; ?>" class="form-control"  >
							</div>
							<div class="form-left ">
								<label>Location detail</label>
								<textarea name="locationdetail" placeholder="Location detail" class="form-control"><?php echo $rsedit['locationdetail']; ?></textarea>
							</div>
							<div class="form-left ">
								<label>Location Map</label>
								<textarea name="locationmap" placeholder="Location map" class="form-control"><?php 
								if(isset($rsedit['locationmap'])) {
									echo "<iframe src='" . $rsedit['locationmap'] . "' width='100%' height='450' frameborder='0' style='border:0' allowfullscreen></iframe>";
								}
								?></textarea>
							</div>
							<div class="form-left ">
								<label>Status</label>
								<select name=status class="form-control">
								<option value=''>Select</option>
								<?php
								$arr = array("Active","Inactive");
								foreach($arr as $value)
								{
									if($rsedit['status'] == $value)
									{
										echo "<option value='$value' selected>$value</option>";
									}
									else
									{
										echo "<option value='$value'>$value</option>";
									}
								}
								?>
								</select>
							</div>
							<div class="clearfix"> </div>
							<input type="submit" value="SUBMIT" name=submit class="form-control">
						</form>
    				</div>

    			</div>
    		</div>
    	</section>
    	<!-- end contact -->
<?php
include("footer.php");
?>