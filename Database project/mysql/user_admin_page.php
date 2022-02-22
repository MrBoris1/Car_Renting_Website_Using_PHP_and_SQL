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
  <body>
    <img src="img2/background.png" width="1920"  height="1080" style="position: absolute; left: 0px; top: 0px;">
    <img src="img2/greenbar.png" width="1920"  height="80" style="position: absolute; left: 0px; top: 0px;">
    <a href="carrent.page.php"><img src="img2/Logo.png" width="100"  height="40" style="position: absolute; left: 20px; top: 20px;"></a>
  	<?php 
  	if (isset($_SESSION['userId'])){
      $user_id = $_SESSION['userId'];
      $user_name = $_SESSION['user_name'];
      $admin = $_SESSION['admin'];
  		echo '
      <form action="logout.php" method="post">
  		<button type="submit" name="logout" style="position: absolute; left: 1180px; top: 20px;">Logout</button></form>
      <form action="user_admin_page.php" method="post">
      <button type="submit" name="id" style="position: absolute; left: 1080px; top: 20px;">User:'.$user_name.'</button></form>';
  	} else {
  		header("Location: ../mysql/Login.page.php?tranferd=success");
  	}
    if ($admin == 'admin'){
      echo '<a href="admin_add_car.php"><img src="img2/addcars.png" width="400"  height="80" style="position: absolute; left: 500px; top: 180px;"></a>
    <a href="admin_rent_car.php"><img src="img2/RentedCarlist.png" width="400"  height="80" style="position: absolute; left: 500px; top: 280px;"></a> 
    <a href="admin_delivered_car.php"><img src="img2/Group_12.png" width="400"  height="80" style="position: absolute; left: 500px; top: 380px;"></a> ';

    } else {
      echo '<h3>USER ACCOUNT MANAGEMENT SYSTEM<h3><br>
      <a href="Rent.php"><img src="img2/YourRentedCars.png" width="400"  height="80" style="position: absolute; left: 500px; top: 180px;"></a>
    <a href="payment_method.php"><img src="img2/PaymentMethods.png" width="400"  height="80" style="position: absolute; left: 500px; top: 280px;"></a>
    <a href="user_change_password.php"><img src="img2/ChangePassword.png" width="400"  height="80" style="position: absolute; left: 500px; top: 380px;"></a>
    <a href="del_accound.php"><img src="img2/DeleteAccount.png" width="400"  height="80" style="position: absolute; left: 500px; top: 480px;"></a>';
    }

  	?>
  </body>
</html>