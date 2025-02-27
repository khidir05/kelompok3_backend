<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'NIM';
    protected $allowedFields = [
        'NIM', 'nama', 'kelas', 'semester', 'status', 'id_prodi'
    ];
    protected $useTimestamps = false;

    // Relasi ke Prodi
    public function prodi()
    {
        return $this->belongsTo('ProdiModel', 'id_prodi');
    }
}