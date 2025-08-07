<?php
include("header.php");
if(isset($_SESSION['employee_id']))
{
	echo "<script>window.location='empaccount.php';</script>";
	
}	
if(isset($_POST["submit"]))
{
	$sql = "SELECT * FROM employee WHERE loginid='$_POST[email]' AND password='$_POST[pass]' AND status='Active'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_num_rows($qsql) == 1)
	{
		$rs=mysqli_fetch_array($qsql);
		$_SESSION['employee_id']=$rs['employee_id'];
		$_SESSION['employeetype']=$rs['employeetype'];
		echo "<script>alert('Logged in succcessfully..');</script>";
		echo "<script>window.location='empaccount.php';</script>";
	}
	else
	{
		echo "<script>alert('You have entered invalid login credentials..');</script>";
	}
}
?>    	
<!-- start contact -->
    	<section id="contact">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-12">
    					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s"><span>EMPLOYEE</span> LOGIN  <span>PANEL</span></h2>
    				</div>
					
    				<div class="col-md-3 col-md-3 col-xs-12 wow fadeInRight" data-wow-offset="50" data-wow-delay="0.6s">
    				
    				</div>
    				<div class="col-md-6 col-sm-6 col-xs-12 wow fadeInLeft" data-wow-offset="50" data-wow-delay="0.9s">
    				
						<form action="" method="post" name="frmform" onsubmit="return validateform()">
    	
							<label>Login ID</label><span id="idemail" class="errdisplay" style="color:red;font-weight: bold;padding-left:10px;"></span>
	<input name="email" type="text" class="form-control" id="email">
							
							
							<label>Password</label><span id="idpass" class="errdisplay" style="color:red;font-weight: bold;padding-left:10px;"></span>
	<input name="pass" type="password" class="form-control" id="pass">
    						
                            <input type="submit" name="submit" class="form-control" value="Click here to Login">
							
    					</form>
    				</div>
    				<div class="col-md-3 col-md-3 col-xs-12 wow fadeInRight" data-wow-offset="50" data-wow-delay="0.6s">
    				
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
	
	
	if(document.getElementById("email").value == "")
	{
		document.getElementById("idemail").innerHTML = "Email ID should not be empty..";
		confirmreturn = "false";
	}
	
	if(document.getElementById("pass").value.length < 8)
	{
		document.getElementById("idpass").innerHTML = "Password should contain more than 8 characters...";
		confirmreturn = "false";
	}
	if(document.getElementById("pass").value == "")
	{
		document.getElementById("idpass").innerHTML = "Password should not be empty..";
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

