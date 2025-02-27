<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;
use Config\Database;

class StaffController extends Controller
{
    use ResponseTrait;

    public function greetings($nip)
    {
        $db = Database::connect();
        $query = $db->query('
            SELECT nama
            FROM staff
            WHERE NIP = ?
        ', [$nip]);

        $staff = $query->getRow();

        if ($staff) {
            return $this->respond([
                'message' => 'Hai ' . $staff->nama . ', how are you?'
            ], 200);
        } else {
            return $this->failNotFound('Staff not found');
        }
    }

    public function manageMahasiswa()
    {
        // Implement CRUD operations for Mahasiswa
    }

    public function manageStaff()
    {
        // Implement CRUD operations for Staff
    }

    public function processLeaveApplications()
    {
        // Implement approving and declining leave applications
    }

    public function viewAllLeaveApplications()
    {
        $db = Database::connect();
        $query = $db->query('
            SELECT
                p.id_pengajuan, 
                m.NIM, 
                m.nama AS nama_mahasiswa, 
                pr.nama AS program_studi, 
                j.nama AS jurusan, 
                p.semester_cuti, 
                p.tgl_mulai_cuti, 
                p.tgl_selesai_cuti, 
                p.alasan, 
                s.NIP, 
                s.nama
            FROM
                pengajuan p
                JOIN mahasiswa m ON p.NIM = m.NIM
                JOIN prodi pr ON m.id_prodi = pr.id_prodi
                JOIN jurusan j ON pr.id_jurusan = j.id_jurusan,
                staff s
            ORDER BY
                p.tgl_pengajuan ASC
        ');

        $applications = $query->getResult();

        return $this->respond($applications, 200);
    }
}