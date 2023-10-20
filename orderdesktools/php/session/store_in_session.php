<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

if (isset($_POST['storeSelected'])) {
    $storeSelected = filter_var($_POST['storeSelected'], FILTER_VALIDATE_BOOLEAN);

    if ($storeSelected) {
        if (isset($_POST['selectedStoreVarPHP'])) {
            $selectedStore = $_POST['selectedStoreVarPHP'];
            $_SESSION['selectedStoreVarPHP'] = $selectedStore; 
            echo "Store selected. Store ID: $selectedStore";
        } else {
            echo "Store is selected, but Store ID is not set in the POST data.";
        }
    } else {
        echo "No store selected.";
    }
}
?>
