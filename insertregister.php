<?php
include("header.php");
if(isset($_POST['submit']))
{
	$sqlvalidate = "SELECT * FROM  customer WHERE email_id='$_POST[email_id]'";
	$qsqlvalidate  = mysqli_query($con,$sqlvalidate);
	if(mysqli_num_rows($qsqlvalidate) >= 1)
	{
		echo "<script>alert('Customer record already exists..');</script>";
		echo "<script>window.location='customer.php';</script>";
	}
	else
	{
		//Insert statement
		$sql = "INSERT INTO customer(customer_id,customer_name,email_id,password,address,contactno,status) VALUES('$_POST[customer_id]','$_POST[customer_name]','$_POST[email_id]','$_POST[password]','$_POST[address]','$_POST[contactno]','$_POST[status]')";
		$qsql = mysqli_query($con,$sql);
		if(!$qsql)
		{
			echo mysqli_error($con);
		}
		else
		{
			echo "<script>alert('Customer Record inserted successfully..');</script>";
			echo "<script>window.location='customer.php';</script>";
		}
	}
}
?>    	 	
<!-- start contact -->
    	<section id="contact">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-12">
    					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s"> <span>Customer Details</span></h2>
    				</div>
<?php
include("sidebar.php");
?>
    				<div class="col-md-9 col-sm-9 col-xs-12 wow fadeInLeft" data-wow-offset="50" data-wow-delay="0.9s">
<form action="" method="post" name="frmform" onsubmit="return validateform()">

	
	<label>Customer Name</label><span id="idcustomer_name" class="errdisplay" style="color:red;font-weight: bold;padding-left:10px;"></span>
	<input name="customer_name" type="text" class="form-control" id="customer_name">
		
		<label>Email ID</label><span id="idemail_id" class="errdisplay" style="color:red;font-weight: bold;padding-left:10px;"></span>
	<input name="email_id" type="text" class="form-control" id="email_id">
	
	<label>Password</label><span id="idpassword" class="errdisplay" style="color:red;font-weight: bold;padding-left:10px;"></span>
	<input name="password" type="password" class="form-control" id="password">
		
		<label>Address</label><span id="idaddress" class="errdisplay" style="color:red;font-weight: bold;padding-left:10px;"></span>
	<textarea name="address" type="text" class="form-control" id="address"></textarea>
		
	<label>Contact</label><span id="idcontactno" class="errdisplay" style="color:red;font-weight: bold;padding-left:10px;"></span>
	<input name="contactno" type="text" class="form-control" id="contactno" accept="image/*">
	
	<label>status</label>
	<select name="status" class="form-control" style="background-color: white;color:black;">
		<option value="">Select</option>
		<?php
		$arr = array("Active","Inactive");
		foreach($arr as $val)
		{
			echo "<option value='$val'>$val</option>";
		}
		?>
	</select>
	
	<input type="submit" name="submit" class="form-control" value="Submit">
	
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
	var numericExpression = /^[0-9]+$/;
	var alphaExp = /^[a-zA-Z]+$/;
	var alphaspaceExp = /^[a-zA-Z\s]+$/;
	var alphanumericExp = /^[0-9a-zA-Z]+$/;
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,6}$/;
	
	var confirmreturn = "true";
	$(".errdisplay").html("");
	
	if(!document.getElementById("customer_name").value.match(alphaspaceExp))
	{
		document.getElementById("idcustomer_name").innerHTML = "Name should contain alphabets...";
		confirmreturn = "false";
	}
	
	if(document.getElementById("customer_name").value == "")
	{
		document.getElementById("idcustomer_name").innerHTML = "Name should not be empty..";
		confirmreturn = "false";
	}
	if(!document.getElementById("email_id").value.match(emailExp))
	{
		document.getElementById("idemail_id").innerHTML = "Entered Email ID is not in valid format...";
		confirmreturn = "false";
	}
	if(document.getElementById("email_id").value == "")
	{
		document.getElementById("idemail_id").innerHTML = "Email ID should not be empty..";
		confirmreturn = "false";
	}
	
	if(document.getElementById("password").value.length < 8)
	{
		document.getElementById("idpassword").innerHTML = "Password should contain more than 8 characters...";
		confirmreturn = "false";
	}
	if(document.getElementById("password").value == "")
	{
		document.getElementById("idpassword").innerHTML = "Password should not be empty..";
		confirmreturn = "false";
	}
	if(document.getElementById("contactno").value.length != 10)
	{
		document.getElementById("idcontactno").innerHTML = "Contact number should contain 10 digits....";
		confirmreturn = "false";
	}
	
	if(!document.getElementById("contactno").value.match(numericExpression))
	{
		document.getElementById("idcontactno").innerHTML = "Contact number should contain numbers...";
		confirmreturn = "false";
	}
	if(document.getElementById("contactno").value == "")
	{
		document.getElementById("idcontactno").innerHTML = "Contact number should not be empty..";
		confirmreturn = "false";
	}
	if(confirmreturn == "true")
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>