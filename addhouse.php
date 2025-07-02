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
    <title>Add House</title>
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
  padding: 10px;
  margin: 5px 0 10px 0;
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
  margin: 5px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}
.option {
  position: relative;
  left: 200px;
  top: -20px; 
  line-height: 20px;
  width: 150px;
  height: 25px;
}
button:hover {
  opacity:1;
}
label{
    font-size: 13px;;
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
    font-size: 13px;;
}
.modal-content {
  background-color: white;
  margin: 1% 0% 0% 25%;
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
    margin-top: 1px;;
    margin-bottom:1px;
    padding: 5px;
    font-size:25px;
  text-align: center;
  background: tomato;
  color: white;
}
.custom-file-input::-webkit-file-upload-button {
  visibility: hidden;
}
.custom-file-input::before {
  content: 'Select house images';
  border: 1px solid #999;
  border-radius: 3px;
  padding: 5px 8px;
  font-weight: 700;
  font-size: 10pt;
}
.custom-file-input:hover::before {
  border-color: black;
}
.custom-file-input:active::before {
  background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9);
}
</style>
  </head>
<body>
<?php
if (isset($_POST['submit'])){
    $namesess = mysqli_real_escape_string($con, $_POST['name']);
    if($namesess!=$_SESSION['name']){
        ?>
        <script>
        alert("email incorrect or it is not yours !");
        </script>
        <?php
    } 
    else{
        $description = mysqli_real_escape_string($con, $_POST['description']);
        $cost = mysqli_real_escape_string($con, $_POST['cost']);
        $city= mysqli_real_escape_string($con, $_POST['city']);
        $type = mysqli_real_escape_string($con, $_POST['type']);
        $latitude = mysqli_real_escape_string($con, $_POST['latitude']);
        $longitude = mysqli_real_escape_string($con, $_POST['longitude']);


        if (!file_exists("upload/".$namesess)) {
            mkdir("upload/".$namesess,0755, true);
        }

        $name = $_FILES['image1']['name'];
        $target_dir = "upload/".$namesess."/";
        $target_file = $target_dir . basename($_FILES["image1"]["name"]);
        $name2 = $_FILES['image2']['name'];
        $target_file2 = $target_dir . basename($_FILES["image2"]["name"]);
        $name3 = $_FILES['image3']['name'];
        $target_file3 = $target_dir . basename($_FILES["image3"]["name"]);
    
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $imageFileType2 = strtolower(pathinfo($target_file2,PATHINFO_EXTENSION));
        $imageFileType3= strtolower(pathinfo($target_file3,PATHINFO_EXTENSION));

        $extensions_arr = array("jpg","jpeg","png","gif");

        if( in_array($imageFileType,$extensions_arr)&& in_array($imageFileType2,$extensions_arr)&&in_array($imageFileType3,$extensions_arr)){
            if(move_uploaded_file($_FILES['image1']['tmp_name'],$target_dir.$name )&& move_uploaded_file($_FILES['image2']['tmp_name'],$target_dir.$name2)&&move_uploaded_file($_FILES['image3']['tmp_name'],$target_dir.$name3)){
                $query= "insert into houses(email,description,cost,city,type,latitude,longitude,img1,img2,img3) values('$namesess','$description','$cost','$city','$type','$latitude','$longitude','".$name."','".$name2."','".$name3."')";
                if(!mysqli_query($con,$query)){
                    ?>
                    <script>
                    alert("Not added");
                    </script>
                    <?php

                }else{
                    ?>
                    <script>
                    alert("Successful");
                    location.replace("owner.php");
                    </script>
                    <?php
                } 
            }else{
                ?>
                <script>
                alert("files not uploaded");
                </script>
                <?php
            }
        }else{
            ?>
            <script>
            alert("upload images only");
            </script>
            <?php
        }
    }
}
?>

  <form class="modal-content" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data"  method="POST">
    <div class="container">
      <center><h1 class="h11">Add House</h1></center>
      <hr>
      <label for="email"><b>Your Name</b></label>
      <input type="text" placeholder="Enter Name" name="name" required>
      <label for="description"><b>Description</b></label>
      <input type="text" placeholder="Enter Description" name="description" required>
      <label for="Cost"><b>Rent</b></label>
      <input type="text" placeholder="Enter Cost" name="cost" required>
      <label for="latitude"><b>Rent</b></label>
      <input type="text" placeholder="Enter Latitude" name="latitude" required>
      <label for="longitude"><b>Rent</b></label>
      <input type="text" placeholder="Enter Longitude" name="longitude" required>
      <h4 >City</h4>
        <select class="option" name="city" required>
					<option disabled="disabled" selected="selected">Choose</option>
					<option>Guntur</option>
					<option>Vijayawada</option>
          <option>Vizag</option>
          <option>Nellore</option>
				</select>
        
      <h4 >Type of House</h4>
        <select class="option" name="type" required>
					<option disabled="disabled" selected="selected">Choose</option>
					<option>1BHK</option>
                    <option>2BHK</option>
					<option>3BHK</option>
                    <option>Individual House</option>
                    <option>Duplex</option>
					<option>Villa</option>
				</select><br>
                    <label for="image3"><b>Upload image1</b></label>
                        <input type="file" class="custom-file-input" name="image1" id="image">
                        <label for="image3"><b>Upload image2</b></label>
                        <input type="file" class="custom-file-input" name="image2" id="image">
                        <label for="image3"><b>Upload image3</b></label>
                        <input type="file" class="custom-file-input" name="image3" id="image">
          <div class="clearfix">
        <button type="submit" name="submit">Add</button>
        <button name="cancel"><a href="owner.php" style="text-decoration:none;color:white;">Cancel</a></button>
      </div>
    </div>
  </form>
</body>
</html>