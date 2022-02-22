<?php 
session_start(); //starting sesion to gain session infroamtion of the user
include 'mysqlconnect.php' //including connection to our database
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
      left: 560px;
      top: 240px;
    }
</style>
  <body>
    <img src="img2/background.png" width="1920"  height="1080" style="position: absolute; left: 0px; top: 0px;">
    <img src="img2/greenbar.png" width="1920"  height="80" style="position: absolute; left: 0px; top: 0px;">
    <a href="carrent.page.php"><img src="img2/Logo.png" width="100"  height="40" style="position: absolute; left: 20px; top: 20px;"></a>
    <img src="img2/YOURPAYMENTMETHOD.png" width="400"  height="80" style="position: absolute; left: 500px; top: 180px;">
  	<?php 
  	if (isset($_SESSION['userId'])){ //getting user session information
      $user_id = $_SESSION['userId']; //getting user id
      $user_name = $_SESSION['user_name']; // getting user name
  		echo '<form action="logout.php" method="post">
  		<button type="submit" name="logout" style="position: absolute; left: 1180px; top: 20px;">Logout</button></form><form action="user_admin_page.php" method="post">
      <button type="submit" name="id" style="position: absolute; left: 1080px; top: 20px;">User:'.$user_name.'</button></form>'; //on click first button send s you to logout and then sends you to home page, second button on click send you to user profile
  	} else {
  		header("Location: ../mysql/Login.php?tranferd=success"); //if user is not loged in login bottun will be apper and send the user to login page
  	}
    $get_payment_method="SELECT * FROM payment WHERE user_id = ".$user_id." ;"; //sql code that going to search users payment methods
    $result = $con->query($get_payment_method);
    echo '<h3>'; //sending the code to mysql quary and returning results to result
    if ($result->num_rows > 0) { //if there is result if statement will be true
      while($row = $result->fetch_assoc()) { //going through the results 
      	$var = $row['card_number']; //taking car number info to mask it
      	$var = substr_replace($var, str_repeat("X", 8), 0, 8); // masking the cards number
        echo "<br>Card Holder Name: ".$row['card_holder_name']."<br> Card Number: ".$var."<br> Expare mounth: ".$row['expare_month']."<br> Expare year: ".$row['Expare_year']."<br>" ; // printing the cars information to page
        echo '<form action="del_card.php" method="post">
          <button type="hidden" name="id" value="'.$row['payment_id'].'">X</button>
          </form>'; // when click on x it send you to del card file and deletes your card from our database
      }
    } else {
      echo "<br> There is no add to system <br>"; //if you not insert any card to system this message apper 
    }
    $home="window.location.href='carrent.page.php'"; //location of home page
    $add="window.location.href='payment_method_add.php'"; // location of payment add code
    echo '<input type="button" value="Add Cart" onclick="'.$add.'"/> <input type="button" value="Back to home page" onclick="'.$home.'"/>'."<br> <br> <br> <br>"; // first buttonn  sends you card add second button send you to home page
    echo '</h3>';
  	?>
  </body>
</html>