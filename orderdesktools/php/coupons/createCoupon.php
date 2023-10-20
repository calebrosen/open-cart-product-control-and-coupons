<?php


$host = "-----";
$user = "caleb";
$password = "-----";
$dbname = "-----";
$port = "-----";

$connection = mysqli_connect($host, $user, $password, $dbname, $port);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$agent = $_POST["agent"]; 
$store = $_POST["store"]; 
$couponAmount = $_POST["couponAmount"]; 


$stmt = $connection->prepare("CALL federatedb.usp_CreateCoupon(?, ?, ?);");
if ($stmt === false) {
    die("Error preparing statement: " . $connection->error);
}


$stmt->bind_param("sss", $agent, $store, $couponAmount);


$result = $stmt->execute();

if ($result === false) {
    die("Error executing statement: " . $stmt->error);
}


$stmt->bind_result($varSalesAgent, $CouponCode, $varStore, $varAmount);


$stmt->fetch();

$connection->close();


$response = array("success" => true, "message" => $CouponCode);

header('Content-Type: application/json');
echo json_encode($response);