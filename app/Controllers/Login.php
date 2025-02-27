<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;
use App\Models\StaffModel;

class Login extends BaseController
{
    public function index()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $mahasiswaModel = new MahasiswaModel();
        $staffModel = new StaffModel();

        $mahasiswa = $mahasiswaModel->where('NIM', $username)->first();
        $staff = $staffModel->where('NIP', $username)->first();

        if ($mahasiswa && $mahasiswa['NIM'] === $password) {
            return $this->response->setJSON(['user_type' => 'mahasiswa', 'user_id' => $mahasiswa['NIM']]);
        } elseif ($staff && $staff['NIP'] === $password) {
            return $this->response->setJSON(['user_type' => 'staff', 'user_id' => $staff['NIP']]);
        } else {
            return $this->response->setJSON(['error' => 'Invalid credentials']);
        }
    }
}