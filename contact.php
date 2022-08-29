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
     $salutation = test_input($_POST["salutation"]);
  }

  if (empty($_POST["name"])) {
    $nameErr = "Naam is verplicht";
  } else {
     $name = test_input($_POST["name"]);
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "e-mail is verplicht";
  } else {
     $email = test_input($_POST["email"]);
  }
    
  if (empty($_POST["phone"])) {
    $phoneErr = "Telefoonnummer verplicht";
  } else {
     $phone = test_input($_POST["phone"]);
  }    
  
  if (empty($_POST["commPref"])) {
    $commPrefErr = "Communicatievoorkeur verplicht";
  } else {
     $commPref = test_input($_POST["salutation"]);
  }
  
}

function test_input($data) {
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
        <select id="salutation" name="salutation" value="<?php echo $salutation; ?>">
            <option value="">Maak een keuze</option>
            <option value="man">Man</option>
            <option value="woman">Vrouw</option>
            <option value="other">Anders</option>
        </select>
    </div>
    <div>
        <label for="name">Naam:</label>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>" placeholder="Jan Klaassen">
    </div>
    <div>
    <label for="e-mail">E-mailadres:</label>
    <input type="email" id="e-mail" name="email" value="<?php echo $email; ?>">
    </div>
    <div>
    <label for="phone">Telefoonnummer:</label>
    <input type="tel" id="phone" name="phone" value="<?php echo $phone; ?>">
    </div>
    <div>
  Communicatievoorkeur:
    <input type="radio" id="cp_e-mail" name="commPref" value="email"><label for="cp_e-mail">E-mail</label>
    <input type="radio" id="cp_phone" name="commPref" value="phone"><label for="cp_phone">Telefoon</label>
    </div>
    <div>
    <label for="message">Geef uw bericht:</label>
    </div>
    <div>
    <textarea rows="10" cols="70" id="message" name="message" value="<?php echo $message; ?>"></textarea>
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