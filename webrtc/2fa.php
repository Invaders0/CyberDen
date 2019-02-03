<?php
$g = new \Google\Authenticator\GoogleAuthenticator();
$salt = '7WAO342QFANY6IKBF7L7SWEUU79WL3VMT920VB5NQMW';
$secret = $username.$salt;
$check_this_code = $_POST['code'];
if ($g->checkCode($secret, $check_this_code)) {
  echo 'Success!';
} else {
  echo 'Invalid login';
}
?>