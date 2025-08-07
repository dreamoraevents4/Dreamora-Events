<?php
include("header.php");

$sqlpaymentdet = "SELECT * FROM payment WHERE paymentid='$_GET[paymentid]'";
$qsqlpaymentdet = mysqli_query($con,$sqlpaymentdet);
echo mysqli_error($con);
$rspaymentdet  = mysqli_fetch_array($qsqlpaymentdet);

if($rspaymentdet['eventbookingid'] != "0")
{
	$sqlpayment = "SELECT * FROM payment LEFT JOIN customer ON payment.customer_id=customer.customer_id LEFT JOIN event_booking ON event_booking.event_booking_id = payment.eventbookingid LEFT JOIN event_package ON event_package.eventpackage_id = event_booking.eventpackageid LEFT JOIN eventtype ON eventtype.eventtype_id =event_package.eventtype_id LEFT JOIN location ON location.locationid = event_booking.locationid WHERE payment.paymentid='$_GET[paymentid]'";
	$qsqlpayment = mysqli_query($con,$sqlpayment);
	echo mysqli_error($con);
	$rspayment = mysqli_fetch_array($qsqlpayment);
	$billno= $rspayment[2];
	
	$sqlpaid_amt ="SELECT sum(paid_amt) FROM payment WHERE eventbookingid='$rspaymentdet[eventbookingid]'";
	$qsqlpaid_amt = mysqli_query($con,$sqlpaid_amt);
	echo mysqli_error($con);
	$rspaid_amt = mysqli_fetch_array($qsqlpaid_amt);
	$paidamt = $rspaid_amt[0];
}

if($rspaymentdet['photographybookingid'] != "0")
{
	$sqlpayment = "SELECT *, photography_booking.address as booking_address, photography_booking.pincode as booking_pin, location.locationname as booking_locationname FROM payment LEFT JOIN customer ON payment.customer_id=customer.customer_id LEFT JOIN photography_booking ON photography_booking.photography_booking_id = payment.photographybookingid LEFT JOIN employee ON employee.employee_id = photography_booking.employee_id LEFT JOIN eventtype ON eventtype.eventtype_id =photography_booking.eventtypeid LEFT JOIN location ON location.locationid = photography_booking.city WHERE payment.paymentid='$_GET[paymentid]'";
	$qsqlpayment = mysqli_query($con,$sqlpayment);
	echo mysqli_error($con);
	$rspayment = mysqli_fetch_array($qsqlpayment);
	$billno= $rspayment[1];
	
	$sqlpaid_amt ="SELECT sum(paid_amt) FROM payment WHERE photographybookingid='$rspaymentdet[photographybookingid]'";
	$qsqlpaid_amt = mysqli_query($con,$sqlpaid_amt);
	echo mysqli_error($con);
	$rspaid_amt = mysqli_fetch_array($qsqlpaid_amt);
	$paidamt = $rspaid_amt[0];
}
?>
<!-- about-top -->
<div class="about" id="about">
	<!-- container -->
	<div class="container">
		<div class="about-info">
			<center>
				<h3>Payment Receipt</h3>
			</center>
		</div>
		<div class="about-top-grids">
			<div class="col-md-12 about-top-grid">

				<p>
				<div id="divprint">
					<table id="datatable" class="table table-bordered" cellspacing="0" width="100%"
						style="background-color:white;">
						<tr>
							<th colspan=3 style="color:black;">
								<center>
									<h2>Event Planner</h2>
								</center>
							</th>
						</tr>
						<tr style="color:black;">
							<td colspan=3>
								<center>Mangalore</center>
							</td>
						</tr>
						<tr style="color:black;">
							<td colspan=2>
								<b>Customer Name:</b>
								<?php echo $rspayment['customer_name']; ?>
							</td>
							<td><b>Date :</b>
								<?php echo date("d-M-Y",strtotime($rspayment['paymentdate'])); ?>
							</td>
						</tr>
						<tr style="color:black;">
							<td colspan=2><b>Address: </b>
								<?php echo $rspayment['booking_address']; ?>,
								<?php echo $rspayment['booking_locationname']; ?>, PIN -
								<?php echo $rspayment['booking_pin']; ?>
							</td>
							<td><b>Bill No :</b>
								<?php echo $billno; ?>
							</td>
						</tr>
						<tr style="color:black;">
							<td colspan=2><b>Contact No :</b>
								<?php echo $rspayment['contactno']; ?>
							</td>
							<td colspan=1><b>Total Amount :</b> ₹
								<?php
//echo "test".$rspaymentdet[eventbookingid]."test";
if($rspaymentdet['eventbookingid'] != "0")
{	
	$date1 = date_create($rspayment['bookingfdate']);
	$date2 = date_create($rspayment['bookingtdate']);
	$diff = date_diff($date1,$date2);
	$nodays =  $diff->format("%a")+1;
	echo $totalamt = $nodays * $rspayment['booking_cost'];
}
if($rspaymentdet['photographybookingid'] != "0")
{
		$date1 = date_create($rspayment['bookingfdate']);
		$date2 = date_create($rspayment['bookingtdate']);
		$diff = date_diff($date1,$date2);
		 $nodays =  $diff->format("%a")+1;
	echo $totalamt = $nodays * $rspayment['bookingcost']; 
}
if($rspaymentdet['editographyorderid'] != "0")
{
}
/*
if($rspaymentdet['photographybookingid'] != "0")
{
}
if($rspaymentdet['eventbookingid'] != "0")
{	
}
if($rspaymentdet['editographyorderid'] != "0")
{
}
*/
?>
							</td>
						</tr>
						<tr style="color:black;">
							<td colspan=2></td>
							<td><b>Paid amount :</b> ₹
								<?php echo $paidamt; ?>
							</td>
						</tr>
						<tr style="color:black;">
							<td colspan=2><b>Payment type : </b>
								<?php echo $rspayment['transactiontype']; ?>
							</td>
							<?php
if(($totalamt - $paidamt) != 0)
{
?>
							<td><b>Balance Amount :</b> ₹
								<?php echo $totalamt - $paidamt; ?>
							</td>
							<?php
}
?>
						</tr>
						<tr style="color:black;">
							<td colspan=3></td>
						</tr>
						<tr style="color:black;">
							<th>SL.NO</th>
							<th>Description</th>
							<th>Sub Total</th>
						</tr>
						<tr rowspan=3 style="color:black;">
							<td> 1 </td>
							<td>
								<?php
if($rspaymentdet['eventbookingid'] != "0")
{
?>
								<b>Event type :</b>
								<?php echo $rspayment['eventtype']; ?><br>
								<b>Package : </b>
								<?php echo $rspayment['packagetitle']; ?><br>
								<b>No. of days: </b>
								<?php echo $nodays; ?><br>
								<b>Cost/day: </b> ₹
								<?php echo $rspayment['booking_cost']; ?><br>
								<b>Booking date: </b>
								<?php echo date("d-M-Y",strtotime($rspayment['bookingfdate'])); ?> to
								<?php echo date("d-M-Y",strtotime($rspayment['bookingtdate'])); ?><br>
								<b>Event location:</b>
								<?php echo $rspayment[25]; ?>,
								<?php echo $rspayment[26]; ?>,
								<?php echo $rspayment['locationname']; ?>-
								<?php echo $rspayment[27]; ?>
								<?php
}
if($rspaymentdet['photographybookingid'] != "0")
{
?>
								<b>Event type :</b>
								<?php echo $rspayment['eventtype']; ?><br>
								<b>Photographer : </b>
								<?php echo $rspayment['employeename']; ?><br>
								<b>No. of days: </b>
								<?php echo $nodays; ?><br>
								<b>Booking date: </b>
								<?php echo date("d-M-Y",strtotime($rspayment['bookingfdate'])); ?> to
								<?php echo date("d-M-Y",strtotime($rspayment['bookingtdate'])); ?><br>
								<b>Booking location:</b>
								<?php echo $rspayment[23]; ?>,
								<?php echo $rspayment[27]; ?>,
								<?php echo $rspayment[28]; ?>
								<?php
}
if($rspaymentdet['editographyorderid'] != "0")
{

}
?>
							</td>
							<td>₹
								<?php echo $rspayment['paid_amt']; ?>
							</td>
						</tr>
						<tr rowspan=3 style="color:black;">
							<td> </td>
							<td><b>Total:</b></td>
							<td>₹
								<?php echo $rspayment['paid_amt']; ?>
							</td>
						</tr>
					</table>
				</div>

				<center><input type="button" name="btnprint" value="Print Receipt" onclick="PrintElem('divprint')"
						class="form-control"><br><br>
					<h5><a href="customeraccount.php">Back..</a></h5>
				</center>

				</p>
			</div>
			<div class="clearfix"> </div>
		</div>

	</div>
</div>
<!-- //about-top -->

<!-- Footer -->
<div class="footer w3ls">
	<div class="container">
		<?php
include("footer.php");
?>

		<script>
			function PrintElem(elem) {
				var mywindow = window.open('', 'PRINT', 'height=400,width=600');

				mywindow.document.write('<html><head><title>' + document.title + '</title>');
				mywindow.document.write('</head><body >');
				mywindow.document.write('<h1>' + document.title + '</h1>');
				mywindow.document.write(document.getElementById(elem).innerHTML);
				mywindow.document.write('</body></html>');

				mywindow.document.close(); // necessary for IE >= 10
				mywindow.focus(); // necessary for IE >= 10*/

				mywindow.print();
				mywindow.close();

				return true;
			}
		</script>