<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProdukResouce extends JsonResource
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
          "nama"=> $this->nama,
          "img"=> $this->img,
          "tipe" => $this->tipe,
          "merek_id"=> $this->merek_id,
          "catalog_id"=> $this->catalog_id,
          "kategori_id"=> $this->kategori_id,
          "rak_id" => $this->rak_id,
          "isaktif" => $this->isaktif,
          "keterangan"=> $this->keterangan,
          "supplier_id"=> $this->supplier_id,
        ];
    }
}
