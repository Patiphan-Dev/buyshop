<!DOCTYPE html>
<?php
require('idpass.php');
?>
<html lang="en">

<head>
    <base href="<?= LOCAL_WEB ?>/">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $result_info_web['web_title'] ?></title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/tung.css" rel="stylesheet">
    <link href="assets/css/hover.css" rel="stylesheet">
    <link href="bg.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="assets/img/web_logo2.png" />
    <link rel="stylesheet" href="assets/css/owl/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/owl/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit:wght@200;300">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src='https://www.google.com/recaptcha/api.js?hl=th'></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>

    <style>
        body {
            font-family: 'Kanit', serif;
            background-color: <?= $result_info_web['web_color'] ?>;
            /* background: linear-gradient(90deg, rgba(138, 9, 117, 0.8) 0%, rgba(167, 17, 159, 0.8) 50%, rgba(129, 18, 177, 0.8) 89%); */
            /* background-blend-mode: overlay; */
            min-height: 100%;
            /* background-image: url("https://i.pinimg.com/originals/03/e4/0e/03e40e6f01981a4ba76b70f386106677.gif"), linear-gradient(rgba(0,0,0,0.1),rgba(0,0,0,0.0)); */
            /* background-image: url("assets/img/bg3.jpg"), linear-gradient(rgba(0,0,0,0.1),rgba(0,0,0,0.0)); */
            background-blend-mode: overlay;
            /* background-image: url("assets/img/bg.jpg") rgba(255, 0, 150, 0.3); */
            background-position: center center !important;
            background-attachment: fixed !important;
            background-repeat: no-repeat !important;
            background-size: cover !important;
            /* background: rgb(62,31,83); */
            /* background: linear-gradient(90deg, rgba(62,31,83,1) 0%, rgba(73,14,119,1) 50%, rgba(50,3,49,1) 89%); */
        }

        .owl-carousel .owl-stage {
            display: flex;
        }

        .aticle-box {
            height: 360px;
        }
    </style>

</head>

<body>



    <div class="snowflakes" aria-hidden="true">
        <div class="snowflake">
            ❅
        </div>
        <div class="snowflake">
            ❅
        </div>
        <div class="snowflake">
            ❆
        </div>
        <div class="snowflake">
            ❄
        </div>
        <div class="snowflake">
            ❅
        </div>
        <div class="snowflake">
            ❆
        </div>
        <div class="snowflake">
            ❄
        </div>
        <div class="snowflake">
            ❅
        </div>
        <div class="snowflake">
            ❆
        </div>
        <div class="snowflake">
            ❄
        </div>
    </div>
    <div id="devbyPtungPage">

        <nav id="top" class="navbar navbar-expand-lg navbar-dark py-4 sticky-lg-top" style="background-color:<?= $result_info_web['menu_color'] ?>;">
            <div class="container">
                <!-- <a class="navbar-brand" href="#">
            <?= $result_info_web['web_name'] ?></a> -->
                <a href=""><img src="<?= $result_info_web['web_img'] ?>" style="height: 1	1.0rem;width: 5.9rem;border-radius: 2%;" alt="a" class="navbar-nav"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarColor02">
                    <ul class="navbar-nav me-auto text-center">
                        <li class="nav-item">
                            <a class="hvr-icon-up nav-link <?php if (@$_GET['page'] == "home") {
                                                                echo "active";
                                                            } ?> " href="page/home"><i class="fa-solid fa-house hvr-icon" style="color:#56DEC3;"></i> หน้าแรก</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="hvr-icon-up nav-link dropdown-toggle <?php if (@$_GET['page'] == "shop" || @$_GET['page'] == "shopaccount") {
                                                                                echo "active";
                                                                            } ?>" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="fa-solid fa-shop hvr-icon" style="color:#FFC100;"></i> ร้านค้า
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item hvr-icon-up " href="page/shop"><i class="fa-solid fa-file-lines hvr-icon" style="color:#000;"></i> ร้านค้าไอดี</a>
                                <a class="dropdown-item hvr-icon-up " href="page/account"><i class="fa-regular fa-file-lines hvr-icon" style="color:#000;"></i> ร้านค้าบัญชี</a>
                                <a class="dropdown-item hvr-icon-up " href="page/accountpre"><i class="fa-regular fa-file-lines hvr-icon" style="color:#000;"></i> ร้านค้าพรีเมี่ยม</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="hvr-icon-up nav-link <?php if (@$_GET['page'] == "game") {
                                                                echo "active";
                                                            } ?>" href="page/game"><i class="fa-solid fa-dice hvr-icon"></i> เกมสุ่มรางวัล</a>
                        </li>
                        <li class="nav-item">
                            <a class="hvr-icon-up nav-link <?php if (@$_GET['page'] == "topup") {
                                                                echo "active";
                                                            } ?> " href="page/topup"><i class="fa-regular fa-credit-card hvr-icon" style="color:#FF5AA8;"></i> เติมเงิน</a>
                        </li>
                        <li class="nav-item">
                            <a class="hvr-icon-up nav-link <?php if (@$_GET['page'] == "inventory") {
                                                                echo "active";
                                                            } ?>" href="page/inventory"><i class="fa-solid fa-box-open hvr-icon" style="color:#949FFF;"></i> คลังเก็บของ</a>
                        </li>
                    </ul>
                    <?php if (isset($_SESSION['username'])) : ?>
                        <div class="d-flex flex-row-reverse">
                            <ul class="navbar-nav me-auto">
                                <li class="nav-item">
                                    <a href="page/profile" class="btn btn-dark btn-sm hvr-icon-up"><i class="fa-solid fa-user-tie hvr-icon" style="color:#fff;"></i> <?= $users_username; ?> : <i class="fa-solid fa-coins"></i> <span id="pointnow_nav"><?= number_format($users_point, 2) ?></span> เครดิต</a>
                                    <?php if ($users_status == $admin_status) : ?>
                                        <a href="page/manage" class="btn btn-info btn-sm hvr-icon-up"><i class="fa-solid fa-code hvr-icon" style="color:#fff;"></i> จัดการหลังบ้าน</a>
                                    <?php endif; ?>
                                    <a class="btn btn-danger btn-sm hvr-icon-forward" onclick="logout()"><i class="fa-solid fa-right-from-bracket hvr-icon"></i> ออกจากระบบ</a>
                                </li>
                            </ul>
                        </div>

                    <?php else : ?>
                        <div class="d-flex flex-row-reverse">
                            <ul class="navbar-nav me-auto">
                                <li class="nav-item">
                                    <a class="btn btn-primary btn-sm" href="page/login"><i class="fa-solid fa-user-lock" style="color:#fff;"></i> เข้าสู่ระบบ</a>
                                    <a class="btn btn-primary btn-sm" href="page/register"><i class="fa-solid fa-address-book" style="color:#fff;"></i> สมัครสมาชิก</a>
                                </li>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </nav>

        <div class="container">
            <div id="return"></div>
            <div class="row">

                <?php
                if (@$_GET['page'] == "login") {
                    if (!isset($_SESSION['username'])) {
                        include 'view/view_login.php';
                    } else {
                        include 'view/view_home.php';
                    }
                } else if (@$_GET['page'] == "register") {
                    if (!isset($_SESSION['username'])) {
                        include 'view/view_register.php';
                    } else {
                        include 'view/view_home.php';
                    }
                } else if (@$_GET['page'] == "topup") {
                    if (!isset($_SESSION['username'])) {
                        include 'view/view_login.php';
                    } else {
                        include 'view/view_topup.php';
                    }
                } else if (@$_GET['page'] == "policy") {
                    include 'view/view_policy.php';
                } else if (@$_GET['page'] == "shop") {
                    include 'view/view_shop.php';
                } else if (@$_GET['page'] == "accountpre") {
                    include 'view/view_shopaccountpre.php';
                } else if (@$_GET['page'] == "account") {
                    include 'view/view_shopaccount.php';
                } else if (@$_GET['page'] == "deposit") {
                    if (!isset($_SESSION['username'])) {
                        include 'view/view_login.php';
                    } else {
                        include 'view/view_deposit.php';
                    }
                } else if (@$_GET['page'] == "profile") {
                    if (!isset($_SESSION['username'])) {
                        include 'view/view_login.php';
                    } else {
                        include 'view/view_profile.php';
                    }
                } else if (@$_GET['page'] == "inventory") {
                    if (!isset($_SESSION['username'])) {
                        include 'view/view_login.php';
                    } else {
                        include 'view/view_history.php';
                    }
                } else if (@$_GET['page'] == "game") {
                    if (!isset($_SESSION['username'])) {
                        include 'view/view_login.php';
                    } else {
                        include 'view/view_game.php';
                    }
                } else if (@$_GET['page'] == "product") {
                    include 'view/view_product.php';
                } else if (@$_GET['page'] == "manage") { //admin page
                    if (!isset($_SESSION['username'])) {
                        include 'view/view_login.php';
                    } else {
                        if ($users_status == $admin_status) {
                            include 'view/admin_manage/admin_home.php';
                        } else {
                            include 'view/view_home.php';
                        }
                    }
                } else if (!preg_match('/^[a-zA-Z0-9\_]*$/', @$_GET['page'])) {
                    include 'view/view_home.php';
                } else {
                    include 'view/view_home.php';
                }
                ?>

                <div class="col-md-12 col-sm-12 mt-4 text-center text-white">
                    <h5 class="text-white">
                        <spen class="hvr-icon-up pointer" onclick="CradURL('<?= $result_info_web['web_discord'] ?>')" target="_blank"><i class="fa-brands fa-discord hvr-icon"></i> Discord</spen>
                        &nbsp; &nbsp;
                        <spen class="hvr-icon-up pointer" onclick="CradURL('<?= $result_info_web['web_fb'] ?>')" target="_blank"><i class="fa-brands fa-facebook hvr-icon"></i> Facebook</spen>
                        &nbsp; &nbsp;
                        <spen class="hvr-icon-up pointer" onclick="CradURL('<?= $result_info_web['web_youtube'] ?>')" target="_blank"><i class="fa-brands fa-youtube hvr-icon"></i> Youtube</spen>
                    </h5>

                    <p>&copy; <?php echo date('Y'); ?> - <?= $result_info_web['web_name'] ?> <?= $result_info_web['web_version'] ?> Dev By TP Shop |
                        <a style="text-decoration: none;color:#fff;" href="page/policy">Privacy Policy</a>
                    </p>

                </div>

            </div>
        </div>

    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <?php
    if (
        @$_GET['game'] != "slot" &&
        @$_GET['game'] != "roller" &&
        @$_GET['game'] != "spin"
    ) {
        echo '<script src="assets/js/jquery-3.4.1.min.js"></script>';
    }
    ?>
    <!-- <script src="assets/js/jquery-3.4.1.min.js"></script> -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js"></script>

    <script src="assets/js/corgi.js"></script>
    <?php if (@$users_status == $admin_status) : ?>
        <script src="assets/js/corgimain.js"></script>
    <?php endif; ?>

    <script src="assets/css/owl/owl.carousel.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script> -->
    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <script>
        function CradURL(url) {
            location.href = url;
        }

        $(document).ready(function() {
            $('.summernote').summernote({
                dialogsInBody: true,
                height: 200,
                // 'height': '1000%',
                'width': '100%',
            });

        });

        var owl = $('.owl-carousel');
        owl.owlCarousel({
            items: 4,
            loop: true,
            margin: 0,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    // nav:true
                },
                600: {
                    items: 3,
                },
                1000: {
                    items: 4,
                }
            }
        });
        $('.play').on('click', function() {
            owl.trigger('play.owl.autoplay', [2000])
        })
        $('.stop').on('click', function() {
            owl.trigger('stop.owl.autoplay')
        })

        AOS.init();
    </script>
    <script type="text/javascript" charset="utf-8">
        $(document).ready(function() {
            <?php if (isset($_SESSION['username'])) : ?>
                // $('.paginate_button.active').css("background-color","#f00");
                $('#tbl_topuphistory').dataTable({
                    "bFilter": false,
                    // "bInfo": false,
                    "order": [
                        [0, 'desc']
                    ],
                    "columnDefs": [{
                        "className": "dt-center",
                        "targets": "_all"
                    }],
                    "oLanguage": {
                        "sLengthMenu": "แสดง _MENU_ เร็คคอร์ด ต่อหน้า",
                        "sZeroRecords": "ไม่เจอข้อมูลที่ค้นหา",
                        "sInfo": "แสดง _START_ ถึง _END_ ของ _TOTAL_ เร็คคอร์ด",
                        "sInfoEmpty": "แสดง 0 ถึง 0 ของ 0 เร็คคอร์ด",
                        "sInfoFiltered": "(จากเร็คคอร์ดทั้งหมด _MAX_ เร็คคอร์ด)",
                        "sSearch": "ค้นหา :",
                        "aaSorting": [
                            [0, 'asc']
                            // [0, 'desc']
                        ],
                        "oPaginate": {
                            "sFirst": "หน้าแรก",
                            "sPrevious": "ก่อนหน้า",
                            "sNext": "ถัดไป",
                            "sLast": "หน้าสุดท้าย"
                        },


                    }
                });

                $('#tbl_history_shop').DataTable({
                    responsive: true
                });
                $('#tbl_history_shop2').DataTable({
                    responsive: true
                });

                $('#tbl_history_reward').DataTable({
                    responsive: true
                });
            <?php endif; ?>

            <?php if ($_GET['page'] == "home") : ?>
                UpdateStock();
            <?php endif ?>

            <?php if (@$users_status == $admin_status) : ?>

                $('#tbl_users').DataTable({
                    responsive: true,
                    "ajax": 'manage.php?usersdata',
                    // "bFilter": false,
                    // "bInfo": false,
                    "order": [
                        [0, 'desc']
                    ],
                    "columnDefs": [{
                            "className": "dt-center",
                            "targets": "_all"
                        },
                        {
                            targets: 5,
                            orderable: false,
                            render: function(data) {
                                return `
                                <a href="?page=manage&admin=users&id=${data}" class="hvr-icon-up btn btn-sm btn-info mb-2"><i class="hvr-icon fa-solid fa-user-gear"></i> Edit</a>
                                `;
                            }
                        },
                    ],
                });

            <?php endif; ?>

        });
    </script>
    <script language=JavaScript>
        function clickIE() {
            if (document.all) {
                alert(message);
                return false;
            }
        }

        function clickNS(e) {
            if (document.layers || (document.getElementById && !document.all)) {
                if (e.which == 2 || e.which == 3) {
                    alert(message);
                    return false;
                }
            }
        }
        if (document.layers) {
            document.captureEvents(Event.MOUSEDOWN);
            document.onmousedown = clickNS;
        } else {
            document.onmouseup = clickNS;
            document.oncontextmenu = clickIE;
        }

        document.oncontextmenu = new Function("return false")
    </script>
</body>

</html>