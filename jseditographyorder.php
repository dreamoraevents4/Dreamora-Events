<?php
session_start();
include("dbconnection.php");
$dt = date("Y-m-d");
if(isset($_POST['delid']))
{
	$sqlDELETE="DELETE FROM editography_order where editographyorder_id ='$_POST[delid]'";
	mysqli_query($con,$sqlDELETE);
}
if(isset($_POST["billno"]))
{
	$sql = "INSERT INTO editography_order(employee_id,customer_id,editography_id,cost,orderdate,deliverydate,status,qty,description,reqdate) 
	VALUES('$_SESSION[employee_id]','$_POST[customer_id]','$_POST[editographytypeid]','$_POST[cost]','$dt','$_POST[deliverydate]','Pending','$_POST[qty]','$_POST[description]','$_POST[reqdate]')";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
}
?>
<hr>
<table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%"  style="background-color:white;color:black;">
	<thead>
		<tr style="background-color:blue;color:white;">
			<th>Editography type</th>
			<th>Cost</th>
			<th>Quantity</th>
			<th>Total</th>
			<th style="width:10px;"><center>Delete</center></th>
		</tr>
	</thead>
	<tbody>
		<?php
			$amt=0;
			$sql ="SELECT * FROM editography_order LEFT JOIN editography ON editography_order.editography_id=editography.editography_id WHERE editography_order.status='Pending'";
			$qsql = mysqli_query($con,$sql);
			echo mysqli_error($con);
			while($rs = mysqli_fetch_array($qsql))
			{
				echo "<tr>
						<td><b>$rs[editographytype]</b><br>$rs[7]</td>
						<td>$rs[cost]</td>
						<td>$rs[qty]</td>
						<td>" . $rs['cost'] * $rs['qty'] ."</td>
						<td><input type='button' value='X' onclick='deleterecord($rs[0])'></td>
					</tr>";
				$amt = ($rs['cost'] * $rs['qty']) + $amt;
			}
		?>
	</tbody>
</table>
<input type='hidden' name='amt' id='amt' value='<?php echo $amt; ?>' >