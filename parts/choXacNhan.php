<?php
require_once '../bootstrap.php';

use CT275\Project\Sach;
use CT275\Project\HoaDon;
use CT275\Project\PhieuMuaHang;

/* if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['maHDTheoNgay']) && isset($_POST['maSachTheoNgay'])) {
    if (PhieuMuaHang::find($_POST['maSachTheoNgay'], $_POST['maHDTheoNgay'])->delete()) {
        if(count(PhieuMuaHang::findAllSPHD($maHDTheoNgay))<=0){
            if(HoaDon::find($_POST['maHDTheoNgay'])->delete()){
                echo "<script>alert('Xóa Sản Phẩm Thành Công thành công!'); </script>";
            }
        } else echo "<script>alert('Xóa Hóa Đơn Thành Công thành công!'); </script>";
    }
} */

$dsHDKHTheoNgay = HoaDon::findAllHDKHTheoNgay($_SESSION['tenDangNhap']);

?>

<?php
if (count($dsHDKHTheoNgay) <= 0)
    echo "<h3>Chờ Xác Nhận</h3>
        <p>Chưa có đơn hàng</p>";
else
    foreach ($dsHDKHTheoNgay as $hdTheoNgay) :
        $maHDTheoNgay = $hdTheoNgay->layMaHD();
        $dsSPHDTheoNgay = PhieuMuaHang::findAllSPHD($maHDTheoNgay);
        foreach ($dsSPHDTheoNgay as $PMH) :
            $maSachTheoNgay = $PMH->layMaSach();
            $sach = Sach::findMaSach($maSachTheoNgay);
            $giamGiaSPTN = htmlspecialchars($sach->giamgia);
            $giaBanSPTN = htmlspecialchars($sach->giaban);
            if ($giamGiaSPTN != 0) {
                $giaMoiSPTN = $giaBanSPTN * (1 - (float)$giamGiaSPTN / 100);
            } else {
                $giaMoiSPTN = $giaBanSPTN;
            }
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
                        <div class="col-2"><small><sup><u>đ</u></sup></small><del><?= $giaBanSPTN ?> </del></div>
                        <!-- cột giá moi cua sản phẩm -->
                        <div class="col-2"><small><sup><u>đ</u></sup></small><?= $giaMoiSPTN ?> </div>

                    </div>
                </div>
            </div>
            <div class="card-footer bg-white">
                <p class="d-flex justify-content-end"><i class="fa fa-money text-danger"></i>&nbsp;Tổng số tiền:&nbsp;&nbsp; <small><sup><u>đ</u></sup></small> <?= $hdTheoNgay->giatrihd ?></p>
                <div>
                    <span class="float-left"><small>Không được đánh giá</small></span>
                    <span class="float-right">
                        <form method="post" class="form-inline" action="<?= $pathHoSo . "&type=donMua" ?>" enctype="multipart/form-data">
                            <div class="form-group">
                                <button type="submit" id="btnHuyBoSP" name="btnHuyBoSP" class="btn btn-danger mr-2"><i class="fa fa-trash"></i>&nbsp;Hủy Bỏ</button>
                                <input class="form-control" type="hidden" id="<?= $maHDTheoNgay ?>" name="maHDTheoNgay" value="<?= $maHDTheoNgay ?>">
                                <input class="form-control" type="hidden" id="<?= $maSachTheoNgay ?>" name="maSachTheoNgay" value="<?= $maSachTheoNgay ?>">
                            </div>
                            <button type="button" id="lienHeNguoiBan<?= $maHDTheoNgay ?>" name="lienHeNguoiBan<?= $maHDTheoNgay ?>" class="btn btn-outline-danger"><i class="fa fa-volume-control-phone"></i>&nbsp;Liên Hệ Người Bán</button>
                        </form>
                        <!-- <a href="<?= $pathAllSP . "&maHDTheoNgay=" . $maHDTheoNgay ?>" type="button" class="btn btn-danger mr-2">Mua Lại</a>
                        <button type="button" id="lienHeNguoiBan<?= $maHDTheoNgay ?>" name="lienHeNguoiBan<?= $maHDTheoNgay ?>" class="btn btn-outline-danger">Liên Hệ Người Bán</button> -->
                    </span>
                </div>
            </div>
        </div>
<?php
        endforeach;
    endforeach;
?>
<div id="modal_DeleteSP" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fa fa-2x fa-trash text-danger" id="my-modal-title">&nbsp;Xác Nhận Xóa</h4>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">Bạn Có Chắc Muốn Xóa Sản Phẩm Này?</div>
            <div class="modal-footer">
                <button type="button" id='btnDeleteSP' class="btn btn-danger float-left">Delete</button>
                <button type="button" id='btnCancelDelete' data-dismiss='modal' class="btn btn-outline-danger float-right">Cancel</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('button[name="btnHuyBoSP"]').on('click', function(e) {
            var $form = $(this).closest('form');
            e.preventDefault();
            $('#modal_DeleteSP').modal({
                backdrop: 'static',
                keyboard: false
            }).one('click', '#btnDeleteSP', function() {
                $form.trigger('submit')
            });
        });
    });
</script>