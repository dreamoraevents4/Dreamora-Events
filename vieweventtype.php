<?php
include("header.php");
if(isset($_GET['delid']))
{
	$sqldel = "DELETE FROM eventtype WHERE eventtype_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sqldel);
	if(mysqli_affected_rows($con) ==1 )
	{
		echo "<script>alert('Event type Record deleted successfully...');</script>";
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
    					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s">View <span>Event type</span></h2>
    				</div>
    				<div class="col-md-12 col-sm-12 col-xs-12 wow fadeInLeft" data-wow-offset="50" data-wow-delay="0.9s">
					
				<table id="example" class="table table-striped table-bordered" style="width:100%;color:black;" >
				<thead>
				<tr style="color:white;">
					<th>Event Type</th>
					<th>Event Image</th>
					<th>Event Description </th>
					<th>Status</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
				</thead>
				<tbody>
				<?php
				$sql = "SELECT * FROM eventtype";
				$qsql = mysqli_query($con,$sql);
				echo mysqli_error($con);
				while($rs = mysqli_fetch_array($qsql))
				{
				echo "<tr>
					<td>$rs[eventtype]</td>
					<td><img src='imgevent/$rs[eventimg]' style='width:100px;height:75px;' ></td>
					<td>$rs[eventdescription]</td>
					<td>$rs[status]</td>
					<td><a href='eventtype.php?editid=$rs[eventtype_id]' class='btn btn-info'> Edit </a></td>
					<td><a href='vieweventtype.php?delid=$rs[eventtype_id]' class='btn btn-danger' onclick='return confirmtodel()'>Delete</a></td>
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
<script>
function confirmtodel()
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
</script>

<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
