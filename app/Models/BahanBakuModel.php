<?php

namespace App\Models;

use CodeIgniter\Model;
use DateTime; // <-- Penting!

class BahanBakuModel extends Model
{
    protected $table            = 'bahan_baku';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'nama', 'kategori', 'jumlah', 'satuan',
        'tanggal_masuk', 'tanggal_kadaluarsa', 'status', 'created_at'
    ];

    // FUNGSI UNTUK MENGAMBIL DATA DENGAN STATUS OTOMATIS
    public function getAllWithDynamicStatus()
    {
        $semuaBahan = $this->findAll();
        $today = new DateTime();

        foreach ($semuaBahan as &$bahan) {
            $kadaluarsaDate = new DateTime($bahan['tanggal_kadaluarsa']);
            $interval = $today->diff($kadaluarsaDate);
            $daysRemaining = (int)$interval->format('%r%a');

            if ($bahan['jumlah'] <= 0) {
                $bahan['status'] = 'habis';
            } elseif ($daysRemaining < 0) {
                $bahan['status'] = 'kadaluarsa';
            } elseif ($daysRemaining <= 3) { // H-3 atau kurang
                $bahan['status'] = 'segera_kadaluarsa';
            } else {
                $bahan['status'] = 'tersedia';
            }
        }

        return $semuaBahan;
    }
}