<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dreamora Event Group</title>
</head>
<style>
	.row_service {
		margin-right: -15px;
		margin-left: 50px;
	}

	.footername {
		text-align: center;
		padding-left: 20%;
	}

	.footerDname {
		text-align: center;
		padding-left: 20%;
	}

	/* Base styles */
	.site-footer {
		font-family: Arial, sans-serif;
		background: #f9f9f9;
		color: #333;
	}

	.footer-top {
		padding: 40px 20px;
		background: #f9f9f9;
	}

	.footer-container {
		display: flex;
		justify-content: space-between;
		max-width: 1200px;
		margin: auto;
		flex-wrap: wrap;
		gap: 20px;
	}

	.footer-column {
		flex: 1 1 30%;
		min-width: 250px;
	}

	.footer-column h3,
	.footer-column h4 {
		font-weight: bold;
		margin-bottom: 15px;
		color: #333;
	}

	.footer-column p {
		margin: 8px 0;
		line-height: 1.6;
	}

	.footer-column ul {
		list-style: none;
		padding: 0;
	}

	.footer-column ul li {
		margin: 8px 0;
	}

	.footer-column ul li a {
		color: #333;
		text-decoration: none;
	}

	.footer-column ul li a:hover {
		color: gray;
	}

	.footer-column button {
		background-color: hotpink;
		color: white;
		padding: 10px 20px;
		border: none;
		margin-top: 10px;
		border-radius: 5px;
		font-weight: bold;
		cursor: pointer;
	}

	.footer-column button:hover {
		color: black;
		background-color: pink;
	}

	.footer-bottom {
		display: flex;
		justify-content: space-between;
		align-items: center;
		background: #f1f1f1;
		padding: 20px;
		flex-wrap: wrap;
	}

	.footer-left {
		flex: 1;
		text-align: left;
		margin: 10px 0;
	}

	.footer-social {
		display: flex;
		gap: 10px;
		margin: 10px 0;
	}

	.footer-social a {
		background: hotpink;
		color: white;
		padding: 10px;
		border-radius: 50%;
		display: inline-block;
		font-size: 16px;
		text-align: center;
	}

	.footer-social a:hover {
		background: pink;
	}

	/* Mobile Responsive */
	@media (max-width: 768px) {
		.footer-container {
			flex-direction: column;
			align-items: flex-start;
		}

		.footer-column {
			width: 100%;
			margin-bottom: 30px;
		}

		.footer-bottom {
			flex-direction: column;
			align-items: center;
			text-align: center;
		}

		.footer-left {
			margin: 10px 0;
			text-align: center;
		}

		.footer-social {
			justify-content: center;
		}
	}
</style>

<body>
	<?php
include("header.php");
?>
	<!-- start home -->
	<section id="home">
		<div class="container">
			<div class="row">
				<div class="col-md-offset-2 col-md-8">
					<h1 class="wow fadeIn" data-wow-offset="50" data-wow-delay="0.9s"> <span
							class="first-name">Dreamora</span> <span class="secound-name">Event</span> </h1>
					<div class="element">
						<div class="sub-element">All-in-one event management Portal..</div>
						<div class="sub-element">Online portal to make Successful Events..</div>
						<div class="sub-element">A unique , dynamic and creative Event Planner..</div>
					</div>
					<a href="register.php" class="button-home">Register</a>
					<a href="custlogin.php" class="button-home">Login</a>
				</div>
			</div>
		</div>
		<img src="index_right_logo.png" class="img_responsive" alt="">
	</section>
	<!-- end home -->
	<hr />
	<!-- start about -->
	<section id="about">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s">SERVICES<span> PROVIDED</span>
					</h2>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-12 wow fadeInLeft" data-wow-offset="50" data-wow-delay="0.6s"
					style="border: 1px solid gray;box-shadow: 0px 0px 5px gray;">
					<div class="media">
						<div class="media-heading-wrapper">
							<div class="media-object pull-left">
								<i class="fa fa-mobile"></i>
							</div>
							<h3 class="media-heading">VISITOR DETAILS</h3>
						</div>
						<div class="media-body">
							<p>The visitors can view all information through online. But to book for events and
								photography the visitor need to register in this website by entering their profile.</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-12 wow fadeInUp" data-wow-offset="50" data-wow-delay="0.9s"
					style="border: 1px solid gray;box-shadow: 0px 0px 5px gray;">
					<div class="media">
						<div class="media-heading-wrapper">
							<div class="media-object pull-left">
								<i class="fa fa-comment-o"></i>
							</div>
							<h3 class="media-heading">PAYMENT METHOD</h3>
						</div>
						<div class="media-body">
							<p>The customer can make payment through online. After making payment customer can view or
								download payment receipt.</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-12 wow fadeInRight" data-wow-offset="50" data-wow-delay="0.6s"
					style="border: 1px solid gray;box-shadow: 0px 0px 5px gray;">
					<div class="media">
						<div class="media-heading-wrapper">
							<div class="media-object pull-left">
								<i class="fa fa-html5"></i>
							</div>
							<h3 class="media-heading">TRANSACTION DETAILS</h3>
						</div>
						<div class="media-body">
							<p>Administrator can view all transaction detail and he can add income and expense records
								through online. Administrator can view and print all kinds of reports</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end about -->
	<hr />
	<!-- start team -->
	<section id="team">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s"><span>Plan your Event
							here</span>...</h2>
				</div>
				<div class="col-md-4 col-sm-6 col-xs-12 wow fadeIn" data-wow-offset="50" data-wow-delay="1.3s">
					<div class="team-wrapper" style="border: 1px solid gray;box-shadow: 0px 0px 10px gray;">
						<a href="displaylocation.php?selected=Event"><img src="images/event.png" class="img-responsive"
								style="height:200px;">
							<div class="team-des">
								<h4>EVENT</h4>
								<span>Event planning for Wedding, Parties, Business</span>
								<p>View tariff packages for Corporate event, Birthday party, Wedding, engagement, etc.
								</p>
							</div>
					</div>
					</a>
				</div>
				<div class="col-md-4 col-sm-6 col-xs-12 wow fadeIn" data-wow-offset="50" data-wow-delay="1.6s">
					<div class="team-wrapper"
						style="border: 1px solid gray;box-shadow: 0px 0px 10px gray;">
						<a href="displaylocation.php?selected=Photographer"><img src="images/photography.jpg"
								class="img-responsive" style="height:200px;">
							<div class="team-des">
								<h4>PHOTOGRAPHER</h4>
								<span>Hire Photographers & Videographers</span>
								<p>Find the best professional photographers, videographers for events.</p>
							</div>
						</a>
					</div>
				</div>
				<div class="col-md-4 col-sm-6 col-xs-12 wow fadeIn" data-wow-offset="50" data-wow-delay="1.3s">
					<div class="team-wrapper" style="border: 1px solid gray;box-shadow: 0px 0px 10px gray;">
						<a href="displaylocation.php?selected=Editography"><img src="images/flex.jpg"
								class="img-responsive" style="height:200px;">
							<div class="team-des">
								<h4>EDITOGRAPHY</h4>
								<span>Online Flex Print Designer</span>
								<p>Get Instant quotes to Print Digital & Flex Banners Printing for events..</p>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end team -->
	<hr />
	<!-- start service -->
	<section id="service">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s">OUR <span>AWESOME</span> THINGS
					</h2>
				</div>
				<div class="col-md-4 active wow fadeIn" data-wow-offset="50" data-wow-delay="0.6s"
					style="border: 1px solid gray;box-shadow: 0px 0px 7px gray;margin-left: 20px;">
					<i class="fa fa-laptop"></i>
					<h4>Events</h4>
					<p>There are almost countless types of events, some are demanded frequently by customers, others
						seldom Find in-depth information about the most important types of events. Event ManagemenT
						presents and describes the diversity of the event planning industry.</p>
				</div>
				<div class="col-md-4 active wow fadeIn" data-wow-offset="50" data-wow-delay="0.9s"
					style="border: 1px solid gray;box-shadow: 0px 0px 7px gray;margin-left: 20px;">
					<i class="fa fa-cloud"></i>
					<h4>Photography</h4>
					<p>A photographer records events and tells stories using images. He or she takes pictures of people,
						places, events, and objects. Photographers often specialize in a type of photography. Portrait
						photographers take pictures of people in studios or on-site at various locations.</p>
				</div>
				<div class="col-md-4 active wow fadeIn" data-wow-offset="50" data-wow-delay="0.6s"
					style="border: 1px solid gray;box-shadow: 0px 0px 7px gray;margin-left: 20px;">
					<i class="fa fa-cog"></i>
					<h4>Editography</h4>
					<p>We provide the best hoarding and shop sign boards, event/elections publicity banner, cut-outs,
						bunt-ings..Our quality full color printing for outdoor is great for such things as real estate
						signs, campaign signs, yard signs, banners, window...</p>
				</div>
			</div>
		</div>
	</section>
	<!-- end servie -->
	<hr />
	<!-- start contact -->
	<section id="contact">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<h2 class="wow bounceIn" data-wow-offset="10" data-wow-delay="0.3s">&nbsp;</h2>

					<address>
						<span></span>
						<p><i class="fa fa-phone"></i> +91 6360000063</p>
					</address>
				</div>
				<div class="col-md-4">
					<h2 class="wow bounceIn" data-wow-offset="10" data-wow-delay="0.3s">CONTACT <span>US</span></h2>

					<address>
						<span></span>
						<p><i class="fa fa-envelope-o"></i> contact@eventplanner.com</p>
					</address>
					<ul class="social-icon">
						<li>
							<h4>SOCIAL MEDIA</h4>
						</li>
						<li><a href="#" class="fa fa-facebook"></a></li>
						<li><a href="#" class="fa fa-twitter"></a></li>
						<li><a href="#" class="fa fa-instagram"></a></li>
					</ul>
				</div>
				<div class="col-md-4">
					<h2 class="wow bounceIn" data-wow-offset="10" data-wow-delay="0.3s">&nbsp;</h2>
					<address>
						<span></span>
						<p><i class="fa fa-map-marker"></i> Dreamora Events, Ahmedabad, 382350</p>
					</address>
				</div>
			</div>
		</div>
	</section>
	<!-- end contact -->
	<hr />
	<footer class="site-footer">
		<div class="footer-top">
			<div class="footer-container">
				<div class="footer-column">
					<h3>Dreamora</h3>
					<p>Ahmedabad<br>Gujarat, India</p>
					<p><strong>Phone:</strong> +91-1023456789<br>
						<strong>Email:</strong> dreamora16@gamil.com
					</p>
				</div>

				<div class="footer-column">
					<h4>Our Services</h4>
					<ul>
						<li><a href="#">› Home</a></li>
						<li><a href="#">› About</a></li>
						<li><a href="#">› Contact</a></li>
					</ul>
				</div>

				<div class="footer-column">
					<h4>Staff Login</h4>
					<p>This feature is Available only for Staff or Administrator</p>
					<button onclick="window.location='emplogin.php';">Click here to Login</button>
				</div>
			</div>
		</div>

		<div class="footer-bottom">
			<div class="footer-left">
				<p class="footername">© Copyright <strong>Dreamora Events</strong>. All Rights Reserved</p><br>
				<p class="footerDname"><strong>Developed By</strong> Henil Paneliya, Prachi Panchal, Krisha Devani,
					Pranali Khunt</p>
			</div>
			<div class="footer-social">
				<a href="#"><i class="bx bxl-twitter"></i></a>
				<a href="#"><i class="bx bxl-facebook"></i></a>
				<a href="https://www.instagram.com/dreamora_events/"><i class="bx bxl-instagram"></i></a>
				<a href="#"><i class="bx bxl-skype"></i></a>
				<a href="#"><i class="bx bxl-linkedin"></i></a>
			</div>
			<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
		</div>
	</footer>
</body>

</html>
<?php
		include ("footer.php");
?>