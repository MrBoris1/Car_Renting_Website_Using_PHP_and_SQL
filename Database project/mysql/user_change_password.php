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
    <img src="img2/Resetpassword.png" width="400"  height="80" style="position: absolute; left: 500px; top: 90px;">
  	<?php 
  	if (isset($_SESSION['userId'])){
      $user_id = $_SESSION['userId'];
      $user_name = $_SESSION['user_name'];
      echo '
      <form action="logout.php" method="post">
      <button type="submit" name="logout" style="position: absolute; left: 1180px; top: 20px;">Logout</button></form>
      <form action="user_admin_page.php" method="post">
      <button type="submit" name="id" style="position: absolute; left: 1080px; top: 20px;">User:'.$user_name.'</button></form>';
  	} else {
        header("Location: ../mysql/Login.php?tranferd=success");
    } 
  	echo '
    <form action="user_change_password.php" method="post">
      <input type="password" name="new_password" placeholder="New Password" style="position: absolute; left: 600px; top: 240px;">
      <br>
      <input type="password" name="con_password" placeholder="Conform password" style="position: absolute; left: 600px; top: 280px;">
      <br>
      <button type="submit"  name="submit" style="position: absolute; left: 600px; top: 320px;">Change</button>
    </form>';
    $sql_check = "SELECT * FROM user WHERE user_id = ".$user_id." ;";
    $result = mysqli_query($con,$sql_check);
    $new_password= $_POST['new_password'];
    $new_con_password = $_POST['con_password'];
    echo "<h3>";
    if ($new_password == Null){
       echo "<br> please enter your new password ";
       $all_correct = false;
       exit();
    } elseif ($new_con_password == Null) {
        echo "<br> please enter your conform password ";
        $all_correct = false;
        exit();
    } elseif ($new_con_password != $new_password){
        echo "<br> password and conform password are not same ";
        $all_correct = false;
        exit();
    }

    while ($row = mysqli_fetch_assoc($result)){
    	$pwdcheck = password_verify($new_password, $row['user_password']);
        if ($pwdcheck == false) {
        	$hashed_password= password_hash($new_password, PASSWORD_DEFAULT);
        	$sql_update=" UPDATE user SET user_password = '".$hashed_password."' WHERE user_id = ".$user_id." ;";
        	if ($con->query($sql_update) === TRUE) { 
        		header("Location: ../mysql/user_admin_page.php?Change=success");
        		exit();
        	} else {  echo "Error: " . $con->error;}
        } else {
        	echo "your password cannot be same of old one";
        	exit();
        }
    }
  	echo"</h3>";
  	?>
  </body>
</html>