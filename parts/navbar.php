<?php

use CT275\Project\KhachHang;

/* Đăng ký tài khoản */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_REQUEST['btnDangKy'])) {
    $soLuongKH = KhachHang::SLKH() + 1;
    #if ($soLuongKH < 10) $_POST['makh'] = 'KH00' . $soLuongKH;
    #else $_POST['makh'] = 'KH0' . $soLuongKH;

    $themKH = new KhachHang();
    while (1) {
        if ($soLuongKH < 10) $_POST['makh'] = 'KH00' . $soLuongKH;
        else $_POST['makh'] = 'KH0' . $soLuongKH;
        if ($themKH->findByMaKH($_POST['makh']) == null) break;
        else $soLuongKH++;
    }
    if ($themKH->fill($_POST)->saveNew()) {
        $_SESSION['tenDangNhap'] = $_POST['makh'];
    };
}
/* Đăng nhập tài khoản */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_REQUEST['btnDangNhap'])) {
    $dsKH = KhachHang::findByNameKH($_POST['tenDangNhap']);
    foreach ($dsKH as $ds) {
        if ($ds->matkhau == md5(md5($_POST['pass1']))) {
            $_SESSION['tenDangNhap'] = $ds->layMaKH();
            break;
        } else echo "<script> alert('Tên đăng nhập hoặc mật khẩu không đúng !!!'); </script>";
    }
}
if(isset($_SESSION['tenDangNhap'])){
    $tenKH = KhachHang::findByMaKH($_SESSION['tenDangNhap']);
    $tenNguoiDung = $tenKH->ten."-".$tenKH->layMaKH();
}else $tenNguoiDung="Tài Khoản";

?>
<!-- navbar  -->
<nav class="navbar navbar-expand-md navbar-dark bg-danger fixed-top">
    <a href="index.php?sl=<?= $tangSPGioHang ?>" class="navbar-brand wow fadeIn" data-wow-duration="1s"><i class="fa fa-1x fa-scribd" style="color: white;">HopLiTE</i></a>

    <button class="navbar-toggler collapsed btn-outline-light" type="button" data-toggle="collapse" data-target="#navToggle">
        <span class="navbar-toggler-icon "></span>
    </button>
    <div class="collapse navbar-collapse" id="navToggle">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="index.php?sl=<?= $tangSPGioHang ?>" class="nav-link"><i class="fa fa-home" style="color: white;">&nbsp;HOME</i></a>
            </li>
            <li class="nav-item">
                <div id="navAbout" class="btn-group dropdown">
                    <a id="navLinkAbout" href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" style="color: white;"><i class="fa fa-book">&nbsp;ABOUT</i></a>
                    <div id="navDropMenuAbout" class="dropdown-menu ">
                        <a href="#" class="dropdown-item fa fa-angle-right">&nbsp;Giới Thiệu ShopLite</a>
                        <a href="#" class="dropdown-item fa fa-angle-right">&nbsp;Điều Khoản</a>
                        <a href="#" class="dropdown-item fa fa-angle-right">&nbsp;Chính Sách Sảo Mật</a>
                        <a href="#" class="dropdown-item fa fa-angle-right">&nbsp;Chương Trình Tiếp Thị</a>
                        <a href="#" class="dropdown-item fa fa-angle-right">&nbsp;Kênh Người Bán</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <div id="navHelp" class="btn-group dropdown">
                    <a id="navLinkHelp" href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" style="color: white;"><i class="fa fa-question-circle">&nbsp;HELP</i></a>
                    <div id="navDropMenuHelp" class="dropdown-menu ">
                        <a href="#" class="dropdown-item fa fa-angle-right">&nbsp;Chính Sách Đổi-Trả-Hoàn Tiền</a>
                        <a href="#" class="dropdown-item fa fa-angle-right">&nbsp;Chính Sách Khách Sỉ</a>
                        <a href="#" class="dropdown-item fa fa-angle-right">&nbsp;Phương Thức Vận Chuyển</a>
                        <a href="#" class="dropdown-item fa fa-angle-right">&nbsp;Phương Thức Thanh Toán & Xuất HD</a>
                        <a href="#" class="dropdown-item fa fa-angle-right">&nbsp;Hỗ Trợ Mua Hàng</a>
                    </div>
                </div>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item mr-5">
                <!-- tim kiem ten sach -->
                <?php
                    if(isset($_GET['id'])) $duongDanTimKiem = $_SERVER['PHP_SELF'] . "?id=".$_GET['id']."&sl=" . $tangSPGioHang;
                    else $duongDanTimKiem = $_SERVER['PHP_SELF'] . "?sl=" . $tangSPGioHang;
                ?>
                <form method="post" action="<?= $duongDanTimKiem ?>" class="form-inline">
                    <div class="input-group">
                        <input class="form-control" type="text" name="timkiem" placeholder="Book title search">
                        <div class="input-group-append">
                            <button class="btn btn-primary fa fa-search" type="submit">&nbsp;Search</button>
                        </div>
                    </div>
                </form>
            </li>
            <li class="nav-item mr-5">
                <a href="#" id="thongBao"><i class="fa fa-2x fa-bell" style="color: white;"></i></a>
            </li>
            <li class="nav-item mr-5">
                <a href="#" id="gioHang"><i class="fa fa-2x fa-cart-plus" style="color: white;"></i><span id="sLSPGioHang" class="badge badge-pill badge-primary align-top"><?= $tangSPGioHang ?></span></a>
            </li>
            <li id="navLogInOut" class="nav-item mr-3">
                <div class="input-group ">
                    <div class="input-group-prepend">
                        <button id="iGLogInOut" type="button" class="dropdown-toggle btn btn-light " data-toggle="dropdown"><?=$tenNguoiDung?>
                            <img src="../anh/logo/avatar.jpg" class="rounded-circle" alt="Me" width="20px">
                        </button>
                        <div id="dMLogInOut" class="dropdown-menu">
                            <?php
                            if (!isset($_SESSION['tenDangNhap'])) :
                            ?>
                                <a class="dropdown-item fa fa-user" href="#" data-toggle="modal" data-target="#dangnhap">&nbsp;Hồ Sơ</a>
                            <?php
                            elseif (isset($_GET['id'])) :
                            ?>
                                <a class="dropdown-item fa fa-user" href="hoSo.php?id=<?=$_GET['id']?>&sl=<?=$tangSPGioHang?>&type=hoso">&nbsp;Hồ Sơ</a>
                            <?php
                            else :
                            ?>
                                <a class="dropdown-item fa fa-user" href="hoSo.php?sl=<?=$tangSPGioHang?>&type=hoso">&nbsp;Hồ Sơ</a>
                            <?php
                            endif;
                            ?>
                            <a class="dropdown-item fa fa-cog" href="#">&nbsp;Tùy Chọn</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item fa fa-sign-in" href="#" data-toggle="modal" data-target="#dangnhap">&nbsp;Đăng Nhập</a>
                            <a class="dropdown-item fa fa-pencil" href="#" data-toggle="modal" data-target="#dangky">&nbsp;Đăng Ký</a>
                            <a class="dropdown-item fa fa-sign-out" href="index.php?sl=<?= $tangSPGioHang ?>&dangXuat=1">&nbsp;Đăng Xuất</a>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>

<!-- toast giỏ hàng -->
<div id="toastGioHang" class="toast" role="alert" data-autohide="false" aria-live="assertive" aria-atomic="true" style="position: fixed; top:60px; right:120px; z-index:4;">
    <div class="toast-header">
        <span><i class="fa fa-2x fa-cart-plus" style="color: red;"></i></span>&nbsp;
        <strong class="mr-auto">Giỏ hàng của bạn</strong>
        <small class="text-muted">press x to exit</small>
        <button id="btnCloseGioHang" type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="toast-body">
        <?php

        use CT275\Project\Sach;

        $tongTien = 0;
        if (!empty($_SESSION) && isset($_SESSION['tenDangNhap'])) :
        ?>
            <table class="text-center">
                <tbody>
                    <?php
                    foreach ($_SESSION as $maSach) :
                        if ($maSach != $_SESSION['tenDangNhap']) :
                            $dsSachGioHang1 = Sach::findMaSach($maSach);
                            $giamGiaGioHang = htmlspecialchars($dsSachGioHang1->giamgia);
                            $giaBanGioHang = htmlspecialchars($dsSachGioHang1->giaban);

                            if ($giamGiaGioHang != 0) {
                                $giaMoiGioHang = $giaBanGioHang * (1 - (float)$giamGiaGioHang / 100);
                            } else {
                                $giaMoiGioHang = $giaBanGioHang;
                            }
                            $tongTien += $giaMoiGioHang;
                    ?>
                            <tr>
                                <td><img src="<?= htmlspecialchars($dsSachGioHang1->hinhanh) ?>" width="30px" class="rounded mr-2" alt="Anh SP"></td>
                                <td class="limitText"><?= htmlspecialchars($dsSachGioHang1->tensach) ?></td>
                                <td class="text-danger">Giá: <?= $giaMoiGioHang ?> đ</td>
                                <td>
                                    <?php
                                    if (isset($_REQUEST['tl'])) {
                                        if (isset($GLOBALS['dsSach'])) {
                                            $path = "buyBook.php?id=" . htmlspecialchars($dsSach->layMaSach()) . "&sl=" . $tangSPGioHang;
                                        } else
                                            isset($_GET['id']) ? $path = "gioHang.php?id=" . $_GET['id'] . "&sl=" . $tangSPGioHang : $path = "index.php?sl=" . $tangSPGioHang . "&tl=" . $_GET['tl'];

                                        /* isset($GLOBALS['dsSach']) ? $path = "buyBook.php?id=" . htmlspecialchars($dsSach->layMaSach()) . "&sl=" . $tangSPGioHang : $path = "index.php?sl=" . $tangSPGioHang . "&tl=" . $_GET['tl']; */
                                    } else {
                                        if (isset($GLOBALS['dsSach'])) {
                                            $path = "buyBook.php?id=" . htmlspecialchars($dsSach->layMaSach()) . "&sl=" . $tangSPGioHang;
                                        } else
                                            isset($_GET['id']) ? $path = "gioHang.php?id=" . $_GET['id'] . "&sl=" . $tangSPGioHang : $path = "index.php?sl=" . $tangSPGioHang;

                                        /* isset($GLOBALS['dsSach']) ? $path = "buyBook.php?id=" . htmlspecialchars($dsSach->layMaSach()) . "&sl=" . $tangSPGioHang : $path = "index.php?sl=" . $tangSPGioHang; */
                                    }
                                    ?>
                                    <form method="post" action="<?= $path ?>" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <button type="submit" class="fa fa-1x fa-trash btn btn-danger"></button>
                                            <input class="form-control" type="hidden" id="<?= htmlspecialchars($dsSachGioHang1->layMaSach()) ?>" name="maSach" value="<?= htmlspecialchars($dsSachGioHang1->layMaSach()) ?>">
                                        </div>
                                    </form>
                                </td>
                            </tr>
                    <?php
                        endif;
                    endforeach;
                    ?>
                </tbody>
            </table>
        <?php
        else :
        ?>
            <p>Chưa có sản phẩm nào trong giỏ hàng của bạn</p>
        <?php
        endif;
        ?>
        <span>THÀNH TIỀN: <?= $tongTien ?> Đ</span>
        <?php
        if (!isset($_SESSION['tenDangNhap'])) :
        ?>
            <a href="#" type="button" name="btnXemGioHang" id="btnXemGioHang" class="btn btn-outline-danger float-right fa fa-1x fa-cart-plus" data-toggle="modal" data-target="#dangnhap">&nbsp;Xem Giỏ Hàng</a>
        <?php
        elseif (isset($_GET['id'])) :
        ?>
            <a href="gioHang.php?id=<?= $_GET['id'] ?>&sl=<?= $tangSPGioHang ?>" type="button" name="btnXemGioHang" id="btnXemGioHang" class="btn btn-outline-danger float-right fa fa-1x fa-cart-plus">&nbsp;Xem Giỏ Hàng</a>
        <?php
        else :
        ?>
            <a href="gioHang.php?sl=<?= $tangSPGioHang ?>" type="button" name="btnXemGioHang" id="btnXemGioHang" class="btn btn-outline-danger float-right fa fa-1x fa-cart-plus">&nbsp;Xem Giỏ Hàng</a>
        <?php
        endif;
        ?>
    </div>
</div>

<!-- toast thông báo -->
<div id="toastThongBao" class="toast" role="alert" data-autohide="false" aria-live="assertive" aria-atomic="true" style="position: fixed; top:60px; right:250px; z-index:3;">
    <div class="toast-header">
        <span><i class="fa fa-2x fa-bell" style="color: red;"></i></span>&nbsp;
        <!-- <img src="../anh/lop1/LS1TL1AN1_1.jpg" width="30px" class="rounded mr-2" alt="..."> -->
        <strong class="mr-auto">Thông Báo</strong>
        <small class="text-muted">press x to exit</small>
        <button id="btnCloseThongBao" type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="toast-body text-center">
        <p class="d-flex justify-content-center"><span><i class="fa fa-5x fa-unlock-alt" style="color: red;"></i></span></p>
        <p class="d-flex justify-content-center">Vui lòng đăng nhập để xem thông báo</p>
        <a href="#" data-toggle="modal" data-target="#dangnhap" type="button" class="btn btn-danger btn-block">Đăng Nhập</a>
        <a href="#" data-toggle="modal" data-target="#dangky" type="button" class="btn btn-outline-danger btn-block">Đăng Ký</a>
    </div>
</div>

<!-- modal đăng nhập -->
<div class="modal fade" id="dangnhap">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <!-- modal header -->
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white"><i class="fa fa-2x fa-unlock-alt">&nbsp;Đăng Nhập</i></h4>
                <button id="btnCloseDangNhap" type="button" class="close" data-dismiss="modal">&times</button>
            </div>
            <!-- modal body -->
            <div class="modal-body">
                <?php
                if (isset($_GET['id'])) $path = $_SERVER['PHP_SELF'] . "?id=" . $_GET['id'] . "&sl=" . $tangSPGioHang;
                else $path = $_SERVER['PHP_SELF'] . "?sl=" . $tangSPGioHang;
                ?>
                <form enctype="multipart/form-data" method="post" action="<?= $path ?>" class="needs-validation" novalidate>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <label for="tenDangNhap" class="input-group-text"><i class="fa fa-envelope-o" style="color: red;"></i></label>
                        </div>
                        <input id="tenDangNhap" name="tenDangNhap" type="text" class="form-control" placeholder="Tên Đăng Nhập" required>
                        <div class="valid-feedback"> Valid.</div>
                        <div class="invalid-feedback"> Please fill out this field.</div>
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <label for="pass1" class="input-group-text"><i class="fa fa-key" style="color: red;"></i></label>
                        </div>
                        <input id="pass1" name="pass1" type="password" class="form-control" placeholder="Mật Khẩu" required>
                        <div class="valid-feedback"> Valid.</div>
                        <div class="invalid-feedback"> Please fill out this field.</div>
                    </div>
                    <div class="form-group form-check">
                        <input id="checkbox1" name="checkbox1" type="checkbox" class="form-check-input">
                        <label for="checkbox1" class="form-check-label">Remember me</label>
                    </div>
                    <button id="btnDangNhap" name="btnDangNhap" type="submit" class="btn btn-danger btn-block">Đăng Nhập</button>
                    <div class="form-group">
                        <a href="#" class="float-left">Quên mật khẩu?</a>
                        <a href="#" class="float-right">Đăng nhập với SMS</a>
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-around">
                <button type="button" class="btn btn-primary"><i class="fa fa-facebook">
                        &nbsp;Facebook</i></button>
                <button type="button" class="btn btn-primary"><i class="fa fa-google-plus">&nbsp;Google</i></button>
                <button type="button" class="btn btn-dark"><i class="fa fa-apple" style="color:white">&nbsp;Apple</i></button>
                <div class="text-center text-secondary">Bạn mới biết về ShopLiTE?
                    <a href="#" id="btnCloseModalDN" data-toggle="modal" data-target="#dangky" class="text-danger">Đăng Ký</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal đăng ký -->
<div class="modal fade" id="dangky">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <!-- modal header -->
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white"><i class="fa fa-1x fa-edit">&nbsp;Đăng Ký Tài Khoản</i></h4>
                <button id="btnCloseDangKy" type="button" class="close" data-dismiss="modal">&times</button>
            </div>
            <!-- modal body -->
            <div class="modal-body">
                <?php
                if (isset($_GET['id'])) $path = $_SERVER['PHP_SELF'] . "?id=" . $_GET['id'] . "&sl=" . $tangSPGioHang;
                else $path = $_SERVER['PHP_SELF'] . "?sl=" . $tangSPGioHang;
                ?>
                <form id="signupForm" name="signupForm" enctype="multipart/form-data" method="post" action="<?= $path ?>">
                    <div class="row">
                        <!-- tên người dùng -->
                        <div class="col-6 form-group input-group">
                            <div class="input-group-prepend">
                                <label for="ho" class="input-group-text"><i class="fa fa-fw fa-user" style="color: red;"></i></label>
                            </div>
                            <input id="ho" name="ho" type="text" class="form-control" placeholder="Name">
                        </div>
                        <div class="col-6 form-group input-group">
                            <div class="input-group-prepend">
                                <label for="ten" class="input-group-text"><i class="fa fa-fw fa-user" style="color: red;"></i></label>
                            </div>
                            <input id="ten" name="ten" type="text" class="form-control" placeholder="Tên Đăng Nhập">
                        </div>
                    </div>
                    <div class="row">
                        <!-- giới tính -->
                        <div class="col">
                            <div class="custom-radio custom-control custom-control-inline">
                                <input id="nam" name="gioitinh" type="radio" class="custom-control-input" value="Nam" checked>
                                <label class="custom-control-label" for="nam">Nam</label>
                            </div>
                            <div class="custom-radio custom-control custom-control-inline">
                                <input id="nu" name="gioitinh" type="radio" class="custom-control-input" value="Nữ">
                                <label class="custom-control-label" for="nu">Nữ</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- email -->
                        <div class="col form-group input-group">
                            <div class="input-group-prepend">
                                <label for="email" class="input-group-text"><i class="fa fa-fw fa-envelope-o" style="color: red;"></i></label>
                            </div>
                            <input id="email" name="email" type="text" class="form-control" placeholder="Enter Email">
                        </div>
                    </div>
                    <div class="row">
                        <!-- điện thoại -->
                        <div class="col form-group input-group">
                            <div class="input-group-prepend">
                                <label for="sdt" class="input-group-text"><i class="fa fa-fw fa-phone" style="color: red;"></i></label>
                                <select class="custom-select" id="maVung">
                                    <option value="1" selected>+84</option>
                                    <option value="2">+82</option>
                                    <option value="3">+86</option>
                                    <option value="4">+81</option>
                                </select>
                            </div>
                            <input id="sdt" name="sdt" type="text" class="form-control" placeholder="Phone Number">
                        </div>
                    </div>
                    <div class="row">
                        <!-- nghề nghiệp -->
                        <div class="col form-group input-group">
                            <div class="input-group-prepend">
                                <label for="congviec" class="input-group-text"><i class="fa fa-fw fa-graduation-cap" style="color: red;"></i></label>
                            </div>
                            <select class="custom-select" name="congviec" id="congviec">
                                <option value="Kỹ Sư" selected>Kỹ Sư</optionva>
                                <option value="Bác Sĩ">Bác Sĩ</optionva>
                                <option value="Giáo Viên">Giáo Viên</optionva>
                                <option value="Học Sinh">Học Sinh</optionva>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Địa chỉ -->
                        <div class="col form-group input-group">
                            <div class="input-group-prepend">
                                <label for="dchi" class="input-group-text"><i class="fa fa-fw fa-map-marker" style="color: red;"></i></label>
                            </div>
                            <input id="dchi" name="dchi" type="text" class="form-control" placeholder="Enter Address">
                        </div>
                    </div>
                    <div class="row">
                        <!-- mật khẩu -->
                        <div class="col-6 form-group input-group">
                            <div class="input-group-prepend">
                                <label for="matkhau" class="input-group-text"><i class="fa fa-fw fa-lock" style="color: red;"></i></label>
                            </div>
                            <input id="matkhau" name="matkhau" type="password" class="form-control" placeholder="Enter Password">
                        </div>
                        <!-- nhap lai mat khau -->
                        <div class="col-6 form-group input-group">
                            <div class="input-group-prepend">
                                <label for="xacNhanMK" class="input-group-text"><i class="fa fa-fw fa-lock" style="color: red;"></i></label>
                            </div>
                            <input id="xacNhanMK" name="xacNhanMK" type="password" class="form-control" placeholder="Comfirm Password">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10 offset-1 form-group form-check">
                            <input class="form-check-input" type="checkbox" id="agree" name="agree" value="agree" />
                            <label class="form-check-label" for="agree">Đồng ý các quy định của chúng tôi</label>
                        </div>
                    </div>
                    <button id="btnDangKy" name="btnDangKy" type="submit" class="btn btn-danger btn-block">Đăng Ký&nbsp;<i class="fa fa-arrow-right"></i></button>
                    <button type="button" class="btn btn-primary btn-block fa fa-arrow-left" data-toggle="modal" data-target="#dangnhap" id="btnCloseModalDK">&nbsp;Đăng Nhập</button>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-around">
                <button type="button" class="btn btn-primary"><i class="fa fa-google-plus">&nbsp;Đăng Nhập Cùng
                        Google</i></button>
            </div>
        </div>
    </div>
</div>