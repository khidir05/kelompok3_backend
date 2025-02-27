<?php

namespace App\Models;

use CodeIgniter\Model;

class PersetujuanModel extends Model
{
    protected $table = 'persetujuan';
    protected $primaryKey = 'id_persetujuan';
    protected $allowedFields = [
        'id_pengajuan', 'id_staff', 'tgl_persetujuan', 
        'status_persetujuan', 'keterangan'
    ];
    
    // Validasi enum status_persetujuan
    protected $validationRules = [
        'status_persetujuan' => 'in_list[ACC,Tolak]'
    ];

    // Relasi ke Pengajuan dan Staff
    public function pengajuan()
    {
        return $this->belongsTo('PengajuanModel', 'id_pengajuan');
    }

    public function staff()
    {
        return $this->belongsTo('StaffAkademikModel', 'id_staff');
    }
}