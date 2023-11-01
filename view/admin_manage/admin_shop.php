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

<div class="col-md-12 col-sm-12 mt-2" data-aos="zoom-in">
    <div class="card crad_tung text-white mb-3">
        <div class="card-header"><i class="fa-solid fa-box-open" style="color:#F186A9;"></i> Shop - จัดการสินค้า</div>
        <div class="card-body">

            <div class="form-group row">
                <div class="form-group col-md-3">
                    <label for="formFile" class="form-label mt-2"><i class="fa-solid fa-chevron-right"></i> ชื่อสินค้า</label>
                    <input class="form-control" type="text" id="shopname" placeholder="ชื่อสินค้า">
                </div>

                <div class="form-group col-md-3">
                    <label for="formFile" class="form-label mt-2"><i class="fa-solid fa-chevron-right"></i> ประเภทสินค้า</label>
                    <select class="form-control" name="shoptype" id="shoptype">
                        <option value="0">กรุณาเลือกประเภทสินค้า</option>
                        <option value="1">ไอดีหรือรหัสเกม</option>
                        <option value="2">บัญชี</option>
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
                        <option value="<?=$res_category['id']?>"><?=$res_category['name']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group col-md-2">
                    <label for="formFile" class="form-label mt-2"><i class="fa-solid fa-chevron-right"></i> ราคาปกติ</label>
                    <input class="form-control" type="text" id="point" placeholder="ราคาปกติ">
                </div>
                <div class="form-group col-md-2">
                    <label for="formFile" class="form-label mt-2"><i class="fa-solid fa-chevron-right"></i> ราคาพิเศษ</label>
                    <input class="form-control" type="text" id="pointv" placeholder="ราคาพิเศษ">
                </div>
            </div>

            <div class="form-group row">
                <div class="form-group mb-2 col-md-6">
                    <label class="col-form-label" for="inputDefault"><i class="fa-solid fa-chevron-right"></i> ข้อมูลสินค้าแสดงหน้าเว็บ</label>
                    <textarea id="name" class="summernote" name="name" rows="5" placeholder="https://i.ibb.co/N2wfyw5/750s-1.png" ></textarea>
                </div>
                <div class="form-group mb-2 col-md-6">
                    <label class="col-form-label" for="inputDefault"><i class="fa-solid fa-chevron-right"></i> ข้อมูลลับ <span class="badge rounded-pill bg-danger" style="font-size: 0.9rem;"> เห็นเฉพาะผู้ซื้อและผู้ขายเท่านั้น!!</span></label>
                    <textarea id="secret_info" class="form-control" name="secret_info" rows="3" placeholder="ตัวอย่าง id:asdzxc123 pass:123465"></textarea>
                </div>

            </div>
            <div class="form-group row">                
                <div class="form-group mb-2 col-md-6">
                    <label class="col-form-label" for="inputDefault"><i class="fa-solid fa-chevron-right"></i> รูปสินค้า</label>
                    <input class="form-control" type="file" name="images[]" id="input" multiple accept="image/*" >
                    <div id="msg"></div>
                </div>
                <div class="form-group mb-3 col-md-6 mt-4" >
                    <button onclick="ok_shop()" class="btn btn-primary w-100" style="margin-top:15px;" ><i class="fa-solid fa-circle-check"></i> ตรวจสอบข้อมูล</button>
                </div>
                <div class="form-group mb-2 col-md-12">
                    <div id="preview-parent"></div>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
    
    // DataTransfer allows updating files in input
    var dataTransfer = new DataTransfer()

    const form = document.querySelector('#form')
    const input = document.querySelector('#input')

    input.addEventListener('change', () => {

    let files = input.files

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
        if(vidFileLength === 0){
            $('#msg').html('กรุณาเลือกรูปภาพ');
            return false;
        }
        var property = document.getElementById('input').files[0];
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
        // Read selected files
        var totalfiles = document.getElementById('input').files.length;
        for (var index = 0; index < totalfiles; index++) {
            form_data.append("file[]", document.getElementById('input').files[index]);
        }
        // form_data.append("file[]", property);
        // form_data.append("urlimg", $('#urlimg').val());
        form_data.append("shopname", $('#shopname').val());
        form_data.append("shoptype", $('#shoptype').val());
        form_data.append("category", $('#category').val());
        form_data.append("name", $('#name').val());
        form_data.append("secret_info", $('#secret_info').val());
        form_data.append("point", $('#point').val());
        form_data.append("pointv", $('#pointv').val());

        console.log(form_data)
        $.ajax({
            url: 'manage.php?add_shop_id',
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