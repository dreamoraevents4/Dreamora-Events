<?php
include("header.php");
if(isset($_POST['submit']))
{
	$imgname = rand(). $_FILES["eventimg"]["name"];
	move_uploaded_file($_FILES["eventimg"]["tmp_name"],"imgevent/".$imgname);
	$eventdescription = mysqli_real_escape_string($con,$_POST['eventdescription']);
	if(isset($_GET['editid']))
	{
		$sql ="UPDATE eventtype set eventtype='$_POST[eventtype]',eventimg='$imgname',eventdescription='$eventdescription',status='$_POST[status]' WHERE eventtype_id='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Event type record updated successfully..')</script>";
		}
	}
	else
	{
		
		$sql = "INSERT INTO eventtype(eventtype,eventimg,eventdescription,status) VALUES('$_POST[eventtype]','$imgname','$eventdescription','$_POST[status]')";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Event type record inserted successfully..')</script>";
		}
	}
}
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM eventtype WHERE eventtype_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>    	 	
<!-- start contact -->
    	<section id="contact">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-12">
    					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s"> <span>Event Type</span></h2>
						<p >Kindly enter the Event Types</p>
    				</div>

    				<div class="col-md-12 col-sm-12 col-xs-12 wow fadeInLeft" data-wow-offset="50" data-wow-delay="0.9s">
<form action="" method="post" name="frm" onsubmit="return validateform()" enctype="multipart/form-data" >
					<div class="form-left" >
						<label>Event Type <span id="ideventtype"  style='color:red'></span></label>
						<input type="text" name="eventtype" placeholder="Event type" value="<?php echo $rsedit['eventtype']; ?>" class="form-control" >
					</div>
					<div class="form-left" >
						<label>Event Image <span id="idimg"  style='color:red'></span></label>
						<input type="file" name="eventimg" placeholder="Event image" id="src"  class="form-control"  >
						<img id="target" width="500px" height="250px" src="<?php
						if($rsedit['eventimg'] == ""){
							echo "images/defaultimages.png";
						}
						else if(file_exists("imgevent/" . $rsedit['eventimg'])){
							echo "imgevent/" . $rsedit['eventimg'];
						}
						else{
							echo "images/defaultimages.png";
						}
						?>"/>
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
						<label>Description <span id="iddesc"  style='color:red'></span></label>
<textarea name="eventdescription" placeholder="Description" class="form-control"><?php echo $rsedit['eventdescription']; ?></textarea>
					</div>
					<div class="form-left ">
						<label>Status <span id="idstatus"  style='color:red'></span></label>
						<select name="status" class="form-control">
						<option value='' style='color:red;'>Select</option>
						<?php
						$arr = array("Active","Inactive");
						foreach($arr as $value)
						{
							if($rsedit['status'] == $value)
							{
								echo "<option value='$value' selected style='color:red;'>$value</option>";
							}
							else
							{
								echo "<option value='$value' style='color:red;'>$value</option>";
							}
						}
						?>
						</select>
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