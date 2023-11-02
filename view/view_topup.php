<div class="col-md-12 col-sm-12 mt-4" data-aos="zoom-in-down">
    <ol class="breadcrumb mt-3 crad_tung text-white">
        <li class="breadcrumb-item text-white hvr-shrink pointer" onclick="CradURL('./page/home')">หน้าแรก</li>
        <li class="breadcrumb-item text-white active">เติมเงิน</li>
    </ol>
</div>

<div class="col-md-4 col-sm-12 mt-4" data-aos="zoom-in">
    <div class="card crad_tung mb-3 text-white ">
        <div class="card-header"><i class="fa-solid fa-circle-dollar-to-slot" style="color:#C46A00;"></i> Topup - เติมเงิน</div>
        <div class="card-body">

            <div class="mb-4 text-center">
                <img src="assets/img/icons/truewallet.png" style="height: 9.9rem;width: 9.9rem; " alt="a" class="card-img-top img-proflie">
            </div>
            <div class="form-group mb-3">
                <label class="col-form-label" for="inputDefault"><i class="fa-solid fa-link"></i> Aungpao - ลิ้งอังเป่า <a href="" data-bs-toggle="modal" data-bs-target="#howtotopup"> วิธีเติมเงินด้วยอังเป่า</a> </label>
                <input type="text" class="form-control" placeholder="https://gift.truemoney.com/campaign/?v=xxxx" id="link_topup">
            </div>
            <div class="form-group mb-3">
                <div class="g-recaptcha d-flex align-items-center justify-content-center" style="margin-top: 15px;" data-sitekey="<?php echo SITE_KEY; ?>"></div>
            </div>

            <div class="form-group mb-3">
                <button onclick="topups()" class="btn btn-primary w-100"><i class="fa-solid fa-circle-check"></i> ตรวจสอบข้อมูล</button>
            </div>

        </div>
    </div>
</div>

<div class="col-md-8 col-sm-12 mt-4" data-aos="zoom-in">
    <!-- crad_tung text-white -->
    <div class="card mb-3">
        <div class="card-header"><i class="fa-solid fa-wallet" style="color:#3D9B00;"></i> Topup History - ประวัติการเติมเงิน</div>
        <div class="card-body">
            <?php
            $result = $connect->query("SELECT * FROM tbl_topup WHERE username = '" . $users_username . "'; ");
            $rewardshistorys = $result->fetch_all(MYSQLI_ASSOC);
            ?>
            <?php if ($result->num_rows == 0) : ?>
                <div class="alert alert-dismissible alert-warning">
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="alert"></button> -->
                    <h4 class="alert-heading">Warning!</h4>
                    <p class="mb-0">ยังไม่มีประวัติการทำรายการ.</p>
                </div>

            <?php else : ?>
                <div class="row">
                    <div class="col-md-12 col-sm-12 text-center mt-2">
                        <div class="table-responsive">
                            <table id="tbl_topuphistory" cellspacing="1" class="table table-striped table-bordered display text-white">
                                <thead>
                                    <tr>
                                        <th>#Order</th>
                                        <th><i class="fa-solid fa-computer"></i> Pay</th>
                                        <th><i class="fa-solid fa-credit-card"></i> Credit</th>
                                        <th><i class="fa-solid fa-font-awesome"></i> Status</th>
                                        <th><i class="fa-solid fa-clock"></i> Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($rewardshistorys as $rewardshistory) :  ?>
                                        <tr>
                                            <td><?= $rewardshistory['id']; ?></td>
                                            <td><?= $rewardshistory['topupby']; ?></td>
                                            <td><?= number_format($rewardshistory['point'], 2); ?></td>
                                            <td><span style="color:#1b4d0a;"><i class="fa-solid fa-check"></i> ผ่าน</span></td>
                                            <td><?= th($rewardshistory['topuptime']); ?></td>

                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="howtotopup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">วิธีเติมเงินด้วยอังเป่า</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="assets/img/aungpao_truewallet.png" style="height: 100%;width: 100%; " alt="a" class="card-img-top img-proflie">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info w-100" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>