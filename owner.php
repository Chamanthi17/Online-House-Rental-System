<?php
$server="localhost";
$user="root";
$password="";
$db="rental_house";
$con=mysqli_connect($server,$user,$password,$db);
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>

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
  .house {
    display: inline-block;
    position: relative;
    width: 400px;
    min-width: 400px;
    height: 400px;
    border-radius: 30px;
    overflow: hidden;
    box-shadow: 5px 5px 30px rgba(0, 0, 0, 0.3);
    margin: 20px;
}

.house-preview {
    height: 60%;
}

.house-description-bk {
    background-image: linear-gradient(0deg, #3f5efb, #fc466b);
    border-radius: 30px;
    position: absolute;
    top: 55%;
    left: -5px;
    height: 65%;
    width: 108%;
    transform: skew(19deg, -9deg);
}

.house-description-bk {
    background-image: linear-gradient(-20deg, #bb7413, #e7d25c);
}

.house-description {
    position: absolute;
    color: #fff;
    font-weight: 900;
    left: 150px;
    bottom: 26%;
}

.detailed {
    position: absolute;
    color: #fff;
    right: 30px;
    bottom: 10%;
    padding: 10px 20px;
    border: 1px solid #fff;
}

.detailed a {
    color: #fff;
}

.price {
    position: absolute;
    color: #fff;
    left: 30px;
    bottom: 10%;
}

body {
    font-family: "Open Sans", sans-serif;
    margin: 0;
    background-color: #eee;
    min-height: 100vh;
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
  $query="select * from houses";
  $query_run=mysqli_query($con,$query);
  $namesess=$_SESSION['name'];
  ?>

<div class="header">
  <h1>Online Rental house management system</h1>

</div>

<div class="navbar">
    <a href="owner.php">Home</a>
    <a href="myhouse.php">My Houses</a>
    <a href="addhouse.php">Add House</a>
    <a href="updatehouse.php">Update House</a>
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
  <?php
    while($row = mysqli_fetch_array($query_run))
    {
$email=$row['email'];
$image = $row['img1'];
$description=$row['description'];
$cost=$row['cost'];
$image_src = "upload/".$email."/".$image;?>

<div class="house">
        <img class="house-preview" src='<?php echo $image_src;?>' alt="" />
        <div class="house-description-bk"></div>
        <div class="house-description">
            <p> <?php echo $description;?></p>
        </div>
        <div class="price">
            <p>₹<?php echo $cost;?></p>
        </div>
        <div class="detailed">
            <a href="viewdetails.php?email=<?php echo $email ;?>&description=<?php echo $description; ?>&img1=<?php echo $image;?>" style="text-decoration:none;color:white;">Click here</a>
        </div>
    </div>
    <?php } ?>
</body>
</html>