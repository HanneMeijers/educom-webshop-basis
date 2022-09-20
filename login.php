<?php
function showLoginHeader () {
    echo 'Log in';
}

function validateLogin () {
    
    // define variables and set to empty values
    $name = $email = $password = "";
    $emailErr = $passwordErr = "";
    $valid = false;
    
      // validate the 'Post' data //
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["email"])) {
            $emailErr = "E-mail is verplicht";
        } else {
            $email = cleanupInputFromUser($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Vul geldig e-mailadres in";
            }
        }

        if (empty($_POST["password"])) {
            $passwordErr = "Vul wachtwoord in";
        } else {
            $password = cleanupInputFromUser($_POST["password"]);
        }    
        if (empty($emailErr) && empty($passwordErr)) {
            require_once ("service.php");
            
            $userArray = authenticateUser($email, $password);
            if (empty($userArray)) {
                $emailErr = "Geen geldig e-mailadres of password onjuist";
            } else {
                $valid = true;
                $name = $userArray["name"];
            }
        }
    }
        return Array ("name" => $name, "email" => $email, "password" => $password,
                      "emailErr" => $emailErr, "passwordErr" => $passwordErr, "valid" => $valid);
}
function showLoginForm($data) {
    echo '
      <form method="post" action="index.php" >    
    <div>
    <label for="e-mail">E-mailadres:</label>
    <input type="email" id="e-mail" name="email" value="'. $data ["email"] .'">
    <span class="error"> '. $data ["emailErr"] .' </span>
    </div>
    <div>
    <label for="password">Wachtwoord:</label>
    <input type="tel" id="password" name="password" value="'. $data ["password"] .'">
    <span class="error"> '. $data ["passwordErr"] .' </span>
    </div>
    <input type="hidden" name="page" value="login">
    <div>
  <input type="submit" value="Verzend"> 
    </div>
</form> ';
}









?> 