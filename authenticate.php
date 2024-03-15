<?php

function isLoggedIn() {
    return isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
}


function isAdmin() {
    return isset($_SESSION['admin']) && $_SESSION['admin'] === true;
}


/*
if (isLoggedIn() !== false ) {
    header("location: loginform.php");
    exit;
} */

?>