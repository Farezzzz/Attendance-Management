<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class UserModel extends Model{
    protected $table = 'users';
    protected $primaryKey = 'user_id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['user_nik','user_name','user_email','user_position','user_password','user_admin','user_skema','user_status','user_created_at'];

    public function search($keyword){
        $builder = $this->table('users');
        $builder->like('user_name ', $keyword);

        return $builder;
    }
}