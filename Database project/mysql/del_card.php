<?php 
session_start();
include 'mysqlconnect.php';

if (isset($_SESSION['userId'])){
	$user_id = $_SESSION['userId'];
	$user_name = $_SESSION['user_name'];
}

if (isset($_POST['id'])){
	$pay_id= $_POST['id'];
	$del_card="DELETE FROM payment WHERE payment_id = ".$pay_id.";";
	if ($con->query($del_card) === TRUE) {
		echo "card deleted successful";
		header("Location: ../mysql/payment_method.php?delete=success");
	} else {  echo "Error: " . $con->error;
	}
}

