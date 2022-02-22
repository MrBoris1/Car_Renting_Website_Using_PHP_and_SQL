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
    echo '<form action="admin_delivered_car.php" method="post">
      <input type="text" name="rent_order" placeholder="Rent order number" width="120" height="40" style="position: absolute; left: 600px; top: 240px;">
      <br>
      <button type="submit"  name="submit" style="position: absolute; left: 600px; top: 280px;">Delivered car</button>
      </form>';
      if (isset($_POST['rent_order'])){
        $rent_order= $_POST['rent_order'];
        $del_rent_order="DELETE FROM rent WHERE rent_order = ".$rent_order.";";
        if ($con->query($del_rent_order) === TRUE) {
          echo "car delivered to our branch";
          header("Location: ../mysql/admin_rent_car.php?delete=success");
        } else {  echo "Error: " . $con->error;
        }
      }
    ?>
  </body>
</html>