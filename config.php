<?php

// Register your app with Google and place the key and secret here
// Visit: http://code.google.com/apis/accounts/docs/RegistrationForWebAppsAuto.html
$CONSUMER_KEY = '';
$CONSUMER_SECRET = '';

/*------------------------------------------------------------------------------------*/

// We use the Zend Oauth framework
// This can be found here: http://framework.zend.com/
require_once 'Zend/Oauth/Consumer.php';

// Set the scope of your application
$SCOPES = array(
  'https://www.googleapis.com/auth/latitude'
);

// Set the OAuth options
$oauthOptions = array(
  'requestScheme' => Zend_Oauth::REQUEST_SCHEME_HEADER,
  'version' => '1.0',
  'consumerKey' => $CONSUMER_KEY,
  'consumerSecret' => $CONSUMER_SECRET,
  'signatureMethod' => 'HMAC-SHA1',
  'xoauth_displayname' => 'Latitude Uploader',
  'requestTokenUrl' => 'https://www.google.com/accounts/OAuthGetRequestToken',
  'userAuthorizationUrl' => 'https://www.google.com/latitude/apps/OAuthAuthorizeToken',
  'accessTokenUrl' => 'https://www.google.com/accounts/OAuthGetAccessToken',
  'location' => 'all',
  'granularity' => 'best'
);

?>