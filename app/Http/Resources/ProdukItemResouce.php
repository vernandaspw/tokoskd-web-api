<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProdukItemResouce extends JsonResource
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
            "produk_id" => $this->produk_id,
            "img" => $this->img,
            "barcode1" => $this->barcode1,
            "barcode2" => $this->barcode2,
            "barcode3" => $this->barcode3,
            "barcode4" => $this->barcode4,
            "barcode5" => $this->barcode5,
            "barcode6" => $this->barcode6,
            "satuan_id" => $this->satuan_id,
            "konversi" => $this->konversi,
            "harga_beli" => $this->harga_beli,
            "harga_pokok" => $this->harga_pokok,
            // "harga_jual" => number_format($this->harga_jual,0,',','.'),
            "harga_jual" => $this->harga_jual,
            "stok_minimum" => $this->stok_minimum,
            "stok_beli" => $this->stok_beli,
            "stok_terjual" => $this->stok_terjual,
            "stok_jual" => $this->stok_jual,
            "stok_buku" => $this->stok_buku,
            "opname_at" => $this->opname_at,
            "diskon_harga_jual" => $this->diskon_harga_jual,
            "diskon_persen" => $this->diskon_persen,
            "diskon_start" => $this->diskon_start,
            "diskon_end" => $this->diskon_end,
            "jam_start" => $this->jam_start,
            "jam_end" => $this->jam_end,
            "isaktif" => $this->isaktif,
            // "created_at" => $this->created_at->isoFormat('DD-MM-Y, H:m'),
            // "updated_at" => $this->updated_at->isoFormat('DD-MM-Y, H:m'),
            "produk" => new ProdukResouce($this->produk),
            "satuan" => new SatuanResource($this->satuan),
        ];
        // return parent::toArray($request);
    }
}
