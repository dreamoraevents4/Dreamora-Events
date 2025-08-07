<?php
include("header.php");

$sqlpaymentdet = "SELECT * FROM payment WHERE paymentid='$_GET[billid]'";
$qsqlpaymentdet = mysqli_query($con,$sqlpaymentdet);
$rspaymentdet  = mysqli_fetch_array($qsqlpaymentdet);

$sqlpayment = "SELECT * FROM payment LEFT JOIN customer ON payment.customer_id=customer.customer_id LEFT JOIN editography_order ON editography_order.billno=payment.editographyorderid LEFT JOIN editography ON editography.editography_id=editography_order.editography_id WHERE payment.paymentid='$_GET[billid]'";
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
    					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s">Editography Receipt</h2>
    				</div>
    				<div class="col-md-12 col-sm-12 col-xs-12 wow fadeInLeft" data-wow-offset="50" data-wow-delay="0.9s">

		<!-- container -->
		<div class="container">
			<div class="about-info">
				<center><h3>Payment Receipt</h3></center>
			</div>
			<div class="about-top-grids">
				<div class="col-md-12 about-top-grid">

					<p>
					<div id="divprint">
<table id="datatable" class="table table-bordered" cellspacing="0" width="100%">
<tr>
<th colspan=6><center><h2>Event Planner</h2></center></th>
</tr>
<tr>
<td colspan=6><center>Trinity Complex,N.G Road,Attavara,Mangalore.</center></td>
</tr>
<tr>
<td colspan=4>
	<b>Customer Name:</b> <?php echo $rspayment['customer_name']; ?>
</td>
<td><b>Date :</b>  <?php echo date("d-m-Y",strtotime($rspayment['paymentdate'])); ?></td>
</tr>
<tr >
<td colspan=4 ><b>Address: </b> <?php echo $rspayment['address']; ?></td>
<td><b>Bill No :</b>  <?php echo $rspayment['editographyorderid']; ?></td>
</tr>
<tr>
<td colspan=4><b>Contact No :</b> <?php echo $rspayment['contactno']; ?></td>
<td colspan=4><b>Total Amount :</b> Rs.
<?php echo $rstotalamt[0]; ?>
 </td>
</tr>
<tr>
<td colspan=4><b>Payment type : </b> <?php echo $rspayment['transactiontype']; ?></td>
<td><b>Paid amount :</b>  Rs. <?php echo $rspaidamt[0]; ?></td>
</tr>
<tr>
<td colspan=4><b>Request date: </b> <?php echo date("d-m-Y",strtotime($rspayment['reqdate'])); ?></td>
<td ><b>Balance Amount :</b> Rs. <?php echo $rstotalamt[0]- $rspaidamt[0]; ?></td>
</tr>
<tr>
<td colspan=4></td>
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
<th>SL.NO</th>
<th>Description</th>
<th>cost</th>
<th>qty</th>
<th>Sub Total</th>
</tr>

		<?php
		$slno=1;
		$sqleditography_order1 = "SELECT * FROM editography_order LEFT JOIN employee ON editography_order.employee_id=employee.employee_id LEFT JOIN customer ON editography_order.customer_id=customer.customer_id LEFT JOIN editography ON editography_order.editography_id=editography.editography_id WHERE editography_order.billno='$rspaymentdet[editographyorderid]' ";
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
</div>

<center><input type="button" name="btnprint" value="Print Receipt" style="color: black;" onclick="PrintElem('divprint')" >
<br><br><h5><a href="vieweditographypayment.php"  >Back..</a></h5></center>
			         
					</p>
				</div>
				<div class="clearfix"> </div>
			</div>

	</div>
	
					
					</div>
    			</div>
    		</div>
    	</section>
    	<!-- end contact -->
<?php
include("footer.php");
?>

<script>
function PrintElem(elem)
{
    var mywindow = window.open('', 'PRINT', 'height=400,width=600');

    mywindow.document.write('<html><head><title>' + document.title  + '</title>');
    mywindow.document.write('</head><body >');
    mywindow.document.write('<h1>' + document.title  + '</h1>');
    mywindow.document.write(document.getElementById(elem).innerHTML);
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/

    mywindow.print();
    mywindow.close();

    return true;
}
</script>