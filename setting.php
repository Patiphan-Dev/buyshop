<?php
    // suppress deprecation notices from third-party libraries (e.g. Google API)
    // these warnings are thrown when PHP parses the Google API source files
    // and are not useful during normal operation.  We need to set this **before*
    // loading the autoloader so that the notices are silenced during parsing.
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);
    require_once 'vendor/autoload.php';
    date_default_timezone_set("Asia/Bangkok");

    define('SITE_KEY', '6Lf9dswZAAAAAInMtWojJTOaAakOkKg1xBigU0oQ');
    define('SECRET_KEY', '6Lf9dswZAAAAADtUjzALRbXMbSdtjl-T6QKKHWH8');

    define('SECRET_WEB', 'GGEZ-T6QKKHWH8');
    define("ENCRYPTION_KEY", "GGEZ-T6QKKHWH8!@#$%^&*");

    define("CODE_IV", "1234567891011121");
    define("CODE_KEY", "GGEZT6QKKHWH8");


    // compute base URL dynamically so CSS/JS links work regardless of
    // whether built-in server, Apache, or a subdirectory is used.
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    // dirname of script path (e.g. /folder) - remove trailing slash
    $path = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
    define('LOCAL_WEB', $protocol.'://'.$host.$path);
    // --------------- google api faekbook --------------
    // include 'src/Facebook/autoload.php'; // path to your autoload.php
    define('Facebook_appId', '3602133873380379');
    // --------------- google api login --------------
    // init configuration
    $clientID = '33665884902-ni33ffaosroli2247jfh5gas1o6o4oj3.apps.googleusercontent.com';
    $clientSecret = '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';
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

    // use 127.0.0.1 instead of localhost to force TCP when socket isn't available
    // (prevents "No such file or directory" errors on macOS MySQL installs).
    // If you need a specific port, use '127.0.0.1:3306' or similar.
    $host = '127.0.0.1';
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