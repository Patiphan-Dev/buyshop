<?php
require('idpass.php');

//check status login
if (isset($_SESSION['username'])) {
    //check status admin
    if ($users_status == $admin_status) {

        if (isset($_GET['add_category'])) {

            if (empty($_POST['name'])) {
                DisplayMSG('error', 'Error', 'กรุณากรอกเชื่อของรางวัล.', 'false');
            }
            if (empty($_POST['platform'])) {
                DisplayMSG('error', 'Error', 'กรุณากรอก platform.', 'false');
            }
            if (empty($_POST['typecategory'])) {
                DisplayMSG('error', 'Error', 'กรุณากรอกเลือกประเภทหมวดหมู่.', 'false');
            }

            $image_name = $_FILES['file']['name'];
            //$temp = explode(".", $image_name);
            //$newfilename = round(microtime(true)) . '.' . end($temp);
            $imagepath = "assets/img/game_icon/" . $image_name;
            // $imagepath ="assets/img/xslot/".$newfilename;
            move_uploaded_file($_FILES["file"]["tmp_name"], $imagepath);

            $stmt = $connect->prepare("INSERT INTO `tbl_game` (`typegame`, `name`, `img`, `platform`, `status`) VALUES (?, ?, ?, ?, '1')");
            $stmt->bind_param('ssss', $_POST['typecategory'], $_POST['name'], $image_name, $_POST['platform']);
            $stmt->execute();

            DisplayMSG('success', 'Add Category Success !!!', 'เพิ่มเรียบร้อย !!!..', 'true');

        }

        if (isset($_GET['update_category'])) {

            if (empty($_POST['name'])) {
                DisplayMSG('error', 'Error', 'กรุณากรอกเชื่อของรางวัล.', 'false');
            }
            if (empty($_POST['platform'])) {
                DisplayMSG('error', 'Error', 'กรุณากรอก platform.', 'false');
            }
            if (empty($_POST['typecategory'])) {
                DisplayMSG('error', 'Error', 'กรุณากรอกเลือกประเภทหมวดหมู่.', 'false');
            }

            $idshop = $_POST['idshop'];
            $stmt_old = $connect->prepare("SELECT * FROM `tbl_game` WHERE id = ?");
            $stmt_old->bind_param('i', $idshop);
            $stmt_old->execute();
            $old_info = $stmt_old->get_result()->fetch_assoc();
            // echo $_FILES['file']['name'] ;
            if (empty($_FILES['file']['name'])) {
                $image_now = $old_info['img'];
            } else {
                unlink('assets/img/game_icon/' . $old_info['img']);
                $image_name = $_FILES['file']['name'];
                $imagepath = "assets/img/game_icon/" . $image_name;
                $image_now = $image_name;
                move_uploaded_file($_FILES["file"]["tmp_name"], $imagepath);
            }

            $stmt = $connect->prepare("UPDATE `tbl_game` SET `typegame` = ?, `img` = ?, `name` = ?, `platform` = ? WHERE id = ?");
            $stmt->bind_param('ssssi', $_POST['typecategory'], $image_now, $_POST['name'], $_POST['platform'], $idshop);
            $stmt->execute();

            DisplayMSG('success', 'Update Category Success !!!', 'แก้ไขเรียบร้อย !!!..', 'true');

        }

        if (isset($_GET['delete_category'])) {
            if (empty($_GET['id'])) {
                DisplayMSG('error', 'Error', 'ไม่พบ category.', 'false');
            }

            //ถ้ามีสินค้าเรียกใช้ category อยู่ไม่ให้ลบ 
            $stmt_num = $connect->prepare("SELECT * FROM tbl_shop_id WHERE gameid = ?");
            $stmt_num->bind_param('i', $_GET['id']);
            $stmt_num->execute();
            $num_shop = $stmt_num->get_result()->num_rows;
            if ($num_shop > 0) {
                DisplayMSG('error', 'Error', 'category นี้ยังมีสินค้าอยู่ไม่สามารถลบได้', 'false');
            }

            //ดึงข้อมูล category 
            $stmt_cat = $connect->prepare("SELECT * FROM tbl_game WHERE id = ?");
            $stmt_cat->bind_param('i', $_GET['id']);
            $stmt_cat->execute();
            $categorys = $stmt_cat->get_result()->fetch_assoc();
            unlink('assets/img/game_icon/' . $categorys['img']);

            $stmt_del = $connect->prepare("DELETE FROM tbl_game WHERE id = ?");
            $stmt_del->bind_param('i', $_GET['id']);
            $stmt_del->execute();

            DisplayMSG('success', 'Delete Success !!!', 'ลบเรียบร้อย !!!..', 'true');

        }


        //add shop
        if (isset($_GET['add_shop_id'])) {

            if (empty($_POST['shopname'])) {
                DisplayMSG('error', 'Error', 'กรุณากรอกเชื่อสินค้า.', 'false');
            }
            if (empty($_POST['name'])) {
                DisplayMSG('error', 'Error', 'กรุณากรอกข้อมูลสินค้า.', 'false');
            }
            if (empty($_POST['shoptype'])) {
                DisplayMSG('error', 'Error', 'กรุณากรอกประเภทสินค้า.', 'false');
            }
            if (empty($_POST['point'])) {
                DisplayMSG('error', 'Error', 'กรุณากระบุราคาปกติสินค้า.', 'false');
            }
            if (empty($_POST['pointv'])) {
                DisplayMSG('error', 'Error', 'กรุณากระบุราคาพิเศษสินค้า.', 'false');
            }

            $image_name_array = array();
            // if(empty($image_name_array))  {
            // 	DisplayMSG('error','Error', 'กรุณาใส่รูปสินค้า.' ,'false');
            // }

            if ($_POST['shoptype'] == 2) {
                for ($i = 0; $i < count($_FILES["file"]["name"]); $i++) {
                    $image_name = $_FILES['file']['name'][$i];
                    $imagepath = "assets/img/shop/" . $image_name;
                    // move_uploaded_file($_FILES["file"]["tmp_name"], $imagepath); 
                    move_uploaded_file($_FILES["file"]["tmp_name"][$i], $imagepath);
                    $image_name_array[] = $imagepath;
                    // array_push($image_name_array, "$folder".$_FILES["file"]["name"][$i]);
                }
                // htmlspecialchars($_POST['name'])
                $info_id_game = openssl_encrypt($_POST['secret_info'], $ciphering, $encryption_key, $options, $encryption_iv);

                $shoptype = 'account';
                $shopname = htmlspecialchars($_POST['shopname']);
                $img_str = implode(',', $image_name_array);
                $timeadd = time();
                $status = '1';
                $count = '0';
                $top = '0';
                $pub_info = htmlspecialchars($_POST['name']);

                $stmt = $connect->prepare("INSERT INTO `tbl_shop_id` (`gameid`, `shoptype`, `name`, `img`, `point`, `pointv`, `timeadd`, `status`, `username`, `count`, `top`, `secret_info`, `publish_info`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param('ssssssisssiss', $_POST['category'], $shoptype, $shopname, $img_str, $_POST['point'], $_POST['pointv'], $timeadd, $status, $users_username, $count, $top, $info_id_game, $pub_info);
                $stmt->execute();

                DisplayMSG('success', 'Add Shop Success !!!', 'เพิ่มเรียบร้อย !!!..', 'true');

            } else {
                // $image_name_array = array();

                for ($i = 0; $i < count($_FILES["file"]["name"]); $i++) {
                    $image_name = $_FILES['file']['name'][$i];
                    $imagepath = "assets/img/shop/" . $image_name;
                    // move_uploaded_file($_FILES["file"]["tmp_name"], $imagepath); 
                    move_uploaded_file($_FILES["file"]["tmp_name"][$i], $imagepath);
                    $image_name_array[] = $imagepath;
                    // array_push($image_name_array, "$folder".$_FILES["file"]["name"][$i]);
                }
                // htmlspecialchars($_POST['name'])
                $info_id_game = openssl_encrypt($_POST['secret_info'], $ciphering, $encryption_key, $options, $encryption_iv);

                $shoptype = 'idgame';
                $shopname = htmlspecialchars($_POST['shopname']);
                $img_str = implode(',', $image_name_array);
                $timeadd = time();
                $status = '1';
                $count = '0';
                $top = '0';
                $pub_info = htmlspecialchars($_POST['name']);

                $stmt = $connect->prepare("INSERT INTO `tbl_shop_id` (`gameid`, `shoptype`, `name`, `img`, `point`, `timeadd`, `status`, `username`, `count`, `top`, `secret_info`, `publish_info`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param('sssssisssiss', $_POST['category'], $shoptype, $shopname, $img_str, $_POST['point'], $timeadd, $status, $users_username, $count, $top, $info_id_game, $pub_info);
                $stmt->execute();

                DisplayMSG('success', 'Add Shop Success !!!', 'เพิ่มเรียบร้อย !!!..', 'true');

            }

            //-------

        }

        //edit shop
        if (isset($_GET['edit_shop_id'])) {

            if (empty($_POST['shopname'])) {
                DisplayMSG('error', 'Error', 'กรุณากรอกเชื่อสินค้า.', 'false');
            }
            if (empty($_POST['name'])) {
                DisplayMSG('error', 'Error', 'กรุณากรอกข้อมูลสินค้า.', 'false');
            }
            if (empty($_POST['shoptype'])) {
                DisplayMSG('error', 'Error', 'กรุณากรอกประเภทสินค้า.', 'false');
            }
            if (empty($_POST['point'])) {
                DisplayMSG('error', 'Error', 'กรุณากระบุราคาปกติสินค้า.', 'false');
            }

            // if (!empty($_FILES["file"]["name"])) {
            $idedit = $connect->real_escape_string(@$_POST['shopid']);
            $image_name_array = array();

            if (!empty($_FILES["file"]["name"]) && empty($_POST['img_info'])) {
                for ($i = 0; $i < count($_FILES["file"]["name"]); $i++) {
                    $image_name = $_FILES['file']['name'][$i];
                    $imagepath = "assets/img/shop/" . $image_name;
                    move_uploaded_file($_FILES["file"]["tmp_name"][$i], $imagepath);
                    $image_name_array[] = $imagepath;
                }
            } else if (empty($_FILES["file"]["name"]) && !empty($_POST['img_info'])) {
                $result_image = explode(',', trim($_POST['img_info']));
                foreach ($result_image as $i => $result_shops) {
                    if (!empty($result_shops)) {
                        $image_name_array[] = $result_shops;
                    }
                }
            } else if (empty($_FILES["file"]["name"]) && empty($_POST['img_info'])) {
                $image_name_array[] = '';
            } else {
                $result_image = explode(',', trim($_POST['img_info']));
                foreach ($result_image as $i => $result_shops) {
                    if (!empty($result_shops)) {
                        $image_name_array[] = $result_shops;
                    }
                }
                for ($i = 0; $i < count($_FILES["file"]["name"]); $i++) {
                    $image_name = $_FILES['file']['name'][$i];
                    $imagepath = "assets/img/shop/" . $image_name;
                    move_uploaded_file($_FILES["file"]["tmp_name"][$i], $imagepath);
                    $image_name_array[] = $imagepath;
                }
            }

            $stmt_old = $connect->prepare("SELECT * FROM tbl_shop_id WHERE id = ?");
            $stmt_old->bind_param('s', $idedit);
            $stmt_old->execute();
            $result_shop_image = $stmt_old->get_result()->fetch_assoc();



            if ($_POST['shoptype'] == '1') {
                $shoptype = 'idgame';
            } else {
                $shoptype = 'account';
            }

            // htmlspecialchars($_POST['name'])implode(',', $image_name_array)
            $id_secret_info = openssl_encrypt($_POST['secret_info'], $ciphering, $encryption_key, $options, $encryption_iv);

            $img_str = implode(',', $image_name_array);
            $timeadd = time();
            $pub_info = $_POST['name'];
            $stmt = $connect->prepare("UPDATE `tbl_shop_id` SET `gameid` = ?, `shoptype` = ?, `name` = ?, `img` = ?, `point` = ?, `pointv` = ?, `timeadd` = ?, `secret_info` = ?, `publish_info` = ? WHERE id = ?");
            $stmt->bind_param('ssssssisss', $_POST['category'], $shoptype, $_POST['shopname'], $img_str, $_POST['point'], $_POST['pointv'], $timeadd, $id_secret_info, $pub_info, $idedit);
            $stmt->execute();

            DisplayMSG('success', 'Update Shop Success !!!', 'แก้เรียบร้อย !!!..', 'true');
        }

        //update users
        if (isset($_GET['updateusers'])) {
            if (empty($_POST['id'])) {
                DisplayMSG('error', 'Error', 'ไม่พบผู้ใช้.', 'false');
            }
            if (empty($_POST['img']) || empty($_POST['email']) || empty($_POST['ip'])) {
                DisplayMSG('error', 'Error', 'กรุณากรอกกรอกข้อมูลให้ครบ.', 'false');
            }
            $id = $connect->real_escape_string($_POST['id']);
            $img = $connect->real_escape_string($_POST['img']);
            $email = $connect->real_escape_string($_POST['email']);
            $point = $connect->real_escape_string($_POST['point']);
            $ip = $connect->real_escape_string($_POST['ip']);
            $status = $connect->real_escape_string($_POST['status']);

            $stmt = $connect->prepare("UPDATE `tbl_users` SET `img` = ?, `email` = ?, `point` = ?, `ip` = ?, `status` = ? WHERE `id` = ?");
            $stmt->bind_param('ssssss', $img, $email, $point, $ip, $status, $id);
            $stmt->execute();

            DisplayMSG('success', 'Update Users Success !!!', 'แก้ไขเรียบร้อย !!!..', 'true');


        }

        if (isset($_GET['updateweb'])) {
            if (empty($_POST['img']) || empty($_POST['name']) || empty($_POST['version']) || empty($_POST['wallet']) || empty($_POST['fb']) || empty($_POST['dc']) || empty($_POST['yt'])) {
                DisplayMSG('error', 'Error', 'กรุณากรอกกรอกข้อมูลให้ครบ.', 'false');
            }
            $img = $connect->real_escape_string($_POST['img']);
            $name = $connect->real_escape_string($_POST['name']);
            $version = $connect->real_escape_string($_POST['version']);
            $wallet = $connect->real_escape_string($_POST['wallet']);
            $fb = $connect->real_escape_string($_POST['fb']);
            $dc = $connect->real_escape_string($_POST['dc']);
            $yt = $connect->real_escape_string($_POST['yt']);
            $point_spin = $connect->real_escape_string($_POST['point_spin']);
            $point_roller = $connect->real_escape_string($_POST['point_roller']);
            $point_slot = $connect->real_escape_string($_POST['point_slot']);
            $colorweb = $connect->real_escape_string($_POST['colorweb']);
            $colormenu = $connect->real_escape_string($_POST['colormenu']);
            $web_title = $connect->real_escape_string($_POST['web_title']);

            $stmt = $connect->prepare("UPDATE `tbl_setting` SET `web_img` = ?, `web_name` = ?, `web_version` = ?, `web_wallet` = ?, `web_discord` = ?, `web_youtube` = ?, `web_fb` = ?, `point_spin` = ?, `point_roller` = ?, `point_slot` = ?, `web_color` = ?, `menu_color` = ?, `web_title` = ? WHERE `id` = 1");
            $stmt->bind_param('sssssssssssss', $img, $name, $version, $wallet, $dc, $yt, $fb, $point_spin, $point_roller, $point_slot, $colorweb, $colormenu, $web_title);
            $stmt->execute();

            DisplayMSG('success', 'Update Website Success !!!', 'แก้ไขเรียบร้อย !!!..', 'true');


        }


        if (isset($_GET['add_rewards'])) {

            if (empty($_POST['name'])) {
                DisplayMSG('error', 'Error', 'กรุณากรอกชื่อของรางวัล.', 'false');
            }
            if (empty($_POST['typegame'])) {
                DisplayMSG('error', 'Error', 'กรุณาเลือกเกม.', 'false');
            }
            if (empty($_POST['typereward'])) {
                DisplayMSG('error', 'Error', 'กรุณาประเภทรางวัล.', 'false');
            }
            if (empty($_POST['colorrewards'])) {
                DisplayMSG('error', 'Error', 'กรุณาใส่สีพื้นหลัง.', 'false');
            }

            $name = $connect->real_escape_string($_POST['name']);
            $typegame = $connect->real_escape_string($_POST['typegame']);
            $typereward = $connect->real_escape_string($_POST['typereward']);
            $valuerewards = $connect->real_escape_string($_POST['valuerewards']);
            $colorrewards = $connect->real_escape_string($_POST['colorrewards']);
            $percent = $connect->real_escape_string($_POST['percent']);

            $res_value = str_replace("-", "|", $valuerewards);

            if ($typereward == 2) {
                if (strpos($res_value, '|') === false) {
                    DisplayMSG('error', 'ผลรางวัลไม่ถูกต้อง', 'ตัวอย่างที่ถูกต้อง 1-10', 'false');
                }
            }

            $image_name = $_FILES['file']['name'];
            $imagepath = "assets/img/rewards_icon/" . $image_name;
            move_uploaded_file($_FILES["file"]["tmp_name"], $imagepath);


            // $query = $connect->query("INSERT INTO `tbl_game` (`id`, `name`, `img`, `platform`, `status`) 
            // VALUES (NULL, '".$_POST['name']."', '".$image_name."', '".$_POST['platform']."', '1');");
            $stmt = $connect->prepare("INSERT INTO `tbl_item_rewards` (`type`, `game`, `name`, `value`, `img`, `percent`, `color`, `status`) VALUES (?, ?, ?, ?, ?, ?, ?, '1')");
            $stmt->bind_param('sssssss', $typereward, $typegame, $name, $res_value, $imagepath, $percent, $colorrewards);
            $stmt->execute();

            DisplayMSG('success', 'Add Rewards Success !!!', 'เพิ่มเรียบร้อย !!!..', 'true');

        }


        if (isset($_GET['update_rewards'])) {

            if (empty($_POST['name'])) {
                DisplayMSG('error', 'Error', 'กรุณากรอกชื่อของรางวัล.', 'false');
            }
            if (empty($_POST['typegame'])) {
                DisplayMSG('error', 'Error', 'กรุณาเลือกเกม.', 'false');
            }
            if (empty($_POST['typereward'])) {
                DisplayMSG('error', 'Error', 'กรุณาประเภทรางวัล.', 'false');
            }
            if (empty($_POST['colorrewards'])) {
                DisplayMSG('error', 'Error', 'กรุณาใส่สีพื้นหลัง.', 'false');
            }

            $idre = $connect->real_escape_string($_POST['idre']);
            $name = $connect->real_escape_string($_POST['name']);
            $typegame = $connect->real_escape_string($_POST['typegame']);
            $typereward = $connect->real_escape_string($_POST['typereward']);
            $valuerewards = $connect->real_escape_string($_POST['valuerewards']);
            $colorrewards = $connect->real_escape_string($_POST['colorrewards']);
            $percent = $connect->real_escape_string($_POST['percent']);

            $res_value = str_replace("-", "|", $valuerewards);

            if ($typereward == 2) {
                if (strpos($res_value, '|') === false) {
                    DisplayMSG('error', 'ผลรางวัลไม่ถูกต้อง', 'ตัวอย่างที่ถูกต้อง 1-10', 'false');
                }
            }

            $image_name = $_FILES['file']['name'];


            if (empty($image_name)) {
                $stmt_old = $connect->prepare("SELECT * FROM tbl_item_rewards WHERE id = ?");
                $stmt_old->bind_param('s', $idre);
                $stmt_old->execute();
                $result_reward_old = $stmt_old->get_result()->fetch_assoc();
                $imagepath = $result_reward_old['img'];

            } else {

                unlink('assets/img/rewards_icon/' . $result_reward_old['img']);

                $imagepath = "assets/img/rewards_icon/" . $image_name;
                move_uploaded_file($_FILES["file"]["tmp_name"], $imagepath);

            }

            $stmt = $connect->prepare("UPDATE `tbl_item_rewards` SET `type` = ?, `game` = ?, `name` = ?, `value` = ?, `img` = ?, `percent` = ?, `color` = ? WHERE id = ?");
            $stmt->bind_param('ssssssss', $typereward, $typegame, $name, $res_value, $imagepath, $percent, $colorrewards, $idre);
            $stmt->execute();

            // $query = $connect->query("INSERT INTO `tbl_item_rewards` (`id`, `type`, `game`, `name`, `value`, `img`, `percent`, `color`, `status`) 
            // VALUES (NULL, '".$typereward."', '".$typegame."', '".$name."', '".$res_value."', '".$imagepath."', '".$percent."', '".$colorrewards."', '1');");

            DisplayMSG('success', 'Edit Rewards Success !!!', 'แก้ไขเรียบร้อย !!!..', 'true');

        }

        if (isset($_GET['delete_rewards'])) {
            if (empty($_GET['id'])) {
                DisplayMSG('error', 'Error', 'ไม่พบ rewards.', 'false');
            }
            $id = $connect->real_escape_string($_GET['id']);

            //check gif code
            $stmt_chk = $connect->prepare("SELECT * FROM tbl_code_rewards WHERE reward_id = ?");
            $stmt_chk->bind_param('s', $id);
            $stmt_chk->execute();
            $res_gifcode_check = $stmt_chk->get_result()->num_rows;
            if ($res_gifcode_check != 0) {
                DisplayMSG('error', 'ติด Gif Code', 'ยังมี Gif Code อยู่ไม่สามารถลบได้.', 'false');
            }
            //ดึงข้อมูล rewards 
            $stmt_cat = $connect->prepare("SELECT * FROM tbl_item_rewards WHERE id = ?");
            $stmt_cat->bind_param('s', $id);
            $stmt_cat->execute();
            $categorys = $stmt_cat->get_result()->fetch_assoc();
            unlink('assets/img/rewards_icon/' . $categorys['img']);

            $stmt = $connect->prepare("DELETE FROM tbl_item_rewards WHERE id = ?");
            $stmt->bind_param('s', $id);
            $stmt->execute();

            DisplayMSG('success', 'Delete rewards Success !!!', 'ลบเรียบร้อย !!!..', 'true');

        }

        if (isset($_GET['add_gifcode'])) {

            if (empty($_POST['iditem']) || empty($_POST['gifcode'])) {
                DisplayMSG('error', 'Error', 'กรุณากรอกข้อมูลให้ครบ.', 'false');
            }

            $iditem = $_POST['iditem'];
            $newcode = $_POST['gifcode'];

            foreach (explode("\n", $newcode) as $line) {
                // $query = $connect->query("INSERT INTO `tbl_stock_card` (`id`, `stock_id`, `type_card`, `code_card`, `time_card`, `status`) 
                // VALUES (NULL, '".$idstock."', '".$typegame."', '".$line."', '".time()."', '1');");
                $timeadd = time();
                $stmt = $connect->prepare("INSERT INTO `tbl_code_rewards` (`reward_id`, `code`, `timeadd`, `status`) VALUES (?, ?, ?, '1')");
                $stmt->bind_param('iss', $iditem, $line, $timeadd);
                $stmt->execute();
            }

            DisplayMSG('success', 'Add Gif Code Success !!!', 'เพิ่มเรียบร้อย !!!..', 'true');

        }

        if (isset($_GET['delete_gifcode'])) {
            if (empty($_GET['id'])) {
                DisplayMSG('error', 'Error', 'ไม่พบ gif code.', 'false');
            }
            $id = $connect->real_escape_string($_GET['id']);
            $stmt = $connect->prepare("DELETE FROM tbl_code_rewards WHERE id = ?");
            $stmt->bind_param('s', $id);
            $stmt->execute();

            DisplayMSG('success', 'Delete Success !!!', 'ลบเรียบร้อย !!!..', 'true');

        }

        if (isset($_GET['delete_gifcode_all'])) {
            if (empty($_GET['id'])) {
                DisplayMSG('error', 'Error', 'ไม่พบ gif code.', 'false');
            }
            $id = $connect->real_escape_string($_GET['id']);
            $stmt = $connect->prepare("DELETE FROM tbl_code_rewards WHERE reward_id = ?");
            $stmt->bind_param('s', $id);
            $stmt->execute();

            DisplayMSG('success', 'Delete Success !!!', 'ลบเรียบร้อย !!!..', 'true');

        }

        if (isset($_GET['delete_shop_id'])) {
            if (empty($_GET['id'])) {
                DisplayMSG('error', 'Error', 'ไม่พบสินค้า.', 'false');
            }
            $id = $connect->real_escape_string($_GET['id']);
            $stmt = $connect->prepare("DELETE FROM tbl_shop_id WHERE id = ?");
            $stmt->bind_param('s', $id);
            $stmt->execute();

            DisplayMSG('success', 'Delete Success !!!', 'ลบเรียบร้อย !!!..', 'true');

        }


        //user data
        if (isset($_GET['usersdata'])) {

            $table = 'tbl_users';
            $primaryKey = 'id';

            $columns = array(
                array('db' => 'id', 'dt' => 0),
                array('db' => 'username', 'dt' => 1),
                array(
                    'db' => 'point',
                    'dt' => 2,
                    'formatter' => function ($d, $row) {
                        return number_format($d, 2);
                    }
                ),
                // array( 'db' => 'status',   'dt' => 3 ),
                array(
                    'db' => 'status',
                    'dt' => 3,
                    'formatter' => function ($d, $row) {
                        if ($d == 0) {
                            return 'Ban';
                        } else if ($d == 1) {
                            return 'Member';
                        } else if ($d == 5) {
                            return 'Vip';
                        } else {
                            return 'Admin';
                        }

                    }
                ),
                array('db' => 'ip', 'dt' => 4),
                array('db' => 'id', 'dt' => 5),
                // array(
                //     'db'        => 'start_date',
                //     'dt'        => 4,
                //     'formatter' => function( $d, $row ) {
                //         return date( 'jS M y', strtotime($d));
                //     }
                // ),
                // array(
                //     'db'        => 'salary',
                //     'dt'        => 5,
                //     'formatter' => function( $d, $row ) {
                //         return '$'.number_format($d);
                //     }
                // )
            );

            // SQL server connection information
            $sql_details = array(
                'user' => $user,
                'pass' => $pass,
                'db' => $name,
                'host' => $host
                // ,'charset' => 'utf8' // Depending on your PHP and MySQL config, you may need this
            );
            require('ssp.class.php');

            echo json_encode(
                SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
            );
        }

        if (isset($_GET['add_account_stock'])) {

            if (empty($_POST['shopid']) || empty($_POST['account'])) {
                DisplayMSG('error', 'Error', 'กรุณากรอกข้อมูลให้ครบ.', 'false');
            }

            $shopid = $_POST['shopid'];
            $account = $_POST['account'];

            foreach (explode("\n", $account) as $line) {
                $cryptaccount = openssl_encrypt($line, $ciphering, $encryption_key, $options, $encryption_iv);
                $timeadd = time();
                $stmt = $connect->prepare("INSERT INTO `tbl_shop_stock` (`shopid`, `account`, `time`, `status`) VALUES (?, ?, ?, '1')");
                $stmt->bind_param('iss', $shopid, $cryptaccount, $timeadd);
                $stmt->execute();
            }

            DisplayMSG('success', 'Add account Success !!!', 'เพิ่มเรียบร้อย !!!..', 'true');

        }

        if (isset($_GET['delete_account_stock'])) {
            if (empty($_GET['id'])) {
                DisplayMSG('error', 'Error', 'ไม่พบ account.', 'false');
            }
            $id = $connect->real_escape_string($_GET['id']);
            $stmt = $connect->prepare("DELETE FROM tbl_shop_stock WHERE id = ?");
            $stmt->bind_param('s', $id);
            $stmt->execute();

            DisplayMSG('success', 'Delete Success !!!', 'ลบเรียบร้อย !!!..', 'true');

        }

        if (isset($_GET['delete_account_stock_all'])) {
            if (empty($_GET['id'])) {
                DisplayMSG('error', 'Error', 'ไม่พบ account.', 'false');
            }
            $id = $connect->real_escape_string($_GET['id']);
            $stmt = $connect->prepare("DELETE FROM tbl_shop_stock WHERE shopid = ?");
            $stmt->bind_param('s', $id);
            $stmt->execute();

            DisplayMSG('success', 'Delete Success !!!', 'ลบเรียบร้อย !!!..', 'true');

        }

        if (isset($_GET['shop_on_top'])) {
            if (empty($_GET['id'])) {
                DisplayMSG('error', 'Error', 'ไม่พบสินค้านี้.', 'false');
            }
            $id = $connect->real_escape_string($_GET['id']);

            $stmt_chk = $connect->prepare("SELECT * FROM tbl_shop_id WHERE id = ?");
            $stmt_chk->bind_param('s', $id);
            $stmt_chk->execute();
            $check_status = $stmt_chk->get_result()->fetch_assoc();


            if ($check_status['top'] == '0') {
                $stmt = $connect->prepare("UPDATE `tbl_shop_id` SET `top`='1' WHERE id = ?");
                $stmt->bind_param('s', $id);
                $stmt->execute();
                DisplayMSG('success', 'On Top !!!', 'ติดสินค้าแนะ !!!..', 'true');

            } else {
                $stmt = $connect->prepare("UPDATE `tbl_shop_id` SET `top`='0' WHERE id = ?");
                $stmt->bind_param('s', $id);
                $stmt->execute();
                DisplayMSG('success', 'Un Top !!!', 'ออกจากสินค้าแนะนำ !!!..', 'true');
            }
        }

        if (isset($_GET['shop_on_show'])) {
            if (empty($_GET['id'])) {
                DisplayMSG('error', 'Error', 'ไม่พบสินค้านี้.', 'false');
            }
            $id = $connect->real_escape_string($_GET['id']);

            $stmt_chk = $connect->prepare("SELECT * FROM tbl_shop_id WHERE id = ?");
            $stmt_chk->bind_param('s', $id);
            $stmt_chk->execute();
            $check_status = $stmt_chk->get_result()->fetch_assoc();


            if ($check_status['status'] == '1' || $check_status['status'] == '2') {
                $stmt = $connect->prepare("UPDATE `tbl_shop_id` SET `status`='0' WHERE id = ?");
                $stmt->bind_param('s', $id);
                $stmt->execute();
                DisplayMSG('success', 'On Top !!!', 'ซ่อนสินค้า !!!..', 'true');

            } else {
                if (empty($check_status['owner'])) {
                    $stmt = $connect->prepare("UPDATE `tbl_shop_id` SET `status`='1' WHERE id = ?");
                } else {
                    $stmt = $connect->prepare("UPDATE `tbl_shop_id` SET `status`='2' WHERE id = ?");
                }
                $stmt->bind_param('s', $id);
                $stmt->execute();

                DisplayMSG('success', 'Un Top !!!', 'แสดงสินค้า !!!..', 'true');
            }


        }

        //อัพเดตราคาพรีเมียม
        if (isset($_GET['editshoppre'])) {

            if (empty($_POST['item_id']) || empty($_POST['price'])) {
                DisplayMSG('error', 'Error', 'กรุณากรอกข้อมูลให้ครบ.', 'true');
            }

            $item_id = $connect->real_escape_string($_POST['item_id']);
            $price = $connect->real_escape_string($_POST['price']);
            // echo $item_id,'<br>';
            // echo $status;

            $stmt = $connect->prepare("UPDATE `tbl_shop_stock_api` SET `price_web` = ? WHERE `id` = ?");
            $stmt->bind_param('ds', $price, $item_id);
            $stmt->execute();


            DisplayMSG('success', 'Update Success !!!', 'อัพเดตเรียบร้อย !!!..', 'true');

        }


        if (isset($_GET['shop_premium'])) {
            if (empty($_GET['id'])) {
                DisplayMSG('error', 'Error', 'ไม่พบสินค้านี้.', 'false');
            }
            $id = $connect->real_escape_string($_GET['id']);

            $stmt_chk = $connect->prepare("SELECT * FROM tbl_shop_stock_api WHERE id = ?");
            $stmt_chk->bind_param('s', $id);
            $stmt_chk->execute();
            $check_status = $stmt_chk->get_result()->fetch_assoc();


            if ($check_status['showitem'] == '0') {
                $stmt = $connect->prepare("UPDATE `tbl_shop_stock_api` SET `showitem` ='1' WHERE id = ?");
                $stmt->bind_param('s', $id);
                $stmt->execute();
                DisplayMSG('success', 'Success', 'ติดสินค้าบนร้านเรียบร้อย', 'true');

            } else {
                $stmt = $connect->prepare("UPDATE `tbl_shop_stock_api` SET `showitem` ='0' WHERE id = ?");
                $stmt->bind_param('s', $id);
                $stmt->execute();
                DisplayMSG('success', 'Success', 'สินค้าออกจากร้านเรียบร้อย', 'true');
            }
        }


        if (isset($_GET['add_slide'])) {

            if (empty($_POST['height'])) {
                DisplayMSG('error', 'Error', 'กรุณากรอกเชื่อของรางวัล.', 'false');
            }


            $image_name = $_FILES['file']['name'];
            //$temp = explode(".", $image_name);
            //$newfilename = round(microtime(true)) . '.' . end($temp);
            $imagepath = "assets/img/slide/" . $image_name;
            // $imagepath ="assets/img/xslot/".$newfilename;
            move_uploaded_file($_FILES["file"]["tmp_name"], $imagepath);

            $stmt = $connect->prepare("INSERT INTO `tbl_slide` (`img`, `height`) VALUES (?, ?)");
            $stmt->bind_param('ss', $image_name, $_POST['height']);
            $stmt->execute();

            DisplayMSG('success', 'Add Category Success !!!', 'เพิ่มเรียบร้อย !!!..', 'true');

        }

        if (isset($_GET['edit_slide'])) {

            if (empty($_POST['typecategory'])) {
                DisplayMSG('error', 'Error', 'กรุณากรอกเลือกประเภทหมวดหมู่.', 'false');
            }

            $idshop = $_POST['idshop'];
            $stmt_old = $connect->prepare("SELECT * FROM `tbl_slide` WHERE id = ?");
            $stmt_old->bind_param('i', $idshop);
            $stmt_old->execute();
            $old_info = $stmt_old->get_result()->fetch_assoc();
            // echo $_FILES['file']['name'] ;
            if (empty($_FILES['file']['name'])) {
                $image_now = $old_info['img'];
            } else {
                unlink('assets/img/slide/' . $old_info['img']);
                $image_name = $_FILES['file']['name'];
                $imagepath = "assets/img/slide/" . $image_name;
                $image_now = $image_name;
                move_uploaded_file($_FILES["file"]["tmp_name"], $imagepath);
            }

            $stmt = $connect->prepare("UPDATE `tbl_slide` SET `img` = ?, `name` = ?, `platform` = ? WHERE id = ?");
            $stmt->bind_param('sssi', $image_now, $_POST['name'], $_POST['platform'], $idshop);
            $stmt->execute();

            DisplayMSG('success', 'Update Category Success !!!', 'แก้ไขเรียบร้อย !!!..', 'true');


        }

        if (isset($_GET['delete_slide'])) {
            if (empty($_GET['id'])) {
                DisplayMSG('error', 'Error', 'ไม่พบ category.', 'false');
            }


            //ดึงข้อมูล category 
            $stmt_cat = $connect->prepare("SELECT * FROM tbl_slide WHERE id = ?");
            $stmt_cat->bind_param('s', $_GET['id']);
            $stmt_cat->execute();
            $categorys = $stmt_cat->get_result()->fetch_assoc();
            unlink('assets/img/slide/' . $categorys['img']);

            $stmt_del = $connect->prepare("DELETE FROM tbl_slide WHERE id = ?");
            $stmt_del->bind_param('s', $_GET['id']);
            $stmt_del->execute();

            DisplayMSG('success', 'Delete Success !!!', 'ลบเรียบร้อย !!!..', 'true');

        }


        if (isset($_GET['shop_slide'])) {
            if (empty($_GET['id'])) {
                DisplayMSG('error', 'Error', 'ไม่พบสินค้านี้.', 'false');
            }
            $id = $connect->real_escape_string($_GET['id']);

            $stmt_chk = $connect->prepare("SELECT * FROM tbl_slide WHERE id = ?");
            $stmt_chk->bind_param('s', $id);
            $stmt_chk->execute();
            $check_status = $stmt_chk->get_result()->fetch_assoc();


            if ($check_status['id_img'] == '0') {
                $stmt = $connect->prepare("UPDATE `tbl_slide` SET `id_img` ='1' WHERE id = ?");
                $stmt->bind_param('s', $id);
                $stmt->execute();
                DisplayMSG('success', 'Success', 'ขึ้นภาพอันดับแรก', 'true');

            } else {
                $stmt = $connect->prepare("UPDATE `tbl_slide` SET `id_img` ='0' WHERE id = ?");
                $stmt->bind_param('s', $id);
                $stmt->execute();
                DisplayMSG('success', 'Success', 'ขึ้นภาพปก', 'true');
            }
        }







    }

}

?>