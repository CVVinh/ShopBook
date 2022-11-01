<?php
namespace CT275\Project;

class LoaiSach
{
    protected $maloai = "";
    public $tenloai;
    protected $errors = [];

    public function layMaLoai()
    {
        return $this->maloai;
    }

    public function __construct(array $data = [])
    {
        $this->fill($data);
    }

    public function fill(array $data)
    {
        if (isset($data['maloai'])) {
            $this->maloai = filter_var(trim($data['maloai']), FILTER_SANITIZE_STRING);
        }
        if (isset($data['tenloai'])) {
            $this->tenloai = filter_var(trim($data['tenloai']), FILTER_SANITIZE_STRING);
        }
        return $this;
    }

    public function getValidationErrors()
    {
        return $this->errors;
    }

    public function validate()
    {
        if (strlen($this->maloai) <= 0 || strlen($this->maloai) > 5) {
            $this->errors['maloai'] = 'Invalid maloai! maloai < character or maloai > 5 character';
        }
        if (strlen($this->tenloai) > 255) {
            $this->errors['tenloai'] = 'Invalid tenloai! tenloai > 255 character';
        }
        return empty($this->errors);
    }

    public function toArray()
    {
        return [
            'maloai' => $this->maloai,
            'tenloai' => $this->tenloai,
        ];
    }
    public static function all(){
        $dsLoaiSach = [];
        $db = Db::getInstance();
        $stmt = $db->prepare('select*from loaisach');
        $stmt->execute();
        while($row = $stmt->fetch()){
            $dsls = static::createFromDb($row);
            $dsLoaiSach[] = $dsls;
        }
        return $dsLoaiSach;
    }
    protected static function createFromDb(array $data){
        $loaiSach = new LoaiSach();
        $loaiSach->maloai = $data['maloai'];
        $loaiSach->tenloai = $data['tenloai'];
        return $loaiSach;
    }
    public function save(){
        $result = false;
        $db = Db::getInstance();
        if($this->maloai != ""){
            $stmt=$db->prepare('update loaisach set tenloai=:tenloai where maloai=:maloai');
            $result = $stmt->execute([
                'maloai' => $this->maloai,
                'tenloai' => $this->tenloai,
            ]);
        } else {
            $stmt=$db->prepare('insert into loaisach(maloai,tenloai) values(:maloai,:tenloai)');
            $result=$stmt->execute([
                'maloai' => $this->maloai,
                'tenloai' => $this->tenloai,
            ]);
            if($result) $this->maloai = $db->lastInsertId;
        }
        return $result;
    }
    public static function find($maloai){
        $timLoaiSach = null;
        $db = Db::getInstance();
        $stmt = $db->prepare('select*from loaisach where maloai=:maloai');
        $stmt->execute(['maloai' => $maloai]);
        if($row = $stmt->fetch()){
            $timLoaiSach = static::createFromDb($row);
        }
        return $timLoaiSach;
    }
    public function update(array $data){
        $this->fill($data);
        if($this->validate()){
            return $this->save();
        }
        return false;
    }
    public function delete(){
        $stmt=Db::getInstance()->prepare('delete from loaisach where maloai=:maloai');
        return $stmt->execute(['maloai' => $this->maloai]);
    }

}
