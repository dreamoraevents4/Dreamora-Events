<?php
include("header.php");
$sqlpaymentdet = "SELECT * FROM payment WHERE editographyorderid='$_GET[billno]'";
$qsqlpaymentdet = mysqli_query($con,$sqlpaymentdet);
$rspaymentdet  = mysqli_fetch_array($qsqlpaymentdet);

$sqlpayment = "SELECT * FROM payment LEFT JOIN customer ON payment.customer_id=customer.customer_id LEFT JOIN editography_order ON editography_order.billno=payment.editographyorderid LEFT JOIN editography ON editography.editography_id=editography_order.editography_id WHERE payment.editographyorderid='$_GET[billno]'";
$qsqlpayment = mysqli_query($con,$sqlpayment);
$rspayment = mysqli_fetch_array($qsqlpayment);

$sqltotalamt = "SELECT SUM(editography_order.cost * editography_order.qty) FROM editography_order LEFT JOIN employee ON editography_order.employee_id=employee.employee_id LEFT JOIN customer ON editography_order.customer_id=customer.customer_id LEFT JOIN editography ON editography_order.editography_id=editography.editography_id WHERE editography_order.billno='$rspaymentdet[editographyorderid]'";
$qsqltotalamt = mysqli_query($con,$sqltotalamt);
$rstotalamt = mysqli_fetch_array($qsqltotalamt);

$sqlpaidamt = "select SUM(paid_amt) FROM payment WHERE editographyorderid='$rspaymentdet[editographyorderid]' ";
$qsqlpaidamt = mysqli_query($con,$sqlpaidamt);
$rspaidamt = mysqli_fetch_array($qsqlpaidamt);
?>
    	<!-- start contact -->
    	<section id="contact">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-12">
    					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s"><h4>Report of Bill No. <?php echo $_GET['billno']; ?></h4></h2>
    				</div>
    				<div class="col-md-12 col-sm-12 col-xs-12 wow fadeInLeft" data-wow-offset="50" data-wow-delay="0.9s">
					
<table id="datatable" class="table table-bordered" cellspacing="0" width="100%" >
<tr  style="background-color: white;">
<td colspan=4>
	<b>Customer Name:</b> <?php echo $rspayment['customer_name']; ?>
</td>
<td><b>Date :</b>  <?php echo date("d-m-Y",strtotime($rspayment['paymentdate'])); ?></td>
</tr>
<tr  style="background-color: white;" >
<td colspan=4 ><b>Address: </b> <?php echo $rspayment['address']; ?></td>
<td><b>Bill No :</b>  <?php echo $_GET['billno']; ?></td>
</tr>
<tr  style="background-color: white;" >
<td colspan=4><b>Contact No :</b> <?php echo $rspayment['contactno']; ?></td>
<td colspan=4><b>Total Amount :</b> Rs.
<?php echo $rstotalamt[0]; ?>
 </td>
</tr>
<tr  style="background-color: white;" >
<td colspan=4><b>Payment type : </b> <?php echo $rspayment['transactiontype']; ?></td>
<td><b>Paid amount :</b>  Rs. <?php echo $rspaidamt[0]; ?></td>
</tr>
<tr  style="background-color: white;" >
<td colspan=4><b>Request date: </b> <?php echo date("d-m-Y", strtotime($rspayment['reqdate'])); ?></td>
<td ><b>Balance Amount :</b> Rs. <?php echo $rstotalamt[0]- $rspaidamt[0]; ?></td>
</tr>
<tr  style="background-color: white;" >
<td colspan=4></td>
<td >
<?php
if($rspayment['deliverydate'] != "0000-00-00")
{
?>
<b>Delivery Date :</b> <?php 
echo date("d-m-Y", strtotime($rspayment['deliverydate'])); ?>
<?php
}
?>
</td>
</tr>
<tr  style="background-color: white;" >
<td colspan=5></td>
</tr>
<tr  style="background-color: white;" >
<th>SL.NO</th>
<th>Description</th>
<th>cost</th>
<th>qty</th>
<th>Sub Total</th>
</tr>
		<?php
		$slno=1;
		$sqleditography_order1 = "SELECT * FROM editography_order LEFT JOIN employee ON editography_order.employee_id=employee.employee_id LEFT JOIN customer ON editography_order.customer_id=customer.customer_id LEFT JOIN editography ON editography_order.editography_id=editography.editography_id WHERE editography_order.billno='$_GET[billno]' ";
		$qsqlditography_order1 = mysqli_query($con,$sqleditography_order1);
		$totalamt = 0;
		while($rsditography_order1 = mysqli_fetch_array($qsqlditography_order1))
		{
			echo "<tr  style='background-color: white;' >
				<td>$slno</td>
				<td><b>$rsditography_order1[editography_type]</b><br> $rsditography_order1[7]</td>
				<td>$rsditography_order1[5]</td>
				<td>$rsditography_order1[qty]</td>
				<td>".  $rsditography_order1['cost']*$rsditography_order1['qty'] ."</td>
			</tr>";
			$slno++;
			$totalamt = $totalamt + $rsditography_order1['cost']*$rsditography_order1['qty'];
		}
		?>	

<tr rowspan="6" style="background-color:grey;">
<th> </th>
<th></th>
<th></th>
<th><b>Total:</b></th>
<th>Rs. <?php echo $totalamt; ?></th>
</tr>
</table>

					</p>
					<hr>
					<p>
					<h2>Transaction  Report</h2>
	<table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%"> 
		<thead>
			<tr>
				<th>Payment Date</th>
				<th>Transaction Type</th>
				<th style="text-align: right;">Paid Amount</th>
				<th>Note</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$sql = "SELECT * FROM payment LEFT JOIN customer ON payment.customer_id=customer.customer_id WHERE payment.status='Active' AND payment.editographyorderid='$_GET[billno]' ORDER BY payment.editographyorderid DESC";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
			$sqleditography ="SELECT SUM(cost * qty) FROM editography_order WHERE billno='$rs[editographyorderid]'";
			$qsqleditography  = mysqli_query($con,$sqleditography);
			$rseditography = mysqli_fetch_array($qsqleditography);
			$sqlpayment ="SELECT SUM(paid_amt) FROM payment WHERE editographyorderid='$rs[editographyorderid]'";
			$qsqlpayment  = mysqli_query($con,$sqlpayment);
			$rspayment = mysqli_fetch_array($qsqlpayment);
			$balanceamt = $rseditography[0] -  $rspayment[0];
			echo "<tr  style='background-color: white;' >
				<td>" . date("d-m-Y",strtotime($rs['paymentdate'])) . "</td>
				<td>$rs[transactiontype]</td>
				<td  style='text-align: right;' >Rs. $rs[paid_amt]</td>
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