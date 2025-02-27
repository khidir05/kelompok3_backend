<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;
use Config\Database;

class MahasiswaController extends Controller
{
    use ResponseTrait;

    public function detail($nim)
    {
        $db = Database::connect();
        $query = $db->query('
            SELECT m.NIM, m.nama, p.nama AS program_studi, j.nama AS jurusan
            FROM mahasiswa m
            JOIN prodi p ON m.id_prodi = p.id_prodi
            JOIN jurusan j ON p.id_jurusan = j.id_jurusan
            WHERE m.NIM = ?
        ', [$nim]);

        $mahasiswa = $query->getRow();

        if ($mahasiswa) {
            return $this->respond($mahasiswa, 200);
        } else {
            return $this->failNotFound('Mahasiswa not found');
        }
    }

    public function submitLeave()
    {
        $request = service('request');
        $data = [
            'NIM' => $request->getPost('NIM'),
            'nama' => $request->getPost('nama'),
            'kelas' => $request->getPost('kelas'),
            'semester' => $request->getPost('semester'),
            'tgl_pengajuan' => date('Y-m-d'),
            'semester_cuti' => $request->getPost('semester_cuti'),
            'tgl_mulai_cuti' => $request->getPost('tgl_mulai_cuti'),
            'tgl_selesai_cuti' => $request->getPost('tgl_selesai_cuti'),
            'alasan' => $request->getPost('alasan'),
            'dokumen' => $request->getPost('dokumen'),
            'status_pengajuan' => 'Menunggu'
        ];

        $db = Database::connect();
        $builder = $db->table('pengajuan');
        $builder->insert($data);

        return $this->respondCreated([
            'message' => 'Leave application submitted successfully',
            'data' => $data
        ]);
    }

    public function history($nim)
    {
        $db = Database::connect();
        $query = $db->query('
            SELECT id_pengajuan, semester_cuti, tgl_mulai_cuti, tgl_selesai_cuti, alasan, status_pengajuan
            FROM pengajuan
            WHERE NIM = ?
            ORDER BY tgl_pengajuan ASC
        ', [$nim]);

        $history = $query->getResult();

        return $this->respond($history, 200);
    }
}