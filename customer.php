<?php
include("header.php");

if (isset($_POST['submit'])) {
    $customer_name = mysqli_real_escape_string($con, $_POST['customer_name']);
    $email_id = mysqli_real_escape_string($con, $_POST['email_id']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $contactno = mysqli_real_escape_string($con, $_POST['contactno']);
    $status = mysqli_real_escape_string($con, $_POST['status']);

    // Handle photo upload
    $photo = '';
    if ($_FILES['photo']['name'] != "") {
        $photo = time() . "_" . basename($_FILES["photo"]["name"]);
        $target_dir = "imgcustomer/";
        $target_file = $target_dir . $photo;
        move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
    }

    if (isset($_GET['editid'])) {
        // Update query
        $sql = "UPDATE customer SET 
            customer_name='$customer_name',
            email_id='$email_id',
            password='$password',
            address='$address',
            contactno='$contactno',
            status='$status'";

        if ($photo != "") {
            $sql .= ", photo='$photo'";
        }

        $sql .= " WHERE customer_id='{$_GET['editid']}'";
        $qsql = mysqli_query($con, $sql) or die("SQL Error: " . mysqli_error($con));

        if (mysqli_affected_rows($con) == 1) {
            echo "<script>alert('Customer record updated successfully.');</script>";
        }
    } else {
        // Insert query
        $sql = "INSERT INTO customer (customer_name, email_id, password, address, contactno, status, photo) 
                VALUES ('$customer_name', '$email_id', '$password', '$address', '$contactno', '$status', '$photo')";
        $qsql = mysqli_query($con, $sql) or die("SQL Error: " . mysqli_error($con));

        if (mysqli_affected_rows($con) == 1) {
            echo "<script>alert('Customer record inserted successfully.');</script>";
        }
    }
}

// Load record if editing
$rsedit = [];
if (isset($_GET['editid'])) {
    $sqledit = "SELECT * FROM customer WHERE customer_id='{$_GET['editid']}'";
    $qsqledit = mysqli_query($con, $sqledit) or die("SQL Error: " . mysqli_error($con));
    $rsedit = mysqli_fetch_array($qsqledit);
}
?>

<!-- start contact -->
<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s">
                    <span>Customer Detail</span>
                </h2>
            </div>

            <div class="col-md-8 col-sm-8 col-xs-8 wow fadeInLeft col-md-offset-2" data-wow-offset="50" data-wow-delay="0.9s">
                <form action="" method="post" enctype="multipart/form-data" name="frm" onsubmit="return validateform()">

                    <label>Customer Name <span id="idcustomername" style='color:red'></span></label>
                    <input name="customer_name" type="text" class="form-control" id="customer_name"
                        value="<?php echo isset($rsedit['customer_name']) ? $rsedit['customer_name'] : ''; ?>">

                    <label>Email ID <span id="idemailid" style='color:red'></span></label>
                    <input name="email_id" type="text" class="form-control" id="email_id"
                        value="<?php echo isset($rsedit['email_id']) ? $rsedit['email_id'] : ''; ?>">

                    <label>Password <span id="idpassword" style='color:red'></span></label>
                    <input name="password" type="password" class="form-control" id="password"
                        value="<?php echo isset($rsedit['password']) ? $rsedit['password'] : ''; ?>">

                    <label>Confirm Password <span id="idcpassword" style='color:red'></span></label>
                    <input type="password" name="cpassword" class="form-control"
                        value="<?php echo isset($rsedit['password']) ? $rsedit['password'] : ''; ?>">

                    <label>Address <span id="idaddress" style='color:red'></span></label>
                    <textarea name="address" class="form-control"
                        id="address"><?php echo isset($rsedit['address']) ? $rsedit['address'] : ''; ?></textarea>

                    <label>Contact No. <span id="idcontactno" style='color:red'></span></label>
                    <input name="contactno" type="text" class="form-control" id="contactno"
                        value="<?php echo isset($rsedit['contactno']) ? $rsedit['contactno'] : ''; ?>">

                    <label>Status <span id="idstatus" style='color:red'></span></label>
                    <select name="status" class="form-control">
                        <option value="">Select</option>
                        <?php
                        $arr = array("Active", "Inactive");
                        foreach ($arr as $value) {
                            $selected = (isset($rsedit['status']) && $rsedit['status'] == $value) ? "selected" : "";
                            echo "<option value='$value' $selected>$value</option>";
                        }
                        ?>
                    </select>

                    <label>Photo</label>
                    <input type="file" name="photo" class="form-control">
                    <?php
                    if (!empty($rsedit['photo'])) {
                        echo "<img src='imgcustomer/{$rsedit['photo']}' width='100' style='margin-top:10px; border-radius:50%;'>";
                    }
                    ?>

                    <br><br>
                    <input type="submit" name="submit" class="form-control btn btn-success" value="Submit">

                </form>
            </div>
        </div>
    </div>
</section>
<!-- end contact -->

<?php include("footer.php"); ?>

<script>
function validateform() {
    var numericExpression = /^[0-9]+$/;
    var alphaSpaceExp = /^[a-zA-Z\s]+$/;
    var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-Z0-9]{2,4}$/;

    var i = 0;
    document.querySelectorAll("span").forEach(span => span.innerHTML = "");

    if (!document.frm.customer_name.value.match(alphaSpaceExp)) {
        document.getElementById("idcustomername").innerHTML = "Customer name should contain only alphabets.";
        i = 1;
    }
    if (document.frm.customer_name.value == "") {
        document.getElementById("idcustomername").innerHTML = "Customer name should not be empty.";
        i = 1;
    }
    if (!document.frm.email_id.value.match(emailExp)) {
        document.getElementById("idemailid").innerHTML = "Enter a valid Email ID.";
        i = 1;
    }
    if (document.frm.password.value.length < 8) {
        document.getElementById("idpassword").innerHTML = "Password should be at least 8 characters.";
        i = 1;
    }
    if (document.frm.cpassword.value != document.frm.password.value) {
        document.getElementById("idcpassword").innerHTML = "Passwords do not match.";
        i = 1;
    }
    if (document.frm.address.value == "") {
        document.getElementById("idaddress").innerHTML = "Address should not be empty.";
        i = 1;
    }
    if (!document.frm.contactno.value.match(numericExpression) || document.frm.contactno.value.length != 10) {
        document.getElementById("idcontactno").innerHTML = "Contact must be 10 digits.";
        i = 1;
    }
    if (document.frm.status.value == "") {
        document.getElementById("idstatus").innerHTML = "Please select status.";
        i = 1;
    }

    return i === 0;
}
</script>
