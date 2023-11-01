<div class="col-md-12 col-sm-12 mt-4" data-aos="zoom-in-down">
    <ol class="breadcrumb mt-3 crad_tung text-white">
        <li class="breadcrumb-item text-white hvr-shrink pointer" onclick="CradURL('./page/home')">หน้าแรก</li>
        <?php if(@$_GET['game'] == "spin"):?>
            <li class="breadcrumb-item text-white hvr-shrink pointer" onclick="CradURL('./page/game')">เกมสุ่มรางวัล</li>
            <li class="breadcrumb-item text-white active">สุ่มวงล้อ</li>
        <?php elseif(@$_GET['game'] == "roller"): ?>
            <li class="breadcrumb-item text-white hvr-shrink pointer" onclick="CradURL('./page/game')">เกมสุ่มรางวัล</li>
            <li class="breadcrumb-item text-white active">กล่องสุ่ม</li>
        <?php elseif(@$_GET['game'] == "slot"): ?>
            <li class="breadcrumb-item text-white hvr-shrink pointer" onclick="CradURL('./page/game')">เกมสุ่มรางวัล</li>
            <li class="breadcrumb-item text-white active">สุ่มสล็อต</li>
        <?php else: ?>
            <li class="breadcrumb-item text-white active">เกมสุ่มรางวัล</li>
        <?php endif; ?>
    </ol>
</div>

<?php if(@$_GET['game'] != "spin" && @$_GET['game'] != "roller" && @$_GET['game'] != "slot"):?>

<div class="col-md-4 col-sm-12 mt-2 hvr-shrink pointer" onclick="CradURL('./game/spin')">
    <div class="card crad_tung text-white mb-3" data-aos="zoom-in-up">
        <div class="card-body text-center">

            <img src="assets/img/icons/wheel-of-fortune.png" alt="wheel" class="center-menu mt-3 mb-3">
            <h4 class="text-white">สุ่มวงล้อ</h4>
            <p class="text-white">ลุ้นรางวัลบัตรเงินสด</p>

        </div>
    </div>
</div>

<div class="col-md-4 col-sm-12 mt-2 hvr-shrink pointer" onclick="CradURL('./game/roller')">
    <div class="card crad_tung text-white mb-3" data-aos="zoom-in-up">
        <div class="card-body text-center">

            <img src="assets/img/icons/gift-box.png" alt="gift-box" class="center-menu mt-3 mb-3">
            <h4 class="text-white">กล่องสุ่ม</h4>
            <p class="text-white">ลุ้นรางวัลบัตรเงินสด</p>

        </div>
    </div>
</div>

<div class="col-md-4 col-sm-12 mt-2 hvr-shrink pointer" onclick="CradURL('./game/slot')">
    <div class="card crad_tung text-white mb-3" data-aos="zoom-in-up">
        <div class="card-body text-center">

            <img src="assets/img/icons/jackpot.png" alt="jackpot" class="center-menu mt-3 mb-3">
            <h4 class="text-white">สุ่มสล็อต</h4>
            <p class="text-white">ลุ้นรางวัลบัตรเงินสด</p>

        </div>
    </div>
</div>

<?php endif; ?>

<?php
    if(@$_GET['game'] == "spin"){
        include 'view/games/game_spin.php';
    }else if(@$_GET['game'] == "roller"){
        include 'view/games/game_roller.php';
    }else if(@$_GET['game'] == "slot"){
        include 'view/games/game_slot.php';
    }else if(!preg_match('/^[a-zA-Z0-9\_]*$/', @$_GET['game'])){
        //include 'view/admin_manage/admin_shop.php';
    }else{
        // include 'view/admin_manage/admin_category.php';
        
    }
    
?>

