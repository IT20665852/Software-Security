<?php
require_once 'vendor/autoload.php';

$client = new Google_Client();
$client->setClientId('608950536132-bmtp21fm3etmk5tblqq03pndl71jh6ff.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/PHP-Blog-master/oauth2callback.php');
$client->addScope("email");
$client->addScope("profile");

$auth_url = $client->createAuthUrl();
header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
