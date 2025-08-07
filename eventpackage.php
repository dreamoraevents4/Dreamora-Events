<?php
include("header.php");
if(isset($_POST['submit']))
{
	$imgname = rand(). $_FILES["images"]["name"];
	move_uploaded_file($_FILES["images"]["tmp_name"],"imgevent/".$imgname);
	
	$eventdescription = mysqli_real_escape_string($con, $_POST['eventdescription']);
	$highlights = mysqli_real_escape_string($con, $_POST['highlights']);
	
	if(isset($_GET['editid']))
	{
		$sql ="UPDATE event_package set eventtype_id='$_POST[eventtypeid]',packagetitle='$_POST[packagetitle]',eventdescription='$eventdescription',images='$imgname',highlights='$highlights',eventcost='$_POST[eventcost]',status='$_POST[status]' WHERE eventpackage_id='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Event Package record updated successfully..')</script>";
		}
	}
	else
	{
		$sql = "INSERT INTO event_package(eventtype_id,packagetitle,eventdescription,images,highlights,eventcost,status) VALUES('$_POST[eventtypeid]','$_POST[packagetitle]','$eventdescription','$imgname','$highlights','$_POST[eventcost]','$_POST[status]')";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Event Package record inserted successfully..')</script>";
		}
	}
}
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM event_package WHERE eventpackage_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>    	 	
<!-- start contact -->
    	<section id="contact">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-12">
    					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s"> <span>Event Package</span></h2>		  
				<p >Kindly enter the Event Packages...</p>
    				</div>
<?php
//include("sidebar.php");
?>
    				<div class="col-md-12 col-sm-12 col-xs-12 wow fadeInLeft" data-wow-offset="50" data-wow-delay="0.9s">
<form action="" method="post" name="frm" onsubmit ="return validateform()" enctype="multipart/form-data" >
					<div class="form-left ">
						<label>Event type <span id="ideventtypeid"  style='color:red'></span></label>
		<select name="eventtypeid" class="form-control">
		<option value='' style='color:red'>Select</option>
		<?php
		$sqleventtype = "SELECT * FROM eventtype where status='Active'";
		$qsqleventtype = mysqli_query($con,$sqleventtype);
		while($rseventtype = mysqli_fetch_array($qsqleventtype))
		{
			if($rseventtype['eventtype_id']==$rsedit['eventtype_id'])
			{
				echo "<option value='$rseventtype[eventtype_id]' selected style='color:red'>$rseventtype[eventtype]</option>";
			}
			else
			{
				echo "<option value='$rseventtype[eventtype_id]' style='color:red'>$rseventtype[eventtype]</option>";
			}
		}
		?>
		</select>
				</div>
				<div class="form-left" >
						<label>Package Title<span id="idpackagetitle"  style='color:red'></span></label>
						<input type="text" name="packagetitle" placeholder="Packagetitle" value="<?php echo $rsedit['packagetitle']; ?>"  class="form-control">
					</div>
					
					<div class="form-left ">
						<label>Event Description<span id="ideventdescription"  style='color:red'></span></label>
						<textarea name="eventdescription" placeholder="Description" class="form-control"><?php echo $rsedit['eventdescription']; ?></textarea>
					</div>
					<div class="form-left" >
						<label>Images<span id="idimages"  style='color:red'></span></label>
						<input type="file" name="images" placeholder="image" id="src"  class="form-control" >
						<img id="target" width="500px" src="<?php
						if($rsedit['images'] == ""){
							echo "images/defaultimages.png";
						}
						else if(file_exists("imgevent/" . $rsedit['images'])){
							echo "imgevent/" . $rsedit['images'];
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
						<label>Highlights<span id="idhighlights"  style='color:red'></span></label>
						<textarea name="highlights" placeholder="highlights" class="form-control"><?php echo $rsedit['highlights']; ?></textarea>
					</div>
					<div class="form-left" >
						<label>Event cost<span id="ideventcost"  style='color:red'></span></label>
						<input type="text" name="eventcost" placeholder="Event cost" value="<?php echo $rsedit['eventcost']; ?>" class="form-control">
					</div>
					<div class="form-left ">
						<label>Status<span id="idstatus"  style='color:red'></span></label>
						<select name="status" class="form-control">
						<option value='' style='color:red'>Select</option>
						<?php
						$arr = array("Active","Inactive");
						foreach($arr as $value)
						{
							if($rsedit['status'] == $value)
							{
								echo "<option value='$value' selected style='color:red'>$value</option>";
							}
							else
							{
								echo "<option value='$value' style='color:red'>$value</option>";
							}
						}
						?>
						</select>
					</div>
					<div class="clearfix"> </div>
					<input type="submit" name="submit" value="SUBMIT"  class="form-control">
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
	
	if(document.frm.eventtypeid.value == "") 
	{
			document.getElementById("ideventtypeid").innerHTML ="Eventtype should not be empty..";
			var i=1;
	}
	if(document.frm.packagetitle.value == "")  
	{
			document.getElementById("idpackagetitle").innerHTML ="Package title should not be empty..";
			var i=1;
	}
	if(document.frm.eventdescription.value == "")   
	{
			document.getElementById("ideventdescription").innerHTML ="Event description should not be empty..";
			var i=1;
	}
	if(document.frm.images.value == "")   
	{
			document.getElementById("idimages").innerHTML ="Image should not be empty..";
			var i=1;
	}
	if(document.frm.highlights.value == "")   
	{
			document.getElementById("idhighlights").innerHTML ="Highlights should not be empty..";
			var i=1;
	}
	if(document.frm.eventcost.value == "")   
	{
			document.getElementById("ideventcost").innerHTML ="Event cost should not be empty..";
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