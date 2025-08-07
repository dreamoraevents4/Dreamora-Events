<?php
include("header.php");
if(!isset($_SESSION["employee_id"]))
{
	echo "<script>window.location='emplogin.php';</script>";
}
?>
    	<!-- start team -->
    	<section id="team" style="background-color: white;">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-12">
    					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s">---<span>Dashboard</span>---</h2>
    				</div>
					
					
    				<div class="col-md-4 col-sm-6 col-xs-12 wow fadeIn" data-wow-offset="50" data-wow-delay="1.3s" onclick="window.location='viewcustomer.php'">
    					<div class="team-wrapper">
    						<img src="images/customers.jpg" class="img-responsive" style="height:200px;width:100%;">
    							<div class="team-des">
    								<h4>Customer</h4>
    								<span>Number of Customers</span>
    								<p>
										<?php
										$sql = "SELECT * FROM customer";
										$qsql =mysqli_query($con,$sql);
										echo mysqli_num_rows($qsql) ." Records";
										?>									
									</p>
    							</div>
    					</div>
    				</div>
					
					
					
    				<div class="col-md-4 col-sm-6 col-xs-12 wow fadeIn" data-wow-offset="50" data-wow-delay="0.s" onclick="window.location='viewphotographybooking.php'">
    					<div class="team-wrapper">
    						<img src="images/photography.jpg" class="img-responsive" style="height:200px;width:100%;">
    							<div class="team-des">
    								<h4>PHOTOGRAPHER</h4>
    								<span> Number of photographers</span>
    								<p>
<?php
$sql = "SELECT * FROM photography_booking";
$qsql =mysqli_query($con,$sql);
echo mysqli_num_rows($qsql) ." Records";
?>	
</p>
    							</div>
    					</div>
    				</div>
    				<div class="col-md-4 col-sm-6 col-xs-12 wow fadeIn" data-wow-offset="50" data-wow-delay="1.3s" onclick="window.location='vieweditography.php'">
    					<div class="team-wrapper">
    						<img src="images/flex.jpg" class="img-responsive" style="height:200px;width:100%;">
    							<div class="team-des">
    								<h4>EDITOGRAPHY</h4>
    								<span>Number of editography records</span>
    								<p>
<?php
$sql = "SELECT * FROM editography";
$qsql =mysqli_query($con,$sql);
echo mysqli_num_rows($qsql) ." Records";
?>	
									</p>
    							</div>
    					</div>
    				</div>
					
					<div class="col-md-4 col-sm-6 col-xs-12 wow fadeIn" data-wow-offset="50" data-wow-delay="1.3s" onclick="window.location='viewemployee.php'">
    					<div class="team-wrapper">
    						<img src="images/employee.jpg" class="img-responsive" style="height:200px;width:100%;">
    							<div class="team-des">
    								<h4>EMPLOYEE</h4>
    								<span>Number of employees</span>
    								<p>
<?php
$sql = "SELECT * FROM employee";
$qsql =mysqli_query($con,$sql);
echo mysqli_num_rows($qsql) ." Records";
?>	
									</p>
    							</div>
    					</div>
    				</div>
					
					<div class="col-md-4 col-sm-6 col-xs-12 wow fadeIn" data-wow-offset="50" data-wow-delay="1.3s" onclick="window.location='vieweventbookingrecord.php'">
    					<div class="team-wrapper">
    						<img src="images/eventbook.jpg" class="img-responsive" style="height:200px;width:100%;">
    							<div class="team-des">
    								<h4>EVENT BOOKING</h4>
    								<span>Number of events booked</span>
    								<p>
<?php
$sql = "SELECT * FROM event_booking";
$qsql =mysqli_query($con,$sql);
echo mysqli_num_rows($qsql) ." Records";
?>	
									</p>
    							</div>
    					</div>
    				</div>
					
					<div class="col-md-4 col-sm-6 col-xs-12 wow fadeIn" data-wow-offset="50" data-wow-delay="1.3s">
    					<div class="team-wrapper">
    						<img src="images/invoice.jpg" class="img-responsive" style="height:200px;width:100%;">
    							<div class="team-des">
    								<h4>INVOICE</h4>
    								<span>Number of invoices</span>
    								<p>
<?php
$sql = "SELECT * FROM invoice";
$qsql =mysqli_query($con,$sql);
echo mysqli_num_rows($qsql) ." Records";
?>	
									</p>
    							</div>
    					</div>
    				</div>
					<div class="col-md-4 col-sm-6 col-xs-12 wow fadeIn" data-wow-offset="50" data-wow-delay="1.3s" onclick="window.location='viewpayment.php'">
    					<div class="team-wrapper">
    						<img src="images/paymrnt.jpg" class="img-responsive" style="height:200px;width:100%;">
    							<div class="team-des">
    								<h4>PAYMENT</h4>
    								<span>Number of Payments done</span>
    								<p>
<?php
$sql = "SELECT * FROM payment";
$qsql =mysqli_query($con,$sql);
echo mysqli_num_rows($qsql) ." Records";
?>	
									</p>
    							</div>
    					</div>
    				</div>
					
    			</div>
    		</div>
    	</section>
    	<!-- end team -->


<?php
include("footer.php");
?>