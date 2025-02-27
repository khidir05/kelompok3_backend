<?php

namespace App\Controllers;

use App\Models\PengajuanModel;

class Staff extends BaseController
{
    public function approveApplication($id)
    {
        $model = new PengajuanModel();
        $model->update($id, ['status_pengajuan' => 'Disetujui']);

        return $this->response->setJSON(['message' => 'Application approved']);
    }

    public function declineApplication($id)
    {
        $model = new PengajuanModel();
        $model->update($id, ['status_pengajuan' => 'Ditolak']);

        return $this->response->setJSON(['message' => 'Application declined']);
    }

    public function getPendingApplications()
    {
        $model = new PengajuanModel();
        $applications = $model->where('status_pengajuan', 'Menunggu')->findAll();

        return $this->response->setJSON($applications);
    }
}