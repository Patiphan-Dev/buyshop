<style>
    #preview-parent {
    /* display: flex; */
    /* flex-direction: column; */
    /* flex-direction: row; */
    /* width: auto; */
    }
    .preview {
    display: flex;
    flex-direction: column;
    margin: 1rem;
    }
    img {
    width: auto;
    height: auto;
    object-fit: cover;
    }
</style>

<?php
    if (!preg_match('/^[a-zA-Z0-9\_]*$/', @$_GET['id'])) {
        $idshop = 1;
    }else{
        $idshop = $connect->real_escape_string(@$_GET['id']);
    }

    $result_shop_check = $connect->query("SELECT * FROM tbl_shop_id WHERE id = '".$idshop."'")->num_rows;
    $result_shop_edit = $connect->query("SELECT * FROM tbl_shop_id WHERE id = '".$idshop."'")->fetch_assoc();
?>

<div class="col-md-12 col-sm-12 mt-2" data-aos="zoom-in">
    <div class="card crad_tung text-white mb-3">
        <div class="card-header"><i class="fa-solid fa-box-open" style="color:#F186A9;"></i> Shop - จัดการสินค้า</div>
        <div class="card-body">
            <a href="?page=manage&admin=manageshop&t=<?=$result_shop_edit['shoptype']?>" class="btn btn-danger"><i class="fa-solid fa-circle-chevron-left"></i> กลับ</a>


            <div class="form-group row">
                <div class="form-group col-md-3">
                    <label for="formFile" class="form-label mt-2"><i class="fa-solid fa-chevron-right"></i> ชื่อสินค้า</label>
                    <input class="form-control" type="text" id="shopname" placeholder="ชื่อสินค้า" value="<?=$result_shop_edit['name']?>">
                    <input type="hidden" id="shopid" value="<?=$result_shop_edit['id']?>">
                </div>

                <div class="form-group col-md-3">
                    <label for="formFile" class="form-label mt-2"><i class="fa-solid fa-chevron-right"></i> ประเภทสินค้า</label>
                    <select class="form-control" name="shoptype" id="shoptype">
                        <option value="0">กรุณาเลือกประเภทสินค้า</option>
                        <option value="1" <?php if($result_shop_edit['shoptype'] == 'idgame'){ echo "selected"; }?>>ไอดีหรือรหัสเกม</option>
                        <option value="2" <?php if($result_shop_edit['shoptype'] == 'account'){ echo "selected"; }?>>บัญชี</option>
                    </select>
                </div>

                <div class="form-group col-md-2">
                    <label for="formFile" class="form-label mt-2"><i class="fa-solid fa-chevron-right"></i> หมวดหมู่ <a href="?page=manage&admin=category"> เพิ่มหมวดหมู่</a></label>
                    <?php 
                    $result_category = $connect->query("SELECT * FROM tbl_game");
                    $res_categorys = $result_category->fetch_all(MYSQLI_ASSOC);
                    ?>
                    <select class="form-control" name="category" id="category">
                        <option value="0">กรุณาเลือกหมวดหมู่</option>
                        <?php foreach($res_categorys as $res_category) : ?>
                        <option value="<?=$res_category['id']?>" <?php if($result_shop_edit['gameid'] == $res_category['id']){ echo "selected"; }?>><?=$res_category['name']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group col-md-2">
                    <label for="formFile" class="form-label mt-2"><i class="fa-solid fa-chevron-right"></i> ราคาปกติ</label>
                    <input class="form-control" type="text" id="point" placeholder="ราคา" value="<?=$result_shop_edit['point']?>">
                </div>
                <div class="form-group col-md-2">
                    <label for="formFile" class="form-label mt-2"><i class="fa-solid fa-chevron-right"></i> ราคาพิเศษ</label>
                    <input class="form-control" type="text" id="pointv" placeholder="ราคา" value="<?=$result_shop_edit['pointv']?>">
                </div>
            </div>

            <div class="form-group row">
                <div class="form-group mb-2 col-md-6">
                    <label class="col-form-label" for="inputDefault"><i class="fa-solid fa-chevron-right"></i> ข้อมูลสินค้าแสดงหน้าเว็บ</label>
                    <textarea id="name" class="summernote" name="name" rows="5" ><?=$result_shop_edit['publish_info']?></textarea>
                </div>
                <div class="form-group mb-2 col-md-6">
                    <label class="col-form-label" for="inputDefault"><i class="fa-solid fa-chevron-right"></i> ข้อมูลลับ <span class="badge rounded-pill bg-danger" style="font-size: 0.9rem;"> เห็นเฉพาะผู้ซื้อและผู้ขายเท่านั้น!!</span></label>
                    <?php $infosecret = openssl_decrypt($result_shop_edit['secret_info'], $ciphering, $decryption_key, $options, $decryption_iv);?>
                    <textarea id="secret_info" class="form-control" name="secret_info" rows="3" placeholder="ตัวอย่าง id:asdzxc123 pass:123465"><?=$infosecret?></textarea>
                    
                    <textarea id="img_info" hidden name="img_info" rows="5" >
                        <?=$result_shop_edit['img']?>
                    </textarea>
                </div>

            </div>
            <div class="form-group row">                
                <div class="form-group mb-2 col-md-6">
                    <label class="col-form-label" for="inputDefault"><i class="fa-solid fa-chevron-right"></i> รูปสินค้า</label>
                    <input class="form-control" type="file" name="images[]" id="input" multiple accept="image/*" >
                    
                </div>
                <div class="form-group mb-3 col-md-6 mt-4" >
                    <button onclick="history.go(0)" class="btn btn-danger w-100 mb-2"><i class="fa-solid fa-rotate-right"></i> ย้อนกลับ</button>
                    <button onclick="ok_shop()" class="btn btn-primary w-100"><i class="fa-solid fa-circle-check"></i> แก้ไขข้อมูล</button>
                </div>
                <div class="form-group mb-2 col-md-12">
                    <div class="form-group row">
                        <div id="preview-parent"></div>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <?php
                    $result_shop = explode(',', $result_shop_edit['img']);
                    foreach($result_shop as $i =>$result_shops): 
                     if(!empty($result_shops)):
                    ?>
                    <div class="form-group mb-2 col-md-3" id="showImgId<?=$i?>">
                        <img src="<?=$result_shops?>" alt="server" class="w-100">
                        <button class="btn btn-danger w-100 mb-2 mt-2" onclick="deleteImg('<?=$result_shops?>',<?=$i?>)">ลบ</button>
                    </div>
                <?php endif; ?>
                <?php endforeach; ?>

            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
    function deleteImg(img, id) {
        // var name = document.getElementById('img_info');
        var textarea = document.getElementById('img_info');
        var data = textarea.value;
        textarea.value = textarea.value.replaceAll(img+'', '');
        document.getElementById("showImgId"+id).remove();
    }
    
    // DataTransfer allows updating files in input
    var dataTransfer = new DataTransfer()

    const form = document.querySelector('#form')
    const input = document.querySelector('#input')

    input.addEventListener('change', () => {

    let files = input.files
    // var formGroupRow = document.querySelector('.form-group.row:nth-child(4)');
    for (let i = 0; i < files.length; i++) {
        // A new upload must not replace images but be added
        dataTransfer.items.add(files[i])

        // Generate previews using FileReader
        let reader, preview, previewImage
        reader = new FileReader()
        preview = document.createElement('div')
        previewImage = document.createElement('img')
        deleteButton = document.createElement('button')
        orderInput = document.createElement('input')

        preview.classList.add('preview')
        preview.classList.add('col-md-6')
        preview.classList.add('col-sm-12')
        document.querySelector('#preview-parent').appendChild(preview)

        deleteButton.setAttribute('data-index', i)
        deleteButton.setAttribute('class', 'btn btn-sm btn-danger mt-2')
        deleteButton.setAttribute('onclick', 'deleteImage(this)')
        deleteButton.innerText = 'Delete'
        orderInput.type = 'hidden'
        orderInput.name = 'images_order[' + files[i].name + ']'

        preview.appendChild(previewImage)
        preview.appendChild(deleteButton)
        preview.appendChild(orderInput)
        preview.appendChild(orderInput)

        reader.readAsDataURL(files[i])
        reader.onloadend = () => {
        previewImage.src = reader.result
        }
    }

    // Update order values for all images
    updateOrder()
    // Finally update input files that will be sumbitted
    input.files = dataTransfer.files
    })

    const updateOrder = () => {
    let orderInputs = document.querySelectorAll('input[name^="images_order"]')
    let deleteButtons = document.querySelectorAll('button[data-index]')
    for (let i = 0; i < orderInputs.length; i++) {
        orderInputs[i].value = [i]
        deleteButtons[i].dataset.index = [i]
        
        // Just to show that order is always correct I add index here
        deleteButtons[i].innerText = 'ลบรูป (' + i + ')'
    }
    }

    const deleteImage = (item) => {
    // Remove image from DataTransfer and update input
    dataTransfer.items.remove(item.dataset.index)
    input.files = dataTransfer.files
    // Delete element from DOM and update order
    item.parentNode.remove()
    updateOrder()
    }

    // I make the images sortable by means of SortableJS
    const el = document.getElementById('preview-parent')
    new Sortable(el, {
    animation: 150,
    ghostClass: "sortablejs-custom-chosen-child",

    // Update order values every time a change is made
    onEnd: (event) => {
        updateOrder()
    }
    })

    function ok_shop(){

        var vidFileLength = $("#input")[0].files.length;
        // if(vidFileLength === 0){
        //     $('#msg').html('กรุณาเลือกรูปภาพ');
        //     return false;
        // }
        var property = document.getElementById('input').files[0];
        var form_data = new FormData();
        // Read selected files
        var totalfiles = document.getElementById('input').files.length;
        for (var index = 0; index < totalfiles; index++) {
            form_data.append("file[]", document.getElementById('input').files[index]);
        }
        // form_data.append("file[]", property);
        // form_data.append("urlimg", $('#urlimg').val());
        form_data.append("shopid", $('#shopid').val());
        form_data.append("category", $('#category').val());
        form_data.append("img_info", $('#img_info').val());
        form_data.append("shopname", $('#shopname').val());
        form_data.append("shoptype", $('#shoptype').val());
        form_data.append("category", $('#category').val());
        form_data.append("name", $('#name').val());
        form_data.append("secret_info", $('#secret_info').val());
        form_data.append("point", $('#point').val());
        form_data.append("pointv", $('#pointv').val());
        $.ajax({
            url: 'manage.php?edit_shop_id',
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