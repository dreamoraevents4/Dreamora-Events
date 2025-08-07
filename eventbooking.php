<?php
include("header.php");
if(isset($_POST['submit']))
{
	if(isset($_GET['editid']))
	{
		$sql ="UPDATE event_booking set eventpackageid='$_POST[eventpackageid]',customerid='$_POST[customerid]',eventlocationaddr='$_POST[eventlocationaddr]',city='$_POST[city]',pincode='$_POST[pincode]',customernote='$_POST[customernote]',sdenote='$_POST[sdenote]',bookingfdate='$_POST[bookingfdate]',bookingtdate='$_POST[bookingtdate]',time='$_POST[time]',booking_cost='$_POST[booking_cost]',status='$_POST[status]' WHERE event_booking_id='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Event Booking record updated successfully..')</script>";
		}
	}
	else
	{
		$sql = "INSERT INTO event_booking(eventpackageid,customer_id,locationid,eventlocationaddr,city,pincode,customernote,empnote,bookingfdate,bookingtdate,time,booking_cost,status) 
		VALUES('$_POST[event_package_id]','$_SESSION[customer_id]','$_POST[locationid]','$_POST[eventlocationaddress]','$_POST[city]','$_POST[pincode]','$_POST[customernote]','$_POST[sdenote]','$_POST[bookingfdate]','$_POST[bookingtdate]','$_POST[time]','$_POST[costperday]','Pending')";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			$insid=  mysqli_insert_id($con);
			//echo "<script>alert('Booking record inserted successfully..')</script>";
			echo "<script>window.location='payment.php?bookingid=$insid';</script>";
		}
	}

}
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM event_booking WHERE event_booking_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	echo mysqli_error($con);
	$rsedit = mysqli_fetch_array($qsqledit);
}


	$sqllocation= "SELECT * FROM location WHERE locationid='$_GET[locationid]'";
	$qsqllocation = mysqli_query($con,$sqllocation);
	$rslocation= mysqli_fetch_array($qsqllocation);

	$sqlevent_package= "SELECT * FROM event_package LEFT JOIN eventtype ON event_package.eventtype_id = eventtype.eventtype_id WHERE eventpackage_id='$_GET[event_package_id]'";
	$qsqlevent_package = mysqli_query($con,$sqlevent_package);
	echo mysqli_error($con);
	$rsevent_package= mysqli_fetch_array($qsqlevent_package);
?>    	 	
<!-- start contact -->
    	<section id="contact">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-12">
    					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s"> <span>Event Booking</span></h2>
						<p >Kindly enter the Event Booking information...</p>
    				</div>
					
<form action="" method="post" name="frm" onsubmit="return validateform()">
    				<div class="col-md-12 col-sm-12 col-xs-12 wow fadeInRight" data-wow-offset="50" data-wow-delay="0.6s">
	<input type="hidden" name="locationid" value="<?php echo $_GET['locationid']; ?>" readonly >
	<input type="hidden" name="event_package_id" value="<?php echo $_GET['event_package_id']; ?>" readonly >
				
				<div class="form-left col-md-6 ">
					<label>Event type<span id="ideventtype"  style='color:red'></span></label>
					<input type="text" name="eventtype" placeholder="eventtype" value="<?php echo $rsevent_package['eventtype']; ?>" readonly style="background-color:white; color:black" class="form-control" >
						
				</div>
				<div class="col-md-6 form-left" >
					<label>Event Package<span id="ideventpackage"  style='color:red'></span></label>
					<input type="text" name="eventpackage" placeholder="event package" value="<?php echo $rsevent_package['packagetitle']; ?>" readonly  style="background-color:white; color:black"  class="form-control">
				</div>
					
				<div class="col-md-12 form-left">
				<label>Enter Address<span id="ideventlocationaddress"  style='color:red'></span> <span id="identeraddress" style='color:red'></span></label>
				<textarea name="eventlocationaddress" placeholder="address" class="form-control" ><?php echo $rsedit['eventlocationaddr']; ?></textarea>
				</div>
					
					<div class="col-md-6 form-left" >
						<label>City or Location<span id="idcity"  style='color:red'></span></label>
						<input type="text" name="city" placeholder="City" value="<?php echo $rslocation['locationname']; ?>"  class="form-control" readonly style="background-color:white; color:black">
					</div>

					<div class="col-md-6 form-left" >
						<label>PIN Code<span id="idpincode"  style='color:red'></span></label>
						<input type="text" name="pincode" placeholder="pincode" value="<?php echo $rsedit['pincode']; ?>"  class="form-control" >
					</div>					
					

					<div class="col-md-6 form-left" >
						<label>Booking From:<span id="idbookingfdate"  style='color:red'></span><span id="idbookingfrom"style='color:red'></label>
						<input type="date" name="bookingfdate" id='bookingfdate' placeholder="From date" value="<?php echo $rsedit['bookingfdate']; ?>" min="<?php echo $dt; ?>" onchange='calculatedays(bookingfdate.value,bookingtdate.value)'  class="form-control">
					</div>
					
					<div class="col-md-6 form-left" >
						<label>Booking To:<span id="idbookingtdate"style='color:red'></label>
						<input type="date" name="bookingtdate" id='bookingtdate' placeholder="To date" value="<?php echo $rsedit['bookingtdate']; ?>"  onchange='calculatedays(bookingfdate.value,bookingtdate.value)'  class="form-control">
					</div>
					
					
					<div class="col-md-6 form-left" >
						<label>Time <span id="idtime" style='color:red'></label>
						<input type="time" name="time" placeholder="Time" class="form-control" value="<?php echo $rsedit['time']; ?>">
					</div>
					
					<div class="col-md-6 form-left" >
						<label>No. of days:<span id="idnodays"  style='color:red'></span></label>
						<input type="text" id="nodays" name="nodays" class="form-control" value="0" readonly  style="background-color:white; color:black"   class="form-control">
					</div>
					
					<div class="col-md-6 form-left" >
						<label>Booking cost:<span id="ideventcost"  style='color:red'></span> </label>
						<input type="text" name="eventcost" id="eventcost" class="form-control"  value="<?php echo "₹". $rsevent_package['eventcost'] . " per day"; ?>" readonly  style="background-color:white; color:black"  class="form-control">
						
						<input type="hidden" name="costperday" id="costperday" value="<?php echo $rsevent_package['eventcost']; ?>"  >
					</div>
					
					<div class="col-md-6 form-left" >
						<label>Total Cost<span id="idtotalcost"  style='color:red'></span></label>
						<input type="text" class="form-control" name="totalcost" id="totalcost" value="<?php echo $rsevent_package['eventcost']; ?>" readonly style="background-color:white; color:black"  class="form-control">
					</div>
					
					<div class="col-md-12 form-left ">
						<label>Enter any notes here..<span id="idcustomernote"  style='color:red'></span></label>
						<textarea name="customernote" placeholder="Customer Note" class="form-control"><?php echo $rsedit['customernote']; ?></textarea>
					</div>
					<!--
					<div class="form-left ">
						<label>SDE Note</label>
						<textarea name="sdenote" placeholder="SDE Note"><?php echo $rsedit['sdenote']; ?></textarea>
					</div>
					-->
					<div class="clearfix"> </div>
					<input type="submit" name="submit" value="Confirm Booking"  class="form-control">
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
function calculatedays(fdate,tdate) 
{
    if (fdate == "") 
	{
        document.getElementById("nodays").value = "0";
        return;
    } 
	else if (tdate == "") 
	{
        document.getElementById("nodays").value = "0";
        return;
    }
	else 
	{ 
        if (window.XMLHttpRequest) 
		{
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } 
		else 
		{
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("nodays").value = this.responseText; 
				document.getElementById("totalcost").value = parseFloat(document.getElementById("costperday").value) * parseFloat(this.responseText);
            }
        };
        xmlhttp.open("GET","ajaxcountdays.php?fdate="+fdate+"&tdate="+tdate,true);
        xmlhttp.send();
    }
}
</script>

<script>
function validateform()
{
	var numericExpression = /^[0-9]+$/;
	var alphaSpaceExp = /^[a-zA-Z\s]+$/;
	var alphaExp = /^[a-zA-Z]+$/;
	var alphaNumericExp = /^[0-9a-zA-Z]+$/;
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	
	var i=0;
	$("span").html("");
	if(document.frm.eventtype.value == "") 
	{
			document.getElementById("ideventtype").innerHTML ="Event type should not be empty..";
			var i=1;
	}
	if(document.frm.eventpackage.value == "")   
	{
			document.getElementById("ideventpackage").innerHTML ="Event type should not be empty..";
			var i=1;
	}	
	if(document.frm.eventlocationaddress.value == "")  
	{
			document.getElementById("ideventlocationaddress").innerHTML ="Event type should not be empty..";
			var i=1;
	}
	if(document.frm.city.value == "")  
	{
			document.getElementById("idcity").innerHTML ="Event type should not be empty..";
			var i=1;
	}
	if(document.frm.pincode.value.length != 6 )
	{
			document.getElementById("idpincode").innerHTML ="Mobile number should contain 10 digits..";
			var i=1;
	}
	if(document.frm.pincode.value == "")  
	{
			document.getElementById("idpincode").innerHTML ="Event type should not be empty..";
			var i=1;
	}
	if(document.frm.bookingfdate.value == "")  
	{
			document.getElementById("idbookingfdate").innerHTML ="Event type should not be empty..";
			var i=1;
	}
	if(document.frm.bookingtdate.value == "")  
	{
			document.getElementById("idbookingtdate").innerHTML ="Event type should not be empty..";
			var i=1;
	}
	if(document.frm.time.value == "")  
	{
			document.getElementById("idtime").innerHTML ="Event type should not be empty..";
			var i=1;
	}
	if(document.frm.nodays.value == "")  
	{
			document.getElementById("idnodays").innerHTML ="Event type should not be empty..";
			var i=1;
	}if(document.frm.eventcost.value == "")  
	{
			document.getElementById("ideventcost").innerHTML ="Event type should not be empty..";
			var i=1;
	}if(document.frm.totalcost.value == "")   
	{
			document.getElementById("idtotalcost").innerHTML ="Event type should not be empty..";
			var i=1;
	}if(document.frm.customernote.value == "")  
	{
			document.getElementById("idcustomernote").innerHTML ="Event type should not be empty..";
			var i=1;
	}
	if(i==1)
	{
		return false;
	}
	else
	{
		return true;
	}
}
</script>