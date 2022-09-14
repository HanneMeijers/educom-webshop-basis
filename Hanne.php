<?php
require_once ("repository.php");

$user = findUserByEmail ("coach@man-kind.nl");
print_r($user);