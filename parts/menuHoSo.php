<?php
    if (isset($_GET['id']) && isset($_REQUEST['timkiem'])) $pathHoSo = $_SERVER['PHP_SELF'] . "?id=" . $_GET['id'] . "&sl=" . $tangSPGioHang;
    elseif(isset($_GET['id'])) $pathHoSo = $_SERVER['PHP_SELF'] . "?id=" . $_GET['id'] . "&sl=" . $tangSPGioHang;
    else $pathHoSo = $_SERVER['PHP_SELF'] . "?sl=" . $tangSPGioHang;
?>
<div id="menuHoSo" class="card">
    <div class="card-header" style="background:#ffccff;">
        <a class="collapsed card-link fa fa-address-card" data-toggle="collapse" href="#taiKhoanCuaToi">&nbsp;Tài Khoản Của Tôi</span></a>
    </div>
    <div id="taiKhoanCuaToi" class="collapse show">
        <div class="card-body">
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <!-- data-toggle="pill" : để đánh dấu(tô màu) link được kích hoạt -->
                    <a class="nav-link fa fa-angle-right" href="<?=$pathHoSo."&type=hoso"?>" id="hoSo">&nbsp;Hồ Sơ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fa fa-angle-right" href="#" id="nganHang">&nbsp;Ngân Hàng</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fa fa-angle-right" href="#" id="diaChi">&nbsp;Địa Chỉ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fa fa-angle-right" href="<?=$pathHoSo."&type=changePass"?>" id="doiMatKhau">&nbsp;Đổi Mật Khẩu</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header" style="background:#ffccff;">
        <a class="collapsed card-link fa fa-bell" data-toggle="collapse" href="#thongBao">&nbsp;Thông Báo</span></a>
    </div>
    <div id="thongBao" class="collapse show">
        <div class="card-body">
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <!-- data-toggle="pill" : để đánh dấu(tô màu) link được kích hoạt -->
                    <a class="nav-link fa fa-angle-right" href="#" id="capNhatDonHang">&nbsp;Cập Nhật Đơn Hàng</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fa fa-angle-right" href="#" id="khuyenMai">&nbsp;Khuyến Mãi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fa fa-angle-right" href="#" id="capNhatVi">&nbsp;Cập Nhật Ví</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fa fa-angle-right" href="#" id="hoatDong">&nbsp;Hoạt Động</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fa fa-angle-right" href="#" id="capNhatDanhGia">&nbsp;Cập Nhật Đánh Giá</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fa fa-angle-right" href="#" id="capNhatShopLite">&nbsp;Cập Nhật ShopLite</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header" style="background:#ffccff;">
        <a class="card-link fa fa-stack-exchange" href="<?=$pathHoSo."&type=donMua"?>">&nbsp;Đơn Mua</span></a>
    </div>
    
</div>
<div class="card">
    <div class="card-header" style="background:#ffccff;">
        <a class="collapsed card-link fa fa-book" data-toggle="collapse" href="#khoVoucher">&nbsp;Kho Voucher</span></a>
    </div>
    <div id="khoVoucher" class="collapse show">
        
    </div>
</div>
<div class="card">
    <div class="card-header" style="background:#ffccff;">
        <a class="collapsed card-link fa fa-scribd" data-toggle="collapse" href="#shopLiteXu">&nbsp;ShopLite Xu</span></a>
    </div>
    <div id="shopLiteXu" class="collapse show">
        
    </div>
</div>