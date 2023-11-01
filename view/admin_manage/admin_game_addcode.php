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
<div class="col-md-12 col-sm-12 mt-2">
    <div class="card-header text-white"><i class="fa-solid fa-screwdriver-wrench"></i> Setting Game - ตั้งค่าเกม</div>
</div>

<div class="col-md-6 col-sm-12 mt-2">
    <div class="card crad_tung text-white mb-3">
        <div class="card-header"><i class="fa-solid fa-folder-plus"></i> Add Gif Code - เพิ่มรหัสโค้ด</div>
        <div class="card-body mb-6">

            <?php
            if (!preg_match('/^[a-zA-Z0-9\_]*$/', @$_GET['id'])) {
                $idgmae = 1;
            }else{
                $idgmae = $connect->real_escape_string(@$_GET['id']);
            }

            $result_reward_check = $connect->query("SELECT * FROM tbl_item_rewards WHERE id = '".$idgmae."'")->num_rows;
            $result_code = $connect->query("SELECT * FROM tbl_item_rewards WHERE id = '".$idgmae."'")->fetch_assoc();
            
            if($result_code == 0):
            ?>
            <div class="alert alert-dismissible alert-success">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong>Well done!</strong> successfully. you can <a href="?page=manage&admin=game" class="alert-link">Add new Rewards.</a>.
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
            $result_gifcode_check = $connect->query("SELECT * FROM tbl_code_rewards WHERE reward_id = '".$idgmae."'")->num_rows;
            if($result_gifcode_check != 0):
            ?>
            <table width="100%">
                <tr>
                    <th><i class="fa-solid fa-superscript"></i></th>
                    <th><i class="fa-solid fa-gift"></i> Gif Code</th>
                    <th><i class="fa-solid fa-clock"></i> Time</th>
                    <th><i class="fa-solid fa-trash-can"></i> Del</th>
                </tr>
                <?php 
                $result_gifcode = $connect->query("SELECT * FROM tbl_code_rewards WHERE reward_id = '".$idgmae."';");
                $res_gifcodes = $result_gifcode->fetch_all(MYSQLI_ASSOC);
                $i= 1;
                foreach($res_gifcodes as $res_gifcode) : 
                ?>
                    <tr>
                        <td style="text-align:center"><?=$i++;?>.</td>
                        <td style="text-align:center"><?=$res_gifcode['code'];?></td>
                        <td style="text-align:center"><?=th($res_gifcode['timeadd']);?></td>
                        <td style="text-align:right">
                            <a onclick="delete_gifcode(<?=$res_gifcode['id'];?>)" class="hvr-icon-up btn btn-danger btn-sm"><i class="hvr-icon fa-solid fa-trash-can"></i> ลบ</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="4" style="text-align:right">
                        <button class="btn btn-danger btn-sm w-100" onclick="delete_gifcode_all(<?=$idgmae;?>)"><i class="hvr-icon fa-solid fa-trash-can"></i> ลบทั้งหมด</button>
                    </td>
                </tr>
            </table>

            <hr>
            <?php endif; ?>
            
            <div class="form-group row">
                <div class="form-group col-md-12">
                    <label for="formFile" class="form-label mt-2"><i class="fa-solid fa-caret-right"></i> Gif Code - รหัสบัตร</label>
                    <textarea class="form-control" name="code" id="gifcode" rows="7"></textarea>
                    <input type="hidden" id="iditem" value="<?=$result_code['id']?>">
                </div>
                
            </div>

            <div class="form-group row mt-4">
                <div class="form-group col-md-6">
                    <a onclick="add_gifcode()" class="btn btn-primary w-100"><i class="fa-solid fa-folder-plus"></i> Add Gif Code - เพิ่มโค้ด</a>
                </div>
                <div class="form-group col-md-6">
                    <a href="?page=manage&admin=game&g=<?=$g_game?>" class="btn btn-success w-100"><i class="fa-regular fa-circle-left"></i> Back - กลับ</a>
                    
                </div>
            </div>
            <?php endif ;?> 


        </div>
    </div>
</div>

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

