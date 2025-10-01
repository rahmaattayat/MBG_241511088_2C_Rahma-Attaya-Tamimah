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
            'bahan_baku' => $bahanBakuModel->findAll()
        ];
        
        return view('bahan_baku/index', $data);
    }
}