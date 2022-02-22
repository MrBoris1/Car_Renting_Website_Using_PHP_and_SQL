<?php 
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
    <img src="img2/background.png" width="1920"  height="1080" style="position: absolute; left: 0px; top: 0px;">
    <img src="img2/greenbar.png" width="1920"  height="80" style="position: absolute; left: 0px; top: 0px;">
    <a href="carrent.page.php"><img src="img2/Logo.png" width="100"  height="40" style="position: absolute; left: 20px; top: 20px;"></a>
    <img src="img2/Resetpassword.png" width="400"  height="80" style="position: absolute; left: 550px; top: 120px;">
    <form action="password_reset.php" method="post">
    <input type="text" name='Recover_E-mail' placeholder="please type your E-Mail" style="position: absolute; left: 600px; top: 240px;">
    <br>
    <button type="submit"  name="submit" style="position: absolute; left: 600px; top: 280px;">Submit</button>
    </form>
    <?php 
    $sql_check = "SELECT * FROM user;";
    $result = mysqli_query($con,$sql_check);
    $recover_e_mail = $_POST['Recover_E-mail'];
    while ($row = mysqli_fetch_assoc($result)){
      if ($row['user_e_mail'] == $recover_e_mail){
        session_start();
        $_SESSION['userId']=$row['user_id'];
        $_SESSION['user_name']=$row['user_name'];
        $_SESSION['admin']=$row['admin'];
        header("Location: ../mysql/user_change_password.php?login=success");
        exit();
      }
    }
    ?>
  </body>
</html>
