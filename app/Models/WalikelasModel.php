<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class WalikelasModel extends Model{
    protected $table = 'walikelas';
    protected $primaryKey = 'walikelas_id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['guru_id', 'kelas_id'];

    public function search($keyword){
        $builder = $this->table('walikelas');
        $builder->like('kelas', $keyword);

        return $builder;
    }
}