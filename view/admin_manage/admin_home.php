<div class="col-md-12 col-sm-12 mt-4">
  <ol class="breadcrumb mt-3 crad_tung text-white">
    <li class="breadcrumb-item text-white hvr-shrink pointer" onclick="CradURL('?page=home')">หน้าแรก</li>
    <li class="breadcrumb-item text-white active">จัดการหลังบ้าน</li>
  </ol>
</div>

<div class="col-md-12 col-sm-12 mt-2">

  <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="?page=manage"><i class="fa-solid fa-screwdriver-wrench"></i> Manage - จัดการข้อมูล</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor03" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarColor03">
        <ul class="navbar-nav me-auto">

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">จัดการสินค้า</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="?page=manage&admin=category">เพิ่มหมวดหมู่</a>
              <a class="dropdown-item" href="?page=manage&admin=manageshop">จัดการสินค้า</a>
              <a class="dropdown-item" href="?page=manage&admin=shop">เพิ่มสินค้า</a>
              <a class="dropdown-item" href="?page=manage&admin=history">ประวัติการซือ</a>
            </div>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">ร้านพรีเมี่ยม</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="?page=manage&admin=shoppremium">จัดการสินค้า</a>
              <a class="dropdown-item" href="?page=manage&admin=history_pre">ประวัติการสั่งซื้อ</a>
            </div>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">ข้อมูลต่าง</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="?page=manage&admin=website">ข้อมูลเว็บ</a>
              <a class="dropdown-item" href="?page=manage&admin=users">ข้อมูลผู้ใช้</a>
              <a class="dropdown-item" href="?page=manage&admin=img_slide">แก้ไขรูปสไลด์</a>
            </div>
          </li>


          <li class="nav-item">
            <a class="nav-link hvr-icon-up" href="?page=manage&admin=game"><i class="hvr-icon fa-solid fa-dice"></i> ระบบเกมสุ่ม</a>
          </li>
          <!-- <li class="nav-item">
          <a class="nav-link hvr-icon-up" href="?page=manage&admin=website"><i class="hvr-icon fa-solid fa-pen-to-square"></i> ข้อมูลเว็บ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link hvr-icon-up" href="?page=manage&admin=users"><i class="hvr-icon fa-solid fa-user-gear"></i> ข้อมูลผู้ใช้</a>
        </li> -->
          <!-- <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Separated link</a>
          </div>
        </li> -->
        </ul>

      </div>
    </div>
  </nav>

</div>
<!-- <div class="col-md-12 col-sm-12 mt-2">
    <div class="card crad_tung text-white mb-3">
        <div class="card-header"><i class="fa-solid fa-caret-right" style="color:#F186A9;"></i> Manage - จัดการหลังบ้าน</div>
        <div class="card-body">

        <a href="?page=manage&admin=category" class="hvr-icon-up btn btn-info col-sm-2 col-12 mb-2"><i class="hvr-icon fa-solid fa-gamepad"></i> เพิ่มหมวดเกม</a>
        <a href="?page=manage&admin=manageshop" class="hvr-icon-up btn btn-outline-warning col-sm-2 col-12 mb-2"><i class="hvr-icon fa-solid fa-shop"></i> จัดการสินค้า</a>
        <a href="?page=manage&admin=shop" class="hvr-icon-up btn btn-success col-sm-2 col-12 mb-2"><i class="hvr-icon fa-solid fa-cart-plus"></i> เพิ่มสินค้า</a>
        <a href="?page=manage&admin=game" class="hvr-icon-up btn btn-primary col-sm-2 col-12 mb-2"><i class="hvr-icon fa-solid fa-dice"></i> ระบบเกมสุ่ม</a>
        <a href="?page=manage&admin=website" class="hvr-icon-up btn btn-danger col-sm-2 col-12 mb-2"><i class="hvr-icon fa-solid fa-pen-to-square"></i> ข้อมูลเว็บ</a>
        <a href="?page=manage&admin=users" class="hvr-icon-up btn btn-info col-sm-2 col-12 mb-2"><i class="hvr-icon fa-solid fa-user-gear"></i> ข้อมูลผู้ใช้</a>

        </div>
    </div>
</div> -->


<?php
if (@$_GET['admin'] == "category") {
  include 'view/admin_manage/admin_category.php';
} else if (@$_GET['admin'] == "category_edit") {
  include 'view/admin_manage/admin_category_edit.php';
} else if (@$_GET['admin'] == "users") {
  include 'view/admin_manage/admin_users.php';
} else if (@$_GET['admin'] == "shop") {
  include 'view/admin_manage/admin_shop.php';
} else if (@$_GET['admin'] == "website") {
  include 'view/admin_manage/admin_websetting.php';
} else if (@$_GET['admin'] == "game") {
  include 'view/admin_manage/admin_game_setting.php';
} else if (@$_GET['admin'] == "editgame") {
  include 'view/admin_manage/admin_game_edit.php';
} else if (@$_GET['admin'] == "addcode") {
  include 'view/admin_manage/admin_game_addcode.php';
} else if (@$_GET['admin'] == "addaccount") {
  include 'view/admin_manage/admin_shop_stock.php';
} else if (@$_GET['admin'] == "editshop") {
  include 'view/admin_manage/admin_shop_edit.php';
} else if (@$_GET['admin'] == "manageshop") {
  include 'view/admin_manage/admin_shop_manage.php';
} else if (@$_GET['admin'] == "history") {
  include 'view/admin_manage/admin_history.php';
} else if (@$_GET['admin'] == "history_pre") {
  include 'view/admin_manage/admin_history_premium.php';
} else if (@$_GET['admin'] == "shoppremium") {
  include 'view/admin_manage/admin_shoppremium.php';
} else if (@$_GET['admin'] == "img_slide") {
  include 'view/admin_manage/admin_img_slide.php';
} else if (@$_GET['admin'] == "img_slide_edit") {
  include 'view/admin_manage/admin_img_slide_edit.php';
} else if (!preg_match('/^[a-zA-Z0-9\_]*$/', @$_GET['admin'])) {
  //include 'view/admin_manage/admin_shop.php';
} else {
  // include 'view/admin_manage/admin_category.php';
}

?>