<?php

namespace App\Models;

use CodeIgniter\Model;

class StaffModel extends Model
{
    protected $table = 'staff';
    protected $primaryKey = 'NIP';
    protected $allowedFields = [
        'nama', 'jabatan'
    ];
}