
<?php
if (!preg_match('/^[a-zA-Z0-9\_]*$/', @$_GET['id'])) {
    $id = 1;
}else{
    $id = $connect->real_escape_string(@$_GET['id']);
}
$result_shopa = $connect->query("SELECT * FROM tbl_shop_id WHERE id = '".$id."'")->fetch_assoc();
$num_shopa = $connect->query("SELECT * FROM tbl_shop_id WHERE id = '".$id."'")->num_rows;
$result_game = $connect->query("SELECT * FROM tbl_game WHERE id = '".$result_shopa['gameid']."'")->fetch_assoc();

$result_history = $connect->query("SELECT * FROM `tbl_shop_history` WHERE gameid = '".$id."'")->fetch_assoc();

//ดึงข้อมูลผู้ขาย
$user_seller = $connect->query('SELECT * FROM `tbl_users` WHERE `username` = "'.@$result_shopa['username'].'" ')->fetch_assoc();
//ดึงข้อมูลผู้ซื้อ
$user_buller = $connect->query('SELECT * FROM `tbl_users` WHERE `username` = "'.@$result_shopa['owner'].'" ')->fetch_assoc();
//เช๋ค ราคา vip
if(@$users_status == $vip_status){
    $point_shopthis = $result_shopa['pointv'];
}else{
    $point_shopthis = $result_shopa['point'];
}
?>

<div class="col-md-12 col-sm-12 mt-4" data-aos="zoom-in-down">
    <ol class="breadcrumb mt-3 crad_tung text-white">
        <li class="breadcrumb-item text-white hvr-shrink pointer" onclick="CradURL('./page/home')">หน้าแรก</li>
        <?php if(@$result_shopa['shoptype'] == 'account'):?>
        <li class="breadcrumb-item text-white hvr-shrink pointer" onclick="CradURL('./page/account')">ร้านค้า</li>
        <?php else:?>
        <li class="breadcrumb-item text-white hvr-shrink pointer" onclick="CradURL('./page/shop')">ร้านค้า</li>
        <?php endif; ?>
        <li class="breadcrumb-item text-white active">รายละเอียดสินค้า</li>
    </ol>
</div>


<?php if($num_shopa == 0 ): ?>
    <div class="col-md-12 col-sm-12 mt-4" data-aos="zoom-in-down">
        <div class="alert alert-dismissible alert-danger">
            <strong>Oh snap!</strong> <a href="page/account" class="alert-link">Change a few things up</a> and try submitting again.
        </div>
    </div>
<?php else: ?>


<div class="col-md-12 col-sm-12 mt-4" data-aos="zoom-in">
    <div class="card crad_tung mb-3 text-white">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 col-sm-12 mt-4">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 mt-4">
                            <?php
                            $result_shop = explode(',', $result_shopa['img']);
                                if(!empty($result_shop[0])):
                            ?>
                            <img src="<?=$result_shop[0]?>" alt="<?=$result_shop[0]?>" width="100%" id="mainimg" class="hvr-float pointer" data-bs-target="#imgshow" data-bs-toggle="modal">
                            <?php endif; ?>
                            <p></p>
                        </div>

                        <div class="col-md-12 col-sm-12 col-12">
                            <div class="text-center">
                                <div class="owl-carousel owl-theme">
                                    <?php foreach($result_shop as $i =>$result_shops):
                                        if(!empty($result_shops)): ?>
                                    <div class="item p-2">
                                        <img src="<?=$result_shops?>" alt="server" class="hvr-float pointer" onclick="changeimage('<?=$result_shops?>')">
                                    </div>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 mt-4 d-flex align-items-stretch">
                    <div class="d-flex flex-column">
                        <h4><img src="assets/img/game_icon/<?=$result_game['img'] ?>" width="10%"> หมวดหมู่ <?=$result_game['name'] ?></h4>
                        <h5><i class="fa-solid fa-caret-right"></i> <?=$result_shopa['name'] ?></h5>
                        <small>รหัสสินค้า A00<?=$result_shopa['id'] ?></small>
                        <?php if($result_shopa['shoptype'] == 'account'): ?>
                            <?php //add get gif code
                            $account_info_shop = $connect->query("SELECT * FROM `tbl_shop_stock` WHERE `shopid` = '".$result_shopa['id']."' ORDER BY id ASC"); 
                            $num_account_info_shop = $account_info_shop->num_rows;
                            ?>
                        <div class="">
                            <span><i class="fa-solid fa-folder-open"></i> สินค้าคงเหลือ : </span><span class="badge rounded-pill bg-light" style="font-size: 0.9rem;"> <?=$num_account_info_shop ?> บัญชี</span>
                        </div>
                        <?php endif; ?>
                        <hr>
                        
                        <div class="mb-2">
                            <span><i class="fa-solid fa-computer"></i> Platform : </span><span class="badge rounded-pill bg-info" style="font-size: 0.9rem;"> <?=$result_game['platform'] ?></span>
                        </div>
                        <div class="mb-2 pmsg">
                            <!-- //htmlspecialchars_decode($result_shopa['publish_info']) -->
                        </div>
                        <div class="mb-2">
                            <?php if(empty($result_shopa['owner'])): ?>
                            <span><i class="fa-solid fa-circle-check"></i> สถานะ : </span><span class="badge rounded-pill bg-success" style="font-size: 0.9rem;"> พร้อมจำหน่าย</span>
                            <?php else: ?>
                            <span><i class="fa-solid fa-circle-xmark"></i> สถานะ : </span><span class="badge rounded-pill bg-danger" style="font-size: 0.9rem;"> จำหน่ายแล้ว</span>
                            <?php endif; ?>
                        </div>
                        <div class="mb-4">
                            <span><i class="fa-solid fa-sack-dollar"></i> ราคา : </span><span class="badge rounded-pill bg-success" style="font-size: 0.9rem;"> <?=number_format($point_shopthis, 2)?> เครดิต</span>
                        </div>
                        <?php if(isset($_SESSION['username']) && @$result_shopa['owner'] == @$users_username): ?>
                            <div class="alert alert-dismissible alert-success">
                                <h5><i class="fa-solid fa-envelope"></i> ข้อมูลลับแสดงเฉพาะผู้ซื้อ</h5> 
                                <?php $infosecret = openssl_decrypt($result_shopa['secret_info'], $ciphering, $decryption_key, $options, $decryption_iv);?>
                                <span><?= $infosecret ?></span> <br>
                                <span><a href="page/inventory" class="alert-link"> เพิ่มเติม</a></span>
                            </div>
                        <?php endif; ?> 
                        <?php if(!empty($result_shopa['owner'])): ?>
                            <div class="alert alert-dismissible alert-danger" style="padding:0.4rem;">
                                <table>
                                    <tr>
                                        <td rowspan="2" style="width:24%">
                                        <img src="<?=$user_buller['img']?>" alt="<?=$user_buller['img']?>" onerror="this.onerror=null; this.src='assets/img/web_logo.png'" 
                                        style="border-color: #7a8288;border-style: solid;border-width: 3px;height: 3.4rem;width: 3.4rem;border-radius: 50%;">
                                        </td>
                                        <td>สั่งซื้อโดย <?=$result_shopa['owner']?></td>
                                    </tr>
                                    <tr>
                                        <td>เมื่อเวลา <?=th($result_history['timeadd'])?></td>
                                    </tr>
                                </table>
                            </div>
                        <?php endif; ?> 

                        <div class="mt-auto">
                        <div class="alert alert-dismissible alert-info" style="padding:0.4rem;">
                            <table>
                                <tr>
                                    <td rowspan="2" style="width:24%">
                                    <img src="<?=$user_seller['img']?>" alt="<?=$user_seller['img']?>" onerror="this.onerror=null; this.src='assets/img/web_logo.png'" 
                                    style="border-color: #7a8288;border-style: solid;border-width: 3px;height: 3.4rem;width: 3.4rem;border-radius: 50%;">
                                    </td>
                                    <td>โพสต์โดย <?=$result_shopa['username']?></td>
                                </tr>
                                <tr>
                                    <td>เมื่อเวลา <?=th($result_shopa['timeadd'])?></td>
                                </tr>
                            </table>
                        </div>
                        
                        <?php if(empty($result_shopa['owner'])): ?>
                        <hr>
                        <?php if(isset($_SESSION['username'])): ?>
                            <?php if($result_shopa['shoptype'] == 'account'): ?>
                                <?php if($num_account_info_shop == 0): ?>
                                <button class="btn btn-danger w-100 w-100 mb-2 disabled" onclick="buyaccount(<?=$result_shopa['id']?>)">
                                    <i class="fa-solid fa-circle-check"></i> สินค้าหมดชั่วคราว
                                </button>
                                <?php else: ?>
                                    <button class="btn btn-primary w-100 w-100 mb-2" onclick="buyaccount(<?=$result_shopa['id']?>)">
                                    <i class="fa-solid fa-circle-check"></i> But Now - ซื้อเลย (<?=number_format($point_shopthis,2)?> เครดิต)
                                </button>
                                <?php endif; ?>
                            <?php else: ?>
                            <a onclick="buyshopadd(<?=$result_shopa['id']?>)" class="btn btn-info w-100">
                                <i class="fa-solid fa-circle-check"></i> But Now - ซื้อเลย (<?=number_format($point_shopthis,2)?> เครดิต)
                            </a>
                            <?php endif; ?>
                            
                        <?php else: ?>   
                            <a href="?page=login" class="btn btn-info w-100">
                                <i class="fa-solid fa-circle-check"></i> เข้าสู่ระบบเพื่อสั่งซื้อ (<?=number_format($point_shopthis,2)?> เครดิต)
                            </a>               
                        <?php endif; ?>                  
                        <?php endif; ?>                  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12 col-sm-12 mt-2">
    <div class="card crad_tung mb-3 text-white " data-aos="fade-up">
    <div class="card-header"><i class="fa-solid fa-circle-info" style="color:#337AFF;"></i>  รายละเอียด</div>
        <div class="card-body">

            <?=htmlspecialchars_decode($result_shopa['publish_info'])?>

        </div>
    </div>
</div>


<div class="modal fade" id="imgshow" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php foreach($result_shop as $i =>$result_shops): ?>
                            <div class="carousel-item active">
                                <img src="<?=$result_shops?>" alt="<?=$result_shops?>" width="100%">
                            </div>
                        <?php endforeach; ?>
                        
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

           
        </div>
    </div>
</div>

<?php include 'view/view_shophot.php'; ?>

<script>
    function changeimage(url) {
        // var a = document.getElementById('mainimg').value;
        // var c = a + ".gif";

        document.getElementById('mainimg').src = url;
    }
</script>

<?php endif; ?>

