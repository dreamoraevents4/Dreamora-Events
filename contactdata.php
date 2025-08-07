<?php
// Step 1: Include your database config file
include("config.php");

// Step 2: Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Step 3: Get form data and sanitize
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Step 4: Insert into database
    $sql = "INSERT INTO contact (fullname, email, message) VALUES ('$fullname', '$email', '$message')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Message sent successfully!'); window.location='contact.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}
?>
