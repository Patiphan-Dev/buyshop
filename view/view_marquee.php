<?php 
    $results_mee = $connect->query("SELECT * FROM tbl_shop_history ORDER BY id DESC LIMIT 10");
    $mee_fetchs = $results_mee->fetch_all(MYSQLI_ASSOC);
?>
<div class="col-md-12 col-sm-12 col-12 mt-4 mb-4">
    <div class="crad crad_tung" style="background: rgba(51,122,255,0.05);">
<marquee direction="left">
    <div class="d-flex flex-row mt-2">

        <?php foreach($mee_fetchs as $mee_fetch) :
            $shop_by_id = $connect->query("SELECT * FROM tbl_shop_id WHERE id = '".$mee_fetch['gameid']."';")->fetch_assoc();
            $img_shop_id = explode(',', $shop_by_id['img']);
            // echo "SELECT * FROM tbl_shop_id WHERE id = '".$mee_fetch['gameid']."';";
             ?>
        <div class="col-md-3 col-sm-12 pr-4" style="padding-right:3px;padding-left:43px;">
            <div class="row">
                <div class="col-md-6 col-sm-12 text-end mt-1">
                    <img class="rounded" style="width:auto;height: 65px;" src="<?=$img_shop_id[0]?>">  
                </div>
                <div class="col-md-6 col-sm-12 text-white">
                    <span><b> <?=$shop_by_id['name']?></b></span><br>
                    <small style="color:#46FF33;"> สั่งซื้อโดย</small>
                    <strong class="text-info" ><?=$mee_fetch['username']?></strong><br>
                    <small><?=th($mee_fetch['timeadd'])?></small>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
               
    </div>
</marquee>
    </div>
</div>