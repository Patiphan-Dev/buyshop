<div class="col-md-12 col-sm-12 col-12 mt-4 mb-4">
    <div class="card-header text-white"><i class="fa-solid fa-cart-shopping"></i> Shop Hot - รายการสินค้าที่เข้าดูเยอะ</div>
</div>

<div class="col-md-12 col-sm-12 col-12" data-aos="fade-up">
    <div class="">
        <div class="owl-carousel owl-theme">
            <?php
            $resultss = $connect->query("SELECT * FROM tbl_shop_id WHERE top = '1' ORDER BY id DESC");
            $shop_fetchss = $resultss->fetch_all(MYSQLI_ASSOC);

            foreach ($shop_fetchss as $sshop_fetch) :
                $img_shops = explode(',', $sshop_fetch['img']); ?>
                <div class="item p-2">
                    <div class="card crad_tung align-items-stretch hvr-float pointer aticle-box" onclick="CradURL('./shop/<?= $sshop_fetch['id'] ?>')">
                        <img src="<?= $img_shops[0] ?>" alt="hot" class="center-menu-shop mb-3">
                        <div class="card-body d-flex flex-column text-white">
                            <h5><?= $sshop_fetch['name'] ?></h5>
                            <small><i class="fa-regular fa-circle-user"></i> โพสต์โดย <?= $sshop_fetch['username'] ?></small>
                            <small><i class="fa-regular fa-clock"></i> เมื่อเวลา <?= th($sshop_fetch['timeadd']) ?></small>
                            <br>
                            <?php if (@$users_status == $vip_status) : ?>
                                <h6 class="card-title mt-auto align-self-start">$<?= number_format($sshop_fetch['pointv'], 2) ?> เครดิค</h6>
                            <?php else : ?>
                                <h6 class="card-title mt-auto align-self-start">$<?= number_format($sshop_fetch['point'], 2) ?> เครดิค</h6>
                            <?php endif; ?>

                        </div>

                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</div>