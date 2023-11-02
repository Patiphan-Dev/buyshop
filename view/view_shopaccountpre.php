<div class="col-md-12 col-sm-12 col-12 mt-4 mb-4">
  <div class="card-header text-white"><i class="fa-solid fa-cart-shopping"></i> Shop - รายการสินค้าบัญชีพรีเมี่ยม</div>
</div>

<?php
$result_load_packz = $connect->query("SELECT * FROM tbl_shop_stock_api");
if ($result_load_packz->num_rows == 0) : ?>
  <div class="col-md-12 col-sm-12 mt-2" data-aos="zoom-in-down">
    <div class="alert alert-dismissible alert-danger">
      <strong>เชื่อมต่อเซิฟเวอร์ไม่สำเร็จ! </strong> <a href="page/pshop" class="alert-link">ลองอีกครั้ง</a>.
    </div>
  </div>
<?php else : ?>


  <?php

  $load_packz = $result_load_packz->fetch_all(MYSQLI_ASSOC);
  $i = 1;
  foreach ($load_packz as $shop_fetch) : ?>

    <div class="col-md-3 col-sm-12 col-12 px-2 d-flex align-items-stretch hvr-float pointer">
      <div class="card crad_tung mb-3 card_new w-100" data-aos="fade-up">
        <center><img src="<?= $shop_fetch['img'] ?>" class="p-4" style="width:11.1rem;"></center>
        <div class="card-body d-flex flex-column text-white">

          <h5><?= $shop_fetch['name'] ?></h5>
          <small><i class="fa-brands fa-creative-commons-share"></i> ประเภทสินค้า <?= $shop_fetch['id'] ?></small>
          <small>
            <i class="fa-regular fa-circle-user"></i> คงเหลือ
            <?php
            if ($shop_fetch['stock'] > 5) : ?>
              <span style="color: green;"><?= $shop_fetch['stock'] ?></span>
            <?php elseif ($shop_fetch['stock'] > 0) : ?>
              <span style="color: yellow;"><?= $shop_fetch['stock'] ?></span>
            <?php else : ?>
              <span style="color: red;"><?= $shop_fetch['stock'] ?></span>
            <?php endif ?>
            ชิ้น
          </small>

          <?php if ($shop_fetch['status'] == 'พร้อมส่ง') : ?>
                <small><i class="fa-regular fa-clock"></i> สถานะ <span style="color: green;"><?= $shop_fetch['status'] ?></span> </small>
              <?php else : ?>
                <small><i class="fa-regular fa-clock"></i> สถานะ <span style="color: red;"><?= $shop_fetch['status'] ?></span> </small>
              <?php endif ?>


        </div>
        <div class="p-2">
          <?php if (@$users_status == $vip_status) : ?>
            <h6 class="text-white">$ราคา <?= number_format($shop_fetch['price_web'], 2) ?> เครดิค</h6>
          <?php else : ?>
            <h6 class="text-white">$ราคา <?= number_format($shop_fetch['price_web'], 2) ?> เครดิค</h6>
          <?php endif; ?>

          <button class="btn btn-outline-primary w-100 mb-2" data-bs-toggle="modal" data-bs-target="#ShopModal<?= $shop_fetch['id'] ?>">ข้อมูลเพิ่มเติม</button>
          <?php if (isset($_SESSION['username'])) : ?>
            <?php if ($shop_fetch['stock'] > 0) : ?>
              <button class="btn btn-primary w-100 mb-2" onclick="buypremium(<?= $shop_fetch['id'] ?>)">สั่งซื้อ (<?= number_format($shop_fetch['price_web'], 2) ?> เครดิค)</button>
            <?php else : ?>
              <button class="btn btn-danger w-100 mb-2">สินค้าหมด (<?= number_format($shop_fetch['price_web'], 2) ?> เครดิค)</button>
            <?php endif ?>

          <?php else : ?>
            <button class="btn btn-primary w-100 mb-2" disabled onclick="buypremium(<?= $shop_fetch['id'] ?>)">เข้าสู่ระบบเพื่อนสั่งซื้อ (<?= number_format($shop_fetch['price_web'], 2) ?> เครดิค)</button>
          <?php endif ?>
        </div>
      </div>
    </div>

  <?php endforeach; ?>


  <?php foreach ($load_packz as $shop_fetch) : ?>
    <!-- Modal -->
    <div class="modal fade" id="ShopModal<?= $shop_fetch['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel"><?= $shop_fetch['name'] ?></h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="text-center">
              <center><img src="<?= $shop_fetch['img'] ?>" class="p-4" style="width:11.1rem;"></center>
              <h5><?= $shop_fetch['name'] ?></h5>
              <small><i class="fa-brands fa-creative-commons-share"></i> ประเภทสินค้า <?= $shop_fetch['id'] ?> </small>

              <small><i class="fa-regular fa-circle-user"></i> คงเหลือ
                <?php
                if ($shop_fetch['stock'] > 5) : ?>
                  <span style="color: green;"><?= $shop_fetch['stock'] ?></span>
                <?php elseif ($shop_fetch['stock'] > 0) : ?>
                  <span style="color: yellow;"><?= $shop_fetch['stock'] ?></span>
                <?php else : ?>
                  <span style="color: red;"><?= $shop_fetch['stock'] ?></span>
                <?php endif ?>
                ชิ้น </small>
              <?php if ($shop_fetch['status'] == 'พร้อมส่ง') : ?>
                <small><i class="fa-regular fa-clock"></i> สถานะ <span style="color: green;"><?= $shop_fetch['status'] ?></span> </small>
              <?php else : ?>
                <small><i class="fa-regular fa-clock"></i> สถานะ <span style="color: red;"><?= $shop_fetch['status'] ?></span> </small>
              <?php endif ?>
            </div>

          </div>
          <div class="modal-footer">
            <?php if (isset($_SESSION['username'])) : ?>
              <?php if ($shop_fetch['stock'] > 0) : ?>
                <button class="btn btn-primary w-40 mb-2" onclick="buypremium(<?= $shop_fetch['id'] ?>)">สั่งซื้อ (<?= number_format($shop_fetch['price_web'], 2) ?> เครดิค)</button>
              <?php else : ?>
                <button class="btn btn-danger w-40 mb-2">สินค้าหมด</button>
              <?php endif ?>
            <?php else : ?>
              <button class="btn btn-primary w-40 mb-2" disabled onclick="buypremium(<?= $shop_fetch['id'] ?>)">เข้าสู่ระบบเพื่อนสั่งซื้อ (<?= number_format($shop_fetch['price_web'], 2) ?> เครดิค)</button>
            <?php endif ?>
            <button type="button" class="btn btn-danger w-40" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>

  <!-- <button class="btn btn-primary w-100 mb-2" onclick="buypremium(100)"> Test สั่งซื้อ ( เครดิค)</button> -->



<?php endif; ?>