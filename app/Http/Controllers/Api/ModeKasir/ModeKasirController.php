<?php

namespace App\Http\Controllers\Api\ModeKasir;

use App\Helpers\Resfor;
use App\Http\Controllers\Controller;
use App\Http\Resources\BillResource;
use App\Http\Resources\CardItemResource;
use App\Http\Resources\PenjualanResource;
use App\Http\Resources\ProdukItemResouce;
use App\Http\Resources\TutupKasBerhasilResource;
use App\Models\Bill;
use App\Models\BillItem;
use App\Models\CardItem;
use App\Models\Kasir;
use App\Models\KasirLog;
use App\Models\KasirReport;
use App\Models\Kas\Kas;
use App\Models\Kas\KasTJenis;
use App\Models\Kas\KasTKategori;
use App\Models\Kas\KasTransaksi;
use App\Models\Penjualan\Penjualan;
use App\Models\Penjualan\PenjualanItem;
use App\Models\Produk;
use App\Models\ProdukItem;
use App\Models\RiwayatHarga;
use App\Models\StokJenis;
use App\Models\StokKategori;
use App\Models\StokTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ModeKasirController extends Controller
{
    public function kasir()
    {
        $kasir = Kasir::with('kasir_report', 'kas')->where('isaktif', true)->get();
        if ($kasir) {
            return Resfor::success($kasir, 'success');
        } else {
            return Resfor::error(null, 'error');
        }
    }

    public function buka_kas_kasir(Request $req)
    {
        try {
            $kasir_id = $req->kasir_id;
            $kasir = Kasir::with('kas')->find($kasir_id);
            $kasirReport = KasirReport::create([
                'kasir_id' => $kasir_id,
                'kas_awal' => $kasir->kas->saldo,
                'buka_oleh' => auth('api')->user()->id,
                'status' => 'open',
            ]);
            $kasir->update([
                'status' => 'open',
            ]);
            if ($kasirReport) {
                $kasirlog = KasirLog::where('kasir_id', $kasir_id)->whereDate('created_at', Carbon::today())->where('user_id', auth('api')->user()->id)->first();
                if ($kasirlog == null) {
                    KasirLog::create([
                        'kasir_id' => $kasir_id,
                        'user_id' => auth('api')->user()->id,
                    ]);
                }
                return Resfor::success($kasirReport, 'success');
            } else {
                return Resfor::error(null, 'error');
            }
        } catch (\Throwable$e) {
            return Resfor::error($e->getMessage(), 'error');
        }
    }

    public function kasir_log_masuk(Request $req)
    {
        $kasir_id = $req->kasir_id;
        $kasirlog = KasirLog::where('kasir_id', $kasir_id)->whereDate('created_at', Carbon::today())->where('user_id', auth('api')->user()->id)->first();
        if ($kasirlog == null) {
            KasirLog::create([
                'kasir_id' => $kasir_id,
                'user_id' => auth('api')->user()->id,
            ]);
        }
        return Resfor::success($kasirlog, 'success');
    }

    public function get_tutup_kas_kasir(Request $req)
    {
        $kasir_id = $req->kasir_id;
        $kasir = Kasir::find($kasir_id);
        // dari kasir id cari kasir log yang terbuka dari kasir id tsb

        // Mencari kas awal
        $kasirReport = KasirReport::with('kasir', 'buka_olehs')->where('kasir_id', $kasir_id)->where('status', 'open')->first();

        if ($kasirReport) {
            // total uang masuk
            $masuk = KasTJenis::where('nama', 'masuk')->first()->id;
            $uang_masuk = KasTransaksi::where('kas_id', $kasir->kas_id)->where('kas_t_jenis_id', $masuk)->whereBetween('created_at', [$kasirReport->created_at, now()])->get()->sum('nominal');

            // return Resfor::success($uang_masuk, 'cek');
            // total uang keluar
            $keluar = KasTJenis::where('nama', 'keluar')->first()->id;
            $kasTrKeluar = KasTransaksi::where('kas_id', $kasir->kasir_id)->whereBetween('created_at', [$kasirReport->created_at, now()]);
            $uang_keluar = $kasTrKeluar->where('kas_t_jenis_id', $keluar)->get()->sum('nominal');

            // kas akhir
            $kas_akhir = $kasir->kas->saldo;

            // data penjualan
            $pen = Penjualan::where('kasir_id', $kasir_id)->whereBetween('created_at', [$kasirReport->created_at, now()]);
            $jumlah_penjualan = $pen->get()->count();
            $uang_tunai = $pen->get()->sum('uang_tunai');
            $uang_nontunai = $pen->get()->sum('uang_nontunai');
            $tagihan_utang = $pen->get()->sum('tagihan_utang');
            $omset = $pen->get()->sum('omset');
            $untung = $pen->get()->sum('untung');

            return Resfor::success([
                'kasir' => $kasirReport->kasir,
                'buka_olehs' => $kasirReport->buka_olehs,
                'kas_awal' => doubleval($kasirReport->kas_awal),
                'uang_masuk' => doubleval($uang_masuk),
                'uang_keluar' => doubleval($uang_keluar),
                'kas_akhir' => doubleval($kas_akhir),
                'jumlah_penjualan' => intval($jumlah_penjualan),
                'uang_tunai' => doubleval($uang_tunai),
                'uang_nontunai' => doubleval($uang_nontunai),
                'omset' => doubleval($omset),
                'untung' => doubleval($untung),
                'tagihan_utang' => doubleval($tagihan_utang),
            ], 'success');
        } else {
            return Resfor::error(null, 'error');
        }
        // $data =
        // return Resfor::success($data, 'success');
    }

    public function tutup_kas_kasir(Request $req)
    {
        $kasir_id = $req->kasir_id;
        $kas_ditarik = $req->kas_ditarik;
        $kas_tutup = $req->kas_tutup;

        $kas = Kasir::find($kasir_id)->kas;

        $report = KasirReport::where('kasir_id', $kasir_id)->where('status', 'open')->first();

        $masuk = KasTJenis::where('nama', 'masuk')->first()->id;
        $kasTrxMasuk = KasTransaksi::where('kas_id', $kas->id)->whereBetween('created_at', [$report->created_at, now()]);
        $total_uang_masuk = $kasTrxMasuk->where('kas_t_jenis_id', $masuk)->get()->sum('nominal');

        $keluar = KasTJenis::where('nama', 'keluar')->first()->id;
        $kasTrxKeluar = KasTransaksi::where('kas_id', $kas->id)->whereBetween('created_at', [$report->created_at, now()]);
        $total_uang_keluar = $kasTrxKeluar->where('kas_t_jenis_id', $keluar)->get()->sum('nominal');

        $kas_akhir = $kas->saldo;

        $selisih = ($kas_tutup != null ? $kas_tutup : 0) - $kas_akhir;

        $sisa_dikasir = $kas_ditarik != null ? ($kas_tutup != null ? $kas_tutup : 0) - ($kas_ditarik != null ? $kas_ditarik : 0) : 0;

        $pen = Penjualan::where('kasir_id', $kasir_id)->whereBetween('created_at', [$report->created_at, now()]);
        $jumlah_penjualan = $pen->get()->count();

        $uang_tunai = $pen->get()->sum('uang_tunai');
        $uang_nontunai = $pen->get()->sum('uang_nontunai');
        $tagihan_utang = $pen->get()->sum('tagihan_utang');
        $omset = $pen->get()->sum('omset');
        $untung = $pen->get()->sum('untung');

        $d = KasirReport::find($report->id);
        if ($kas_ditarik > $kas_tutup) {
            return Resfor::error('jumlah kas ditarik tidak boleh melebihi jumlah tutup kas', 'error');
        } elseif ($kas_ditarik <= $kas_ditarik) {
            $d->update([
                'total_uang_masuk' => $total_uang_masuk,
                'total_uang_keluar' => $total_uang_keluar,
                'kas_akhir' => $kas_akhir,
                'kas_tutup' => $kas_tutup,
                'selisih' => $selisih,
                'kas_ditarik' => $kas_ditarik,
                'sisa_dikasir' => $sisa_dikasir,
                'jumlah_transaksi' => $jumlah_penjualan,
                'uang_tunai' => $uang_tunai,
                'uang_nontunai' => $uang_nontunai,
                'tagihan_utang' => $tagihan_utang,
                'omset' => $omset,
                'untung' => $untung,
                'tutup_oleh' => auth('api')->user()->id,
                'tutup_at' => now(),
                'status' => 'pending',
            ]);
            Kasir::find($kasir_id)->update([
                'status' => 'pending',
            ]);

            // update kas setelah terima uang dikas besar
            // $kasir = Kasir::find($this->kasirID);
            // $kasKasir = Kas::find($kasir->kas_id);
            // $kasKasir->update([
            // ]);

            // $this->emit('cetakStrukTutup', ['url' => url('penjualan/struk/kasir/tutup/' . $report->id), 'title' => 'struk laporan tutup kas']);
            // get kasir report terbaru
            $newReport = KasirReport::find($report->id);
            return Resfor::success($newReport, 'success');
        }
    }

    public function get_report(Request $req)
    {
        $kasirReport = KasirReport::with('kasir', 'buka_olehs', 'tutup_olehs')->find($req->report_id);
        if ($kasirReport) {
            return Resfor::success(new TutupKasBerhasilResource($kasirReport), 'success');
        } else {
            return Resfor::error(null, 'error');
        }
    }

    public function get_terima_kas_kasir(Request $req)
    {
        $kasir_id = $req->kasir_id;

        $kasir = Kasir::find($kasir_id);

        $kasirReport = KasirReport::where('kasir_id', $kasir_id)->where('status', 'pending')->first();
        if ($kasirReport) {
            return Resfor::success(new TutupKasBerhasilResource($kasirReport), 'success');
        } else {
            return Resfor::error(null, 'kasir report tidak ditemukan pada kasir ini');
        }
    }

    public function terima_kas_kasir(Request $req)
    {
        $kasir_report_id = $req->kasir_report_id;
        $report = KasirReport::find($kasir_report_id);

        // nanti cek hasil database col diterima/ditarik, sisa dikasir

        if ($report) {
            $kasir_id = $report->kasir_id;
            $diterima = $req->kas_diterima != null ? doubleval($req->kas_diterima) : 0;
            $kas_diterima = $req->kas_diterima != 0 ? $diterima : $report->kas_ditarik;
            $kategori_id = KasTKategori::where('nama', 'tutup kasir')->first()->id;

            $kas = Kas::find($report->kasir->kas_id);
            $kasTujuan = Kas::find(1);

            // if ($kas_diterima > $report->kas_tutup) {
            //     return Resfor::error('Jumlah tarik tidak boleh melebihi jumlah tutup kas', 'error');
            // } elseif ($kas_diterima <= $report->kas_tutup) {
            // jika ada perubahan kas ditarik ketika terima

            $revisi_sisa_dikasir = $report->kas_tutup - $kas_diterima;

            $asal_saldo = $kas->saldo - ($report->kas_tutup - $kas_diterima);
            // dd($asal_saldo);
            $asal_saldo_selisih = $kas->saldo_selisih + $report->selisih;
            // ASAL
            $jenisKeluar = KasTJenis::where('nama', 'keluar')->first();
            $asal = KasTransaksi::create([
                'kas_t_jenis_id' => $jenisKeluar->id,
                'kas_t_kategori_id' => $kategori_id,
                'kas_id' => $report->kasir->kas_id,
                'nominal' => $kas_diterima,
                'keterangan' => 'asal kas tutup',
                'user_id' => auth('api')->user()->id,
            ]);

            $kas->update([
                'saldo' => $kas->saldo - $asal_saldo,
                'saldo_selisih' => $asal_saldo_selisih,
            ]);

            $jenisMasuk = KasTJenis::where('nama', 'masuk')->first();
            // Tujuan /masuk

            // LANJUT DISINI
            $trx = KasTransaksi::create([
                'kas_t_jenis_id' => $jenisMasuk->id,
                'kas_t_kategori_id' => $kategori_id,
                'kas_id' => $kasTujuan->id,
                'nominal' => $kas_diterima,
                'keterangan' => 'dari kas tutup',
                'user_id' => auth('api')->user()->id,
                'asal_id' => $asal->id,
            ]);

            $kasTujuan->update([
                'saldo' => $kasTujuan->saldo + $kas_diterima,
            ]);

            $report->update([
                'kas_ditarik' => $kas_diterima,
                'sisa_dikasir' => $revisi_sisa_dikasir,
                'status' => 'close',
            ]);

            Kasir::find($kasir_id)->update([
                'status' => 'close',
            ]);
            $reportNew = KasirReport::find($kasir_report_id);
            return Resfor::success($reportNew, 'Berhasil terima uang dari tutup kasir');
            // }
        } else {
            return Resfor::error('Tidak memiliki id kasir report', 'error');
        }

    }

    public function produk(Request $request)
    {
        $produk = ProdukItem::with('produk', 'satuan')->latest();
        $totalData = $produk->get()->count();

        if ($request->barcode) {
            $barcodeProduk = ProdukItem::with('produk', 'satuan')
                ->Where('barcode1', $request->barcode)
                ->orWhere('barcode2', $request->barcode)
                ->orWhere('barcode3', $request->barcode)
                ->orWhere('barcode4', $request->barcode)
                ->orWhere('barcode5', $request->barcode)
                ->orWhere('barcode6', $request->barcode);

            $dataBarcode = $barcodeProduk->get();

            if ($dataBarcode->count() > 1) {
                // cari konversi terendah
                $konversi_terendah = $dataBarcode->min('konversi');
                $dataTerendah = $barcodeProduk->where('konversi', $konversi_terendah)->first();
                // dd($dataTerendah);
                // add data tambah barang dengan koonversi terendah
                $id = $dataTerendah->id;
                // tampilkan data produk dari produk_id nya produk item barcode
                // produk_id yang telah dikonversi
                $produk_id_kon = $dataTerendah->produk_id;

                $data = ProdukItem::with('produk', 'satuan')->where('produk_id', $produk_id_kon)->get();
                return Resfor::success([
                    'totalData' => $totalData,
                    'data' => ProdukItemResouce::collection($data),
                ], 'success');
            } elseif ($dataBarcode->count() == 1) {
                // cek diskon
                $dataFind = $barcodeProduk->with('produk', 'satuan')->first();
                $id = $dataFind->id;

                // ADd to cart
                // $this->addCardItem($id);

                $produk_id_kon = $dataFind->produk_id;
                $data = ProdukItem::with('produk', 'satuan')->where('produk_id', $produk_id_kon)->get();
                return Resfor::success([
                    'totalData' => $totalData,
                    'data' => ProdukItemResouce::collection($data),
                    'dataFind' => new ProdukItemResouce($dataFind),
                ], 'success');
            } else if ($dataBarcode == null) {

                $data = $produk->take($request->take)->get();
                return Resfor::success([
                    'totalData' => $totalData,
                    'data' => ProdukItemResouce::collection($data),
                ], 'success');
            }
        }

        if ($request->nama) {
            $produk->whereRelation('produk', 'nama', 'like', '%' . $request->nama . '%');
        }

        if ($request->take) {
            $take = $request->take;
        } else {
            $take = 20;
        }
        $produk->take($take);
        $data = $produk->get();

        return Resfor::success([
            'totalData' => $totalData,
            'data' => ProdukItemResouce::collection($data),
        ], 'success');
    }
// Pelanggan
    public function pelanggan()
    {
        # code...
    }
    // Buat pelanggan
    public function buatPelanggan()
    {
        # code...
    }

    public function bill(Request $req)
    {
        $data = Bill::with('user', 'bill_item', 'pelanggan');
        if ($req->id) {
            $cek = $data->find($req->id);
            if ($cek) {
                return Resfor::success(new BillResource($cek), 'success');
            }else{
                return Resfor::error(null, 'tidak ditemukan');
            }
        }
        if ($req->no_bill) {
            $cek = $data->where('no_bill', $req->no_bill)->first;

            if ($cek) {
                return Resfor::success(new BillResource($cek), 'success');
            }else{
                return Resfor::error(null, 'tidak ditemukan');
            }
        }
        $datas = $data->get();
        return Resfor::success(BillResource::collection($datas), 'success');
    }

    public function simpanBill(Request $req)
    {
        $no_bill = date('H') . date('i') . date('s') . rand(0001, 9999);
        $cek = Bill::where('no_bill', $no_bill)->first();
        if ($cek != null) {
            $no_bill = date('H') . date('i') . date('s') . rand(0001, 9999);
        }

        // return Resfor::success($req->cartItem,'success');

        $bill = Bill::create([
            'no_bill' => $no_bill,
            'pelanggan_nama' => $req->pelanggan_nama,
            'total_harga_pokok' => $req->total_harga_pokok,
            'total_harga_jual' => $req->total_harga_jual,
            'potongan_diskon' => $req->potongan_diskon,
            'total_harga' => $req->total_harga,
            'total_pembayaran' => $req->total_pembayaran,
            'user_id' => auth('api')->user()->id,
        ]);

        $cartItem = $req->cartItem;

        foreach (json_decode($cartItem) as $data) {
            BillItem::create([
                'waktuCreate' => $data->created_at,
                'bill_id' => $bill->id,
                'produk_id' => $data->produk_id,
                'produk_nama' => $data->produk_nama != null ? $data->produk_nama : null,
                'merek_id' => $data->merek_id,
                'catalog_id' => $data->catalog_id,
                'kategori_id' => $data->kategori_id,
                'rak_id' => $data->rak_id,
                'produk_item_id' => $data->produk_item_id,
                'satuan_id' => $data->satuan_id,
                'satuan' => $data->satuan,
                'harga_modal' => $data->harga_modal,
                'harga_jual' => $data->harga_jual,
                'qty' => $data->qty,
                'total_harga_modal' => $data->total_harga_modal,
                'total_harga_jual' => $data->total_harga_jual,
                'diskon_persen' => $data->diskon_persen,
                'diskon_harga_jual' => $data->diskon_persen,
                'potongan_diskon' => $data->potongan_diskon,
                'total_harga' => $data->total_harga,
                'untung' => $data->untung,
            ]);
        }
        return Resfor::success($bill, 'Berhasil simpan bill');

        // setelah simpan
        // hapus data cartItem
    }


    public function perbaruiBill()
    {
        // setelah perbarui
        // hapus BillItem lama, Buat billItem baru
        // hapus data CartItem diFE
    }

    public function hapusBill(Request $req)
    {
        // hapus manual
        // hapus setelah penjualan
        $bill = Bill::find($req->id);
        $bill->delete();
        return Resfor::success(null, 'success');
    }


    public function simpanPenjualan(Request $req)
    {
        // pelanggan_id
        $pelanggan_id = $req->pelanggan_id != 'null' ? $req->pelanggan_id : null;
        $pelanggan_nama = $req->pelanggan_nama != 'null' ? $req->pelanggan_nama : null;
        $kasir_id = $req->kasir_id;

        $kasir = Kasir::find($kasir_id);
        $kas_id = $kasir->kas_id;
        $isLunas = $req->isLunas == 'true' ? 1 : 0;
        $isTunai = $req->isTunai;

        $total_harga_pokok = doubleval($req->total_harga_pokok);
        $total_harga_jual = doubleval($req->total_harga_jual);
        $potongan_diskon = doubleval($req->potongan_diskon);
        $tagihan_utang = doubleval($req->tagihan_utang);
        $total_harga = doubleval($req->total_harga);
        $ongkir = doubleval($req->ongkir);
        $pajak = 0;
        $total_pembayaran = doubleval($req->total_pembayaran);
        $diterima = doubleval($req->diterima);
        $kembali = doubleval($req->kembali);
        $pendapatan = doubleval($total_pembayaran);
        $uang_tunai = $isTunai == 'true' ? doubleval($total_pembayaran) : 0;
        $uang_nontunai = $isTunai != 'true' ? doubleval($total_pembayaran) : 0;
        $omset = $total_harga + $ongkir;
        $untung = doubleval($req->untung);

        $dataCartItem = $req->cartItem;

        // cek foreach
        // $namaP = '';
        // foreach (json_decode($dataCartItem) as $value) {
        //    $namaP =  $value->produk_nama;
        // }
        // return Resfor::success(json_decode($dataCartItem), 'ok');

        // jika berhasil, percobaan hapus itemCart
        // return Resfor::success([
        //     'pelanggan_id'=> $pelanggan_id,
        //     'pelanggan_nama'=> $pelanggan_nama,
        //     'kasir_id' => $kasir_id,
        //     'kas_id' => $kas_id,
        //     'isLunas' => $isLunas,
        //     'total_harga_pokok' => $total_harga_pokok,
        //     'total_harga_jual' => $total_harga_jual,
        //     'potongan_diskon' => $potongan_diskon,
        //     'tagihan_utang' => $tagihan_utang,
        //     'total_harga' => $total_harga,
        //     'ongkir' => $ongkir,
        //     'pajak' => $pajak,
        //     'total_pembayaran' => $total_pembayaran,
        //     'diterima' => $diterima,
        //     'kembali' => $kembali,
        //     'pendapatan' => $pendapatan,
        //     'uang_tunai' => $uang_tunai,
        //     'uang_nontunai' => $uang_nontunai,
        //     'omset' => $omset,
        //     'untung' => $untung,
        //     'dataItem' => $dataCartItem
        // ], 'success');


        $no_penjualan = date('Y') . date('m') . date('d') . date('H') . date('i') . date('s') . rand(0001, 9999);
        $cek_no_penjualan = Penjualan::where('no_penjualan', $no_penjualan)->first();
        if ($cek_no_penjualan != null) {
            $no_penjualan = date('Y') . date('m') . date('d') . date('H') . date('i') . date('s') . rand(0001, 9999);
        }
        $waktu = now();
        $kasir = Kasir::find($kasir_id);

        $penjualan = Penjualan::create([
            'user_id' => auth('api')->user()->id,
            'kasir_id' => $kasir_id,
            'no_penjualan' => $no_penjualan,
            'waktu' => $waktu,
            'penjualan_pesanan_id' => null,
            'pelanggan_id' => $pelanggan_id,
            'pelanggan_nama' => $pelanggan_nama,
            'kas_id' => $kas_id,
            'total_harga_pokok' => $total_harga_pokok,
            'total_harga_jual' => $total_harga_jual,
            'potongan_diskon' => $potongan_diskon,
            'total_harga' => $total_harga,
            'tagihan_utang' => $tagihan_utang,
            'ongkir' => $ongkir,
            'pajak' => $pajak,
            'total_pembayaran' => $total_pembayaran,
            'diterima' => $diterima,
            'kembali' => $kembali,
            'pendapatan' => $pendapatan,
            'uang_tunai' => $uang_tunai,
            'uang_nontunai' => $uang_nontunai,
            'omset' => $omset,
            'untung' => $untung,
            'islunas' => $isLunas,
            'keterangan' => null,
            'status' =>  $isLunas == true ? 'success' : 'pending',
        ]);

        // update kas berdasarkan jumlah pendapatan
        $kaskasir = Kas::find($kas_id);
        $kaskasir->update([
            'saldo' => $kaskasir->saldo + $total_harga + $ongkir + $pajak,
        ]);

        $jenis = KasTJenis::where('nama', 'masuk')->first();
        $kategori = KasTKategori::where('nama', 'penjualan')->first();
        KasTransaksi::create([
            'kas_t_jenis_id' => $jenis->id,
            'kas_t_kategori_id' => $kategori->id,
            'kas_id' => $kas_id,
            'nominal' => $total_harga + $ongkir + $pajak,
            'keterangan' => 'penjualan',
            'user_id' => auth('api')->user()->id,
        ]);

        // penjualan Item

        foreach (json_decode($dataCartItem) as $item) {
            $penjualanItem = PenjualanItem::create([
                'penjualan_id' => $penjualan->id,
                'produk_id' => $item->produk_id,
                'produk_nama' => $item->produk_nama,
                'merek_id' => $item->merek_id,
                'catalog_id' => $item->catalog_id,
                'kategori_id' => $item->kategori_id,
                'rak_id' => $item->rak_id,
                'produk_item_id' => $item->produk_item_id,
                'satuan_id' => $item->satuan_id,
                'harga_modal' => $item->harga_modal,
                'harga_jual' => $item->harga_jual,
                'qty' => $item->qty,
                'total_harga_modal' => $item->total_harga_modal,
                'total_harga_jual' => $item->total_harga_jual,
                'diskon_persen' => $item->diskon_persen,
                'potongan_diskon' => $item->potongan_diskon,
                'total_harga' => $item->total_harga,
                'untung' => $item->untung,
            ]);


            // KELOLA STOK
            // kurangi stok pada produkItem
            $produkitem = ProdukItem::find($item->produk_item_id);
            $produk = Produk::find($produkitem->produk->id);

             // jika Harga jual FE beda dengan Harga jual asli produk, buat history Harga_log
             if ($produkitem->harga_jual != $item->harga_jual) {
                RiwayatHarga::create([
                    'produk_id' => $item->produk_id,
                    'produk_item_id' => $item->produk_item_id,
                    'penjulan_id' => $penjualan->id,
                    'harga_jual_awal' => $produkitem->harga_jual,
                    'harga_jual_akhir' => $item->harga_jual,
                    'status' => 'tidak diperbarui',
                    'ubahdiRak' => false,
                    'user_id' => auth('api')->user()->id
                ]);
             }

            $jenis = StokJenis::where('nama', 'keluar')->first();
            $stok_kategori = StokKategori::where('nama', 'penjualan')->first();

            if ($produk->tipe == 'INV') {
                $min = $produk->produk_item->min('konversi');
                $max = $produk->produk_item->max('konversi');

                // perubahan stok
                foreach ($produk->produk_item as $data) {
                    $dasar = $produk->produk_item->where('konversi', $min)->first();
                    $konversiDasar = $data->find($item->produk_item_id);
                    $hasil = $item->qty * $konversiDasar->konversi;

                    if ($data->id == $item->produk_item_id) {

                        $st = StokTransaksi::create([
                            'produk_id' => $produkitem->produk->id,
                            'produk_item_id' => $data->id,
                            'stok_jenis_id' => $jenis->id,
                            'stok_kategori_id' => $stok_kategori->id,
                            'jumlah' => $hasil,
                            'catatan' => null,
                            'user_id' => auth('api')->user()->id,
                        ]);
                    }

                    if ($data->id == $dasar->id) {
                        $data->update([
                            'stok_jual' => $data->stok_jual - $hasil,
                            'stok_buku' => $data->stok_buku - $hasil,
                        ]);
                    } else {
                        $data->update([
                            'stok_jual' => $dasar->stok_jual / $data->konversi,
                            'stok_buku' => $dasar->stok_buku / $data->konversi,
                        ]);
                    }
                }
            } elseif ($produk->tipe == 'rakitan') {
                $produkitem->update([
                    'stok_jual' => $produkitem->stok_jual - $item->qty,
                    'stok_buku' => $produkitem->stok_buku - $item->qty,
                ]);
                $jenis = StokJenis::where('nama', 'keluar')->first();
                $st = StokTransaksi::create([
                    'produk_id' => $produkitem->produk->id,
                    'produk_item_id' => $produkitem->id,
                    'stok_jenis_id' => $jenis->id,
                    'stok_kategori_id' => $stok_kategori->id,
                    'jumlah' => $item->qty,
                    'catatan' => null,
                    'user_id' => auth('api')->user()->id,
                ]);
            }
        }

        return Resfor::success(Penjualan::with('penjualan_item', 'kasir', 'user', 'pelanggan')->find($penjualan->id), 'success');
        // setelah berhasil, delete bill di FE
    }

    public function riwayatPenjualan(Request $req)
    {
       $data = Penjualan::latest()->take($req->take == null ? 10 : $req->take)->get();
       return Resfor::success(new PenjualanResource($data), 'success');
    }

    public function detailPenjualan(Request $request)
    {
        $id = $request->penjualanid;
        $data = Penjualan::with('penjualan_item', 'kasir', 'user', 'pelanggan')->find($id);

        return Resfor::success(new PenjualanResource($data), 'success');
    }

    // ====================================================

    public function cart(Request $req)
    {
        $item = CardItem::with('produk', 'satuan')->where('user_id', auth('api')->user()->id)->latest()->get();
        // return Resfor::success($item, 'ok');
        if ($item) {
            return Resfor::success(CardItemResource::collection($item), 'success');
        } else {
            return Resfor::error(null, 'error');
        }

    }

    public function addCart(Request $req)
    {

        // $item = ProdukItem::find($req->id);
        $this->addCardItem($req->id);

        return Resfor::success(null, 'success');
    }

    public function addCardItem($id)
    {
        $user_id = auth('api')->user()->id;
        $data = ProdukItem::find($id);

        if ($data->diskon_start <= date('Y-m-d') && $data->diskon_end >= date('Y-m-d')) {
            if ($data->jam_start != null && $data->jam_end != null) {
                if ($data->jam_start <= date('H:i:s') && $data->jam_end >= date('H:i:s')) {
                    $harga_jual = $data->diskon_harga_jual;
                    $persenDiskon = $data->diskon_persen;
                } else {
                    $harga_jual = $data->harga_jual;
                    $persenDiskon = 0;
                }
            } else {
                $harga_jual = $data->diskon_harga_jual;
                $persenDiskon = $data->diskon_persen;
            }
        } else {
            $harga_jual = $data->harga_jual;
            $persenDiskon = 0;
        }

        $cartitem = CardItem::where('produk_item_id', $data->id)->first();
        if ($cartitem) {
            $qty = $cartitem->qty + 1;
            $total_harga_modal = $data->harga_pokok * $qty;
            $total_harga_jual = $harga_jual * $qty;
            $total_potongan_diskon = ($harga_jual * ($persenDiskon / 100)) * $qty;
            $total_harga = $total_harga_jual - $total_potongan_diskon;
            $untung = $total_harga - $total_harga_modal;

            $cartitem->update([
                // 'user_id' => auth()->user()->id,
                'produk_id' => $data->produk->id,
                'merek_id' => $data->produk->merek_id,
                'catalog_id' => $data->produk->catalog_id,
                'kategori_id' => $data->produk->kategori_id,
                'rak_id' => $data->produk->rak_id,
                'produk_item_id' => $data->id,
                'satuan_id' => $data->satuan_id,
                'harga_modal' => $data->harga_pokok,
                'harga_jual' => $harga_jual,
                'diskon_persen' => $persenDiskon,
                'qty' => $qty,
                'total_harga_modal' => $total_harga_modal,
                'total_harga_jual' => $total_harga_jual,
                'potongan_diskon' => $total_potongan_diskon,
                'total_harga' => $total_harga,
                'untung' => $untung,
            ]);
        } else {
            $potongan_diskon = $harga_jual * ($persenDiskon / 100);
            $total_harga = $harga_jual - $potongan_diskon;
            $untung = $total_harga - $data->harga_pokok;

            CardItem::create([
                'user_id' => auth('api')->user()->id,
                'produk_id' => $data->produk->id,
                'merek_id' => $data->produk->merek_id,
                'catalog_id' => $data->produk->catalog_id,
                'kategori_id' => $data->produk->kategori_id,
                'rak_id' => $data->produk->rak_id,
                'produk_item_id' => $data->id,
                'satuan_id' => $data->satuan_id,
                'harga_modal' => $data->harga_pokok,
                'harga_jual' => $harga_jual,
                'diskon_persen' => $persenDiskon,
                'qty' => 1,
                'total_harga_modal' => $data->harga_pokok,
                'total_harga_jual' => $harga_jual,
                'potongan_diskon' => $potongan_diskon,
                'total_harga' => $total_harga,
                'untung' => $untung,
            ]);
        }

    }
}
