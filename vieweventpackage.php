<?php
include("header.php");
if(isset($_GET['delid']))
{
	$sql = "DELETE FROM event_package WHERE eventpackage_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Event Package record deleted successfully..');</script>";
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
    					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s">View Event Package</h2>
    				</div>
    				<div class="col-md-12 col-sm-12 col-xs-12 wow fadeInLeft" data-wow-offset="50" data-wow-delay="0.9s">
	<table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%"> 
		<thead>
			<tr>
				<th>Images</th>
				<th>Event Type</th>
				<th>Package Title</th>
				<th>Event description</th>
				<th>Highlights</th>
				<th>Event Cost</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$sql = "SELECT * FROM event_package LEFT JOIN eventtype ON event_package.eventtype_id=eventtype.eventtype_id";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		while($rs = mysqli_fetch_array($qsql))
		{
			echo "<tr style='color:black;'>
				<td><img src='imgevent/$rs[images]' style='width:100px;height:75px;' ></td>
				<td>$rs[eventtype]</td>
				<td>$rs[packagetitle]</td>
				<td>$rs[3]</td>
				<td>$rs[highlights]</td>
				<td>₹$rs[eventcost]</td>
				<td>$rs[status]</td>
				<td><a href='eventpackage.php?editid=$rs[0]' class='btn btn-info'> Edit </a> <a href='vieweventpackage.php?delid=$rs[0]' onclick='return confirmdelete()' class='btn btn-danger'> Delete </a></td>
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