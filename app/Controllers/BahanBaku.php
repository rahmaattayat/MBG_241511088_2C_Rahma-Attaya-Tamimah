<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BahanBakuModel;

class BahanBaku extends BaseController
{
    public function index()
    {
        if (session()->get('user_role') !== 'gudang') {
            return redirect()->to('/dashboard');
        }
        
        $bahanBakuModel = new BahanBakuModel();
        
        $data = [
            'title' => 'Daftar Bahan Baku',
            'bahan_baku' => $bahanBakuModel->getAllWithDynamicStatus() 
        ];
        
        return view('bahan_baku/index', $data);
    }

    public function create()
    {
        if (session()->get('user_role') !== 'gudang') {
            return redirect()->to('/dashboard');
        }

        $data = ['title' => 'Form Tambah Bahan Baku'];
        return view('bahan_baku/create', $data);
    }

    public function store()
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

        session()->setFlashdata('success', 'Bahan baku baru berhasil ditambahkan.');
        return redirect()->to('/bahanbaku');
    }

    public function edit($id)
    {
        if (session()->get('user_role') !== 'gudang') {
            return redirect()->to('/dashboard');
        }

        $bahanBakuModel = new BahanBakuModel();
        $data = [
            'title' => 'Form Edit Stok Bahan Baku',
            'bahan' => $bahanBakuModel->find($id)
        ];

        return view('bahan_baku/edit', $data);
    }

    public function update($id)
    {
        if (session()->get('user_role') !== 'gudang') {
            return redirect()->to('/dashboard');
        }

        $bahanBakuModel = new BahanBakuModel();
        $jumlahBaru = $this->request->getPost('jumlah');

        // Validasi: Tolak jika stok < 0
        if ($jumlahBaru < 0) {
            session()->setFlashdata('error', 'Jumlah stok tidak boleh kurang dari 0.');
            return redirect()->back();
        }

        $bahanBakuModel->update($id, [
            'jumlah' => $jumlahBaru
        ]);

        session()->setFlashdata('success', 'Stok bahan baku berhasil di-update.');
        return redirect()->to('/bahanbaku');
    }
}