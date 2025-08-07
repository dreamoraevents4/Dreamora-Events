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
</style>
    	<!-- start contact -->
    	<section id="contact">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-12">
    					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s">View editography Payment</h2>
    				</div>
    				<div class="col-md-12 col-sm-12 col-xs-12 wow fadeInLeft" data-wow-offset="50" data-wow-delay="0.9s">
					
<table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%"> 
		<thead>
			<tr>
				<th>Bill No.</th>
				<th>Date</th>
				<th>Customer</th>
				<th>Total Amount</th>
				<th>Paid Amount</th>
				<th>Balance Amount</th>
				<th>Transaction Type</th>
				<th>Note</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php
		
		$sql = "SELECT * FROM payment LEFT JOIN customer ON payment.customer_id=customer.customer_id WHERE payment.status='Active' AND payment.editographyorderid!='0' GROUP BY payment.editographyorderid  ORDER BY payment.editographyorderid DESC";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		while($rs = mysqli_fetch_array($qsql))
		{
			$sqleditography ="SELECT SUM(cost * qty) FROM editography_order WHERE billno='$rs[editographyorderid]'";
			$qsqleditography  = mysqli_query($con,$sqleditography);
			$rseditography = mysqli_fetch_array($qsqleditography);
			
			$sqlpayment ="SELECT SUM(paid_amt) FROM payment WHERE editographyorderid='$rs[editographyorderid]'";
			$qsqlpayment  = mysqli_query($con,$sqlpayment);
			$rspayment = mysqli_fetch_array($qsqlpayment);
			$balanceamt = $rseditography[0] -  $rspayment[0];
			
			$sqleditography_order = "SELECT * FROM editography_order WHERE status='Active' AND billno='$rs[editographyorderid]'";
			$qsqleditography_order  = mysqli_query($con,$sqleditography_order);
			$rseditography_order  = mysqli_fetch_array($qsqleditography_order);
			
			echo "<tr style='color: black;'>
				<td>$rs[editographyorderid]</td>
				<td>
				<b>Payment date:</b><br>" . date("d-m-Y",strtotime($rs['paymentdate']))  . "<br>
				<b>Request date:</b><br>" . date("d-m-Y",strtotime($rseditography_order['reqdate']))  . "
				</td>
				<td>$rs[customer_name],<br>$rs[address],<br><b>Ph No.</b> $rs[contactno]</td>
				<td>Rs. $rseditography[0]</td>
				<td>Rs. $rspayment[0]</td>
				<td>Rs. ". $balanceamt  ."</td>
				<td>$rs[transactiontype]</td>
				<td>$rs[note]</td>
				<td><a href='editographydetailedreport.php?billno=$rs[editographyorderid]' class='btn btn-warning' ><b>View Report</b></a>";
			if($balanceamt > 0)
			{
				echo " <br><a href='editographyfullpayment.php?billno=$rs[editographyorderid]' class='btn btn-info' ><b style='color: white;'>Pay full amount</b></a>";
			}
			else
			{
				$sqldeliver = "SELECT * FROM  editography_order WHERE billno='$rs[editographyorderid]' and deliverydate='0000-00-00'";
				$qsqldeliver = mysqli_query($con,$sqldeliver);
				if(mysqli_num_rows($qsqldeliver) >0)
				{					
				echo " <br><a href='editographydeliver.php?billno=$rs[editographyorderid]' class='btn btn-success'><b >Deliver</b></a>";
				}
				else
				{
					echo " <br><a href='editographydeliver.php?billno=$rs[editographyorderid]'><b style='color:green;'>Delivered</b></a>";
				}
				
			}
			echo "</td></tr>";
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