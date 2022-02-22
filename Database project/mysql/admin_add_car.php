<?php
session_start(); 
include 'mysqlconnect.php'
?>
<!DOCTYPE html>
<html lang="en" style="background-color:rgb(244, 244, 244);">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABI CAR RENT</title>
</head>
  <body>
    <img src="img2/background.png" width="1920"  height="1080" style="position: absolute; left: 0px; top: 0px;">
    <img src="img2/greenbar.png" width="1920"  height="80" style="position: absolute; left: 0px; top: 0px;">
    <a href="carrent.page.php"><img src="img2/Logo.png" width="100"  height="40" style="position: absolute; left: 20px; top: 20px;"></a>
    <img src="img2/addcars.png" width="400"  height="80" style="position: absolute; left: 500px; top: 90px;">

  	<h2>Add cars or Increse the reserves</h2>
    <?php 
    if (isset($_SESSION['userId'])){
      $user_id = $_SESSION['userId'];
      $user_name = $_SESSION['user_name'];
      $sql_check = "SELECT * FROM user WHERE user_id = ".$user_id.";";
      $result = mysqli_query($con,$sql_check);
      while ($row = mysqli_fetch_assoc($result)) {
        if ($row['admin'] != 'admin'){
          header("Location: ../mysql/carrent.page.php?correction=success");
          exit();
        }
      }
      echo '<form action="logout.php" method="post">
      <button type="submit" name="logout" width="10" height="40" style="position: absolute; left: 1180px; top: 20px;">Logout</button>
    </form><form action="user_admin_page.php" method="post">
      <button type="submit" name="id" width="10" height="40" style="position: absolute; left: 1100px; top: 20px;">USER:'.$user_name.'</button></form>'; 
    } else {
      header("Location: ../mysql/Login.php?tranferd=success");
    } 
    echo '<form action="admin_add_car.php" method="post">
      <input type="text" name="car_name" placeholder="Car name" width="120" height="40" style="position: absolute; left: 600px; top: 240px;">
      <br>
      <input type="text" name="car_type" placeholder="Car type" width="120" height="40" style="position: absolute; left: 600px; top: 280px;">
      <br>
      <input type="text" name="status" placeholder="car_status" width="120" height="40" style="position: absolute; left: 600px; top: 320px;">
      <br>
      <input type="number" name="car_price" placeholder="Car price" width="120" height="40" style="position: absolute; left: 600px; top: 360px;">
      <br>
      <input type="number" name="car_available" placeholder="Car available number" width="120" height="40" style="position: absolute; left: 600px; top: 400px;">
      <br>
      <input type="text" name="loc" placeholder="Cars Location" height="40" style="position: absolute; left: 600px; top: 440px;">
      <br>
      <button type="submit"  name="submit" style="position: absolute; left: 600px; top: 480px;">Add the car</button>
      </form>';
    $sql_check = "SELECT * FROM cars;";
    $result = mysqli_query($con,$sql_check);
    $all_correct = true;
    $Car_name = $_POST['car_name'];
    $Car_type = $_POST['car_type'];
    $Car_status = $_POST['status'];
    $Car_price = $_POST['car_price'];
    $Car_available = $_POST['car_available'];
    $Car_location = $_POST['loc'];

    if (empty($Car_name) || empty($Car_type) || empty($Car_status) || empty($Car_price) || empty($Car_available) || empty($Car_location)){
    	echo "Please fill all of the boxes";
    	$all_correct = false;
    	exit();
    }

    while ($row = mysqli_fetch_assoc($result)) { //if this vcar in the system its increment it availability
        if ($row['car_name'] == $Car_name && $row['car_type'] == $Car_type && $row['car_price'] == $Car_price && $row['car_status'] == $Car_status && $row['car_price'] == $Car_price && $row['car_location'] == $Car_location) {
          $id = $row['car_id'];
          $sql_update = " UPDATE cars SET car_available= car_available + ".$Car_available." WHERE car_id=".$id.";";
          if ($con->query($sql_update) === TRUE){
            header("Location: ../mysql/carrent.page.php?add=success");
          }
          exit();
        }
    }
    if ($all_correct == true) {
      $sql_insert_car = " INSERT INTO cars (car_name,car_type,car_status,car_price,car_available,car_location)
      VALUES (?, ?, ?, ?, ?, ?);"; //<- sql code to insert data
      $statement = mysqli_stmt_init($con);
      if (!mysqli_stmt_prepare($statement, $sql_insert_car)){
          echo "There is a problem in database";
          exit();
      } else {
        mysqli_stmt_bind_param($statement, "sssiis",$Car_name ,$Car_type, $Car_status, $Car_price, $Car_available,$Car_location);
        mysqli_stmt_execute($statement);
        header("Location: ../mysql/carrent.page.php?add=success");
        exit();
      }
    }

    ?>
  </body>
</html>