<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_WARNING);
$con = mysqli_connect("localhost", "root", "", "eventplanner");
mysqli_set_charset($con, "utf8"); // Handle special characters like apostrophes(')
echo mysqli_connect_error();
?>

<?php include("header.php");

if (isset($_POST['submitregister'])) {
	$name = mysqli_real_escape_string($con, $_POST['name']);
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$pass = mysqli_real_escape_string($con, $_POST['pass']);
	$address = mysqli_real_escape_string($con, $_POST['address']);
	$contactno = mysqli_real_escape_string($con, $_POST['contactno']);
	$image_name = rand() . "_" . $_FILES["photo"]["name"];
	$temp = isset($_FILES["photo"]["tmp_name"]) ? $_FILES["photo"]["tmp_name"] : '';
	$folder = "uploads/" . $image_name;

	if (!is_dir("uploads")) {
		mkdir("uploads");
	}

	if (!empty($temp) && is_uploaded_file($temp)) {
		if (move_uploaded_file($temp, $folder)) {
			$sql = "INSERT INTO customer (customer_name, email_id, password, contactno, address, photo, status) 
					VALUES ('$name', '$email', '$pass', '$contactno', '$address', '$image_name', 'Active')";
			$qsql = mysqli_query($con, $sql);

			if ($qsql && mysqli_affected_rows($con) == 1) {
				echo "<script>alert('Registration successful!');</script>";
				echo "<script>window.location='custlogin.php';</script>";
			} else {
				echo "<p style='color:red;'>Something went wrong. " . mysqli_error($con) . "</p>";
			}
		} else {
			echo "<p style='color:red;'>Image upload failed!</p>";
		}
	} else {
		echo "<p style='color:red;'>No image selected or upload error!</p>";
	}
}
?>

<style>
	section#contact {
		padding: 5px 0;
		background-color: #fff;
	}

	h2 {
		text-align: center;
		font-size: 36px;
		color: #333;
		margin-bottom: 40px;
		position: relative;
	}

	h2 span {
		color: hotpink;
	}

	form {
		background-color: #ffffff;
		padding: 30px;
		border-radius: 16px;
		box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
	}

	label {
		font-weight: 600;
		margin-top: 15px;
		display: block;
		color: #333;
	}

	input.form-control,
	textarea.form-control {
		width: 100%;
		padding: 12px;
		margin-top: 8px;
		margin-bottom: 12px;
		border: 1px solid #ccc;
		border-radius: 8px;
		box-sizing: border-box;
		transition: border-color 0.3s;
	}

	input.form-control:focus,
	textarea.form-control:focus {
		border-color: hotpink;
		outline: none;
	}

	input[type="submit"].form-control {
		background-color: hotpink;
		color: #fff;
		font-weight: bold;
		border: none;
		cursor: pointer;
		transition: background-color 0.3s ease;
	}

	input[type="submit"].form-control:hover {
		background-color: pink;
	}

	input[type="file"]{
		display: block;
		margin-top: 1px;
		padding: 10px;
		width: 100%;
		border: 2px dashed hotpink;
		border-radius: 15px;
		color: #333;
		transition: background 0.3s;
	}

	input[type="file"]:hover {
		background-color:hotpink;
	}

	.errdisplay {
		font-size: 13px;
		padding-left: 10px;
	}

	.address-title {
		font-size: 22px;
		font-weight: bold;
		color: #333;
		margin-bottom: 20px;
	}

	ul.social-icon {
		list-style-type: none;
		padding: 0;
	}

	ul.social-icon li {
		margin-bottom: 15px;
	}

	ul.social-icon li input[type="submit"] {
		width: 100%;
		padding: 12px;
		background-color: pink;
		color: white;
		font-weight: bold;
		border: none;
		border-radius: 8px;
		cursor: pointer;
		transition: background-color 0.3s;
	}

	ul.social-icon li input[type="submit"]:hover {
		background-color: pink;
	}
</style>


<!-- start contact -->
<section id="contact">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s">REGISTER <span>PANEL</span></h2>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12 wow fadeInLeft" data-wow-offset="50" data-wow-delay="0.9s">
				<form action="" method="post" name="frmform" onsubmit="return validateform()" enctype="multipart/form-data">

					<label>Name</label><span id="idname" class="errdisplay"></span>
					<input name="name" type="text" class="form-control" id="name">

					<label>Email ID</label><span id="idemail" class="errdisplay"></span>
					<input name="email" type="text" class="form-control" id="email">

					<label>Password</label><span id="idpass" class="errdisplay"></span>
					<input name="pass" type="password" class="form-control" id="pass">

					<label>Confirm Password</label><span id="idconfirm" class="errdisplay"></span>
					<input name="confirm" type="password" class="form-control" id="confirm">

					<label>Contact</label><span id="idcontactno" class="errdisplay"></span>
					<input name="contactno" type="text" class="form-control" id="contactno">

					<label>Address</label><span id="idaddress" class="errdisplay"></span>
					<textarea name="address" class="form-control" id="address"></textarea>

					<label>Select image:</label>
					<input type="file" name="photo" required><br>

					<input type="submit" name="submitregister" class="form-control" value="Click here to Register">
				</form>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12 wow fadeInRight" data-wow-offset="50" data-wow-delay="0.6s">
				<address>
					<p class="address-title">Existing User</p>
				</address>
				<ul class="social-icon">
					<li><input type="submit" class="form-control" value="Click here to Login" onclick="window.location='custlogin.php'"></li>
				</ul>
			</div>
		</div>
	</div>
</section>
<!-- end contact -->

<?php include("footer.php"); ?>

<script>
	function validateform() {
		var numericExpression = /^[0-9]+$/;
		var alphaspaceExp = /^[a-zA-Z\s]+$/;
		var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-Z0-9]{2,6}$/;

		var confirmreturn = "true";
		$(".errdisplay").html("");

		if (!document.getElementById("name").value.match(alphaspaceExp)) {
			document.getElementById("idname").innerHTML = "Name should contain alphabets...";
			confirmreturn = "false";
		}
		if (document.getElementById("name").value == "") {
			document.getElementById("idname").innerHTML = "Name should not be empty..";
			confirmreturn = "false";
		}
		if (!document.getElementById("email").value.match(emailExp)) {
			document.getElementById("idemail").innerHTML = "Entered Email ID is not in valid format...";
			confirmreturn = "false";
		}
		if (document.getElementById("email").value == "") {
			document.getElementById("idemail").innerHTML = "Email ID should not be empty..";
			confirmreturn = "false";
		}
		if (document.getElementById("pass").value.length < 8) {
			document.getElementById("idpass").innerHTML = "Password should contain more than 8 characters...";
			confirmreturn = "false";
		}
		if (document.getElementById("pass").value == "") {
			document.getElementById("idpass").innerHTML = "Password should not be empty..";
			confirmreturn = "false";
		}
		if (document.getElementById("pass").value != document.getElementById("confirm").value) {
			document.getElementById("idconfirm").innerHTML = "Password and Confirm password not matching....";
			confirmreturn = "false";
		}
		if (document.getElementById("confirm").value == "") {
			document.getElementById("idconfirm").innerHTML = "Confirm password should not be empty..";
			confirmreturn = "false";
		}
		if (document.getElementById("contactno").value.length != 10 || !document.getElementById("contactno").value.match(numericExpression)) {
			document.getElementById("idcontactno").innerHTML = "Contact number should be 10 digits only...";
			confirmreturn = "false";
		}
		if (document.getElementById("contactno").value == "") {
			document.getElementById("idcontactno").innerHTML = "Contact number should not be empty..";
			confirmreturn = "false";
		}

		return confirmreturn === "true";
	}
</script>