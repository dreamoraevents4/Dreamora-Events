<?php
include("header.php");
if(isset($_POST['submit']))
{
	if($_GET['bookingid'] != "")
	{
		$sql ="UPDATE event_booking set status='Active' WHERE event_booking_id='$_GET[bookingid]'";
		$qsql = mysqli_query($con,$sql);
	}
	if($_GET['photographerbookingid'] != "")
	{
		$sql ="UPDATE photography_booking set status='Active' WHERE photography_booking_id='$_GET[photographerbookingid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
	}
		echo mysqli_error($con);
		$sql = "INSERT INTO payment(photographybookingid,eventbookingid,editographyorderid,transactiontype,customer_id,paid_amt,card_no,cvvno,expirydate,cardholder,paymentdate,note,status) VALUES('$_GET[photographerbookingid]','$_GET[bookingid]','$_POST[editographyorderid]','$_POST[paymenttype]','$_SESSION[customer_id]','$_POST[paid_amt]','$_POST[card_no]','$_POST[cvvno]','$_POST[expirydate]-01','$_POST[cardholder]','$dt','$_POST[note]','Active')";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Payment done successfully..')</script>";
			$insid = mysqli_insert_id($con);
			echo "<script>window.location='bill.php?paymentid=$insid';</script>";
		}
}
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM payment WHERE paymentid='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
if(isset($_GET['bookingid']))
{
	$sqlevent_booking = "SELECT * FROM event_booking WHERE event_booking_id='$_GET[bookingid]'";
	$qsqlevent_booking = mysqli_query($con,$sqlevent_booking);
	$rsevent_booking = mysqli_fetch_array($qsqlevent_booking);
	
	$bookingfdate = date_create($rsevent_booking['bookingfdate']);
	$bookingtdate = date_create($rsevent_booking['bookingtdate']);

	//difference between two dates
	$diff = date_diff($bookingfdate,$bookingtdate);

	//count days
	$nodays = $diff->format("%a")+1;

	//Total cost
	$totalcost = $rsevent_booking['booking_cost'] * $nodays;
}
if(isset($_GET['photographerbookingid']))
{
    $sqlphotography_booking="SELECT * FROM photography_booking WHERE photography_booking_id='$_GET[photographerbookingid]'";
	$qsqlphotography_booking = mysqli_query($con,$sqlphotography_booking);
	$rsphotography_booking = mysqli_fetch_array($qsqlphotography_booking);
	
	$bookingfdate=date_create($rsphotography_booking['bookingfdate']);
	$bookingtdate=date_create($rsphotography_booking['bookingtdate']);
	
	//difference between two dates
	$diff = date_diff($bookingfdate,$bookingtdate);

	//count days
	$nodays = $diff->format("%a")+1;

	//Total cost
	$totalcost = $rsphotography_booking['bookingcost'] * $nodays;
}	
?>    	 	
<!-- start contact -->
    	<section id="contact">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-12">
    					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s"> <span>Payment Portal</span></h2>
						<p>Booking done successfully...<br>Kindly enter the Payment information...</p>
    				</div>
    				<div class="col-md-12 col-sm-12 col-xs-12 wow fadeInLeft" data-wow-offset="50" data-wow-delay="0.9s">
<form action="" method="post">				
					<div class="form-left col-md-12" >
						<hr>
					</div>
					<div class="form-left col-md-6" >
						<label>Total amount</label>
						<input type="text" name="totalamt" id="totalamt" placeholder="paid_amt" value="<?php echo $totalcost; ?>"  readonly style="background-color:white; color:black" class="form-control" >
					</div>
					<div class="form-left col-md-6" >
						<label>Minimum payable amount (40%)</label>
						<input type="text" name="minimum_amt" id="minimum_amt" placeholder="paid_amt" value="<?php echo $totalcost*40/100; ?>" readonly style="background-color:white; color:black" class="form-control" >
					</div>
					<div class="form-left col-md-6" >
						<label>Payable amount</label>
						<input type="text" name="paid_amt" id="paid_amt" placeholder="Payable amount" onkeyup="calculateamt(totalamt.value,minimum_amt.value,paid_amt.value)" class="form-control" >
					</div>
					<div class="form-left col-md-6" >
						<label>Balance amount</label>
						<input type="text" name="bal_amt" id="bal_amt" value="<?php echo $totalcost; ?>"  readonly style="background-color:white; color:black" class="form-control" >
					</div>
					<div class="form-left col-md-12" >
						<hr>
					</div>
					

					<div class="form-left col-md-12">
						<label>payment Type</label>
						<select name="paymenttype" id="paymenttype" onchange="funpaymenttype(this.value)" class="form-control" >
						<option value='' style='color:red'>Select payment type</option>
						<?php
						$arr = array("VISA","Debit Card","Master card","Cash payment");
						foreach($arr as $value)
						{
								echo "<option value='$value' style='color:red'>$value</option>";
						}
						?>
						</select>
					</div>
					
					<div id="divpaymenttype">
							<div class="form-left col-md-12" >
								<hr>
							</div>
							<div class="form-left col-md-6" >
								<input type="hidden" name="cardholder" placeholder="cardholder" >
							</div>
							<div class="form-left col-md-6" >
								<input type="hidden" name="card_no" placeholder="card_no" >
							</div>
							<div class="form-left col-md-6" >
								<input type="hidden" name="cvvno" placeholder="cvvno" >
							</div>
							<div class="form-left col-md-6" >
								<input type="hidden" name="expirydate" placeholder="expirydate" >
							</div>
					</div>
					
					<div class="form-left col-md-12" >
						<hr>
					</div>
				<div class="form-left col-md-12">
						<label>Any notes</label>
						<textarea name="note" placeholder="note" class="form-control" ><?php echo $rsedit['note']; ?></textarea>
					</div>
					<div class="clearfix"> </div>
					<input type="submit" name="submit" value="Make payment" class="form-control" >
				</form>
    				</div>

    			</div>
    		</div>
    	</section>
    	<!-- end contact -->
<?php
include("footer.php");
?>
<script>
function calculateamt(totalamt,minimum_amt,paid_amt)
{
	document.getElementById("bal_amt").value = parseFloat(totalamt) - parseFloat(paid_amt);
}
function funpaymenttype(paytype)
{
	if(paytype == "VISA" || paytype=="Debit Card" || paytype == "Master card")
	{
		document.getElementById("divpaymenttype").innerHTML = '<div class="form-left col-md-12" ><hr></div><div class="form-left col-md-6" ><label>Card Holder</label><input type="text" name="cardholder" placeholder="cardholder" class="form-control"  ></div><div class="form-left col-md-6" ><label>Card No</label><input type="text" name="card_no" placeholder="card_no" class="form-control" ></div><div class="form-left col-md-6" ><label>CVV No</label><input type="text" name="cvvno" placeholder="cvvno" class="form-control" ></div><div class="form-left col-md-6" ><label>Expiry Date</label><input type="month" name="expirydate" placeholder="expirydate" class="form-control" ></div>';
	}
	if(paytype == "Cash payment")
	{
		document.getElementById("divpaymenttype").innerHTML  = '<div class="form-left col-md-12" ><hr><input type="hidden" name="cardholder" placeholder="cardholder" ><input type="hidden" name="card_no" placeholder="card_no" ><input type="hidden" name="cvvno" placeholder="cvvno" ><input type="hidden" name="expirydate" placeholder="expirydate" ><label>Offline payment - Payment will be done in the Event Planner office..</label></div>';
	}
}
</script>