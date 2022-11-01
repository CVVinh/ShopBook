<?php

namespace CT275\Project;

class HoaDon extends KhachHang
{
    protected $mahd = -1;
    protected $makh;
    public $ngaylap;
    public $giatrihd;
    protected $errors = [];

    public function layMaHD()
    {
        return $this->mahd;
    }
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
        if (isset($data['mahd'])) {
            $this->mahd = filter_var(trim($data['mahd']), FILTER_SANITIZE_STRING);
        }
        if (isset($data['makh'])) {
            $this->makh = filter_var(trim($data['makh']), FILTER_SANITIZE_STRING);
        }
        if (isset($data['ngaylap'])) {
            $this->ngaylap = $data['ngaylap'];
        }
        if (isset($data['giatrihd'])) {
            $this->giatrihd = filter_var(trim($data['giatrihd']), FILTER_SANITIZE_NUMBER_INT);
        }
        return $this;
    }

    public function getValidationErrors()
    {
        return $this->errors;
    }

    public function validate()
    {
        if (strlen($this->mahd) <= 0 || strlen($this->mahd) > 5) {
            $this->errors['mahd'] = 'Invalid field field mahd! mahd < 0 character or mahd > 5 character.';
        }
        if (strlen($this->makh) <= 0 || strlen($this->makh) > 5) {
            $this->errors['makh'] = 'Invalid field makh! makh < 0 character or makh > 5 character.';
        }
        if (!is_int($this->giatrihd) || !is_float($this->giatrihd) || $this->giatrihd < 0) {
            $this->errors['giatrihd'] = 'Invalid field giatrihd! giatrihd is < 0 or giatrihd is not integer| float';
        }
        return empty($this->errors);
    }

    public function toArray()
    {
        return [
            'mahd' => $this->mahd,
            'makh' => $this->makh,
            'ngaylap' => $this->ngaylap,
            'giatrihd' => $this->giatrihd,
        ];
    }
    public static function all()
    {
        $dsHoaDon = [];
        $db = Db::getInstance();
        $stmt = $db->prepare('select*from HoaDon');
        $stmt->execute();
        while ($row = $stmt->fetch()) {
            $hoadon = static::createFromDb($row);
            $dsHoaDon[] = $hoadon;
        }
        return $dsHoaDon;
    }
    public static function SLHD()
    {
        $sLHD = 0;
        $db = Db::getInstance();
        $stmt = $db->prepare('select*from HoaDon');
        $stmt->execute();
        while ($row = $stmt->fetch()) {
            $sLHD++;
        }
        return $sLHD;
    }
    protected static function createFromDb(array $data)
    {
        $hoadon = new HoaDon();
        $hoadon->mahd = $data['mahd'];
        $hoadon->makh = $data['makh'];
        $hoadon->ngaylap = $data['ngaylap'];
        $hoadon->giatrihd = $data['giatrihd'];
        return $hoadon;
    }
    public function saveNew()
    {
        $result = false;
        $db = Db::getInstance();
        $stmt = $db->prepare('insert into hoadon(mahd,makh,ngaylap,giatrihd) values(:mahd,:makh,now(),:giatrihd)');
        $result = $stmt->execute([
            'mahd' => $this->mahd,
            'makh' => $this->makh,
            'giatrihd' => $this->giatrihd
        ]);
        /* if($result) $this->mahd = $db->lastInsertId; */
        return $result;
    }
    public function saveUpdate()
    {
        $result = false;
        $db = Db::getInstance();
        $stmt = $db->prepare('update hoadon set makh=:makh, ngaylap=now(), giatrihd=:giatrihd where mahd=:mahd');
        $result = $stmt->execute([
            'mahd' => $this->mahd,
            'makh' => $this->makh,
            'giatrihd' => $this->giatrihd,
        ]);
        return $result;
    }
    public static function find($mahd)
    {
        $hoadon = null;
        $db = Db::getInstance();
        $stmt = $db->prepare('select*from hoadon where mahd=:mahd');
        $stmt->execute(['mahd' => $mahd]);
        if ($row = $stmt->fetch()) {
            $hoadon = static::createFromDb($row);
        }
        return $hoadon;
    }
    public static function findAllHDKH($makh)
    {
        $dsHoaDon = [];
        $db = Db::getInstance();
        $stmt = $db->prepare('select*from HoaDon where makh=:makh');
        $stmt->execute(['makh' => $makh]);
        while ($row = $stmt->fetch()) {
            $hoadon = static::createFromDb($row);
            $dsHoaDon[] = $hoadon;
        }
        return $dsHoaDon;
    }
    public static function findAllHDKHTheoNgay($makh)
    {
        $dsHoaDon = [];
        $db = Db::getInstance();
        $stmt = $db->prepare('select*from HoaDon where makh=:makh and ngaylap=:ngaylap');
        $stmt->execute(['makh' => $makh, 'ngaylap' => date('Y-m-d')]);
        while ($row = $stmt->fetch()) {
            $hoadon = static::createFromDb($row);
            $dsHoaDon[] = $hoadon;
        }
        return $dsHoaDon;
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
        $stmt = Db::getInstance()->prepare('delete from hoadon where mahd=:mahd');
        return $stmt->execute(['mahd' => $this->mahd]);
    }
}
