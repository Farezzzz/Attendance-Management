<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class GuruModel extends Model{
    protected $table = 'guru';
    protected $primaryKey = 'guru_id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['guru_nik','guru_nama','guru_email','guru_position','guru_wakel', 'user'];

    public function search($keyword){
        $builder = $this->table('guru');
        $builder->like('guru_nama', $keyword);

        return $builder;
    }

}