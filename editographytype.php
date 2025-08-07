<?php
include("header.php");
if(isset($_POST['submit']))
{
	$imgname = rand(). $_FILES["img"]["name"];
	move_uploaded_file($_FILES["img"]["tmp_name"],"imgeditography/".$imgname);
	if(isset($_GET['editid']))
	{
		$sql ="UPDATE editography set editography_type='$_POST[editographytype]'";
		if($_FILES["img"]["name"] != ""){
			$sql .= ",img='$imgname'";
		}		
		$sql .= ",description='$_POST[description]',default_cost='$_POST[defaultcost]',status='$_POST[status]' WHERE editography_id='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Editography record updated successfully..')</script>";
		}
	}
	else
	{	
		$sql = "INSERT INTO editography(editography_type,img,description,default_cost,status) VALUES('$_POST[editographytype]','$imgname','$_POST[description]','$_POST[defaultcost]','$_POST[status]')";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Editography type record inserted successfully..')</script>";
			echo "<script>window.location='vieweditographytype.php';</script>";
		}	
	}
}
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM editography WHERE editography_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>    	 	
<!-- start contact -->
    	<section id="contact">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-12">
    					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s"> <span>Editography Type</span></h2>
						<p >Kindly enter the Editography Types...</p>
    				</div>

    				<div class="col-md-12 col-sm-12 col-xs-12 wow fadeInLeft" data-wow-offset="50" data-wow-delay="0.9s">
					<form action="" method="post" enctype="multipart/form-data" >
					<div class="form-left" >
						<label>Editography Type</label>
						<input class="form-control" type="text" name="editographytype" placeholder="Editography Type" value="<?php echo $rsedit['editography_type']; ?>">
					</div>
					<div class="form-left" >
						<label>Image</label>
						<input class="form-control" type="file" name="img" id="src" >
						<img id="target" width="500px" src="<?php
						if($rsedit['img'] == ""){
							echo "images/defaultimages.png";
						}
						else if(file_exists("imgeditography/" . $rsedit['img'])){
							echo "imgeditography/" . $rsedit['img'];
						}
						else{
							echo "images/defaultimages.png";
						}
						?>" />
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
					<div class="form-left ">
						<label>Description</label>
						<textarea  class="form-control" name="description" placeholder="Description"><?php echo $rsedit['description']; ?></textarea>
					</div>
					<div class="form-left" >
						<label>Default cost</label>
						<input class="form-control" type="text" name="defaultcost" placeholder="Default cost" value="<?php echo $rsedit['default_cost']; ?>">
					</div>
					<div class="form-left ">
						<label>Status</label>
						<select name="status" class="form-control">
						<option value=''>Select</option>
						<?php
						$arr = array("Active","Inactive");
						foreach($arr as $value)
						{
							if($rsedit['status'] == $value)
							{
								echo "<option value='$value' selected>$value</option>";
							}
							else
							{
								echo "<option value='$value'>$value</option>";
							}
						}
						?>
						</select>
					</div>
					<div class="clearfix"> </div>
					<input class="form-control" type="submit" name="submit" value="SUBMIT" >
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