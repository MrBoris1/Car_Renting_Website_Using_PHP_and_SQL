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
    <img src="img2/Group_11.png" width="400"  height="80" style="position: absolute; left: 500px; top: 150px;">
    <?php 
    if (isset($_SESSION['userId'])){
      $user_id = $_SESSION['userId'];
      $user_name = $_SESSION['user_name'];
      echo '<form action="logout.php" method="post">
      <button type="submit" name="logout" style="position: absolute; left: 1180px; top: 20px;">Logout</button>
    </form><form action="user_admin_page.php" method="post">
      <button type="submit" name="id" style="position: absolute; left: 1080px; top: 20px;">User:'.$user_name.'</button></form>'; 
    } else {
      header("Location: ../mysql/Login.php?tranferd=success");
    } 
    echo '<form action="payment_method_add.php" method="post">
      <input type="text" name="Card_holder_name" placeholder="Card Holder Name" style="position: absolute; left: 600px; top: 240px;">
      <br>
      <input type="number" name="Card_number" placeholder="Card Number" min="15" style="position: absolute; left: 600px; top: 280px;">
      <br>
      <input type="number" name="Expare_month" placeholder="Expare Month" min="00" max="12" style="position: absolute; left: 600px; top: 320px;">
      <br>
      <input type="number" name="Expare_year" placeholder="Expare Year" min="2010" max="2030" style="position: absolute; left: 600px; top: 360px;">
      <br>
      <input type="number" name="CSV" placeholder="CSV" min="0" max="1000" style="position: absolute; left: 600px; top: 400px;">
      <br>
      <button type="submit"  name="submit" style="position: absolute; left: 600px; top: 420px;">Add the card</button>
      </form>';
    $sql_check = "SELECT * FROM payment;";
    $result = mysqli_query($con,$sql_check);
    $all_correct = true;
    $Card_holder = $_POST['Card_holder_name'];
    $Card_number = $_POST['Card_number'];
    $Expare_month = $_POST['Expare_month'];
    $Expare_year = $_POST['Expare_year'];
    $CSV = $_POST['CSV'];

    if (empty($Card_holder) || empty($Card_number)){
    	echo "<h3>Please fill all of the boxes</h3>";
    	$all_correct = false;
    	exit();
    }

    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['Card_holder'] == $Card_holder || $row['Card_number'] == $Card_number || $row['Expare_month'] == $Expare_month || $row['Expare_year'] == $Expare_year || $row['CSV'] == $CSV ) {
          echo "<h3><br> this creadit card is already used please enter a diffrent one !!!</h3>";
          $all_correct = false;
          exit();
        }
    }
    if ($all_correct == true) {
      $sql_insert_card = " INSERT INTO payment (user_id,card_holder_name,card_number,expare_month,Expare_year,cvs)
      VALUES  ($user_id,'$Card_holder', $Card_number, $Expare_month, $Expare_year, $CSV);"; //<- sql code to insert data
      if ($con->query($sql_insert_card) === TRUE) { 
        header("Location: ../mysql/payment_method.php?add=success");
        exit();
      } else {  echo "Error: " . $con->error;} 
    }

    ?>
  </body>
</html>