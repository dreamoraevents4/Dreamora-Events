<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "eventplanner");

if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($con, $_POST['email_id']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $query = "SELECT * FROM customer WHERE email_id = '$email' AND password = '$password'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $customer_name = $row['customer_name'];
        $_SESSION['customer_id']   = $row['customer_id'];
        $_SESSION['customer_name'] = $row['customer_name'];
        
        // Set session values
        $_SESSION['email_id'] = $email;
        $_SESSION['customer_name'] = $customer_name;

        // Success Alert + Redirect to custaccount.php
        echo "
        <script>
            alert('Login Successful,\\nWelcome to Dreamora Event,\\n \\t $customer_name! 👋');
            window.location.href = 'customeraccount.php';
        </script>";
    } else {
        // Failure Alert + Back to login
        echo "
        <script>
            alert('Invalid login!\\nIncorrect email or password.');
            window.location.href = 'custlogin.php';
        </script>";
    }
}
?>
