<?php
define("APPID","577003342437698");
define("SECRET","a7abc6b9b73073482cf9e0eb348d1452");

require 'facebook/facebook.php';

$facebook = new Facebook(array(
  'appId'  => APPID,
  'secret' => SECRET,
));


?>
