<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class TingkatModel extends Model{
    protected $table = 'tingkat';
    protected $primaryKey = 'tingkat_id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['tingkat'];
}