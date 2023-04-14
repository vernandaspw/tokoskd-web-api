<?php

namespace App\Helpers;

use App\Models\DompetTransaksi;
use App\Models\DompetTransaksiItem;
use App\Models\Pengguna;

class SkemaRefferal
{
    public static function createRefferal($refferal)
    {
        // cek level tersedua refferal
        $auth = auth('pengguna')->user();

        $pengguna = Pengguna::find($auth->id);

        if ($auth->reff_1 == null) {
            $pengguna->update([
                'reff_1' => 1,
            ]);
        } elseif ($auth->reff_2 == null) {
            $pengguna->update([
                'reff_2' => $refferal,
            ]);
        } elseif ($auth->reff_3 == null) {
            $pengguna->update([
                'reff_3' => $refferal,
            ]);
        } elseif ($auth->reff_4 == null) {
            $pengguna->update([
                'reff_3' => $refferal,
            ]);
        } elseif ($auth->reff_5 == null) {
            $pengguna->update([
                'reff_3' => $refferal,
            ]);
        }
    }
    public static function komisiFee()
    {
        try {
            // cek kondisi user login memiliki berapa refferal
            $auth = auth('pengguna')->user();

            $lv1 = $auth->reff_1;
            $lv2 = $auth->reff_2;
            $lv3 = $auth->reff_3;
            $lv4 = $auth->reff_4;
            $lv5 = $auth->reff_5;

            $komisi_lv1 = 500;
            $komisi_lv2 = 250;
            $komisi_lv3 = 125;
            $komisi_lv4 = 75;
            $komisi_lv5 = 50;

            // cek
            if ($lv1 != null) {
                SkemaRefferal::buatTransaksi($lv1, $komisi_lv1);

                $komisi_fee = $komisi_lv1;
            } elseif ($lv2 != null) {
                SkemaRefferal::buatTransaksi($lv1, $komisi_lv1);
                SkemaRefferal::buatTransaksi($lv2, $komisi_lv2);

                $komisi_fee = $komisi_lv1 + $komisi_lv2;
            } elseif ($lv3 != null) {
                SkemaRefferal::buatTransaksi($lv1, $komisi_lv1);
                SkemaRefferal::buatTransaksi($lv2, $komisi_lv2);
                SkemaRefferal::buatTransaksi($lv3, $komisi_lv3);

                $komisi_fee = $komisi_lv1 + $komisi_lv2 + $komisi_lv3;
            } elseif ($lv4 != null) {
                SkemaRefferal::buatTransaksi($lv1, $komisi_lv1);
                SkemaRefferal::buatTransaksi($lv2, $komisi_lv2);
                SkemaRefferal::buatTransaksi($lv3, $komisi_lv3);
                SkemaRefferal::buatTransaksi($lv4, $komisi_lv4);

                $komisi_fee = $komisi_lv1 + $komisi_lv2 + $komisi_lv3 + $komisi_lv4;
            } elseif ($lv5 != null) {
                SkemaRefferal::buatTransaksi($lv1, $komisi_lv1);
                SkemaRefferal::buatTransaksi($lv2, $komisi_lv2);
                SkemaRefferal::buatTransaksi($lv3, $komisi_lv3);
                SkemaRefferal::buatTransaksi($lv4, $komisi_lv4);
                SkemaRefferal::buatTransaksi($lv5, $komisi_lv5);

                $komisi_fee = $komisi_lv1 + $komisi_lv2 + $komisi_lv3 + $komisi_lv4 + $komisi_lv5;
            } else {
                $komisi_fee = 0;
            }

            return $komisi_fee;

        } catch (\Throwable$e) {
            return 'Terjadi kesalahan' . $e;
        }

    }

    public static function buatTransaksi($lv, $komisi)
    {
        $make_no = 'C' . date('Y') . date('m') . date('d') . date('H') . date('i') . date('s') . rand(001, 999);
        $cek = DompetTransaksi::where('no', $make_no)->first();
        if ($cek != null) {
            $make_no = 'C' . date('Y') . date('m') . date('d') . date('H') . date('i') . date('s') . rand(001, 999);
        }

        $user_lv = Pengguna::find($lv);

        $dt = DompetTransaksi::create([
            'no_transaksi' => $make_no,
            'pengguna_id' => $user_lv->id,
            'kategori' => 'komisi',
            'metode_pembayaran' => 'saldo',
            'nominal' => $komisi,
            'total' => $komisi,
        ]);
        DompetTransaksiItem::create([
            'dompet_transaksi_id' => $dt->id,
            'jenis' => 'masuk',
            'pengguna_id' => $user_lv->id,
            'ispengirim' => false,
        ]);
        $user_lv->update([
            'saldo' => $user_lv->saldo + $komisi,
        ]);
    }
}