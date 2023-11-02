<link rel="stylesheet" href="assets/spin/css/superwheel.css">


<div class="col-md-3 col-sm-12"></div>
<div class="col-md-6 col-sm-12">
    <div class="col-12">
        <div class="superwheel"></div>
    </div>
    <div class="col-12 text-center">
        <span class="badge rounded-pill bg-light" style="font-size: 1.1rem;">
            <small style="color:#000">คุณคงเหลือ : <i class="fa-solid fa-coins"></i> <span id="pointnow"><?=number_format($users_point,2)?></span> เครดิต</small> 
        </span><br>
        <small style="color:#fff">ของรางวัลคือบัตร บัตรทรู 50 - 1,000 บาท<br>
        <a href="page/inventory" class="alert-link" style="text-decoration:none"><i class="fa-solid fa-clock-rotate-left"></i> ประวัติการรับของรางวัล</a></small><br>

        <span class="badge rounded-pill bg-danger" style="font-size: 0.8rem;">
            <small style="color:#fff">เมื่อกดสุ่มแล้วไม่สามารถขอคืนเครดิตได้ในทุกกรณี</small> 
        </span>
        <div class="col-12 mt-3 mb-6">
            <button type="button" spin-buttonid="ff" class="btn btn-primary spin-button w-50">เริ่มการสุ่ม ( 10 เครดิต )</button>

        </div>
    </div>
</div>
<div class="col-md-3 col-sm-12"></div>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<script type="text/javascript" src="assets/spin/js/superwheel.js"></script>
<script type="text/javascript">

    var pointnow;
    var audio = new Audio('assets/media/new.mp3');
    var audiotick = new Audio('assets/media/wheel_tick.mp3');
    var audiolost = new Audio('assets/media/effect-lost.mp4');
    var audiowin = new Audio('assets/media/effect-win.mp4');
    audio.volume = 0.2;
    audiowin.volume = 0.2;
    audiolost.volume = 0.2;

    $('.superwheel').superWheel({
        slices: [

            <?php 
            $result_reward = $connect->query("SELECT * FROM tbl_item_rewards WHERE game = 'spin'");
            $res_rewards = $result_reward->fetch_all(MYSQLI_ASSOC);
            $i= 1;
            foreach($res_rewards as $res_reward) :  
            ?>
           
            {
                text: "<?=$res_reward['img']?>",
                value: <?=$res_reward['id']?>,
                message: "<?=$res_reward['name']?>",
                background: "<?=$res_reward['color']?>",
                color: "<?=$res_reward['color']?>"
            },
            <?php endforeach; ?>

		],
        width: 700,
        frame: 1,
        type: "spin",
        text: {
            type: "image",
            color: "#333",
            size: 20,
            offset: 8,
            orientation: "h",
            arc: false
        },
        line: {
            color: "#333"
        },
        outer: {
            color: "#333"
        },
        inner: {
            color: "#333"
        },
        center: {
            rotate: true,
            image: {
                url: "assets/img/web_logo2.png"
            }
        },
        marker: {
            animate: "true"
        }
		});
        var tick = new Audio('assets/spin/tick.mp3');
        var winmsg;
        var popup;
        $(document).on('click', '.spin-button', function (e) {
            audio.play();
            e.preventDefault();
            var id = $(this).attr("spin-buttonid")
            var formData = {
                'id': 'code' //for get code 
            };

            $.ajax({
                url: "idpass.php?spin_api",
                type: "POST",
                data: formData,
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                success: function (res) {
                    if (res.status == 200) {
                        $(".spin-button").attr("disabled", true);
                        $(".spin-button").html("รอสักครู่...");
                        $('.superwheel').superWheel('start', 'value', res.valueid);
                    } else {
                        $( "#return" ).html( res.popup );
                    }
                    $('#pointnow').html(res.point_now);
                    pointnow = res.point_nows;
                    winmsg = res.item_value;
                    popup = res.popup;
                    
                    
                },
                error: function (ee) {
                    //console.log(ee);
                }
            });
        });
        $('.superwheel').superWheel('onComplete', function (results) {
            $( "#return" ).html( popup );
            $(".spin-button").attr("disabled", false);
            $(".spin-button").html("เริ่มการสุ่ม");
            $('#pointnow').html(pointnow);
        });
        $('.superwheel').superWheel('onStep', function (results) {

            if (typeof tick.currentTime !== 'undefined')
                tick.currentTime = 0;
            tick.play();

        });

        function code(a){
            return a;
        }
</script>