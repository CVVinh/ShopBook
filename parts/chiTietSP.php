<div class="card">
    <div class="card-body">
        <div class="row">

            <div class="col-3">
                <div class="card">
                    <img class="card-img-top" src="<?= htmlspecialchars($dsSach->hinhanh) ?>" alt="Card image">
                </div>
            </div> <!-- cot anh -->

            <div class="col-8 offset-1">
                <h3 class="card-title"><span class="badge badge-danger align-middle" style="font-size:15px;">Yêu Thích</span>&nbsp;<?= htmlspecialchars($dsSach->tensach) ?></h3>
                <div class="row">
                    <div class="col-8">
                        <p>Nhà cung cấp:</p>
                        <p>Nhà xuất bản: <?= htmlspecialchars($dsSach->nxb) ?></p>
                        <p class="text-secondary"><i class="fa fa-star-o"></i>&nbsp;<i class="fa fa-star-o"></i>&nbsp;<i class="fa fa-star-o"></i>&nbsp;<i class="fa fa-star-o"></i>&nbsp;<i class="fa fa-star-o"></i>&nbsp;<span class="text-warning">(0 đánh giá)</span>&nbsp;|&nbsp;<span class="fa fa-thumbs-up text-primary fa-1x">&nbsp;(0 lượt bình chọn)</span></p>
                        <div class="align-middle alert alert-secondary">
                            <span class="font-weight-bold text-danger" style="font-size: 40px;"><?= $giaMoi ?> đ</span> &nbsp;&nbsp;
                            <del><?= $giaBan ?> </del>&nbsp; <span class="badge badge-danger "><?= -$giamGia . "%" ?>&nbsp;Giảm</span>
                            <br><span><i class="fa fa-check" style="color:blue;"></i>&nbsp;Giá tốt nhất cho các sản phẩm cùng loại</span>
                        </div>
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>Deal Sốc</td>
                                    <td><span class="badge badge-danger">Mua Kèm Deal Sốc</span></td>
                                </tr>
                                <tr>
                                    <td>Vận chuyển:</td>
                                    <td><span class="fa fa-bus">&nbsp;Miễn phí vận chuyển</span>
                                        <br><span class="text-secondary">Miễn phí vận chuyển cho đơn hàng trên 50đ</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-3">
                                <p>Số lượng:</p>
                            </div>
                            <div class="col-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button id="btnGiamSL" class="btn btn-light" type="button"><b>-</b></button>
                                    </div>
                                    <input id="txtSLMua" class="form-control" type="text" name="txtSoLuong" value="1" disabled>
                                    <div class="input-group-append">
                                        <button id="btnTangSL" class="btn btn-light" type="button"><b>+</b></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-5">
                                <p><?= htmlspecialchars($dsSach->soluong) ?> sản phẩm có sẵn</p>
                            </div>
                        </div>

                    </div> <!-- cot chi tiet ben trai-->

                    <div class="col-4">
                        <p>Tác giả: <?= htmlspecialchars($dsSach->tacgia) ?> </p>
                        <p>Hình thức bìa: </p>
                        <p>Thể loại: <?= htmlspecialchars($dsTheLoai->tentheloai) ?></p><br><br><br>
                        <h5>
                            <a href="#" class="badge badge-pill badge-light shadow fa fa-thumbs-o-up text-primary fa-1x">&nbsp;Bình Chọn</a>
                            <a href="#" class="badge badge-pill badge-light shadow fa fa-heart-o text-primary fa-1x">&nbsp;</a>
                        </h5>
                    </div> <!-- cot chi tiet ben phai -->
                </div>
                <hr>
            </div> <!-- cot thong tin sach -->
        </div> <!-- dong thong tin anh -->

        <div class="row">
            <!-- nut them san pham vao gio hang -->
            <div class="col-3">
                <?php
                if (!isset($_SESSION['tenDangNhap'])) :
                ?>
                    <a href="#" type="button" name="btnThemSPGioHang" id="btnThemSPGioHang" class="btn btn-outline-danger btn-block" data-toggle="modal" data-target="#dangnhap"><i class="fa fa-1x fa-cart-plus"></i>&nbsp;Thêm Vào Giỏ Hàng</a>
                <?php
                else :
                ?>
                    <form method="post" action="buyBook.php?id=<?= htmlspecialchars($dsSach->layMaSach()) ?>&sl=<?= $tangSPGioHang ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <button type="submit" name="btnThemSPGioHang" id="btnThemSPGioHang" class="btn btn-outline-danger btn-block"><i class="fa fa-1x fa-cart-plus"></i>&nbsp;Thêm Vào Giỏ Hàng</button>
                            <input id="txtThemSPGioHang" class="form-control" type="hidden" name="txtThemSPGioHang" value="<?= htmlspecialchars($dsSach->layMaSach()) ?>">
                        </div>
                    </form>
                <?php
                endif;
                ?>
            </div>
            <!-- nut mua ngay -->
            <div class="col-3">

                <?php
                if (isset($_SESSION['tenDangNhap'])) :
                ?>
                    <!-- <a href="gioHang.php?id=<?= $id ?>&sl=<?= $tangSPGioHang ?>" type="button" name="btnMuaNgay" id="btnMuaNgay" class="btn btn-danger btn-block">&nbsp;Mua Ngay</a> -->

                    <form method="post" action="buyBook.php?id=<?= htmlspecialchars($dsSach->layMaSach()) ?>&sl=<?= $tangSPGioHang ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <button type="submit" name="btnMuaNgay" id="btnMuaNgay" class="btn btn-danger btn-block">&nbsp;Mua Ngay</button>
                            <input id="txtMuaNgay" class="form-control" type="hidden" name="txtMuaNgay" value="<?= htmlspecialchars($dsSach->layMaSach()) ?>">
                        </div>
                    </form>
                <?php
                else :
                ?>
                    <a href="#" type="button" name="btnMuaNgay" id="btnMuaNgay" class="btn btn-danger btn-block" data-toggle="modal" data-target="#dangnhap">&nbsp;Mua Ngay</a>
                <?php
                endif;
                ?>
            </div>
            <div class="col-2">
                <span class="fa-stack text-danger"><i class="fa fa-circle fa-stack-2x"></i><i class="fa  fa-arrows-h fa-stack-1x fa-inverse"></i></span>
                <span data-toggle="tooltip" title="Hoàn toàn yên tâm khi mua hàng ở ShopLite với ưu đãi miễn phí trả hàng lên đến 7 ngày.">7 ngày miễn phí trả hàng</span>
            </div>
            <div class="col-2">
                <span data-toggle="tooltip" title="Nhận lại gấp đôi số tiền mà bạn đã thanh toán cho sản phẩm không chính hãng từ ShopLite"><i class="fa fa-car text-danger"></i>&nbsp;Hàng chính hãng 100%</span>
            </div>
            <div class="col-2">
                <span data-toggle="tooltip" title="Ưu đãi miễn phí vận chuyển lên tới 40,000 VNĐ cho đơn hàng của ShopLite từ 150,000 VNĐ"><i class="fa fa-check-square-o text-danger"></i>&nbsp;Miễn phí vận chuyển</span>
            </div>
        </div> <!-- dong nut mua sach -->

    </div>
</div> <!-- card thong tin san pham mua -->