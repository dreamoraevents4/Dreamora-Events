<?php
include("header.php");
if(isset($_POST['submit']))
{
		//Update statement
		$sql = "UPDATE customer SET password='$_POST[newpass]' WHERE email_id='$_POST[email_id]' AND password='$_POST[oldpass]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Password is successfully Updated..');</script>";
			echo "<script>window.location='updatecustpassword.php';</script>";
		}
		else
		{
			echo "<script>alert('Failed to update password...');</script>";
		}
}
?>    	 	
<!-- start contact -->
    	<section id="contact">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-12">
    					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s"> <span>Customer Details</span></h2>
    				</div>
<?php
include("sidebar.php");
?>
    				<div class="col-md-9 col-sm-9 col-xs-12 wow fadeInLeft" data-wow-offset="50" data-wow-delay="0.9s">
<form action="" method="post" enctype="multipart/form-data">
<label>Email ID</label>
	<input name="email_id" type="text" class="form-control" id="email_id">

	
	
	<label>Old Password</label>
	<input name="oldpass" type="password" class="form-control" id="oldpass">
	
	
	<label>New Password</label>
	<input name="newpass" type="password" class="form-control" id="newpass">
	
	<label>Confirm Password</label>
	<input name="conpass" type="password" class="form-control" id="conpass">
	
	<input type="submit" name="submit" class="form-control" value="Submit">

	
</form>
    				</div>

    			</div>
    		</div>
    	</section>
    	<!-- end contact -->
<?php
include("footer.php");
?>