<?php
include("header.php");
?>

    	<!-- start contact -->
    	<section id="contact">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-12">
    					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s">LOGIN  <span>PANEL</span></h2>
    				</div>
    				<div class="col-md-6 col-sm-6 col-xs-12 wow fadeInLeft" data-wow-offset="50" data-wow-delay="0.9s">
    					<form action="#" method="post">
						
    						<label>Email ID</label>
    						<input name="email" type="text" class="form-control" id="email">
   						  	
                            <input type="submit" class="form-control" value="Reset Password">
    					</form>
    				</div>
    				<div class="col-md-6 col-sm-6 col-xs-12 wow fadeInRight" data-wow-offset="50" data-wow-delay="0.6s">
    					<address>
    						<p class="address-title">New User</p>
    					</address>
    					<ul class="social-icon">
    						<li><input type="submit" class="form-control" value="Click here to Register" onclick="window.location='register.php'"></li>
    					</ul>
    				</div>
    			</div>
    		</div>
    	</section>
    	<!-- end contact -->
<?php
include("footer.php");
?>