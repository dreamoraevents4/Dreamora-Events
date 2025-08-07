<?php
include("header.php");
if(isset($_GET['deleveryid']))
{
	 $sqldeleveryid = "UPDATE editography_order set deliverydate='$dt' WHERE editographyorderid='$_GET[deleveryid]'";
	$qsqldeleveryid= mysqli_query($con,$sqldeleveryid);
	echo mysqli_error($con);
}
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
    					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s">Report of Bill No. <?php echo $_GET['billno']; ?></h2>
    				</div>
    				<div class="col-md-12 col-sm-12 col-xs-12 wow fadeInLeft" data-wow-offset="50" data-wow-delay="0.9s">
					
	<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
<tr>
<td colspan=4>
	<b>Customer Name:</b> <?php echo $rspayment['customer_name']; ?>
</td>
<td><b>Date :</b>  <?php echo date("d-M-Y",strtotime($rspayment['paymentdate'])); ?></td>
</tr>
<tr >
<td colspan=4 ><b>Address: </b></td>
<td><b>Bill No :</b>  <?php echo $_GET['billno']; ?></td>
</tr>
<tr>
<td colspan=4><?php echo $rspayment[18]; ?></td>
<td colspan=4><b>Total Amount :</b> Rs.
<?php echo $rstotalamt[0]; ?>
 </td>
</tr>
<tr>
<td colspan=4><b>Contact No :</b> <?php echo $rspayment[19]; ?></td>
<td><b>Paid amount :</b>  Rs. <?php echo $rspaidamt[0]; ?></td>
</tr>
<tr>
<td colspan=4><b>Payment type : </b> <?php echo $rspayment['transactiontype']; ?></td>
<td ><b>Balance Amount :</b> Rs. <?php echo $rstotalamt[0]- $rspaidamt[0]; ?></td>
</tr>
<tr>
<td colspan=4><b>Request date: </b> <?php echo $rspayment['reqdate']; ?></td>
<td >
<?php
if($rspayment['deliverydate'] != "0000-00-00")
{
?>
<b>Delivery Date :</b> <?php 
echo $rspayment['deliverydate']; ?>
<?php
}
?>
</td>
</tr>
<tr>
<td colspan=3></td>
</tr>
<tr>
<th>SL.NO</th>
<th>Description</th>
<th>cost</th>
<th>qty</th>
<th>Sub Total</th>
<th>Delivery date</th>
<th>Deliver</th>
</tr>

		<?php
		$slno=1;
		$sqleditography_order1 = "SELECT * FROM editography_order LEFT JOIN employee ON editography_order.employee_id=employee.employee_id LEFT JOIN customer ON editography_order.customer_id=customer.customer_id LEFT JOIN editography ON editography_order.editography_id=editography.editography_id WHERE editography_order.billno='$_GET[billno]' ";
		$qsqlditography_order1 = mysqli_query($con,$sqleditography_order1);
		$totalamt = 0;
		while($rsditography_order1 = mysqli_fetch_array($qsqlditography_order1))
		{
			echo "<tr>
				<td>$slno</td>
				<td><b>$rsditography_order1[editography_type]</b><br> $rsditography_order1[7]</td>
				<td>$rsditography_order1[5]</td>
				<td>$rsditography_order1[qty]</td>
				<td>".  $rsditography_order1['cost']*$rsditography_order1['qty'] ."</td>
				<td>";
				if($rsditography_order1['deliverydate'] != "0000-00-00" )
				{
					echo date("d-M-Y",strtotime($rsditography_order1['deliverydate']));
				}				
				echo "</td>
				<td>";
				
				if($rsditography_order1['deliverydate'] != "0000-00-00" )
				{
					echo "<b style='color:green;'>Delivered</a></b>";
				}
				else
				{
					echo "<a href='editographydeliver.php?deleveryid=$rsditography_order1[0]&billno=$_GET[billno]'><b style='color:red;'>Deliver item</a></b>";
				}
				
				
				echo " </td></tr>";
			$slno++;
			$totalamt = $totalamt + $rsditography_order1['cost']*$rsditography_order1['qty'];
		}
		?>	

</table>
<br><br>
<h5><a href="vieweditographypayment.php"  >Back..</a></h5>

				</div>
    			</div>
    		</div>
    	</section>
    	<!-- end contact -->
<?php
include("footer.php");
?>
<script>
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
</script>

<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
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