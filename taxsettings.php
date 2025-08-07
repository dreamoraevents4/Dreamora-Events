<?php
include("header.php");
$sqledit = "SELECT * FROM tax";
$qsqledit = mysqli_query($con,$sqledit);
if(mysqli_num_rows($qsqledit)  == 0)
{
	$sql = "INSERT INTO  tax(taxtype,taxamt,status) VALUES('GST Tax','0','Active')";
	$qsql = mysqli_query($con,$sql);
}
if(isset($_POST['submit']))
{
	$sqledit = "DELETE FROM tax";
	$qsqledit = mysqli_query($con,$sqledit);		 
		$sql = "INSERT INTO tax(taxtype,taxamt,status) VALUES('$_POST[taxtype]','$_POST[taxamt]','Active')";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Tax record updated successfully..')</script>";
		}
}
$sqledit = "SELECT * FROM tax";
$qsqledit = mysqli_query($con,$sqledit);
$rsedit = mysqli_fetch_array($qsqledit);
?>    	 	
<!-- start contact -->
    	<section id="contact">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-12">
    					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s"> <span>Event Type</span></h2>
						<p >Kindly enter the Event Types</p>
    				</div>
<?php
include("sidebar.php");
?>
    				<div class="col-md-9 col-sm-9 col-xs-12 wow fadeInLeft" data-wow-offset="50" data-wow-delay="0.9s">
<form action="" method="post" name="frm" onsubmit="return validateform()" enctype="multipart/form-data" >
					<div class="form-left" >
						<label>Tax<span id="idtaxtype"  style='color:red'></span></label>
						<input type="text" name="taxtype" placeholder="Tax type" value="<?php echo $rsedit['taxtype']; ?>" >
					</div>
					<div class="form-left" >
						<label>Tax percentage(%)<span id="idtaxamt"  style='color:red'></span></label>
						<input type="text" name="taxamt" placeholder="Tax amount" value="<?php echo $rsedit['taxamt']; ?>" >
					</div>
					<div class="clearfix"> </div>
					<input type="submit" name="submit" value="SUBMIT" class="form-control" >
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
function validateform()
{
	var i=0;
	$("span").html("");
	
	if(document.frm.eventtype.value == "")	
	{
			document.getElementById("ideventtype").innerHTML ="Event type should not be empty..";
			var i=1;
	}
	if(document.frm.eventimg.value == "")	 
	{
			document.getElementById("idimg").innerHTML ="Event image should not be empty..";
			var i=1;
	}
	
	if(document.frm.eventdescription.value == "")	 
	{
			document.getElementById("iddesc").innerHTML ="Description should not be empty..";
			var i=1;
	}
	if(document.frm.status.value == "")	 
	{
			document.getElementById("idstatus").innerHTML ="Status should not be empty..";
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