<?php if(!empty($_GET['id'])): ?>

<div class="col-md-12 col-sm-12 mt-2" data-aos="zoom-in">
    <div class="card crad_tung text-white mb-3">
        <div class="card-header"><i class="fa-solid fa-caret-right" style="color:#F186A9;"></i> Manage Users - จัดการข้อมูลผู้ใช้</div>
        <div class="card-body p-4">

        <?php
        if (!preg_match('/^[a-zA-Z0-9\_]*$/', @$_GET['id'])) {
            $id = 1;
        }else{
            $id = $connect->real_escape_string(@$_GET['id']);
        }
        $result_users_edit = $connect->query("SELECT * FROM tbl_users WHERE id = '".$id."'")->fetch_assoc();
        ?>
        <center>
            <img src="<?=$result_users_edit['img'];?>" onerror="this.onerror=null; this.src='assets/img/web_logo.png'" style="border-color: #7a8288;border-style: solid;border-width: 3px;height: 9.9rem;width: 9.9rem;border-radius: 50%;" alt="a" class="card-img-top img-proflie">
        </center>
            <div class="form-group">
                <label class="col-form-label" for="inputDefault"><i class="fa-solid fa-image"></i> Img URL (รูปโปรไฟล์)</label>
                <input type="text" class="form-control" placeholder="img" id="img" value="<?=$result_users_edit['img']?>">
                <input type="hidden" id="id" value="<?=$result_users_edit['id']?>">
            </div>
            <div class="form-group row">
                <div class="form-group col-md-6">
                    <label class="col-form-label" for="inputDefault"><i class="fa-solid fa-user"></i> Username (ชื่อผู้ใช้)</label>
                    <input type="text" class="form-control" placeholder="username" id="username" value="<?=$result_users_edit['username']?>" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label class="col-form-label" for="inputDefault"><i class="fa-solid fa-envelope"></i> Email (อีเมล)</label>
                    <input type="text" class="form-control" placeholder="email" id="email" value="<?=$result_users_edit['email']?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="form-group col-md-6">
                    <label class="col-form-label" for="inputDefault"><i class="fa-solid fa-coins"></i> Cradit (เครดิต)</label>
                    <input type="text" class="form-control" placeholder="point" id="point" value="<?=$result_users_edit['point']?>">
                </div>
                <div class="form-group col-md-6">
                    <label class="col-form-label" for="inputDefault"><i class="fa-solid fa-coins"></i> IP (ไอพี)</label>
                    <input type="text" class="form-control" placeholder="ip" id="ip" value="<?=$result_users_edit['ip']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-label" for="inputDefault"><i class="fa-solid fa-user-tag"></i> Status (สถานะ)</label>
                <select name="status" class="form-control" id="status">
                    <option value="0" <?php if($result_users_edit['status'] == 0){ echo "selected";} ?>>Ban (แบน)</option>
                    <option value="1" <?php if($result_users_edit['status'] == 1){ echo "selected";} ?>>Member (ผู้ใช้ทั่วไป)</option>
                    <option value="5" <?php if($result_users_edit['status'] == 5){ echo "selected";} ?>>Vip (วีไอพี)</option>
                    <option value="7" <?php if($result_users_edit['status'] == 7){ echo "selected";} ?>>Admin (แอดมิน)</option>
                </select>
            </div>
            <div class="form-group mt-3 mb-4">
                <button onclick="updateusers()" class="btn btn-primary w-100"><i class="fa-regular fa-address-book"></i> แก้ไขบัญชีผู้ใช้</button>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<div class="col-md-12 col-sm-12 mt-2">
    <div class="card mb-3">
        <div class="card-header"><i class="fa-solid fa-caret-right" style="color:#F186A9;"></i> Manage Users - จัดการผู้ใช้</div>
        <div class="card-body">

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table id="tbl_users" cellspacing="1" class="table table-striped table-bordered display">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th><i class="fa-solid fa-computer"></i> Username</th>
                            <th><i class="fa-solid fa-credit-card"></i> Point</th>
                            <th><i class="fa-solid fa-font-awesome"></i> Status</th>
                            <th><i class="fa-solid fa-clock"></i> IP</th>
                            <th><i class="fa-solid fa-clock"></i> Manage</th>
                        </tr>
                    </thead>
                    <!-- <tbody>
                        <tr>
                            <td>zx</td>
                            <td>zx</td>
                            <td>zx</td>
                            <td>zx</td>
                            <td>zx</td>
                            <td>zx</td>
                            
                        </tr>
                    </tbody> -->
                   
                </table>
            </div>

        </div>
    </div>
</div>

<script>
   
</script>