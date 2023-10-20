<?php

//redacted
$host = "-----";
$user = "caleb";
$password = "-----";
$dbname = "-----";
$port = "-----";

$connection = mysqli_connect($host, $user, $password, $dbname, $port);

if ($connection->connect_error) {
    $error_message = "Connection failed: " . $connection->connect_error;
    $response = array("success" => false, "message" => $error_message);
    header('Content-Type: application/json');
    echo json_encode($response);
    exit; // Exit the script
}

$varAgent = $_POST["agent"];
$varStore = $_POST["store"];
$varProduct = $_POST["product"];
$varQuantity = $_POST["quantity"];

$stmt = $connection->prepare("CALL federatedb.usp_releaseProduct_v3(?, ?, ?, ?);");

if ($stmt === false) {
    $error_message = "Error preparing statement: " . $connection->error;
    $response = array("success" => false, "message" => $error_message);
    header('Content-Type: application/json');
    echo json_encode($response);
    exit; // Exit the script
}

$stmt->bind_param("sssi", $varAgent, $varStore, $varProduct, $varQuantity);

$result = $stmt->execute();

if ($result === false) {
    $error_message = "Error executing statement: " . $stmt->error;
    $response = array("success" => false, "message" => $error_message);
    header('Content-Type: application/json');
    echo json_encode($response);
    exit; 
}

$stmt->bind_result($released);


$stmt->fetch();


$stmt->close(); 

$connection->close(); 
$response = array("success" => true, "message" => $released);

header('Content-Type: application/json');
echo json_encode($response);
?>
