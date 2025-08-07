<?php
include("header.php");
if(isset($_GET['delid']))
{
	$sqldel = "DELETE FROM editography WHERE editography_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sqldel);
	if(mysqli_affected_rows($con) ==1 )
	{
		echo "<script>alert('Editography Record deleted successfully...');</script>";
	}
}
?>
<style>
	label {
    display: inline-block;
    max-width: 100%;
    margin-bottom: 5px;
    font-weight: 700;
    color: black;
}
</style>
    	<!-- start contact -->
    	<section id="contact">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-12">
    					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s">View <span>editography</span></h2>
    				</div>
    				<div class="col-md-12 col-sm-12 col-xs-12 wow fadeInLeft" data-wow-offset="50" data-wow-delay="0.9s">
				<table id="example" class="table table-striped table-bordered" style="width:100%;color:black;" >
				<thead>
				<tr style="color: black;">
					<th>Editography type</th>
					<th>Image</th>
					<th>Description</th>
					<th>Default cost</th>
					<th>Status</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
				</thead>
				<tbody>
				<?php
				$sql = "SELECT * FROM editography";
				$qsql = mysqli_query($con,$sql);
				while($rs = mysqli_fetch_array($qsql))
				{
				echo "<tr>
					<td>$rs[editography_type]</td>
					<td>$rs[img]</td>
					<td>$rs[description]</td>
					<td>₹ $rs[default_cost]</td>
					<td>$rs[status]</td>
					<td>Edit</td>
					<td><a href='vieweditography.php?delid=$rs[editography_id]' onclick='return confirmtodel()'>Delete</a></td>
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
