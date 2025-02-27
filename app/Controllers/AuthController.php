<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\Response;
use Config\Database;

class AuthController extends Controller
{
    use ResponseTrait;

    public function login()
    {
        $request = service('request');
        $username = $request->getPost('username');
        $password = $request->getPost('password');

        $db = Database::connect();
        $query = $db->query('
            SELECT 
                "mahasiswa" AS user_type,
                m.NIM AS user_id,
                m.nama,
                m.status,
                m.semester,
                m.id_prodi
            FROM Mahasiswa m
            WHERE m.NIM = ? AND m.NIM = ?

            UNION ALL

            SELECT 
                "staff" AS user_type,
                s.NIP AS user_id,
                s.nama,
                s.jabatan AS status,
                NULL AS semester,
                NULL AS id_prodi
            FROM Staff s
            WHERE s.NIP = ? AND s.NIP = ?
        ', [$username, $password, $username, $password]);

        $user = $query->getRow();

        if ($user) {
            return $this->respond([
                'message' => 'Login successful',
                'user' => $user
            ], 200);
        } else {
            return $this->failUnauthorized('Invalid username or password');
        }
    }
}