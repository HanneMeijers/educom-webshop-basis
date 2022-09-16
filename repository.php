<?php
function findUserByEmail($email) {
    $usersFile = fopen("Users/users.txt", "r");
    $userArray = null;
    $line = fgets($usersFile);
    while (!feof($usersFile)) {
        $line = fgets($usersFile);
        $userData = explode("|",$line);
        if ($userData[0] == $email) {
            $userArray = array("email" => trim ($userData[0]), "name" => trim ($userData[1]), "password" => trim($userData[2]));
            break;
        }        
    }
    fclose ($usersFile);
    return ($userArray);
}

function saveUser ($email, $name, $password) {
     $usersFile = fopen("Users/users.txt", "a");
     $txt = $email . "|" . $name . "|" . $password . PHP_EOL ;
fwrite($usersFile, $txt);

fclose($usersFile);
}
