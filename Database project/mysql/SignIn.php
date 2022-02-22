<?php
include 'mysqlconnect.php'
?>
<!DOCTYPE html>
<html lang="en" style="background-color:lightcyan;">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataBase</title>
</head>
<style>
    h3 {
      position: absolute;
      left: 1100px;
      top: 400px;
    }
</style>
  <body>
    <img src="img2/background.png" width="1920"  height="1080" style="position: absolute; left: 0px; top: 0px;">
    <img src="img2/greenbar.png" width="1920"  height="80" style="position: absolute; left: 0px; top: 0px;">
    <a href="carrent.page.php"><img src="img2/Logo.png" width="100"  height="40" style="position: absolute; left: 20px; top: 20px;"></a>
    <img src="img/signup.png" width="150"  height="30" style="position: absolute; left: 1100px; top: 160px;">
    <form action="SignIn.php" method="post">
      <input type="text" name='Username' placeholder="USERNAME" style="position: absolute; left: 1100px; top: 200px;">
      <br>
      <input type="text" name='E-mail' placeholder="E-Mail" style="position: absolute; left: 1100px; top: 230px;">
      <br>
      <input type="password" name='password' placeholder="Password" style="position: absolute; left: 1100px; top: 260px;">
      <br>
      <input type="password" name='con_password' placeholder="Conform password" style="position: absolute; left: 1100px; top: 290px;">
      <br>
      <button type="submit"  name="submit" style="position: absolute; left: 1100px; top: 320px;">Sign Up</button>
    </form>
      <?php 
      $sql_check = "SELECT * FROM user;";
      $result = mysqli_query($con,$sql_check);
      $all_correct = true;
      $userId = $_POST["Username"];
      $User_e_mail = $_POST["E-mail"];
      $User_password = $_POST["password"];
      $User_con_password = $_POST['con_password'];
      echo "<h3>";
      if ($userId == Null){
        echo "<br> please enter your username ";
        $all_correct = false;
        exit();
      } elseif (!preg_match("/^[a-zA-Z0-9]*$/", $userId)) {
        echo "<br> please enter a propar username ";
        exit();
      }
       while ($row = mysqli_fetch_assoc($result)){
        if ($row['user_name'] == $userId){
          echo "<br> this username has been used please enter a diffrent username ";
          $all_correct = false;
          exit();
        }
      }
      if ($User_e_mail == Null && !filter_var($User_e_mail, FILTER_VALIDATE_EMAIL)){
        echo "<br> please enter your e-mail ";
        $all_correct = false;
        exit();
      }
      while ($row = mysqli_fetch_assoc($result)){
        if ($row['user_e_mail'] == $User_e_mail){
          echo "<br> this mail has been used please enter a diffrent e-mail ";
          $all_correct = false;
          exit();
        }
      }
      if ($User_password == Null){
        echo "<br> please enter your password ";
        $all_correct = false;
        exit();
      } elseif ($User_con_password == Null) {
        echo "<br> please enter your conform password ";
        $all_correct = false;
        exit();
      } elseif ($User_con_password != $User_password){
        echo "<br> password and conform password are not same ";
        $all_correct = false;
        exit();
      }
      if ($all_correct === true) {
        $sql = " INSERT INTO user (user_name,user_e_mail,user_password,admin)
        VALUES (?, ?, ?, ?);"; //<- sql code to insert data
        $statement = mysqli_stmt_init($con);
        if (!mysqli_stmt_prepare($statement, $sql)){
          echo "There is a problem in database";
          exit();
        } else {
          $user_admin='user';
          $hashed_password= password_hash($User_password, PASSWORD_DEFAULT); // <- hashing the password

          mysqli_stmt_bind_param($statement, "ssss", $userId, $User_e_mail, $hashed_password, $user_admin);
          mysqli_stmt_execute($statement);
          header("Location: ../mysql/Login.php?signup=success");
          exit();
        }
      }
      echo "</h3>";
      ?>

  </body>
</html>
