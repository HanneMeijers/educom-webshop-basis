<?php
session_start();

function dologinUser($name) {
    $_SESSION['loggedInName'] = $name;
}

function isUserLoggedIn() {
    return isset($_SESSION['loggedInName']);
}
function getLoggedInUsername() {
    return $_SESSION["loggedInName"];
}

function doLogoutUser() {
    unset($_SESSION['loggedInName']);
}