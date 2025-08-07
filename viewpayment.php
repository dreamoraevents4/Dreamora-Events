<?php
include("header.php");
if(isset($_GET['delid']))
{
	$sql = "DELETE FROM payment WHERE paymentid='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Payment record deleted successfully..');</script>";
	}
}
?>
<style>
		label{
		color: black;
	}
	.pagination>.active>a{
	z-index: 2;
    color: white;
    cursor: default;
    background-color: hotpink;
    border-color: pink;
	}
	.pagination>.active>a:hover{
	z-index: 2;
    color: white;
    cursor: default;
    background-color: hotpink;
    border-color: pink;	
	}
	.pagination>li>a{
	position: relative;
    float: left;
    padding: 6px 12px;
    margin-left: -1px;
    line-height: 1.42857143;
    color: black;
    text-decoration: none;
    background-color: #fff;
    border: 1px solid pink;
	}
	
</style>
    	<!-- start contact -->
    	<section id="contact">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-12">
    					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s">View Payment</h2>
    				</div>
    				<div class="col-md-12 col-sm-12 col-xs-12 wow fadeInLeft" data-wow-offset="50" data-wow-delay="0.9s">
					
	<table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%"> 
		<thead>
			<tr>
				<th>Bill No.</th>
				<th>Payment Date</th>
				<th>Transaction Type</th>
				<th>Paid Amount</th>
				<th>Note</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$sql = "SELECT *,payment.status as payment_status FROM payment LEFT JOIN photography_booking ON payment.photographybookingid=photography_booking.photography_booking_id LEFT JOIN event_booking ON payment.eventbookingid=event_booking.event_booking_id LEFT JOIN editography_order ON payment.editographyorderid=editography_order.editographyorder_id";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
			echo "<tr style='color: black'>
				<td>$rs[0]</td>
				<td>" . date("d-m-Y",strtotime($rs['paymentdate'])) . "</td>
				<td>$rs[transactiontype]</td>
				<td>$rs[paid_amt]</td>
				<td>$rs[note]</td>
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