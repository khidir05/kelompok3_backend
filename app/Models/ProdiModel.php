<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdiModel extends Model
{
    protected $table = 'prodi';
    protected $primaryKey = 'id_prodi';
    protected $allowedFields = ['id_prodi', 'nama', 'id_jurusan'];
    
    // Relasi ke Jurusan
    public function jurusan()
    {
        return $this->belongsTo('JurusanModel', 'id_jurusan');
    }
}