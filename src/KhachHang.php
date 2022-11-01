<?php

namespace CT275\Project;

class KhachHang
{
    protected $makh;
    public $ho;
    public $ten;
    public $gioitinh;
    public $sdt;
    public $dchi;
    public $email;
    public $congviec;
    public $matkhau;
    protected $errors = [];

    public function layMaKH()
    {
        return $this->makh;
    }

    public function __construct(array $data = [])
    {
        $this->fill($data);
    }

    public function fill(array $data)
    {
        if (isset($data['makh'])) {
            $this->makh = filter_var(trim($data['makh']), FILTER_SANITIZE_STRING);
        }
        if (isset($data['ho'])) {
            $this->ho = filter_var(trim($data['ho']), FILTER_SANITIZE_STRING);
        }
        if (isset($data['ten'])) {
            $this->ten = filter_var(trim($data['ten']), FILTER_SANITIZE_STRING);
        }
        if (isset($data['gioitinh'])) {
            $this->gioitinh = filter_var(trim($data['gioitinh']), FILTER_SANITIZE_STRING);
        }
        if (isset($data['sdt'])) {
            $this->sdt = preg_replace('/[^0-9]+/', '', $data['sdt']);
        }
        if (isset($data['dchi'])) {
            $this->dchi = filter_var(trim($data['dchi']), FILTER_SANITIZE_STRING);
        }
        if (isset($data['email'])) {
            $this->email = filter_var(trim($data['email']), FILTER_SANITIZE_EMAIL);
        }
        if (isset($data['congviec'])) {
            $this->congviec = filter_var(trim($data['congviec']), FILTER_SANITIZE_STRING);
        }
        if (isset($data['matkhau'])) {
            $this->matkhau =  md5(md5(filter_var(trim($data['matkhau']), FILTER_SANITIZE_STRING)));
        }
        return $this;
    }

    public function getValidationErrors()
    {
        return $this->errors;
    }

    public function validate()
    {
        if (strlen($this->makh) <= 0 || strlen($this->makh) > 5) {
            $this->errors['makh'] = 'Invalid field makh! makh < 0 character or makh > 5 character.';
        }
        if (strlen($this->ho) <= 0 || strlen($this->ho) > 30) {
            $this->errors['ho'] = 'Invalid field ho! field ho is empty or ho > 30 character';
        }
        if (strlen($this->ten) <= 0 || strlen($this->ten) > 10) {
            $this->errors['ten'] = 'Invalid field ten! field ten is empty or ten > 10 character';
        }
        if (strlen($this->gioitinh) < 0 || strlen($this->gioitinh) > 5) {
            $this->errors['gioitinh'] = 'Invalid field gioitinh! field gioitinh is empty or gioitinh > 5 character';
        }
        if (strlen($this->sdt) < 10 || strlen($this->sdt) > 11) {
            $this->errors['sdt'] = 'Invalid field sdt! field sdt < 10 or sdt > 11 character';
        }
        if (strlen($this->dchi) > 255) {
            $this->errors['dchi'] = 'DiaChi > 255 characters.';
        }
        if (strlen($this->email) > 255) {
            $this->errors['email'] = 'Email > 255 characters.';
        }
        if (strlen($this->congviec) > 255) {
            $this->errors['congviec'] = 'Field congviec > 255 characters.';
        }
        if (strlen($this->matkhau) > 255) {
            $this->errors['matkhau'] = 'Mat khau > 255 characters.';
        }
        return empty($this->errors);
    }

    public function toArray()
    {
        return [
            'makh' => $this->makh,
            'ho' => $this->ho,
            'ten' => $this->ten,
            'gioitinh' => $this->gioitinh,
            'sdt' => $this->sdt,
            'dchi' => $this->dchi,
            'email' => $this->email,
            'congviec' => $this->congviec,
            'matkhau' => $this->matkhau
        ];
    }
    public static function all()
    {
        $dsKhachHang = [];
        $db = Db::getInstance();
        $stmt = $db->prepare('select*from khachhang');
        $stmt->execute();
        while ($row = $stmt->fetch()) {
            $khachhang = static::createFromDb($row);
            $dsKhachHang[] = $khachhang;
        }
        return $dsKhachHang;
    }
    protected static function createFromDb(array $data)
    {
        $khachhang = new KhachHang();
        $khachhang->makh = $data['makh'];
        $khachhang->ho = $data['ho'];
        $khachhang->ten = $data['ten'];
        $khachhang->gioitinh = $data['gioitinh'];
        $khachhang->sdt = $data['sdt'];
        $khachhang->dchi = $data['dchi'];
        $khachhang->email = $data['email'];
        $khachhang->congviec = $data['congviec'];
        $khachhang->matkhau = $data['matkhau'];
        return $khachhang;
    }
    public function saveNew()
    {
        $result = false;
        $db = Db::getInstance();
        $stmt = $db->prepare('insert into khachhang(makh,ho,ten,gioitinh,sdt,dchi,email,congviec,matkhau) values(:makh,:ho,:ten,:gioitinh,:sdt,:dchi,:email,:congviec,:matkhau)');
        $result = $stmt->execute([
            'makh' => $this->makh,
            'ho' => $this->ho,
            'ten' => $this->ten,
            'gioitinh' => $this->gioitinh,
            'sdt' => $this->sdt,
            'dchi' => $this->dchi,
            'email' => $this->email,
            'congviec' => $this->congviec,
            'matkhau' => $this->matkhau
        ]);
        /* if ($result) $this->makh = $db->lastInsertId; */
        return $result;
    }
    public function saveUpdate()
    {
        $result = false;
        $db = Db::getInstance();
        $stmt = $db->prepare('update khachhang set ho=:ho, ten=:ten, gioitinh=:gioitinh, sdt=:sdt, dchi=:dchi, email=:email, congviec=:congviec where makh=:makh');
        $result = $stmt->execute([
            'makh' => $this->makh,
            'ho' => $this->ho,
            'ten' => $this->ten,
            'gioitinh' => $this->gioitinh,
            'sdt' => $this->sdt,
            'dchi' => $this->dchi,
            'email' => $this->email,
            'congviec' => $this->congviec
        ]);
        return $result;
    }
    public function saveUpdateMK()
    {
        $result = false;
        $db = Db::getInstance();
        $stmt = $db->prepare('update khachhang set matkhau=:matkhau where makh=:makh');
        $result = $stmt->execute([
            'makh' => $this->makh,
            'matkhau' => $this->matkhau
        ]);
        return $result;
    }
    public static function findByMaKH($makh)
    {
        $khachhang = null;
        $db = Db::getInstance();
        $stmt = $db->prepare('select*from khachhang where makh=:makh');
        $stmt->execute(['makh' => $makh]);
        if($stmt->rowCount()>0)
        if ($row = $stmt->fetch()) {
            $khachhang = static::createFromDb($row);
        }
        return $khachhang;
    }
    public static function findByNameKH($tenDangNhap)
    {
        $timTheoTen = '%'.$tenDangNhap.'%';
        $dsKhachHang = [];
        $db = Db::getInstance();
        $stmt = $db->prepare('select*from khachhang where ten like :ten');
        $stmt->execute(['ten'=> $timTheoTen]);
        while ($row = $stmt->fetch()) {
            $khachhang = static::createFromDb($row);
            $dsKhachHang[] = $khachhang;
        }
        return $dsKhachHang;
    }
    public static function SLKH()
    {
        $soLuongKH = 0;
        $db = Db::getInstance();
        $stmt = $db->prepare('select * from khachhang ');
        $stmt->execute();
        while ($row = $stmt->fetch()) {
            $soLuongKH++;
        }
        return  $soLuongKH;
    }
    public function update(array $data)
    {
        $this->fill($data);
        if ($this->validate()) {
            return $this->saveUpdate();
        }
        return false;
    }
    public function delete()
    {
        $stmt = Db::getInstance()->prepare('delete from khachhang where makh=:makh');
        return $stmt->execute(['makh' => $this->makh]);
    }
}
