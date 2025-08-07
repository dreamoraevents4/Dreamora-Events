<?php
include("header.php");
if(isset($_POST['submit']))
{
	//Coding to upload image starts here
	$filename= rand().$_FILES["empimage"]["name"];
	move_uploaded_file($_FILES["empimage"]["tmp_name"],"imgemp/".$filename);
	//Coding to upload image ends here

	//Insert statement
	$sql = "UPDATE employee SET employeename='$_POST[employeename]',loginid='$_POST[loginid]',empprofile='$_POST[empprofile]'";
	if($_FILES["empimage"]["name"] != "")
	{
	$sql = $sql . ",empimage='$filename'";
	}
	$sql = $sql. ",photographycost='$_POST[photographycost]' WHERE employee_id='$_SESSION[employee_id]'";
	$qsql = mysqli_query($con,$sql);
	if(!$qsql)
	{
		echo mysqli_error($con);
	}
	else
	{
		echo "<script>alert('Employee Profile updated successfully..');</script>";
		echo "<script>window.location='employeeprofile.php';</script>";
	}
}
$sqlemployee = "SELECT * FROM  employee WHERE employee_id='$_SESSION[employee_id]'";
$qsqlemployee  = mysqli_query($con,$sqlemployee);
$rsemployee = mysqli_fetch_array($qsqlemployee);
?>    	 	
<!-- start contact -->
    	<section id="contact">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-12">
    					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s"> <span>Employee Profile</span></h2>
    				</div>

    				<div class="col-md-6 col-sm-6 col-xs-12 wow fadeInLeft" data-wow-offset="50" data-wow-delay="0.9s">
<form action="" method="post" name="frmform" onsubmit="return validateform()" enctype="multipart/form-data">

		<label>Employee Name<span id="idemployeename"  style='color:red'></span></label>
						<input type="text" class="form-control" name="employeename" placeholder="employeename" value="<?php echo $rsemployee['employeename']; ?>" >
					

	<label>Employee Profile<span id="idempprofile"  style='color:red'></span></label>
						<textarea name="empprofile" class="form-control" placeholder="employeeprofile" rows="5"><?php echo $rsemployee['empprofile']; ?></textarea>
	<?php
	if($_SESSION['employeetype'] == "Photographer")
	{
	?>
		<label>Photography Cost</label>
		<input name="photographycost" type="text" class="form-control" id="photographycost" value="<?php echo $rsemployee['photographycost']; ?>">
	<?php
	}
	?>
	

    				</div>


    				<div class="col-md-6 col-sm-6 col-xs-12 wow fadeInLeft" data-wow-offset="50" data-wow-delay="0.9s">

	
	<label>Login ID</label>
	<input name="loginid" type="text" class="form-control" id="loginid" value="<?php echo $rsemployee['loginid']; ?>">
	
	
	<label>Employee Image</label>
	<input name="empimage" type="file" class="form-control" id="empimage" accept="image/*">
	<?php
	if(file_exists("imgemp/$rsemployee[empimage]"))
	{
		$imgname = "imgemp/$rsemployee[empimage]";
	}
	else
	{
		$imgname = "images/defaultimage.png";
	}
	?>


    				</div>
	<label>&nbsp;</label>
	<center><input type="submit" name="submit" class="form-control" value="Update profile" style="width:200px;"></center>
	
</form>
    			</div>
    		</div>
    	</section>
    	<!-- end contact -->
<?php
include("footer.php");
?>