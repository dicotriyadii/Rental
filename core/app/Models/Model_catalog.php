<?php namespace App\Models;
 
use CodeIgniter\Model;

class Model_catalog extends Model
{
    protected $table = 'tbl_catalog';
    protected $primaryKey = 'idCatalog';
    protected $allowedFields = ['id_user','namaKendaraan','statusKendaraan','jumlahMuatan','keteranganTambahan'];
}