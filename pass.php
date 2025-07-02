<?php
$server = "localhost";
$user = "root";
$password = "";
$db = "rental_house";
$con = mysqli_connect($server, $user, $password, $db);
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
<style>
* {
  box-sizing: border-box;
  font-family: sans-serif;
}
body {
  width: 99%;
  height: 100%;
  background-image: linear-gradient(rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.75)), url(img1.jpg);
  background-size: cover;
  background-position: center;
}
input {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}
input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}
button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}
.option {
  position: relative;
  left: 200px;
  top: -27px; 
  line-height: 30px;
  width: 150px;
  height: 30px;
}
button:hover {
  opacity:1;
}
.container {
  padding: 10px;
}
h4 {
    display: block;
    margin-block-start: 1px;
    margin-block-end: 1px;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
    font-weight: bold;
}
.modal-content {
  background-color: white;
  margin: 10% 0% 0% 30%;
  border: 1px solid #888;
  width: 40%; 
}
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}
.clearfix::after {
  content: "";
  clear: both;
  display: table;
}
.h11{
    margin-top: 2px;;
    padding: 10px;
  text-align: center;
  background: tomato;
  color: white;
}
</style>
</head>
<body>
<?php
if (isset($_POST['submit'])) {
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);

    $pass = password_hash($password, PASSWORD_BCRYPT);
    $cpass = password_hash($cpassword, PASSWORD_BCRYPT);

    if ($password === $cpassword) {
        $e = $_SESSION['mail'];
        $updatequery = "update register set password='$pass' where mailid='$e'";
        $iquery = mysqli_query($con, $updatequery);
        if ($iquery) {
?>
          <script>
          alert("Password updated Successfully");
          location.replace("index.php");
          </script>
          <?php
        }
        else {
?>
          <script>
          alert("Not updated");
          </script>
          <?php
        }
    }
    else {
?>
      <script>
      alert("password  are not matching");
      </script>
      <?php
    }
}
?>
  <form class="modal-content" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
    <div class="container">
      <center><h1 class="h11" ">Reset Password</h1></center>
      <hr>
      <label for="password"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>
      <label for="cpassword"><b>Repeat Password</b></label>
      <input type="password" placeholder="Confirm Password" name="cpassword" required>
      <div class="clearfix">
        <button type="submit" name="submit"> Reset</button>
      </div>
    </div>
  </form>
</body>
</html>