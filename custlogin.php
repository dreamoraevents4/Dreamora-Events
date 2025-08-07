<?php
error_reporting(E_ALL & ~E_NOTICE  &  ~E_STRICT  &  ~E_WARNING);
$con = mysqli_connect("localhost", "root", "", "eventplanner");
echo mysqli_connect_error();
?>
<?php
include("header.php");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Login with Instant Image Preview</title>
  <style>

.login_box{
  padding-left: 39%;
  padding-top: 5%;
}
    .login-container {
      width: 350px;
      background: #ffffff;
      padding: 40px 30px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.4);
    }

    .login-container h2 {
      text-align: center;
      margin-bottom: 15px;
      color: hotpink;
    }

    #preview {
      text-align: center;
      margin-bottom: 15px;
    }

    .profile-img {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      object-fit: cover;
      display: none;
      margin: 0 auto;
      border: 2px solid black;
    }

    .login-container label {
      font-weight: bold;
      color: #555555;
      margin-bottom: 5px;
      display: block;
    }

    .login-container input[type="text"],
    .login-container input[type="password"] {
      width: 100%;
      padding: 10px 12px;
      margin-bottom: 20px;
      border: 1px solid hotpink;
      border-radius: 5px;
      box-sizing: border-box;
      transition: border-color 0.3s ease;
    }

    .login-container input[type="text"]:focus,
    .login-container input[type="password"]:focus {
      border-color: pink;
      outline: none;
    }

    .login-container input[type="submit"] {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 5px;
      background-color: hotpink;
      color: #ffffff;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .login-container input[type="submit"]:hover {
      background-color: pink;
    }
     @media (max-width: 480px) {
      .login-container {
        padding: 25px 20px;
      }

      .profile-img {
        width: 100px;
        height: 100px;
      }
    }
  </style>
</head>
<body>
  <div class="login_box">
  <div class="login-container">
    <h2>Login</h2>

    <!-- 👇 Image preview  -->
    <div id="preview">
      <img id="userImage" class="profile-img" src="">
    </div>

    <form method="post" action="login_action.php" autocomplete="off">
      <label for="email_id">Email ID:</label>
      <input type="text" name="email_id" id="email_id" required autocomplete="off">

      <label for="password">Password:</label>
      <input type="password" name="password" id="password" required autocomplete="new-password">

      <input type="submit" name="submit" value="Login">
    </form>
  </div></div>

  <script>
    document.getElementById("email_id").addEventListener("input", function () {
      var email = this.value;

      if (email.length >= 5) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "fetch_image.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onload = function () {
          if (this.status === 200) {
            var response = this.responseText.trim();
            if (response !== "NOT_FOUND") {
              document.getElementById("userImage").src = "uploads/" + response;
              document.getElementById("userImage").style.display = "block";
            } else {
              document.getElementById("userImage").style.display = "none";
            }
          }
        };
        xhr.send("email_id=" + encodeURIComponent(email));
      } else {
        document.getElementById("userImage").style.display = "none";
      }
    });
  </script>
  
</body>
</html>
<br/>
<br/>
<br/>
<br/> 
<?php
include("footer.php")
?>