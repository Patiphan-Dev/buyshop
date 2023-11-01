<?php
    require_once 'vendor/autoload.php';
    date_default_timezone_set("Asia/Bangkok");

    define('SITE_KEY', '6Lf9dswZAAAAAInMtWojJTOaAakOkKg1xBigU0oQ');
    define('SECRET_KEY', '6Lf9dswZAAAAADtUjzALRbXMbSdtjl-T6QKKHWH8');

    define('SECRET_WEB', 'GGEZ-T6QKKHWH8');
    define("ENCRYPTION_KEY", "GGEZ-T6QKKHWH8!@#$%^&*");

    define("CODE_IV", "1234567891011121");
    define("CODE_KEY", "GGEZT6QKKHWH8");


    define('LOCAL_WEB', 'http://localhost/buyshop');
    // --------------- google api faekbook --------------
    // include 'src/Facebook/autoload.php'; // path to your autoload.php
    define('Facebook_appId', '3602133873380379');
    // --------------- google api login --------------
    // init configuration
    $clientID = '33665884902-ni33ffaosroli2247jfh5gas1o6o4oj3.apps.googleusercontent.com';
    $clientSecret = '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';
    $redirectUri = LOCAL_WEB.'/idpass.php?login_google';
    // create Client Request to access Google API
	$client = new Google_Client();
	$client->setClientId($clientID);
	$client->setClientSecret($clientSecret);
	$client->setRedirectUri($redirectUri);
	$client->addScope("email");
	$client->addScope("profile");
    // --------------- encryp id pass in shop --------------
    $ciphering = "AES-128-CTR";
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;
    $encryption_iv = CODE_IV;
    $encryption_key = CODE_KEY;
    $decryption_iv = CODE_IV;
    $decryption_key = CODE_KEY;
    // --------------- encryp id pass in shop --------------

    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $name = 'buyshop';

    $admin_status = 7; //status admin db
    $vip_status = 5; //status vip db

    $connect = new mysqli($host,$user,$pass,$name);
    $connect->query('SET names utf8'); 
    if($connect->connect_errno){
        exit($connect->connect_error);
    }
    session_start();
?>