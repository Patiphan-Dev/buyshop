<div class="col-md-12 col-sm-12 mt-2">
    <div class="card-header text-white"><i class="fa-solid fa-screwdriver-wrench"></i> Setting Game - ตั้งค่าเกม</div>
</div>

<div class="col-md-6 col-sm-12 mt-2">
    <div class="card crad_tung text-white mb-3">
        <div class="card-header"><i class="fa-solid fa-folder-plus"></i> Edit Rewards - แก้ไขรางวัล</div>
        <div class="card-body mb-6">

            <?php
            if (!preg_match('/^[a-zA-Z0-9\_]*$/', @$_GET['id'])) {
                $idgmae = 1;
            }else{
                $idgmae = $connect->real_escape_string(@$_GET['id']);
            }

            $result_reward_check = $connect->query("SELECT * FROM tbl_item_rewards WHERE id = '".$idgmae."'")->num_rows;
            $result_reward_edit = $connect->query("SELECT * FROM tbl_item_rewards WHERE id = '".$idgmae."'")->fetch_assoc();
            $res_value = str_replace("|","-",$result_reward_edit['value']);
            if(strpos($res_value, '-') === false){
                $res_value = "";
            }
            if($result_reward_check == 0):
            ?>
            <div class="alert alert-dismissible alert-success">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong>Well done!</strong>successfully. you can <a href="?page=manage&admin=game" class="alert-link">Add new Rewards.</a>.
            </div>
            <?php else: ?>

            <div class="form-group">
                <div class="text-center pointer">
                    <img src="<?=$result_reward_edit['img']?>" alt="<?=$result_reward_edit['img']?>" width="17%" id="output" onclick="click_image()">
                </div>
            </div>
            <div class="form-group">
                <label for="formFile" class="form-label mt-4"><i class="fa-solid fa-caret-right"></i> รูปของรางวัล <span class="badge rounded-pill bg-warning" style="font-size: 0.9rem;" >ขนาด 200x200px</span></label>
                <input class="form-control" type="file" id="photo" accept="image/*" onchange="loadFile(event)">
                <span id="msg" style="color:red"></span>
            </div>
            <div class="form-group row">
                <div class="form-group col-md-6">
                    <label for="formFile" class="form-label mt-2"><i class="fa-solid fa-caret-right"></i> ชื่อรางวัล</label>
                    <input class="form-control" type="text" id="name" placeholder="บัตร Truemoney 1,000 บาท" value="<?=$result_reward_edit['name']?>">
                    <input type="hidden" id="idre" value="<?=$result_reward_edit['id']?>">
                </div>
                <div class="form-group col-md-6">
                    <label class="col-form-label" for="inputDefault"><i class="fa-solid fa-caret-right"></i> เกมที่ต้องการเพิ่มรางวัล</label>
                    <select name="typegame" class="form-control" id="typegame">
                        <option value="spin" <?php if($result_reward_edit['game'] == "spin"){ echo "selected"; } ?>>Game Spin</option>
                        <option value="roller" <?php if($result_reward_edit['game'] == "roller"){ echo "selected"; } ?>>Game Roller</option>
                        <option value="slot" <?php if($result_reward_edit['game'] == "slot"){ echo "selected"; } ?>>Game Slot</option> 
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="form-group col-md-4">
                    <label class="col-form-label" for="inputDefault"><i class="fa-solid fa-caret-right"></i> ประเภทของรางวัล</label>
                    <select name="typereward" class="form-control" id="typereward">
                        <option value="0" <?php if($result_reward_edit['type'] == "0"){ echo "selected"; } ?>>เลิอกประเภทของรางวัล</option>
                        <option value="1" <?php if($result_reward_edit['type'] == "1"){ echo "selected"; } ?>>เกลือ</option>
                        <option value="2" <?php if($result_reward_edit['type'] == "2"){ echo "selected"; } ?>>เครดิต</option>
                        <option value="3" <?php if($result_reward_edit['type'] == "3"){ echo "selected"; } ?>>Gif Code หรือ บัตรเติมเงิน</option> 
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="formFile" class="form-label mt-2"><i class="fa-solid fa-caret-right"></i> ผลรางวัลกรณีเป็นเครดิต</label>
                    <input class="form-control" type="text" id="valuerewards" placeholder="เช่น 5 ถึง 10 ให้ใส่ 5-10" value="<?=$res_value?>">
                </div>

                <div class="form-group col-md-4">
                    <label for="formFile" class="form-label mt-2"><i class="fa-solid fa-caret-right"></i> สีพิ้นหลังรางวัล</label>
                    <input class="form-control form-control-color" type="color" id="colorrewards" placeholder="FFCC00" value="<?=$result_reward_edit['color']?>">
                </div>

            </div>
           
            
            

            <div class="form-group">
                <label for="formFile" class="form-label mt-2"><i class="fa-solid fa-caret-right"></i> เปอร์เซ็นการออกรางวัล <span class="badge rounded-pill bg-info" style="font-size: 0.9rem;" id="valBox"><?=$result_reward_edit['percent']?> %</span></label>
                <input type="range" class="form-range" id="percent" onchange="showVal()" value="<?=$result_reward_edit['percent']?>">
            </div>

            <div class="form-group mt-4">
                <a onclick="ok_rewards()" class="btn btn-primary w-100"><i class="fa-solid fa-folder-plus"></i> Add Rewards - เพิ่มรางวัล</a>
            </div>


            <?php endif ;?> 


        </div>
    </div>
</div>
<?php
if(@$_GET['g']=="spin"){
    $g_game = "spin";
}else if(@$_GET['g']=="roller"){
    $g_game = "roller";
}else if(@$_GET['g']=="slot"){
    $g_game = "slot";
}else{
    $g_game = "spin";
}
?>
<div class="col-md-6 col-sm-12 mt-2">
    <div class="card crad_tung text-white mb-3">
        <div class="card-header"><i class="fa-solid fa-caret-right" style="color:#F186A9;"></i> Rewards - รางวัล <?=$g_game?></div>
        <div class="card-body">
            <div class="text-center mb-4">
                <a href="?page=manage&admin=game&g=spin" class="hvr-icon-up btn btn-primary mb-2"><i class="hvr-icon fa-regular fa-file-lines"></i> รางวัล Game Spin</a>
                <a href="?page=manage&admin=game&g=roller" class="hvr-icon-up btn btn-primary mb-2"><i class="hvr-icon fa-regular fa-file-lines"></i> รางวัล Game Roller</a>
                <a href="?page=manage&admin=game&g=slot" class="hvr-icon-up btn btn-primary mb-2"><i class="hvr-icon fa-regular fa-file-lines"></i>  รางวัล Game Slot</a>
            </div>
        <style>
        table, th, td {
            padding: 5px;
        /* border: 1px solid black; */
        }
        </style>
        <div class="table-responsive">
            <table class="" width="100%">
                <tr>
                    <th style="text-align:center"><i class="fa-solid fa-hashtag"></i></th>
                    <th style="text-align:center"><i class="fa-solid fa-images"></i> Image</th>
                    <th style="text-align:center"><i class="fa-solid fa-gift"></i> Name</th>
                    <th style="text-align:center"><i class="fa-solid fa-percent"></i> Percent</th>
                    <th style="text-align:center"><i class="fa-solid fa-tags"></i> Type</th>
                    <th style="text-align:center"><i class="fa-solid fa-sliders"></i> Manage</th>
                </tr>
            <?php 
            $result_reward = $connect->query("SELECT * FROM tbl_item_rewards WHERE game = '".$g_game."';");
            $res_rewards = $result_reward->fetch_all(MYSQLI_ASSOC);
            $i= 1;
            foreach($res_rewards as $res_reward) : 
            ?>
                <tr>
                    <td style="text-align:center"><?=$i++;?>.</td>
                    <td style="text-align:center;background-color: <?=$res_reward['color'];?>;"><img src="<?=$res_reward['img'];?>" alt="<?=$res_reward['img'];?>" width="50px"></td>
                    <td style="text-align:center;"><?=$res_reward['name'];?></td>
                    <td style="text-align:right"><?=$res_reward['percent'];?>%</td>
                    <td style="text-align:center">
                        <?php 
                        if($res_reward['type'] == 1){
                            echo "เกลือ";
                        }else if($res_reward['type'] == 2){
                            echo "เครดิต";
                        }else if($res_reward['type'] == 3){
                            echo "Gif Code";
                        }else{
                            echo "ไม่มีระบุ";
                        }
                        ?>
                    </td>
                    <td style="text-align:right">
                        <?php if($res_reward['type'] == 3):?>
                        <a href="?page=manage&admin=addcode&id=<?=$res_reward['id'];?>&g=<?=$g_game?>" class="hvr-icon-up btn btn-success btn-sm mb-2"><i class="hvr-icon fa-solid fa-square-plus"></i></a>
                        <?php endif;?>
                        <a href="?page=manage&admin=editgame&id=<?=$res_reward['id'];?>&g=<?=$g_game?>" class="hvr-icon-up btn btn-info btn-sm mb-2"><i class="hvr-icon fa-solid fa-pen-to-square"></i></a>
                        <a onclick="delete_rewards(<?=$res_reward['id'];?>)" class="hvr-icon-up btn btn-danger btn-sm mb-2"><i class="hvr-icon fa-solid fa-trash-can"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </table>   
        </div>

        </div>
    </div>
</div>

<script>
    var loadFile = function(event) {
        var reader = new FileReader();
        reader.onload = function(){
        var output = document.getElementById('output');
        output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    };

    function showVal(){
        percent = $('#percent').val();
        document.getElementById("valBox").innerHTML = percent + ' %';
    }

    function click_image(){
        $('#photo').click();
    }

    function ok_rewards(){

        var vidFileLength = $("#photo")[0].files.length;
        // if(vidFileLength === 0){
        //     $('#msg').html('กรุณาเลือกรูปภาพ');
        //     return false;
        // }
        var property = document.getElementById('photo').files[0];
        var form_data = new FormData();
        form_data.append("file", property);
        // form_data.append("urlimg", $('#urlimg').val());
        form_data.append("idre", $('#idre').val());
        form_data.append("name", $('#name').val());
        form_data.append("typegame", $('#typegame').val());
        form_data.append("typereward", $('#typereward').val());
        form_data.append("valuerewards", $('#valuerewards').val());
        form_data.append("colorrewards", $('#colorrewards').val());
        form_data.append("percent", $('#percent').val());
        $.ajax({
            url: 'manage.php?update_rewards',
            method: 'POST',
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $('#msg').html('Loading......');
            },
            success: function(data) {
                $("#btn").prop("disabled", true);
                $( "#return" ).html( data );
                $("#btn").prop("disabled", false); 
            }
        });
    }
</script>