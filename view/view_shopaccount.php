<div class="col-md-12 col-sm-12 mt-4" data-aos="zoom-in-down">
    <ol class="breadcrumb mt-3 crad_tung text-white">
        <li class="breadcrumb-item text-white hvr-shrink pointer" onclick="CradURL('./page/home')">หน้าแรก</li>
        <li class="breadcrumb-item text-white active">รายการสินค้า</li>
    </ol>
</div>

<div class="col-md-12 col-sm-12 col-12 mt-4 mb-4">
    <div class="card-header text-white"><i class="fa-solid fa-box-open"></i> Category - หมวดหมู่บัญชี</div>
</div>
<?php
$result_category = $connect->query("SELECT * FROM tbl_game WHERE typegame = 'account';");
$res_categorys = $result_category->fetch_all(MYSQLI_ASSOC);
$i = 1;
foreach ($res_categorys as $res_category) :
?>

    <div class="col-md-3 col-sm-12 col-12 mb-4 hvr-float pointer" onclick="CradURL('./category_account/<?= $res_category['id'] ?>')">
        <div class="card crad_tung card_new text-white" data-aos="fade-up">
            <div class="row p-2">
                <div class="col-6 text-center">
                    <img src="assets/img/game_icon/<?= $res_category['img'] ?>" alt="<?= $res_category['img'] ?>" width="70%" class="mb-3">
                </div>
                <div class="col-6 mt-3">
                    <h4><?= $res_category['name'] ?></h4>
                    <small><?= $res_category['platform'] ?></small>
                </div>
            </div>
        </div>
    </div>

<?php endforeach; ?>


<div class="col-md-12 col-sm-12 col-12 mt-4 mb-4">
    <div class="card-header text-white"><i class="fa-solid fa-cart-shopping"></i> Shop - รายการสินค้า</div>
</div>

<?php
if (isset($_GET['category'])) {
    $idcategory = $connect->real_escape_string(@$_GET['category']);
    $result = $connect->query("SELECT * FROM tbl_shop_id WHERE gameid = '" . $idcategory . "' AND status != '0' AND shoptype = 'account'  ORDER BY status ASC");
} else {
    $result = $connect->query("SELECT * FROM tbl_shop_id WHERE status != '0' AND shoptype = 'account' ORDER BY status ASC");
}

if ($result->num_rows == 0) {
    echo '<div class="col-md-12 col-sm-12 mt-2" data-aos="zoom-in-down">
            <div class="alert alert-dismissible alert-danger">
                <strong>ยังไม่มีสินค้าตอนนี้!</strong> <a href="page/account" class="alert-link">ร้านค้า</a>.
            </div>
        </div>';
} else {

    $shop_fetchs = $result->fetch_all(MYSQLI_ASSOC);
    foreach ($shop_fetchs as $shop_fetch) :
        $img_shop = explode(',', $shop_fetch['img']);
?>

        <div class="col-md-3 col-sm-12 col-12 px-2 d-flex align-items-stretch hvr-float pointer" onclick="CradURL('./shop/<?= $shop_fetch['id'] ?>')">
            <div class="card crad_tung mb-3 card_new" data-aos="fade-up">
                <img src="<?= $img_shop[0] ?>" alt="shop" class="mb-3">
                <div class="card-body d-flex flex-column text-white">
                    <h4><?= $shop_fetch['name'] ?></h4>
                    <small><i class="fa-brands fa-creative-commons-share"></i> รหัสสินค้า A00<?= $shop_fetch['id'] ?></small>
                    <small><i class="fa-regular fa-circle-user"></i> โพสต์โดย <?= $shop_fetch['username'] ?></small>
                    <small><i class="fa-regular fa-clock"></i> เมื่อเวลา <?= th($shop_fetch['timeadd']) ?></small>
                    <?php //add get gif code
                    $account_info_shop = $connect->query("SELECT * FROM `tbl_shop_stock` WHERE `shopid` = '" . $shop_fetch['id'] . "' ORDER BY id ASC");
                    $num_account_info_shop = $account_info_shop->num_rows;
                    ?>
                    <small><i class="fa-solid fa-file-csv"></i> สินต้าคงเหลือ <b><?= $num_account_info_shop ?> </b>บัญชี</small>
                </div>
                <div class="p-2">
                    <?php if (@$users_status == $vip_status) : ?>
                        <h6 class="text-white">$ราคา <?= number_format($shop_fetch['pointv'], 2) ?> เครดิค</h6>
                    <?php else : ?>
                        <h6 class="text-white">$ราคา <?= number_format($shop_fetch['point'], 2) ?> เครดิค</h6>
                    <?php endif; ?>

                    <button class="btn btn-outline-primary w-100 mb-2">ข้อมูลเพิ่มเติม</button>

                </div>

            </div>
        </div>

    <?php endforeach; ?>

<?php } ?>

<?php include 'view/view_shophot.php'; ?>