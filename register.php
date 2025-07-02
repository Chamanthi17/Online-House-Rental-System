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
  <title>Register</title>
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
  margin: 2% 0% 0% 25%;
  border: 1px solid #888;
  width: 50%; 
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
  $name = mysqli_real_escape_string($con, $_POST['name']);
  $mailid = mysqli_real_escape_string($con, $_POST['email']);
  $password = mysqli_real_escape_string($con, $_POST['password']);
  $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
  $prof = mysqli_real_escape_string($con, $_POST['role']);
  $pass = password_hash($password, PASSWORD_BCRYPT);
  $cpass = password_hash($cpassword, PASSWORD_BCRYPT);
  $emailQuery = " select * from register where mailid='$mailid'";
  $query = mysqli_query($con, $emailQuery);
  $emailcount = mysqli_num_rows($query);
  if ($emailcount > 0) {
?>
    <script>
    alert("email already exists");
          location.replace("index.php");
    </script>
    <?php
  }
  else {
    if ($password === $cpassword) {
      $insertquery = "insert into register(name, mailid, password, cpassword, prof) 
            values('$name','$mailid','$pass','$cpass','$prof')";
      $iquery = mysqli_query($con, $insertquery);
      if ($iquery) {
        $_SESSION['mail'] = $mailid;
        $_SESSION['name'] = $name;
        $_SESSION['prof'] = $prof;
        if ($prof == 'Renter') {
?>
          <script>
          alert("Connection Success");
          location.replace("renter.php");
          </script>
          <?php
        }
        else {
?>
          <script>
          alert("Connection Success");
          location.replace("owner.php");
          </script>
          <?php
        }
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
}
?>
  <form class="modal-content" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
    <div class="container">
      <center><h1 class="h11" ">Registration form</h1></center>
      <hr>
      <label for="name"><b>Name</b></label>
      <input type="text" placeholder="Enter Name" name="name" required>
      <label for="email"><b>Email</b></label>
      <input type="text" placeholder="Enter Email" name="email" required>
      <label for="password"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>
      <label for="cpassword"><b>Repeat Password</b></label>
      <input type="password" placeholder="Confirm Password" name="cpassword" required>
      <h4 >Owner or Renter</h4>
        <select class="option" name="role">
					<option disabled="disabled" selected="selected">Choose</option>
					<option> Owner</option>
					<option> Renter</option>
				</select>
      <div class="clearfix">
        <button type="submit" name="submit"> Sign Up</button>
        <button name="cancel"><a href="index.php" style="text-decoration:none;color:white;">Cancel</a></button>
     </div>
    </div>
  </form>
</body>
</html>