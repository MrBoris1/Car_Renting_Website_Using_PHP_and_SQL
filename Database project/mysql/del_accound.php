<?php 
session_start();
include 'mysqlconnect.php';

if (isset($_SESSION['userId'])){
	$user_id = $_SESSION['userId'];
	$user_name = $_SESSION['user_name'];
}
$del="DELETE FROM user WHERE user_id = ".$user_id.";";
$del_pay="DELETE FROM payment WHERE user_id = ".$user_id.";";
if ($con->query($del) === TRUE) {
	echo "user deleted";
} else {  echo "Error: " . $con->error;
}

$get_payment_method="SELECT * FROM payment WHERE user_id = ".$user_id." ;"; 
$result = $con->query($get_payment_method);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
    	$del_pay="DELETE FROM payment WHERE user_id = ".$user_id.";";
    	if ($con->query($del_pay) === TRUE) {
    		echo "users payment method deleted";
    	} else {  echo "Error: " . $con->error;
        }
    }
}
header("Location: ../mysql/logout.php?tranferd=success");