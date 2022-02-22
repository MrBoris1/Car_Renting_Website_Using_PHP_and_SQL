<?php
$serverName = "localhost";
$userName = "root";
$password = "";
$dbname = "ABIcarrent";

//create connection
$con = new mysqli($serverName,$userName,$password,$dbname);

if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
} 

//creating user table in database
$sql = "CREATE TABLE user ( 
user_id int(11) AUTO_INCREMENT PRIMARY KEY not null,
user_name varchar(256) not null,
user_e_mail varchar(256) not null,
user_password varchar(256) not null,
admin varchar(256) not null
) ";

// creating cars methods table in database
$sql_cars= "CREATE TABLE cars (
car_id int(11) AUTO_INCREMENT PRIMARY KEY not null,
car_name varchar(256) not null,
car_type varchar(256) not null,
car_status varchar(256) not null, 
car_price int not null,
car_available int not null,
car_location varchar(256) not null
) ";

$sql_rent= "CREATE TABLE rent (
rent_order int(11) AUTO_INCREMENT PRIMARY KEY not null,
cars_id int not null,
users_id int not null,
rent_time date,
rent_leght date, 
rent_location varchar(256) not null
) ";


$sql_payment= "CREATE TABLE payment (
payment_id int AUTO_INCREMENT PRIMARY KEY not null,
user_id int not null,
card_holder_name varchar(256) not null,
card_number int not null,
expare_month int not null,
Expare_year int not null, 
cvs int not null
) ";

//$user = ali 
//$sql_update="UPDATE user SET admin = admin WHERE ".$user.";";

mysqli_query($con, $sql_payment);
mysqli_query($con,$sql_rent);
mysqli_query($con, $sql);
mysqli_query($con, $sql_cars);


//if ($con->query($sql_update) === TRUE) { echo "Table MyGuests created successfully";} 
//else {  echo "Error: " . $con->error;}
?>
