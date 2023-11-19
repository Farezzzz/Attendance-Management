<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class KelasModel extends Model{
    protected $table = 'kelas';
    protected $primaryKey = 'kelas_id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['kelas', 'kelas_wakel'];

    public function search($keyword){
        $builder = $this->table('kelas');
        $builder->like('kelas', $keyword);

        return $builder;
    }

}