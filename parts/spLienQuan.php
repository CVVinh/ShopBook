<?php

use CT275\Project\TheLoai;

?>
<div class="card mt-3">
    <div class="card-body">
        <h4 class="card-title">SẢN PHẨM LIÊN QUAN</h4>
        <div class="card-text">

            <div id="<?= $dsSach->layMaTheLoai() ?>" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    $soDong = count($dsLienQuan) / 4;
                    $k = 1;
                    for ($j = 1; $j <= $soDong; $j++) :
                        $carouselItemLienQuan = "carouselItemLienQuan" . $j;
                    ?>
                        <div id="<?= $carouselItemLienQuan ?>" class="carousel-item">
                            <div class="card-deck">
                                <?php
                                if (!empty($dsLienQuan)) for ($i = $k; $i <= count($dsLienQuan); $i++) :
                                    if (($k - 1) == $j * 4) break;
                                    else $k = $k + 1;
                                    $giamGia = htmlspecialchars($dsLienQuan[$i - 1]->giamgia);
                                    $giaBan = htmlspecialchars($dsLienQuan[$i - 1]->giaban);
                                    if ($giamGia != 0) {
                                        $giaMoi = $giaBan * (1 - (float)$giamGia / 100);
                                        $giaBan = $giaBan . " đ";
                                    } else {
                                        $giaMoi = $giaBan;
                                        $giaBan = "";
                                    }
                                    $maTheLoai = htmlspecialchars($dsLienQuan[$i - 1]->layMaTheLoai());
                                    $theLoai = TheLoai::findMaTheLoai($maTheLoai);
                                    $infBook = "- Thể loại: " . htmlspecialchars($theLoai->tentheloai) . "<br>- Tác giả: " . htmlspecialchars($dsLienQuan[$i - 1]->tacgia) . "<br>- Ngôn Ngữ: " . htmlspecialchars($dsLienQuan[$i - 1]->ngonngu) . "<br>- Số trang: " . htmlspecialchars($dsLienQuan[$i - 1]->sotrang);
                                ?>
                                    <div class="card ">
                                        <img class="card-img-top" src="<?= htmlspecialchars($dsLienQuan[$i - 1]->hinhanh) ?>" alt="Card image" height="300px">
                                        <div class="card-img-overlay"><span class="badge badge-danger">Yêu Thích</span><span class="float-right rounded-circle cssGiamGia"><?= -$giamGia . "%" ?></span></div>
                                        <div class="card-body">
                                            <div class="card-text">
                                                <a href="buyBook.php?id=<?=htmlspecialchars($dsLienQuan[$i - 1]->layMaSach()) ?>&sl=<?=$tangSPGioHang ?>" data-html="true" class="stretched-link ficon-help-icon d-flex justify-content-center" twipsy-content-set="true" data-toggle="tooltip" title="<?= $infBook ?>"></a>
                                                <p class="limitText"><?= htmlspecialchars($dsLienQuan[$i - 1]->tensach) ?> </p>
                                                <p>
                                                    <del><?= $giaBan ?> </del> &nbsp;&nbsp;
                                                    <span class="font-weight-bold text-danger"><?= $giaMoi ?> đ</span>
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
                <a href="#<?= $dsSach->layMaTheLoai() ?>" class="carousel-control-prev" data-slide="prev"><span class="carousel-control-prev-icon"></span></a>
                <a href="#<?= $dsSach->layMaTheLoai() ?>" class="carousel-control-next" data-slide="next"><span class="carousel-control-next-icon"></span></a>
            </div> <!-- carousel sach lien quan -->

        </div>
    </div>
    <div class="card-footer d-flex justify-content-center">
        <button class="xemThemSP btn btn-outline-danger" type="button"><span class="xemThemRutGon">Xem Thêm&nbsp;<i class="fa fa-chevron-down"></i></span> </button>
    </div>
</div> <!-- card thong tin san pham can lien quan -->