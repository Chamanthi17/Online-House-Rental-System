<?php
$server = "localhost";
$user = "root";
$password = "";
$db = "rental_house";
$con = mysqli_connect($server, $user, $password, $db);
session_start();
?><!DOCTYPE html>
<html lang="en">
<head>
<title>Details</title>
<style>
* {
  box-sizing: border-box;
}

body {
  font-family: Arial, Helvetica, sans-serif;
  margin: 0;
}

.header {
background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(img1.jpg);
  padding: 10px;
  text-align: center;
color:white;
  background-position: center;
}

.header h1 {
  font-size: 30px;
}

.footer a {
  float: left;
  display: block;
  color: black;
  text-align: center;
  padding: 14px 20px;
  text-decoration: none;
}
.footer a.right {
  float: right;
}
.footer a:hover {
  background-color: #ddd;
  color: black;
}


.main {   
  -ms-flex: 70%; /* IE10 */
  flex: 70%;
  background-color: white;
  padding: 1000px;
}

body {
    font-family: Arial, Helvetica, sans-serif;
  }
 
  .navbar {
    overflow: hidden;
    background-color: grey;;
  }
  
  .navbar a {
    float: left;
    font-size: 16px;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
  }
  
  .dropdown {
    float: left;
    overflow: hidden;
  }
  
  .dropdown .dropbtn {
    font-size: 16px;
    border: none;
    outline: none;
    color: white;
    padding: 14px 16px;
    background-color: inherit;
    font-family: inherit;
    margin: 0;
  }
  
  .navbar a:hover,
  .dropdown:hover .dropbtn {
    background-color: #ddd;
    color: black;
  }
  
  .dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
  }
  
  .dropdown-content a {
    float: none;
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
  }
  
  .dropdown-content a:hover {
    background-color: #ddd;
  }
  
  .dropdown:hover .dropdown-content {
    display: block;
  }
  .house-preview{
   margin: 1px 12px;
    width:30%;
  height : auto;
  border-color: #ddd;

  }

button{
  background-color: #4CAF50;
  color: white;
  padding: 10px 18px;
  margin: 3px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}
.ba{
  color:white;
  text-decoration: none;
  padding: 10px;
  font-size: 18px;;
}
table{
  width:500px;
  margin-left: 30px;
}
td{
  padding:0px 3px;
}
</style>
</head>
<body>
<?php
$a=$_SESSION['name'];
$obhk="1BHK";
  $tbhk="2BHK";
  $thbhk="3BHK";
  $indi="Individual House";
  $dup="Duplex";
  $vill="Villa";
  $gnt="Guntur";
  $vij="Vijayawada";
  $viz="Vizag";
  $nlr="Nellore";
  $thou="1000";
  $three="3000";
  $six="6000";
  $email=$_GET['email'];
  $description=$_GET['description'];
  $img1=$_GET['img1'];
  $query="SELECT * FROM houses WHERE email='".$email."' AND description='".$description."'AND img1='".$img1."'";
  $query_run=mysqli_query($con,$query);
  
?>
<div class="header">
  <h1>Online Rental house management system</h1>

</div>
<div class="navbar">
<?php

 $prof=$_SESSION['prof'] ;
 if($prof=="Owner"){
     echo "<a href='owner.php'>Home</a>";
 
     echo "<a href='myhouse.php'>My Houses</a>";
     echo "<a href='addhouse.php'>Add House</a>";
     echo "<a href='updatehouse.php'>Update House</a>";
  }else{
 echo "<a href='renter.php'>Home</a>";
 }
 ?>

<div class="dropdown">
      <button class="dropbtn">
        Location
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-content">
        <a href="location.php?location=<?php echo $gnt ?>">Guntur</a>
        <a href="location.php?location=<?php echo $vij ?>">Vijaywada</a>
        <a href="location.php?location=<?php echo $viz?>">Vizag</a>
        <a href="location.php?location=<?php echo $nlr ?>">Nellore</a>
      </div>
    </div>
    <div class="dropdown">
      <button class="dropbtn">
        House Type
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-content">
        <a href="type.php?type=<?php echo $obhk ?>">1BHK</a>
        <a href="type.php?type=<?php echo $tbhk ?>">2BHK</a>
        <a href="type.php?type=<?php echo $thbhk ?>">3BHK</a>
        <a href="type.php?type=<?php echo $indi ?>">Individual House</a>
        <a href="type.php?type=<?php echo $dup ?>">Duplex</a>
        <a href="type.php?type=<?php echo $vill ?>">Villa</a>
      </div>
    </div>
    <div class="dropdown">
      <button class="dropbtn">
         Cost Range
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-content">
        <a href="cost.php?gt=<?php echo $thou ?>">greater than 1000</a>
        <a href="cost.php?gt=<?php echo $three ?>">greater than 3000</a>
        <a href="cost.php?gt=<?php echo $six ?>">greater than 6000</a>
      </div>
      
    </div>
    
    <a href="logout.php" style="float:right;">Logout</a>
    <a href="#" style="float:right;">Welcome <?php echo $a;?></a>
  </div>
  </div>
  <?php 
if($query_run){
  while($row = mysqli_fetch_assoc($query_run))
    {
$cost=$row['cost'];
$type=$row['type'];
$img2 = $row['img2'];
$img3 = $row['img3'];
$city=$row['city'];
$lati=$row['latitude'];
$longi=$row['longitude'];
$image_src1 = "upload/".$email."/".$img1;
$image_src2 = "upload/".$email."/".$img2;
$image_src3 = "upload/".$email."/".$img3;
$query2="SELECT * FROM register WHERE name='".$email."' ";
$query_run2=mysqli_query($con,$query2);
$row2 = mysqli_fetch_assoc($query_run2);
$to=$row2['mailid'];
$own=$row2['name'];
?>
<center><h3> Details</h3></center>
<hr>
<center>
<img class="house-preview" src='<?php echo $image_src1;?>' alt="" />
        <img class="house-preview" src='<?php echo $image_src2;?>' alt="" />
        <img class="house-preview" src='<?php echo $image_src3;?>' alt="" />
      <center>
  <table><tr><td>
  <p><b>Description:</b></p></td>
  <td><p><?php echo $description;?></p></td>
  </tr><tr>
      <td> <p><b>Type:</b></p></td>
      <td><p><?php echo $type;?></p></td>
    
      <td>   <p><b>City:</b></p></td>
      <td><p><?php echo $city;?></p></td></tr><tr>
      <td> <p><b>Cost:</b></p></td>
      <td><p>₹<?php echo $cost;?></p></td>
      <td> <p><b>Owner:</b></p></td>
      <td><p><?php echo $own;?></p></td>
    </tr>
    <tr><td colspan="4">
        <div class="mailto">
          <button><a class="ba" href="mailto:<?php echo $to; ?>" >Mail to owner</a>
          </button><br>
          <button><a class="ba" href="https://www.google.com/maps/search/?api=1&query=<?php echo $lati; ?>,<?php echo $longi; ?>"target="_blank" >View On Maps</a>
          </button>
        </div></td>     
    </tr>
  </table>
      </center>  
      
    <?php } }
    ?>

</body>
</html>