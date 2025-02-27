<?
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\PengajuanModel;

class Pengajuan extends ResourceController
{
    protected $modelName = 'App\Models\PengajuanModel';
    protected $format = 'json';

    // GET semua pengajuan
    public function index()
    {
        $data = $this->model->findAll();
        return $this->respond($data);
    }

    // GET pengajuan by ID
    public function show($id = null)
    {
        $data = $this->model->find($id);
        if ($data) return $this->respond($data);
        return $this->failNotFound("Data tidak ditemukan");
    }

    // POST pengajuan baru
    public function create()
    {
        $data = $this->request->getJSON();
        
        // Handle upload dokumen
        if ($this->request->hasFile('dokumen')) {
            $file = $this->request->getFile('dokumen');
            $fileName = $file->getRandomName();
            $file->move('uploads', $fileName);
            $data->dokumen = $fileName;
        }

        if ($this->model->save($data)) {
            return $this->respondCreated($data);
        }
        return $this->fail($this->model->errors());
    }

    // PUT update pengajuan
    public function update($id = null)
    {
        $data = $this->request->getJSON();
        $this->model->update($id, $data);
        return $this->respond($data);
    }

    // DELETE pengajuan
    public function delete($id = null)
    {
        $this->model->delete($id);
        return $this->respondDeleted(['id' => $id]);
    }
}