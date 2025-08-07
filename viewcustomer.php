<?php
include("header.php");
if(isset($_GET['delid']))
{
	$sqldel = "DELETE FROM customer WHERE customer_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sqldel);
	if(mysqli_affected_rows($con) ==1 )
	{
		echo "<script>alert('Customer Record deleted successfully...');</script>";
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
    					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s">View <span>Customer</span></h2>
    				</div>
    				<div class="col-md-12 col-sm-12 col-xs-12 wow fadeInLeft" data-wow-offset="50" data-wow-delay="0.9s">
					
				<table id="example"  class="table table-striped table-bordered" style="width:100%;color: black;" >
				<thead>
				<tr style="color: black;">
					<th>Name</th>
					<th>Email ID</th>
					<th>Address</th>
					<th>Contact No</th>
					<th>Status</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
				</thead>
				<tbody>
				<?php
				$sql = "SELECT * FROM customer";
				$qsql = mysqli_query($con,$sql);
				while($rs = mysqli_fetch_array($qsql))
				{
				echo "<tr>
					<td>$rs[customer_name]</td>
					<td>$rs[email_id]</td>
					<td>$rs[address]</td>
					<td>$rs[contactno]</td>
					<td>$rs[status]</td>
					<td><a href='customer.php?editid=$rs[0]' class='btn btn-info'>Edit</a></td>
					<td><a href='viewcustomer.php?delid=$rs[customer_id]' onclick='return confirmtodel()'  class='btn btn-danger' >Delete</a></td>
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