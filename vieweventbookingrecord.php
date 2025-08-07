<?php
include("header.php");
if(isset($_GET['delid']))
{
	$sql = "DELETE FROM event_booking WHERE event_booking_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Event Booking record deleted successfully..');</script>";
	}
}
?>
	
    	<!-- start contact -->
    	<section id="contact">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-12">
    					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s">View Event Booking</h2>
    				</div>
    				<div class="col-md-12 col-sm-12 col-xs-12 wow fadeInLeft" data-wow-offset="50" data-wow-delay="0.9s">

		<?php
	$sql = "SELECT * FROM event_booking LEFT JOIN event_package ON event_package.eventpackage_id = event_booking.eventpackageid LEFT JOIN customer ON event_booking.customer_id = customer.customer_id WHERE event_booking.event_booking_id!='0' ";
	if(isset($_SESSION['customer_id']))
	{
	$sql  = $sql . " and event_booking.customer_id='$_SESSION[customer_id]'"; 
	}
	$sql  = $sql . " ORDER BY event_booking.event_booking_id DESC";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		while($rs = mysqli_fetch_array($qsql))
		{
			$sqlpayment ="SELECT sum(paid_amt) FROM payment WHERE eventbookingid='$rs[0]'";
			$qsqlpayment = mysqli_query($con,$sqlpayment);
			echo mysqli_error($con);
			$rspayment = mysqli_fetch_array($qsqlpayment);
			 $paidamt = $rspayment[0];
			 
			$date1 = date_create($rs['bookingfdate']);
			$date2 = date_create($rs['bookingtdate']);
			$diff = date_diff($date1,$date2);
			$nodays =  $diff->format("%a")+1;
			$totalamt = $nodays * $rs["booking_cost"];
	
			$balamt = $totalamt - $rspayment[0];
		
?>
	<table class="table table-bordered" cellspacing="0" width="100%"> 
		<thead>
			<tr>
				<th>Bill No.</th>
				<th>Event Package</th>
				<th>Customer</th>
				<th>Event Location</th>
				<th>Event Date</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php
			echo "<tr>
				<td>$rs[0]</td>
				<td>$rs[packagetitle]</td>
				<td>$rs[customer_name]</td>
				<td>$rs[eventlocationaddr],<br>$rs[city],$rs[pincode]</td>
				<td>". date("d-M-Y",strtotime($rs['bookingfdate'])) ." to ". date("d-M-Y",strtotime($rs['bookingtdate'])) ."<br><b>Event Time:</b> ". date("h:i A",strtotime($rs['time'])) ."</td>
				<td>
				<b><a href='viewpaymenteventbooking.php?event_booking_id=$rs[0]'>View Report</a></b>";
			if($balamt != 0)
			{
			echo "<br><b><a href='balancepayment.php?event_booking_id=$rs[0]'>Make payment</a></b>";
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
				<td colspan="5"><?php echo $rs['empnote']; ?></td>
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
<script type="text/javascript" language="javascript" class="init">
function confirmdelete()
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