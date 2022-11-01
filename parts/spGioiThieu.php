<?php

use CT275\Project\TheLoai;

?>
<div class="card mt-3">
    <div class="card-body">
        <h4 class="card-title">SHOPLITE GIỚI THIỆU</h4>
        <div class="card-text">

            <div id="<?= $spGioiThieu ?>" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    $soDong = count($dsGioiThieu) / 4;
                    $k = 1;
                    for ($j = 1; $j <= $soDong; $j++) :
                        $carouselItemGioiThieu = "carouselItemGioiThieu" . $j;
                    ?>
                        <div id="<?= $carouselItemGioiThieu ?>" class="carousel-item">
                            <div class="card-deck">
                                <?php
                                if (!empty($dsGioiThieu)) for ($i = $k; $i <= count($dsGioiThieu); $i++) :
                                    if (($k - 1) == $j * 4) break;
                                    else $k = $k + 1;
                                    $giamGia = htmlspecialchars($dsGioiThieu[$i - 1]->giamgia);
                                    $giaBan = htmlspecialchars($dsGioiThieu[$i - 1]->giaban);
                                    if ($giamGia != 0) {
                                        $giaMoi = $giaBan * (1 - (float)$giamGia / 100);
                                        $giaBan = $giaBan . " đ";
                                    } else {
                                        $giaMoi = $giaBan;
                                        $giaBan = "";
                                    }

                                    $maTheLoai = htmlspecialchars($dsGioiThieu[$i - 1]->layMaTheLoai());
                                    $theLoai = TheLoai::findMaTheLoai($maTheLoai);
                                    $infBook = "- Thể loại: " . htmlspecialchars($theLoai->tentheloai) . "<br>- Tác giả: " . htmlspecialchars($dsGioiThieu[$i - 1]->tacgia) . "<br>- Ngôn Ngữ: " . htmlspecialchars($dsGioiThieu[$i - 1]->ngonngu) . "<br>- Số trang: " . htmlspecialchars($dsGioiThieu[$i - 1]->sotrang);
                                ?>
                                    <div class="card ">
                                        <img class="card-img-top" src="<?= htmlspecialchars($dsGioiThieu[$i - 1]->hinhanh) ?>" alt="Card image" height="300px">
                                        <div class="card-img-overlay"><span class="badge badge-danger">Yêu Thích</span><span class="float-right rounded-circle cssGiamGia"><?= -$giamGia . "%" ?></span></div>
                                        <div class="card-body">
                                            <div class="card-text">
                                                <a href="buyBook.php?id=<?=htmlspecialchars($dsGioiThieu[$i - 1]->layMaSach()) ?>&sl=<?=$tangSPGioHang ?>" data-html="true" class="stretched-link  d-flex justify-content-center" data-toggle="tooltip" title="<?= $infBook ?>"></a>
                                                <p class="limitText"><?= htmlspecialchars($dsGioiThieu[$i - 1]->tensach) ?> </p>
                                                <p>
                                                    <del><?= $giaBan ?> </del> &nbsp;&nbsp;
                                                    <span class="font-weight-bold text-danger"><?= $giaMoi ?> đ</span>
                                                    <span class="badge badge-secondary">Tập <?= $i ?></span>
                                                    <i class="fa fa-1x fa-truck text-primary float-right"></i>
                                                </p>
                                                <p class="text-secondary"><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>&nbsp;<span class="text-warning">(0)</span>&nbsp;Đã bán 1.7K</p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div> <!-- mỗi carousel-item  -->
                    <?php endfor; ?>
                </div>
                <a href="#<?= $spGioiThieu ?>" class="carousel-control-prev" data-slide="prev"><span class="carousel-control-prev-icon"></span></a>
                <a href="#<?= $spGioiThieu ?>" class="carousel-control-next" data-slide="next"><span class="carousel-control-next-icon"></span></a>
            </div> <!-- carousel sach lien quan -->

        </div>
    </div>
    <div class="card-footer d-flex justify-content-center">
        <button class="xemThemSP btn btn-outline-danger" type="button"><span class="xemThemRutGon">Xem Thêm&nbsp;<i class="fa fa-chevron-down"></i></span> </button>
    </div>
</div> <!-- card thong tin san pham duoc gioi thieu -->