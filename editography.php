<?php
include("header.php");
if(isset($_POST['submit']))
{
	//Coding to upload image starts here
	$filename= rand().$_FILES["img"]["name"];
	move_uploaded_file($_FILES["img"]["tmp_name"],"imgeditography/".$filename);
	//Coding to upload image ends here
	//Insert statement
	$sql = "INSERT INTO editography(editography_type,img,description,default_cost,status) VALUES('$_POST[editography_type]','$filename','$_POST[description]','$_POST[default_cost]','$_POST[status]')";
	$qsql = mysqli_query($con,$sql);
	if(!$qsql)
	{
		echo mysqli_error($con);
	}
	else
	{
		echo "<script>alert('Editography type inserted successfully..');</script>";
		echo "<script>window.location='editography.php';</script>";
	}
}
?>    	
<!-- start contact -->
    	<section id="contact">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-12">
    					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s"> <span>Editography</span></h2>
    				</div>
<?php
include("sidebar.php");
?>
    				<div class="col-md-9 col-sm-9 col-xs-12 wow fadeInLeft" data-wow-offset="50" data-wow-delay="0.9s">
<form action="" method="post" enctype="multipart/form-data">
	<label>Editography Type</label>
	<input name="editography_type" type="text" class="form-control" id="editography_type">
	
	<label>Image</label>
	<input name="img" type="file" class="form-control" id="img"
	accept="image/*">
	
	<label>Description</label>
	<textarea name="description" class="form-control" id="description" ></textarea>
	
	<label>Default cost</label>
	<input name="default_cost" type="text" class="form-control" id="default_cost">
	
	<label>status</label>
	<select name="status" class="form-control" style="background-color: white;color: black;">
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