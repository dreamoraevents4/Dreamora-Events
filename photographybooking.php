<?php
include("header.php");
if(isset($_POST['submit']))
{
	if(isset($_GET['editid']))
	{
		$sql ="UPDATE photography_booking set employee_id='$_POST[employeeid]',customer_id='$_POST[customer_id]',bookingcost='$_POST[bookingcost]',bookingfdate='$_POST[bookingfdate]',bookingtdate='$_POST[bookingtdate]',bookingtime='$_POST[bookingtime]',status='$_POST[status]' WHERE photography_bookingid='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Photography Booking record updated successfully..')</script>";
		}
	}
	else
	{
		$sql = "INSERT INTO photography_booking(employee_id,customer_id,bookingcost,bookingfdate,bookingtdate,bookingtime,status) 
		VALUES('$_POST[employeeid]','$_POST[customer_id]','$_POST[bookingcost]','$_POST[bookingfdate]','$_POST[bookingtdate]','$_POST[bookingtime]','$_POST[status]')";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Photography Booking  record inserted successfully..')</script>";
		}
	}
}
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM photography_booking WHERE photography_bookingid='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>    	 	
<!-- start contact -->
    	<section id="contact">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-12">
    					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s"> <span>Photography Booking</span></h2>
						<p >Kindly enter the Photography Booking information...</p>
    				</div>
<?php
include("sidebar.php");
?>
    				<div class="col-md-9 col-sm-9 col-xs-12 wow fadeInLeft" data-wow-offset="50" data-wow-delay="0.9s">
<form action="" method="post">
				<div class="form-left ">
					<label>Employee</label>
					<select name="employeeid">
						<option value=''>Select</option>
						<?php
						$sqlemployee = "SELECT * FROM employee where status='Active'";
						$qsqlemployee = mysqli_query($con,$sqlemployee);
						while($rsemployee = mysqli_fetch_array($qsqlemployee))
						{
							if($rsemployee['employee_id']==$rsedit['employee_id'])
							{
								echo "<option value='$rsemployee[employee_id]' selected>$rsemployee[employeetype]</option>";
							}
							else
							{
								echo "<option value='$rsemployee[employee_id]'>$rsemployee[employeetype]</option>";
							}
						}
						?>
					</select>
				</div>
					<div class="form-left">
						<label>Customer</label>
						<select name="customer_id">
							<option value=''>Select</option>
							<?php
							$sqlcustomer = "SELECT * FROM customer where status='Active'";
							$qsqlcustomer = mysqli_query($con,$sqlcustomer);
							while($rscustomer = mysqli_fetch_array($qsqlcustomer))
							{
								if($rscustomer['customer_id']==$rsedit['customer_id'])
								{
									echo "<option value='$rscustomer[customer_id]' selected>$rscustomer[customer_name]</option>";
								}
								else
								{
									echo "<option value='$rscustomer[customer_id]'>$rscustomer[customer_name]</option>";
								}
							}
							?>
						</select>
					</div>
					<div class="form-left" >
						<label>Booking Cost</label>
						<input type="text" name="bookingcost" placeholder="bookingcost" value="<?php echo $rsedit['bookingcost']; ?>" >
					</div>
					<div class="form-left" >
					<label>Booking Date:</label><br>
						<label>From:</label>
						<input type="date" name="bookingfdate" placeholder="bookingfdate" value="<?php echo $rsedit['bookingfdate']; ?>" >
					</div>
					<div class="form-left" >
						<label>To:</label>
						<input type="date" name="bookingtdate" placeholder="bookingtdate" value="<?php echo $rsedit['bookingtdate']; ?>">
					</div>
					<div class="form-left" >
						<label>Booking time</label>
						<input type="time" name="bookingtime" placeholder="bookingtime" value="<?php echo $rsedit['bookingtime']; ?>" >
					</div>
					<div class="form-left ">
						<label>Status</label>
						<select name="status">
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
					<input type="submit" name="submit" value="SUBMIT" >
				</form>
    				</div>

    			</div>
    		</div>
    	</section>
    	<!-- end contact -->
<?php
include("footer.php");
?>