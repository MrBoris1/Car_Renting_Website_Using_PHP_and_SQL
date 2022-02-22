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
      left: 200px;
      top: 50px;
    }
</style>
  <body>
    <img src="img2/greenbar.png" width="1920"  height="80" style="position: absolute; left: 0px; top: 0px;">
    <a href="carrent.page.php"><img src="img2/Logo.png" width="100"  height="40" style="position: absolute; left: 20px; top: 20px;"></a>
  	<?php 
  	if (isset($_SESSION['userId'])){
      $user_id = $_SESSION['userId'];
      $user_name = $_SESSION['user_name'];
      $admin = $_SESSION['admin'];
      echo '<form action="carrent.page.php" method="post">
      <input type="text" name="search" placeholder="Search" style="position: absolute; left: 500px; top: 20px;">
      <button type="submit" name="search_con" style="position: absolute; left: 680px; top: 20px;">Search</button></form>
      <form action="logout.php" method="post">
      <button type="submit" name="logout" style="position: absolute; left: 1180px; top: 20px;">Logout</button></form>
      <form action="user_admin_page.php" method="post">
      <button type="submit" name="id" style="position: absolute; left: 1100px; top: 20px;">User:'.$user_name.'</button></form>';
  	} else {
  		echo '<form action="carrent.page.php" method="post">
      <input type="text" name="search" placeholder="Search" style="position: absolute; left: 500px; top: 20px;">
      <button type="submit" name="search_con" style="position: absolute; left: 680px; top: 20px;">Search</button></form>
      <form action="Login.php" method="post">
  		<button type="submit" name="login" style="position: absolute; left: 1180px; top: 20px;">Login</button>
  	</form>';
  	}
    $search=$_POST['search'];
    if ($search==NULL){
      $get_price="SELECT * FROM cars WHERE car_price;";
      $result = $con->query($get_price);
      echo '<h3>';
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          echo '<br><br><img src="img/'.$row['car_name'].'.jpg" width="100" height="100" style="float: right;"/>'."Name of the car: ".$row['car_name']."<br> type of the car: ".$row['car_type']."<br> Status of car: ".$row['car_status']."<br> Price of the car: ".$row['car_price']."<br> Number of Available: ".$row['car_available']."<br> Location of the car: ".$row['car_location']."<br>" ;
          if ($row['car_available']==0){
            echo '<input type="button" value="Out of Stock"'."<br> <br>";
          } else {
            echo '<form action="Rent_success.php" method="post">
            <button type="hidden" name="id" value="'.$row['car_id'].'">Rent now</button>
            </form>'."<br> <br>";
          }
        }
      } else {
        echo "0 results";
      }
      echo '</h3>';
    }else{
      $get="SELECT * FROM cars WHERE car_name = '".$search."' OR car_type = '".$search."' OR car_status = '".$search."' OR car_price = '".$search."' OR car_location = '".$search."' ;";
      $result = $con->query($get);
      echo '<h3>';
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          echo '<br><br><img src="img/'.$row['car_name'].'.jpg" width="100" height="100" style="float: right;"/>'."Name of the car: ".$row['car_name']."<br> type of the car: ".$row['car_type']."<br> Status of car: ".$row['car_status']."<br> Price of the car: ".$row['car_price']."<br> Number of Available: ".$row['car_available']."<br> Location of the car: ".$row['car_location']."<br>" ;
          if ($row['car_available']==0){
            echo '<input type="button" value="Out of Stock"'."<br> <br>";
          } else {
            echo '<form action="Rent_success.php" method="post">
            <button type="hidden" name="id" value="'.$row['car_id'].'">Rent now</button>
            </form>'."<br> <br>";
          }
        }
      } else {
        echo "0 results";
      }
      echo '</h3>';
    }
  	?>
  </body>
</html>
