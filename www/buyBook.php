<?php
require_once '../bootstrap.php';

use CT275\Project\Sach;
use CT275\Project\TheLoai;
use CT275\Project\LoaiSach;

$tangSPGioHang = $_GET['sl'];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_REQUEST['txtThemSPGioHang'])) {
    $_SESSION[$_POST['txtThemSPGioHang']] = $_POST['txtThemSPGioHang'];
    $tangSPGioHang = $tangSPGioHang + 1;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_REQUEST['txtMuaNgay'])) {
    $laySach = $_POST['txtMuaNgay'];
    $checkSach = true;
    foreach ($_SESSION as $ms) {
        if ($ms == $laySach) {
            $checkSach = false;
            break;
        }
    }
    if ($checkSach) {
        $_SESSION[$laySach] = $laySach;
        $tangSPGioHang = $tangSPGioHang + 1;
    }
    header("location: gioHang.php?id=".$_GET['id']."&sl=".$tangSPGioHang);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_REQUEST['maSach'])) {
    unset($_SESSION[$_POST['maSach']]);
    #header("Refresh:0");
    $tangSPGioHang = $tangSPGioHang - 1;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_REQUEST['timkiem'])) {
    $lietKeDSSach = Sach::findDSTenSach($_POST['timkiem']);
    $dsSach = $lietKeDSSach[0];
} else {
    $id = $_GET['id'];
    $dsSach = Sach::findMaSach($id);
}
$dsTheLoai = TheLoai::findMaTheLoai($dsSach->layMaTheLoai());
$loaiSach = LoaiSach::find($dsTheLoai->layMaLoai());
$dsLienQuan = Sach::findMaTheLoai($dsSach->layMaTheLoai());
if ($dsTheLoai->layMaTheLoai() == 'LS1TL1') $spCungMua = 'LS1TL2';
else if ($dsTheLoai->layMaTheLoai() == 'LS1TL2') $spCungMua = 'LS1TL1';
else if ($dsTheLoai->layMaTheLoai() == 'LS2TL1') $spCungMua = 'LS2TL2';
else if ($dsTheLoai->layMaTheLoai() == 'LS2TL2') $spCungMua = 'LS2TL1';
else if ($dsTheLoai->layMaTheLoai() == 'LS3TL1') $spCungMua = 'LS3TL2';
else if ($dsTheLoai->layMaTheLoai() == 'LS3TL2') $spCungMua = 'LS3TL1';
else if ($dsTheLoai->layMaTheLoai() == 'LS4TL1') $spCungMua = 'LS4TL2';
else if ($dsTheLoai->layMaTheLoai() == 'LS4TL2') $spCungMua = 'LS4TL1';
else if ($dsTheLoai->layMaTheLoai() == 'LS5TL1') $spCungMua = 'LS5TL2';
else if ($dsTheLoai->layMaTheLoai() == 'LS5TL2') $spCungMua = 'LS5TL1';
else if ($dsTheLoai->layMaTheLoai() == 'LS6TL1') $spCungMua = 'LS6TL2';
else if ($dsTheLoai->layMaTheLoai() == 'LS6TL2') $spCungMua = 'LS6TL1';
else if ($dsTheLoai->layMaTheLoai() == 'LS7TL1') $spCungMua = 'LS7TL2';
else if ($dsTheLoai->layMaTheLoai() == 'LS7TL2') $spCungMua = 'LS7TL1';
else if ($dsTheLoai->layMaTheLoai() == 'LS8TL1') $spCungMua = 'LS8TL2';
else if ($dsTheLoai->layMaTheLoai() == 'LS8TL2') $spCungMua = 'LS8TL1';
$dsCungMua = Sach::findMaTheLoai($spCungMua);
if (empty($dsCungMua)) $dsCungMua = Sach::findMaTheLoai('LS6TL1');
if ($dsSach->layMaTheLoai() == 'LS3TL1') {
    $spGioiThieu = 'LS4TL1';
} else $spGioiThieu = 'LS3TL1';
$dsGioiThieu = Sach::findMaTheLoai($spGioiThieu);
$giamGia = htmlspecialchars($dsSach->giamgia);
$giaBan = htmlspecialchars($dsSach->giaban);

if ($giamGia != 0) {
    $giaMoi = $giaBan * (1 - (float)$giamGia / 100);
    $giaBan = $giaBan . " đ";
} else {
    $giaMoi = $giaBan;
    $giaBan = "";
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

<body style="background-color: lightgray;">
    <div class="container " style="margin-top:65px;">
        <!-- navbar -->
        <?php
        include("../parts/navbar.php");
        ?>
        <!-- tao menu 3 o -->
        <div class="row ">
            <!-- Phần nội dung -->
            <div class="col-12">
                <!-- Breadcrumbs cho trang (ds đường dẫn tới trang) -->
                <ul class="breadcrumb" style="margin:0px; margin-bottom: 5px; padding:5px;">
                    <li class="breadcrumb-item fa fa-home">&nbsp;<a href="index.php?sl=<?= $tangSPGioHang ?>">HOME</a></li>
                    <li class="breadcrumb-item limitText"><a href="#">Chi Tiết Sách</a></li>
                    <li class="breadcrumb-item limitText"><a href="#"><?= htmlspecialchars($loaiSach->tenloai) ?></a></li>
                    <li class="breadcrumb-item limitText"><a href="#"><?= htmlspecialchars($dsTheLoai->tentheloai) ?></a></li>
                    <li class="breadcrumb-item active limitText"><?= htmlspecialchars($dsSach->tensach) ?></li>
                </ul>
                <!-- card thong tin san pham mua -->
                <?php
                include_once('../parts/chiTietSP.php');
                ?>
                <!-- card thong tin san pham can lien quan -->
                <?php
                include_once('../parts/spLienQuan.php');
                ?>

                <!-- card thong tin san pham duoc gioi thieu -->
                <?php
                include_once('../parts/spGioiThieu.php');
                ?>

                <!-- card SẢN PHẨM CÙNG MUA -->
                <?php
                include_once('../parts/spCungMua.php');
                ?>

                <!-- card thong tin chi tiet san pham can mua -->
                <?php
                include_once('../parts/thongTinSP.php');
                ?>

                <!-- card danh gia san pham can mua -->
                <?php
                include_once('../parts/danhGiaSP.php');
                ?>

                <!-- phần đuôi -->
                <?php
                include("../parts/footer.php");
                ?>
            </div> <!-- cot chinh col-12 -->
        </div> <!-- dong chinh -->
    </div> <!-- container -->

</body>

</html>