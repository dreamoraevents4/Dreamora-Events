<?php
include("header.php");
if(isset($_POST['submit']))
{
	$sql = "UPDATE customer SET customer_name='$_POST[customer_name]',email_id='$_POST[email_id]',address='$_POST[address]',contactno='$_POST[contactno]' WHERE  customer_id='$_SESSION[customer_id]'";
	$qsql = mysqli_query($con,$sql);
	if(!$qsql)
	{
		echo mysqli_error($con);
	}
	else
	{
		echo "<script>alert('Customer Profile updated successfully..');</script>";
		echo "<script>window.location='customerprofile.php';</script>";
	}
}
	$sqlcustomer = "SELECT * FROM  customer WHERE customer_id='$_SESSION[customer_id]'";
	$qsqlcustomer  = mysqli_query($con,$sqlcustomer);
	$rscustomer= mysqli_fetch_array($qsqlcustomer);
?>    	 	
<!-- start contact -->
    	<section id="contact">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-12">
    					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s"> <span>Customer Details</span></h2>
    				</div>

    				<div class="col-md-6 col-sm-6 col-xs-12 wow fadeInLeft" data-wow-offset="50" data-wow-delay="0.9s">
<form action="" method="post" enctype="multipart/form-data">
	

	<label>Customer Name</label>
	<input name="customer_name" type="text" class="form-control" id="customer_name" value="<?php echo $rscustomer['customer_name']; ?>">
	
	<label>Email ID</label>
	<input name="email_id" type="text" class="form-control" id="email_id" value="<?php echo $rscustomer['email_id']; ?>">
	
	
		
	<label>Address</label>
	<textarea name="address" class="form-control" id="address" ><?php echo $rscustomer['address']; ?></textarea>
	
	<label>Contact No</label>
	<input name="contactno" type="text" class="form-control" id="contactno"  value="<?php echo $rscustomer['contactno']; ?>">
	
		
	
	<input name="submit" type="SUBMIT" class="form-control" id="submit" value="SUBMIT">
	
</form>
    				</div>

    			</div>
    		</div>
    	</section>
    	<!-- end contact -->
<?php
include("footer.php");
?>