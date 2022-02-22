<?php 
session_start();
include 'mysqlconnect.php'
?>
<!DOCTYPE html>
<html lang="en" style="background-color:lightcyan;">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABI CAR RENT</title>
</head>
<style>
    h3 {
      position: absolute;
      left: 200px;
      top: 200px;
    }
</style>
  <body>
    <img src="img2/background.png" width="1920"  height="1080" style="position: absolute; left: 0px; top: 0px;">
    <img src="img2/greenbar.png" width="1920"  height="80" style="position: absolute; left: 0px; top: 0px;">
    <a href="carrent.page.php"><img src="img2/Logo.png" width="100"  height="40" style="position: absolute; left: 20px; top: 20px;"></a>
    <img src="img2/YourRentedCars.png" width="400"  height="80" style="position: absolute; left: 150px; top: 150px;">
  	<?php 
  	if (isset($_SESSION['userId'])){
      $user_id = $_SESSION['userId'];
      $user_name = $_SESSION['user_name'];
  		echo '<form action="logout.php" method="post">
  		<button type="submit" name="logout" style="position: absolute; left: 1180px; top: 20px;">Logout</button></form><form action="user_admin_page.php" method="post">
      <button type="submit" name="id" style="position: absolute; left: 1080px; top: 20px;">User:'.$user_name.'</button></form>';
  	} else {
  		echo 'header("Location: ../mysql/Login.page.php?tranferd=success");';
  	}
    $get_rent="SELECT * FROM rent ;";
    $result = $con->query($get_rent);
    echo '<h3>';
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        if ($row['users_id']==$user_id){
          echo "<br>Name of the car: ".$row['cars_name']."<br> Rented date: ".$row['rent_time']."<br> Drop date: ".$row['rent_leght']."<br> Drop and pick-up location: ".$row['rent_location']."<br>" ;
        }
      }
    } else {
      echo "0 results";
    }
    echo "</h3>";
  	?>
  </body>
</html>