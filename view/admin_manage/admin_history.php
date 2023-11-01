<div class="col-md-12 col-sm-12 mt-4" data-aos="zoom-in-down">
    <ol class="breadcrumb mt-3 crad_tung text-white">
        <li class="breadcrumb-item text-white hvr-shrink pointer" onclick="CradURL('./page/home')">หน้าแรก</li>
        <!-- <li class="breadcrumb-item text-white hvr-shrink pointer" onclick="CradURL('./page/shop')">ร้านค้า</li> -->
        <li class="breadcrumb-item text-white active">คลังเก็บของ</li>
    </ol>
</div>

<div class="col-md-12 col-sm-12 mt-2" data-aos="zoom-in">
    <div class="card mb-3">
        <div class="card-header"><i class="fa-solid fa-box-open" style="color:#F186A9;"></i> History Shop - ประวัติการซื้อไอดี</div>
        <div class="card-body">

        <style>
            .modal-backdrop {
                z-index: -1;
            }
            .modal{
                /* bug fix - custom overlay */   
                background-color: rgba(10,10,10,0.45);
            }
        </style>

            <div class="table-responsive">
                <table id="tbl_history_shop2" cellspacing="1" class="table table-striped table-bordered display text-white">
                    <thead>
                        <tr>
                            <th>#รหัสสินค้า</th>
                            <!-- <th><i class="fa-solid fa-computer"></i> ราคา</th> -->
                            <th><i class="fa-solid fa-file-csv"></i> สินค้า</th>
                            <th><i class="fa-solid fa-clock"></i> เวลาสั่งซื้อ</th>
                            <th><i class="fa-solid fa-font-awesome"></i> ราคา</th>
                            <th><i class="fa-solid fa-clock"></i> ข้อมูล</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $result_shop = $connect->query("SELECT * FROM tbl_shop_history ORDER BY id desc ");
                    $shophistorys = $result_shop->fetch_all(MYSQLI_ASSOC);
                    foreach($shophistorys as $shophistory) :
                        $shop_info = $connect->query('SELECT * FROM `tbl_shop_id` WHERE `id` = "'.$shophistory['gameid'].'" ')->fetch_assoc();
                    ?>
                        <tr>
                            <td>A00<?= $shophistory['gameid']; ?></td>
                            <td><?= $shop_info['name']; ?></td>
                            <td><?= th_full($shophistory['timeadd']); ?></td>
                            <td><?= number_format($shophistory['point'],2); ?></td>
                            <td>
                                <?php if($shop_info['shoptype'] == 'idgame'):?>
                                <a href="shop/<?=$shophistory['gameid']?>" class="btn btn-primary btn-sm mb-2"><i class="fa-solid fa-cart-shopping"></i> ดูสินค้า</a>
                                <?php endif; ?>
                                <button class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#SeeIdModal<?=$shophistory['id']?>"><i class="fa-solid fa-lock-open"></i> ดูข้อมูล</button>
                            </td>
                            
                            
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php foreach($shophistorys as $shophistory) :  ?>
            <!-- Modal -->
            <div class="modal fade" id="SeeIdModal<?=$shophistory['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">รหัสสินค้าที่ A00<?=$shophistory['gameid']?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php $infosecret = openssl_decrypt($shophistory['secret_info'], $ciphering, $decryption_key, $options, $decryption_iv);?>
                        <h5>ข้อมูลลับ</h5> 
                        <span><?= $infosecret ?></span> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary w-100" data-bs-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </div>
</div>

<div class="col-md-12 col-sm-12 mt-2" data-aos="zoom-in">
    <div class="card mb-3">
        <div class="card-header"><i class="fa-solid fa-gift" style="color:#C30101;"></i> History Rewards - ประวัติการรับรางวัล</div>
        <div class="card-body">

            <div class="table-responsive">
                <table id="tbl_history_reward" cellspacing="1" class="table table-striped table-bordered display text-white">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><i class="fa-solid fa-dice"></i> เกม</th>
                            <th><i class="fa-solid fa-gift"></i> รางวัล</th>
                            <th><i class="fa-solid fa-barcode"></i> จำนวน</th>
                            <th><i class="fa-solid fa-clock"></i> เวลา</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $result_reward = $connect->query("SELECT * FROM tbl_history_rewards ORDER BY id desc;");
                    $rewardhistorys = $result_reward->fetch_all(MYSQLI_ASSOC);
                    $i = 1;
                    foreach($rewardhistorys as $rewardhistory) :  ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $rewardhistory['game']; ?></td>
                            <td><?= $rewardhistory['name']; ?></td>
                            <td><?= $rewardhistory['value']; ?></td>
                            <td><?= th_full($rewardhistory['timeadd']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            

        </div>
    </div>
</div>



<div class="col-md-12 col-sm-12 mt-2">
    <div class="card mb-3">
        <div class="card-header"><i class="fa-solid fa-gift" style="color:#C30101;"></i> History Buy - ประวัติการซื้อ</div>
        <div class="card-body">

            <div class="table-responsive">
                <table id="tbl_history_shop" cellspacing="1" class="table table-striped table-bordered display text-white">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ชื่อ</th>
                            <th>สถานะ</th>
                            <th>จำนวน</th>
                            <th>ราคา</th>
                            <th>ข้อมูล</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $result_history_api = $connect->query("SELECT * FROM tbl_history_api ORDER BY id desc;");
                    $history_apis = $result_history_api->fetch_all(MYSQLI_ASSOC);
                    $i = 1;
                    foreach($history_apis as $history_api) :  ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $history_api['name']; ?></td>
                            <td><?= $history_api['status']; ?></td>
                            <td><?= $history_api['price']; ?></td>
                            <td><?= th_full($history_api['timeadd']); ?></td>
                            <td><button class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#apiModal<?=$history_api['id']?>"><i class="fa-solid fa-lock-open"></i> ดูข้อมูล</button></td>
                            
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            

        </div>
    </div>
</div>


<?php  foreach($history_apis as $history_api) : ?>
  <!-- Modal -->
<div class="modal fade" id="apiModal<?=$history_api['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><?=$history_api['name']?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p><?=$history_api['info']?></p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary w-100" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>

<?php endforeach; ?>



