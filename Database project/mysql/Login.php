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
      left: 400px;
      top: 400px;
    }
</style>
  <body>
    <img src="img2/background.png" width="1920"  height="1080" style="position: absolute; left: 0px; top: 0px;">
    <img src="img2/greenbar.png" width="1920"  height="80" style="position: absolute; left: 0px; top: 0px;">
    <img src="img2/Group_10.png" width="300"  height="60" style="position: absolute; left: 450px; top: 100px;">
    <a href="carrent.page.php"><img src="img2/Logo.png" width="100"  height="40" style="position: absolute; left: 20px; top: 20px;"></a>
    <form action="Login.php" method="post">
      <input type="text" name="UserID" placeholder="User ID or user E-mail" style="position: absolute; left: 500px; top: 200px;">
      <br> 
      <input type="password" name="password" placeholder="Password" style="position: absolute; left: 500px; top: 230px;"> <br>
      <input type="button" value="Sign up" onclick="window.location.href='SignIn.php'" style="position: absolute; left: 550px; top: 260px;" />
      <input type="submit" value="Login" style="position: absolute; left: 500px; top: 260px;">
      <br>
      <input type="button" value="I forget my password" onclick="window.location.href='password_reset.php'" style="position: absolute; left: 500px; top: 300px;" />
    </form>
      <?php 
      $userId = $_POST["UserID"];
      $User_password = $_POST["password"];
      $all_correct = true;
      echo "<h3>";
      if ($userId == Null){
        echo "<br> please enter your username ";
        $all_correct = false;
      } 
      else if ($User_password == Null){
        echo "<br> please enter your password ";
        $all_correct = false;
      } else {
        if ($all_correct == true){
          $sql_check = "SELECT * FROM user WHERE user_name=? OR user_e_mail=?;";
          $statement = mysqli_stmt_init($con);
          if (!mysqli_stmt_prepare($statement,$sql_check)){
            echo "there is a error in database";
            exit();
          } else {
            mysqli_stmt_bind_param($statement, "ss", $userId,  $userId);
            mysqli_stmt_execute($statement);
            $result = mysqli_stmt_get_result($statement);
            if ($row = mysqli_fetch_assoc($result)){
              $pwdcheck = password_verify($User_password, $row['user_password']);
              if ($pwdcheck == false) {
                echo "Wrong password!!!";
                exit();
              } else {
                session_start();
                $_SESSION['userId']=$row['user_id'];
                $_SESSION['user_name']=$row['user_name'];
                $_SESSION['admin']=$row['admin'];

                header("Location: ../mysql/carrent.page.php?login=success");
              }
            } else {
              echo "there is a problem in row database";
              exit();
            }
          }
        }
      }
      echo "</h3>";
      ?>
  </body>
</html>
