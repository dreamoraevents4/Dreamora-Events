<?php
include("header.php");
if(isset($_POST['submit']))
{
	$sql = "INSERT INTO photography_booking(employee_id,customer_id,locationid,bookingcost,eventtypeid,address,city,pincode,bookingfdate,bookingtdate,bookingtime,status) 
	VALUES('$_GET[photographerid]','$_SESSION[customer_id]','$_POST[locationid]','$_POST[costperday]','$_POST[eventtypeid]','$_POST[address]','$_POST[locationid]','$_POST[pincode]','$_POST[bookingfdate]','$_POST[bookingtdate]','$_POST[bookingtime]','Pending')";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		$insid=  mysqli_insert_id($con);
		echo "<script>window.location='payment.php?photographerbookingid=$insid';</script>";
	}
}
$sqlemployee= "SELECT * FROM employee WHERE employee_id='$_GET[photographerid]'";
$qsqlemployee= mysqli_query($con,$sqlemployee);
$rsemployee = mysqli_fetch_array($qsqlemployee);

$sqllocation= "SELECT * FROM location WHERE locationid='$_GET[locationid]'";
$qsqllocation = mysqli_query($con,$sqllocation);
$rslocation= mysqli_fetch_array($qsqllocation);
?>    	 	
<!-- start contact -->
    	<section id="contact">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-12">
    					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s"> <span>PHOTOGRAPHER PROFILE</span></h2>
    				</div>
<?php
//include("sidebar.php");
?>
    				<div class="col-md-10 col-sm-12 col-xs-12 wow fadeInLeft" data-wow-offset="50" data-wow-delay="0.9s">
			<div class="about-top-grids">
				<div class="col-md-8 about-top-grid">
					<h4>About <?php echo $rsemployee['employeename']; ?></h4>
					<p><?php echo $rsemployee['empprofile'];?><br><hr>
			         <h2>Rs. <?php echo $rsemployee['photographycost'];?> / day</h2>
					</p>
				</div>
				<div class="col-md-4 about-top-grid " >
					<img src="imgemp/<?php echo $rsemployee['empimage']; ?>" height="300" alt="" />
				</div>
				<div class="clearfix"> </div>
			</div>
    				</div>

    			</div>
    		</div>
			
			<!--contact -->
	<div class="contact" id="contact">
		<div class="container">	
  <h3>Book this photographer</h3>		
			<div class="contact-form" >
			<p>Kindly enter the Photographer Booking information...</p>
	<form action="" method="post" name="frm" onsubmit="return validateform()">

			<input type="hidden" name="locationid" value="<?php echo $_GET['locationid']; ?>" readonly >

			<div class="col-md-6 form-left">
				<label>Photographer<span id="idphotographer"  style='color:red'></span></label>
				<input type="text" class="form-control" name="photographer" placeholder="photographer" value="<?php echo $rsemployee['employeename']; ?>" readonly style="background-color:white; color:black" >						
			</div>
				
			<div class="col-md-6 form-left" >
				<label>Event type<span id="ideventtype"  style='color:red'></span></label>
				<select name="eventtypeid" class="form-control" id="eventtypeid" style="height:50px;"  >
					<option value='' style='color: black;'>SELECT EVENT TYPE</option>
					<?php
						$sqleventtype = "SELECT * FROM eventtype where status='Active'";
						$qsqleventtype = mysqli_query($con,$sqleventtype);
						while($rseventtype = mysqli_fetch_array($qsqleventtype))
						{
							echo "<option value='$rseventtype[eventtype_id]' style='color: black;'>$rseventtype[eventtype]</option>";
						}
					?>
				</select>
			</div>
			
			<span id="idphotographer"  style='color:red'></span>
					
			<div class="col-md-12 form-left">
				<label>Enter Address<span id="idaddress"  style='color:red'></span></label>
				<textarea name="address" class="form-control" placeholder="Enter address" style="background-color:white;color:black;" ></textarea>
			</div>
					<div class="col-md-6 form-left" >
						<label>City or Location<span id="idcity"  style='color:red'></span></label>
						<input type="text" class="form-control" name="city" placeholder="City" style="background-color:white; color:black" readonly value="<?php echo $rslocation['locationname']; ?>">
					</div>
					
					<div class="col-md-6 form-left" >
						<label>PIN Code<span id="idpincode"  style='color:red'></span></label>
						<input type="text" class="form-control" name="pincode" placeholder="pincode" >
					</div>
					
					
					<div class="col-md-6 form-left" >
						<label>Booking From: <span id="idbookingfdate"  style='color:red'></span></label>
						<input type="date" class="form-control" name="bookingfdate" id='bookingfdate' placeholder="From date" value="<?php echo $rsedit['bookingfdate']; ?>" min="<?php echo date("Y-m-d"); ?>" onchange='changebookingtdate(this.value)'  onkeyup='changebookingtdate(this.value)' >
					</div>
					<div class="col-md-6 form-left" >
						<label>Booking To:<span id="idbookingtdate"  style='color:red'></span></label>
						<input type="date" class="form-control" name="bookingtdate" id='bookingtdate' placeholder="To date" max="<?php echo  date('Y-m-d', strtotime("+365 days")); ?>"  min="<?php echo date("Y-m-d"); ?>" onchange='calculatedays(bookingfdate.value,bookingtdate.value)' >						
					</div>
					
					
					<div class="col-md-6 form-left" >
						<label>Time<span id="idbookingtime"  style='color:red'></span></label>
						<input type="time" class="form-control" name="bookingtime" placeholder="bookingtime" class="form-control" value="<?php echo $rsedit['bookingtime']; ?>">
					</div>
					
					<div class="col-md-6 form-left" >
						<label>No. of days:<span id="idnodays"  style='color:red'></span></label>
						<input type="text" id="nodays" name="nodays" class="form-control" value="0" readonly  style="background-color:white; color:black"  >
					</div>
					
					<div class="col-md-6 form-left" >
						<label>Booking cost:<span id="idbookingcost"  style='color:red'></span> </label>
						<input type="text" class="form-control" name="bookingcost" id="bookingcost" class="form-control"  value="<?php echo "₹". $rsemployee['photographycost'] . " per day"; ?>" readonly  style="background-color:white; color:black" >
						
						<input type="hidden" name="costperday" id="costperday" value="<?php echo $rsemployee['photographycost']; ?>"  >
					</div>
					
					<div class="col-md-6 form-left" >
						<label>Total Cost<span id="idtotalcost"  style='color:red'></span></label>
						<input type="text" class="form-control" name="totalcost" id="totalcost" value="<?php echo $rsemployee['photographycost']; ?>" readonly style="background-color:white; color:black" >
					</div>
					
					<div class="col-md-12 form-left ">
						<label>Enter any notes here..</label>
						<textarea class="form-control" name="customernote" placeholder="Customer Note"><?php echo $rsedit['customernote']; ?></textarea>
					</div>
					<!--
					<div class="form-left ">
						<label>SDE Note</label>
						<textarea name="sdenote" placeholder="SDE Note"><?php echo $rsedit['sdenote']; ?></textarea>
					</div>
					-->
					<div class="clearfix"> </div>
					<input type="submit" class="form-control" name="submit" value="Confirm Booking" >
				</form>
			</div>
		</div>
	</div>		
	<!--//contact -->
			
			
    	</section>
    	<!-- end contact -->
<script>
function changebookingtdate(fdate)
{
	//change bookingtdate min date to fdate
	//var fdate = new Date(fdate);
    var bookingtdate = document.getElementById('bookingtdate');
    bookingtdate.min = fdate;
	/*
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
			document.getElementById("idsbookingtdate").innerHTML = this.responseText;
		}
	};
	xmlhttp.open("GET","ajaxchangetodate.php?fdate="+fdate,true);
	xmlhttp.send();
	*/
}

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
<?php
include("footer.php");
?>
<script>
function validateform()
{
	
	
	var i=0;
	$("span").html("");
	
	if(document.frm.photographer.value == "")
	{
			document.getElementById("idphotographer").innerHTML ="Photographer name should not be empty..";
			var i=1;
	}
	/*if(document.frm.eventtype.value == "")
	{
			document.getElementById("ideventtype").innerHTML ="Event type should not be empty..";
			var i=1;
	}
	if(document.frm.address.value == "")
	{
			document.getElementById("idaddres").innerHTML ="Address should not be empty..";
			var i=1;
	}
	if(document.frm.city.value == "")
	{
			document.getElementById("idcity").innerHTML ="City should not be empty..";
			var i=1;
	}
	if(document.frm.pincode.value == "")
	{
			document.getElementById("idpincode").innerHTML ="Pincode should not be empty..";
			var i=1;
	}
	if(document.frm.bookingfdate.value == "")
	{
			document.getElementById("idbookingfdate").innerHTML ="Booking from date should not be empty..";
			var i=1;
	}
	if(document.frm.bookingtdate.value == "")

			document.getElementById("idbookingtdate").innerHTML ="Booking to date should not be empty..";
			var i=1;
	}
	if(document.frm.bookingtime.value == "")
	{
			document.getElementById("idbookingtime").innerHTML ="Booking time should not be empty..";
			var i=1;
	}
	if(document.frm.nodays.value == "")
	{
			document.getElementById("idnodays").innerHTML ="No of days should not be empty..";
			var i=1;
	}
	if(document.frm.bookingcost.value == "")
	{
			document.getElementById("idbookingcost").innerHTML ="Booking cost should not be empty..";
			var i=1;
	}
	if(document.frm.totalcost.value == "")
	{
			document.getElementById("idtotalcost").innerHTML ="Total cost should not be empty..";
			var i=1;
	}*/
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