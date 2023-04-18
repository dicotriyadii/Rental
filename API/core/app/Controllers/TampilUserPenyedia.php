<?php namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Model_data; 
use App\Models\Model_user; 

class TampilUserPenyedia extends ResourceController
{ 
    // create a product
    public function create()
    {       
        //variable
        $user       = new Model_user();
        $data       = new Model_data();
        $username   = $this->request->getVar('username');
        $token      = $this->request->getVar('token');
        // Cek Validasi
        $dataValidasi = [
            'username'  => $username,
            'token'     => $token
        ];
        $cekAkses   = $user->where($dataValidasi)->findAll();
        if($cekAkses == null){
            $response[] = [
                'status'    => 400,
                'messages'  => 'Tidak Ada Akses !! Silahkan Login Terlebih Dahulu'
            ];
            return $this->respond($response,400);  
        }
        $dataResponse = $data->getUserPenyedia();
        $response []= [
            'status'    => 200,
            'messages'  => 'Data Berhasil Ditemukan',
            'data'      => $dataResponse
        ];
        return $this->respond($response,200);
    }         
}