<?php

// redacted
$host = "-----";
$user = "caleb";
$password = "-----";
$dbname = "-----";
$port = "-----";

$connection =mysqli_connect($host, $user, $password, $dbname, $port);


if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Get the entered username and password from the POST request
$enteredUsername = $_POST["username"];
$enteredPassword = $_POST["password"];

// Prepare and execute a query to call the stored procedure for validation
$stmt = $connection->prepare("CALL usp_validateAgent(?,?);");
$stmt->bind_param("ss", $enteredUsername, $enteredPassword);
$stmt->execute();

// Fetch the result from the stored procedure call
$stmt->bind_result($agentID, $limit, $used, $available);
$stmt->fetch();

// Close the prepared statement and the connection
$stmt->close();
$connection->close();

$isValid = ($agentID !== 'ERROR');



// Return a JSON response indicating if the username and password are valid
$response = array("valid" => $isValid, "agentID" => $agentID, "limit" => $limit, "used" => $used, "available" => $available);
header('Content-Type: application/json');
echo json_encode($response);

// echo "StoredLimit:".$storedLimit;

?>
