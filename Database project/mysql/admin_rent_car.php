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
  <style>
    h3 {
      position: absolute;
      left: 560px;
      top: 240px;
    }
  </style>
  <body>
    <img src="img2/greenbar.png" width="1920"  height="80" style="position: absolute; left: 0px; top: 0px;">
    <a href="carrent.page.php"><img src="img2/Logo.png" width="100"  height="40" style="position: absolute; left: 20px; top: 20px;"></a>
    <img src="img2/RentedCarlist.png" width="400"  height="80" style="position: absolute; left: 500px; top: 90px;">
    <?php 
    if (isset($_SESSION['userId'])){
      $user_id = $_SESSION['userId'];
      $user_name = $_SESSION['user_name'];
      $admin = $_SESSION['admin'];
      $sql_check = "SELECT * FROM user WHERE user_id = ".$user_id.";";
      $result = mysqli_query($con,$sql_check);
      while ($row = mysqli_fetch_assoc($result)) {
        if ($row['admin'] != 'admin'){
          header("Location: ../mysql/carrent.page.php?correction=success");
          exit();
        }
      }
      echo '<form action="admin_rent_car.php" method="post">
      <input type="text" name="search" placeholder="Search" style="position: absolute; left: 560px; top: 200px;">
      <button type="submit" name="search_con" style="position: absolute; left: 700px; top: 200px;">Search</button></form>
      <form action="logout.php" method="post">
      <button type="submit" name="logout" style="position: absolute; left: 1180px; top: 20px;">Logout</button></form>
      <form action="user_admin_page.php" method="post">
      <button type="submit" name="id" style="position: absolute; left: 1100px; top: 20px;">User:'.$user_name.'</button></form>'; 
    }  
    ?>
    <?php
    $search=$_POST['search'];
    if ($search==NULL){
      $get_rent="SELECT * FROM rent ;";
      $result = $con->query($get_rent);
      echo '<h3>';
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          echo "<br><br>Rent order number: ".$row['rent_order']."<br> Car id: ".$row['cars_id']."<br> Rented user id : ".$row['users_id']."<br> rent start time: ".$row['rent_time']."<br> rent end time: ".$row['rent_leght']."<br> take and bring location: ".$row['rent_location']."<br>" ;
        }
      } else {
        echo "0 results";
      }
      echo '</h3>';
    }else{
      $get="SELECT * FROM rent WHERE rent_order = '".$search."' OR cars_id = '".$search."' OR users_id = '".$search."' OR rent_time = '".$search."' OR rent_leght = '".$search."' OR rent_location = '".$search."' ;";
      $result = $con->query($get);
      echo '<h3>';
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          echo "<br><br>Rent order number: ".$row['rent_order']."<br> Car id: ".$row['cars_id']."<br> Rented user id : ".$row['users_id']."<br> rent start time: ".$row['rent_time']."<br> rent end time: ".$row['rent_leght']."<br> take and bring location: ".$row['rent_location']."<br>" ;
        }
      } else {
        echo "0 results";
      }
      echo '</h3>';
    }
    ?>
  </body>
</html>