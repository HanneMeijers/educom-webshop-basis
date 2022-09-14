<?php
function findUserByEmail($email) {
    $usersFile = fopen("Users/users.txt", "r");
    $userArray = null;
    $line = fgets($usersFile);
    while (!feof($usersFile)) {
        $line = fgets($usersFile);
        $userData = explode("|",$line);
        if ($userData[0] == $email) {
            $userArray = array("email" => $userData[0], "name" => $userData[1], "password" => $userData[2]);
            break;
        }        
    }
    fclose ($usersFile);
    return ($userArray);
}