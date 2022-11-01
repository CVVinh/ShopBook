<?php
namespace CT275\Project;

class Sach extends TheLoai
{
    protected $masach = "";
    protected $matheloai = "";
    public $tensach;
    public $tacgia;
    public $nxb;
    public $namxb;
    public $ngonngu;
    public $kichthuoc;
    public $hinhanh;
    public $soluong;
    public $giaban;
    public $giamgia;
    public $sotrang;
    public $bientap;
    protected $errors = [];

    public function layMaSach()
    {
        return $this->masach;
    }
    public function layMaTheLoai()
    {
        return $this->matheloai;
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
        if (isset($data['matheloai'])) {
            $this->matheloai = filter_var(trim($data['matheloai']), FILTER_SANITIZE_STRING);
        }
        if (isset($data['tensach'])) {
            $this->tensach = filter_var(trim($data['tensach']), FILTER_SANITIZE_STRING);
        }
        if (isset($data['tacgia'])) {
            $this->tacgia = filter_var(trim($data['tacgia']), FILTER_SANITIZE_STRING);
        }
        if (isset($data['nxb'])) {
            $this->nxb = filter_var(trim($data['nxb']), FILTER_SANITIZE_STRING);
        }
        if (isset($data['namxb'])) {
            $this->namxb = preg_replace('/[^0-9]+/', '', trim($data['namxb']));
        }
        if (isset($data['ngonngu'])) {
            $this->ngonngu = filter_var(trim($data['ngonngu']), FILTER_SANITIZE_STRING);
        }
        if (isset($data['kichthuoc'])) {
            $this->kichthuoc = filter_var(trim($data['kichthuoc']), FILTER_SANITIZE_STRING);
        }
        if (isset($data['hinhanh'])) {
            $this->hinhanh = filter_var(trim($data['hinhanh']), FILTER_SANITIZE_URL);
        }
        if (isset($data['soluong'])) {
            $this->soluong = filter_var(trim($data['soluong']), FILTER_SANITIZE_NUMBER_INT);
        }
        if (isset($data['giaban'])) {
            $this->giaban = filter_var(trim($data['giaban']), FILTER_SANITIZE_NUMBER_FLOAT);
        }
        if (isset($data['giamgia'])) {
            $this->giamgia = filter_var(trim($data['giamgia']), FILTER_SANITIZE_NUMBER_INT);
        }
        if (isset($data['sotrang'])) {
            $this->sotrang = filter_var(trim($data['sotrang']), FILTER_SANITIZE_NUMBER_INT);
        }
        if (isset($data['bientap'])) {
            $this->bientap = filter_var(trim($data['bientap']), FILTER_SANITIZE_STRING);
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
        if (strlen($this->matheloai) <= 0 || strlen($this->matheloai) > 6) {
            $this->errors['matheloai'] = 'Invalid field matheloai! matheloai < 0 character or matheloai > 6 character';
        }
        if (strlen($this->tensach) > 255) {
            $this->errors['tensach'] = 'Invalid field tensach! tensach > 255 character';
        }
        if (strlen($this->tacgia) > 255) {
            $this->errors['tacgia'] = 'Invalid field tacgia! tacgia > 255 character';
        }
        if (strlen($this->nxb) > 255) {
            $this->errors['nxb'] = 'Invalid field nxb! nxb > 255 character';
        }
        if (strlen($this->hinhanh) > 255) {
            $this->errors['hinhanh'] = 'Invalid field hinhanh! hinhanh > 255 character';
        }
        if (!is_int($this->soluong) || $this->soluong <= 0) {
            $this->errors['soluong'] = 'Invalid field soluong! soluong is < 0 or soluong is not integer';
        }
        if (!is_int($this->giaban) || !is_float($this->giaban) || $this->giaban < 0) {
            $this->errors['giaban'] = 'Invalid field giaban! giaban is < 0 or giaban is not integer| float';
        }
        if (!is_int($this->giamgia)) {
            $this->errors['giamgia'] = 'Invalid field giamgia! giamgia is not integer';
        }
        if (!is_int($this->sotrang) || $this->sotrang < 0) {
            $this->errors['sotrang'] = 'Invalid field sotrang! sotrang is < 0 or sotrang is not integer';
        }
        if (strlen($this->bientap) > 255) {
            $this->errors['bientap'] = 'Invalid field bientap! bientap > 255 character';
        }
        return empty($this->errors);
    }

    public function toArray()
    {
        return [
            'masach' => $this->masach,
            'matheloai' => $this->matheloai,
            'tensach' => $this->tensach,
            'tacgia' => $this->tacgia,
            'nxb' => $this->nxb,
            'namxb' => $this->namxb,
            'ngonngu' => $this->ngonngu,
            'kichthuoc' => $this->kichthuoc,
            'hinhanh' => $this->hinhanh,
            'soluong' => $this->soluong,
            'giaban' => $this->giaban,
            'giamgia' => $this->giamgia,
            'sotrang' => $this->sotrang,
            'bientap' => $this->bientap
        ];
    }
    public static function all()
    {
        $dssach = [];
        $db = Db::getInstance();
        $stmt = $db->prepare('select*from sach');
        $stmt->execute();
        while ($row = $stmt->fetch()) {
            $sach = static::createFromDb($row);
            $dssach[] = $sach;
        }
        return $dssach;
    }
    protected static function createFromDb(array $data)
    {
        $sach = new Sach();
        $sach->masach = $data['masach'];
        $sach->matheloai = $data['matheloai'];
        $sach->tensach = $data['tensach'];
        $sach->tacgia = $data['tacgia'];
        $sach->nxb = $data['nxb'];
        $sach->namxb = $data['namxb'];
        $sach->ngonngu = $data['ngonngu'];
        $sach->kichthuoc = $data['kichthuoc'];
        $sach->hinhanh = $data['hinhanh'];
        $sach->soluong = $data['soluong'];
        $sach->giaban = $data['giaban'];
        $sach->giamgia = $data['giamgia'];
        $sach->sotrang = $data['sotrang'];
        $sach->bientap = $data['bientap'];
        return $sach;
    }
    public function save()
    {
        $result = false;
        $db = Db::getInstance();
        if ($this->masach != "") {
            $stmt = $db->prepare('update contacts set matheloai=:matheloai, tensach=:tensach, tacgia=:tacgia, nxb=:nxb, namxb=:namxb, ngonngu=:ngonngu, kichthuoc=:kichthuoc, hinhanh=:hinhanh, soluong=:soluong, giaban=:giaban, giamgia=:giamgia, sotrang=:sotrang, bientap=:bientap where masach=:masach');
            $result = $stmt->execute([
                'masach' => $this->masach,
                'matheloai' => $this->matheloai,
                'tensach' => $this->tensach,
                'tacgia' => $this->tacgia,
                'nxb' => $this->nxb,
                'namxb' => $this->namxb,
                'ngonngu' => $this->ngonngu,
                'kichthuoc' => $this->kichthuoc,
                'hinhanh' => $this->hinhanh,
                'soluong' => $this->soluong,
                'giaban' => $this->giaban,
                'giamgia' => $this->giamgia,
                'sotrang' => $this->sotrang,
                'bientap' => $this->bientap
            ]);
        } else {
            $stmt = $db->prepare('insert into contacts(masach,matheloai,tensach,tacgia,nxb,namxb,ngonngu,kichthuoc,hinhanh,soluong,giaban,giamgia,sotrang,bientap) values(:masach,:matheloai,:tensach,:tacgia,:nxb,:namxb,:ngonngu,:kichthuoc,:hinhanh,:soluong,:giaban,:giamgia,:sotrang,:bientap)');
            $result = $stmt->execute([
                'masach' => $this->masach,
                'matheloai' => $this->matheloai,
                'tensach' => $this->tensach,
                'tacgia' => $this->tacgia,
                'nxb' => $this->nxb,
                'namxb' => $this->namxb,
                'ngonngu' => $this->ngonngu,
                'kichthuoc' => $this->kichthuoc,
                'hinhanh' => $this->hinhanh,
                'soluong' => $this->soluong,
                'giaban' => $this->giaban,
                'giamgia' => $this->giamgia,
                'sotrang' => $this->sotrang,
                'bientap' => $this->bientap
            ]);
            /* if ($result) $this->masach = $db->lastInsertId; */
        }
        return $result;
    }
    public static function findMaSach($masach)
    {
        $sach = null;
        $db = Db::getInstance();
        $stmt = $db->prepare('select*from sach where masach=:masach');
        $stmt->execute(['masach' => $masach]);
        if ($row = $stmt->fetch()) {
            $sach = static::createFromDb($row);
        }
        return $sach;
    }
    public static function findDSTenSach($tensach)
    {
        $dssach = [];
        $sachCanTim = '%'.$tensach.'%';
        $db = Db::getInstance();
        $stmt = $db->prepare('select*from sach where tensach like :tensach');
        $stmt->execute(['tensach' => $sachCanTim]);
        while ($row = $stmt->fetch()) {
            $sach = static::createFromDb($row);
            $dssach[] = $sach;
        }
        return $dssach;
    }
    public static function findMaTheLoai($matheloai)
    {
        $dssach = [];
        $db = Db::getInstance();
        $stmt = $db->prepare('select*from sach where matheloai=:matheloai');
        $stmt->execute(['matheloai' => $matheloai]);
        while ($row = $stmt->fetch()) {
            $sach = static::createFromDb($row);
            $dssach[] = $sach;
        }
        return $dssach;
    }
    public function update(array $data)
    {
        $this->fill($data);
        if ($this->validate()) {
            return $this->save();
        }
        return false;
    }
    public function delete()
    {
        $stmt = Db::getInstance()->prepare('delete from sach where masach=:masach');
        return $stmt->execute(['masach' => $this->masach]);
    }
}
