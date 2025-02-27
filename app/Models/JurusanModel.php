<?php

namespace App\Models;

use CodeIgniter\Model;

class JurusanModel extends Model
{
    protected $table = 'jurusan';
    protected $primaryKey = ['id_jurusan', 'nama']; // Composite primary key
    protected $allowedFields = ['id_jurusan', 'nama'];
    protected $useAutoIncrement = false; // Karena primary key bukan auto-increment

    // Override method untuk handle composite key
    public function getPrimaryKeyName()
    {
        return $this->primaryKey;
    }
}