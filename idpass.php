<?php

require('setting.php');

$result_info_web = $connect->query("SELECT * FROM tbl_setting WHERE id = 1")->fetch_assoc();

$count_users = $connect->query('SELECT * FROM tbl_users ; ')->num_rows;
$count_shop = $connect->query('SELECT * FROM tbl_shop_id ; ')->num_rows;
$count_shop_sell = $connect->query('SELECT * FROM tbl_shop_id WHERE `owner` != "" ; ')->num_rows;


if(isset($_GET['login'])) {
	if(empty($_POST['email']) || empty($_POST['password']))  {
		DisplayMSG('error','โอ้ะ...โอ!!', 'กรุณาอย่าเว้นช่องว่าง ✍️.','false');
	}
	if(empty($_POST['recaptcha']) )  {
		DisplayMSG('error','โอ้ะ...โอ!!', 'กรุณายืนยันตัวตน.','false');
	}
    // if (!preg_match('/^[a-zA-Z0-9\_]*$/', $_POST['username'])) {
	// 	DisplayMSG('error','โอ้ะ...โอ!!', 'ชื่อผู้ใช้ไม่ถูกต้อง ต้องเป็น A-Z 0-9 เท่านั้น !!.','false');
	// }
	// if(mb_strlen($_POST['username']) <= 4) {
	// 	DisplayMSG('error','โอ้ะ...โอ!!', 'ชื่อผู้ใช้อย่างน้อย 5 ตัวขึ้นไป !!','false');
	// }
	// if(mb_strlen($_POST['username']) >= 25) {
	// 	DisplayMSG('error','โอ้ะ...โอ!!', 'ชื่อผู้ใช้สูงสุด 24 ตัวขึ้นไป !!','false');
	// }
	if(strlen($_POST['password']) <= 4) {
		DisplayMSG('error','โอ้ะ...โอ!!', 'รหัสผ่านอย่างน้อย 5 ตัวขึ้นไป !!','false');
	}
	if(mb_strlen($_POST['password']) >= 25) {
		DisplayMSG('error','โอ้ะ...โอ!!', 'รหัสผ่านสูงสุด 24 ตัว !!','false');
	}

	$secretKey = SECRET_KEY;
	$captcha = $_POST['recaptcha'];
    $ip = $_SERVER['REMOTE_ADDR'];
        // post request to server
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
    $response = file_get_contents($url);
    $responseKeys = json_decode($response,true);
        // should return JSON with success as true
    if($responseKeys["success"]) {

		// $username = $connect->real_escape_string($_POST['username']);
		$email = $connect->real_escape_string($_POST['email']);
		$password = md5($_POST['password'].SECRET_WEB);
		$query = $connect->query('SELECT * FROM tbl_users WHERE email = "'.$email.'" AND password = "'.$password.'" ');
		$username_check = $query->num_rows;
		$account = $query->fetch_assoc();
		if($username_check == 0){
			DisplayMSG('error','Error', 'ชื่อผู้ใช้ หรือ รหัสผ่านไม่ถูกต้อง !!','false');
		}
		if($account['status'] == "0"){
			DisplayMSG('error','Banned !!!', 'บัญชีของคุณถูกแบนถาวร !!!','false');
		}else {
			$_SESSION['username'] = $email;
			$connect->query("UPDATE tbl_users SET ip = '".$ip."' WHERE email = '$email' ;");
			DisplayMSG('success','Login Success !!!', 'เข้าสู่ระบบสำเร็จ !!','true');
		}
	}else {
        DisplayMSG('error','Are you a rebot!!', 'กรุณายืนยันตัวตน.','true');
    }
}

if(isset($_GET['register'])) {
	if(empty($_POST['username']) || empty($_POST['password']))  {
	   DisplayMSG('error','โอ้ะ...โอ!! ❗️❗️', 'กรุณาอย่าเว้นช่องว่าง ✍️.','false');
    }
    if(empty($_POST['email']))  {
        DisplayMSG('error','โอ้ะ...โอ!! ❗️❗️', 'กรุณากรอกอีเมลที่ติดต่อได้จริง 📵.','false');
    }
	if (!preg_match('/^[a-zA-Z0-9\_]*$/', $_POST['username'])) {
		DisplayMSG('error','โอ้ะ...โอ!!', 'ชื่อผู้ใช้ไม่ถูกต้อง ต้องเป็น A-Z 0-9 เท่านั้น !!.','false');
	}
	if(mb_strlen($_POST['username']) <= 4) {
		DisplayMSG('error','โอ้ะ...โอ!!', 'ชื่อผู้ใช้อย่างน้อย 5 ตัวขึ้นไป !!','false');
	}
	if(mb_strlen($_POST['username']) >= 25) {
		DisplayMSG('error','โอ้ะ...โอ!!', 'ชื่อผู้ใช้สูงสุด 24 ตัวขึ้นไป !!','false');
	}
	if(strlen($_POST['password']) <= 4) {
		DisplayMSG('error','โอ้ะ...โอ!!', 'รหัสผ่านอย่างน้อย 5 ตัวขึ้นไป !!','false');
	}
	if(mb_strlen($_POST['password']) >= 25) {
		DisplayMSG('error','โอ้ะ...โอ!!', 'รหัสผ่านสูงสุด 24 ตัว !!','false');
	}
	if($_POST['password'] != $_POST['repassword'])  {
	  DisplayMSG('error','โอ้ะ...โอ!!', 'รหัสผ่าน ไม่ตรงกัน !!','false');
	}
	if(empty($_POST['recaptcha']) )  {
		DisplayMSG('error','โอ้ะ...โอ!!', 'กรุณายืนยันตัวตน.','false');
	}

	$secretKey = SECRET_KEY;
	$captcha = $_POST['recaptcha'];
	$ip = $_SERVER['REMOTE_ADDR'];
        // post request to server
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
    $response = file_get_contents($url);
    $responseKeys = json_decode($response,true);
        // should return JSON with success as true
    if($responseKeys["success"]) {
			$username = $connect->real_escape_string($_POST['username']);
			$email = $connect->real_escape_string($_POST['email']);
			$password = md5($_POST['password'].SECRET_WEB);
			$query = $connect->query('SELECT * FROM tbl_users WHERE email = "'.$email.'" ');
			$username_check = $query->num_rows;
		if($username_check >= 1){
			DisplayMSG('error','Error', ' มีผู้ใช้งานไปแล้ว !!!','false');
		}else {
			$query = $connect->query("INSERT INTO `tbl_users` (`id`, `img`, `username`, `password`, `email`, `point`, `ip`, `status`) VALUES (NULL, 'assets/img/anya.jpg', '".$username."', '".$password."', '".$email."', '0', '".$ip."', '1');");

			$_SESSION['username'] = $email;
            
			DisplayMSG('success','Register Success !!!', 'สมัครสมาชิกสำเร็จ !!!..','true');
		}
	}else {
        DisplayMSG('error','Are you a rebot!!', 'กรุณายืนยันตัวตน.','true');
    }
}

if(isset($_GET['logout'])) {
	session_destroy();
	DisplayMSG('success','Logout Success!!','ออกจากระบบเรียบร้อยแล้ว','true');
	// DisplayMSG('success','Logout Success!!','ออกจากระบบเรียบร้อยแล้ว','true','./home');
}

if(isset($_GET['login_google'])) {
	$token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
	$client->setAccessToken($token['access_token']);

	// get profile info
	$google_oauth = new Google_Service_Oauth2($client);
	$google_account_info = $google_oauth->userinfo->get();
	$userinfo = [
		'email' => $google_account_info['email'],
		'first_name' => $google_account_info['givenName'],
		'last_name' => $google_account_info['familyName'],
		'gender' => $google_account_info['gender'],
		'full_name' => $google_account_info['name'],
		'picture' => $google_account_info['picture'],
		'verifiedEmail' => $google_account_info['verifiedEmail'],
		'token' => $google_account_info['id'],
	];

	$username = $userinfo['first_name'];
	$ip = $_SERVER['REMOTE_ADDR'];
	$img = $userinfo['picture'];
	$email = $userinfo['email'];
	$password = $userinfo['token'];
	$query = $connect->query('SELECT * FROM tbl_users WHERE email = "'.$email.'"; ');
	$email_check = $query->num_rows;
	$account = $query->fetch_assoc();
	if($email_check == 0){
		// DisplayMSG('error','Error', 'ชื่อผู้ใช้ หรือ รหัสผ่านไม่ถูกต้อง !!','false');
		$query = $connect->query("INSERT INTO `tbl_users` (`id`, `img`, `username`, `password`, `email`, `point`, `ip`, `status`) 
		VALUES (NULL, '".$img."', '".$username."', '".$password."', '".$email."', '0', '".$ip."', '1');");
		$_SESSION['username'] = $email;
		header("Location: index.php");
	}
	if($account['status'] == "0"){
		header("Location: index.php");
		// DisplayMSG('error','Banned !!!', 'บัญชีของคุณถูกแบนถาวร !!!','false');
	}else {
		$_SESSION['username'] = $email;
		$connect->query("UPDATE tbl_users SET ip = '".$ip."' WHERE username = '$email' ;");
		header("Location: index.php");
		// DisplayMSG('success','Login Success !!!', 'เข้าสู่ระบบสำเร็จ !!','true');
	}
}

if(isset($_GET['login_facebook'])) {

	$ip = $_SERVER['REMOTE_ADDR'];
	$img = $_POST['img'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	if(empty($email)){
		$email = $password."@fb.com";
	}
	
	$query = $connect->query('SELECT * FROM tbl_users WHERE email = "'.$email.'"; ');
	$email_check = $query->num_rows;
	$account = $query->fetch_assoc();
	if($email_check == 0){
		$query = $connect->query("INSERT INTO `tbl_users` (`id`, `img`, `username`, `password`, `email`, `point`, `ip`, `status`) 
		VALUES (NULL, '".$img."', '".$username."', '".$password."', '".$email."', '0', '".$ip."', '1');");
		$_SESSION['username'] = $email;
		// header("Location: index.php");
		DisplayMSG('success','Login Success !!!', 'เข้าสู่ระบบสำเร็จ !!','true');
	}
	if($account['status'] == "0"){
		// header("Location: index.php");
		DisplayMSG('error','Banned !!!', 'บัญชีของคุณถูกแบนถาวร !!!','false');
	}else {
		$_SESSION['username'] = $email;
		$connect->query("UPDATE tbl_users SET ip = '".$ip."' WHERE email = '$email' ;");
		// header("Location: index.php");
		DisplayMSG('success','Login Success !!!', 'เข้าสู่ระบบสำเร็จ !!','true');
	}

}

//status login
if(isset($_SESSION['username'])) {
    //ดึงข้อมูล user
    $users = $connect->query('SELECT * FROM `tbl_users` WHERE `email` = "'.$_SESSION['username'].'" ')->fetch_assoc();
    $users_status = $users['status'];
    $users_username = $users['username'];
    $users_point = $users['point'];
    $users_profile = $users['img'];
    $users_email = substr($users['email'], 0, 3).'****'.substr($users['email'], strpos($users['email'], "@"));

	if($users_status == 0){//ban
		session_destroy();
		header("Refresh:0");
	}

    if(isset($_GET['reprofile'])) {
        if(empty($_POST['urlimg']))  {
            DisplayMSG('error','Warning ❗️❗️', 'กรุณาอย่าเว้นช่องว่าง ✍️.','false');
        }
		// if (!preg_match('/^[a-zA-Z0-9\_]*$/', $_POST['urlimg'])) {
		// 	DisplayMSG('error','Error', 'มีอักษรต้องห้าม.','false');
		// }
        $urlimg = $connect->real_escape_string($_POST['urlimg']);
        $users = $connect->query("UPDATE `tbl_users` SET `img` = '".htmlspecialchars($urlimg)."' WHERE username = '".$users_username."';");
        
        DisplayMSG('success','Save Profile Success!!','บันทึกข้อมูลเรียบร้อย!!','true');
    }

    if(isset($_GET['repassword'])) {
        if(empty($_POST['urlimg']))  {
            DisplayMSG('error','Warning ❗️❗️', 'กรุณาอย่าเว้นช่องว่าง ✍️.','false');
        }
		if (!preg_match('/^[a-zA-Z0-9\_]*$/', $_POST['urlimg'])) {
			DisplayMSG('error','Error', 'มีอักษรต้องห้าม.','false');
		}
        $urlimg = $connect->real_escape_string($_POST['urlimg']);
        $users = $connect->query("UPDATE `tbl_users` SET `img` = '".htmlspecialchars($urlimg)."' WHERE username = '".$users_username."';");
        
        DisplayMSG('success','Save Profile Success!!','บันทึกข้อมูลเรียบร้อย!!','true');
    }

	//เติมเงิน
	if(isset($_GET['topupwallet'])) {
		//echo $_POST['link_topup'] . $web_info['web_phone'];
		if (empty($_POST['link_topup']))  {
			DisplayMSG('error','Error', 'ไม่พบซองอั๋งเปานี้','false');
		}
		$secretKey = SECRET_KEY;
		$captcha = $_POST['recaptcha'];
		$ip = $_SERVER['REMOTE_ADDR'];
		// post request to server
		$url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
		$response = file_get_contents($url);
		$responseKeys = json_decode($response,true);
		// should return JSON with success as true
		if($responseKeys["success"]) {
			
			$link = $_POST['link_topup'];
			$phone = "0647024408";//$web_info['web_phone']; //เบอร์รับอังเปา
			class topup {
				function giftcode($hash = null,$phone = null) {
					if (is_null($hash) || is_null($phone)) return false;
					$ch = curl_init();
					@$hash = explode('?v=',$hash)[1];
					$headers  = [
						'Content-Type: application/json',
						'Accept: application/json'
					];
					$postData = [
						'mobile' => $phone,
						'voucher_hash' => $hash
					];
					curl_setopt($ch, CURLOPT_URL,"https://gift.truemoney.com/campaign/vouchers/$hash/redeem");
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));           
					curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
					curl_setopt ($ch, CURLOPT_SSLVERSION, 7);
					curl_setopt( $ch, CURLOPT_USERAGENT, "aaaaaaaaaaa" );
					$result     = curl_exec ($ch);
					$statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
					return json_decode($result,true);
				}
			}
			$topup_truewallet = new topup();
			$truewallet = (object) $topup_truewallet->giftcode($link ,$phone);
			
			if(@$truewallet->status['code'] == 'VOUCHER_OUT_OF_STOCK'){
				DisplayMSG('error','Error', 'ซองเติมเงินนี้ถูกใช้งานไปแล้ว','true');
				// ซองเติมเงินนี้ถูกใช้งานไปแล้ว
			}elseif(@$truewallet->status['code'] == 'VOUCHER_EXPIRED'){
				DisplayMSG('error','Error', 'ซองเติมเงินนี้หมดอายุ','true');
				// ซองเติมเงินนี้หมดอายุ
			}
			elseif(@$truewallet->status['code'] == 'VOUCHER_NOT_FOUND'){
				DisplayMSG('error','Error', 'ไม่พบซอง','true');
				// ไมพบซอง
			}elseif(@$truewallet->status['code'] == null){
				DisplayMSG('error','Error', 'ไม่พบซองอั๋งเปานี้','true');
				// กรอกมั่ว
			}else{
				if(@$truewallet->data['voucher']['member'] != "1"){
					DisplayMSG('error','Error', 'ผู้รับซองต้องเป็น 1 คน','true');
					// ผู้รับซองต้องเป็น 1 คน
				}else{
					// เติมเงินสำเร็จ
					$price = $truewallet->data['voucher']['amount_baht'];
					$sum_point = $users_point + $price;

					$query1 = $connect->query("INSERT INTO `tbl_topup` (`id`, `topupby`, `topuptime`, `point`, `status`, `username`) VALUES (NULL, 'อั่งเป่า', '".time()."', '".$price."', '1', '".$users_username."');");
					$query2 = $connect->query("UPDATE tbl_users SET point = '".$sum_point."' WHERE username = '".$users_username."'");

					DisplayMSG('success','คุณได้รับ '. $price . ' Point', 'ขอบคุณมากๆครับ','true');
				
				}
			}

		}else{
			DisplayMSG('error','Error', 'กรุณายืนยันตัวตนใหม่','true');
		}
	}

	//สังซื้อ
	if(isset($_GET['buyshopid'])) {
        if(empty($_GET['id']))  {
            DisplayMSG('error','Warning ❗️❗️', 'ไม่พบสินค้านี้ ✍️.','false');
        }
        $idshop = $connect->real_escape_string($_GET['id']);
		//ดึงข้อมูลสินค้า
		$shop_info = $connect->query('SELECT * FROM `tbl_shop_id` WHERE `id` = "'.$idshop.'" ')->fetch_assoc();

		if($users_status == $vip_status){//vip
			$point_this_shop = $shop_info['pointv'];
		}else{
			$point_this_shop = $shop_info['point'];
		}

		if(!empty($result_shopa['owner'])){
			DisplayMSG('error','Warning ❗️❗️', 'สินค้านี้จำหน่ายไปแล้ว ✍️.','false');
		}else if ($users_point >= $point_this_shop) {
			//อัพเดทเจ้าของสินค้า
			$shop_update = $connect->query("UPDATE `tbl_shop_id` SET `status` = '2', `owner` = '".$users_username."' WHERE id = '".$idshop."';");
			//ตัดเครดิต
			$sums_point = $users_point - $point_this_shop;
			$query_point = $connect->query("UPDATE tbl_users SET point = '".$sums_point."' WHERE username = '".$users_username."'");

			$add_history = $connect->query("INSERT INTO `tbl_shop_history` (`id`, `secret_info`, `timeadd`, `point`, `username`, `gameid`, `status`) 
			VALUES (NULL, '".$shop_info['secret_info']."', '".time()."', '".$point_this_shop."', '".$users_username."', '".$idshop."', '1');");
				
			DisplayMSG('success','Buy Success!!','สั่งซื้อเรียบร้อย!!','true');
		}else{
			DisplayMSG('error','Warning ❗️❗️', 'เครดิตของคุณไม่เพียงพอ กรุณาเติมเงิน.','false');
		}
        
    }

	//สั่งซื้อ API
	if(isset($_GET['buy_pshop'])) {
		if(empty($_GET['id']))  {
			DisplayMSG('error','Warning ❗️❗️', 'ไม่พบสินค้า ✍️.','false');
		}
		$idshop = $connect->real_escape_string($_GET['id']);
		$shop_info = $connect->query('SELECT * FROM `tbl_shop_stock_api` WHERE `id` = "'.$idshop.'" ')->fetch_assoc();
		$product_id = $shop_info['product_id'];
		$product_point = $shop_info['price_web']; //ราคาเรา

		if($users_point < $product_point){
			DisplayMSG('error','Warning ❗️❗️', 'ยอดเงินของคุณไม่เพียงพอ.','true');
		}else{
			$url = 'https://byshop.me/api/buy';
			$headers = array(
			// 'User-Agent: HMPRSLIPAPI',
			);

			$data = array(
				'id' => $product_id,
				'keyapi' => 'xxxxxxx', //ใส่คีย์จาก buyshop
				'username_customer' => $users_username
			);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POST, true);
			// curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			$response = curl_exec($ch);
			curl_close($ch);

			if ($response === false) {

			}else{
				$data = json_decode($response, true);
				// echo $data['status'];
				if($data['status'] == "success"){
					
					$product_name = $data['name'];
					$product_price = $data['price'];
					$product_info = $data['info'];
					$product_status = $data['status'];
					// $product_stock = $data['stock'];
					// $product_id = $product_id;
					//check stock
					// check point user
					
					//หัก point
					$point_update = $users_point - $product_point;
					$query_point = $connect->query("UPDATE `tbl_users` SET `point` = '".$point_update."' WHERE username = '".$users_username."';");
					//เก็บลงประวัติ
					// $query = $connect->query("INSERT INTO `pum_history` (`id`, `name`, `secretcode`, `timeadd`, `product_id`, `price`, `username`, `status`) 
					// VALUES (NULL, '".$product_name."', '".$product_info."', '".time()."', '".$product_id."', '".$product_price."', '".$users_username."', '1');");
					$query = $connect->query("INSERT INTO `tbl_history_api` (`id`, `name`, `status`, `info`, `price`, `timeadd`, `username`) 
					VALUES (NULL, '".$product_name."', '".$product_status."', '".$product_info."', '".$product_point."', '".time()."', '".$users_username."');");

					DisplayMSG('success','สั่งซื้อ '.$product_name.' เรียบร้อย!!','ตรวจสอบสินค้าได้ที่ ประวัติการสั่งซื้อ','true');

					}else{
					
					$product_message = $data['message'];
					// DisplayMSG('error','ERROR [10121]', 'กรุณาติดต่่อ แอดมิน','false');
					DisplayMSG('error','Warning ❗️❗️', ''.$product_message.'✍️.','true');
				}
			}


		}


		

	}

	//สังซื้อ account
	if(isset($_GET['buyshopaccount'])) {
        if(empty($_GET['id']))  {
            DisplayMSG('error','Warning ❗️❗️', 'ไม่พบสินค้านี้ ✍️.','false');
        }
        $idshop = $connect->real_escape_string($_GET['id']);
		//ดึงข้อมูลสินค้า
		$shop_info = $connect->query('SELECT * FROM `tbl_shop_id` WHERE `id` = "'.$idshop.'" ')->fetch_assoc();
		if($users_status == $vip_status){//vip
			$point_this_shop = $shop_info['pointv'];
		}else{
			$point_this_shop = $shop_info['point'];
		}
		if($users_point >= $point_this_shop) {
			//add get gif code
			$account_info = $connect->query("SELECT * FROM `tbl_shop_stock` WHERE `shopid` = '".$idshop."' ORDER BY id ASC");
			$num_account_info = $account_info->num_rows;
			$res_account_info = $account_info->fetch_assoc();
			if($num_account_info == 0){
				DisplayMSG('error','Out of stock ❗️❗️', 'สินค้านี้หมด Stock ✍️.','false');
			}
			//ตัดเครดิต
			$sums_point = $users_point - $point_this_shop;
			$query_point = $connect->query("UPDATE tbl_users SET point = '".$sums_point."' WHERE username = '".$users_username."'");

			$velue_item = $res_account_info['account'];
			//add account to history
			$add_history = $connect->query("INSERT INTO `tbl_shop_history` (`id`, `secret_info`, `timeadd`, `point`, `username`, `gameid`, `status`) 
			VALUES (NULL, '".$velue_item."', '".time()."', '".$point_this_shop."', '".$users_username."', '".$idshop."', '1');");

			//ลบ account ที่ซื้อแล้ว
			$account_delete = $connect->query("DELETE FROM tbl_shop_stock WHERE id = '".$res_account_info['id']."';");

			DisplayMSG('success','Buy Success ❗️❗️','สั่งซื้อเรียบร้อย!!','true');
		}else{
			DisplayMSG('error','Warning ❗️❗️', 'เครดิตของคุณไม่เพียงพอ กรุณาเติมเงิน.','false');
		}
        
    }

	//spin game
	if(isset($_GET['spin_api'])){

		if($_SERVER['REQUEST_METHOD'] === 'POST')  {
		// if(true)  {

			$point_use_game = $result_info_web['point_spin']; // ระบุราคาสุ่ม
			if($users_point < $point_use_game ){
				$put_data['status'] = 401;
				$put_data['popup'] = "<script>
					Swal.fire({
						title: 'โอ้ะ...โอ!!',
						text: 'ยอดเงินของคุณไม่เพียง!!',
						imageUrl: 'https://media.tenor.com/haXkziw3LB4AAAAi/no-tuji.gif',
						imageWidth: 200,
						imageHeight: 200,
						imageAlt: 'Custom image',
					}).then(function () {
					})</script>";
				echo json_encode($put_data);
			}else{

				// ----------------------
				//หักเงิน
				$nowpoint = $users_point - $point_use_game;
				$update_point = $connect->query("UPDATE `tbl_users` SET `point` = '".$nowpoint."' WHERE username = '".$users_username."'");
				// ----------------------
				$item_reward = $connect->query("SELECT * FROM tbl_item_rewards WHERE game = 'spin'");
				$res_items = $item_reward->fetch_all(MYSQLI_ASSOC);
				$count_item = $item_reward->num_rows;

				$data = array();
				// เพิ่มรายการใหม่ในอาร์เรย์
				foreach($res_items as $res_item){
					$newItem = array(
						"id" => $res_item['id'],
						"name" => $res_item['name'],
						"percent" => $res_item['percent']
					);

					array_push($data, $newItem);
				}
				
				// สร้างอาร์เรย์ของตัวเลือกโดยพิจารณาเปอร์เซ็นต์
				$weightedOptions = array();
				foreach ($data as $item) {
					for ($i = 0; $i < $item['percent']; $i++) {
						$weightedOptions[] = $item;
					}
				}

				// สุ่มรายการจากอาร์เรย์ของตัวเลือก
				$randomKey = array_rand($weightedOptions);

				// แสดงผลลัพธ์
				$randomItem = $weightedOptions[$randomKey];
				// echo "ID: " . $randomItem['id'] . ", Name: " . $randomItem['name'] . ", Percent: " . $randomItem['percent'] . "%";

				//get item ที่สุ่มได้
				$info_reward = $connect->query("SELECT * FROM tbl_item_rewards WHERE game = 'spin' AND id = '".$randomItem['id']."'")->fetch_assoc();

				if($info_reward['type'] == 1){//no reward
					//point user หลังอัพเดท
					$info_user_now = $connect->query("SELECT * FROM `tbl_users` WHERE `username` = '".$users_username."'")->fetch_assoc();

					//add reward to history
					$add_reward_history = $connect->query("INSERT INTO `tbl_history_rewards` (`id`, `name`, `game`, `value`, `timeadd`, `status`, `username`) 
						VALUES (NULL, '".$info_reward['name']."', '".$info_reward['game']."', 'ไม่ได้รับรางวัล', '".time()."', '1', '".$users_username."');");

					$put_data['status'] = 200;
					$put_data['valueid'] = intval($randomItem['id']); //intval แปลงเป็น int
					$put_data['item_value'] = 0;
					$put_data['point_now'] = number_format($info_user_now['point'], 2);
					$put_data['popup'] = "<script>
					audiolost.play();
					Swal.fire({
						title: 'เสียใจด้วยคุณไม่ได้รับรางวัล',
						text: 'วันพระไม่ได้มีหนเดียวลองอีกครั้ง!!',
						imageUrl: 'https://media.tenor.com/SFy5Za0DyMEAAAAi/erm-fingers.gif',
						imageWidth: 200,
						imageHeight: 200,
						imageAlt: 'Custom image',
					}).then(function () {
					})</script>";
					echo json_encode($put_data);

				}else if($info_reward['type'] == 2){// point
					$value_random = explode('|', $info_reward['value']);
					$min = $value_random[0];
					$max = $value_random[1];
					$point_random = rand($min,$max);
					//point user ก่อนอัพเดท
					$info_user_now = $connect->query("SELECT * FROM `tbl_users` WHERE `username` = '".$users_username."'")->fetch_assoc();

					//add point
					$addpoint = $users_point + $point_random;
					$add_point_random = $connect->query("UPDATE `tbl_users` SET `point` = '".$addpoint."' WHERE username = '".$users_username."'");

					//add reward to history
					$add_reward_history = $connect->query("INSERT INTO `tbl_history_rewards` (`id`, `name`, `game`, `value`, `timeadd`, `status`, `username`) 
						VALUES (NULL, '".$info_reward['name']."', '".$info_reward['game']."', '".$point_random." เครดิต', '".time()."', '1', '".$users_username."');");

					//point user หลังอัพเดท
					$info_user_nows = $connect->query("SELECT * FROM `tbl_users` WHERE `username` = '".$users_username."'")->fetch_assoc();

					$put_data['status'] = 200;
					$put_data['valueid'] = intval($randomItem['id']); //intval แปลงเป็น int
					$put_data['item_value'] = $point_random." เครดิต";
					$put_data['point_now'] = number_format($info_user_now['point'], 2);
					$put_data['point_nows'] = number_format($info_user_nows['point'], 2);
					$put_data['popup'] = "<script>
						audiowin.play();
						Swal.fire({
							// icon: 'success',
							title: 'คุณได้รางวัล',
							text: winmsg,
							imageUrl: 'https://media.tenor.com/jWpeDwFyOjsAAAAi/mochi-cute.gif',
							imageWidth: 200,
							imageHeight: 200,
							imageAlt: 'Custom image',
						}).then(function () {
					})</script>";
					echo json_encode($put_data);

				}else if($info_reward['type'] == 3){// gif code
					
					//point user ก่อนอัพเดท
					$info_user_now = $connect->query("SELECT * FROM `tbl_users` WHERE `username` = '".$users_username."'")->fetch_assoc();

					//add get gif code
					$gifcode_info = $connect->query("SELECT * FROM `tbl_code_rewards` WHERE `reward_id` = '".$info_reward['id']."' ORDER BY id ASC");
					$num_gifcode_info = $gifcode_info->num_rows;
					$res_gifcode_info = $gifcode_info->fetch_assoc();
					if($num_gifcode_info == 0){
						$velue_item = "Gif Code หมดติดต่อ แอดมิน!!";
						//add reward to history
						$add_reward_history = $connect->query("INSERT INTO `tbl_history_rewards` (`id`, `name`, `game`, `value`, `timeadd`, `status` , `username`) 
						VALUES (NULL, '".$info_reward['name']."', '".$info_reward['game']."', '".$velue_item."', '".time()."', '1', '".$users_username."');");
					}else{
						$velue_item = $res_gifcode_info['code'];

						//add reward to history
						$add_reward_history = $connect->query("INSERT INTO `tbl_history_rewards` (`id`, `name`, `game`, `value`, `timeadd`, `status` , `username`) 
						VALUES (NULL, '".$info_reward['name']."', '".$info_reward['game']."', '".$velue_item."', '".time()."', '1', '".$users_username."');");

						//remove aftar add history
						$gifcode_delete = $connect->query("DELETE FROM tbl_code_rewards WHERE id = '".$res_gifcode_info['id']."';");
					}
					//point user หลังอัพเดท
					$info_user_nows = $connect->query("SELECT * FROM `tbl_users` WHERE `username` = '".$users_username."'")->fetch_assoc();

					$put_data['status'] = 200;
					$put_data['valueid'] = intval($randomItem['id']); //intval แปลงเป็น int
					$put_data['item_value'] = $info_reward['name'];
					$put_data['point_now'] = number_format($info_user_now['point'], 2);
					$put_data['point_nows'] = number_format($info_user_nows['point'], 2);
					$put_data['popup'] = "<script>
						audiowin.play();
						Swal.fire({
							// icon: 'success',
							title: 'คุณได้รางวัล',
							text: winmsg,
							imageUrl: 'https://media.tenor.com/jWpeDwFyOjsAAAAi/mochi-cute.gif',
							imageWidth: 200,
							imageHeight: 200,
							imageAlt: 'Custom image',
						}).then(function () {
					})</script>";
					echo json_encode($put_data);

				}else{
					$put_data['status'] = 402;
					$put_data['popup'] = "<script>
						Swal.fire({
							title: 'โอ้ะ...โอ!!',
							text: 'เกิดข้อผิดหลาด!!',
							imageUrl: 'https://media.tenor.com/haXkziw3LB4AAAAi/no-tuji.gif',
							imageWidth: 200,
							imageHeight: 200,
							imageAlt: 'Custom image',
						}).then(function () {
						})</script>";
					echo json_encode($put_data);

				}
			}	
			//-----------
		}
	}
	//roller game
	if(isset($_GET['roller_api'])){

		if($_SERVER['REQUEST_METHOD'] === 'POST')  {
		// if(true)  {

			$point_use_game = $result_info_web['point_roller']; // ระบุราคาสุ่ม
			if($users_point < $point_use_game ){
				$put_data['status'] = 401;
				$put_data['popup'] = "<script>
					Swal.fire({
						title: 'โอ้ะ...โอ!!',
						text: 'ยอดเงินของคุณไม่เพียง!!',
						imageUrl: 'https://media.tenor.com/haXkziw3LB4AAAAi/no-tuji.gif',
						imageWidth: 200,
						imageHeight: 200,
						imageAlt: 'Custom image',
					}).then(function () {
					})</script>";
				echo json_encode($put_data);
			}else{

				// ----------------------
				//หักเงิน
				$nowpoint = $users_point - $point_use_game;
				$update_point = $connect->query("UPDATE `tbl_users` SET `point` = '".$nowpoint."' WHERE username = '".$users_username."'");
				// ----------------------
				$item_reward = $connect->query("SELECT * FROM tbl_item_rewards WHERE game = 'roller'");
				$res_items = $item_reward->fetch_all(MYSQLI_ASSOC);
				$count_item = $item_reward->num_rows;

				$data = array();
				// เพิ่มรายการใหม่ในอาร์เรย์
				foreach($res_items as $res_item){
					$newItem = array(
						"id" => $res_item['id'],
						"name" => $res_item['name'],
						"percent" => $res_item['percent']
					);

					array_push($data, $newItem);
				}
				
				// สร้างอาร์เรย์ของตัวเลือกโดยพิจารณาเปอร์เซ็นต์
				$weightedOptions = array();
				foreach ($data as $item) {
					for ($i = 0; $i < $item['percent']; $i++) {
						$weightedOptions[] = $item;
					}
				}

				// สุ่มรายการจากอาร์เรย์ของตัวเลือก
				$randomKey = array_rand($weightedOptions);

				// แสดงผลลัพธ์
				$randomItem = $weightedOptions[$randomKey];
				// echo "ID: " . $randomItem['id'] . ", Name: " . $randomItem['name'] . ", Percent: " . $randomItem['percent'] . "%";

				//get item ที่สุ่มได้
				$info_reward = $connect->query("SELECT * FROM tbl_item_rewards WHERE game = 'roller' AND id = '".$randomItem['id']."'")->fetch_assoc();

				if($info_reward['type'] == 1){//no reward
					//point user หลังอัพเดท
					$info_user_now = $connect->query("SELECT * FROM `tbl_users` WHERE `username` = '".$users_username."'")->fetch_assoc();

					//add reward to history
					$add_reward_history = $connect->query("INSERT INTO `tbl_history_rewards` (`id`, `name`, `game`, `value`, `timeadd`, `status`, `username`) 
						VALUES (NULL, '".$info_reward['name']."', '".$info_reward['game']."', 'ไม่ได้รับรางวัล', '".time()."', '1', '".$users_username."');");

					$put_data['status'] = 200;
					$put_data['valueid'] = intval($randomItem['id']); //intval แปลงเป็น int
					$put_data['item_value'] = 0;
					$put_data['point_now'] = number_format($info_user_now['point'], 2);
					$put_data['popup'] = "<script>
					audiolost.play();
					Swal.fire({
						title: 'เสียใจด้วยคุณไม่ได้รับรางวัล',
						text: 'วันพระไม่ได้มีหนเดียวลองอีกครั้ง!!',
						imageUrl: 'https://media.tenor.com/SFy5Za0DyMEAAAAi/erm-fingers.gif',
						imageWidth: 200,
						imageHeight: 200,
						imageAlt: 'Custom image',
					}).then(function () {})</script>";
					echo json_encode($put_data);

				}else if($info_reward['type'] == 2){// point
					$value_random = explode('|', $info_reward['value']);
					$min = $value_random[0];
					$max = $value_random[1];
					$point_random = rand($min,$max);
					//point user ก่อนอัพเดท
					$info_user_now = $connect->query("SELECT * FROM `tbl_users` WHERE `username` = '".$users_username."'")->fetch_assoc();

					//add point
					$addpoint = $users_point + $point_random;
					$add_point_random = $connect->query("UPDATE `tbl_users` SET `point` = '".$addpoint."' WHERE username = '".$users_username."'");

					//add reward to history
					$add_reward_history = $connect->query("INSERT INTO `tbl_history_rewards` (`id`, `name`, `game`, `value`, `timeadd`, `status`, `username`) 
						VALUES (NULL, '".$info_reward['name']."', '".$info_reward['game']."', '".$point_random." เครดิต', '".time()."', '1', '".$users_username."');");

					//point user หลังอัพเดท
					$info_user_nows = $connect->query("SELECT * FROM `tbl_users` WHERE `username` = '".$users_username."'")->fetch_assoc();

					$put_data['status'] = 200;
					$put_data['valueid'] = intval($randomItem['id']); //intval แปลงเป็น int
					$put_data['item_value'] = $point_random." เครดิต";
					$put_data['point_now'] = number_format($info_user_now['point'], 2);
					$put_data['point_nows'] = number_format($info_user_nows['point'], 2);
					$put_data['popup'] = "<script>
						audiowin.play();
						Swal.fire({
							// icon: 'success',
							title: 'คุณได้รางวัล',
							text: winmsg,
							imageUrl: 'https://media.tenor.com/jWpeDwFyOjsAAAAi/mochi-cute.gif',
							imageWidth: 200,
							imageHeight: 200,
							imageAlt: 'Custom image',
						}).then(function () {})</script>";
					echo json_encode($put_data);

				}else if($info_reward['type'] == 3){// gif code
					
					//point user ก่อนอัพเดท
					$info_user_now = $connect->query("SELECT * FROM `tbl_users` WHERE `username` = '".$users_username."'")->fetch_assoc();

					//add get gif code
					$gifcode_info = $connect->query("SELECT * FROM `tbl_code_rewards` WHERE `reward_id` = '".$info_reward['id']."' ORDER BY id ASC");
					$num_gifcode_info = $gifcode_info->num_rows;
					$res_gifcode_info = $gifcode_info->fetch_assoc();
					if($num_gifcode_info == 0){
						$velue_item = "Gif Code หมดติดต่อ แอดมิน!!";
						//add reward to history
						$add_reward_history = $connect->query("INSERT INTO `tbl_history_rewards` (`id`, `name`, `game`, `value`, `timeadd`, `status` , `username`) 
						VALUES (NULL, '".$info_reward['name']."', '".$info_reward['game']."', '".$velue_item."', '".time()."', '1', '".$users_username."');");
					}else{
						$velue_item = $res_gifcode_info['code'];

						//add reward to history
						$add_reward_history = $connect->query("INSERT INTO `tbl_history_rewards` (`id`, `name`, `game`, `value`, `timeadd`, `status` , `username`) 
						VALUES (NULL, '".$info_reward['name']."', '".$info_reward['game']."', '".$velue_item."', '".time()."', '1', '".$users_username."');");

						//remove aftar add history
						$gifcode_delete = $connect->query("DELETE FROM tbl_code_rewards WHERE id = '".$res_gifcode_info['id']."';");
					}
					//point user หลังอัพเดท
					$info_user_nows = $connect->query("SELECT * FROM `tbl_users` WHERE `username` = '".$users_username."'")->fetch_assoc();

					$put_data['status'] = 200;
					$put_data['valueid'] = intval($randomItem['id']); //intval แปลงเป็น int
					$put_data['item_value'] = $info_reward['name'];
					$put_data['point_now'] = number_format($info_user_now['point'], 2);
					$put_data['point_nows'] = number_format($info_user_nows['point'], 2);
					$put_data['popup'] = "<script>
						audiowin.play();
						Swal.fire({
							// icon: 'success',
							title: 'คุณได้รางวัล',
							text: winmsg,
							imageUrl: 'https://media.tenor.com/jWpeDwFyOjsAAAAi/mochi-cute.gif',
							imageWidth: 200,
							imageHeight: 200,
							imageAlt: 'Custom image',
						}).then(function () {
					})</script>";
					echo json_encode($put_data);

				}else{
					$put_data['status'] = 402;
					$put_data['popup'] = "<script>
						Swal.fire({
							title: 'โอ้ะ...โอ!!',
							text: 'เกิดข้อผิดหลาด!!',
							imageUrl: 'https://media.tenor.com/haXkziw3LB4AAAAi/no-tuji.gif',
							imageWidth: 200,
							imageHeight: 200,
							imageAlt: 'Custom image',
						}).then(function () {
						})</script>";
					echo json_encode($put_data);

				}
			}	
			//-----------
		}
	}
	//slot game
	if(isset($_GET['slot_api'])){

		if($_SERVER['REQUEST_METHOD'] === 'POST')  {
		// if(true)  {

			$point_use_game = $result_info_web['point_slot']; // ระบุราคาสุ่ม
			if($users_point < $point_use_game ){
				$put_data['status'] = 401;
				$put_data['popup'] = "<script>
					Swal.fire({
						title: 'โอ้ะ...โอ!!',
						text: 'ยอดเงินของคุณไม่เพียง!!',
						imageUrl: 'https://media.tenor.com/haXkziw3LB4AAAAi/no-tuji.gif',
						imageWidth: 200,
						imageHeight: 200,
						imageAlt: 'Custom image',
					}).then(function () {
					})</script>";
				echo json_encode($put_data);
			}else{

				// ----------------------
				//หักเงิน
				$nowpoint = $users_point - $point_use_game;
				$update_point = $connect->query("UPDATE `tbl_users` SET `point` = '".$nowpoint."' WHERE username = '".$users_username."'");
				// ----------------------
				$item_reward = $connect->query("SELECT * FROM tbl_item_rewards WHERE game = 'slot'");
				$res_items = $item_reward->fetch_all(MYSQLI_ASSOC);
				$count_item = $item_reward->num_rows;

				$data = array();
				// เพิ่มรายการใหม่ในอาร์เรย์
				foreach($res_items as $res_item){
					$newItem = array(
						"id" => $res_item['id'],
						"name" => $res_item['name'],
						"percent" => $res_item['percent']
					);

					array_push($data, $newItem);
				}
				
				// สร้างอาร์เรย์ของตัวเลือกโดยพิจารณาเปอร์เซ็นต์
				$weightedOptions = array();
				foreach ($data as $item) {
					for ($i = 0; $i < $item['percent']; $i++) {
						$weightedOptions[] = $item;
					}
				}

				// สุ่มรายการจากอาร์เรย์ของตัวเลือก
				$randomKey1 = array_rand($weightedOptions);
				$randomKey2 = array_rand($weightedOptions);
				$randomKey3 = array_rand($weightedOptions);

				// แสดงผลลัพธ์
				$randomItem1 = $weightedOptions[$randomKey1];
				$randomItem2 = $weightedOptions[$randomKey2];
				$randomItem3 = $weightedOptions[$randomKey3];
				//echo "ID: " . $randomItem1['id'] . ", Name: " . $randomItem1['name'] . ", Percent: " . $randomItem1['percent'] . "%<br>";
				//echo "ID: " . $randomItem2['id'] . ", Name: " . $randomItem2['name'] . ", Percent: " . $randomItem2['percent'] . "%<br>";
				//echo "ID: " . $randomItem3['id'] . ", Name: " . $randomItem3['name'] . ", Percent: " . $randomItem3['percent'] . "%<br>";

				if($randomItem1['id'] == $randomItem2['id'] && $randomItem1['id'] == $randomItem3['id']){//รางวัลต้องกัน ให่เข้า if
					//echo "dd";
					//get item ที่สุ่มได้
					$info_reward = $connect->query("SELECT * FROM tbl_item_rewards WHERE game = 'slot' AND id = '".$randomItem1['id']."'")->fetch_assoc();
					if($info_reward['type'] == 1){//no reward
						//point user หลังอัพเดท
						$info_user_now = $connect->query("SELECT * FROM `tbl_users` WHERE `username` = '".$users_username."'")->fetch_assoc();

						//add reward to history
						$add_reward_history = $connect->query("INSERT INTO `tbl_history_rewards` (`id`, `name`, `game`, `value`, `timeadd`, `status`, `username`) 
							VALUES (NULL, '".$info_reward['name']."', '".$info_reward['game']."', 'ไม่ได้รับรางวัล', '".time()."', '1', '".$users_username."');");

						$put_data['status'] = 200;
						$put_data['valueid1'] = intval($randomItem1['id']); //intval แปลงเป็น int
						$put_data['valueid2'] = intval($randomItem2['id']); 
						$put_data['valueid3'] = intval($randomItem3['id']); 
						$put_data['item_value'] = 0;
						$put_data['point_now'] = number_format($info_user_now['point'], 2);
						$put_data['popup'] = "<script>
						audiolost.play();
						Swal.fire({
							title: 'เสียใจด้วยคุณไม่ได้รับรางวัล',
							text: 'วันพระไม่ได้มีหนเดียวลองอีกครั้ง!!',
							imageUrl: 'https://media.tenor.com/SFy5Za0DyMEAAAAi/erm-fingers.gif',
							imageWidth: 200,
							imageHeight: 200,
							imageAlt: 'Custom image',
						}).then(function () {})</script>";
						echo json_encode($put_data);

					}else if($info_reward['type'] == 2){// point
						$value_random = explode('|', $info_reward['value']);
						$min = $value_random[0];
						$max = $value_random[1];
						$point_random = rand($min,$max);
						//point user ก่อนอัพเดท
						$info_user_now = $connect->query("SELECT * FROM `tbl_users` WHERE `username` = '".$users_username."'")->fetch_assoc();

						//add point
						$addpoint = $users_point + $point_random;
						$add_point_random = $connect->query("UPDATE `tbl_users` SET `point` = '".$addpoint."' WHERE username = '".$users_username."'");

						//add reward to history
						$add_reward_history = $connect->query("INSERT INTO `tbl_history_rewards` (`id`, `name`, `game`, `value`, `timeadd`, `status`, `username`) 
							VALUES (NULL, '".$info_reward['name']."', '".$info_reward['game']."', '".$point_random." เครดิต', '".time()."', '1', '".$users_username."');");

						//point user หลังอัพเดท
						$info_user_nows = $connect->query("SELECT * FROM `tbl_users` WHERE `username` = '".$users_username."'")->fetch_assoc();

						$put_data['status'] = 200;
						$put_data['valueid1'] = intval($randomItem1['id']); //intval แปลงเป็น int
						$put_data['valueid2'] = intval($randomItem2['id']); 
						$put_data['valueid3'] = intval($randomItem3['id']); 
						$put_data['item_value'] = $point_random." เครดิต";
						$put_data['point_now'] = number_format($info_user_now['point'], 2);
						$put_data['point_nows'] = number_format($info_user_nows['point'], 2);
						$put_data['popup'] = "<script>
							audiowin.play();
							Swal.fire({
								// icon: 'success',
								title: 'คุณได้รางวัล',
								text: winmsg,
								imageUrl: 'https://media.tenor.com/jWpeDwFyOjsAAAAi/mochi-cute.gif',
								imageWidth: 200,
								imageHeight: 200,
								imageAlt: 'Custom image',
							}).then(function () {})</script>";
						echo json_encode($put_data);

					}else if($info_reward['type'] == 3){// gif code
						
						//point user ก่อนอัพเดท
						$info_user_now = $connect->query("SELECT * FROM `tbl_users` WHERE `username` = '".$users_username."'")->fetch_assoc();

						//add get gif code
						$gifcode_info = $connect->query("SELECT * FROM `tbl_code_rewards` WHERE `reward_id` = '".$info_reward['id']."' ORDER BY id ASC");
						$num_gifcode_info = $gifcode_info->num_rows;
						$res_gifcode_info = $gifcode_info->fetch_assoc();
						if($num_gifcode_info == 0){
							$velue_item = "Gif Code หมดติดต่อ แอดมิน!!";
							//add reward to history
							$add_reward_history = $connect->query("INSERT INTO `tbl_history_rewards` (`id`, `name`, `game`, `value`, `timeadd`, `status` , `username`) 
							VALUES (NULL, '".$info_reward['name']."', '".$info_reward['game']."', '".$velue_item."', '".time()."', '1', '".$users_username."');");
						}else{
							$velue_item = $res_gifcode_info['code'];

							//add reward to history
							$add_reward_history = $connect->query("INSERT INTO `tbl_history_rewards` (`id`, `name`, `game`, `value`, `timeadd`, `status` , `username`) 
							VALUES (NULL, '".$info_reward['name']."', '".$info_reward['game']."', '".$velue_item."', '".time()."', '1', '".$users_username."');");

							//remove aftar add history
							$gifcode_delete = $connect->query("DELETE FROM tbl_code_rewards WHERE id = '".$res_gifcode_info['id']."';");
						}
						//point user หลังอัพเดท
						$info_user_nows = $connect->query("SELECT * FROM `tbl_users` WHERE `username` = '".$users_username."'")->fetch_assoc();

						$put_data['status'] = 200;
						$put_data['valueid1'] = intval($randomItem1['id']); //intval แปลงเป็น int
						$put_data['valueid2'] = intval($randomItem2['id']); 
						$put_data['valueid3'] = intval($randomItem3['id']);
						$put_data['item_value'] = $info_reward['name'];
						$put_data['point_now'] = number_format($info_user_now['point'], 2);
						$put_data['point_nows'] = number_format($info_user_nows['point'], 2);
						$put_data['popup'] = "<script>
							audiowin.play();
							Swal.fire({
								// icon: 'success',
								title: 'คุณได้รางวัล',
								text: winmsg,
								imageUrl: 'https://media.tenor.com/jWpeDwFyOjsAAAAi/mochi-cute.gif',
								imageWidth: 200,
								imageHeight: 200,
								imageAlt: 'Custom image',
							}).then(function () {
						})</script>";
						echo json_encode($put_data);

					}else{
						$put_data['status'] = 402;
						$put_data['popup'] = "<script>
							Swal.fire({
								title: 'โอ้ะ...โอ!!',
								text: 'เกิดข้อผิดหลาด!!',
								imageUrl: 'https://media.tenor.com/haXkziw3LB4AAAAi/no-tuji.gif',
								imageWidth: 200,
								imageHeight: 200,
								imageAlt: 'Custom image',
							}).then(function () {
							})</script>";
						echo json_encode($put_data);

					}


				}else{
					//point user หลังอัพเดท
					$info_user_now = $connect->query("SELECT * FROM `tbl_users` WHERE `username` = '".$users_username."'")->fetch_assoc();
					//add reward to history
					$add_reward_history = $connect->query("INSERT INTO `tbl_history_rewards` (`id`, `name`, `game`, `value`, `timeadd`, `status`, `username`) 
						VALUES (NULL, 'ไม่ได้รับรางวัล', 'slot', 'ไม่ได้รับรางวัล', '".time()."', '1', '".$users_username."');");

					$put_data['status'] = 200;
					$put_data['valueid1'] = intval($randomItem1['id']); //intval แปลงเป็น int
					$put_data['valueid2'] = intval($randomItem2['id']); 
					$put_data['valueid3'] = intval($randomItem3['id']); 
					$put_data['item_value'] = 0;
					$put_data['point_now'] = number_format($info_user_now['point'], 2);
					$put_data['popup'] = "<script>
					audiolost.play();
					Swal.fire({
						title: 'เสียใจด้วยคุณไม่ได้รับรางวัล',
						text: 'วันพระไม่ได้มีหนเดียวลองอีกครั้ง!!',
						imageUrl: 'https://media.tenor.com/SFy5Za0DyMEAAAAi/erm-fingers.gif',
						imageWidth: 200,
						imageHeight: 200,
						imageAlt: 'Custom image',
					}).then(function () {})</script>";
					echo json_encode($put_data);

				}
			}	
			//-----------
		}
	}



}

// อัพเดตสต็อค
if(isset($_GET['UpdateStock'])) {

	$api_key = 'KATqV515MGG8KztTpJTc3sDkI5cltP';

	$url = 'https://byshop.me/api/product';
	// $url = 'https://otp24hr.com/api/v1?action=getpack';
	$headers = array(
		// 'User-Agent: HMPRSLIPAPI',
	);

	$data = array(
		// 'keyapi' => $api_key,
	);

	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://byshop.me/api/product.php', 
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
	));

	$response = curl_exec($curl);
	curl_close($curl);

	$load_packz = json_decode($response);

	// echo $response;
	foreach ($load_packz as $data) :

		//เช็คสถานะสินค้า
		$check_stock = $data->stock;
		$shop_status = $data->status;
		$shop_point = $data->price;
		$shop_img = $data->img;
		$shop_name = $data->name;
		$shop_id = $data->id;

		// $query = $connect->query("INSERT INTO `tbl_shop_stock_api` (`id`, `product_id`, `name`, `price`, `price_web`, `img`, `stock`, `status`, `up`) 
		// VALUES (NULL, '".$shop_id."', '".$shop_name."', '".$shop_point."', '".$shop_point."', '".$shop_img ."', '".$check_stock."', '".$shop_status."', '');");
		$query = $connect->query("UPDATE `tbl_shop_stock_api` SET `price` = '".$shop_point."', 
		`stock` = '".$check_stock."',  
		`status` = '".$shop_status."' WHERE product_id = '".$shop_id."';");

	endforeach;




}



function DisplayMSG($function,$title,$msg,$reload){
	global $url;
	// $uri = $_SERVER['REQUEST_URI'];
	if($reload == 'true') {
		$data = exit("<script>$function('$title', '$msg', 'true');setTimeout(function(){ window.location.reload(); }, 2500);</script>");
		// $data = exit("<script>$function('$title', '$msg', 'true');setTimeout(function(){ location.href = \"$url\"; }, 2500);</script>");
	}else {
	$data = exit("<script>$function('$title', '$msg', 'false');</script>");
	}
	return $data;
}
function iDisplayMSG($function,$title,$msg,$reload,$url){
	if(empty($url)) {
		$url = "..";
	}else {
		$url = $url;
	}
	if($function == 'isuccess' || $function == 'ierror') {
		if($reload == 'true') {
			$data = "<script>$function('$title', '$msg', 'true', '$url');setTimeout(function(){ location.href = \"$url\"; }, 2500);</script>";
		}else {
			$data = "<script>$function('$title', '$msg', 'false','');</script>";
		}
	}else {
		if($reload == 'true') {
			$data = "<script>$function('$title', '$msg', 'true');setTimeout(function(){ location.href = \"$url\"; }, 2500);</script>";
		}else {
			$data = "<script>$function('$title', '$msg', 'false');</script>";
		}
	}
	echo $data;
}

$months =array( 
	"0"=>"", "1"=>"มกราคม", "2"=>"กุมภาพันธ์", "3"=>"มีนาคม","4"=>"เมษายน","5"=>"พฤษภาคม","6"=>"มิถุนายน", "7"=>"กรกฎาคม","8"=>"สิงหาคม","9"=>"กันยายน","10"=>"ตุลาคม","11"=>"พฤศจิกายน","12"=>"ธันวาคม"
		  );
function th_full($time){
	global $months;
	@$th.= date("H",$time);
	@$th.= ":".date("i",$time);
	@$th.= "  วันที่ ".date("j",$time);
	@$th.= " ".$months[date("n",$time)];
	@$th.= " พ.ศ.".(date("Y",$time)+543);
	return $th;
}
function th($time){
	global $months;
	@$th.= date("H",$time);
	@$th.= ":".date("i",$time);
	@$th.= " ".date("j",$time);
	@$th.= " ".$months[date("n",$time)];
	@$th.= " ".(date("Y",$time)+543);
	return $th;
}


?>