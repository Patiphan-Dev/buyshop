<script src="assets/js2/jquery.min.js"></script>
<link rel="stylesheet" href="assets/roller/eroller.css">
<link rel="stylesheet" href="assets/roller/prism.css">
<script src="assets/roller/prism-min.js"></script>
<script src="assets/roller/eroller.js"></script>
<style>
    .eroller .er-item:after,.eroller .er-item:before, .eroller .er-last-rolls:after,.eroller .er-last-rolls:before, .eroller:after,.eroller:before {
        display: table;
        content: " "
    }
    .eroller .er-item:after, .eroller .er-last-rolls:after, .eroller:after {
        clear: both
    }
    .eroller {
        width: 100%;
        /*display: inline-block;*/
        overflow: hidden;
        border: 2px solid #B0BEC5;
        border-radius: 5px;
        /* background-image: url("assets/img/roller/background.PNG"); */
        background-color: #37474F;
        background-repeat: repeat;
        background-size: auto;
    }
    .eroller .er-contents {
        position: relative;
        z-index: 1;
        width: 100%;
        max-height: 100%;
        padding: 0px 0;
        margin: 0;
        overflow: hidden;
        display: -webkit-box;
        display: -ms-flexbox;
        display: -ms-flex;
        display: -moz-flex;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-align: center;
            -ms-flex-align: center;
                align-items: center;
        justify-content: center;
    }
    .eroller, .eroller * {
        box-sizing: border-box;
    }
    .eroller .er-inner {
        z-index: 1;
        overflow: hidden;
        position: relative;
        display: block;
        -webkit-transform: translateX(0);
        transform: translateX(0);
        text-align: center;
        margin: 0;
    }
    .eroller.er-hor .er-inner {
        margin-left: 37.5%;
    }
    .eroller .er-item {
        position: relative;
        width: 60px;
        height: 60px;
        line-height: 47px;
        border-radius: 6px;
        display: inline-block;
        vertical-align: middle;
        text-align: center;
        margin: 2px;
        font-size: 100%;
        font-weight: 700;
        /*border: 2px solid #fefefe;*/
        /*color: #fefefe;*/
        /*background-color: #455A64;*/
        overflow: hidden;
        padding: 5px;
    }
    .eroller .er-item.er-has-img {
        line-height: inherit;
    }
    .eroller .er-item.er-has-img>img {
        max-width: 100%;
    }
    .eroller .er-indicator {
        background-color: #e3dc00;
    }
    .eroller.er-hor .er-indicator {
        width: 4px;
        position: absolute;
        left: 50%;
        margin-left: -2px;
        top: 0;
        bottom: 0;
        z-index: 2;
    }
    /* Vertical Mod */
    .eroller.er-ver {
        width: 80px;
        height: 300px;
    }
    .eroller.er-ver .er-indicator {
        height: 4px;
        width: 100%;
        position: absolute;
        left: 0;
        margin-top: -2px;
        top: 50%;
        bottom: 0;
        z-index: 2;
    }
    .roller .er-item {
        width: 120px;
        height: 113px;
        font-size: 14px;
        padding: 4px;
    }
    .game-roller {margin: 0px auto;}
    .eroller.er-ver {width: 200px!important;height: 200px!important;}
    .eroller .er-inner {
        z-index: 1;
        overflow: hidden;
        position: relative;
        /*display: inline-block;*/
        -webkit-transform: translateX(0);
        transform: translateX(0);
        text-align: center;
        margin: 0;
    }
    .eroller .er-item {
        position: relative;
        width: 150px!important;
        height: 150px!important;
        line-height: 47px;
        border-radius: 6px;
        display: inline-block;
        vertical-align: middle;
        text-align: center;
        margin: 0px;
        font-size: 100%;
        font-weight: 700;
        border: 0px solid #fefefe;
        color: transparent;
        /*background-color: rgb(75, 75, 75);*/
        overflow: hidden;
        padding: 0.2px;
    }
</style>

<div class="col-md-12 col-sm-12 mt-2 mb-4">
    <div class="col-12">
        <div class="game-roller">
            <div class="roller" id="roller-1"></div>
        </div>
    </div>
    

</div>
<div class="col-md-4 col-sm-12 mt-2"></div>
<div class="col-md-4 col-sm-12 mt-2">
    <div class="col-12 text-center">
        <span class="badge rounded-pill bg-light" style="font-size: 1.1rem;">
            <small style="color:#000">คุณคงเหลือ : <i class="fa-solid fa-coins"></i> <span id="pointnow"><?=number_format($users_point,2)?></span> เครดิต</small> 
        </span><br>
        <small style="color:#fff">ของรางวัลคือบัตร Steam Wallet 50 - 1,000 บาท<br>
        <a href="page/inventory" class="alert-link" style="text-decoration:none"><i class="fa-solid fa-clock-rotate-left"></i> ประวัติการรับของรางวัล</a></small><br>

        <span class="badge rounded-pill bg-danger" style="font-size: 0.8rem;">
            <small style="color:#fff">เมื่อกดสุ่มแล้วไม่สามารถขอคืนเครดิตได้ในทุกกรณี</small> 
        </span>
        <div class="col-12 mt-3">
            <button type="button" spin-buttonid="ff" class="start-spin btn btn-primary w-100">เริ่มการสุ่ม ( 10 เครดิต )</button>

        </div>
    </div>
</div>
<div class="col-md-4 col-sm-12 mt-2"></div>


<script>
function getDuplicates(array) {
    var sorted_arr = array.slice().sort();
    var results = [];
    var c = 0;
    for (var i = 0; i < sorted_arr.length - 1; i++) {
        if (sorted_arr[i + 1] == sorted_arr[i]) {
            results[c] = sorted_arr[i];
            c++;
        }
    }
    return results;
}
var audio = new Audio('assets/media/new.mp3');
var audiotick = new Audio('assets/media/wheel_tick.mp3');
var audiolost = new Audio('assets/media/effect-lost.mp4');
var audiowin = new Audio('assets/media/effect-win.mp4');

audio.volume = 0.2;
audiowin.volume = 0.2;
audiolost.volume = 0.2;
jQuery(document).ready(function($){
    var eroller1 = false;
    var eroller2 = false;
    var eroller3 = false;
   
    var aee = new Array(5, 6, 7);
    var winner_msg;
    var ajax_msg;
    var ajax_point;
    var items1 = [
        <?php 
        $result_reward = $connect->query("SELECT * FROM tbl_item_rewards WHERE game = 'roller'");
        $res_rewards = $result_reward->fetch_all(MYSQLI_ASSOC);
        $i= 1;
        foreach($res_rewards as $res_reward) :  ?>
        {
            id: <?=$i++?>,
            text: '<img class="img-fluid" src="<?=$res_reward['img']?>" style="background-image: radial-gradient(<?=$res_reward['color'] ?>,#0E0E0E);">',
            value: <?=$res_reward['id']?>,
        },
        <?php endforeach; ?>
    ];
    

    $('#roller-1').eroller({
        items  : items1,
        key    : 'text',
    });

   
    var id = $(this).attr("spin-buttonid")

    $(document).on('click','.start-spin',function() {
        $("#roller-1 .er-indicator").prop("style", "");
        var directions = ["left","right"];
        audio.play();


        
        
        var id = $(this).attr("spin-buttonid")
        var formData = {
            'id': 'code' //for get code 
        };

        $.ajax({
            url: "idpass.php?roller_api",
            type: "POST",
            data: formData,
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function (res) {
                if (res.status == 200) {
                    $(".start-spin").prop("disabled", true);
                    $(".start-spin").html("รอสักครู่...");
                    $(".roller").eroller('start', 'value', res.valueid);
                    
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

    $(document).on('eroller.complete','#roller-1',function(event,item){
        eroller1 = true;
        audiotick.volume = 0.3;
        audiotick.play();
        
        $("#roller-1 .er-indicator").prop("style", "background-color: #3fff00;");

        $( "#return" ).html( popup );
        $('#pointnow').html(pointnow);
        $(".start-spin").attr("disabled", false);
        $(".start-spin").html("เริ่มการสุ่ม");
        eroller1 = false;

    });

    

});
</script>