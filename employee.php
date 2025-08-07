<?php
include("header.php");
if(isset($_POST['submit']))
{
	$imgname = rand(). $_FILES["empimage"]["name"];
	move_uploaded_file($_FILES["empimage"]["tmp_name"],"imgemp/".$imgname);
	$empprofile = mysqli_real_escape_string($con, $_POST['empprofile']);
	if(isset($_GET['editid']))
	{
		$sql ="UPDATE employee set employeetype='$_POST[employeetype]',employeename='$_POST[employeename]',loginid='$_POST[loginid]',password='$_POST[password]',empprofile='" . $empprofile . "', photographycost='" . $_POST['photographycost'] . "'";
		if($_FILES["empimage"]["name"] != "")
		{
		$sql = $sql . " ,empimage='$imgname'";
		}
		$sql = $sql . " ,status='$_POST[status]' WHERE employee_id='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Employee  record updated successfully..');</script>";
		}
	}
	else
	{
		$sql = "INSERT INTO employee(employeetype,employeename,loginid,password,empprofile,empimage,photographycost,status)
		VALUES('$_POST[employeetype]','$_POST[employeename]','$_POST[loginid]','$_POST[password]','" . $empprofile . "','$imgname','$_POST[photographycost]','$_POST[status]')";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Employee record inserted successfully..');</script>";
			echo "<script>window.location='emplogin.php';</script>";
		}
	}
}
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM employee WHERE employee_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}

?>    	 	
<!-- start contact -->
    	<section id="contact">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-12">
    					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s"> <span>Employee</span></h2>
    				</div>

    				<div class="col-md-12 col-sm-12 col-xs-12 wow fadeInLeft" data-wow-offset="50" data-wow-delay="0.9s">
<form action="" method="post" name="frm" onsubmit="return validateform()" enctype="multipart/form-data" >
					<div class="form-left ">
						<label>Employee type <span id="idemployeetype"  style='color:red'></span></label>
		<select name="employeetype" id="employeetype" class="form-control" onchange="emptype(this.value)" >
			<option value='' style='color:black;'>Select Employee type</option>
			<?php
			$arr = array("Administrator","Staff","Photographer","Editor","Event Manager");
			foreach($arr as $value)
			{
				if($rsedit['employeetype'] == $value)
				{
					echo "<option value='$value' selected style='color:black;'>$value</option>";
				}
				else
				{
					echo "<option value='$value' style='color:black;'>$value</option>";
				}
			}
			?>
		</select><br>
				</div>
				<div class="form-left" >
						<label>Employee Name<span id="idemployeename"  style='color:red'></span></label>
						<input type="text" class="form-control" name="employeename" placeholder="Enter Employee Name" value="<?php echo $rsedit['employeename']; ?>" >
					</div>
					
				<div class="form-left" >
						<label>Login ID<span id="idloginid"  style='color:red'></span></label>
						<input type="text" class="form-control" name="loginid" placeholder="Enter Login ID" value="<?php echo $rsedit['loginid']; ?>">
				</div>
					<div class="form-left" >
						<label>Password<span id="idpassword"  style='color:red'></span></label>
						<input type="password" class="form-control" name="password" placeholder="Enter password" value="<?php echo $rsedit['password']; ?>" >
					</div>
						<div class="form-left" >
						<label>Confirm Password<span id="idcpassword"  style='color:red'></span></label>
						<input type="password" class="form-control" name="cpassword" placeholder="Enter confirm password" value="<?php echo $rsedit['password']; ?>" >
					</div>
						<div class="form-left ">
						<label>Employee Profile<span id="idempprofile"  style='color:red'></span></label>
						<textarea name="empprofile" class="form-control" placeholder="Enter employee profile"><?php echo $rsedit['empprofile']; ?></textarea>
					</div>
					<div class="form-left" >
						<label>Employee Images<span id="idempimage"  style='color:red'></span></label>
						<input type="file" class="form-control" name="empimage"  id="src" >
						<?php
						if(isset($rsedit['empimage'])) {
							echo '<img id="target" width="100px;height: 200px;" src="imgemp/'  . $rsedit['empimage'] . '" >';
						}
						?>
						<script>
							function showImage(src,target) {
							var fr=new FileReader();
							// when image is loaded, set the src of the image where you want to display it
							fr.onload = function(e) { target.src = this.result; };
							src.addEventListener("change",function() {
								// fill fr with image data    
								fr.readAsDataURL(src.files[0]);
							});
							}

							var src = document.getElementById("src");
							var target = document.getElementById("target");
							showImage(src,target);
						</script>
					</div>


					<div id="divemptype">
						<div  class="form-left" >
							<input type="hidden" name="photographycost" placeholder="photographycost" value="<?php echo $rsedit['photographycost']; ?>" >
						</div>
						<?php /*<label>Photography cost<span id="idphotographycost"  style='color:red'></span></label>
						<input type="text" name="photographycost" placeholder="photographycost" value="<?php echo $rsedit['photographycost']; ?>" >*/?>
					</div>
					
					<div class="form-left ">
						<label>Status<span id="idstatus"  style='color:red'></span></label>
						<select name="status" class="form-control">
						<option value='' selected style='color:black;'>Select Employee Status</option>
						<?php
						$arr = array("Active","Inactive");
						foreach($arr as $value)
						{
							if($rsedit['status'] == $value)
							{
								echo "<option value='$value' selected selected style='color:black;'>$value</option>";
							}
							else
							{
								echo "<option value='$value'  style='color:black;'>$value</option>";
							}
						}
						?>
						</select>
					</div>
					<div class="clearfix"> </div>
					<input type="submit" class="form-control" name="submit" value="SUBMIT" >
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
	var alphaSpaceExp = /^[a-zA-Z\s]+$/;
	var alphaExp = /^[a-zA-Z]+$/;
	var alphaNumericExp = /^[0-9a-zA-Z]+$/;
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,}$/; // ✅ Email format regex

	var i=0;
	$("span").html("");

	if(document.frm.employeetype.value == "")
	{
		document.getElementById("idemployeetype").innerHTML ="Employee type should not be empty..";
		i=1;
	}
	if(!document.frm.employeename.value.match(alphaSpaceExp))
	{
		document.getElementById("idemployeename").innerHTML ="Employee name should contain only alphabets..";
		i=1;
	}
	if(document.frm.employeename.value == "")
	{
		document.getElementById("idemployeename").innerHTML ="Employee name should not be empty..";
		i=1;
	}
	if(!document.frm.loginid.value.match(emailExp))  // ✅ email validation added
	{
		document.getElementById("idloginid").innerHTML ="Please enter a valid Email ID (e.g. henil@gmail.com)";
		i=1;
	}
	if(document.frm.loginid.value == "")  
	{
		document.getElementById("idloginid").innerHTML ="Login ID should not be empty..";
		i=1;
	}
	if(document.frm.password.value.length < 6 )
	{
		document.getElementById("idpassword").innerHTML ="Password should contain more than 6 characters..";
		i=1;
	}
	if(document.frm.password.value == "")  
	{
		document.getElementById("idpassword").innerHTML ="Password should not be empty..";
		i=1;
	}
	if(document.frm.cpassword.value != document.frm.password.value )
	{
		document.getElementById("idcpassword").innerHTML ="Entered password and confirm password not matching....";
		i=1;
	}
	if(document.frm.cpassword.value == "")  
	{
		document.getElementById("idcpassword").innerHTML ="Confirm password should not be empty..";
		i=1;
	}
	if(document.frm.empprofile.value == "")  
	{
		document.getElementById("idempprofile").innerHTML ="Employee profile should not be empty..";
		i=1;
	}
	/*
	if(document.frm.empimage.value == "")  
	{
		document.getElementById("idempimage").innerHTML ="Employee image should not be empty..";
		i=1;
	}
	*/
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
