<div class="col-md-12 col-sm-12 mt-2" data-aos="zoom-in">
    <div class="card crad_tung text-white mb-3">
        <div class="card-header"><i class="fa-solid fa-caret-right" style="color:#F186A9;"></i> จัดการข้อมูลผู้ใช้</div>
        <div class="card-body p-4">

       
            <div class="form-group row">
                <div class="form-group col-md-4">
                    <label class="col-form-label" for="inputDefault"><i class="fa-solid fa-image"></i> Img Logo URL (รูปโลโก้)</label>
                    <input type="text" class="form-control" id="img" value="<?=$result_info_web['web_img']?>">
                </div>
                <div class="form-group col-md-4">
                    <label class="col-form-label" for="inputDefault"><i class="fa-solid fa-tag"></i> Name (ชื่อเว็บ)</label>
                    <input type="text" class="form-control" id="name" value="<?=$result_info_web['web_name']?>">
                </div>
                <div class="form-group col-md-4">
                    <label class="col-form-label" for="inputDefault"><i class="fa-solid fa-wallet"></i> Wallet (เบอร์วอเลท)</label>
                    <input type="text" class="form-control" id="wallet" value="<?=$result_info_web['web_wallet']?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="form-group col-md-4">
                    <label class="col-form-label" for="inputDefault"><i class="fa-solid fa-circle-info"></i> Version (เวอร์ชั่น)</label>
                    <input type="text" class="form-control" id="version" value="<?=$result_info_web['web_version']?>">
                </div>
            </div>
            <hr>
            <div class="form-group row">
                <div class="form-group col-md-4">
                    <label class="col-form-label" for="inputDefault"><i class="fa-brands fa-facebook"></i> Facebook (ลิ้ง)</label>
                    <input type="text" class="form-control" id="fb" value="<?=$result_info_web['web_fb']?>">
                </div>
                <div class="form-group col-md-4">
                    <label class="col-form-label" for="inputDefault"><i class="fa-brands fa-discord"></i> Discord (ลิ้ง)</label>
                    <input type="text" class="form-control" id="dc" value="<?=$result_info_web['web_discord']?>">
                </div>
                <div class="form-group col-md-4">
                    <label class="col-form-label" for="inputDefault"><i class="fa-brands fa-youtube"></i> Youtube (ลิ้ง)</label>
                    <input type="text" class="form-control" id="yt" value="<?=$result_info_web['web_youtube']?>">
                </div>
            </div>
            <hr>
            <div class="form-group row">
                <div class="form-group col-md-4">
                    <label for="formFile" class="form-label mt-2"><i class="fa-solid fa-caret-right"></i> ราคา Spin</label>
                    <input class="form-control" type="number" id="point_spin" placeholder="ราคา Spin" value="<?=$result_info_web['point_spin']?>">
                </div>
                <div class="form-group col-md-4">
                    <label for="formFile" class="form-label mt-2"><i class="fa-solid fa-caret-right"></i> ราคา Roller</label>
                    <input class="form-control" type="number" id="point_roller" placeholder="ราคา Roller" value="<?=$result_info_web['point_roller']?>">
                </div>
                <div class="form-group col-md-4">
                    <label for="formFile" class="form-label mt-2"><i class="fa-solid fa-caret-right"></i> ราคา Slot</label>
                    <input class="form-control" type="number" id="point_slot" placeholder="ราคา Slot" value="<?=$result_info_web['point_slot']?>">
                </div>

            </div>

            <div class="form-group row">
                 <div class="form-group col-md-4">
                    <label for="formFile" class="form-label mt-2"><i class="fa-solid fa-caret-right"></i> Title WEB</label>
                    <input class="form-control" type="text" id="web_title" placeholder="Shop" value="<?=$result_info_web['web_title']?>">
                </div>
                <div class="form-group col-md-4">
                    <label for="formFile" class="form-label mt-2"><i class="fa-solid fa-caret-right"></i> สีพื้นหลังเว็บ</label>
                    <input class="form-control form-control-color" type="color" id="colorweb" placeholder="FFCC00" value="<?=$result_reward_edit['color']?>">
                </div>
                <div class="form-group col-md-4">
                    <label for="formFile" class="form-label mt-2"><i class="fa-solid fa-caret-right"></i> สีพื้นหลังเมนู</label>
                    <input class="form-control form-control-color" type="color" id="colormenu" placeholder="FFCC00" value="<?=$result_reward_edit['color']?>">
                </div>
               

            </div>
            
            <div class="form-group mt-3 mb-4">
                <button onclick="updateweb()" class="btn btn-primary"><i class="fa-regular fa-address-book"></i> แก้ไขข้อมูล</button>
            </div>
        </div>
    </div>
</div>

