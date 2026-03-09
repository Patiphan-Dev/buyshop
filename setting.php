<?php
    // load environment variables and silence deprecation warnings early
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);
    require_once 'vendor/autoload.php';

    (\Dotenv\Dotenv::createImmutable(__DIR__))->load();
    date_default_timezone_set("Asia/Bangkok");

    define('SITE_KEY', getenv('SITE_KEY'));
    define('SECRET_KEY', getenv('SECRET_KEY'));

    define('SECRET_WEB', getenv('SECRET_WEB'));
    define('ENCRYPTION_KEY', getenv('ENCRYPTION_KEY'));

    define('CODE_IV', getenv('CODE_IV'));
    define('CODE_KEY', getenv('CODE_KEY'));


    // compute base URL dynamically so CSS/JS links work regardless of
    // whether built-in server, Apache, or a subdirectory is used.
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    // dirname of script path (e.g. /folder) - remove trailing slash
    $path = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
    define('LOCAL_WEB', $protocol.'://'.$host.$path);
    // --------------- google api faekbook --------------
    // include 'src/Facebook/autoload.php'; // path to your autoload.php
    define('Facebook_appId', getenv('FACEBOOK_APP_ID'));
    // --------------- google api login --------------
    // init configuration
    $clientID = getenv('GOOGLE_CLIENT_ID');
    $clientSecret = getenv('GOOGLE_CLIENT_SECRET');
    $redirectUri = LOCAL_WEB.'/idpass.php?login_google';
    // create Client Request to access Google API
    // temporarily keep deprecation messages off while instantiating the
    // Google client; the library triggers a bunch of notices about nullable
    // parameter hints which we don't care about.
    $oldReporting = error_reporting();
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);
    $client = new Google_Client();
    // restore previous error reporting level for the rest of the script
    error_reporting($oldReporting);
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

    // database connection parameters are stored in environment
    $host = getenv('DB_HOST') ?: '127.0.0.1';
    $user = getenv('DB_USER') ?: 'root';
    $pass = getenv('DB_PASS') ?: '';
    $name = getenv('DB_NAME') ?: 'buyshop';

    $admin_status = 7; //status admin db
    $vip_status = 5; //status vip db

    $connect = new mysqli($host,$user,$pass,$name);
    $connect->query('SET names utf8'); 
    if($connect->connect_errno){
        exit($connect->connect_error);
    }
    session_start();
?>