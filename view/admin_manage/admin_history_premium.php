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
                            <th>ราคา</th>
                            <th>เวลา</th>
                            <th>Username</th>
                            <th>ข้อมูล</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $result_history_api = $connect->query("SELECT * FROM tbl_history_api ORDER BY id DESC;");
                    $history_apis = $result_history_api->fetch_all(MYSQLI_ASSOC);
                    $i = 1;
                    foreach($history_apis as $history_api) :  ?> 
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $history_api['name']; ?></td>
                            <td><?= $history_api['status']; ?></td>
                            <td><?= $history_api['price']; ?></td>
                            <td><?= th_full($history_api['timeadd']); ?></td>
                            <td><?= $history_api['username']; ?></td>
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
<?php endforeach ?>