<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BahanBakuModel;

class Dashboard extends BaseController
{
    public function index()
    {
            $data = [];
            $userRole = session()->get('user_role');

            if ($userRole === 'gudang' || $userRole === 'dapur') {
                $bahanBakuModel = new BahanBakuModel();
                $data['bahan_baku'] = $bahanBakuModel->getAllWithDynamicStatus();                
            }

            return view('dashboard_view', $data);
    }

    public function tambahBahanBaku()
    {
        
        if (session()->get('user_role') !== 'gudang') {
            return redirect()->to('/dashboard');
        }

        $data = ['title' => 'Form Tambah Bahan Baku'];
        return view('bahan_baku/create', $data); 
    }

    public function simpanBahanBaku()
    {
        if (session()->get('user_role') !== 'gudang') {
            return redirect()->to('/dashboard');
        }

        $bahanBakuModel = new BahanBakuModel();

        $data = [
            'nama' => $this->request->getPost('nama'),
            'kategori' => $this->request->getPost('kategori'),
            'jumlah' => $this->request->getPost('jumlah'),
            'satuan' => $this->request->getPost('satuan'),
            'tanggal_masuk' => $this->request->getPost('tanggal_masuk'),
            'tanggal_kadaluarsa' => $this->request->getPost('tanggal_kadaluarsa'),
            'status' => 'tersedia', 
            'created_at' => date('Y-m-d H:i:s')
        ];

        $bahanBakuModel->insert($data);

        session()->setFlashdata('success', 'Bahan baku berhasil ditambahkan.');
        return redirect()->to('/dashboard'); 
    }

}