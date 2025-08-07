<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
		<script src="js/jquery.dataTables.min.js"></script>
		<script src="js/dataTables.bootstrap4.min.js"></script>
        <!-- start copyright -->
        <footer id="copyright"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <p class="" data-wow-offset="50" data-wow-delay="0.3s">
                       	Copyright &copy; <?php echo date('Y'); ?> Event Planner | 
						
						
	<?php
	if(isset($_SESSION['employee_id']))
	{
	?>						
	<a href="empaccount.php">My Account</a> 
	| 
	<a href="logout.php">Logout</a>
	<?php
	}
	else
	{
	?>
	<a href="emplogin.php">Employee Login Panel</a>	
	<a href="employee.php">Employee Register Panel</a>	
	<?php
	}
	?>
					
						</p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end copyright -->

	</body>
</html>