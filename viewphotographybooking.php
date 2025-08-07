<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
<?php
include("header.php");
if(isset($_GET['delid']))
{
	$sql = "DELETE FROM photography_booking WHERE photography_booking_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Photography Booking record deleted successfully..');</script>";
	}
}
?>
	

    	<!-- start contact -->
    	<section id="contact">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-12">
    					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s">View Photography Booking </h2>
    				</div>
    				<div class="col-md-12 col-sm-12 col-xs-12 wow fadeInLeft" data-wow-offset="50" data-wow-delay="0.9s">					
<?php					
	$sql = "SELECT *, photography_booking.address as booking_address, photography_booking.pincode as booking_pin, location.locationname as booking_locationname FROM photography_booking LEFT JOIN employee ON photography_booking.employee_id=employee.employee_id LEFT JOIN customer ON photography_booking.customer_id=customer.customer_id LEFT JOIN eventtype ON eventtype.eventtype_id =photography_booking.eventtypeid LEFT JOIN location ON location.locationid = photography_booking.city  WHERE photography_booking.photography_booking_id!='0' AND photography_booking.status='Active' ";
	if(isset($_SESSION['customer_id']))
	{
	$sql  = $sql . " and photography_booking.customer_id='$_SESSION[customer_id]'"; 
	}
	$sql = $sql . " ORDER BY photography_booking.photography_booking_id DESC";	
//echo $sql;
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
			$sqlpaid_amt ="SELECT sum(paid_amt) FROM payment WHERE photographybookingid='$rs[photography_booking_id]'";
			$qsqlpaid_amt = mysqli_query($con,$sqlpaid_amt);
			$rspaid_amt = mysqli_fetch_array($qsqlpaid_amt);
			$paidamt = $rspaid_amt[0];
							 
			$date1 = date_create($rs['bookingfdate']);
			$date2 = date_create($rs['bookingtdate']);
			$diff = date_diff($date1,$date2);
			$nodays =  $diff->format("%a")+1;
			$totalamt = $nodays * $rs["bookingcost"];
			$balamt = $totalamt - $rspaid_amt[0];
?>
	<table class="table table-striped table-bordered" cellspacing="0" width="100%"> 
		<thead>
			<tr>
				<th>Bill No.</th>
				<th>Customer</th>
				<th>Photographer</th>
				<th>Event Location</th>
				<th>Event Date</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php
			echo "<tr style='color: black;'>
				<td>$rs[0]</td>
				<td>$rs[customer_name]</td>  
				<td>$rs[employeename]</td>
				<td>$rs[booking_address],<br>$rs[booking_pin],$rs[booking_locationname]</td>
				<td>". date("d-M-Y",strtotime($rs['bookingfdate'])) ." - ". date("d-M-Y",strtotime($rs['bookingtdate'])) ."<br><b>Event Time:</b> ". date("h:i A",strtotime($rs['bookingtime'])) ."</td>
				<td>
				<b><a href='viewpaymentphotographybooking.php?photography_bookingid=$rs[0]'>View Report</a></b>";
			if($balamt != 0)
			{
			echo "<br><b><a href='balancepayment.php?photographerbookingid=$rs[0]'>Make payment</a></b>";
			}
			echo "</td></tr>";
			echo "<tr>
				<td colspan='2'><b>Total Amount : </b> Rs. $totalamt</td>
				<td colspan='2'><b>Paid Amount : </b> Rs. $paidamt</td>";
				if($balamt != 0)
				{
					echo "<td colspan='2'><b>Balance Amount : </b>Rs. $balamt</td>";
				}
			echo "</tr>";
			if($rs['customernote'] != "")
			{
			?>
			<tr>
				<th colspan="1">Customer Note</th>
				<td colspan="5"><?php echo $rs['customernote']; ?></td>
			</tr>	
			<?php
			}
			if($rs['sdenote'] != "")
			{
			?>
			<tr>
				<th colspan="1">SDE Note</th>
				<td colspan="5"><?php echo $rs['sdenote']; ?></td>
			</tr>	
			<?php
			}
			?>
		</tbody>
	</table>
<?php
		}
?>
				</div>
    			</div>
    		</div>
    	</section>
    	<!-- end contact -->
<?php
include("footer.php");
?>
</body>
</html>
<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
<script type="text/javascript" language="javascript" class="init">
function confirmtodel()
{
	if(confirm("Are you sure want to delete this record?") == true)
	{
		return true;	
	}
	else
	{
		return false;
	}
}

$(document).ready(function() {
	$('#datatable').DataTable();
} );
</script>