<?php
    require_once 'vendor/autoload.php';
    date_default_timezone_set("Asia/Bangkok");

    define('SITE_KEY', '6Lf9dswZAAAAAInMtWojJTOaAakOkKg1xBigU0oQ');
    define('SECRET_KEY', '6Lf9dswZAAAAADtUjzALRbXMbSdtjl-T6QKKHWH8');

    //define('SITE_KEY', '6Lf9dswZAAAAAInMtWojJTOaAakOkKg1xBigU0oQ');
    //define('SECRET_KEY', '6Lf9dswZAAAAADtUjzALRbXMbSdtjl-T6QKKHWH8');
    define('SECRET_WEB', 'GGEZ-T6QKKHWH8');
    define("ENCRYPTION_KEY", "GGEZ-T6QKKHWH8!@#$%^&*");

    define("CODE_IV", "1234567891011121");
    define("CODE_KEY", "GGEZT6QKKHWH8");


    define('LOCAL_WEB', 'http://localhost/shop2');
    // --------------- google api faekbook --------------
    // include 'src/Facebook/autoload.php'; // path to your autoload.php
    define('Facebook_appId', '501334741601521');
    // --------------- google api login --------------
    // init configuration
    $clientID = '321239954341-ptf0td0rsunj86jm4jja0rv9cmd6h487.apps.googleusercontent.com';
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
    $name = 'shop2';

    $admin_status = 7; //status admin db
    $vip_status = 5; //status vip db

    $connect = new mysqli($host,$user,$pass,$name);
    $connect->query('SET names utf8'); 
    if($connect->connect_errno){
        exit($connect->connect_error);
    }
    session_start();
?>