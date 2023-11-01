<div class="col-md-4 col-sm-12"></div>
<div class="col-md-4 col-sm-12">
    <div class="card crad_tung mb-2 mt-4" data-aos="zoom-in">
        <div class="card-body text-white">
            <div class="text-center">
                <!-- <center> -->
                    <img  src="assets/img/anya.jpg" style="border-color: #7a8288;border-style: solid;border-width: 3px;height: 9.9rem;width: 9.9rem;border-radius: 50%;" alt="a" class="card-img-top img-proflie mb-2">
                <!-- </center> -->
                <h3>สร้างบัญชีใหม่</h3>
                <p class="mb-2">ฉันมีบัญชีแล้ว, <a href="?page=login" class="alert-link">เข้าสู่ระบบ</a>
            </div>

            <div class="form-group">
                <label class="col-form-label" for="inputDefault"><i class="fa-solid fa-user"></i> Username (ชื่อผู้ใช้)</label>
                <input type="text" class="form-control" placeholder="Username" id="username">
            </div>
            <div class="form-group">
                <label class="col-form-label" for="inputDefault"><i class="fa-solid fa-lock"></i> Password (รหัสผ่าน)</label>
                <div class="input-group">
                    <input type="password" class="form-control password" placeholder="Password" id="password">
                    <span class="input-group-text" onclick="password_show_hide();">
                    <i class="fas fa-eye" id="show_eye"></i>
                    <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-label" for="inputDefault"><i class="fa-solid fa-lock"></i> Re - Password (ยืนยันรหัสผ่าน)</label>
                <div class="input-group">
                    <input type="password" class="form-control passwordx" placeholder="Re - Password" id="repassword">
                    <span class="input-group-text" onclick="password_show_hidex();">
                    <i class="fas fa-eye" id="show_eyex"></i>
                    <i class="fas fa-eye-slash d-none" id="hide_eyex"></i>
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-label" for="inputDefault"><i class="fa-solid fa-envelope"></i> E-mail (อีเมล)</label>
                <input type="email" class="form-control" placeholder="E-mail" id="email">
            </div>
            <div class="form-group">
                <div class="g-recaptcha d-flex align-items-center justify-content-center" style="margin-top: 15px;" data-sitekey="<?php echo SITE_KEY; ?>"></div>
            </div>
            <div class="form-group mt-3 mb-2">
                <button onclick="register()" class="btn btn-primary w-100"><i class="fa-regular fa-address-book"></i> สร้างบัญชี</button>
            </div>
            <div class="form-group mb-2">
                <a href="<?=$client->createAuthUrl()?>" class="btn btn-light w-100"><i class="fa-brands fa-google-plus-g"></i> Google Login</a>
            </div>
            <div class="form-group mb-2">
                <div id="fb-root"></div>
                <button onclick="fb_login();waitload();" class="btn btn-primary w-100"><i class="fa-brands fa-facebook"></i> Facebook Login</button>
            </div>
        </div>
    </div>
    
</div>
<div class="col-md-4 col-sm-12"></div>

<script src="assets/js/jquery-3.4.1.min.js"></script>
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
        var x = document.getElementById("repassword");
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
    
</script>


<script>
    function waitload() {
        Swal.fire({
            title: '<i class="fa fa-spinner fa-spin fa-fw"></i>',
            html:'กรุณารอสักครู่...',
            showConfirmButton: false,
        })
    }
    function fb_login() {
        FB.login( function() {}, { scope: 'public_profile,email' } );
    }
    var bFbStatus = false;
    var fbID = "";
    var fbName = "";
    var fbEmail = "";
    var fbPic = "";
    var fbPass = "";
        


    window.fbAsyncInit = function () {
        FB.init({
            appId: '<?=Facebook_appId?>',
            oauth: true,
            status: true, // check login status
            cookie: true, // enable cookies to allow the server to access the session
            xfbml: true // parse XFBML
        });

    };

    function fb_login() {
        
        FB.login(function (response) {
            
            if (response.authResponse) {
                access_token = response.authResponse.accessToken; //get access token
                user_id = response.authResponse.userID; //get FB UID
                FB.api('/me?fields=name,email,picture', function(userInfo) {
                fbPass = user_id;
                fbName = userInfo.name;
                fbEmail = userInfo.email;
                fbPic = userInfo.picture.data.url;
                // console.log(fbID);
                // console.log(fbName);
                // console.log(fbEmail);
                // console.log(fbPic);
                    $.post( "idpass.php?login_facebook",{
                        email: fbEmail,
                        username: fbName,
                        password: fbPass,
                        img: fbPic
                    },  function( data ) {
                    $("#btn").prop("disabled", true);
                    $( "#return" ).html( data );
                    $("#btn").prop("disabled", false); 
                }
                );
                
            });
            } else {
                //user hit cancel button
                //console.log('User cancelled login or did not fully authorize.');
            }
        }, {
            scope: 'public_profile,email'
        });
    }
    (function () {
        var e = document.createElement('script');
        e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
        e.async = true;
        document.getElementById('fb-root').appendChild(e);
    }())
</script>