<?php
require_once("repository.php");

function doesUserExist($email) {
    $userArray=findUserByEmail($email);
    return empty($userArray);
}

/**
  * tests if a user is authenticated
   *
  * @param (string) $email     The email to search for.
  * @param (string) $password  The password to check against the stored password 
  * @return (null|array) Returns an array with name, email,password when user is authenticatd or null when not authenticatd
  */
function authenticateUser($email, $password){
    $userArray=findUserByEmail($email);
    if (empty($userArray)) {
        return null;
    }
    if ($userArray ["password"] != $password){
        return null;
    }
    return $userArray;
}    