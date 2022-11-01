<?php
require_once '../bootstrap.php';
isset($_REQUEST['sl']) ? $tangSPGioHang = $_GET['sl'] : $tangSPGioHang = 0;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_REQUEST['maSach'])) {
    unset($_SESSION[$_POST['maSach']]);
    $tangSPGioHang = $tangSPGioHang - 1;
}
if (isset($_REQUEST['dangXuat'])) {
    session_destroy();
    $tangSPGioHang = 0;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Shop Đồ Dùng Học Tập</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sticky-footer.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <script src="js/jquery-3.5.1.slim.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.validate.js"></script>
    <script src="js/event.js"></script>
    <script src="js/wow.min.js"></script>

</head>

<body>
    <!-- Noi dung -->
    <div class="container shadow" style="margin-top:65px;">
        <!-- navbar -->
        <?php
        include("../parts/navbar.php");
        ?>
        <!-- tao menu 3 o -->
        <div class="row mt-15">
            <div class="col-12">
                <ul class="breadcrumb" style="margin:0px; margin-bottom: 5px; padding:5px;">
                    <li class="breadcrumb-item fa fa-home">&nbsp;<a href="index.php?sl=<?= $tangSPGioHang ?>">HOME</a>
                    </li>
                    <?php
                    if (isset($_GET['id'])) :
                    ?>
                        <li class="breadcrumb-item limitText"><a href="buyBook.php?id=<?= $_GET['id'] ?>&sl=<?= $tangSPGioHang ?>">Chi Tiết Sách</a></li>
                    <?php
                    else :
                    ?>
                        <li class="breadcrumb-item limitText"><a href="buyBook.php?id=LS1TL1S1&sl=<?= $tangSPGioHang ?>">Chi Tiết Sách</a></li>
                    <?php
                    endif;
                    ?>
                    <li class="breadcrumb-item active limitText">Hồ Sơ</li>
                </ul>
            </div>
            <!-- menu -->
            <div class="col-3">
                <?php
                include("../parts/menuHoSo.php");
                ?>
            </div>
            <!-- Phần nội dung -->
            <div class="col-9">
                <?php
                if (isset($_GET['type'])) {
                    if ($_GET['type'] == "changePass")
                        include("../parts/changePass.php");
                    elseif($_GET['type']=="donMua")
                        include("../parts/donMua.php");    
                    elseif($_GET['type']=="hoso")
                        include("../parts/taiKhoan.php");
                }else include("../parts/taiKhoan.php");
                ?>
            </div>

            <!-- phần đuôi -->
            <?php
            include("../parts/footer.php");
            ?>
        </div> <!-- het dong -->

    </div> <!-- container -->
</body>

</html>