<?php
include("header.php");
if(isset($_GET['delid']))
{
	$sql = "DELETE FROM employee WHERE employee_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Employee  record deleted successfully..');</script>";
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
    					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s">View <?php echo $_GET['emptype']; ?></h2>
    				</div>
    				<div class="col-md-12 col-sm-12 col-xs-12 wow fadeInLeft" data-wow-offset="50" data-wow-delay="0.9s">
					
	<table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%"> 
		<thead>
			<tr>
				<th>Employee Image</th>
				<th>Employee Type</th>
				<th>Employee name</th>
				<th>Login ID</th>
				<th>Employee Profile</th>
				<?php
				if($_GET['emptype'] == "Photographer") {
				?>
				<th>Photography Cost</th>
				<?php } ?>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody style="color:black;">
		<?php
		$sql = "SELECT * FROM employee WHERE employeetype='$_GET[emptype]'";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
			echo "<tr>
				<td><img src='imgemp/$rs[empimage]' style='width:100px;height:75px;' ></td>
				<td>$rs[employeetype]</td>
				<td>$rs[employeename]</td>
				<td>$rs[loginid]</td>
				<td>$rs[empprofile]</td>";
				if($_GET['emptype'] == "Photographer") {
			echo "<td>₹$rs[photographycost]</td>";
				}
			echo "<td>$rs[status]</td>
				<td><a href='employee.php?editid=$rs[employee_id]' class='btn btn-info'> Edit </a> <a href='viewemployee.php?delid=$rs[employee_id]' onclick='return confirmdelete()' class='btn btn-danger'> Delete </a> </td>
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