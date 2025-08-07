<?php
include("header.php");
if(isset($_GET['delid']))
{
	$sql = "DELETE FROM editography WHERE editography_id ='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Editography type record deleted successfully..');</script>";
		echo "<script>window.location='vieweditographytype.php';</script>";
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
    					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s">View <span>Editography types</span></h2>
    				</div>
    				<div class="col-md-12 col-sm-12 col-xs-12 wow fadeInLeft" data-wow-offset="50" data-wow-delay="0.9s">
					
<table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%"> 
		<thead>
			<tr>
				<th>Image</th>
				<th>Editography Type</th>
				<th>Discription</th>
				<th>Default Cost</th>
				<th>status</th>
			    <th>Action</th> 
			</tr>
		</thead>
		<tbody>
		<?php
		$sql= "SELECT * FROM editography";
		$qsql= mysqli_query($con,$sql);
		while($rs= mysqli_fetch_array($qsql))
		{
			echo"<tr style='color: black;'>
				<td><img src='imgeditography/$rs[img]' style='width:100px;height:75px;' ></td>
				<td>$rs[editography_type]</td>
				<td>$rs[description]</td>
				<td style='text-align: right;'>Rs." . round($rs['default_cost']) . "</td>
				<td>$rs[status]</td>
				<td><a href='editographytype.php?editid=$rs[editography_id]' class='btn btn-info'> Edit </a> <a href='vieweditographytype.php?delid=$rs[editography_id]' onclick='return confirmdelete()' class='btn btn-danger'> Delete</td>
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
</script>
<script type="text/javascript" language="javascript" class="init">
$(document).ready(function() {
	$('#datatable').DataTable();
} );
</script>