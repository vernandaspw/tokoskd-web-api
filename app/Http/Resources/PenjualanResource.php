<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PenjualanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id"=> $this->id,
            "no_penjualan"=> $this->no_penjualan,
            "waktu"=> $this->waktu,
            "penjualan_pesanan_id"=> $this->penjualan_pesanan_id,
            "pelanggan_id"=> $this->pelanggan_id,
            "pelanggan_nama"=> $this->pelanggan_nama,
            "kas_id"=> $this->kas_id,
            "total_harga_pokok"=> $this->total_harga_pokok,
            "total_harga_jual"=> $this->total_harga_jual,
            "potongan_diskon"=> $this->potongan_diskon,
            "total_harga"=> $this->total_harga,
            "tagihan_utang"=> $this->tagihan_utang,
            "ongkir"=> $this->ongkir,
            "pajak"=> $this->pajak,
            "potongan_utang_toko"=> $this->potongan_utang_toko,
            "total_pembayaran"=> $this->total_pembayaran,
            "diterima"=> $this->diterima,
            "kembali"=> $this->kembali,
            "kembali_kurang"=> $this->kembali_kurang,
            "uang_muka"=> $this->uang_muka,
            "sisa_belum_bayar"=> $this->sisa_belum_bayar,
            "pendapatan"=> $this->pendapatan,
            "uang_tunai"=> $this->uang_tunai,
            "uang_nontunai"=> $this->uang_nontunai,
            "omset"=> $this->omset,
            "untung"=> $this->untung,
            "islunas"=> $this->islunas,
            "keterangan"=> $this->keterangan,
            "status"=> $this->status,
            "user_id"=> $this->user_id,
            "kasir_id"=> $this->kasir_id,
            "sales_id"=> $this->sales_id,
            "created_at"=> $this->created_at,
            "updated_at"=> $this->updated_at,
            'penjualan_item' => PenjualanItemResource::collection($this->penjualan_item),
            'kasir' => $this->kasir,
            'user' => $this->user,
            'pelanggan' => $this->pelanggan
        ];
    }
}
