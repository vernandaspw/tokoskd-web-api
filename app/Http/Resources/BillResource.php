<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BillResource extends JsonResource
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
            "id" => $this->id,
            "no_bill" => $this->no_bill,
            "pelanggan_id" => $this->pelanggan_id,
            "pelanggan_nama" => $this->pelanggan_nama,
            "total_harga_pokok" => $this->total_harga_pokok,
            "total_harga_jual" => $this->total_harga_jual,
            "potongan_diskon" => $this->potongan_diskon,
            "total_harga" => $this->total_harga,
            "tagihan_utang" => $this->tagihan_utang,
            "ongkir" => $this->ongkir,
            "pajak" => $this->pajak,
            "potongan_utang_toko" => $this->potongan_utang_toko,
            "total_pembayaran" => $this->total_pembayaran,
            "user_id" => $this->user_id,
            "created_at" => $this->created_at->isoFormat('D MMMM Y, HH:mm'),
            "updated_at" => $this->updated_at,
            "created_at_human" => $this->created_at->diffForHumans(),
            'user' => $this->user,
            'pelanggan' => $this->pelanggan,
            'bill_item' => $this->bill_item,
        ];
    }
}
