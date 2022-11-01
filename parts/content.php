<?php

use CT275\Project\TheLoai;

?>
<div id="xuhuongmuasam" class="card" style="margin-top:20px;">
    <div class="card-header text-primary" style="background:#ffccff;">
        <h5 class="mr-auto">XU HƯỚNG MUA SẮM
            <a href="#" class="text-danger float-right" style="font-size:15px;text-decoration: none;" role="button">Xem tất cả &nbsp;<span class="fa fa-chevron-right" style="color:red"></span></a>
        </h5>
        <ul class="nav nav-pills ">
            <li class="nav-item">
                <a href="#" data-toggle="pill" class="nav-link active">Xu Hướng Theo Ngày</a>
            </li>
            <li class="nav-item">
                <a href="#" data-toggle="pill" class="nav-link">Sách Hot - Giảm Sốc</a>
            </li>
            <li class="nav-item">
                <a href="#" data-toggle="pill" class="nav-link">Truy Cập Gần Đây</a>
            </li>
            <li class="nav-item">
                <a href="#" data-toggle="pill" class="nav-link">Gợi Ý Cho Bạn</a>
            </li>
        </ul>
    </div>
    <div class="card-body bg-light">
        <!-- phan truy van -->
        <div class="card-columns">
            <?php
            if (!empty($lietKeDSSach)) for ($i = $starPage; $i < $endPage; $i++) :
                $giamGia = htmlspecialchars($lietKeDSSach[$i]->giamgia);
                $giaBan = htmlspecialchars($lietKeDSSach[$i]->giaban);
                if ($giamGia != 0) {
                    $giaMoi = $giaBan * (1 - (float)$giamGia / 100);
                    $giaBan = "<small><sup><u>đ</u></sup></small>".$giaBan ;
                } else {
                    $giaMoi = $giaBan;
                    $giaBan = "";
                }

                $maTheLoai = htmlspecialchars($lietKeDSSach[$i]->layMaTheLoai());
                $theLoai = TheLoai::findMaTheLoai($maTheLoai);
                $infBook = "- Thể loại: " . htmlspecialchars($theLoai->tentheloai) . "<br>- Tác giả: " . htmlspecialchars($lietKeDSSach[$i]->tacgia) . "<br>- Ngôn Ngữ: " . htmlspecialchars($lietKeDSSach[$i]->ngonngu) . "<br>- Số trang: " . htmlspecialchars($lietKeDSSach[$i]->sotrang);
            ?>
                <div class="card ">
                    <img class="card-img-top" src="<?= htmlspecialchars($lietKeDSSach[$i]->hinhanh) ?>" alt="Card image" height="300px">
                    <div class="card-img-overlay"><span class="badge badge-danger">Yêu Thích</span><span class="float-right rounded-circle cssGiamGia"><?= -$giamGia . "%" ?></span></div>
                    <div class="card-body">
                        <div class="card-text">
                            <a href="buyBook.php?id=<?= htmlspecialchars($lietKeDSSach[$i]->layMaSach()) ?>&sl=<?= $tangSPGioHang ?>" data-html="true" class="stretched-link  d-flex justify-content-center" data-toggle="tooltip" title="<?= $infBook ?>"></a>
                            <p class="limitText"><?= htmlspecialchars($lietKeDSSach[$i]->tensach) ?> </p>
                            <p>
                                <del><?= $giaBan ?> </del> &nbsp;&nbsp;
                                <span class="font-weight-bold text-danger"><small><sup><u>đ</u></sup></small><?= $giaMoi ?> </span>
                                <i class="fa fa-1x fa-truck text-primary float-right"></i>
                            </p>
                            <p class="text-secondary"><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>&nbsp;<span class="text-warning">(0)</span>&nbsp;Đã bán 1.7K</p>
                        </div>
                    </div>
                </div>
            <?php endfor;
            else echo "<h5>(0) Kết quả được tìm thấy</h5>"; ?>
        </div>

    </div>
    <div class="card-footer d-flex justify-content-center">
        <ul class="pagination justify-content-center" style="margin: 0">
            <?php
            if (isset($_REQUEST['tl'])) :
            ?>
                <li class="page-item"><a class="page-link" href="index.php?sl=<?= $tangSPGioHang ?>&pageOld=<?= $pageOld ?>&pageNew=-1&tl=<?= $_GET['tl'] ?>">Previous</a></li>
                <?php
                $sotrang = (int)($soLuongSach / 30) > 0 ? (int)($soLuongSach / 30) + 1 : 1;
                for ($i = 1; $i <= $sotrang; $i++) :
                ?>
                    <li class="New-item"><a class="page-link" href="index.php?sl=<?= $tangSPGioHang ?>&pageOld=<?= $pageOld ?>&pageNew=<?= $i ?>&tl=<?= $_GET['tl'] ?>"> <?= $i ?></a></li>
                <?php
                endfor;
                ?>
                <li class="page-item"><a class="page-link" href="index.php?sl=<?= $tangSPGioHang ?>&pageOld=<?= $pageOld ?>&pageNew=-2&tl=<?= $_GET['tl'] ?>">Next</a></li>
            <?php
            elseif (isset($_REQUEST['timkiem']) || isset($_GET['timkiem'])) :

            ?>
                <li class="page-item"><a class="page-link" href="index.php?sl=<?= $tangSPGioHang ?>&pageOld=<?= $pageOld ?>&pageNew=-1&timkiem=<?=$timKiem?>">Previous</a></li>
                <?php
                $sotrang = (int)($soLuongSach / 30) > 0 ? (int)($soLuongSach / 30) + 1 : 1;
                for ($i = 1; $i <= $sotrang; $i++) :
                ?>
                    <li class="New-item"><a class="page-link" href="index.php?sl=<?= $tangSPGioHang ?>&pageOld=<?= $pageOld ?>&pageNew=<?= $i ?>&timkiem=<?=$timKiem?>"><?= $i ?></a></li>
                <?php
                endfor;
                ?>
                <li class="page-item"><a class="page-link" href="index.php?sl=<?= $tangSPGioHang ?>&pageOld=<?= $pageOld ?>&pageNew=-2&timkiem=<?=$timKiem?>">Next</a></li>
            <?php
            else :

            ?>
                <li class="page-item"><a class="page-link" href="index.php?sl=<?= $tangSPGioHang ?>&pageOld=<?= $pageOld ?>&pageNew=-1">Previous</a></li>
                <?php
                $sotrang = (int)($soLuongSach / 30) > 0 ? (int)($soLuongSach / 30) + 1 : 1;
                for ($i = 1; $i <= $sotrang; $i++) :
                ?>
                    <li class="New-item"><a class="page-link" href="index.php?sl=<?= $tangSPGioHang ?>&pageOld=<?= $pageOld ?>&pageNew=<?= $i ?>"><?= $i ?></a></li>
                <?php
                endfor;
                ?>
                <li class="page-item"><a class="page-link" href="index.php?sl=<?= $tangSPGioHang ?>&pageOld=<?= $pageOld ?>&pageNew=-2">Next</a></li>
            <?php
            endif;

            ?>
        </ul>
    </div>
</div><br>


<!-- <?php #foreach ($dsLoaiSach as $loaisach) : 
        ?>
    <div id="<?= htmlspecialchars($loaisach->layMaLoai()) ?>" class="card" style="margin-top:20px;">
        <div class="card-header text-primary" style="background:#ffccff;">
            <h5 class="mr-auto"><?= htmlspecialchars($loaisach->tenloai) ?>
                <a href="#" class="text-danger float-right" style="font-size:15px;text-decoration: none;" role="button">Xem tất cả &nbsp;<span class="fa fa-chevron-right" style="color:red"></span></a>
            </h5>
            <ul class="nav nav-pills">
                <?php
                #$maloai = htmlspecialchars($loaisach->layMaLoai());
                #$dsTheLoaiSach = TheLoai::findMaLoai($maloai);
                #if (!empty($dsTheLoaiSach)) foreach ($dsTheLoaiSach as $theloaisach) : 
                ?>
                    <li class="nav-item">
                        <a href="#" data-toggle="pill" class="nav-link"><?= htmlspecialchars($theloaisach->tentheloai) ?></a>
                    </li>
                <?php #endforeach 
                ?>
            </ul>
        </div>

        <?php #$maloaisach = 'LS1TL1'; 
        ?>
        <div class="card-body bg-light">
            <div id="<?= $maloaisach ?>" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    
                    <?php
                    #$dsSach = Sach::findMaTheLoai($maloaisach);
                    #$soDong = count($dsSach) / 4 - 1;
                    #$k = 0;
                    #for ($i = 0; $i < $soDong; $i++) : 
                    ?>
                        <div class="carousel-item active">
                            
                            <div class="card-deck">

                                <?php #for ($j = $k; $j < $k + 4; $j++) : 
                                ?>
                                    <div class="card">
                                        <img class="card-img-top" src="<?= htmlspecialchars($dsSach[$j]->hinhanh) ?>" alt="Card image">
                                        <div class="card-body">
                                            <h4 class="card-title"><?= htmlspecialchars($dsSach[$j]->tensach) ?></h4>
                                            <p class="card-text"><?= htmlspecialchars($dsSach[$j]->giaban) ?></p>
                                            <a href="#" class="stretched-link"></a>
                                        </div>
                                    </div>
                                <?php #endfor 
                                ?>

                            </div>
                        </div>
                    <?php #$k += 4;
                    #endfor 
                    ?>
                </div>
                <a href="#<?= $maloaisach ?>" class="carousel-control-prev" data-slide="prev"><span class="carousel-control-prev-icon"></span></a>
                <a href="#<?= $maloaisach ?>" class="carousel-control-next" data-slide="next"><span class="carousel-control-next-icon"></span></a>
            </div>
        </div>
    </div><br>
<?php #endforeach 
?> -->