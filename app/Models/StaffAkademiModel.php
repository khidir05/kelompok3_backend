<?php

namespace App\Models;

use CodeIgniter\Model;

class StaffAkademikModel extends Model
{
    protected $table = 'staff_akademik';
    protected $primaryKey = 'id_staff';
    protected $allowedFields = [
        'id_staff', 'nama', 'jabatan', 'no_hp', 'email'
    ];
    
    // Validasi format email
    protected $validationRules = [
        'email' => 'valid_email'
    ];
}