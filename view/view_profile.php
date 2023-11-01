<div class="col-md-4 col-sm-12 mt-4"></div>
<div class="col-md-4 col-sm-12 mt-4" data-aos="zoom-in">
    <center>
        <img src="<?=$users_profile;?>" onerror="this.onerror=null; this.src='<?=$result_info_web['web_img'];?>'" style="border-color: #7a8288;border-style: solid;border-width: 3px;height: 9.9rem;width: 9.9rem;border-radius: 50%;" alt="a" class="card-img-top img-proflie">
    </center>
    <div class="text-center mt-3">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <h4 class="text-white">สวัสดี, <?=$users_username;?></h4>
                <p class="text-white"><?=$users_email;?></p>
            </div>
            <div class="col-md-12 col-sm-12">
                <span class="badge rounded-pill bg-info" style="font-size: 0.9rem;"><i class="fa-solid fa-sack-dollar"></i> คงเหลือ : <?=number_format($users_point,2)?> Credit</span>
                <?php if($users_status == $admin_status): ?>
                    <span class="badge rounded-pill bg-danger" style="font-size: 0.9rem;"><i class="fa-solid fa-rocket"></i> สถานะ : Admin</span>
                <?php elseif($users_status == $vip_status):?>  
                    <span class="badge rounded-pill bg-warning" style="font-size: 0.9rem;"><i class="fa-solid fa-rocket"></i> สถานะ : Vip</span>
                <?php else:?>  
                    <span class="badge rounded-pill bg-success" style="font-size: 0.9rem;"><i class="fa-solid fa-rocket"></i> สถานะ : Member</span> 
                <?php endif;?>

            </div>
        </div>
    </div>
</div>
<div class="col-md-4 col-sm-12 mt-4"></div>

<div class="col-md-6 col-sm-12 mt-4">
    <div class="card crad_tung text-white mb-3">
        <div class="card-header"><i class="fa-solid fa-user-pen"></i> User Info - ข้อมูลผู้ใช้</div>
        <div class="card-body">

            <div class="p-4">
                <div class="form-group mb-2">
                    <label class="col-form-label" for="inputDefault"><i class="fa-solid fa-chevron-right"></i> Url รูปโปรไฟล์ <a href="https://th.imgbb.com" target="_blank" rel="noopener noreferrer">imgbb.com</a></label>
                    <input type="text" class="form-control" id="urlimg" value="<?=$users_profile;?>">
                </div>
                <div class="form-group mb-2">
                    <label class="col-form-label" for="inputDefault"><i class="fa-solid fa-chevron-right"></i> Email - อีเมล์ <span class="badge rounded-pill bg-dark" style="font-size: 0.9rem;color:#FF2C2C;" id="valBox">ไม่สามารถเปลี่ยนได้</span></label>
                    <input type="text" class="form-control" id="email" readonly value="<?=$users_email;?>">
                </div>
                <div class="form-group mt-4 mb-4">
                    <button onclick="reprofile()" class="btn btn-primary w-100"><i class="fa-solid fa-circle-check"></i> แก้ไขข้อมูล</button>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="col-md-6 col-sm-12 mt-4">
    <div class="card crad_tung text-white mb-3">
        <div class="card-header"><i class="fa-solid fa-unlock"></i> Change Passwrod - เปลี่ยนรหัสผ่าน</div>
        <div class="card-body">

            <div class="p-4">
                <div class="form-group">
                    <label class="col-form-label" for="inputDefault"><i class="fa-solid fa-lock"></i> Password (รหัสผ่านเก่า)</label>
                    <div class="input-group">
                        <input type="password" class="form-control password" placeholder="Password" id="password">
                        <span class="input-group-text" onclick="password_show_hide();">
                        <i class="fas fa-eye" id="show_eye"></i>
                        <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="inputDefault"><i class="fa-solid fa-lock"></i> New - Password (รหัสผ่านใหม่)</label>
                    <div class="input-group">
                        <input type="password" class="form-control passwordx" placeholder="Re - Password" id="newpassword">
                        <span class="input-group-text" onclick="password_show_hidex();">
                        <i class="fas fa-eye" id="show_eyex"></i>
                        <i class="fas fa-eye-slash d-none" id="hide_eyex"></i>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="inputDefault"><i class="fa-solid fa-lock"></i> Re - Password (ยืนยันรหัสผ่านใหม่)</label>
                    <div class="input-group">
                        <input type="password" class="form-control passwordy" placeholder="Re - Password" id="repassword">
                        <span class="input-group-text" onclick="password_show_hidey();">
                        <i class="fas fa-eye" id="show_eyey"></i>
                        <i class="fas fa-eye-slash d-none" id="hide_eyey"></i>
                        </span>
                    </div>
                </div>

                <div class="form-group mt-4 mb-4">
                    <button onclick="repassword()" class="btn btn-primary w-100"><i class="fa-solid fa-circle-check"></i> เปลี่ยนรหัสผ่าน</button>
                </div>

            </div>

        </div>
    </div>
</div>


<script>
    function password_show_hide() {
        var x = document.getElementById("password");
        var show_eye = document.getElementById("show_eye");
        var hide_eye = document.getElementById("hide_eye");
        hide_eye.classList.remove("d-none");
        if (x.type === "password") {
            x.type = "text";
            show_eye.style.display = "none";
            hide_eye.style.display = "block";
        } else {
            x.type = "password";
            show_eye.style.display = "block";
            hide_eye.style.display = "none";
        }
    }
    function password_show_hidex() {
        var x = document.getElementById("newpassword");
        var show_eye = document.getElementById("show_eyex");
        var hide_eye = document.getElementById("hide_eyex");
        hide_eye.classList.remove("d-none");
        if (x.type === "password") {
            x.type = "text";
            show_eye.style.display = "none";
            hide_eye.style.display = "block";
        } else {
            x.type = "password";
            show_eye.style.display = "block";
            hide_eye.style.display = "none";
        }
    }
    function password_show_hidey() {
        var x = document.getElementById("repassword");
        var show_eye = document.getElementById("show_eyey");
        var hide_eye = document.getElementById("hide_eyey");
        hide_eye.classList.remove("d-none");
        if (x.type === "password") {
            x.type = "text";
            show_eye.style.display = "none";
            hide_eye.style.display = "block";
        } else {
            x.type = "password";
            show_eye.style.display = "block";
            hide_eye.style.display = "none";
        }
    }
</script>