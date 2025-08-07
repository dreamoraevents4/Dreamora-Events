<?php
include("header.php");
if(isset($_POST['submit']))
{
		//Update statement
		$sql = "UPDATE employee SET password='$_POST[newpass]' WHERE loginid='$_POST[loginid]' AND password='$_POST[oldpass]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Password is successfully Updated..');</script>";
			echo "<script>window.location='updateemppassword.php';</script>";
		}
		else
		{
			echo "<script>alert('Failed to update password...');</script>";
		}
}
?>    	 	
<!-- start contact -->
    	<section id="contact">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-12">
    					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s"> <span>Update Employee password</span></h2>
    				</div>
				</div>
				<div class="row">
    				<div class="col-md-3 col-sm-3 col-xs-3 wow fadeInLeft" data-wow-offset="50" data-wow-delay="0.9s">
					</div>
    				<div class="col-md-6 col-sm-6 col-xs-6 wow fadeInLeft" data-wow-offset="50" data-wow-delay="0.9s">
						<form action="" method="post" name="frmform" onsubmit="return validateform()">
							<label>Login ID</label><span id="idloginid" class="errdisplay" style="color:red;font-weight: bold;padding-left:10px;"></span>
							<input name="loginid" type="text" class="form-control" id="loginid">
							
							<label>Old Password</label><span id="idoldpass" class="errdisplay" style="color:red;font-weight: bold;padding-left:10px;"></span>
							<input name="oldpass" type="password" class="form-control" id="oldpass">
							
							<label>New Password</label><span id="idnewpass" class="errdisplay" style="color:red;font-weight: bold;padding-left:10px;"></span>
							<input name="newpass" type="password" class="form-control" id="newpass">
							
							<label>Confirm Password</label><span id="idconpass" class="errdisplay" style="color:red;font-weight: bold;padding-left:10px;"></span>
							<input name="conpass" type="password" class="form-control" id="conpass">
							
							<input type="submit" name="submit" class="form-control" value="Change Password">
						</form>
    				</div>
    				<div class="col-md-3 col-sm-3 col-xs-3 wow fadeInLeft" data-wow-offset="50" data-wow-delay="0.9s">
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
	if(document.getElementById("loginid").value == "")
	{
		document.getElementById("idloginid").innerHTML = "Login ID should not be empty..";
		confirmreturn = "false";
	}
	
	if(document.getElementById("oldpass").value == "")
	{
		document.getElementById("idoldpass").innerHTML = "Password should not be empty..";
		confirmreturn = "false";
	}
	if(document.getElementById("newpass").value  != document.getElementById("newpass").value)
	{
		document.getElementById("idnewpass").innerHTML ="Password should contain more than 8 characters...";
		confirmreturn = "false";
	}
	
	if(document.getElementById("newpass").value == "")
	{
		document.getElementById("idnewpass").innerHTML = "New password should not be empty..";
		confirmreturn = "false";
	}
	
	if(document.getElementById("conpass").value  != document.getElementById("conpass").value)
	{
		document.getElementById("idconpass").innerHTML = " New Password and Confirm password not matching....";
		confirmreturn = "false";
	}
	
	if(document.getElementById("conpass").value == "")
	{
		document.getElementById("idconpass").innerHTML = "Confirm password should not be empty..";
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