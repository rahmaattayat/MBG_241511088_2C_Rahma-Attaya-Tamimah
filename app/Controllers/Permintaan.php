<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BahanBakuModel; 
use App\Models\PermintaanModel;
use App\Models\DetailPermintaanModel;

class Permintaan extends BaseController
{
    
    public function index()
    {
        if (session()->get('user_role') !== 'dapur') {
            return redirect()->to('/dashboard');
        }

        $permintaanModel = new PermintaanModel();
        $userId = session()->get('user_id');
        
        $data = [
            'title' => 'Riwayat Permintaan Bahan Baku',
            'permintaan_list' => $permintaanModel->getHistoryByUserId($userId)
        ];

        return view('permintaan/index', $data);
    }
    public function create()
    {
        if (session()->get('user_role') !== 'dapur') {
            return redirect()->to('/dashboard');
        }

        $bahanBakuModel = new BahanBakuModel();
        
        $data = [
            'title' => 'Buat Permintaan Bahan Baku',
            'bahan_baku_tersedia' => $bahanBakuModel->getAvailableForRequest()
        ];
        
        return view('permintaan/create', $data);
    }

    public function store()
    {
        if (session()->get('user_role') !== 'dapur') {
            return redirect()->to('/dashboard');
        }

        $permintaanModel = new PermintaanModel();
        $detailPermintaanModel = new \App\Models\PermintaanDetailModel(); 

        $dataPermintaan = [
            'pemohon_id'    => session()->get('user_id'),
            'tgl_masak'     => $this->request->getPost('tgl_masak'),
            'menu_makan'    => $this->request->getPost('menu_makan'),
            'jumlah_porsi'  => $this->request->getPost('jumlah_porsi'),
            'status'        => 'menunggu',
            'created_at'    => date('Y-m-d H:i:s')
        ];

        $permintaanModel->insert($dataPermintaan);
        $permintaanID = $permintaanModel->getInsertID();

        $bahanIDs = $this->request->getPost('bahan_id');
        $jumlahs = $this->request->getPost('jumlah');

        foreach ($bahanIDs as $index => $bahanID) {
            $dataDetail = [
                'permintaan_id'  => $permintaanID,
                'bahan_id'       => $bahanID,
                'jumlah_diminta' => $jumlahs[$index]
            ];
            $detailPermintaanModel->insert($dataDetail);
        }

        session()->setFlashdata('success', 'Permintaan bahan baku berhasil dikirim.');
        return redirect()->to('/dashboard'); 
    }

    public function gudangIndex()
    {
        if (session()->get('user_role') !== 'gudang') {
            return redirect()->to('/dashboard');
        }

        $permintaanModel = new PermintaanModel();
        
        $data = [
            'title' => 'Daftar Permintaan Masuk',
            'permintaan_list' => $permintaanModel->getAllPermintaan()
        ];

        return view('permintaan/gudang_index', $data);
    }
}