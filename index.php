<?php 
//Main applicatie
$page = getRequestedPage();
showResponsePage($page);

function getRequestedPage () {
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $requestedPage = getUrlVariabele('page', 'home');
    } else {
        $requestedPage = getPostDataVariabele('page');
    }
    return ($requestedPage);
    
}
/**
 * Zoek variabele in de url en retourneer deze.
 * @param $key dit is de naam van de variabele waar we naar op zoek zijn.
 * @param $default (optional) value to return when the $key is not found.
 * @return value of the $key or the $default if $key is not found. 
 */
function getUrlVariabele($key, $default = '') {
 return getArrayVar($_GET, $key, $default);
}
/**
 * Zoek variabele in de POST data en retourneer deze.
 * @param $key dit is de naam van de variabele waar we naar op zoek zijn.
 * @param $default (optional) value to return when the $key is not found.
 * @return value of the $key or the $default if $key is not found. 
 */
function getPostDataVariabele($key, $default = '') {
return getArrayVar($_POST, $key, $default);
}
/**
 * Zoek variabele in de $array en retourneer deze.
 * @param $array dit is de array waarin we gaan zoeken.
 * @param $key dit is de naam van de variabele waar we naar op zoek zijn.
 * @param $default (optional) value to return when the $key is not found.
 * @return value of the $key or the $default if $key is not found. 
 */
function getArrayVar($array, $key, $default='') 
{ 
   return isset($array[$key]) ? $array[$key] : $default; 
} 

function showResponsePage($page) {
   beginDocument(); 
   showHeadSection(); 
   showBodySection($page); 
   endDocument();  
}

function beginDocument() 
{ 
   echo '<!doctype html> 
<html>'; 
} 

function showHeadSection() 
{ 
  echo '<head>';
  echo '</head>';
}

function showBodySection($page) 
{ 
   echo '    <body>' . PHP_EOL; 
   showHeader($page);
   showMenu(); 
   showContent($page); 
   showFooter(); 
   echo '    </body>' . PHP_EOL; 
} 

function endDocument() 
{ 
   echo  '</html>'; 
} 

function showHeader($page) 
{ 
   echo '   <h1>
} 

function showContent($page) 
{ 
   switch ($page) 
   { 
       case 'home':
          require('home.php');
          showHomeContent();
          break;
       case 'about':
          require('about.php');
          showAboutContent();
          break;
       case 'contact':
       require('contact.php');
       showContactContent();
          break;  
   }     
} 

