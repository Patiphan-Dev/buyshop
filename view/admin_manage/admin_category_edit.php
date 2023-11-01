
<div class="col-md-6 col-sm-12 mt-2" data-aos="zoom-in">
    <div class="card crad_tung text-white mb-3">
        <div class="card-header"><i class="fa-solid fa-caret-right" style="color:#F186A9;"></i> Manage Category - จัดการหมวดเกม</div>
        <div class="card-body">

        <?php
        
        if (!preg_match('/^[a-zA-Z0-9\_]*$/', $_GET['id'])) {
            $id = 1;
        }else{
            $id = $connect->real_escape_string($_GET['id']);
        }
        $result_category_check = $connect->query("SELECT * FROM tbl_game WHERE id = '".$id."'")->num_rows;
        $result_category_edit = $connect->query("SELECT * FROM tbl_game WHERE id = '".$id."'")->fetch_assoc();
        if($result_category_check == 0):
        ?>
        <div class="alert alert-dismissible alert-success">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong>Well done!</strong>successfully. you can <a href="?page=manage&admin=category" class="alert-link">Add new category</a>.
        </div>
        <?php else: ?>

            <div class="form-group">
                <div class="text-center pointer">
                    <img src="assets/img/game_icon/<?=$result_category_edit['img']?>" alt="null" width="20%" id="output" onclick="click_image()">
                </div>
            </div>
            <div class="form-group">
                <label for="formFile" class="form-label mt-4">รูปหมวดเกม <span class="badge rounded-pill bg-warning" style="font-size: 0.9rem;" >ขนาด 200x200px</span></label>
                <input class="form-control" type="file" id="photo" accept="image/*" onchange="loadFile(event)">
                <input type="hidden" id="idshop" value="<?=$result_category_edit['id']?>">
                <!-- <input class="form-control" type="text" id="urlimg" placeholder="https://xspin/true50.jpg" value="<?=$stockcards['img']?>"> -->
                <span id="msg" style="color:red"></span>
            </div>
            <div class="form-group">
                <label for="formFile" class="form-label mt-2">ชื่อหมวดเกม</label>
                <input class="form-control" type="text" id="name" placeholder="pung" value="<?=$result_category_edit['name']?>">
            </div>
            <div class="form-group">
                <label for="formFile" class="form-label mt-2"></label>
                <select class="form-control" name="typecategory" id="typecategory">
                    <option value="0">กรุณาเลือกประเภท</option>
                    <option value="idgame" <?php if($result_category_edit['typegame'] == 'idgame'){ echo "selected";}?>>ไอดีเกม</option>
                    <option value="account" <?php if($result_category_edit['typegame'] == 'account'){ echo "selected";}?>>บัญชี</option>
                </select>
            </div>
            <div class="form-group">
                <label for="formFile" class="form-label mt-2">แพลตฟอร์ม</label>
                <input class="form-control" type="text" id="platform" placeholder="Steam" value="<?=$result_category_edit['platform']?>">
            </div>

            <div class="form-group mt-4">
                <a onclick="ok_category()" class="btn btn-info w-100"><i class="fa-solid fa-folder-plus"></i> Edit Category - อัพเดทหมวดเกม</a>
            </div>
          <?php endif ;?>          

        </div>
    </div>
</div>
<div class="col-md-6 col-sm-12 mt-2">
    <div class="card crad_tung text-white mb-3">
        <div class="card-header"><i class="fa-solid fa-caret-right" style="color:#F186A9;"></i> Category - หมวดเกมที่มี</div>
        <div class="card-body">
         
        <table width="100%">
        <?php 
        $result_category = $connect->query("SELECT * FROM tbl_game");
        $res_categorys = $result_category->fetch_all(MYSQLI_ASSOC);
        $i= 1;
        foreach($res_categorys as $res_category) : 
        ?>
            <tr>
                <td style="text-align:left"><?=$i++;?>.</td>
                <td style="text-align:center"><img src="assets/img/game_icon/<?=$res_category['img'];?>" alt="<?=$res_category['img'];?>" width="50px"></td>
                <td style="text-align:left"><?=$res_category['name'];?></td>
                <td style="text-align:right">
                    <a href="?page=manage&admin=category_edit&id=<?=$res_category['id'];?>" class="hvr-icon-up btn btn-info btn-sm"><i class="hvr-icon fa-solid fa-pen-to-square"></i> แก้ไข</a>
                    <a onclick="delete_category(<?=$res_category['id'];?>)" class="hvr-icon-up btn btn-danger btn-sm"><i class="hvr-icon fa-solid fa-trash-can"></i> ลบ</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </table>
        <div class="mt-3">
            <a href="?page=manage&admin=category" class="hvr-icon-up btn btn-info btn-sm w-100"><i class="hvr-icon fa-solid fa-plus"></i> เพิ่มหมวดเกม</a>
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

    function click_image(){
        $('#photo').click();
    }

    function ok_category(){

        var vidFileLength = $("#photo")[0].files.length;
        // if(vidFileLength === 0){
        //     $('#msg').html('กรุณาเลือกรูปภาพ');
        //     return false;
        // }
        var property = document.getElementById('photo').files[0];
        var form_data = new FormData();
        form_data.append("file", property);
        // form_data.append("urlimg", $('#urlimg').val());
        form_data.append("name", $('#name').val());
        form_data.append("typecategory", $('#typecategory').val());
        form_data.append("idshop", $('#idshop').val());
        form_data.append("platform", $('#platform').val());
        $.ajax({
            url: 'manage.php?update_category',
            method: 'POST',
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $('#msg').html('Loading......');
            },
            success: function(data) {
                // console.log(data)
                $("#btn").prop("disabled", true);
                $( "#return" ).html( data );
                $("#btn").prop("disabled", false); 
            }
        });
    }
</script>