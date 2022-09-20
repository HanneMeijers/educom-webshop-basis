<?php 

define("SALUTATIONS", array ( "man" => "Man", "woman" => "Vrouw","other" => "Anders"));
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

        $salutation = cleanupInputFromUser(getPostDataVariabele("salutation"));
        if (empty($salutation)) { 
        $salutationErr = "Aanhef is verplicht"; 
        } 

        /* validate the name */
        $name = cleanupInputFromUser(getPostDataVariabele("name"));
        if (empty($name)) {
            $nameErr = "Naam is verplicht";
        }

        $email = cleanupInputFromUser(getPostDataVariabele("email"));
        if (empty($email)) {
            $emailErr = "E-mail is verplicht";
        }

        $phone = cleanupInputFromUser(getPostDataVariabele("phone"));
        if (empty($phone)) {
            $phoneErr = "Telefoonnummer verplicht";
        }    

        $commPref = cleanupInputFromUser(getPostDataVariabele("commPref"));
        if (empty($commPref)) {
            $commPrefErr = "Communicatievoorkeur verplicht";
        }

        $message = cleanupInputFromUser(getPostDataVariabele("message"));
        if (empty ($message)) {
            $messageErr = "Bericht is verplicht";
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
            <option value="">Maak een keuze</option>';
    foreach(SALUTATIONS as $salutationKey => $salutationValue) {
        echo PHP_EOL . '<option value="' . $salutationKey . '" ';
        if ($data ["salutation"] == $salutationKey) { echo "selected"; } 
        echo '>' .$salutationValue. '</option>';  
    }     
    echo '</select> 
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
    <label for="commPref">Communicatievoorkeur:</label>' . PHP_EOL;
    foreach(COMMPREFS as $key => $value) {
       echo '<input type="radio" id="cp_' . $key . '" name="commPref" value="' . $key . '" '; if ($data ["commPref"] == $key) { echo "checked"; } echo '><label for="cp_' . $key . '">'.$value.'</label>' . PHP_EOL;
    }
    echo '<span class="error"> '. $data ["commPrefErr"] .' </span>
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