<div class="col-md-12 col-sm-12 mt-2">
    <div class="card mb-3">
        <div class="card-header"><i class="fa-solid fa-caret-right" style="color:#F186A9;"></i> Manage Shop Premium - จัดการร้านพรีเมียม</div>
        <div class="card-body">

            <!-- Modal -->

            <div class="table-responsive">
                <table id="tbl_history_shop" cellspacing="1" class="table table-striped table-bordered display">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Name</th>
                            <th>Price Api</th>
                            <th>Price Web</th>
                            <th>Status</th>
                            <th>Stock</th>
                            <th>Show</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            $result_bank = $connect->query("SELECT * FROM tbl_shop_stock_api order by id asc");
                            $bankhistorys = $result_bank->fetch_all(MYSQLI_ASSOC);
                            $i = 1;
                            $timenow = time() - 900;
                            foreach($bankhistorys as $data_bank) :  ?>

                            <td><?php echo $i++ ?></td>
                            <td><?=$data_bank['name'] ?></td>
                            <td><?=number_format($data_bank['price'],2) ?></td>
                            <td><?=number_format($data_bank['price_web'],2) ?></td>
                            <td><?=$data_bank['status']?></td>
                            <td><?=$data_bank['stock']?></td>
                            <td>
                                <?php
                                    if($data_bank['showitem'] == 1){
                                        echo '<i class="fa-solid fa-toggle-on fa-xl pointer" style="color:#08B000;" onclick="on_showpremium('.$data_bank['id'].')"> </i> แสดง';
                                    }else{
                                        echo '<i class="fa-solid fa-toggle-off fa-xl pointer" style="color:#A0A0A0;" onclick="on_showpremium('.$data_bank['id'].')"> </i> ซ่อน';
                                    }
                                ?>
                                
                            </td>
                            <td>
                                <a data-bs-toggle="modal" data-bs-target="#editshop<?php echo $data_bank['id'] ?>" class="btn btn-sm btn-info w-100">แก้ไข้ราคา</a></td>                 
                            </td>

                            
                            
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                   
                </table>
            </div>

        </div>
    </div>
</div>

<?php foreach($bankhistorys as $data_bank) :   ?>

<!-- Modal Edit -->
<div class="modal fade" id="editshop<?php echo $data_bank['id'] ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"><i class="fa-solid fa-circle-info"></i> แก้ไขราคา</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"></span>
            </button>
        </div>
        <div class="modal-body">

            <div class="form-group">
                <label class="col-form-label" for="inputDefault"> ราคา API </label>
                <input type="text" class="form-control" disabled value="<?=$data_bank['price'] ?> บาท" id="username">
                <input type="text" class="form-control" hidden placeholder="" value="<?=$data_bank['id'] ?>" id="item_id3<?=$data_bank['id'] ?>">
            </div>

            <div class="form-group">
                <label class="col-form-label" for="inputDefault">ราคาที่ต้องการขายหน้าเว็บเรา</label>
                <input type="text" class="form-control" placeholder="<?=$data_bank['price_web'] ?>" value="<?=$data_bank['price_web'] ?>" id="price<?=$data_bank['id'] ?>">
            </div>
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" onclick="editshoppre(<?=$data_bank['id'] ?>)"><i class="fa-regular fa-circle-check"></i> ยืนยัน</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i> ยกเลิก</button>
        </div>
        </div>
    </div>
</div>

<!-- End Modal Edit -->



<?php endforeach ?>

