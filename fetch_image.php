<?php
$con = mysqli_connect("localhost", "root", "", "eventplanner");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email_id'])) {
    $email = mysqli_real_escape_string($con, $_POST['email_id']);

    $query = "SELECT photo FROM customer WHERE email_id = '$email' LIMIT 1";
    $result = mysqli_query($con, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        echo $row['photo']; // only image file name
    } else {
        echo "NOT_FOUND";
    }
}
?>
