<?php

namespace CT275\Project;

class PhieuMuaHang
{
    protected $masach;
    protected $mahd;
    public $soluong;
    public $ngaydat;
    public $ngaygiao;
    public $kieuthanhtoan;
    protected $errors = [];

    public function layMaSach()
    {
        return $this->masach;
    }
    public function layMaHD()
    {
        return $this->mahd;
    }

    public function __construct(array $data = [])
    {
        $this->fill($data);
    }

    public function fill(array $data)
    {
        if (isset($data['masach'])) {
            $this->masach = filter_var(trim($data['masach']), FILTER_SANITIZE_STRING);
        }
        if (isset($data['mahd'])) {
            $this->mahd = filter_var(trim($data['mahd']), FILTER_SANITIZE_STRING);
        }
        if (isset($data['soluong'])) {
            $this->soluong = filter_var(trim($data['soluong']), FILTER_SANITIZE_NUMBER_INT);
        }
        if (isset($data['ngaydat'])) {
            $this->ngaydat = $data['ngaydat'];
        }
        if (isset($data['ngaygiao'])) {
            $this->ngaygiao = $data['ngaygiao'];
        }
        if (isset($data['kieuthanhtoan'])) {
            $this->kieuthanhtoan = filter_var(trim($data['kieuthanhtoan']), FILTER_SANITIZE_STRING);
        }
        return $this;
    }

    public function getValidationErrors()
    {
        return $this->errors;
    }

    public function validate()
    {
        if (strlen($this->masach) <= 0 || strlen($this->masach) > 9) {
            $this->errors['masach'] = 'Invalid field field masach! masach < 0 character or masach > 9 character.';
        }
        if (strlen($this->mahd) <= 0 || strlen($this->mahd) > 5) {
            $this->errors['mahd'] = 'Invalid field field mahd! mahd < 0 character or mahd > 5 character.';
        }
        if (!is_int($this->soluong)) {
            $this->errors['soluong'] = 'Invalid field soluong! soluong is not integer';
        }
        if (strlen($this->kieuthanhtoan) > 255) {
            $this->errors['kieuthanhtoan'] = 'Invalid field kieuthanhtoan! kieuthanhtoan > 255 character';
        }
        return empty($this->errors);
    }

    public function toArray()
    {
        return [
            'masach' => $this->masach,
            'mahd' => $this->mahd,
            'soluong' => $this->soluong,
            'ngaydat' => $this->ngaydat,
            'ngaygiao' => $this->ngaygiao,
            'kieuthanhtoan' => $this->kieuthanhtoan
        ];
    }
    public static function all()
    {
        $phieuMuaHang = [];
        $db = Db::getInstance();
        $stmt = $db->prepare('select*from phieumuahang');
        $stmt->execute();
        while ($row = $stmt->fetch()) {
            $hangMua = static::createFromDb($row);
            $phieuMuaHang[] = $hangMua;
        }
        return $phieuMuaHang;
    }
    public static function SLPMH()
    {
        $sLPMH = 0;
        $db = Db::getInstance();
        $stmt = $db->prepare('select*from phieumuahang');
        $stmt->execute();
        while ($row = $stmt->fetch()) {
            $sLPMH++;
        }
        return $sLPMH;
    }
    protected static function createFromDb(array $data)
    {
        $phieuMuaHang = new PhieuMuaHang();
        $phieuMuaHang->masach = $data['masach'];
        $phieuMuaHang->mahd = $data['mahd'];
        $phieuMuaHang->soluong = $data['soluong'];
        $phieuMuaHang->ngaydat = $data['ngaydat'];
        $phieuMuaHang->ngaygiao = $data['ngaygiao'];
        $phieuMuaHang->kieuthanhtoan = $data['kieuthanhtoan'];
        return $phieuMuaHang;
    }
    public function saveNew()
    {
        $result = false;
        $db = Db::getInstance();
        $stmt = $db->prepare('insert into phieumuahang(masach,mahd,soluong,ngaydat,ngaygiao,kieuthanhtoan) values(:masach,:mahd,:soluong,now(),:ngaygiao,:kieuthanhtoan)');
        $result = $stmt->execute([
            'masach' => $this->masach,
            'mahd' => $this->mahd,
            'soluong' => $this->soluong,
            'ngaygiao' => $this->ngaygiao,
            'kieuthanhtoan' => $this->kieuthanhtoan
        ]);
        /* if($result) $this->masach = $db->lastInsertId; */
        return $result;
    }
    public function saveUpdate()
    {
        $result = false;
        $db = Db::getInstance();
        $stmt = $db->prepare('update phieumuahang set soluong=:soluong, ngaydat=now(), ngaygiao=:ngaygiao, kieuthanhtoan=:kieuthanhtoan where mahd=:mahd and masach=:masach');
        $result = $stmt->execute([
            'masach' => $this->masach,
            'mahd' => $this->mahd,
            'soluong' => $this->soluong,
            'ngaygiao' => $this->ngaygiao,
            'kieuthanhtoan' => $this->kieuthanhtoan
        ]);
        return $result;
    }
    public static function find($masach, $mahd)
    {
        $phieuMuaHang = null;
        $db = Db::getInstance();
        $stmt = $db->prepare('select*from phieumuahang where masach=:masach and mahd=:mahd');
        $stmt->execute(['masach' => $masach, 'mahd' => $mahd]);
        if ($row = $stmt->fetch()) {
            $phieuMuaHang = static::createFromDb($row);
        }
        return $phieuMuaHang;
    }
    public static function findAllSPHD($mahd)
    {
        $phieuMuaHang = [];
        $db = Db::getInstance();
        $stmt = $db->prepare('select*from phieumuahang where mahd=:mahd');
        $stmt->execute(['mahd' => $mahd]);
        while ($row = $stmt->fetch()) {
            $hangMua = static::createFromDb($row);
            $phieuMuaHang[] = $hangMua;
        }
        return $phieuMuaHang;
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
        $stmt = Db::getInstance()->prepare('delete from phieumuahang where masach=:masach and mahd=:mahd');
        return $stmt->execute(['masach' => $this->masach, 'mahd' => $this->mahd]);
    }
}
