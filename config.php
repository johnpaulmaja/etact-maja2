<?php

//config.php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('947482041440-33e8qh9nlu3vemrq1brcp9jdbb1a582v.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('ACl_dvm1FbABsfeSpnR9QxvX');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost/api/index.php');

//
$google_client->addScope('email');

$google_client->addScope('profile');

//start session on web page
session_start();

?>