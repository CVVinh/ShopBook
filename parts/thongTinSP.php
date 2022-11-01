<div class="card mt-3">
    <div class="card-body">
        <h4 class="card-title">Thông tin sản phẩm</h4>
        <div class="card-text">
            <table class="table table-borderless">
                <tbody>
                    <tr>
                        <td>Mã Hàng</td>
                        <td><?= htmlspecialchars($dsSach->layMaSach()) ?></td>
                    </tr>
                    <tr>
                        <td>Tên Nhà Cung Cấp</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Tác Giả</td>
                        <td><?= htmlspecialchars($dsSach->tacgia) ?></td>
                    </tr>
                    <tr>
                        <td>Tên Nhà Xuất Bản</td>
                        <td><?= htmlspecialchars($dsSach->nxb) ?></td>
                    </tr>
                    <tr>
                        <td>Năm Xuất Bản</td>
                        <td><?= htmlspecialchars($dsSach->namxb) ?></td>
                    </tr>
                    <tr>
                        <td>Ngôn Ngữ</td>
                        <td><?= htmlspecialchars($dsSach->ngonngu) ?></td>
                    </tr>
                    <tr>
                        <td>Trọng lượng</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Kích Thước Bao Bì</td>
                        <td><?= htmlspecialchars($dsSach->kichthuoc) ?></td>
                    </tr>
                    <tr>
                        <td>Số Trang</td>
                        <td><?= htmlspecialchars($dsSach->sotrang) ?></td>
                    </tr>
                    <tr>
                        <td>Biên Tập</td>
                        <td><?= htmlspecialchars($dsSach->bientap) ?></td>
                    </tr>
                    <tr>
                        <td>Hình Thức</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Sản Phẩm Hiển Thị Trong</td>
                        <td><?= htmlspecialchars($dsTheLoai->tentheloai) ?></td>
                    </tr>
                    <tr>
                        <td>Sản phẩm bán chạy nhất</td>
                        <td>Top những quyển sách được nhiều lượt mua</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer d-flex justify-content-center">
        <button class="xemThemSP btn btn-outline-danger" type="button"><span class="xemThemRutGon">Xem Thêm&nbsp;<i class="fa fa-chevron-down"></i></span> </button>
    </div>
</div> <!-- card thong tin chi tiet san pham can mua -->