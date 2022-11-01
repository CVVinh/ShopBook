var soLuongMua = 1;
var rutGonXemThem = true;
$(document).ready(function() {
    new WOW().init();

    /* mở Drop-Menu about trên thanh Narbar */
    $('#navAbout').hover(function() {
        $('#navLinkAbout').trigger('click');
    });
    /* đóng Drop-Menu about trên thanh Narbar */
    $('#navDropMenuAbout').on({
        mouseleave: function() {
            $('#navLinkAbout').trigger('click');
        }
    });
    /* mở Drop-Menu help trên thanh Narbar */
    $('#navHelp').hover(function() {
        $('#navLinkHelp').trigger('click');
    });
    /* đóng Drop-Menu help trên thanh Narbar */
    $('#navDropMenuHelp').on({
        mouseleave: function() {
            $('#navLinkHelp').trigger('click');
        }
    });
    /* mở Drop-Menu login/logout */
    $('#navLogInOut').hover(function() {
        $('#iGLogInOut').trigger('click');
    });
    /* đóng Drop-Menu login/logout */
    $('#dMLogInOut').mouseleave(function() {
        $('#iGLogInOut').trigger('click');
    });
    /* tô màu cho phần tử menu được kích hoạt */
    $('#menuHoSo li a:first-child').click(function() {
        $('a').removeClass('active');
        $(this).addClass('active');
    });

    /* đóng modal đăng ký nếu madal đăng ký đang mở, để mở madal đăng nhập */
    $('#btnCloseModalDK').click(function() {
        $('#btnCloseDangKy').trigger('click');
    });

    /* đóng modal đăng nhập nếu madal đăng nhập đang mở, để mở madal đăng ký */
    $('#btnCloseModalDN').click(function() {
        $('#btnCloseDangNhap').trigger('click');
    });

    /* bật thông báo nhận được từ shop*/
    $("#thongBao").hover(function() {
        $('#toastThongBao').toast('show');
    });

    /* tắt thông báo nhận từ shop*/
    $('#toastThongBao').mouseleave(function() {
        $('#btnCloseThongBao').trigger('click');
    });

    /* xem hàng trong giỏ (xem những sp trong giỏ hàng) */
    $("#gioHang").hover(function() {
        $('#toastGioHang').toast('show');
    });

    /* tắt xem giỏ hàng */
    $('#toastGioHang').mouseleave(function() {
        $('#btnCloseGioHang').trigger('click');
    });

    /* bật tin nhắn */
    $("#clickToast1").click(function() {
        $('#toastMessage').toast('show');
    });

    /* tooltip thông tin thêm cho sản phẩm */
    $('[data-toggle="tooltip"]').tooltip();


    $('.xemThemSP').click(function() {
        if (rutGonXemThem) {
            $('.xemThemRutGon').html('<span>Rút Gọn</span>&nbsp;<span id=" hinhXemThem" class="fa fa-chevron-up"></span>');
            rutGonXemThem = false;
        } else {
            $('.xemThemRutGon').html('<span>Xem Thêm</span>&nbsp;<span id="hinhXemThem" class="fa fa-chevron-down"></span>');
            rutGonXemThem = true;
        }
    });

    /* carousel các mục sản phẩm */
    $('#carouselItemLienQuan1').addClass('active');
    $('#carouselItemCungMua1').addClass('active');
    $('#carouselItemGioiThieu1').addClass('active');

    /* giảm số lượng sản phẩm mua */
    $('#btnGiamSL').click(function() {
        if (soLuongMua > 1) {
            soLuongMua = soLuongMua - 1;
            $('#txtSLMua').val(soLuongMua);
        }
    });

    /* tăng số lượng sản phẩm mua */
    $('#btnTangSL').click(function() {
        soLuongMua = soLuongMua + 1;
        $('#txtSLMua').val(soLuongMua);
    });


});

(function() {
    'use strict';
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() == false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

/* $.validator.setDefaults({
    submitHandler: function() {
        alert("Đăng Ký Thành Công!");
    }
}); */
$(document).ready(function() {
    $("#signupForm").validate({
        rules: {
            ho: "required",
            ten: {
                required: true,
                minlength: 2
            },
            email: {
                required: true,
                email: true
            },
            sdt: "required",
            dchi: "required",
            agree: "required",
            matkhau: {
                required: true,
                minlength: 5
            },
            xacNhanMK: {
                required: true,
                minlength: 5,
                equalTo: "#matkhau"
            },
        },
        messages: {
            ho: "Bạn chưa nhập vào họ tên của bạn",
            ten: {
                required: "Bạn chưa nhập vào tên đăng nhập",
                minlength: "Tên đăng nhập phải có ít nhất 2 ký tự"
            },
            matkhau: {
                required: "Bạn chưa nhập vào mật khẩu",
                minlength: "Mật khẩu phải có ít nhất 5 ký tự"
            },
            xacNhanMK: {
                required: "Bạn chưa nhập vào mật khẩu",
                minlength: "Mật khẩu phải có ít nhất 5 ký tự",
                equalTo: "Mật khẩu không trùng khớp với mật khẩu đã nhập"
            },
            email: {
                required: "Bạn chưa nhập Email",
                email: "Hộp thư điện tử không hợp lệ"
            },
            dchi: "Bạn chưa nhập vào địa chỉ",
            sdt: "Bạn chưa nhập vào số điện thoại",
            agree: "Bạn phải đồng ý với các quy định của chúng tôi"
        },
        errorElement: "div",
        errorPlacement: function(error, element) {
            error.addClass("invalid-feedback");
            if (element.prop("type") === "checkbox") {
                error.insertAfter(element.siblings("label"));
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).addClass("is-valid").removeClass("is-invalid");
        }
    });
});

/* kiểm tra đăng nhập hồ sơ */
$(document).ready(function() {
    $("#capNhatHoSo").validate({
        rules: {
            tenNguoiDung: "required",
            tenDangNhapUser: {
                required: true,
                minlength: 2
            },
            emailNguoiDung: {
                required: true,
                email: true
            },
            soDienThoai: "required",
            diaChiUser: "required",
        },
        messages: {
            tenNguoiDung: "Bạn chưa nhập vào họ tên của bạn",
            tenDangNhapUser: {
                required: "Bạn chưa nhập vào tên đăng nhập",
                minlength: "Tên đăng nhập phải có ít nhất 2 ký tự"
            },
            emailNguoiDung: {
                required: "Bạn chưa nhập Email",
                email: "Hộp thư điện tử không hợp lệ"
            },
            diaChiUser: "Bạn chưa nhập vào địa chỉ",
            soDienThoai: "Bạn chưa nhập vào số điện thoại",
        },
        errorElement: "div",
        errorPlacement: function(error, element) {
            error.addClass("invalid-feedback");
            if (element.prop("type") === "checkbox") {
                error.insertAfter(element.siblings("label"));
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).addClass("is-valid").removeClass("is-invalid");
        }
    });
});

/* kiểm tra đăng nhập thay đổi mật khẩu */
$(document).ready(function() {
    $("#thayDoiMatKhau").validate({
        rules: {
            matKhauCu: "required",
            matKhauMoi: {
                required: true,
                minlength: 5
            },
            nhapLaiMK: {
                required: true,
                minlength: 5,
                equalTo: "#matKhauMoi"
            },
        },
        messages: {
            matKhauCu: "Bạn chưa nhập vào mật khẩu cũ",
            matKhauMoi: {
                required: "Bạn chưa nhập vào mật khẩu mới",
                minlength: "Mật khẩu phải có ít nhất 5 ký tự"
            },
            nhapLaiMK: {
                required: "Bạn chưa nhập vào mật khẩu để xác nhận",
                minlength: "Mật khẩu phải có ít nhất 5 ký tự",
                equalTo: "Mật khẩu không trùng khớp với mật khẩu đã nhập"
            },
        },
        errorElement: "div",
        errorPlacement: function(error, element) {
            error.addClass("invalid-feedback");
            if (element.prop("type") === "checkbox") {
                error.insertAfter(element.siblings("label"));
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).addClass("is-valid").removeClass("is-invalid");
        }
    });
});