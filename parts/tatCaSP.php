<?php
require_once '../bootstrap.php';

use CT275\Project\Sach;
use CT275\Project\HoaDon;
use CT275\Project\PhieuMuaHang;

/* if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['maHD'])){
    $dsSPThemSession = PhieuMuaHang::findAllSPHD($_POST['maHD']);
    foreach($dsSPThemSession as $dsMaSP){
        $_SESSION[$dsMaSP->layMaSach()] = $dsMaSP->layMaSach();
        $tangSPGioHang = $tangSPGioHang + 1;
    }
    if (isset($_GET['id']))
        header("location: gioHang.php?id=".$_GET['id']."&sl=".$tangSPGioHang);
    else header("location: gioHang.php?sl=".$tangSPGioHang);    
} */

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['maHDTheoNgay']) && isset($_POST['maSachTheoNgay'])) {
    if (PhieuMuaHang::find($_POST['maSachTheoNgay'], $_POST['maHDTheoNgay'])->delete()) {
        if(count(PhieuMuaHang::findAllSPHD($_POST['maHDTheoNgay']))<=0){
            if(HoaDon::find($_POST['maHDTheoNgay'])->delete()){
                //echo "<script>alert('Xóa Sản Phẩm Thành Công thành công!'); </script>";
            }
        } //else echo "<script>alert('Xóa Hóa Đơn Thành Công thành công!'); </script>";
    }
}

$dsHDKH = HoaDon::findAllHDKH($_SESSION['tenDangNhap']);
if (isset($_GET['id']))
    $pathAllSP = "gioHang.php?id=" . $_GET['id'] . "&sl=" . $tangSPGioHang;
else $pathAllSP = "gioHang.php?sl=" . $tangSPGioHang;

?>

<?php
if (count($dsHDKH) <= 0)
echo "<h3>Danh Sách Các Sản Phẩm</h3>
    <p>Chưa có đơn hàng</p>";
else
foreach ($dsHDKH as $hd) :
    $maHD = $hd->layMaHD();
    $dsSPHD = PhieuMuaHang::findAllSPHD($maHD);

?>
    <div class="card mt-3">
        <div class="card-header" style="background:#ffccff;">
            <span class="badge badge-danger align-middle" style="font-size:15px;">Yêu Thích</span>&nbsp;<span>linchutou.vn</span>
            <button class="fa fa-envelope-o btn-danger" style="font-size:15px;" type="button">&nbsp;Chat</button>&nbsp;&nbsp;
            <button class="fa fa-info-circle btn-danger" style="font-size:15px;" type="button">&nbsp;Xem Shop</button>
            <span class="float-right">
                <span class="fa fa-car text-success"><i></i>&nbsp;<span class="text-primary">Đang Vận Chuyển </span>&nbsp;|&nbsp;<span class="text-danger"> CHỜ XÁC NHẬN </span></span>
            </span>
        </div>
        <div class="card-body">
            <div class="card-text">
                <?php
                foreach ($dsSPHD as $PMH) :
                    $maSach = $PMH->layMaSach();
                    $sach = Sach::findMaSach($maSach);
                    $giamGiaSP = htmlspecialchars($sach->giamgia);
                    $giaBanSP = htmlspecialchars($sach->giaban);
                    if ($giamGiaSP != 0) {
                        $giaMoiSP = $giaBanSP * (1 - (float)$giamGiaSP / 100);
                    } else {
                        $giaMoiSP = $giaBanSP;
                    }
                ?>
                    <div class="row mb-3">
                        <!-- cột hình ảnh, loại sản phẩm -->
                        <div class="col-1">
                            <img src="<?= htmlspecialchars($sach->hinhanh) ?>" width="60px" class="rounded" alt="Anh SP">
                        </div>
                        <!-- cột tên sản phẩm -->
                        <div class="col-6"><?= htmlspecialchars($sach->tensach) ?></div>
                        <!-- cột so luong sản phẩm -->
                        <div class="col-1"><?= htmlspecialchars($PMH->soluong) ?> </div>
                        <!-- cột giá cu cua sản phẩm -->
                        <div class="col-2"><small><sup><u>đ</u></sup></small><del><?= $giaBanSP ?> </del></div>
                        <!-- cột giá moi cua sản phẩm -->
                        <div class="col-2"><small><sup><u>đ</u></sup></small><?= $giaMoiSP ?> </div>

                    </div>
                    <hr />
                <?php
                endforeach;
                ?>
            </div>
        </div>
        <div class="card-footer bg-white">
            <p class="d-flex justify-content-end"><i class="fa fa-money text-danger"></i>&nbsp;Tổng số tiền:&nbsp;&nbsp; <small><sup><u>đ</u></sup></small> <?= $hd->giatrihd ?></p>
            <div>
                <span class="float-left"><small>Không được đánh giá</small></span>
                <span class="float-right">
                    <!-- <form method="post" class="form-inline" action="<?= $pathHoSo . "&type=donMua" ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <button type="submit" class="btn btn-danger mr-2">Mua Lại</button>
                            <input class="form-control" type="hidden" id="muaLai<?= $maHD ?>" name="maHD" value="<?= $maHD ?>">
                        </div>
                        <button type="button" id="lienHeNguoiBan<?= $maHD ?>" name="lienHeNguoiBan<?= $maHD ?>" class="btn btn-outline-danger">Liên Hệ Người Bán</button>
                    </form> -->
                    <a href="<?=$pathAllSP."&maHD=".$maHD?>" type="button" class="btn btn-danger mr-2"><i class="fa fa-shopping-basket"></i>&nbsp;Mua Lại</a>
                    <button type="button" id="lienHeNguoiBan<?= $maHD ?>" name="lienHeNguoiBan<?= $maHD ?>" class="btn btn-outline-danger"><i class="fa fa-volume-control-phone"></i>&nbsp;Liên Hệ Người Bán</button>
                </span>
            </div>
        </div>
    </div>
<?php
endforeach;
?>