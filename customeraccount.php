<?php
include("header.php");
?>
    	<!-- start team -->
    	<section id="team" style="background: white;">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-12">
    					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s">---<span>Customer Account</span>---</h2>
    				</div>					
					
	<div class="col-md-6 col-sm-6 col-xs-12 wow fadeIn" class="mod_backcolor" data-wow-offset="50" data-wow-delay="1.3s" onclick="window.location='vieweventbookingrecord.php'">
		<div class="team-wrapper">
			<img src="images/eventbook.jpg" class="img-responsive" style="height:200px;width:100%;">
				<div class="team-des">
					<h4>Event Booking</h4>
					<span>Number of Bookings</span>
					<p>
<?php
$sql = "SELECT * FROM event_booking where customer_id='$_SESSION[customer_id]'";
$qsql = mysqli_query($con,$sql);
echo mysqli_error($con);
echo mysqli_num_rows($qsql) ." bookings";
?>									
					</p>
				</div>
		</div>
	</div>
					
					
					
	<div class="col-md-6 col-sm-6 col-xs-12 wow fadeIn" data-wow-offset="50" data-wow-delay="1.6s" onclick="window.location='viewphotographybooking.php'">
		<div class="team-wrapper">
			<img src="images/photography.jpg" class="img-responsive" style="height:200px;width:100%;">
				<div class="team-des">
					<h4>PHOTOGRAPHER</h4>
					<span> Number of photographers booked</span>
					<p>
				<?php
				$sql = "SELECT * FROM photography_booking where customer_id='$_SESSION[customer_id]'";
				$qsql = mysqli_query($con,$sql);
				echo mysqli_num_rows($qsql)." Photographers booked";
				?>
					</p>
				</div>
		</div>
	</div>
					
    				<div class="col-md-6 col-sm-6 col-xs-12 wow fadeIn" data-wow-offset="50" data-wow-delay="1.3s">
    					<div class="team-wrapper">
    						<img src="images/dueamount.jpg" class="img-responsive" style="height:200px;width:100%;">
    							<div class="team-des">
    								<h4>Event Booking Balance Amount</h4>
    								<p>
<?php
	$sqlevent_booking = "SELECT * FROM event_booking WHERE customer_id='$_SESSION[customer_id]'";
	$qsqlevent_booking = mysqli_query($con,$sqlevent_booking);
	echo mysqli_error($con);
	$rsevent_booking = mysqli_fetch_array($qsqlevent_booking);
	if(mysqli_num_rows($qsqlevent_booking) != 0) {

		$bookingfdate = date_create($rsevent_booking['bookingfdate']);
		$bookingtdate = date_create($rsevent_booking['bookingtdate']);
	
		//difference between two dates
		$diff = date_diff($bookingfdate,$bookingtdate);
	
		//count days
		$nodays = $diff->format("%a")+1;
	
		//Total cost
		$totalcost = $rsevent_booking['booking_cost'] * $nodays;
		
		$sqlpayment ="SELECT sum(paid_amt) FROM payment WHERE eventbookingid='$rsevent_booking[event_booking_id]' AND photographybookingid!='0' AND editographyorderid!='0'";
		$qsqlpayment = mysqli_query($con,$sqlpayment);
		echo mysqli_error($con);
		$rspayment = mysqli_fetch_array($qsqlpayment);
		$paidamt = $rspayment[0]; 
		$balanceamt= $totalcost - $paidamt;
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		echo " ₹ ".$balanceamt;
	}
	else {
		echo " ₹ 0";
	}
?>
									</p>
    							</div>
    					</div>
    				</div>
					
					<div class="col-md-6 col-sm-6 col-xs-12 wow fadeIn" data-wow-offset="50" data-wow-delay="1.3s">
    					<div class="team-wrapper">
    						<img src="images/invoice.jpg" class="img-responsive" style="height:200px;width:100%;">
    							<div class="team-des">
    								<h4>Total Balance Invoice</h4>
    								<p>
<?php
	$sql = "SELECT * FROM payment where customer_id='$_SESSION[customer_id]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_num_rows($qsql) . " pending invoices";
?>
									</p>
    							</div>
    					</div>
    				</div>
				
				
				
    			</div>
    		</div>
    	</section>
    	<!-- end team -->

<?php
session_start();
echo "Welcome, " . $_SESSION['customer_name'];
?>

<?php
include("footer.php");
?>