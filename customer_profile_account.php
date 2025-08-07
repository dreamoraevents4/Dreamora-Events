<?php
include 'header_for_customer_profile.php';
$con = new mysqli("localhost", "root", "", "eventplanner");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
session_start();

if (!isset($_SESSION['customer_id'])) {
    echo "<script>alert('Please login first.');window.location='custlogin.php';</script>";
    exit();
}

$id = $_SESSION['customer_id'];
$sql = "SELECT * FROM customer WHERE customer_id=$id";
$res = $con->query($sql);
$data = $res->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  <style>
        * {
      box-sizing: border-box;
    }
    body {
      font-family: Arial, sans-serif;
      color: #333;
    }
    .profile-container {
      max-width: 800px;
      margin-left: 470px;
      margin-top: 60px;
      padding: 20px;
      background-color: rgba(255, 255, 255, 0.63);
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.82);
    }
h2 {
    margin-bottom: 20px;
    text-align: center;
    color: Black;
}
    table {
      width: 100%;
      border-collapse: collapse;
    }
    th, td {
      padding: 12px;
      text-align: left;
      border-bottom: 1px solid rgba(6, 15, 2, 0.1);
    }
    th {
      background-color: #f4f4f406;
    }
    td{
        background-color: #f4f4f405;
    }
     /* Responsive Design */
    @media (max-width: 1024px) {
      .profile-container {
        margin-top: 50px auto;
        padding: 18px;
      }

      h2 {
        font-size: 24px;
      }

      th, td {
        font-size: 15px;
      }

      .profile-photo {
        width: 130px;
        height: 130px;
      }
    }

    @media (max-width: 768px) {
      .profile-container {
        margin: 50px auto;
        padding: 15px;
      }

      h2 {
        font-size: 22px;
      }

      th, td {
        display: block;
        width: 100%;
        text-align: left;
        padding: 8px 0;
        font-size: 14px;
      }

      table {
        border: none;
      }

      th {
        background-color: transparent;
        border: none;
      }

      td {
        border-bottom: 1px solid #ccc;
      }
    }

    @media (max-width: 480px) {
      .profile-container {
        margin: 40px 10px;
        padding: 10px;
      }

      h2 {
        font-size: 20px;
      }

      .profile-photo {
        width: 100px;
        height: 100px;
      }

      th, td {
        font-size: 13px;
      }
    }
  </style>
  </head>
<body style="background: url('hannah-shedrow-PoisoMav1Jg-unsplash.jpg');background-size: cover; background-position: center;">
<section>
  <div class="profile-container">
    <h2>Welcome, <?= htmlspecialchars($data['customer_name']) ?></h2>
    <table>
        <tr><img src="uploads/<?= $data['photo'] ?>" alt="Profile Photo" style="width: 150px; height: 150px; border-radius: 50%;margin-left: 40%;border: 2px solid black;"></tr><br><br><br><br>
        <tr><th>Name:</th><td><?= $data['customer_name'] ?></td></tr>
        <tr><th>Address:</th><td><?= $data['address'] ?></td></tr>
        <tr><th>Mobile Number:</th><td><?= $data['contactno'] ?></td></tr>
        <tr><th>Email ID:</th><td><?= $data['email_id'] ?></td></tr>
    </table>
</div>
</section>
  </hr>
</body>
</html>
<?php include 'footer.php'; ?>