<?php
require_once '../bootstrap.php';

use CT275\Project\Sach;
use CT275\Project\HoaDon;
use CT275\Project\TheLoai;
use CT275\Project\LoaiSach;
use CT275\Project\PhieuMuaHang;

$tangSPGioHang = $_GET['sl'];
if (isset($_REQUEST['maSach'])) {
    unset($_SESSION[$_REQUEST['maSach']]);
    #header("Refresh:0");
    $tangSPGioHang = $tangSPGioHang - 1;
}
if (isset($_REQUEST['xoaTatCaSP'])) {
    foreach ($_SESSION as $sp) {
        if ($sp != $_SESSION['tenDangNhap']) {
            unset($_SESSION[$sp]);
            #header("Refresh:0");
            $tangSPGioHang = $tangSPGioHang - 1;
        }
    }
}
if (isset($_REQUEST['maHD'])) {
    $dsSPThemSession = PhieuMuaHang::findAllSPHD($_REQUEST['maHD']);
    foreach ($dsSPThemSession as $dsMaSP) {
        $checkMS = true;
        foreach ($_SESSION as $sachOnSession) {
            if ($sachOnSession == $dsMaSP->layMaSach()) {
                $checkMS = false;
                break;
            }
        }
        if ($checkMS) {
            $_SESSION[$dsMaSP->layMaSach()] = $dsMaSP->layMaSach();
            $tangSPGioHang = $tangSPGioHang + 1;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tinhTien'])) {
    $sLHD = HoaDon::SLHD() + 1;
    $hd = new HoaDon();
    while (1) {
        if ($sLHD < 10) $mahd = "HD00" . $sLHD;
        else $mahd = "HD0" . $sLHD;
        if ($hd::find($mahd) == null) break;
        else $sLHD++;
    }
    $hoaDon['mahd'] = $mahd;
    $hoaDon['makh'] = $_SESSION['tenDangNhap'];
    $hoaDon['ngaylap'] = date("Y-m-d");
    $hoaDon['giatrihd'] = $_POST['giaTien'];
    $hd->fill($hoaDon)->saveNew();

    $checkbox = $_POST['chkSPDuocChon'];
    foreach ($checkbox as $chkKey => $chkValue) {
        $phieuSP = [];
        foreach ($_SESSION as $Skey => $SValue) {
            if ($chkValue == $SValue) {
                $phieuSP['mahd'] = $hoaDon['mahd'];
                $phieuSP['masach'] = $SValue;
                $phieuSP['soluong'] = $_POST[$SValue];
                $phieuSP['ngaydat'] = date("Y-m-d");
                $phieuSP['ngaygiao'] = date("Y-m-d", strtotime('+5 day', strtotime(date("Y-m-d"))));
                $phieuSP['kieuthanhtoan'] = $_POST['PTTT'];
                $phieuMH = new PhieuMuaHang();
                $phieuMH->fill($phieuSP)->saveNew();
            }
        }
    }
    echo "<script>alert('Sản phẩm đặt mua thành công!'); </script>";
}
$dsGioiThieu = Sach::findMaTheLoai('LS6TL1');
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
                    <li class="breadcrumb-item fa fa-home">&nbsp;<a href="index.php?sl=<?= $tangSPGioHang ?>">HOME</a>
                    </li>
                    <?php
                    if (isset($_GET['id'])) :
                    ?>
                        <li class="breadcrumb-item limitText"><a href="buyBook.php?id=<?= $_GET['id'] ?>&sl=<?= $tangSPGioHang ?>">Chi Tiết Sách</a></li>
                    <?php
                    else :
                    ?>
                        <li class="breadcrumb-item limitText"><a href="buyBook.php?id=LS1TL1S1&sl=<?= $tangSPGioHang ?>">Chi
                                Tiết Sách</a></li>
                    <?php
                    endif;
                    ?>
                    <li class="breadcrumb-item active limitText">Giỏ Hàng</li>
                </ul>

                <div class="alert alert-warning" style="margin-bottom:6px; ">
                    <span><i class="fa fa-bus text-success"></i>&nbsp;Nhấn vào mục Mã giảm giá ở cuối trang để hưởng
                        miễn phí vận chuyển bạn nhé!</span>
                </div>

                <!-- cột tiêu đề cho thông tin sản phẩm -->
                <div class="alert alert-light" style="margin:0px;">
                    <div class="row text-center">
                        <!-- cột checkbox để check all sp -->
                        <div class="col-1">
                            <form class="form-inline" method="post" action="#" enctype="multipart/form-data">
                                <div class="form-check">
                                    <input id="chonAllSP1" class="form-check-input" type="checkbox" name="chkSPDuocChon[]" value="true" checked>
                                    <label for="chkAllSP1" class="form-check-label"></label>
                                </div>
                            </form>
                        </div>
                        <!-- cột tên, hình ảnh, loại sản phẩm -->
                        <div class="col-6">Sản phẩm</div>
                        <!-- cột giá sản phẩm -->
                        <div class="col-1">Giá Bán</div>
                        <!-- cột số lượng -->
                        <div class="col-2">Số Lượng</div>
                        <!-- cột số tiền -->
                        <div class="col-1">Số Tiền</div>
                        <!-- cột thao tác (xóa) -->
                        <div class="col-1">Thao Tác</div>
                    </div>
                </div> <!-- dòng tiêu đề sản phẩm -->

                <!-- liệt kê danh sách sản phẩm trong giỏ hàng -->
                <?php
                if (isset($_GET['id'])) {
                    $muasp = "gioHang.php?id=" . $_GET['id'] . "&sl=" . $tangSPGioHang;
                } else $muasp = "gioHang.php?sl=" . $tangSPGioHang;
                ?>
                <form onsubmit="return checkSLSP()" method="post" action="<?= $muasp ?>" enctype="multipart/form-data">
                    <?php
                    $tongTien = 0;
                    $demSL = 0;
                    if (!empty($_SESSION)  && isset($_SESSION['tenDangNhap'])) :
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
                                $demSL++;
                    ?>
                                <div class="card mt-3">
                                    <div class="card-header" style="background:#ffccff;">
                                        <span class="badge badge-danger align-middle" style="font-size:15px;">Deal
                                            sốc</span>&nbsp;<span>Mua kèm deal độc quyền</span><a href="#" class="text-danger" style="font-size:15px;text-decoration: none;" role="button">&nbsp;&nbsp;Xem Thêm
                                            &nbsp;<span class="fa fa-chevron-right" style="color:red"></span></a>
                                    </div>
                                    <div class="card-body">
                                        <div class="card-text">
                                            <div class="row ">
                                                <!-- cột checkbox để check all sp -->
                                                <div class="col-1">

                                                    <div class="form-check ">
                                                        <input id="chk<?= htmlspecialchars($dsSachGioHang1->layMaSach()) ?>" class="form-check-input" type="checkbox" name="chkSPDuocChon[]" value="<?= htmlspecialchars($dsSachGioHang1->layMaSach()) ?>" checked>
                                                    </div>
                                                </div>
                                                <!-- cột hình ảnh, loại sản phẩm -->
                                                <div class="col-1">
                                                    <img src="<?= htmlspecialchars($dsSachGioHang1->hinhanh) ?>" width="60px" class="rounded" alt="Anh SP">
                                                </div>
                                                <!-- cột tên sản phẩm -->
                                                <div class="col-5"><?= htmlspecialchars($dsSachGioHang1->tensach) ?></div>
                                                <!-- cột giá sản phẩm -->
                                                <div class="col-1"><small><sup><u>đ</u></sup></small><?= $giaMoiGioHang ?> </div>
                                                <!-- cột số lượng sản phẩm-->
                                                <div class="col-2">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <button id="btnGiamSL<?= htmlspecialchars($dsSachGioHang1->layMaSach()) ?>" class="btn btn-light" type="button"><b>-</b></button>
                                                        </div>
                                                        <button id="btnSLSPMua<?= htmlspecialchars($dsSachGioHang1->layMaSach()) ?>" class="btn btn-light" type="button">1</button>
                                                        <input id="txtSLMua<?= htmlspecialchars($dsSachGioHang1->layMaSach()) ?>" class="form-control" type="hidden" name="<?= htmlspecialchars($dsSachGioHang1->layMaSach()) ?>" value="1">
                                                        <div class="input-group-append">
                                                            <button id="btnTangSL<?= htmlspecialchars($dsSachGioHang1->layMaSach()) ?>" class="btn btn-light" type="button"><b>+</b></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- cột số tiền -->
                                                <div class="col-1 text-danger">
                                                    <small><sup><u>đ</u></sup></small><span id="TT<?= htmlspecialchars($dsSachGioHang1->layMaSach()) ?>"><?= $giaMoiGioHang ?>
                                                        <span>
                                                </div>
                                                <!-- cột thao tác (xóa) -->
                                                <div class="col-1">
                                                    <?php
                                                    if (isset($_GET['id'])) :
                                                    ?>
                                                        <a href="gioHang.php?id=<?= $_GET['id'] ?>&sl=<?= $tangSPGioHang ?>&maSach=<?= htmlspecialchars($dsSachGioHang1->layMaSach()) ?>" type="button" name="maSach" class="fa fa-1x fa-trash btn btn-danger"></a>
                                                    <?php
                                                    else :
                                                    ?>
                                                        <a href="gioHang.php?sl=<?= $tangSPGioHang ?>&maSach=<?= htmlspecialchars($dsSachGioHang1->layMaSach()) ?>" type="button" name="maSach" class="fa fa-1x fa-trash btn btn-danger"></a>
                                                    <?php
                                                    endif;
                                                    ?>

                                                </div>
                                            </div>
                                            <script>
                                                $(document).ready(function() {

                                                    var <?= "soLuongMua" . htmlspecialchars($dsSachGioHang1->layMaSach()) ?> =
                                                        $('#txtSLMua<?= htmlspecialchars($dsSachGioHang1->layMaSach()) ?>')
                                                        .val();
                                                    $('#btnGiamSL<?= htmlspecialchars($dsSachGioHang1->layMaSach()) ?>').click(
                                                        function() {
                                                            if (<?= "soLuongMua" . htmlspecialchars($dsSachGioHang1->layMaSach()) ?> >
                                                                1) {
                                                                /* <?= "soLuongMua" . htmlspecialchars($dsSachGioHang1->layMaSach()) ?>--; */

                                                                $("#btnSLSPMua<?= htmlspecialchars($dsSachGioHang1->layMaSach()) ?>")
                                                                    .text(--
                                                                        <?= "soLuongMua" . htmlspecialchars($dsSachGioHang1->layMaSach()) ?>
                                                                    );
                                                                $('#txtSLMua<?= htmlspecialchars($dsSachGioHang1->layMaSach()) ?>')
                                                                    .val(
                                                                        <?= "soLuongMua" . htmlspecialchars($dsSachGioHang1->layMaSach()) ?>
                                                                    );
                                                                $('#TT<?= htmlspecialchars($dsSachGioHang1->layMaSach()) ?>')
                                                                    .text(<?= $giaMoiGioHang ?> *
                                                                        <?= "soLuongMua" . htmlspecialchars($dsSachGioHang1->layMaSach()) ?>
                                                                    );

                                                                var checkbox = document.getElementsByName(
                                                                    'chkSPDuocChon[]');
                                                                var thanhTien = 0;
                                                                for (var i = 0; i < checkbox.length; i++) {
                                                                    if (checkbox[i].checked === true) {
                                                                        <?php
                                                                        if (!empty($_SESSION) && isset($_SESSION['tenDangNhap']))
                                                                            foreach ($_SESSION as $maSach1) :
                                                                                if ($maSach1 != $_SESSION['tenDangNhap']) :
                                                                                    $dsSachGioHang11 = Sach::findMaSach($maSach1);

                                                                        ?>
                                                                                if (checkbox[i].value ==
                                                                                    '<?= htmlspecialchars($dsSachGioHang11->layMaSach()) ?>'
                                                                                ) {
                                                                                    thanhTien += Number($(
                                                                                        '#TT<?= htmlspecialchars($dsSachGioHang11->layMaSach()) ?>'
                                                                                    ).text());
                                                                                }
                                                                        <?php
                                                                                endif;
                                                                            endforeach;
                                                                        ?>
                                                                    }
                                                                }
                                                                $('#tongThanhToan').text(thanhTien);
                                                                $('#giaTien').val(thanhTien);
                                                            }
                                                        });

                                                    $('#btnTangSL<?= htmlspecialchars($dsSachGioHang1->layMaSach()) ?>').click(
                                                        function() {
                                                            /* <?= "soLuongMua" . htmlspecialchars($dsSachGioHang1->layMaSach()) ?>++; */
                                                            $("#btnSLSPMua<?= htmlspecialchars($dsSachGioHang1->layMaSach()) ?>")
                                                                .text(++
                                                                    <?= "soLuongMua" . htmlspecialchars($dsSachGioHang1->layMaSach()) ?>
                                                                );
                                                            $('#txtSLMua<?= htmlspecialchars($dsSachGioHang1->layMaSach()) ?>')
                                                                .val(
                                                                    <?= "soLuongMua" . htmlspecialchars($dsSachGioHang1->layMaSach()) ?>
                                                                );
                                                            $('#TT<?= htmlspecialchars($dsSachGioHang1->layMaSach()) ?>')
                                                                .text(<?= $giaMoiGioHang ?> *
                                                                    <?= "soLuongMua" . htmlspecialchars($dsSachGioHang1->layMaSach()) ?>
                                                                );

                                                            var checkbox = document.getElementsByName('chkSPDuocChon[]');
                                                            var thanhTien = 0;
                                                            for (var i = 0; i < checkbox.length; i++) {
                                                                if (checkbox[i].checked === true) {
                                                                    <?php
                                                                    if (!empty($_SESSION) && isset($_SESSION['tenDangNhap']))
                                                                        foreach ($_SESSION as $maSach1) :
                                                                            if ($maSach1 != $_SESSION['tenDangNhap']) :
                                                                                $dsSachGioHang11 = Sach::findMaSach($maSach1);

                                                                    ?>
                                                                            if (checkbox[i].value ==
                                                                                '<?= htmlspecialchars($dsSachGioHang11->layMaSach()) ?>'
                                                                            ) {
                                                                                thanhTien += Number($(
                                                                                    '#TT<?= htmlspecialchars($dsSachGioHang11->layMaSach()) ?>'
                                                                                ).text());
                                                                            }
                                                                    <?php
                                                                            endif;
                                                                        endforeach;
                                                                    ?>
                                                                }
                                                            }
                                                            $('#tongThanhToan').text(thanhTien);
                                                            $('#giaTien').val(thanhTien);
                                                        });

                                                    $("#chk<?= htmlspecialchars($dsSachGioHang1->layMaSach()) ?>").click(
                                                        function() {
                                                            var checkbox = document.getElementsByName('chkSPDuocChon[]');
                                                            checkbox[checkbox.length - 1].checked = false;
                                                            checkbox[0].checked = false;
                                                            var thanhTien = 0,
                                                                sLSPThanhToan = 0;
                                                            for (var i = 0; i < checkbox.length; i++) {
                                                                if (checkbox[i].checked === true) {
                                                                    <?php
                                                                    if (!empty($_SESSION) && isset($_SESSION['tenDangNhap']))
                                                                        foreach ($_SESSION as $maSach1) :
                                                                            if ($maSach1 != $_SESSION['tenDangNhap']) :
                                                                                $dsSachGioHang11 = Sach::findMaSach($maSach1);
                                                                    ?>
                                                                            if (checkbox[i].value ==
                                                                                '<?= htmlspecialchars($dsSachGioHang11->layMaSach()) ?>'
                                                                            ) {
                                                                                thanhTien += Number($(
                                                                                    '#TT<?= htmlspecialchars($dsSachGioHang11->layMaSach()) ?>'
                                                                                ).text());
                                                                                sLSPThanhToan++;
                                                                            }
                                                                    <?php
                                                                            endif;
                                                                        endforeach;
                                                                    ?>
                                                                }
                                                            }
                                                            $('#tongThanhToan').text(thanhTien);
                                                            $('#giaTien').val(thanhTien);
                                                            $('#sLSPThanhToan').text(sLSPThanhToan);
                                                        });

                                                });
                                            </script>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-white">
                                        <p><i class="fa fa-list-alt text-danger"></i>&nbsp;Shop Voucher giảm đến 10% &nbsp;<a href="#">Xem thêm voucher</a></p>
                                        <hr>
                                        <p><i class="fa fa-car text-success"></i>&nbsp;Giảm ₫25.000 phí vận chuyển đơn tối thiểu
                                            ₫50.000
                                            &nbsp;<a href="#">Tìm hiểu thêm</a></p>

                                    </div>
                                </div>
                        <?php
                            endif;
                        endforeach;
                    else :
                        ?>
                        <div class="alert alert-success">Bạn chưa có sản phẩm nào trong giỏ hàng.</div>
                    <?php
                    endif;
                    ?>
                    <!-- card chọn sản phẩm, xóa tất cả -->
                    <div class="card mt-3">
                        <div class="card-header bg-white">
                            <div class="row">
                                <div class="col-3">
                                    <h5>Phương thức thanh toán</h5>
                                </div>
                                <div class="col-3 offset-3">
                                    <span class="mx-auto"><i class="fa fa-list-alt text-danger"></i>&nbsp;Shopee
                                        Voucher</span>
                                </div>
                                <div class="col-3">
                                    <a href="#" class="float-right">Chọn hoặc nhập mã</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-text">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <label for="PTTT" class="input-group-text"><i class="fa fa-fw fa-google-wallet" style="color: red;"></i></label>
                                                <select class="custom-select" id="PTTT" name="PTTT">
                                                    <option value="Thanh toán khi nhận hàng" selected>Thanh toán khi
                                                        nhận hàng</option>
                                                    <option value="Thẻ tín dụng/Ghi nợ">Thẻ tín dụng/Ghi nợ</option>
                                                    <option value="Ví ShopLite/ZaloPay">Ví ShopLite/ZaloPay</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2 offset-3 ">
                                        <div class="form-check ">
                                            <input id="shopXu" class="form-check-input" type="checkbox" name="shopXu" value="100" checked>
                                            <label for="shopXu" class="form-check-label">&nbsp;
                                                <span class="mx-auto"><i class="fa fa-skype text-warning"></i>&nbsp;Shopee Xu</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <span>Dùng 100 Shopee Xu &nbsp;</span>
                                    </div>
                                    <div class="col-1">
                                        <p class="text-danger">-100<small><sup><u>đ</u></sup></small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-white">
                            <div class="row" style="margin: 0; padding:0px;">
                                <div class="col-2">
                                    <div class="form-check ">
                                        <input id="chonAllSP2" class="form-check-input" type="checkbox" name="chkSPDuocChon[]" value="chonAllSP2" checked>
                                        <label for="chonAllSP2" class="form-check-label">Chọn tất cả
                                            (<?= count($_SESSION) - 1 ?>)</label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <?php
                                    if (isset($_GET['id'])) :
                                    ?>
                                        <a href="gioHang.php?id=<?= $_GET['id'] ?>&sl=<?= $tangSPGioHang ?>&xoaTatCaSP=1" type="button" class="fa fa-1x fa-trash btn btn-outline-danger btn-block" id="xoaTatCaSP" name="xoaTatCaSP">&nbsp;Xóa Tất Cả SP</a>
                                    <?php
                                    else :
                                    ?>
                                        <a href="gioHang.php?sl=<?= $tangSPGioHang ?>&xoaTatCaSP=1" type="button" class="fa fa-1x fa-trash btn btn-outline-danger btn-block" id="xoaTatCaSP" name="xoaTatCaSP">&nbsp;Xóa Tất Cả SP</a>
                                    <?php
                                    endif;
                                    ?>
                                </div>
                                <div class="col-2">
                                    <!-- <form class="form-inline" method="post" action="#" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <button type="submit" class="fa fa-1x fa-trash btn btn-outline-danger btn-block">&nbsp;Bỏ Các SP Không Hoạt Động</button>
                                        <input class="form-control" type="hidden" name="boSPKhongSD" value="#">
                                    </div>
                                </form> -->
                                </div>
                                <div class="col-2">
                                    <span>Tổng thanh toán (<span id="sLSPThanhToan"><?= count($_SESSION) - 1 ?></span>
                                        Sản
                                        phẩm):</span>
                                </div>
                                <div class="col-2">
                                    <h3 class="text-danger"><small><sup><u>đ</u></sup></small><span id="tongThanhToan"><?= $tongTien ?></span> </h3>
                                    <input class="form-control" type="hidden" id="giaTien" name="giaTien" value="<?= $tongTien ?>">
                                </div>
                                <div class="col-2">
                                    <button type="submit" id="tinhTien" name="tinhTien" class="btn btn-danger btn-block">Mua Ngay</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <div id="modal_sp" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title fa fa-2x fa-shopping-basket text-danger" id="my-modal-title">
                                    &nbsp;Giỏ Hàng</h4>
                                <button class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-center">Bạn chưa chọn sản phẩm nào để mua!</div>
                            <div class="modal-footer">
                                <button type="button" id='cancel' data-dismiss='modal' class="btn btn-danger btn-block">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- card thong tin san pham duoc gioi thieu -->
                <?php
                include_once('../parts/spGioiThieu.php');
                ?>

                <!-- phần đuôi -->
                <?php
                include("../parts/footer.php");
                ?>
            </div> <!-- cot chinh col-12 -->
        </div> <!-- dong chinh -->
    </div> <!-- container -->

    <script>
        var check = false;
        /* checkbox cho san pham duoc chon ở đầu trang*/
        $('#chonAllSP1').click(function() {
            var checkbox = document.getElementsByName('chkSPDuocChon[]');
            var thanhTien = 0;
            if (check == false) {
                for (var i = 0; i < checkbox.length; i++) {
                    checkbox[i].checked = false;
                }
                $('#tongThanhToan').text('0');
                $('#giaTien').val(0);
                check = true;
            } else {
                // Lặp qua từng checkbox để lấy giá trị
                for (var i = 0; i < checkbox.length; i++) {
                    checkbox[i].checked = true;
                }
                <?php
                if (!empty($_SESSION) && isset($_SESSION['tenDangNhap']))
                    foreach ($_SESSION as $maSach) :
                        if ($maSach != $_SESSION['tenDangNhap']) :
                            $dsSachGioHang1 = Sach::findMaSach($maSach);

                ?>
                        thanhTien += Number($('#TT<?= htmlspecialchars($dsSachGioHang1->layMaSach()) ?>').text());
                <?php
                        endif;
                    endforeach;
                ?>
                $('#tongThanhToan').text(thanhTien);
                $('#giaTien').val(thanhTien);
                check = false;
            }
        });
        /* checkbox cho san pham duoc chon ở cuối trang*/
        $('#chonAllSP2').click(function() {
            var checkbox = document.getElementsByName('chkSPDuocChon[]');
            var thanhTien = 0;
            if (check == false) {
                for (var i = 0; i < checkbox.length; i++) {
                    checkbox[i].checked = false;
                }
                $('#tongThanhToan').text('0');
                $('#giaTien').val(0);
                check = true;
            } else {
                // Lặp qua từng checkbox để lấy giá trị
                for (var i = 0; i < checkbox.length; i++) {
                    checkbox[i].checked = true;
                }
                <?php
                if (!empty($_SESSION) && isset($_SESSION['tenDangNhap']))
                    foreach ($_SESSION as $maSach) :
                        if ($maSach != $_SESSION['tenDangNhap']) :
                            $dsSachGioHang1 = Sach::findMaSach($maSach);

                ?>
                        thanhTien += Number($('#TT<?= htmlspecialchars($dsSachGioHang1->layMaSach()) ?>').text());
                <?php
                        endif;
                    endforeach;
                ?>
                $('#tongThanhToan').text(thanhTien);
                $('#giaTien').val(thanhTien);
                check = false;
            }
        });
        /* hàm kiểm tra không gửi form nếu chưa chọn sản phẩm nào */
        function checkSLSP() {
            var checkbox = document.getElementsByName('chkSPDuocChon[]');
            var dem = 0;
            for (var i = 0; i < checkbox.length; i++) {
                if (checkbox[i].checked == true) dem++;
            }
            if (<?= count($_SESSION) ?> == 1 || <?= $tangSPGioHang ?> == 0 || dem == 0) {
                $('#modal_sp').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            } else return true;
            return false;
        }
    </script>
</body>

</html>