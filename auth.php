<?php

require_once("config.php");

// $oauthOptions specified in config.php
$consumer = new Zend_Oauth_Consumer($oauthOptions);

// Request an access token
$request_token_string = $consumer->getRequestToken(array('scope' => implode(' ', $SCOPES)));

// parse the request token for later use
parse_str($request_token_string, $request_token_array);

// Open the URL in the users browser for authorisation
$approvalUrl = $consumer->getRedirectUrl(array('domain' => $CONSUMER_KEY, 'hd' => 'default', 'location' => 'all', 'granularity' => 'best', 'oauth_callback' => 'oob'));
exec("open " . escapeshellarg($approvalUrl));

// Request the authorisation code off the user
print('Enter authorisation code: ');
$authcode = fgets(STDIN);

// Convert the response into an access token
$requestResponse = array(	'oauth_verifier' => $authcode,
							'oauth_token' => $request_token_array['oauth_token']
							);
							
$accessToken = $consumer->getAccessToken($requestResponse, $request_token_string);

// Save the access token so that we can use it later
if(!$fp = fopen( "token.txt",'w' )) die('Error opening file.');
if(!fwrite($fp,serialize($accessToken))) die('Error writing data to file');
fclose($fp);

?>