<div class="col-md-12 col-sm-12 mt-2">
    <div class="card-header text-white"><i class="fa-solid fa-screwdriver-wrench"></i> Add Stock account - เพิ่มบัญชี</div>
</div>

<div class="col-md-6 col-sm-12 mt-2">
    <div class="card crad_tung text-white mb-3">
        <div class="card-header"><i class="fa-solid fa-folder-plus"></i> Add Stock - เพิ่มบัญชี</div>
        <div class="card-body mb-6">

            <?php
            if (!preg_match('/^[a-zA-Z0-9\_]*$/', @$_GET['id'])) {
                $idshop = 1;
            }else{
                $idshop = $connect->real_escape_string(@$_GET['id']);
            }

            $result_reward_check = $connect->query("SELECT * FROM tbl_shop_stock WHERE shopid = '".$idshop."'")->num_rows;
            $result_code = $connect->query("SELECT * FROM tbl_shop_stock WHERE shopid = '".$idshop."'")->fetch_assoc();
            $result_shop_item = $connect->query("SELECT * FROM tbl_shop_id WHERE id = '".$idshop."'")->fetch_assoc();
            
            if($result_code == 0):
            ?>
            <div class="alert alert-dismissible alert-success">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong>แจ้งเตือน</strong> ยังไม่มี บัญชีใน สินค้านี้สามารถเพิ่มได้เลย. <a href="?page=manage&admin=manageshop&t=account" class="alert-link">กลับ.</a>.
            </div>
            <?php else: ?>
            <style>
                table, th, td {
                    padding: 5px;
                    text-align:center;
                    /* border: 1px solid black; */
                }
            </style>
            <?php
            $result_gifcode_check = $connect->query("SELECT * FROM tbl_shop_stock WHERE shopid = '".$idshop."'")->num_rows;
            if($result_gifcode_check != 0):
            ?>
            <table width="100%">
                <tr>
                    <th><i class="fa-solid fa-superscript"></i></th>
                    <th><i class="fa-solid fa-gift"></i> Account</th>
                    <th><i class="fa-solid fa-clock"></i> Time</th>
                    <th><i class="fa-solid fa-trash-can"></i> Del</th>
                </tr>
                <?php 
                $result_accounte = $connect->query("SELECT * FROM tbl_shop_stock WHERE shopid = '".$idshop."';");
                $res_accountes = $result_accounte->fetch_all(MYSQLI_ASSOC);
                $i= 1;
                foreach($res_accountes as $res_accounte) : 
                ?>
                    <tr>
                        <td style="text-align:center"><?=$i++;?>.</td>
                        <td style="text-align:center">
                            <?php $res_accountesecret = openssl_decrypt($res_accounte['account'], $ciphering, $decryption_key, $options, $decryption_iv);?>
                            <?=$res_accountesecret;?>
                        </td>
                        <td style="text-align:center"><?=th($res_accounte['time']);?></td>
                        <td style="text-align:right">
                            <a onclick="delete_account_stock(<?=$res_accounte['id'];?>)" class="hvr-icon-up btn btn-danger btn-sm"><i class="hvr-icon fa-solid fa-trash-can"></i> ลบ</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="4" style="text-align:right">
                    <hr>
                        <button class="btn btn-danger btn-sm w-100" onclick="delete_account_stock_all(<?=$idshop;?>)"><i class="hvr-icon fa-solid fa-trash-can"></i> ลบทั้งหมด</button>
                    </td>
                </tr>
            </table>

            
            <?php endif; ?>
            
            
            <?php endif ;?> 


        </div>
    </div>
</div>

<div class="col-md-6 col-sm-12 mt-2">
    <div class="card crad_tung text-white mb-3">
        <div class="card-header"><i class="fa-solid fa-folder-plus"></i> Add account - เพิ่มบัญชี</div>
        <div class="card-body">

            <div class="form-group row">
                <div class="form-group col-md-12">
                    <label for="formFile" class="form-label mt-2"><i class="fa-solid fa-caret-right"></i> <?=$result_shop_item['name']?></label>
                    <br>
                    <small>1 บรรทัดต่อบัญชี เช่น ไอดี user1 รหัสผ่าน 12345 ให่ใส่เป็น user1:1234</small>
                    <textarea class="form-control" name="code" id="account" rows="7" placeholder="user1:1234&#13;&#10;user2:4321"></textarea>
                    <input type="hidden" id="shopid" value="<?=$idshop?>">
                </div>
                
            </div>

            <div class="form-group row mt-4">
                <div class="form-group col-md-6">
                    <a onclick="add_account_stock()" class="btn btn-primary w-100"><i class="fa-solid fa-folder-plus"></i> Add account - เพิ่มบัญชี</a>
                </div>
                <div class="form-group col-md-6">
                    <a href="?page=manage&admin=manageshop&t=account" class="btn btn-success w-100"><i class="fa-regular fa-circle-left"></i> Back - กลับ</a>
                    
                </div>
            </div>
            

        </div>
    </div>
</div>

