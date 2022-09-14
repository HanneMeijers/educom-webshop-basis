<?php 

define("SALUTATIONS", array ( "man" => "Man", "woman" => "Vrouw", "other" => "Anders"));
define ("COMMPREFS", array ("email" => "E-mail", "phone" => "Telefoon"));

function showContactHeader () {
    echo 'Contactformulier';
}

function showContactContent () {
    $data=validateContact ();
    if (!$data ["valid"]) { /* Show the next part only when $valid is false */ 
        showContactForm ($data);
    } else { /* Show the next part only when $valid is true */
       showContactThanks ($data);
    }/* End of conditional showing */
}

function validateContact () {
    
    // define variables and set to empty values
    $salutation = $name = $email = $phone = $commPref = $message = "";
    $salutationErr = $nameErr = $emailErr = $phoneErr = $commPrefErr = $messageErr = "";
    $valid = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // validate the 'Post' data //

        if (empty($_POST["salutation"])) {
            $salutationErr = "Aanhef is verplicht";
        } else {
            $salutation = cleanupInputFromUser($_POST["salutation"]);
        }

        /* validate the name */
        if (empty($_POST["name"])) {
            $nameErr = "Naam is verplicht";
        } else {
            // $name = $_POST["name"];
            $name = cleanupInputFromUser($_POST["name"]);
        }

        if (empty($_POST["email"])) {
            $emailErr = "E-mail is verplicht";
        } else {
            $email = cleanupInputFromUser($_POST["email"]);
        }

        if (empty($_POST["phone"])) {
            $phoneErr = "Telefoonnummer verplicht";
        } else {
            $phone = cleanupInputFromUser($_POST["phone"]);
        }    

        if (empty($_POST["commPref"])) {
            $commPrefErr = "Communicatievoorkeur verplicht";
        } else {
            $commPref = cleanupInputFromUser($_POST["commPref"]);
        }

        if (empty ($_POST ["message"])) {
            $messageErr = "Bericht is verplicht";
        } else {
            $message = cleanupInputFromUser($_POST["message"]); 
        } 

        if (empty($salutationErr) && empty($nameErr) && empty($emailErr) && empty($phoneErr) && empty($commPrefErr) && empty($messageErr)) {
            $valid = true;
        }
    }
    return Array ("salutation" => $salutation, "name" => $name, "email" => $email, "phone" => $phone, "commPref" => $commPref, "message" => $message, 
                  "salutationErr" => $salutationErr, "nameErr" => $nameErr, "emailErr" => $emailErr, "phoneErr" => $phoneErr, "commPrefErr" => $commPrefErr, 
                  "messageErr" => $messageErr, "valid" => $valid);
}

function showContactForm ($data) {
    echo '
      <form method="post" action="index.php" >    
    <div>
        <label for="salutation">Aanhef:</label>
        <select id="salutation" name="salutation">
            <option value="">Maak een keuze</option>
            <option value="man" '; if ($data ["salutation"] == "man") { echo "selected"; } echo '>'.SALUTATIONS['man'].'</option>
            <option value="woman" '; if ($data ["salutation"] == "woman") { echo "selected"; }echo '>'.SALUTATIONS['woman'].'</option>
            <option value="other" '; if ($data ["salutation"] == "other") { echo "selected"; } echo '>'.SALUTATIONS['other'].'</option> 
        </select>
      <span class="error"> '. $data ["salutationErr"] .'</span>
    </div> 
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
    <label for="phone">Telefoonnummer:</label>
    <input type="tel" id="phone" name="phone" value="'. $data ["phone"] .'">
    <span class="error"> '. $data ["phoneErr"] .' </span>
    </div>
    <div>
    <label for="commPref">Communicatievoorkeur:</label>
    <input type="radio" id="cp_e-mail" name="commPref" value="email" '; if ($data ["commPref"] == "email") { echo "checked"; } echo '><label for="cp_e-mail">'.COMMPREFS["email"].'</label>
    <input type="radio" id="cp_phone" name="commPref" value="phone" '; if ($data ["commPref"] == "phone") { echo "checked"; } echo '><label for="cp_phone">'.COMMPREFS["phone"].'</label>
    <span class="error"> '. $data ["commPrefErr"] .' </span>
    </div>
    <div>
    <label for="message">Geef uw bericht:</label>
    </div>
    <div>
    <textarea rows="10" cols="70" id="message" name="message">'. $data ["message"] .'</textarea>
    <span class="error"> '. $data ["messageErr"] .' </span>
    </div>
    <input type="hidden" name="page" value="contact">
    <div>
  <input type="submit" value="Verzend"> 
    </div>
</form> ';
}

function showContactThanks ($data) {
    echo '<p>Bedankt voor uw reactie:</p> 
    <div>Aanhef: '. SALUTATIONS [ $data ["salutation"] ] .'</div>    
    <div>Naam: '. $data ["name"] .' </div>
    <div>Email: '. $data ["email"] .' </div>
    <div>Telefoonnummer: '. $data ["phone"] .' </div>
    <div>Communicatievoorkeur: '. COMMPREFS[ $data ["commPref"] ].' </div>
    <div>Uw bericht: '. $data ["message"] .' </div> ';
}