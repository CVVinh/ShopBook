<?php
    use CT275\Project\KhachHang;
    $capNhatKH = KhachHang::findByMaKH($_SESSION['tenDangNhap']);

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_REQUEST['btnCapNhatThongTin'])){
        $data = [
            'makh' => $_SESSION['tenDangNhap'],
            'ho' => $_POST['tenNguoiDung'],
            'ten' => $_POST['tenDangNhapUser'],
            'gioitinh' => $_POST['gioitinh'],
            'email' => $_POST['emailNguoiDung'],
            'sdt' => $_POST['soDienThoai'],
            'dchi' => $_POST['diaChiUser'],
            'congviec' => $_POST['ngheNghiep'],
        ];
        if ($capNhatKH->fill($data)->saveUpdate()){
            echo "<script> alert('Cập Nhật Thành Công !!!'); </script>";
        } 
    }

    if (isset($_GET['id'])) $path = $_SERVER['PHP_SELF'] . "?id=" . $_GET['id'] . "&sl=" . $tangSPGioHang . "&type=hoso";
    else $path = $_SERVER['PHP_SELF'] . "?sl=" . $tangSPGioHang . "&type=hoso";
?>
<div class="card">
    <div class="card-header fa fa-user" style="background:#ffccff;">&nbsp;Hồ Sơ Của Tôi</div>
    <div class="card-body">
        <form id="capNhatHoSo" name="capNhatHoSo" enctype="multipart/form-data" method="post" action="#">
            <div class="row">
                <!-- tên người dùng -->
                <div class="col-3 form-group">
                    <label for="tenNguoiDung">Tên Người Dùng:</label>
                </div>
                <div class="col-8 form-group input-group">
                    <div class="input-group-prepend">
                        <label for="tenNguoiDung" class="input-group-text"><i class="fa fa-fw fa-user"
                                style="color: red;"></i></label>
                    </div>
                    <input id="tenNguoiDung" name="tenNguoiDung" type="text" class="form-control" placeholder="Name"
                        value="<?=$capNhatKH->ho?>">
                </div>
            </div>
            <!-- tên đăng nhập -->
            <div class="row">
                <div class="col-3 form-group">
                    <label for="tenDangNhapUser">Tên Đăng Nhập:</label>
                </div>
                <div class="col-8 form-group input-group">
                    <div class="input-group-prepend">
                        <label for="tenDangNhapUser" class="input-group-text"><i class="fa fa-fw fa-user"
                                style="color: red;"></i></label>
                    </div>
                    <input id="tenDangNhapUser" name="tenDangNhapUser" type="text" class="form-control"
                        placeholder="Tên Đăng Nhập" value="<?=$capNhatKH->ten?>">
                </div>
            </div>
            <div class="row">
                <!-- giới tính -->
                <div class="col-3 form-group">
                    <label>Giới Tính:</label>
                </div>
                <div class="col-8">
                    <?php
                        if($capNhatKH->gioitinh=="Nam"):
                    ?>
                    <div class="custom-radio custom-control custom-control-inline">
                        <input id="gioiNam" name="gioitinh" type="radio" class="custom-control-input" value="Nam"
                            checked>
                        <label class="custom-control-label" for="gioiNam">Nam</label>
                    </div>
                    <div class="custom-radio custom-control custom-control-inline">
                        <input id="gioiNu" name="gioitinh" type="radio" class="custom-control-input" value="Nữ">
                        <label class="custom-control-label" for="gioiNu">Nữ</label>
                    </div>
                    <?php
                        else:
                    ?>
                    <div class="custom-radio custom-control custom-control-inline">
                        <input id="gioiNam" name="gioitinh" type="radio" class="custom-control-input" value="Nam">
                        <label class="custom-control-label" for="gioiNam">Nam</label>
                    </div>
                    <div class="custom-radio custom-control custom-control-inline">
                        <input id="gioiNu" name="gioitinh" type="radio" class="custom-control-input" value="Nữ" checked>
                        <label class="custom-control-label" for="gioiNu">Nữ</label>
                    </div>
                    <?php
                        endif;
                    ?>
                </div>
            </div>
            <div class="row">
                <!-- email -->
                <div class="col-3 form-group">
                    <label for="emailNguoiDung">Email:</label>
                </div>
                <div class="col-8 form-group input-group">
                    <div class="input-group-prepend">
                        <label for="emailNguoiDung" class="input-group-text"><i class="fa fa-fw fa-envelope-o"
                                style="color: red;"></i></label>
                    </div>
                    <input id="emailNguoiDung" name="emailNguoiDung" type="text" class="form-control"
                        placeholder="Enter Email" value="<?=$capNhatKH->email?>">
                </div>
            </div>
            <div class="row">
                <!-- điện thoại -->
                <div class="col-3 form-group">
                    <label for="soDienThoai">Số Điện Thoại:</label>
                </div>
                <div class="col-8 form-group input-group">
                    <div class="input-group-prepend">
                        <label for="soDienThoai" class="input-group-text"><i class="fa fa-fw fa-phone"
                                style="color: red;"></i></label>
                        <select class="custom-select" id="maVung1">
                            <option value="1" selected>+84</option>
                            <option value="2">+82</option>
                            <option value="3">+86</option>
                            <option value="4">+81</option>
                        </select>
                    </div>
                    <input id="soDienThoai" name="soDienThoai" type="text" class="form-control"
                        placeholder="Phone Number" value="<?=$capNhatKH->sdt?>">
                </div>
            </div>
            <div class="row">
                <!-- nghề nghiệp -->
                <div class="col-3 form-group">
                    <label for="ngheNghiep">Nghề Nghiệp:</label>
                </div>
                <div class="col-8 form-group input-group">
                    <div class="input-group-prepend">
                        <label for="ngheNghiep" class="input-group-text"><i class="fa fa-fw fa-graduation-cap"
                                style="color: red;"></i></label>
                    </div>
                    <select class="custom-select" name="ngheNghiep" id="ngheNghiep">
                        <option value="Kỹ Sư" selected>Kỹ Sư</optionva>
                        <option value="Bác Sĩ">Bác Sĩ</optionva>
                        <option value="Giáo Viên">Giáo Viên</optionva>
                        <option value="Học Sinh">Học Sinh</optionva>
                    </select>
                </div>
            </div>
            <div class="row">
                <!-- Địa chỉ -->
                <div class="col-3 form-group">
                    <label for="diaChiUser">Địa Chỉ:</label>
                </div>
                <div class="col-8 form-group input-group">
                    <div class="input-group-prepend">
                        <label for="diaChiUser" class="input-group-text"><i class="fa fa-fw fa-map-marker"
                                style="color: red;"></i></label>
                    </div>
                    <input id="diaChiUser" name="diaChiUser" type="text" class="form-control"
                        placeholder="Enter Address" value="<?=$capNhatKH->dchi?>">
                </div>
            </div>
            <div class="row">
                <div class="col-8 offset-3 form-group">
                    <button id="btnCapNhatThongTin" name="btnCapNhatThongTin" type="submit" class="btn btn-danger "><i
                            class="fa fa-pencil"></i> &nbsp;Lưu</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
$(document).ready(function() {

});
</script>