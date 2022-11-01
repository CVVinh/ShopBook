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
    header("location: index.php?sl=".$tangSPGioHang);
}

use CT275\Project\Sach;
use CT275\Project\TheLoai;
use CT275\Project\LoaiSach;

if (isset($_REQUEST['timkiem'])) $timKiem = $_REQUEST['timkiem'];
else if (isset($_GET['timkiem'])) $timKiem = '\'' . $_GET['timkiem'] . '\'';

$dsLoaiSach = LoaiSach::all();
if (($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_REQUEST['timkiem'])) || !empty($timKiem)) {
    //$lietKeDSSach = Sach::findDSTenSach($_POST['timkiem']);
    $lietKeDSSach = Sach::findDSTenSach($_REQUEST['timkiem']);
    if (empty($lietKeDSSach)) Sach::findDSTenSach($timKiem);
    $soLuongSach = count($lietKeDSSach);
    $theLoaiBreadcrumbs = TheLoai::findMaTheLoai($lietKeDSSach[0]->layMaTheLoai());
    $loaiSachBreadcrumbs = LoaiSach::find($theLoaiBreadcrumbs->layMaLoai());
} else
if (isset($_REQUEST['tl'])) {
    $lietKeDSSach = Sach::findMaTheLoai($_GET['tl']);
    $soLuongSach = count($lietKeDSSach);
    $theLoaiBreadcrumbs = TheLoai::findMaTheLoai($_GET['tl']);
    $loaiSachBreadcrumbs = LoaiSach::find($theLoaiBreadcrumbs->layMaLoai());
} else {
    $lietKeDSSach = Sach::all();
    $soLuongSach = count($lietKeDSSach);
    $loaiSachBreadcrumbs = null;
    $theLoaiBreadcrumbs = null;
}
$numberPage = 1;
$pageOld = 1;
if (isset($_GET['pageNew'])) {
    $pageNew = $_GET['pageNew'];
    $pageOld = $_GET['pageOld'];

    if ($pageNew >= 1 && $pageNew <= (int)($soLuongSach / 30 + 1)) {
        $numberPage = $pageNew;
        $pageOld = $pageNew;
    } else if ($pageNew == -2 && $pageOld <= (int)($soLuongSach / 30)) {
        $numberPage = $pageOld + 1;
        $pageOld = $numberPage;
    } else if ($pageNew == -1 && $pageOld > 1) {
        $numberPage = $pageOld - 1;
        $pageOld = $numberPage;
    } else $numberPage = $pageOld;
}
$endPage = $soLuongSach > 30 ? $numberPage * 30 : $soLuongSach;
if ($endPage > $soLuongSach) {
    $endPage = $soLuongSach;
    $starPage = ($numberPage - 1) * 30;
} else $starPage = $soLuongSach > 30 ? $endPage - 30 : 0;

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
        <div class="row mt-10">
            <div class="col-12">
                <ul class="breadcrumb" style="margin:0px; margin-bottom: 5px; padding:5px;">
                    <li class="breadcrumb-item fa fa-home">&nbsp;<a href="index.php?sl=<?= $tangSPGioHang ?>">HOME</a>
                    </li>
                    <?php
                    if ($loaiSachBreadcrumbs != null) :
                    ?>
                    <li class="breadcrumb-item"><a href="#"><?= $loaiSachBreadcrumbs->tenloai ?></a></li>
                    <?php
                    endif;
                    if ($theLoaiBreadcrumbs != null) :
                    ?>
                    <li class="breadcrumb-item"><a href="#"><?= $theLoaiBreadcrumbs->tentheloai ?></a></li>
                    <?php
                    endif;
                    ?>
                    <li class="breadcrumb-item active">Danh Sách Sách</li>
                </ul>
            </div>
        </div>
        <div class="row">
            <!-- menu -->
            <div class="col-3">
                <?php
                include("../parts/menu.php");
                ?>
            </div>
            <!-- Phần nội dung -->
            <div class="col-9">
                <!-- carousel -->
                <?php
                include("../parts/carousel.php");
                ?>

                <!-- tiep noi dung -->
                <!-- cac loai sach -->
                <?php
                include("../parts/content.php");
                ?>
            </div>
        </div>
        <div class="row">
            <!-- phần đuôi -->
            <?php
            include("../parts/footer.php");
            ?>
        </div>

    </div>
</body>

</html>