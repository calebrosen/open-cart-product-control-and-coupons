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

// Get the entered password from the POST request
$enteredPassword = $_POST["password"];

// Prepare and execute a query to call the stored procedure for validation
$stmt = $connection->prepare("CALL usp_checkAdminPW(?)");
$stmt->bind_param("s", $enteredPassword);
$stmt->execute();

// Bind the result to a variable
$stmt->bind_result($result);

// Fetch the result from the stored procedure call
$stmt->fetch();

// Close the prepared statement
$stmt->close();

// Close the connection
$connection->close();

// Return a JSON response indicating if the password is valid
$response = array("valid" => ($result == 1)); // Assuming 1 means valid
header('Content-Type: application/json');
echo json_encode($response);
?>
