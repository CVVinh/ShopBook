<?php
namespace CT275\Project;

class TheLoai extends LoaiSach
{
    protected $matheloai ;
    protected $maloai ;
    public $tentheloai;
    protected $errors = [];

    public function layMaTheLoai()
    {
        return $this->matheloai;
    }
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
        if (isset($data['matheloai'])) {
            $this->matheloai = filter_var(trim($data['matheloai']), FILTER_SANITIZE_STRING);
        }
        if (isset($data['maloai'])) {
            $this->maloai = filter_var(trim($data['maloai']), FILTER_SANITIZE_STRING);
        }
        if (isset($data['tentheloai'])) {
            $this->tentheloai = filter_var(trim($data['tentheloai']), FILTER_SANITIZE_STRING);
        }
        return $this;
    }

    public function getValidationErrors()
    {
        return $this->errors;
    }

    public function validate()
    {
        if (strlen($this->matheloai) <= 0 || strlen($this->matheloai) > 6) {
            $this->errors['matheloai'] = 'Invalid matheloai! matheloai < 0 character or matheloai > 6 character';
        }
        if (strlen($this->maloai) <= 0 || strlen($this->maloai) > 5) {
            $this->errors['maloai'] = 'Invalid maloai! maloai < 0 character or maloai > 5 character';
        }
        if (strlen($this->tentheloai) > 255) {
            $this->errors['tentheloai'] = 'Invalid tentheloai! tentheloai > 255 character';
        }
        return empty($this->errors);
    }

    public function toArray()
    {
        return [
            'matheloai' => $this->matheloai,
            'maloai' => $this->maloai,
            'tentheloai' => $this->tentheloai
        ];
    }
    public static function all(){
        $dsTheLoai = [];
        $db = Db::getInstance();
        $stmt = $db->prepare('select*from TheLoai');
        $stmt->execute();
        while($row = $stmt->fetch()){
            $theloai = static::createFromDb($row);
            $dsTheLoai[] = $theloai;
        }
        return $dsTheLoai;
    }
    protected static function createFromDb(array $data){
        $theloai = new TheLoai();
        $theloai->matheloai = $data['matheloai'];
        $theloai->maloai = $data['maloai'];
        $theloai->tentheloai = $data['tentheloai'];
        return $theloai;
    }
    public function save(){
        $result = false;
        $db = Db::getInstance();
        if($this->matheloai != ""){
            $stmt=$db->prepare('update contacts set maloai=:maloai,tentheloai=:tentheloai where matheloai=:matheloai');
            $result = $stmt->execute([
                'matheloai' => $this->matheloai,
                'maloai' => $this->maloai,
                'tentheloai' => $this->tentheloai
            ]);
        } else {
            $stmt=$db->prepare('insert into contacts(matheloai,maloai,tentheloai) values(:matheloai,:maloai,:tentheloai)');
            $result=$stmt->execute([
                'matheloai' => $this->matheloai,
                'maloai' => $this->maloai,
                'tentheloai' => $this->tentheloai
            ]);
            if($result) $this->matheloai = $db->lastInsertId;
        }
        return $result;
    }
    public static function findMaTheLoai($matheloai)
    {
        $theloai = null;
        $db = Db::getInstance();
        $stmt = $db->prepare('select*from theloai where matheloai=:matheloai');
        $stmt->execute(['matheloai' => $matheloai]);
        if ($row = $stmt->fetch()) {
            $theloai = static::createFromDb($row);
        }
        return $theloai;
    }
    public static function findMaLoai($maloai){
        $dsTheLoai = [];
        $db = Db::getInstance();
        $stmt = $db->prepare('select*from theloai where maloai=:maloai');
        $stmt->execute(['maloai' => $maloai]);
        while($row = $stmt->fetch()){
            $theloai = static::createFromDb($row);
            $dsTheLoai[] = $theloai;
        }
        return $dsTheLoai;
    }
    public function update(array $data){
        $this->fill($data);
        if($this->validate()){
            return $this->save();
        }
        return false;
    }
    public function delete(){
        $stmt=Db::getInstance()->prepare('delete from theloai where matheloai=:matheloai');
        return $stmt->execute(['matheloai' => $this->matheloai]);
    }

}
