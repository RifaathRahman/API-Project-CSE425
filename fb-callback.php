<?php


session_start();
require 'Facebook/autoload.php';

$fb = new \Facebook\Facebook([
  'app_id' => '6410125645706362',
  'app_secret' => '5aee89322d8d7ea6ba59f2e379663148',
  'default_graph_version' => 'v13.0',
]);

$helper = $fb->getRedirectLoginHelper();

try {
  $accessToken = $helper->getAccessToken();
} catch (\Facebook\Exceptions\FacebookResponseException $e) {
  // When Facebook returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch (\Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (!isset($accessToken)) {
  if ($helper->getError()) {
    // Handle errors due to user denied the request
    header('HTTP/1.0 401 Unauthorized');
    echo "Error: " . $helper->getError() . "\n";
    echo "Error Code: " . $helper->getErrorCode() . "\n";
    echo "Error Reason: " . $helper->getErrorReason() . "\n";
    echo "Error Description: " . $helper->getErrorDescription() . "\n";
  } else {
    header('HTTP/1.0 400 Bad Request');
    echo 'Bad request';
  }
  exit;
}

// Logged in
$_SESSION['facebook_access_token'] = $accessToken->getValue();

// Redirect to your desired page after successful login
header("Location: profile.php");

?>
