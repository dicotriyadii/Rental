<?php namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Model_user;
use App\Models\Model_data; 

class Login extends ResourceController
{ 
    // create a product
    public function create()
    {       
        //variable
        $user       = new Model_user();
        $data       = new Model_data();
        $username   = $this->request->getVar('username');
        $pass       = $this->request->getVar('password');
        // Cek Warga
        $cekUser    = $user->where('username',$username)->findAll();
        if($cekUser == null){
            $response[] = [
                'status'    => 200,
                'messages'  => 'Data Kosong'
            ];
            return $this->respond($response,200);  
        }
        $cekPassword   = password_verify($pass,$cekUser[0]['password']);
        if($cekPassword == true){
            $token = rand(1,9999);
            $updateToken = [
                'token' => $token
            ];
            $user->update($cekUser[0]['idUser'],$updateToken);
            $dataResponse = $data->getUserDetail($username);
            $response []= [
                'status'    => 200,
                'messages'  => 'Login Berhasil',
                'data'      => $dataResponse
            ];
        }else{
            $response = [
                'status'    => 400,
                'messages'  => 'Password yang anda masukkan salah, Silahkan Coba Lagi'
            ];
            return $this->respond($response,400);  
        }
        return $this->respond($response,400);
    }         
}