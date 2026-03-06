<?php

require('setting.php');

$result_info_web = $connect->query("SELECT * FROM tbl_setting WHERE id = 1")->fetch_assoc();

$count_users = $connect->query('SELECT * FROM tbl_users ; ')->num_rows;
$count_shop = $connect->query('SELECT * FROM tbl_shop_id ; ')->num_rows;
$count_shop_sell = $connect->query('SELECT * FROM tbl_shop_id WHERE `owner` != "" ; ')->num_rows;


if (isset($_GET['login'])) {
	if (empty($_POST['email']) || empty($_POST['password'])) {
		DisplayMSG('error', 'โอ้ะ...โอ!!', 'กรุณาอย่าเว้นช่องว่าง ✍️.', 'false');
	}
	if (empty($_POST['recaptcha'])) {
		DisplayMSG('error', 'โอ้ะ...โอ!!', 'กรุณายืนยันตัวตน.', 'false');
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
	if (strlen($_POST['password']) <= 4) {
		DisplayMSG('error', 'โอ้ะ...โอ!!', 'รหัสผ่านอย่างน้อย 5 ตัวขึ้นไป !!', 'false');
	}
	if (mb_strlen($_POST['password']) >= 25) {
		DisplayMSG('error', 'โอ้ะ...โอ!!', 'รหัสผ่านสูงสุด 24 ตัว !!', 'false');
	}

	$secretKey = SECRET_KEY;
	$captcha = $_POST['recaptcha'];
	$ip = $_SERVER['REMOTE_ADDR'];
	// post request to server
	$url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) . '&response=' . urlencode($captcha);
	$response = file_get_contents($url);
	$responseKeys = json_decode($response, true);
	// should return JSON with success as true
	if ($responseKeys["success"]) {

		// Use prepared statement for login security
		$email = $_POST['email'];
		$password = md5($_POST['password'] . SECRET_WEB);
		$stmt = $connect->prepare('SELECT * FROM tbl_users WHERE email = ? AND password = ?');
		$stmt->bind_param('ss', $email, $password);
		$stmt->execute();
		$query = $stmt->get_result();
		$username_check = $query->num_rows;
		$account = $query->fetch_assoc();
		if ($username_check == 0) {
			DisplayMSG('error', 'Error', 'ชื่อผู้ใช้ หรือ รหัสผ่านไม่ถูกต้อง !!', 'false');
		}
		if ($account['status'] == "0") {
			DisplayMSG('error', 'Banned !!!', 'บัญชีของคุณถูกแบนถาวร !!!', 'false');
		} else {
			$_SESSION['username'] = $email;
			$stmt2 = $connect->prepare("UPDATE tbl_users SET ip = ? WHERE email = ?");
			$stmt2->bind_param('ss', $ip, $email);
			$stmt2->execute();
			DisplayMSG('success', 'Login Success !!!', 'เข้าสู่ระบบสำเร็จ !!', 'true');
		}
	} else {
		DisplayMSG('error', 'Are you a rebot!!', 'กรุณายืนยันตัวตน.', 'true');
	}
}

if (isset($_GET['register'])) {
	if (empty($_POST['username']) || empty($_POST['password'])) {
		DisplayMSG('error', 'โอ้ะ...โอ!! ❗️❗️', 'กรุณาอย่าเว้นช่องว่าง ✍️.', 'false');
	}
	if (empty($_POST['email'])) {
		DisplayMSG('error', 'โอ้ะ...โอ!! ❗️❗️', 'กรุณากรอกอีเมลที่ติดต่อได้จริง 📵.', 'false');
	}
	if (!preg_match('/^[a-zA-Z0-9\_]*$/', $_POST['username'])) {
		DisplayMSG('error', 'โอ้ะ...โอ!!', 'ชื่อผู้ใช้ไม่ถูกต้อง ต้องเป็น A-Z 0-9 เท่านั้น !!.', 'false');
	}
	if (mb_strlen($_POST['username']) <= 4) {
		DisplayMSG('error', 'โอ้ะ...โอ!!', 'ชื่อผู้ใช้อย่างน้อย 5 ตัวขึ้นไป !!', 'false');
	}
	if (mb_strlen($_POST['username']) >= 25) {
		DisplayMSG('error', 'โอ้ะ...โอ!!', 'ชื่อผู้ใช้สูงสุด 24 ตัวขึ้นไป !!', 'false');
	}
	if (strlen($_POST['password']) <= 4) {
		DisplayMSG('error', 'โอ้ะ...โอ!!', 'รหัสผ่านอย่างน้อย 5 ตัวขึ้นไป !!', 'false');
	}
	if (mb_strlen($_POST['password']) >= 25) {
		DisplayMSG('error', 'โอ้ะ...โอ!!', 'รหัสผ่านสูงสุด 24 ตัว !!', 'false');
	}
	if ($_POST['password'] != $_POST['repassword']) {
		DisplayMSG('error', 'โอ้ะ...โอ!!', 'รหัสผ่าน ไม่ตรงกัน !!', 'false');
	}
	if (empty($_POST['recaptcha'])) {
		DisplayMSG('error', 'โอ้ะ...โอ!!', 'กรุณายืนยันตัวตน.', 'false');
	}

	$secretKey = SECRET_KEY;
	$captcha = $_POST['recaptcha'];
	$ip = $_SERVER['REMOTE_ADDR'];
	// post request to server
	$url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) . '&response=' . urlencode($captcha);
	$response = file_get_contents($url);
	$responseKeys = json_decode($response, true);
	// should return JSON with success as true
	if ($responseKeys["success"]) {
		// Use prepared statement for register security
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = md5($_POST['password'] . SECRET_WEB);
		$stmt = $connect->prepare('SELECT * FROM tbl_users WHERE email = ?');
		$stmt->bind_param('s', $email);
		$stmt->execute();
		$query = $stmt->get_result();
		$username_check = $query->num_rows;
		if ($username_check >= 1) {
			DisplayMSG('error', 'Error', ' มีผู้ใช้งานไปแล้ว !!!', 'false');
		} else {
			$img = 'assets/img/anya.jpg';
			$point = 0;
			$status = 1;
			$stmt2 = $connect->prepare("INSERT INTO `tbl_users` (`id`, `img`, `username`, `password`, `email`, `point`, `ip`, `status`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)");
			$stmt2->bind_param('ssssssi', $img, $username, $password, $email, $point, $ip, $status);
			$stmt2->execute();

			$_SESSION['username'] = $email;

			DisplayMSG('success', 'Register Success !!!', 'สมัครสมาชิกสำเร็จ !!!..', 'true');
		}
	} else {
		DisplayMSG('error', 'Are you a rebot!!', 'กรุณายืนยันตัวตน.', 'true');
	}
}

if (isset($_GET['logout'])) {
	session_destroy();
	DisplayMSG('success', 'Logout Success!!', 'ออกจากระบบเรียบร้อยแล้ว', 'true');
	// DisplayMSG('success','Logout Success!!','ออกจากระบบเรียบร้อยแล้ว','true','./home');
}

if (isset($_GET['login_google'])) {
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

	$stmt = $connect->prepare('SELECT * FROM tbl_users WHERE email = ?');
	$stmt->bind_param('s', $email);
	$stmt->execute();
	$query = $stmt->get_result();
	$email_check = $query->num_rows;
	$account = $query->fetch_assoc();

	if ($email_check == 0) {
		$point = 0;
		$status = 1;
		$stmt_insert = $connect->prepare("INSERT INTO `tbl_users` (`img`, `username`, `password`, `email`, `point`, `ip`, `status`) VALUES (?, ?, ?, ?, ?, ?, ?)");
		$stmt_insert->bind_param('ssssdsi', $img, $username, $password, $email, $point, $ip, $status);
		$stmt_insert->execute();
		$_SESSION['username'] = $email;
		header("Location: index.php");
	} elseif (isset($account['status']) && $account['status'] == "0") {
		header("Location: index.php");
		// DisplayMSG('error','Banned !!!', 'บัญชีของคุณถูกแบนถาวร !!!','false');
	} else {
		$_SESSION['username'] = $email;
		$stmt_update = $connect->prepare("UPDATE tbl_users SET ip = ? WHERE username = ?");
		$stmt_update->bind_param('ss', $ip, $email);
		$stmt_update->execute();
		header("Location: index.php");
		// DisplayMSG('success','Login Success !!!', 'เข้าสู่ระบบสำเร็จ !!','true');
	}
}

if (isset($_GET['login_facebook'])) {

	$ip = $_SERVER['REMOTE_ADDR'];
	$img = $_POST['img'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	if (empty($email)) {
		$email = $password . "@fb.com";
	}

	$stmt = $connect->prepare('SELECT * FROM tbl_users WHERE email = ?');
	$stmt->bind_param('s', $email);
	$stmt->execute();
	$query = $stmt->get_result();
	$email_check = $query->num_rows;
	$account = $query->fetch_assoc();

	if ($email_check == 0) {
		$point = 0;
		$status = 1;
		$stmt_insert = $connect->prepare("INSERT INTO `tbl_users` (`img`, `username`, `password`, `email`, `point`, `ip`, `status`) VALUES (?, ?, ?, ?, ?, ?, ?)");
		$stmt_insert->bind_param('ssssdsi', $img, $username, $password, $email, $point, $ip, $status);
		$stmt_insert->execute();
		$_SESSION['username'] = $email;
		// header("Location: index.php");
		DisplayMSG('success', 'Login Success !!!', 'เข้าสู่ระบบสำเร็จ !!', 'true');
	} elseif (isset($account['status']) && $account['status'] == "0") {
		// header("Location: index.php");
		DisplayMSG('error', 'Banned !!!', 'บัญชีของคุณถูกแบนถาวร !!!', 'false');
	} else {
		$_SESSION['username'] = $email;
		$stmt_update = $connect->prepare("UPDATE tbl_users SET ip = ? WHERE email = ?");
		$stmt_update->bind_param('ss', $ip, $email);
		$stmt_update->execute();
		// header("Location: index.php");
		DisplayMSG('success', 'Login Success !!!', 'เข้าสู่ระบบสำเร็จ !!', 'true');
	}

}

//status login
if (isset($_SESSION['username'])) {
	//ดึงข้อมูล user
	$stmt = $connect->prepare('SELECT * FROM `tbl_users` WHERE `email` = ?');
	$stmt->bind_param('s', $_SESSION['username']);
	$stmt->execute();
	$users = $stmt->get_result()->fetch_assoc();
	$users_status = $users['status'];
	$users_username = $users['username'];
	$users_point = $users['point'];
	$users_profile = $users['img'];
	$users_email = substr($users['email'], 0, 3) . '****' . substr($users['email'], strpos($users['email'], "@"));

	if ($users_status == 0) {//ban
		session_destroy();
		header("Refresh:0");
	}

	if (isset($_GET['reprofile'])) {
		if (empty($_POST['urlimg'])) {
			DisplayMSG('error', 'Warning ❗️❗️', 'กรุณาอย่าเว้นช่องว่าง ✍️.', 'false');
		}
		// if (!preg_match('/^[a-zA-Z0-9\_]*$/', $_POST['urlimg'])) {
		// 	DisplayMSG('error','Error', 'มีอักษรต้องห้าม.','false');
		// }
		$urlimg = $connect->real_escape_string($_POST['urlimg']);
		$clean_img = htmlspecialchars($urlimg);
		$stmt = $connect->prepare("UPDATE `tbl_users` SET `img` = ? WHERE username = ?");
		$stmt->bind_param('ss', $clean_img, $users_username);
		$stmt->execute();

		DisplayMSG('success', 'Save Profile Success!!', 'บันทึกข้อมูลเรียบร้อย!!', 'true');
	}

	if (isset($_GET['repassword'])) {
		if (empty($_POST['urlimg'])) {
			DisplayMSG('error', 'Warning ❗️❗️', 'กรุณาอย่าเว้นช่องว่าง ✍️.', 'false');
		}
		if (!preg_match('/^[a-zA-Z0-9\_]*$/', $_POST['urlimg'])) {
			DisplayMSG('error', 'Error', 'มีอักษรต้องห้าม.', 'false');
		}
		$urlimg = $connect->real_escape_string($_POST['urlimg']);
		$clean_img = htmlspecialchars($urlimg);
		$stmt = $connect->prepare("UPDATE `tbl_users` SET `img` = ? WHERE username = ?");
		$stmt->bind_param('ss', $clean_img, $users_username);
		$stmt->execute();

		DisplayMSG('success', 'Save Profile Success!!', 'บันทึกข้อมูลเรียบร้อย!!', 'true');
	}

	//เติมเงิน
	if (isset($_GET['topupwallet'])) {
		echo $_POST['link_topup'] . $web_info['web_phone'];
		if (empty($_POST['link_topup'])) {
			DisplayMSG('error', 'Error', 'ไม่พบซองอั๋งเปานี้', 'false');
		}
		$secretKey = SECRET_KEY;
		$captcha = $_POST['recaptcha'];
		$ip = $_SERVER['REMOTE_ADDR'];
		// post request to server
		$url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) . '&response=' . urlencode($captcha);
		$response = file_get_contents($url);
		$responseKeys = json_decode($response, true);
		// should return JSON with success as true
		if ($responseKeys["success"]) {

			$link = $_POST['link_topup'];
			$phone = $web_info['web_phone'];
			class topup
			{
				function giftcode($hash = null, $phone = null)
				{
					if (is_null($hash) || is_null($phone))
						return false;
					$ch = curl_init();
					@$hash = explode('?v=', $hash)[1];
					$headers = [
						'Content-Type: application/json',
						'Accept: application/json'
					];
					$postData = [
						'mobile' => $phone,
						'voucher_hash' => $hash
					];
					curl_setopt($ch, CURLOPT_URL, "https://gift.truemoney.com/campaign/vouchers/$hash/redeem");
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
					curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
					curl_setopt($ch, CURLOPT_SSLVERSION, 7);
					curl_setopt($ch, CURLOPT_USERAGENT, "aaaaaaaaaaa");
					$result = curl_exec($ch);
					$statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
					return json_decode($result, true);
				}
			}
			$topup_truewallet = new topup();
			$truewallet = (object) $topup_truewallet->giftcode($link, $phone);

			if (@$truewallet->status['code'] == 'VOUCHER_OUT_OF_STOCK') {
				DisplayMSG('error', 'Error', 'ซองเติมเงินนี้ถูกใช้งานไปแล้ว', 'true');
				// ซองเติมเงินนี้ถูกใช้งานไปแล้ว
			} elseif (@$truewallet->status['code'] == 'VOUCHER_EXPIRED') {
				DisplayMSG('error', 'Error', 'ซองเติมเงินนี้หมดอายุ', 'true');
				// ซองเติมเงินนี้หมดอายุ
			} elseif (@$truewallet->status['code'] == 'VOUCHER_NOT_FOUND') {
				DisplayMSG('error', 'Error', 'ไม่พบซอง', 'true');
				// ไมพบซอง
			} elseif (@$truewallet->status['code'] == null) {
				DisplayMSG('error', 'Error', 'ไม่พบซองอั๋งเปานี้', 'true');
				// กรอกมั่ว
			} else {
				if (@$truewallet->data['voucher']['member'] != "1") {
					DisplayMSG('error', 'Error', 'ผู้รับซองต้องเป็น 1 คน', 'true');
					// ผู้รับซองต้องเป็น 1 คน
				} else {
					// เติมเงินสำเร็จ
					$price = $truewallet->data['voucher']['amount_baht'];
					$sum_point = $users_point + $price;

					$topupby = 'อั่งเป่า';
					$topuptime = time();
					$status = '1';
					$stmt1 = $connect->prepare("INSERT INTO `tbl_topup` (`topupby`, `topuptime`, `point`, `status`, `username`) VALUES (?, ?, ?, ?, ?)");
					$stmt1->bind_param('ssiss', $topupby, $topuptime, $price, $status, $users_username);
					$stmt1->execute();

					$stmt2 = $connect->prepare("UPDATE tbl_users SET point = ? WHERE username = ?");
					$stmt2->bind_param('ds', $sum_point, $users_username);
					$stmt2->execute();

					DisplayMSG('success', 'คุณได้รับ ' . $price . ' Point', 'ขอบคุณมากๆครับ', 'true');

				}
			}

		} else {
			DisplayMSG('error', 'Error', 'กรุณายืนยันตัวตนใหม่', 'true');
		}
	}

	//สังซื้อ
	if (isset($_GET['buyshopid'])) {
		if (empty($_GET['id'])) {
			DisplayMSG('error', 'Warning ❗️❗️', 'ไม่พบสินค้านี้ ✍️.', 'false');
		}
		$idshop = $connect->real_escape_string($_GET['id']);
		//ดึงข้อมูลสินค้า
		$stmt_shop = $connect->prepare('SELECT * FROM `tbl_shop_id` WHERE `id` = ?');
		$stmt_shop->bind_param('i', $idshop);
		$stmt_shop->execute();
		$shop_info = $stmt_shop->get_result()->fetch_assoc();

		if ($users_status == $vip_status) {//vip
			$point_this_shop = $shop_info['pointv'];
		} else {
			$point_this_shop = $shop_info['point'];
		}

		if (!empty($result_shopa['owner'])) {
			DisplayMSG('error', 'Warning ❗️❗️', 'สินค้านี้จำหน่ายไปแล้ว ✍️.', 'false');
		} else if ($users_point >= $point_this_shop) {
			//อัพเดทเจ้าของสินค้า
			$status_update = '2';
			$stmt_update = $connect->prepare("UPDATE `tbl_shop_id` SET `status` = ?, `owner` = ? WHERE id = ?");
			$stmt_update->bind_param('ssi', $status_update, $users_username, $idshop);
			$stmt_update->execute();
			//ตัดเครดิต
			$sums_point = $users_point - $point_this_shop;
			$stmt_point = $connect->prepare("UPDATE tbl_users SET point = ? WHERE username = ?");
			$stmt_point->bind_param('ds', $sums_point, $users_username);
			$stmt_point->execute();

			$timeadd = time();
			$status_history = '1';
			$stmt_history = $connect->prepare("INSERT INTO `tbl_shop_history` (`secret_info`, `timeadd`, `point`, `username`, `gameid`, `status`) VALUES (?, ?, ?, ?, ?, ?)");
			$stmt_history->bind_param('ssdssi', $shop_info['secret_info'], $timeadd, $point_this_shop, $users_username, $idshop, $status_history);
			$stmt_history->execute();

			DisplayMSG('success', 'Buy Success!!', 'สั่งซื้อเรียบร้อย!!', 'true');
		} else {
			DisplayMSG('error', 'Warning ❗️❗️', 'เครดิตของคุณไม่เพียงพอ กรุณาเติมเงิน.', 'false');
		}

	}

	//สั่งซื้อ API
	if (isset($_GET['buy_pshop'])) {
		if (empty($_GET['id'])) {
			DisplayMSG('error', 'Warning ❗️❗️', 'ไม่พบสินค้า ✍️.', 'false');
		}
		$idshop = $connect->real_escape_string($_GET['id']);
		$stmt_api = $connect->prepare('SELECT * FROM `tbl_shop_stock_api` WHERE `id` = ?');
		$stmt_api->bind_param('i', $idshop);
		$stmt_api->execute();
		$shop_info = $stmt_api->get_result()->fetch_assoc();
		$product_id = $shop_info['product_id'];
		$product_point = $shop_info['price_web']; //ราคาเรา

		if ($users_point < $product_point) {
			DisplayMSG('error', 'Warning ❗️❗️', 'ยอดเงินของคุณไม่เพียงพอ.', 'true');
		} else {
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

			} else {
				$data = json_decode($response, true);
				// echo $data['status'];
				if ($data['status'] == "success") {

					$product_name = $data['name'];
					$product_price = $data['price'];
					$product_info = $data['info'];
					$product_status = $data['status'];
					// $product_stock = $data['stock'];
					// $product_id = $product_id;
					//check stock
					// check point user

					$point_update = $users_point - $product_point;
					$stmt_point = $connect->prepare("UPDATE `tbl_users` SET `point` = ? WHERE username = ?");
					$stmt_point->bind_param('ds', $point_update, $users_username);
					$stmt_point->execute();
					//เก็บลงประวัติ
					$timeadd = time();
					$stmt_history = $connect->prepare("INSERT INTO `tbl_history_api` (`name`, `status`, `info`, `price`, `timeadd`, `username`) VALUES (?, ?, ?, ?, ?, ?)");
					$stmt_history->bind_param('sssdss', $product_name, $product_status, $product_info, $product_point, $timeadd, $users_username);
					$stmt_history->execute();

					DisplayMSG('success', 'สั่งซื้อ ' . $product_name . ' เรียบร้อย!!', 'ตรวจสอบสินค้าได้ที่ ประวัติการสั่งซื้อ', 'true');

				} else {

					$product_message = $data['message'];
					// DisplayMSG('error','ERROR [10121]', 'กรุณาติดต่่อ แอดมิน','false');
					DisplayMSG('error', 'Warning ❗️❗️', '' . $product_message . '✍️.', 'true');
				}
			}


		}




	}

	//สังซื้อ account
	if (isset($_GET['buyshopaccount'])) {
		if (empty($_GET['id'])) {
			DisplayMSG('error', 'Warning ❗️❗️', 'ไม่พบสินค้านี้ ✍️.', 'false');
		}
		$idshop = $connect->real_escape_string($_GET['id']);
		//ดึงข้อมูลสินค้า
		$stmt_shop = $connect->prepare('SELECT * FROM `tbl_shop_id` WHERE `id` = ?');
		$stmt_shop->bind_param('i', $idshop);
		$stmt_shop->execute();
		$shop_info = $stmt_shop->get_result()->fetch_assoc();
		if ($users_status == $vip_status) {//vip
			$point_this_shop = $shop_info['pointv'];
		} else {
			$point_this_shop = $shop_info['point'];
		}
		if ($users_point >= $point_this_shop) {
			//add get gif code
			$stmt_account = $connect->prepare("SELECT * FROM `tbl_shop_stock` WHERE `shopid` = ? ORDER BY id ASC");
			$stmt_account->bind_param('i', $idshop);
			$stmt_account->execute();
			$account_info = $stmt_account->get_result();
			$num_account_info = $account_info->num_rows;
			$res_account_info = $account_info->fetch_assoc();
			if ($num_account_info == 0) {
				DisplayMSG('error', 'Out of stock ❗️❗️', 'สินค้านี้หมด Stock ✍️.', 'false');
			}
			//ตัดเครดิต
			$sums_point = $users_point - $point_this_shop;
			$stmt_point = $connect->prepare("UPDATE tbl_users SET point = ? WHERE username = ?");
			$stmt_point->bind_param('ds', $sums_point, $users_username);
			$stmt_point->execute();

			$velue_item = $res_account_info['account'];
			//add account to history
			$timeadd = time();
			$status_history = '1';
			$stmt_history = $connect->prepare("INSERT INTO `tbl_shop_history` (`secret_info`, `timeadd`, `point`, `username`, `gameid`, `status`) VALUES (?, ?, ?, ?, ?, ?)");
			$stmt_history->bind_param('ssdssi', $velue_item, $timeadd, $point_this_shop, $users_username, $idshop, $status_history);
			$stmt_history->execute();

			//ลบ account ที่ซื้อแล้ว
			$stmt_del = $connect->prepare("DELETE FROM tbl_shop_stock WHERE id = ?");
			$stmt_del->bind_param('i', $res_account_info['id']);
			$stmt_del->execute();

			DisplayMSG('success', 'Buy Success ❗️❗️', 'สั่งซื้อเรียบร้อย!!', 'true');
		} else {
			DisplayMSG('error', 'Warning ❗️❗️', 'เครดิตของคุณไม่เพียงพอ กรุณาเติมเงิน.', 'false');
		}

	}

	//spin game
	if (isset($_GET['spin_api'])) {

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			// if(true)  {

			$point_use_game = $result_info_web['point_spin']; // ระบุราคาสุ่ม
			if ($users_point < $point_use_game) {
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
			} else {

				// ----------------------
				//หักเงิน
				$nowpoint = $users_point - $point_use_game;
				$nowpoint = $users_point - $point_use_game;
				$stmt_point = $connect->prepare("UPDATE `tbl_users` SET `point` = ? WHERE username = ?");
				$stmt_point->bind_param('ds', $nowpoint, $users_username);
				$stmt_point->execute();
				// ----------------------
				$item_reward = $connect->query("SELECT * FROM tbl_item_rewards WHERE game = 'spin'");
				$res_items = $item_reward->fetch_all(MYSQLI_ASSOC);
				$count_item = $item_reward->num_rows;

				$data = array();
				// เพิ่มรายการใหม่ในอาร์เรย์
				foreach ($res_items as $res_item) {
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
				$stmt_reward = $connect->prepare("SELECT * FROM tbl_item_rewards WHERE game = 'spin' AND id = ?");
				$stmt_reward->bind_param('i', $randomItem['id']);
				$stmt_reward->execute();
				$info_reward = $stmt_reward->get_result()->fetch_assoc();

				if ($info_reward['type'] == 1) {//no reward
					//point user หลังอัพเดท
					$stmt_usr = $connect->prepare("SELECT * FROM `tbl_users` WHERE `username` = ?");
					$stmt_usr->bind_param('s', $users_username);
					$stmt_usr->execute();
					$info_user_now = $stmt_usr->get_result()->fetch_assoc();

					//add reward to history
					$val_msg = 'ไม่ได้รับรางวัล';
					$timeadd = time();
					$status = '1';
					$stmt_hist = $connect->prepare("INSERT INTO `tbl_history_rewards` (`name`, `game`, `value`, `timeadd`, `status`, `username`) VALUES (?, ?, ?, ?, ?, ?)");
					$stmt_hist->bind_param('ssssss', $info_reward['name'], $info_reward['game'], $val_msg, $timeadd, $status, $users_username);
					$stmt_hist->execute();

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

				} else if ($info_reward['type'] == 2) {// point
					$value_random = explode('|', $info_reward['value']);
					$min = $value_random[0];
					$max = $value_random[1];
					$point_random = rand($min, $max);
					//point user ก่อนอัพเดท
					$stmt_usr = $connect->prepare("SELECT * FROM `tbl_users` WHERE `username` = ?");
					$stmt_usr->bind_param('s', $users_username);
					$stmt_usr->execute();
					$info_user_now = $stmt_usr->get_result()->fetch_assoc();

					//add point
					$addpoint = $users_point + $point_random;
					$stmt_point = $connect->prepare("UPDATE `tbl_users` SET `point` = ? WHERE username = ?");
					$stmt_point->bind_param('ds', $addpoint, $users_username);
					$stmt_point->execute();

					//add reward to history
					$val_msg = $point_random . ' เครดิต';
					$timeadd = time();
					$status = '1';
					$stmt_hist = $connect->prepare("INSERT INTO `tbl_history_rewards` (`name`, `game`, `value`, `timeadd`, `status`, `username`) VALUES (?, ?, ?, ?, ?, ?)");
					$stmt_hist->bind_param('ssssss', $info_reward['name'], $info_reward['game'], $val_msg, $timeadd, $status, $users_username);
					$stmt_hist->execute();

					//point user หลังอัพเดท
					$stmt_usrs = $connect->prepare("SELECT * FROM `tbl_users` WHERE `username` = ?");
					$stmt_usrs->bind_param('s', $users_username);
					$stmt_usrs->execute();
					$info_user_nows = $stmt_usrs->get_result()->fetch_assoc();

					$put_data['status'] = 200;
					$put_data['valueid'] = intval($randomItem['id']); //intval แปลงเป็น int
					$put_data['item_value'] = $point_random . " เครดิต";
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

				} else if ($info_reward['type'] == 3) {// gif code

					//point user ก่อนอัพเดท
					$stmt_usr = $connect->prepare("SELECT * FROM `tbl_users` WHERE `username` = ?");
					$stmt_usr->bind_param('s', $users_username);
					$stmt_usr->execute();
					$info_user_now = $stmt_usr->get_result()->fetch_assoc();

					//add get gif code
					$stmt_gif = $connect->prepare("SELECT * FROM `tbl_code_rewards` WHERE `reward_id` = ? ORDER BY id ASC");
					$stmt_gif->bind_param('i', $info_reward['id']);
					$stmt_gif->execute();
					$gifcode_info = $stmt_gif->get_result();
					$num_gifcode_info = $gifcode_info->num_rows;
					$res_gifcode_info = $gifcode_info->fetch_assoc();
					if ($num_gifcode_info == 0) {
						$velue_item = "Gif Code หมดติดต่อ แอดมิน!!";
						//add reward to history
						$timeadd = time();
						$status = '1';
						$stmt_hist = $connect->prepare("INSERT INTO `tbl_history_rewards` (`name`, `game`, `value`, `timeadd`, `status`, `username`) VALUES (?, ?, ?, ?, ?, ?)");
						$stmt_hist->bind_param('ssssss', $info_reward['name'], $info_reward['game'], $velue_item, $timeadd, $status, $users_username);
						$stmt_hist->execute();
					} else {
						$velue_item = $res_gifcode_info['code'];

						//add reward to history
						$timeadd = time();
						$status = '1';
						$stmt_hist = $connect->prepare("INSERT INTO `tbl_history_rewards` (`name`, `game`, `value`, `timeadd`, `status`, `username`) VALUES (?, ?, ?, ?, ?, ?)");
						$stmt_hist->bind_param('ssssss', $info_reward['name'], $info_reward['game'], $velue_item, $timeadd, $status, $users_username);
						$stmt_hist->execute();

						//remove aftar add history
						$stmt_del = $connect->prepare("DELETE FROM tbl_code_rewards WHERE id = ?");
						$stmt_del->bind_param('i', $res_gifcode_info['id']);
						$stmt_del->execute();
					}
					//point user หลังอัพเดท
					$stmt_usrs = $connect->prepare("SELECT * FROM `tbl_users` WHERE `username` = ?");
					$stmt_usrs->bind_param('s', $users_username);
					$stmt_usrs->execute();
					$info_user_nows = $stmt_usrs->get_result()->fetch_assoc();

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

				} else {
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
	if (isset($_GET['roller_api'])) {

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			// if(true)  {

			$point_use_game = $result_info_web['point_roller']; // ระบุราคาสุ่ม
			if ($users_point < $point_use_game) {
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
			} else {

				// ----------------------
				//หักเงิน
				$nowpoint = $users_point - $point_use_game;
				$stmt_point = $connect->prepare("UPDATE `tbl_users` SET `point` = ? WHERE username = ?");
				$stmt_point->bind_param('ds', $nowpoint, $users_username);
				$stmt_point->execute();
				// ----------------------
				$item_reward = $connect->query("SELECT * FROM tbl_item_rewards WHERE game = 'roller'");
				$res_items = $item_reward->fetch_all(MYSQLI_ASSOC);
				$count_item = $item_reward->num_rows;

				$data = array();
				// เพิ่มรายการใหม่ในอาร์เรย์
				foreach ($res_items as $res_item) {
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

				$stmt_reward = $connect->prepare("SELECT * FROM tbl_item_rewards WHERE game = 'roller' AND id = ?");
				$stmt_reward->bind_param('i', $randomItem['id']);
				$stmt_reward->execute();
				$info_reward = $stmt_reward->get_result()->fetch_assoc();

				if ($info_reward['type'] == 1) {//no reward
					//point user หลังอัพเดท
					$stmt_usr = $connect->prepare("SELECT * FROM `tbl_users` WHERE `username` = ?");
					$stmt_usr->bind_param('s', $users_username);
					$stmt_usr->execute();
					$info_user_now = $stmt_usr->get_result()->fetch_assoc();

					//add reward to history
					$val_msg = 'ไม่ได้รับรางวัล';
					$game = 'roller';
					$timeadd = time();
					$status = '1';
					$stmt_hist = $connect->prepare("INSERT INTO `tbl_history_rewards` (`name`, `game`, `value`, `timeadd`, `status`, `username`) VALUES (?, ?, ?, ?, ?, ?)");
					$stmt_hist->bind_param('ssssss', $info_reward['name'], $info_reward['game'], $val_msg, $timeadd, $status, $users_username);
					$stmt_hist->execute();

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

				} else if ($info_reward['type'] == 2) {// point
					$value_random = explode('|', $info_reward['value']);
					$min = $value_random[0];
					$max = $value_random[1];
					$point_random = rand($min, $max);
					//point user ก่อนอัพเดท
					$stmt_usr = $connect->prepare("SELECT * FROM `tbl_users` WHERE `username` = ?");
					$stmt_usr->bind_param('s', $users_username);
					$stmt_usr->execute();
					$info_user_now = $stmt_usr->get_result()->fetch_assoc();

					//add point
					$addpoint = $users_point + $point_random;
					$stmt_point = $connect->prepare("UPDATE `tbl_users` SET `point` = ? WHERE username = ?");
					$stmt_point->bind_param('ds', $addpoint, $users_username);
					$stmt_point->execute();

					//add reward to history
					$val_msg = $point_random . ' เครดิต';
					$timeadd = time();
					$status = '1';
					$stmt_hist = $connect->prepare("INSERT INTO `tbl_history_rewards` (`name`, `game`, `value`, `timeadd`, `status`, `username`) VALUES (?, ?, ?, ?, ?, ?)");
					$stmt_hist->bind_param('ssssss', $info_reward['name'], $info_reward['game'], $val_msg, $timeadd, $status, $users_username);
					$stmt_hist->execute();

					//point user หลังอัพเดท
					$stmt_usrs = $connect->prepare("SELECT * FROM `tbl_users` WHERE `username` = ?");
					$stmt_usrs->bind_param('s', $users_username);
					$stmt_usrs->execute();
					$info_user_nows = $stmt_usrs->get_result()->fetch_assoc();

					$put_data['status'] = 200;
					$put_data['valueid'] = intval($randomItem['id']); //intval แปลงเป็น int
					$put_data['item_value'] = $point_random . " เครดิต";
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

				} else if ($info_reward['type'] == 3) {// gif code

					//point user ก่อนอัพเดท
					$stmt_usr = $connect->prepare("SELECT * FROM `tbl_users` WHERE `username` = ?");
					$stmt_usr->bind_param('s', $users_username);
					$stmt_usr->execute();
					$info_user_now = $stmt_usr->get_result()->fetch_assoc();

					//add get gif code
					$stmt_gif = $connect->prepare("SELECT * FROM `tbl_code_rewards` WHERE `reward_id` = ? ORDER BY id ASC");
					$stmt_gif->bind_param('i', $info_reward['id']);
					$stmt_gif->execute();
					$gifcode_info = $stmt_gif->get_result();
					$num_gifcode_info = $gifcode_info->num_rows;
					$res_gifcode_info = $gifcode_info->fetch_assoc();
					if ($num_gifcode_info == 0) {
						$velue_item = "Gif Code หมดติดต่อ แอดมิน!!";
						//add reward to history
						$timeadd = time();
						$status = '1';
						$stmt_hist = $connect->prepare("INSERT INTO `tbl_history_rewards` (`name`, `game`, `value`, `timeadd`, `status`, `username`) VALUES (?, ?, ?, ?, ?, ?)");
						$stmt_hist->bind_param('ssssss', $info_reward['name'], $info_reward['game'], $velue_item, $timeadd, $status, $users_username);
						$stmt_hist->execute();
					} else {
						$velue_item = $res_gifcode_info['code'];

						//add reward to history
						$timeadd = time();
						$status = '1';
						$stmt_hist = $connect->prepare("INSERT INTO `tbl_history_rewards` (`name`, `game`, `value`, `timeadd`, `status`, `username`) VALUES (?, ?, ?, ?, ?, ?)");
						$stmt_hist->bind_param('ssssss', $info_reward['name'], $info_reward['game'], $velue_item, $timeadd, $status, $users_username);
						$stmt_hist->execute();

						//remove aftar add history
						$stmt_del = $connect->prepare("DELETE FROM tbl_code_rewards WHERE id = ?");
						$stmt_del->bind_param('i', $res_gifcode_info['id']);
						$stmt_del->execute();
					}
					//point user หลังอัพเดท
					$stmt_usrs = $connect->prepare("SELECT * FROM `tbl_users` WHERE `username` = ?");
					$stmt_usrs->bind_param('s', $users_username);
					$stmt_usrs->execute();
					$info_user_nows = $stmt_usrs->get_result()->fetch_assoc();

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

				} else {
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
	if (isset($_GET['slot_api'])) {

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			// if(true)  {

			$point_use_game = $result_info_web['point_slot']; // ระบุราคาสุ่ม
			if ($users_point < $point_use_game) {
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
			} else {

				// ----------------------
				//หักเงิน
				$nowpoint = $users_point - $point_use_game;
				$stmt_point = $connect->prepare("UPDATE `tbl_users` SET `point` = ? WHERE username = ?");
				$stmt_point->bind_param('ds', $nowpoint, $users_username);
				$stmt_point->execute();
				// ----------------------
				$item_reward = $connect->query("SELECT * FROM tbl_item_rewards WHERE game = 'slot'");
				$res_items = $item_reward->fetch_all(MYSQLI_ASSOC);
				$count_item = $item_reward->num_rows;

				$data = array();
				// เพิ่มรายการใหม่ในอาร์เรย์
				foreach ($res_items as $res_item) {
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

				if ($randomItem1['id'] == $randomItem2['id'] && $randomItem1['id'] == $randomItem3['id']) {//รางวัลต้องกัน ให่เข้า if
					//echo "dd";
					//get item ที่สุ่มได้
					$stmt_reward = $connect->prepare("SELECT * FROM tbl_item_rewards WHERE game = 'slot' AND id = ?");
					$stmt_reward->bind_param('i', $randomItem1['id']);
					$stmt_reward->execute();
					$info_reward = $stmt_reward->get_result()->fetch_assoc();
					if ($info_reward['type'] == 1) {//no reward
						//point user หลังอัพเดท
						$stmt_usr = $connect->prepare("SELECT * FROM `tbl_users` WHERE `username` = ?");
						$stmt_usr->bind_param('s', $users_username);
						$stmt_usr->execute();
						$info_user_now = $stmt_usr->get_result()->fetch_assoc();

						//add reward to history
						$val_msg = 'ไม่ได้รับรางวัล';
						$timeadd = time();
						$status = '1';
						$stmt_hist = $connect->prepare("INSERT INTO `tbl_history_rewards` (`name`, `game`, `value`, `timeadd`, `status`, `username`) VALUES (?, ?, ?, ?, ?, ?)");
						$stmt_hist->bind_param('ssssss', $info_reward['name'], $info_reward['game'], $val_msg, $timeadd, $status, $users_username);
						$stmt_hist->execute();

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

					} else if ($info_reward['type'] == 2) {// point
						$value_random = explode('|', $info_reward['value']);
						$min = $value_random[0];
						$max = $value_random[1];
						$point_random = rand($min, $max);
						//point user ก่อนอัพเดท
						$stmt_usr = $connect->prepare("SELECT * FROM `tbl_users` WHERE `username` = ?");
						$stmt_usr->bind_param('s', $users_username);
						$stmt_usr->execute();
						$info_user_now = $stmt_usr->get_result()->fetch_assoc();

						//add point
						$addpoint = $users_point + $point_random;
						$stmt_point = $connect->prepare("UPDATE `tbl_users` SET `point` = ? WHERE username = ?");
						$stmt_point->bind_param('ds', $addpoint, $users_username);
						$stmt_point->execute();

						//add reward to history
						$val_msg = $point_random . ' เครดิต';
						$timeadd = time();
						$status = '1';
						$stmt_hist = $connect->prepare("INSERT INTO `tbl_history_rewards` (`name`, `game`, `value`, `timeadd`, `status`, `username`) VALUES (?, ?, ?, ?, ?, ?)");
						$stmt_hist->bind_param('ssssss', $info_reward['name'], $info_reward['game'], $val_msg, $timeadd, $status, $users_username);
						$stmt_hist->execute();

						//point user หลังอัพเดท
						$stmt_usrs = $connect->prepare("SELECT * FROM `tbl_users` WHERE `username` = ?");
						$stmt_usrs->bind_param('s', $users_username);
						$stmt_usrs->execute();
						$info_user_nows = $stmt_usrs->get_result()->fetch_assoc();

						$put_data['status'] = 200;
						$put_data['valueid1'] = intval($randomItem1['id']); //intval แปลงเป็น int
						$put_data['valueid2'] = intval($randomItem2['id']);
						$put_data['valueid3'] = intval($randomItem3['id']);
						$put_data['item_value'] = $point_random . " เครดิต";
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

					} else if ($info_reward['type'] == 3) {// gif code

						//point user ก่อนอัพเดท
						$stmt_usr = $connect->prepare("SELECT * FROM `tbl_users` WHERE `username` = ?");
						$stmt_usr->bind_param('s', $users_username);
						$stmt_usr->execute();
						$info_user_now = $stmt_usr->get_result()->fetch_assoc();

						//add get gif code
						$stmt_gif = $connect->prepare("SELECT * FROM `tbl_code_rewards` WHERE `reward_id` = ? ORDER BY id ASC");
						$stmt_gif->bind_param('i', $info_reward['id']);
						$stmt_gif->execute();
						$gifcode_info = $stmt_gif->get_result();
						$num_gifcode_info = $gifcode_info->num_rows;
						$res_gifcode_info = $gifcode_info->fetch_assoc();
						if ($num_gifcode_info == 0) {
							$velue_item = "Gif Code หมดติดต่อ แอดมิน!!";
							//add reward to history
							$timeadd = time();
							$status = '1';
							$stmt_hist = $connect->prepare("INSERT INTO `tbl_history_rewards` (`name`, `game`, `value`, `timeadd`, `status`, `username`) VALUES (?, ?, ?, ?, ?, ?)");
							$stmt_hist->bind_param('ssssss', $info_reward['name'], $info_reward['game'], $velue_item, $timeadd, $status, $users_username);
							$stmt_hist->execute();
						} else {
							$velue_item = $res_gifcode_info['code'];

							//add reward to history
							$timeadd = time();
							$status = '1';
							$stmt_hist = $connect->prepare("INSERT INTO `tbl_history_rewards` (`name`, `game`, `value`, `timeadd`, `status`, `username`) VALUES (?, ?, ?, ?, ?, ?)");
							$stmt_hist->bind_param('ssssss', $info_reward['name'], $info_reward['game'], $velue_item, $timeadd, $status, $users_username);
							$stmt_hist->execute();

							//remove aftar add history
							$stmt_del = $connect->prepare("DELETE FROM tbl_code_rewards WHERE id = ?");
							$stmt_del->bind_param('i', $res_gifcode_info['id']);
							$stmt_del->execute();
						}
						//point user หลังอัพเดท
						$stmt_usrs = $connect->prepare("SELECT * FROM `tbl_users` WHERE `username` = ?");
						$stmt_usrs->bind_param('s', $users_username);
						$stmt_usrs->execute();
						$info_user_nows = $stmt_usrs->get_result()->fetch_assoc();

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

					} else {
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


				} else {
					//point user หลังอัพเดท
					$stmt_usr = $connect->prepare("SELECT * FROM `tbl_users` WHERE `username` = ?");
					$stmt_usr->bind_param('s', $users_username);
					$stmt_usr->execute();
					$info_user_now = $stmt_usr->get_result()->fetch_assoc();
					//add reward to history
					$val_msg = 'ไม่ได้รับรางวัล';
					$game = 'slot';
					$timeadd = time();
					$status = '1';
					$stmt_hist = $connect->prepare("INSERT INTO `tbl_history_rewards` (`name`, `game`, `value`, `timeadd`, `status`, `username`) VALUES (?, ?, ?, ?, ?, ?)");
					$stmt_hist->bind_param('ssssss', $val_msg, $game, $val_msg, $timeadd, $status, $users_username);
					$stmt_hist->execute();

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
if (isset($_GET['UpdateStock'])) {

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
	foreach ($load_packz as $data):

		//เช็คสถานะสินค้า
		$check_stock = $data->stock;
		$shop_status = $data->status;
		$shop_point = $data->price;
		$shop_img = $data->img;
		$shop_name = $data->name;
		$shop_id = $data->id;

		// $query = $connect->query("INSERT INTO `tbl_shop_stock_api` (`id`, `product_id`, `name`, `price`, `price_web`, `img`, `stock`, `status`, `up`)
		// VALUES (NULL, '".$shop_id."', '".$shop_name."', '".$shop_point."', '".$shop_point."', '".$shop_img ."', '".$check_stock."', '".$shop_status."', '');");
		$stmt_update = $connect->prepare("UPDATE `tbl_shop_stock_api` SET `price` = ?, `stock` = ?, `status` = ? WHERE product_id = ?");
		$stmt_update->bind_param('ssss', $shop_point, $check_stock, $shop_status, $shop_id);
		$stmt_update->execute();

	endforeach;




}



function DisplayMSG($function, $title, $msg, $reload)
{
	global $url;
	// $uri = $_SERVER['REQUEST_URI'];
	if ($reload == 'true') {
		$data = exit("<script>$function('$title', '$msg', 'true');setTimeout(function(){ window.location.reload(); }, 2500);</script>");
		// $data = exit("<script>$function('$title', '$msg', 'true');setTimeout(function(){ location.href = \"$url\"; }, 2500);</script>");
	} else {
		$data = exit("<script>$function('$title', '$msg', 'false');</script>");
	}
	return $data;
}
function iDisplayMSG($function, $title, $msg, $reload, $url)
{
	if (empty($url)) {
		$url = "..";
	}
	if ($function == 'isuccess' || $function == 'ierror') {
		if ($reload == 'true') {
			$data = "<script>$function('$title', '$msg', 'true', '$url');setTimeout(function(){ location.href = \"$url\"; }, 2500);</script>";
		} else {
			$data = "<script>$function('$title', '$msg', 'false','');</script>";
		}
	} else {
		if ($reload == 'true') {
			$data = "<script>$function('$title', '$msg', 'true');setTimeout(function(){ location.href = \"$url\"; }, 2500);</script>";
		} else {
			$data = "<script>$function('$title', '$msg', 'false');</script>";
		}
	}
	echo $data;
}

$months = array(
	"0" => "",
	"1" => "มกราคม",
	"2" => "กุมภาพันธ์",
	"3" => "มีนาคม",
	"4" => "เมษายน",
	"5" => "พฤษภาคม",
	"6" => "มิถุนายน",
	"7" => "กรกฎาคม",
	"8" => "สิงหาคม",
	"9" => "กันยายน",
	"10" => "ตุลาคม",
	"11" => "พฤศจิกายน",
	"12" => "ธันวาคม"
);
function th_full($time)
{
	global $months;
	$th = '';
	$th .= date("H", $time);
	$th .= ":" . date("i", $time);
	$th .= "  วันที่ " . date("j", $time);
	$th .= " " . $months[date("n", $time)];
	$th .= " พ.ศ." . (date("Y", $time) + 543);
	return $th;
}
function th($time)
{
	global $months;
	$th = '';
	$th .= date("H", $time);
	$th .= ":" . date("i", $time);
	$th .= " " . date("j", $time);
	$th .= " " . $months[date("n", $time)];
	$th .= " " . (date("Y", $time) + 543);
	return $th;
}


?>