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
  echo '<link rel="stylesheet" href="CSS\mystyle.css">';
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
    echo '<h1 class="title">';    
    switch ($page) 
   { 
       case 'home':
          require_once('home.php');
          showHomeHeader();
          break;
       case 'about':
          require_once('about.php');
          showAboutHeader();
          break;
       case 'contact':
       require_once('contact.php');
       showContactHeader();
          break;  
   }     
    echo '</h1>';  
} 

function showMenu ()
{
   echo '<ul class="navigation">
    <li><a HREF="index.php?page=home">Home</a></li>
    <li><a HREF="index.php?page=about">About</a></li>
    <li><a HREF="index.php?page=contact">Contact</a></li>
   </ul>' ;
}
  
function showContent($page) 
{ 
   switch ($page) 
   { 
       case 'home':
          require_once('home.php');
          showHomeContent();
          break;
       case 'about':
          require_once('about.php');
          showAboutContent();
          break;
       case 'contact':
       require_once('contact.php');
       showContactContent();
          break;  
   }     
} 

function showFooter ()
  {
      echo '<footer>';
      echo '<p><span>&copy;</span> 2022 Author: Hanne Meijers</p>';
      echo '</footer>';
  }
  
function showThanks
