<?php
require_once 'vendor/autoload.php';
session_start();

$client = new Google_Client();
$client->setClientId('608950536132-bmtp21fm3etmk5tblqq03pndl71jh6ff.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/PHP-Blog-master/oauth2callback.php');

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token);

    $oauth = new Google_Service_Oauth2($client);
    $userInfo = $oauth->userinfo->get();

    $_SESSION['user_name'] = $userInfo->name;
    $_SESSION['user_email'] = $userInfo->email;

    header('Location: index.php');
    exit();
}
