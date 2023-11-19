<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class ValidasiModel extends Model{
    protected $table = 'validasi_user';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['nama'];
}