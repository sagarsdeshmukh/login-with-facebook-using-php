<?php
session_start();
 
require_once('Facebook/FacebookSession.php');
require_once('Facebook/FacebookRedirectLoginHelper.php');
require_once('Facebook/FacebookRequest.php');
require_once('Facebook/FacebookResponse.php');
require_once('Facebook/FacebookSDKException.php');
require_once('Facebook/FacebookRequestException.php');
require_once('Facebook/FacebookAuthorizationException.php');
require_once('Facebook/GraphObject.php');
require_once('Facebook/HttpClients/FacebookCurl.php');
require_once('Facebook/HttpClients/FacebookHttpable.php');
require_once('Facebook/HttpClients/FacebookCurlHttpClient.php');
require_once('Facebook/Entities/AccessToken.php');
require_once('Facebook/GraphUser.php');
 
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\HttpClients\FacebookCurl;
use Facebook\HttpClients\FacebookHttpable;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\Entities\AccessToken;
use Facebook\GraphUser;
 
$app_id = 'YOUR_APP_ID';
$app_secret = 'YOUR_APP_SECRET';
 
FacebookSession::setDefaultApplication($app_id, $app_secret);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Facebook SDK example</title>
</head>
<body>
<?
 
$helper = new FacebookRedirectLoginHelper("https://www.apptic.me/blog/facebook-sdk-test.php", $app_id, $app_secret);
try {
    $session = $helper->getSessionFromRedirect();
}
catch(FacebookRequestException $ex) { } 
catch(\Exception $ex) { }
 
$loggedIn = false;
 
if (isset($session)){
    if ($session) {
        $loggedIn = true;
        try {
          // Logged in
          
          $user_photos = (new FacebookRequest(
            $session, 'GET', '/me/photos/uploaded'))->execute()->getGraphObject(GraphUser::className());
          $user_photos = $user_photos->asArray();
          $pic = $user_photos["data"][0]->{"source"};
          //print_r($user_photos);
          echo "<img src='$pic' />";
        } catch(FacebookRequestException $e) {
            echo "Exception occured, code: " . $e->getCode();
            echo " with message: " . $e->getMessage();
        }   
    }
}
if (!$loggedIn){
  $loginUrl = $helper->getLoginUrl(array('user_photos'));
  echo "<a href='$loginUrl'>Login";
}
?>
</body>
</html>