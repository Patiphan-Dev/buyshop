<div class="col-md-6 col-sm-12 mt-2" data-aos="zoom-in">
    <div class="card crad_tung text-white mb-3">
        <div class="card-header"><i class="fa-solid fa-caret-right" style="color:#F186A9;"></i> รูปภาพสไลด์</div>
        <div class="card-body">

            <?php
            if (!preg_match('/^[a-zA-Z0-9\_]*$/', @$_GET['id'])) {
                $idgmae = 1;
            } else {
                $idgmae = $connect->real_escape_string(@$_GET['id']);
            }

            $result_slide_check = $connect->query("SELECT * FROM tbl_slide WHERE id = '" . $idgmae . "'")->num_rows;
            $result_slide_edit = $connect->query("SELECT * FROM tbl_slide WHERE id = '" . $idgmae . "'")->fetch_assoc();
            if ($result_slide_check == 0) :
            ?>
                <div class="alert alert-dismissible alert-success">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong>Well done!</strong>successfully. you can <a href="?page=manage&admin=img_slide" class="alert-link">Add new Image Slide</a>.
                </div>
            <?php else : ?>
                <div class="form-group">
                    <div class="text-center pointer">
                        <img src="assets/img/slide/<?= $result_slide_edit['img'] ?>" alt="null" width="20%" id="output" onclick="click_image()">
                    </div>
                </div>
                <div class="form-group">
                    <label for="formFile" class="form-label mt-4">รูปภาพสไลด์ <span class="badge rounded-pill" style="font-size: 1rem;"></span></label>
                    <input class="form-control" type="file" id="photo" accept="image/*" onchange="loadFile(event)">
                    <!-- <input class="form-control" type="text" id="urlimg" placeholder="https://xspin/true50.jpg" value="<?= $stockcards['img'] ?>"> -->
                    <span id="msg" style="color:red"></span>
                </div>
                <div class="form-group">
                    <label for="formFile" class="form-label mt-2">ความสูง</label>
                    <input class="form-control" type="text" id="height" placeholder="300px" value="<?= $result_slide_edit['height'] ?>">
                </div>
                <div class="form-group mt-4">
                    <a onclick="editslide()" class="btn btn-info w-100"><i class="fa-solid fa-folder-plus"></i> อัพเดทสไลด์</a>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>
<div class="col-md-6 col-sm-12 mt-2" data-aos="zoom-in">
    <div class="card crad_tung text-white mb-3">
        <div class="card-header"><i class="fa-solid fa-caret-right" style="color:#F186A9;"></i> รูปภาพสไลด์ที่มี</div>
        <div class="card-body">

            <table width="100%">
                <?php
                $result_category = $connect->query("SELECT * FROM tbl_slide");
                $res_categorys = $result_category->fetch_all(MYSQLI_ASSOC);
                $i = 1;
                foreach ($res_categorys as $res_category) :
                ?>
                    <tr>
                        <td style="text-align:left"><?= $i++; ?>.</td>
                        <td style="text-align:center"><img src="assets/img/slide/<?= $res_category['img']; ?>" alt="<?= $res_category['img']; ?>" height="50px" width="200px"></td>
                        <!-- <td style="text-align:left"><?= $res_category['img']; ?></td> -->
                        <td style="text-align:left">
                            <?php
                            if ($res_category['id_img'] == 1) {
                                echo '<i class="fa-solid fa-toggle-on fa-xl pointer" style="color:#08B000;" onclick="on_showslide(' . $res_category['id'] . ')"> </i> ภาพแรก';
                            } else {
                                echo '<i class="fa-solid fa-toggle-off fa-xl pointer" style="color:#dee81e;" onclick="on_showslide(' . $res_category['id'] . ')"> </i> ปกติ';
                            }
                            ?>

                        </td>
                        <td style="text-align:right">
                            <a href="?page=manage&admin=img_slide_edit&id=<?= $res_category['id']; ?>" class="hvr-icon-up btn btn-info btn-sm"><i class="hvr-icon fa-solid fa-pen-to-square"></i> แก้ไข</a>
                            <a onclick="delete_slide(<?= $res_category['id']; ?>)" class="hvr-icon-up btn btn-danger btn-sm"><i class="hvr-icon fa-solid fa-trash-can"></i> ลบ</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>
    </div>
</div>

<script>
    var loadFile = function(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('output');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    };

    function click_image() {
        $('#photo').click();
    }

    function addslide() {

        var vidFileLength = $("#photo")[0].files.length;
        if (vidFileLength === 0) {
            $('#msg').html('กรุณาเลือกรูปภาพ');
            return false;
        }
        var property = document.getElementById('photo').files[0];
        // var size = $('#photo')[0].files[0].size;
        // if(size > 100000 ){
        //     $('#msg').html('ขนาดไฟล์ต้องไม่เกิน 10 mb.');
        //     return false;
        // }
        // var image_name = property.name;
        // var image_extension = image_name.split('.').pop().toLowerCase();

        // if (jQuery.inArray(image_extension, ['jpg', 'jpeg', 'png']) == -1) {
        //     $('#msg').html('นามสกุลไฟล์ไม่ถูกต้อง');
        //     return false;
        // }
        var form_data = new FormData();
        form_data.append("file", property);
        form_data.append("height", $('#height').val());
        // form_data.append("urlimg", $('#urlimg').val());
        $.ajax({
            url: 'manage.php?add_slide',
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
                $("#return").html(data);
                $("#btn").prop("disabled", false);
            }
        });
    }

    function editslide() {

        var vidFileLength = $("#photo")[0].files.length;
        // if(vidFileLength === 0){
        //     $('#msg').html('กรุณาเลือกรูปภาพ');
        //     return false;
        // }
        var property = document.getElementById('photo').files[0];
        var form_data = new FormData();
        form_data.append("file", property);
        // form_data.append("urlimg", $('#urlimg').val());
        form_data.append("photo", $('#photo').val());
        form_data.append("height", $('#height').val());
        $.ajax({
            url: 'manage.php?edit_slide',
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
                $("#return").html(data);
                $("#btn").prop("disabled", false);
            }
        });
    }
</script>