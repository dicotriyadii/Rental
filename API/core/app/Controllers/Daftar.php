<?php namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Model_user;

class Daftar extends ResourceController
{
    use ResponseTrait;

    public function create()
    {
        // inisialisasi Variable
        $session        = session();
        $user           = new Model_user();
        // Variable
        $username       = $this->request->getVar('username');
        $password       = $this->request->getVar('password');
        $hakAkses       = $this->request->getVar('hakAkses');
        $cekUser        = $user->where('username',$username)->findAll();
        if($cekUser != null){
            $response[] = [
                'status'    => 400,
                'messages'  => 'Username sudah terdaftar, silahkan coba lagi'
            ];
            return $this->respond($response,400);  
        }
        $jumlahHash = [
            'cost' => 10,
        ];
        $data = [
            'username'  => $username,
            'password'  => password_hash($password,PASSWORD_DEFAULT,$jumlahHash),
            'hakAkses'  => $hakAkses,
        ];
        $user->insert($data);
        $response[] = [
            'status'    => 200,
            'messages'  => 'Penambahan User Baru Berhasil',
            'data'      => $data,
        ];
        return $this->respond($response,200);  
    }
}