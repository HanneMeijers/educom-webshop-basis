<?php
require_once "service.php";
require_once "login.php";
function showRegisterHeader () {
    echo 'Registreren';
}

function showRegisterContent () {
    $data=validateRegister ();
    if (!$data ["valid"]) { /* Show the next part only when $valid is false */ 
        showRegisterForm ($data);
    } else { /* Show the next part only when $valid is true */
        storeUser($data);
        showLoginForm($data);    
    }/* End of conditional showing */
}
function validateRegister () {
    
    // define variables and set to empty values
    $name = $email = $password = $passwordCheck = "";
    $nameErr = $emailErr = $passwordErr = $passwordCheckErr = "";
    $valid = false;
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // validate the 'Post' data //
            /* validate the name */
        if (empty($_POST["name"])) {
            $nameErr = "Naam is verplicht";
        } else {
            // $name = $_POST["name"];
            $name = cleanupInputFromUser($_POST["name"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
                $nameErr = "Only letters and white space allowed";
            }
        }

        if (empty($_POST["email"])) {
            $emailErr = "E-mail is verplicht";
        } else {
            $email = cleanupInputFromUser($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "ongeldig email format";
            }
        }
        if (empty($_POST["password"])) {
            $passwordErr = "Vul wachtwoord in";
        } else {
            $password = cleanupInputFromUser($_POST["password"]);
        }    
        
        if (empty($_POST["passwordCheck"])) {
            $passwordCheckErr = "Herhaal wachtwoord";
        } else {
            $passwordCheck = cleanupInputFromUser($_POST["passwordCheck"]);
        } 

        if (empty($nameErr) && empty($emailErr) && empty($passwordErr) && empty($passwordCheckErr)) {
            if (doesUserExist($email)) {
                $emailErr = "e-mailadres is al in gebruik, ga naar login";
            } else{
                $valid = true;
            }
        }
       
    }
    
        return Array ("name" => $name, "email" => $email, "password" => $password, "passwordCheck" => $passwordCheck,
                  "nameErr" => $nameErr, "emailErr" => $emailErr, "passwordErr" => $passwordErr, "passwordCheckErr" => $passwordCheckErr, "valid" => $valid);
}
function showRegisterForm ($data) {
    echo '
      <form method="post" action="index.php" >    
     <div>
        <label for="name">Naam:</label>
        <input type="text" id="name" name="name" value="'. $data ["name"] .'" placeholder="Jan Klaassen">
        <span class="error"> '. $data ["nameErr"] .' </span>
    </div>
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
    <div>
    <label for="passwordCheck">Wachtwoord herhaal:</label>
    <input type="tel" id="passwordCheck" name="passwordCheck" value="'. $data ["passwordCheck"] .'">
    <span class="error"> '. $data ["passwordCheckErr"] .' </span>
    </div>
      <input type="hidden" name="page" value="register">
    <div>
  <input type="submit" value="Verzend"> 
    </div>
</form> ';
}

?> 