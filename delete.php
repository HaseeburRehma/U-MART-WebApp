<?php

require "config.php";
require_once "authenticate.php";
session_start();
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $sql = "DELETE FROM `userdata` WHERE `id`='$user_id'";
    $result = $conn->query($sql);

    if ($result == TRUE) {
        $_SESSION['UserDeletedStatus'] = "User Deleted successfully.";
        
       
        
    } else {
        echo "Error:" . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
    header('Location: usertables.php');
    exit();

}

