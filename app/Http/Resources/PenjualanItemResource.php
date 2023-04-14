<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PenjualanItemResource extends JsonResource
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
        "penjualan_id"=> $this->penjualan_id,
        "produk_id"=> $this->produk_id,
        "produk_nama"=> $this->produk_nama,
        "merek_id"=> $this->merek_id,
        "catalog_id"=> $this->catalog_id,
        "kategori_id"=> $this->kategori_id,
        "rak_id"=> $this->rak_id,
        "produk_item_id"=> $this->produk_item_id,
        "satuan_id"=> $this->satuan_id,
        "harga_modal"=> doubleval($this->harga_modal),
        "harga_jual"=> doubleval($this->harga_jual),
        "qty"=> intval($this->qty),
        "total_harga_modal"=> doubleval($this->total_harga_modal),
        "total_harga_jual"=> doubleval($this->total_harga_jual),
        "diskon_persen"=> doubleval($this->diskon_persen),
        "potongan_diskon"=> doubleval($this->potongan_diskon),
        "total_harga"=> doubleval($this->total_harga),
        "untung"=> doubleval($this->untung),
        "created_at"=> $this->created_at,
        "updated_at"=> $this->updated_at,
        'produk' => $this->produk,
        'satuan' => $this->satuan
        ];
    }
}
