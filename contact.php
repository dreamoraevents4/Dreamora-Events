<?php
include("header.php");
?>
<!-- start contact -->
<section id="contact">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s">CONTACT <span>AWESOME</span></h2>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12 wow fadeInLeft" data-wow-offset="50" data-wow-delay="0.9s">
				<form action="contactdata.php" method="post">
					<label>NAME</label>
					<input name="fullname" type="text" class="form-control" id="fullname">
					
					<label>EMAIL</label>
					<input name="email" type="email" class="form-control" id="email">
					
					<label>MESSAGE</label>
					<textarea style="color: black;" name="message" type="text" rows="4" class="form-control" id="message"></textarea>
					
					<input type="submit" class="form-control">
				</form>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12 wow fadeInRight" data-wow-offset="50" data-wow-delay="0.6s">
				<address>
					<p class="address-title">OUR ADDRESS</p>
					
					<p><i class="fa fa-phone"></i> +91 6360177263</p>
					<p><i class="fa fa-envelope-o"></i> deramora16@gmail.com</p>
					<p><i class="fa fa-map-marker"></i> 6City Bright Building, Mangalore, 579211</p>
				</address>
				<ul class="social-icon">
					<li><h4>WE ARE SOCIAL</h4></li>
					<li><a href="#" class="fa fa-facebook"></a></li>
					<li><a href="#" class="fa fa-twitter"></a></li>
					<li><a href="#" class="fa fa-instagram"></a></li>
				</ul>
			</div>
		</div>
	</div>
</section>
<!-- end contact -->
<?php
include("footer.php");
?>