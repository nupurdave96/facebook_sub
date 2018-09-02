<?php

error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
ob_start();
session_start();

define('PROJECT_NAME', 'Login System with facebook ');
define('DB_SERVER', 'aliassurbhi.db.9462939.hostedresource.com');
define('DB_SERVER_USERNAME', 'aliassurbhi');
define('DB_SERVER_PASSWORD', 'Demo5@1212');
define('DB_DATABASE', 'aliassurbhi');


/* * ***** facebook related activities start ** */
require 'facebook_library/facebook.php';

define("APP_ID", "589688641210673");
define("APP_SECRET", "fbf74ae167c1adb59ebc3365d8d6e827");
/* make sure the url end with a trailing slash */
define("SITE_URL", "http://demo5.brainoorja.com/facebook/");
/* the page where you will be redirected after login */
define("REDIRECT_URL", SITE_URL."facebook_login.php");
/* Email permission for fetching emails. */
define("PERMISSIONS", "public_profile");


/*  If database connection is OK, then proceed with facebook * */
// create a facebook object
$facebook = new Facebook(array('appId' => APP_ID, 'secret' => APP_SECRET));
$userID = $facebook->getUser();

// Login or logout url will be needed depending on current user login state.
if ($userID) {
  $logoutURL = $facebook->getLogoutUrl(array('next' => SITE_URL . 'logout.php'));
} else {
  $loginURL = $facebook->getLoginUrl(array('scope' => PERMISSIONS, 'redirect_uri' => REDIRECT_URL));
}
?>