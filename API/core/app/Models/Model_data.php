<?php namespace App\Models;
 
use CodeIgniter\Model;
class Model_data extends Model
{   
    // Tampil Keselurahan
    // User
    public function getUser()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_user');
        $builder->select('*');
        return $builder->get()->getResultArray();
    }
    public function getUserDetail($username)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_user');
        $builder->select('*');
        $builder->where('username',$username);
        return $builder->get()->getResultArray();
    }
    public function getUserPenyedia()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_user');
        $builder->select('*');
        $builder->where('hakAkses','penyedia');
        return $builder->get()->getResultArray();
    }
}