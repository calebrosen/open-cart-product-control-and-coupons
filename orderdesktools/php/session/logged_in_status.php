<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 


if (isset($_POST['logged_in'])) {
    $logged_in = filter_var($_POST['logged_in'], FILTER_VALIDATE_BOOLEAN);

    if ($logged_in) {
        if (isset($_POST['agentID'])) {
            $agentID = $_POST['agentID'];
            $_SESSION['loggedIn'] = true; 
            $_SESSION['agentID'] = $agentID; 
        echo "User is logged in. Agent ID: $agentID";
        } else {
            echo "User is logged in, but Agent ID is not set in the POST data.";
        }
    } else {
        echo "User is not logged in";
    }
} 
?>
