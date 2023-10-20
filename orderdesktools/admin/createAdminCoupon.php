<?php

//redacted
$host = "-----";
$user = "caleb";
$password = "-----";
$dbname = "-----";
$port = "-----";

$connection = mysqli_connect($host, $user, $password, $dbname, $port);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$couponName = $_POST["varCouponName"];
$couponCode = $_POST["varCouponCode"];
$couponType = $_POST["varCouponType"];
$couponAmount = $_POST["varCouponAmount"];
$minimumAmount = $_POST["varMinimumAmount"];
$formattedDateStart = $_POST["varDateStart"];
$formattedDateEnd = $_POST["varDateEnd"];     
$usesPerCoupon = $_POST["varUsesPerCoupon"];
$usesPerCustomer = $_POST["varUsesPerCustomer"];
$DIM = $_POST["varDIM"];
$FMP = $_POST["varFMP"];
$FMS = $_POST["varFMS"];
$FPG = $_POST["varFPG"];
$GNP = $_POST["varGNP"];
$RFS = $_POST["varRFS"];


$stmt = $connection->prepare("CALL usp_CreateCouponAdmin(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
if (!$stmt) {

    die("Error preparing statement: " . $connection->error);
}

$stmt->bind_param("sssiiiiiiiiiiii", $couponName, $couponCode, $couponType, $couponAmount, $minimumAmount, $formattedDateStart, $formattedDateEnd, $usesPerCoupon, $usesPerCustomer, $DIM, $FMP, $FMS, $FPG, $GNP, $RFS);

if (!$stmt->execute()) {
    die("Error executing statement: " . $stmt->error);
}


$stmt->bind_result($CouponsCreated);
$stmt->fetch(); 


$stmt->close();


$connection->close();


$response = array("valid" => true, "numCoupons" => $CouponsCreated);
header('Content-Type: application/json');
echo json_encode($response);
?>