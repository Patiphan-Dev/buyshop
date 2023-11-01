<script src="assets/js2/jquery.min.js"></script>
<link rel="stylesheet" href="assets/roller/eroller.css">
<link rel="stylesheet" href="assets/roller/prism.css">
<script src="assets/roller/prism-min.js"></script>
<script src="assets/roller/eroller.js"></script>
<style>
    .game-roller {margin: 0px auto;}
	.eroller.er-ver {width: 200px!important;height: 200px!important;}
	.eroller .er-inner {
    z-index: 1;
    overflow: hidden;
    position: relative;
    display: inline-block;
    -webkit-transform: translateX(0);
    transform: translateX(0);
    text-align: center;
    margin: 0;
	}
	.eroller .er-item {
    position: relative;
    width: 200px!important;
    height: 200px!important;
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
    background-color: rgb(75, 75, 75);
    overflow: hidden;
    padding: 1px;
	}
	.eroller .er-item img {
		width: 200px!important;
	}


	@media (min-width: 576px) and (max-width: 767.98px) {
		.game-roller .roller-1 ,
		.game-roller .roller-2 ,
		.game-roller .roller-3{
			height: 120px!important;
		}
		.eroller.er-ver {width: 120px!important;height: 120px!important;}
		.eroller .er-item {
	    width: 120px!important;
	    height: 120px!important;
		}
		.eroller .er-item img {
			width: 120px!important;
		}
	}

	@media (max-width: 575.98px) {
		.game-roller .roller-1 ,
		.game-roller .roller-2 ,
		.game-roller .roller-3{
			height: 100px!important;
		}
		.eroller.er-ver {width: 100px!important;height: 100px!important;}
		.eroller .er-item {
	    width: 100px!important;
	    height: 100px!important;
		}
		.eroller .er-item img {
			width: 100px!important;
		}
	}

  
</style>


<div class="col-md-12 col-sm-12 mt-4 text-center">


    <div class="game-roller">
        <div class="roller-1"></div>
        <div class="roller-2"></div>
        <div class="roller-3"></div>

        <div class="row mt-4">
        <div class="col-md-4 col-sm-12"></div>
        <div class="col-md-4 col-sm-12 text-center">
            <span class="badge rounded-pill bg-light" style="font-size: 1.1rem;">
                <small style="color:#000">คุณคงเหลือ : <i class="fa-solid fa-coins"></i> <span id="pointnow"><?=number_format($users_point,2)?></span> เครดิต</small> 
            </span><br>
            <small style="color:#fff">ของรางวัลคือบัตร บัตรทรู 50 - 1,000 บาท<br> Steam Wallet 50 - 1,000 บาท<br>
            <a href="page/inventory" class="alert-link" style="text-decoration:none"><i class="fa-solid fa-clock-rotate-left"></i> ประวัติการรับของรางวัล</a></small><br>

            <span class="badge rounded-pill bg-danger" style="font-size: 0.8rem;">
                <small style="color:#fff">เมื่อกดสุ่มแล้วไม่สามารถขอคืนเครดิตได้ในทุกกรณี</small> 
            </span>

            <div class="col-lg-12 mt-3 mb-3">
                <button type="button" spin-buttonid="ff" class="start-spin btn btn-info w-100">เริ่มการสุ่ม ( 10 เครดิต )</button>
            </div>

        </div>
        <div class="col-md-4 col-sm-12"></div>

        </div>
        
    </div>


</div>


<script>

    var audio = new Audio('assets/media/new.mp3');
    var audiotick = new Audio('assets/media/wheel_tick.mp3');
    var audiolost = new Audio('assets/media/effect-lost.mp4');
    var audiowin = new Audio('assets/media/effect-win.mp4');
    audio.volume = 0.2;
    audiowin.volume = 0.2;
    audiolost.volume = 0.2;
   
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

jQuery(document).ready(function($){
    var items = [
      <?php 
        $result_reward = $connect->query("SELECT * FROM tbl_item_rewards WHERE game = 'slot'");
        $res_rewards = $result_reward->fetch_all(MYSQLI_ASSOC);
        $i= 1;
        foreach($res_rewards as $res_reward) :  ?>
        {
            id: <?=$i++?>,
            text: '<img class="img-fluid" src="<?=$res_reward['img']?>" style="background-image: radial-gradient(<?=$res_reward['color'] ?>,#0E0E0E);">',
            value: <?=$res_reward['id']?>,
            // message: 'คุณได้รับบัตร Truemoney 1,000 บาท',
        },
        <?php endforeach; ?>
            
    ];

  $('.roller-1 ,.roller-2 ,.roller-3').eroller({
    items  : items,
    key    : 'text',
    align   : 'vertical',
  });

  var id = $(this).attr("spin-buttonid")

  var game_status;
  var game_result;
  var game_point;
  // Buttons
  $('.game-roller').on('click','.start-spin',function(){
    audio.play();
    var id = $(this).attr("spin-buttonid")
    var formData = {
        'id': 'code' //for get code 
    };

    $.ajax({
        url: "idpass.php?slot_api",
        type: "POST",
        data: formData,
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function (res) {
            if (res.status == 200) {
                $('.game-roller .roller-1').eroller('start','value', res.valueid1, 5000);
                $('.game-roller .roller-2').eroller('start','value', res.valueid2, 4500);
                $('.game-roller .roller-3').eroller('start','value', res.valueid3, 4000);
                $(".start-spin").html("รอสักครู่...");
                $(".game-roller .start-spin").prop("disabled", true);
                
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
  
  //Events
  var winners = [],calc = 0;
  $('.game-roller').on('eroller.complete','.roller-1 ,.roller-2 ,.roller-3',function(event,item){
    
    winners[calc] = item.value;
    ++calc;
    if(calc === 3){

      $( "#return" ).html( popup );
      $('#pointnow').html(pointnow);
      $(".start-spin").html("เริ่มการสุ่ม");
      $(".game-roller .start-spin").prop("disabled", false);
      calc = 0;

    }


  });
});
</script>