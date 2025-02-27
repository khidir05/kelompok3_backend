<?php

namespace App\Controllers;

use App\Models\PengajuanModel;

class Mahasiswa extends BaseController
{
    public function submitApplication()
    {
        $data = $this->request->getJSON(true);
        $model = new PengajuanModel();

        $data['status_pengajuan'] = 'Menunggu'; // Default status
        $model->insert($data);

        return $this->response->setJSON(['message' => 'Application submitted successfully']);
    }

    public function getApplications($nim)
    {
        $model = new PengajuanModel();
        $applications = $model->where('NIM', $nim)->findAll();

        return $this->response->setJSON($applications);
    }
}