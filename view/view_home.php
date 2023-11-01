<div class="col-12 mt-3 mb-3">
   
    <div id="carouselExampleRide" class="carousel slide" data-bs-ride="true">
        <div class="carousel-inner">
            <?php 
            $result_category = $connect->query("SELECT * FROM tbl_slide order by id asc");
            $res_categorys = $result_category->fetch_all(MYSQLI_ASSOC);
            $i= 1;
            foreach($res_categorys as $res_category) : 
            ?>
            <div class="carousel-item <?php if(@$res_category['id_img'] == 1){ echo "active"; } ?>">
                <img src="assets/img/slide/<?=$res_category['img'];?>" alt="<?=$res_category['img'];?>" height="<?=$res_category['height'] ?>" class="d-block w-100 rounded-3">
            </div>
            <?php endforeach; ?>
            
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
        <img src="..." class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
        <img src="..." class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
        <img src="..." class="d-block w-100" alt="...">
        </div>
    </div>
    </div> -->


</div>
<?php include('view_marquee.php') ?>
<?php if(isset($_SESSION['username'])) :?>





<div class="col-md-2 col-sm-12 col-6 px-2 hvr-shrink pointer" onclick="CradURL('./page/profile')">
    <div class="card crad_tung mb-3 text-center">
        <img src="assets/img/icons/users.png" alt="profile" class="center-menu mt-3">
        <h4 class="text-white">Profile</h4>
        <p class="text-white">โปรไฟล์</p>
    </div>
</div>
<div class="col-md-2 col-sm-12 col-6 px-2 hvr-shrink pointer" onclick="CradURL('./page/shop')">
    <div class="card crad_tung mb-3 text-center">
        <img src="assets/img/icons/shop.png" alt="shop" class="center-menu mt-3">
        <h4 class="text-white">Shop</h4>
        <p class="text-white">ร้านค้า</p>
    </div>
</div>
<div class="col-md-2 col-sm-12 col-6 px-2 hvr-shrink pointer" onclick="CradURL('./page/topup')">
    <div class="card crad_tung mb-3 text-center">
        <img src="assets/img/icons/topup.png" alt="topup" class="center-menu mt-3">
        <h4 class="text-white">Topup</h4>
        <p class="text-white">เติมเงิน</p>
    </div>
</div>
<div class="col-md-2 col-sm-12 col-6 px-2 hvr-shrink pointer" onclick="CradURL('./page/deposit')">
    <div class="card crad_tung mb-3 text-center">
        <img src="assets/img/icons/deposit.png" alt="deposit" class="center-menu mt-3">
        <h4 class="text-white">Deposit</h4>
        <p class="text-white">ฝากขายไอดี</p>
    </div>
</div>
<div class="col-md-2 col-sm-12 col-6 px-2 hvr-shrink pointer" onclick="CradURL('./page/game')">
    <div class="card crad_tung mb-3 text-center">
        <img src="assets/img/icons/game.png" alt="game" class="center-menu mt-3">
        <h4 class="text-white">Game</h4>
        <p class="text-white">เกมส์</p>
    </div>
</div>
<div class="col-md-2 col-sm-12 col-6 px-2 hvr-shrink pointer" onclick="CradURL('./page/inventory')">
    <div class="card crad_tung mb-3 text-center">
        <img src="assets/img/icons/history.png" alt="history" class="center-menu mt-3">
        <h4 class="text-white">Inventory</h4>
        <p class="text-white">คลังเก็บของ</p>
    </div>
</div>

<?php else: ?>


<?php endif; ?>
<div class="col-md-12 col-sm-12 mt-4"></div>
<div class="col-md-3 col-sm-12 col-12 px-2">
    <div class="card crad_tung mb-3 text-center" data-aos="fade-up">
        <img src="assets/img/icons/balance.png" alt="balance" class="center-menu-status mt-3 mb-3">
        <small class="text-white">สินทั้งหมด</small>
        <h2 class="text-white"><?=$count_shop?></h2>
    </div>
</div>
<div class="col-md-3 col-sm-12 col-12 px-2">
    <div class="card crad_tung mb-3 text-center" data-aos="fade-up">
        <img src="assets/img/icons/return-of-investment.png" alt="investment" class="center-menu-status mt-3 mb-3">
        <small class="text-white">ขายแล้ว</small>
        <h2 class="text-white"><?=$count_shop_sell?></h2>
    </div>
</div>
<div class="col-md-3 col-sm-12 col-12 px-2">
    <div class="card crad_tung mb-3 text-center" data-aos="fade-up">
        <img src="assets/img/icons/rating.png" alt="rating" class="center-menu-status mt-3 mb-3">
        <small class="text-white">สมาชิกทั้งหมด</small>
        <h2 class="text-white"><?=$count_users?></h2>
    </div>
</div>
<div class="col-md-3 col-sm-12 col-12 px-2">
    <div class="card crad_tung mb-3 text-center" data-aos="fade-up">
        <img src="assets/img/icons/server.png" alt="server" class="center-menu-status mt-3 mb-3">
        <small class="text-white">สถาะเซิฟเวอร์</small>
        <h2 class="text-white">Online</h2>
    </div>
</div>


<?php include 'view/view_shophot.php'; ?>


<script>

    
</script>