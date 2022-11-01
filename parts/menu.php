<?php
use CT275\Project\TheLoai;

?>
<!-- Toast tin nhan -->
<div class="message">
    <a href="#" id="clickToast1" style="position: fixed; bottom:20px; right:20px;"><i class="fa fa-comments fa-3x"></i></a>
</div>
<div id="linkmessge">
    <div class="d-inline-flex flex-column" style="position: fixed; bottom:110px; left:5px;">
        <a href="#" id="clickToast2" class="text-white bg-primary"><i class="fa fa-facebook fa-2x p-1 "></i><span class="share bg-primary">FACEBOOK</span></a>
        <a href="#" id="clickToast3" class="text-white bg-info"><i class="fa fa-twitter fa-2x p-1 "></i><span class="share bg-info">TWITTER</span></a>
        <a href="#" id="clickToast4" class="text-white bg-danger"><i class="fa fa-skype fa-2x p-1 "></i><span class="share bg-danger">SKYPE</span></a>
        <a href="#" id="clickToast5" class="text-white bg-primary"><i class="fa fa-linkedin fa-2x p-1 "></i><span class="share bg-primary">LINKEIN</span></a>
        <a href="#" id="clickToast6" class="text-white bg-info"><i class="fa fa-instagram fa-2x p-1 "></i><span class="share bg-info">INSTAGRAM</span></a>
        <a href="#" id="clickToast7" class="text-white bg-danger"><i class="fa fa-phone fa-2x p-1"></i><span class="share bg-danger">PHONE</span></a>
        <a href="#" id="clickToast8" class="text-white bg-primary"><i class="fa fa-envelope fa-2x p-1"></i><span class="share bg-primary">EVELOPE</span></a>
        <a href="#" id="clickToast9" class="text-white bg-info"><i class="fa fa-share-alt fa-2x p-1 "></i><span class="share bg-info">SHARES</span></a>
        <a href="#" id="clickToast7" class="text-white bg-danger"><i class="fa fa-send fa-2x p-1"></i><span class="share bg-danger">SEND</span></a>
        <a href="#" id="clickToast9" class="text-white bg-primary"><i class="fa fa-google fa-2x p-1"></i><span class="share bg-primary">GOOGLE</span></a>
        <a href="#" id="clickToast10" class="text-white bg-dark ">&lt;&lt;</a>
    </div>
</div>
<a href="#actionImg" id="idpageup" style="position: fixed; bottom:310px; right:5px; opacity: 0.5;"><i class="fa fa-arrow-circle-up fa-4x"></i></a>
<a href="#pagedown" id="idpagedown" style="position: fixed; bottom:250px; right:5px; opacity: 0.5;"><i class="fa fa-arrow-circle-down fa-4x"></i></a>

<div id="toastMessage" class="toast" data-autohide="false" style="position: fixed; bottom:60px; right:60px; background-color:#ccff66; z-index:1">
    <div class="toast-header bg-primary text-white">
        <strong class="mr-auto fa fa-2x fa-scribd">HopLiTE</strong>
        <i role="button" class="ml-3 fa fa-2x fa-commenting"></i>
        <i role="button" class="ml-3 fa-2x fa fa-window-minimize" data-dismiss="toast"></i>
    </div>
    <div class="toast-body">
        <h4>Chat với ShopLiTE</h4>
        <p class="text-primary">Thường phản hồi trong vòng một giờ</p>
        <p>Chào bạn! Nếu bạn cần hỗ trợ hãy để lại lời nhắn, ShopLiTE sẽ hỗ trợ bạn</p>
        <button class="mx-auto fa fa-comment-o btn btn-primary d-flex justify-content-center">&nbsp;Tiếp
            tục với
            ...</button>
    </div>
</div>

<!-- menu sach -->
<div id="accordion">
<?php foreach ($dsLoaiSach as $loaisach) : ?>
    <div class="card">
        <div class="card-header" style="background:#ffccff;">
            <a class="collapsed card-link fa fa-book" data-toggle="collapse" href="#<?= htmlspecialchars($loaisach->layMaLoai()) ?>">&nbsp;<?= htmlspecialchars($loaisach->tenloai) ?></span></a>
        </div>
        <div id="<?=htmlspecialchars($loaisach->layMaLoai()) ?>" class="collapse show"> <!-- data-parent="#accordion" -->
            <div class="card-body">
                <ul class="nav nav-pills flex-column">
                <?php 
                $maloai = htmlspecialchars($loaisach->layMaLoai()) ;
                $dsTheLoaiSach = TheLoai::findMaLoai($maloai);
                if(!empty($dsTheLoaiSach)) foreach ($dsTheLoaiSach as $theloaisach) : ?>
                    <li class="nav-item">
                        <!-- data-toggle="pill" : để đánh dấu(tô màu) link được kích hoạt -->
                        <a class="nav-link fa fa-angle-right" href="index.php?tl=<?= htmlspecialchars($theloaisach->layMaTheLoai()) ?>&sl=<?=$tangSPGioHang?>" id="<?= htmlspecialchars($theloaisach->layMaTheLoai()) ?>">&nbsp;<?= htmlspecialchars($theloaisach->tentheloai) ?></a>
                    </li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </div>
    <?php endforeach ?>

</div>

<!-- <ul class="card nav nav-pills flex-column">
    <div class="card-header bg-success">
        <a href="#book" class="card-link" data-toggle="collapse"><i class="fa fa-book" style="color: white;">&nbsp;DANH MỤC SÁCH HỌC TẬP DANH MỤC SÁCH HỌC TẬP</i></a>
    </div>
    <div id="book" class="card-body collapse show" data-parent="#parent">
        <li class="nav-item">
            <a class="nav-link" href="#sachgiaokhoa">Sách Giáo Khoa</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#sachkhoahoc">Sách Khoa Học</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#sachgiaitri">Sách Giải Trí</a>
        </li>
    </div>
 -->
    <!-- menu BUT -->
    <!-- <div class="card-header bg-success">
        <a href="#but" class="card-link" data-toggle="collapse"><i class="fa fa-pencil" style=" color:white;">&nbsp; DANH MỤC BÚT VIẾT </i></a>
    </div>
    <div id="but" class="card-body collapse" data-parent="#parent">
        <li class="nav-item">
            <a class="nav-link" href="#butbi">Bút Bi</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#butchi">Bút Chì</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#butmay">Bút Máy</a>
        </li>
    </div> -->

    <!-- menu THUOC -->
    <!-- <div class="card-header bg-success">
        <a href="#thuoc" class="card-link" data-toggle="collapse"><i class="fa fa-sliders" style="color: white;">&nbsp;DANH MỤC THƯỚC KẺ</i></a>
    </div>
    <div id="thuoc" class="card-body collapse" data-parent="#parent">
        <li class="nav-item">
            <a class="nav-link" href="#thuocdochieudai">Thước Đo Chiều Dài</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#thuocdogoc">Thước Đo Góc</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#thuocvehinhhoc">Thước Vẽ Hình Học</a>
        </li>
    </div>

</ul>
 -->
<!-- tiếp menu -->
<hr class="d-sm-none">