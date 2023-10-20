<?php

//redacted
$host = "-----";
$user = "caleb";
$password = "-----";
$dbname = "-----";
$port = "-----";

try {
    $connection = mysqli_connect($host, $user, $password, $dbname, $port);
    
    if ($connection->connect_error) {
        throw new Exception("Connection failed: " . $connection->connect_error);
    }
    
    $agent1 = $_POST["agent"];
    
    $stmt = $connection->prepare("CALL federatedb.usp_getAgentCoupons (?)");
    if ($stmt === false) {
        throw new Exception("Error preparing statement: " . $connection->error);
    }
    
    $stmt->bind_param("s", $agent1);
    
    $result = $stmt->execute();
    if ($result === false) {
        throw new Exception("Error executing statement: " . $stmt->error);
    }
    
    $result_set = $stmt->get_result(); // Fetch the result set
    
    $data = array();
    
    while ($row = mysqli_fetch_assoc($result_set)) {
        $data[] = $row;
    }
    
    $response = array("success" => true, "coupons" => $data);
    
    $stmt->close();
    $connection->close();
    
    header('Content-Type: application/json');
    echo json_encode($response);
}    catch (Exception $e) {
        // Handle the exception, for example, log the error
        error_log("Error in script: " . $e->getMessage());
        // Send an appropriate error response
        http_response_code(500); // Internal Server Error
        echo json_encode(array("success" => false, "message" => "An error occurred."));
    }
    ?>
    