<?php

use CT275\Project\KhachHang;

$capNhatKH = KhachHang::findByMaKH($_SESSION['tenDangNhap']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_REQUEST['btnChangePass'])) {
    $passOld = $capNhatKH->matkhau;
    $passNew = md5(md5($_POST['matKhauCu']));
    if($passOld===$passNew){
        $data = [
            'makh' => $_SESSION['tenDangNhap'],
            'matkhau' => $_POST['matKhauMoi'],
        ];
        if ($capNhatKH->fill($data)->saveUpdateMK()) {
            echo "<script> alert('Cập Nhật Thành Công !!!'); </script>";
        }
    }else  echo "<script> alert('Mật Khẩu Cũ KHÔNG Đúng !!!'); </script>";
}

if (isset($_GET['id'])) $path = $_SERVER['PHP_SELF'] . "?id=" . $_GET['id'] . "&sl=" . $tangSPGioHang . "&type=changePass";
else $path = $_SERVER['PHP_SELF'] . "?sl=" . $tangSPGioHang . "&type=changePass";
?>
<div class="card">
    <div class="card-header fa fa-key" style="background:#ffccff;">&nbsp;Đổi Mật Khẩu</div>
    <div class="card-body">
        <form id="thayDoiMatKhau" name="thayDoiMatKhau" enctype="multipart/form-data" method="post" action="#">
            <div class="row">
                <!-- mật khẩu cũ-->
                <div class="col-3 form-group">
                    <label for="matKhauCu">Mật Khẩu Hiện Tại:</label>
                </div>
                <div class="col-8 form-group input-group">
                    <div class="input-group-prepend">
                        <label for="matKhauCu" class="input-group-text"><i class="fa fa-fw fa-lock" style="color: red;"></i></label>
                    </div>
                    <input id="matKhauCu" name="matKhauCu" type="password" class="form-control" placeholder="Enter Old Password">
                </div>
            </div>
            <div class="row">
                <!-- mật khẩu mới-->
                <div class="col-3 form-group">
                    <label for="matKhauMoi">Mật Khẩu Mới:</label>
                </div>
                <div class="col-8 form-group input-group">
                    <div class="input-group-prepend">
                        <label for="matKhauMoi" class="input-group-text"><i class="fa fa-fw fa-lock" style="color: red;"></i></label>
                    </div>
                    <input id="matKhauMoi" name="matKhauMoi" type="password" class="form-control" placeholder="Enter New Password">
                </div>
            </div>
            <div class="row">
                <!-- nhap lai mat khau -->
                <div class="col-3 form-group">
                    <label for="nhapLaiMK">Xác Nhận Mật Khẩu:</label>
                </div>
                <div class="col-8 form-group input-group">
                    <div class="input-group-prepend">
                        <label for="nhapLaiMK" class="input-group-text"><i class="fa fa-fw fa-lock" style="color: red;"></i></label>
                    </div>
                    <input id="nhapLaiMK" name="nhapLaiMK" type="password" class="form-control" placeholder="Comfirm Password">
                </div>
            </div>
            <div class="row">
                <div class="col-8 offset-3 form-group">
                    <button id="btnChangePass" name="btnChangePass" type="submit" class="btn btn-danger "><i class="fa fa-check"></i> &nbsp;Xác Nhận</button>
                </div>
            </div>
        </form>
    </div>
</div>