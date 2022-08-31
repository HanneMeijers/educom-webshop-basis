<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="CSS\mystyle.css">
</head>
<body>
<?php
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

}
/**
 * Takes the input of a user and trims the whithespace in front en behind
 * and removes all html special characters or replaces them with HTML equvalents
 *
 * @param string $data the user input
 * @returns string the cleaned string.
 */
function cleanupInputFromUser($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

  <h1 class="title">Contactformulier</h1>
   <ul class="navigation">
    <li><a HREF="index.html">Home</a></li>
    <li><a HREF="about.html">About</a></li>
    <li><a HREF="contact.php">Contact</a></li>
   </ul>
   
   <?php if (!$valid) { /* Show the next part only when $valid is false */ ?>;
      
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">;    
    <div>
        <label for="salutation">Aanhef:</label>
        <select id="salutation" name="salutation">
            <option value="">Maak een keuze</option>
            <option value="man" <?php if ($salutation == "man") { echo "selected"; } ?>>Man</option>
            <option value="woman" <?php if ($salutation == "woman") { echo "selected"; }?>>Vrouw</option>
            <option value="other" <?php if ($salutation == "other") { echo "selected"; }?>>Anders</option> 
        </select>
      <span class="error"> <?php echo $salutationErr; ?></span>
    </div>
    <div>
        <label for="name">Naam:</label>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>" placeholder="Jan Klaassen">
        <span class="error"> <?php echo $nameErr; ?></span>
    </div>
    <div>
    <label for="e-mail">E-mailadres:</label>
    <input type="email" id="e-mail" name="email" value="<?php echo $email; ?>">
    <span class="error"> <?php echo $emailErr; ?></span>
    </div>
    <div>
    <label for="phone">Telefoonnummer:</label>
    <input type="tel" id="phone" name="phone" value="<?php echo $phone; ?>">
    <span class="error"> <?php echo $phoneErr; ?></span>
    </div>
    <div>
    <label for="commPref">Communicatievoorkeur:</label>
    <input type="radio" id="cp_e-mail" name="commPref" value="email" <?php if ($commPref == "email") { echo "checked"; }?>><label for="cp_e-mail">E-mail</label>
    <input type="radio" id="cp_phone" name="commPref" value="phone" <?php if ($commPref == "phone") { echo "checked"; }?>><label for="cp_phone">Telefoon</label>
    <span class="error"> <?php echo $commPrefErr; ?></span>
    </div>
    <div>
    <label for="message">Geef uw bericht:</label>
    </div>
    <div>
    <textarea rows="10" cols="70" id="message" name="message" value="<?php echo $message; ?>"></textarea>
    <span class="error"> <?php echo $messageErr ?></span>
    </div>
    <div>
  <input type="submit" value="Verzend"> 
    </div>
</form>

    <?php } else { /* Show the next part only when $valid is true */ ?>;

    <p>Bedankt voor uw reactie:</p> 
    <div>Aanhef: <?php echo $salutation; ?></div>;    
    <div>Naam: <?php echo $name; ?></div>;
    <div>Email: <?php echo $email; ?></div>;
    <div>Telefoonnummer <?php echo $phone; ?></div>;
    <div>Communicatievoorkeur <?php echo $commPref; ?></div>
    <div>Uw bericht: <?php echo $message; ?></div>;

    <?php } /* End of conditional showing */ ?>;

 <footer>
  <p><span>&copy;<span> 2022 Author: Hanne Meijers</p>
 </footer>
</body>
</html>