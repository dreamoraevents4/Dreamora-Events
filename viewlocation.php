<?php
include("header.php");
if(isset($_GET['delid']))
{
	$sql = "DELETE FROM location WHERE locationid='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Location record deleted successfully..');</script>";
	}
}
?>
<style>
		label{
		color: black;
	}
</style>
    	<!-- start contact -->
    	<section id="contact">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-12">
    					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s">View Location</h2>
    				</div>
    				<div class="col-md-12 col-sm-12 col-xs-12 wow fadeInLeft" data-wow-offset="50" data-wow-delay="0.9s">
					
	<table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%"> 
		<thead>
			<tr>
				<th>Location name</th>
				<th>Location Detail</th>
				<th>Location Map</th>
				<th>status</th>
			     <th>Action</th> 
			</tr>
		</thead>
		<tbody>
		<?php
		$sql= "SELECT * FROM location";
		$qsql= mysqli_query($con,$sql);
		while($rs= mysqli_fetch_array($qsql))
		{
			echo"<tr  style='color:black;'>
				<td>$rs[locationname]</td>
				<td>$rs[locationdetail]</td>
				<td><iframe src='$rs[locationmap]' width='100%' height='150' frameborder='0' style='border:0' allowfullscreen></iframe></td>
				<td>$rs[status]</td>
				<td>
					<a href='location.php?editid=$rs[locationid]' class='btn btn-info'> Edit </a>
					<a href='viewlocation.php?delid=$rs[locationid]' onclick='return confirmdelete()' class='btn btn-danger'> Delete </a>
				</td>
			</tr>";
		}
		?>
		</tbody>
		</table>
				</div>
    			</div>
    		</div>
    	</section>
    	<!-- end contact -->
<?php
include("footer.php");
?>
<script type="text/javascript" language="javascript" class="init">
function confirmdelete()
{
	if(confirm("Are you sure want to delete this record?") == true)
	{
		return true;	
	}
	else
	{
		return false;
	}
}
$(document).ready(function() {
	$('#datatable').DataTable();
} );
</script>