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
					
	<table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%"> 
		<thead>
			<tr>
				<th>Event Package</th>
				<th>Customer</th>
				<th>Event Location Address</th>
				<th>City</th>
				<th>Pincode</th>
				<th>Customer Note</th>
				<th>SDE Note</th>
				<th>Booking FDate</th>
				<th>Booking TDate</th>
				<th>Time</th>
				<th>Booking Cost</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$sql = "SELECT * FROM event_booking LEFT JOIN event_package ON event_package.eventpackageid = event_booking.eventpackageid LEFT JOIN customer ON event_booking.customer_id = customer.customer_id";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
			echo "<tr>
				<td>$rs[packagetitle]</td>
				<td>$rs[customer_name]</td>
				<td>$rs[eventlocationaddr]</td>
				<td>$rs[city]</td>
				<td>$rs[pincode]</td>
				<td>$rs[customernote]</td>
				<td>$rs[sdenote]</td>
				<td>$rs[bookingfdate]</td>
				<td>$rs[bookingtdate]</td>
				<td>$rs[time]</td>
				<td>$rs[booking_cost]</td>
				<td>$rs[status]</td>
				<td><a href='Eventbooking.php?editid=$rs[event_booking_id]'> Edit </a> | <a href='vieweventbooking.php?delid=$rs[event_booking_id]' onclick='return confirmdelete()'> Delete </a></td>
			</tr>";
		}
		?>			
		</tbody>
	</table>
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