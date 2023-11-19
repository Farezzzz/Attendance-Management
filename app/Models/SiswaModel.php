<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class SiswaModel extends Model{
    protected $table = 'siswa';
    protected $primaryKey = 'siswa_id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['siswa_nis', 'kelas_id', 'siswa_nama', 'siswa_email', 'siswa_position', 'user'];

    public function search($keyword){
        $keyword = $keyword ? $keyword :"";
        $builder = $this->table('siswa');
        $builder->like('siswa_nama ', $keyword);

        return $builder;
    }
}