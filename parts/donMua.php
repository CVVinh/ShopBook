<!-- Nav tabs -->
<ul class="nav nav-tabs nav-justified" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#tatCa">Tất Cả</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#choXacNhan">Chờ Xác Nhận</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#choLayHang">Chờ Lấy Hàng</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#dangGiao">Đang Giao</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#daGiao">Đã Giao</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#daHuy">Đã Hủy</a>
    </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div id="tatCa" class="container tab-pane active"><br>
        <?php
        include("../parts/tatCaSP.php");
        ?>
    </div>
    <div id="choXacNhan" class="container tab-pane fade"><br>
        <?php
        include("../parts/choXacNhan.php");
        ?>
    </div>
    <div id="choLayHang" class="container tab-pane fade"><br>
        <h3>Chờ Lấy Hàng</h3>
        <p>Chưa có đơn hàng</p>
    </div>
    <div id="dangGiao" class="container tab-pane fade"><br>
        <h3>Đang Giao</h3>
        <p>Chưa có đơn hàng</p>
    </div>
    <div id="daGiao" class="container tab-pane fade"><br>
        <h3>Đã Giao</h3>
        <p>Chưa có đơn hàng</p>
    </div>
    <div id="daHuy" class="container tab-pane fade"><br>
        <h3>Đã Hủy</h3>
        <p>Chưa có đơn hàng</p>
    </div>
</div>