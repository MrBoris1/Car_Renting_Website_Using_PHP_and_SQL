<?php 
session_start();
include 'mysqlconnect.php'
?>
<!DOCTYPE html>
<html lang="en" style="background-color:rgb(244,244,244);">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABI CAR RENT</title>
</head>
<style>
    h3 {
      position: absolute;
      left: 500px;
      top: 500px;
    }
</style>

  <body>
    <img src="img2/background.png" width="1920"  height="1080" style="position: absolute; left: 0px; top: 0px;">
    <img src="img2/greenbar.png" width="1920"  height="80" style="position: absolute; left: 0px; top: 0px;">
    <a href="carrent.page.php"><img src="img2/Logo.png" width="100"  height="40" style="position: absolute; left: 20px; top: 20px;"></a>
  	<?php 
  	if (isset($_SESSION['userId'])){
      $user_id = $_SESSION['userId'];
      $user_name = $_SESSION['user_name'];
  		echo '<form action="logout.php" method="post">
  		<button type="submit" name="logout" style="position: absolute; left: 1180px; top: 20px;">Logout</button></form><form action="user_admin_page.php" method="post">
      <button type="submit" name="id" style="position: absolute; left: 1080px; top: 20px;">User:'.$user_name.'</button></form>';
  	} else {
  		header("Location: ../mysql/Login.php?tranferd=success");
  	}
    if (isset($_POST['id'])){
      $car_id= $_POST['id'];
      $_SESSION['car_id'] = $car_id;
    } 
    echo '<form action="Rent_success.php" method="post">
    <input type="date" name="start" placeholder="pick-up date" style="position: absolute; left: 450px; top: 240px;"> 
    <input type="date" name="end" placeholder="drop date" style="position: absolute; left: 580px; top: 240px;">
    <button type="submit" name="submit" style="position: absolute; left: 700px; top: 240px;">Conform</button>
    </form>';
    if (isset($_SESSION['car_id'])){
      $car_id = $_SESSION['car_id'];
    }
    $start = $_POST['start'];
    $end = $_POST['end'];
    if (empty($start) || empty($end)) {
      echo "<h3>Please enter a valid date</h3>";
      exit();
    }
    $get_car_id="SELECT * FROM cars WHERE car_id=".$car_id.";";
    $result = $con->query($get_car_id);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()){
        $car_name= $row['car_name'];
        $loc = $row['car_location'];
        $sql_insert = " INSERT INTO rent (cars_id,cars_name,users_id,rent_time,rent_leght,rent_location)
        VALUES ($car_id,'$car_name','$user_id' , '$start', '$end', '$loc');";
        $sql_update = " UPDATE cars SET car_available= car_available - 1 WHERE car_id=".$car_id.";";
        if ($con->query($sql_insert) === TRUE && $con->query($sql_update) === TRUE ) { 
          header("Location: ../mysql/Rent.php?login=success");
        } else { 
          echo "Error: " . $con->error;
        }
      }
    } else {
      echo "0 results";
    }
  	?>
  </body>
</html>