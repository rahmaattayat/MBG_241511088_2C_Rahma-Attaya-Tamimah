<?php

namespace App\Models;

use CodeIgniter\Model;

class PermintaanModel extends Model
{
    protected $table            = 'permintaan';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'pemohon_id',    
        'tgl_masak',     
        'menu_makan',    
        'jumlah_porsi',
        'status',
        'created_at'
    ];

    public function getHistoryByUserId($userId)
    {
        $permintaan_list = $this->where('pemohon_id', $userId)
                                ->orderBy('created_at', 'DESC')
                                ->findAll();
        
        if (empty($permintaan_list)) {
            return [];
        }

        $detailPermintaanModel = new \App\Models\PermintaanDetailModel();

        foreach ($permintaan_list as &$permintaan) {
            $permintaan['details'] = $detailPermintaanModel
                ->select('permintaan_detail.*, bahan_baku.nama as nama_bahan, bahan_baku.satuan')
                ->join('bahan_baku', 'bahan_baku.id = permintaan_detail.bahan_id')
                ->where('permintaan_id', $permintaan['id'])
                ->findAll();
        }

        return $permintaan_list;
    }

    public function getAllPermintaan()
    {
        $permintaan_list = $this->orderBy('created_at', 'DESC')->findAll();
        
        if (empty($permintaan_list)) {
            return [];
        }

        $detailModel = new \App\Models\PermintaanDetailModel();
        $userModel = new \App\Models\UserModel();

        foreach ($permintaan_list as &$permintaan) {
            $user = $userModel->find($permintaan['pemohon_id']);
            $permintaan['nama_pemohon'] = $user ? $user['name'] : 'Tidak Diketahui';

            $permintaan['details'] = $detailModel
                ->select('permintaan_detail.*, bahan_baku.nama as nama_bahan, bahan_baku.satuan')
                ->join('bahan_baku', 'bahan_baku.id = permintaan_detail.bahan_id')
                ->where('permintaan_id', $permintaan['id'])
                ->findAll();
        }

        return $permintaan_list;
    }
}