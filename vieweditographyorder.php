<?php
include("header.php");
if(isset($_GET['delid']))
{
	$sql = "DELETE FROM editography_order WHERE editographyorderid='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Editography order record deleted successfully..');</script>";
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
    					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s">View <span>editography</span> Orders</h2>
    				</div>
    				<div class="col-md-12 col-sm-12 col-xs-12 wow fadeInLeft" data-wow-offset="50" data-wow-delay="0.9s">
					
	<table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%"> 
		<thead>
			<tr>
				<th>Bill No.</th>
				<th>Employee name</th>
				<th>Customer</th>
				<th>Editography Type</th>
				<th>Cost</th>
				<th>Order Date</th>
				<th>Deliver Date</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$sql = "SELECT * FROM editography_order LEFT JOIN employee ON editography_order.employee_id=employee.employee_id LEFT JOIN customer ON editography_order.customer_id=customer.customer_id LEFT JOIN editography ON editography_order.editography_id=editography.editography_id";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
			echo "<tr style='background-color: white;' >
				<td>$rs[billno]</td>
				<td>$rs[employeename]</td>
				<td>$rs[customer_name]</td>
				<td>$rs[editography_type]</td>
				<td>$rs[cost]</td>
				<td>" . date("d-m-Y",strtotime($rs['orderdate'])) . "</td>
				<td>"; 
				if($rs['deliverydate'] == "0000-00-00"){
					echo "Not Delivered";
				}
				else {
					echo date("d-m-Y",strtotime($rs['deliverydate']));
				}				
			echo "</td></tr>";
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
