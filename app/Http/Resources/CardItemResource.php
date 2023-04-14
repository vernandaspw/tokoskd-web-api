<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CardItemResource extends JsonResource
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
            'kasir_id' => $this->kasir_id,
            'user_id' => $this->user_id,
            'produk_id' => $this->produk_id,
            'produk_nama' => $this->produk_nama,
            'merek_id' => $this->merek_id,
            'catalog_id' => $this->catalog_id,
            'kategori_id' => $this->kategori_id,
            'rak_id' => $this->rak_id,
            'produk_item_id' => $this->produk_item_id,
            'satuan_id' => $this->satuan_id,
            'harga_modal' => $this->harga_modal,
            'harga_jual' => $this->harga_jual,
            'qty' => $this->qty,
            'total_harga_modal' => $this->total_harga_modal,
            'total_harga_jual' => $this->total_harga_jual,
            'diskon_persen' => $this->diskon_persen,
            'potongan_diskon' => $this->potongan_diskon,
            'total_harga' => $this->total_harga,
            'untung' => $this->untung,
            "produk" => new ProdukResouce($this->produk),
            "satuan" => new SatuanResource($this->satuan),
        ];
        // return [
        //     "id" => $this->id,
        //     'kasir_id' => $this->kasir_id,
        //     'user_id' => $this->user_id,
        //     'produk_id' => $this->produk_id,
        //     'produk_nama' => $this->produk_nama,
        //     'merek_id' => $this->merek_id,
        //     'catalog_id' => $this->catalog_id,
        //     'kategori_id' => $this->kategori_id,
        //     'rak_id' => $this->rak_id,
        //     'produk_item_id' => $this->produk_item_id,
        //     'satuan_id' => $this->satuan_id,
        //     'harga_modal' => $this->harga_modal,
        //     'harga_jual' => number_format($this->harga_jual,0,',','.'),
        //     'qty' => number_format($this->qty,0,',','.'),
        //     'total_harga_modal' => $this->total_harga_modal,
        //     'total_harga_jual' => number_format($this->total_harga_jual,0,',','.'),
        //     'diskon_persen' => $this->diskon_persen,
        //     'potongan_diskon' => $this->potongan_diskon,
        //     'total_harga' => number_format($this->total_harga,0,',','.'),
        //     'untung' => number_format($this->untung,0,',','.'),
        //     "produk" => new ProdukResouce($this->produk),
        //     "satuan" => new SatuanResource($this->satuan),
        // ];
    }
}
