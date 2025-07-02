<?php
$server = "localhost";
$user = "root";
$password = "";
$db = "rental_house";
$con = mysqli_connect($server, $user, $password, $db);
session_start();
$email=$_GET["email"];
$description=$_GET["description"];
$img1=$_GET["img1"];

$query1="select * FROM houses WHERE email='".$email."' AND description='".$description."'AND img1='".$img1."'";
$query_run1=mysqli_query($con,$query1);
$row = mysqli_fetch_assoc($query_run1);
$img2 = $row['img2'];
$img3 = $row['img3'];
$image_src1 = "upload/".$email."/".$img1;
$image_src2 = "upload/".$email."/".$img2;
$image_src3 = "upload/".$email."/".$img3;
unlink($image_src1);
unlink($image_src2);
unlink($image_src3);
$query="delete FROM houses WHERE email='".$email."' AND description='".$description."'AND img1='".$img1."'";
$query_run=mysqli_query($con,$query);
if ($query_run ){
    ?>
        <script>
        alert("Successfully deleted");
              location.replace("owner.php");
        </script>
        <?php
      }
      else{
        ?>
        <script>
        alert("Not deleted");
              location.replace("owner.php");
        </script>
        <?php

      }
?>  