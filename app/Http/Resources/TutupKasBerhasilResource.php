<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TutupKasBerhasilResource extends JsonResource
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
                "kasir_id" => $this->kasir_id,
                "kas_awal" => doubleval($this->kas_awal),
                "total_uang_masuk" => doubleval($this->total_uang_masuk),
                "total_uang_keluar" => doubleval($this->total_uang_keluar),
                "kas_akhir" => doubleval($this->kas_akhir),
                "kas_tutup" => doubleval($this->kas_tutup),
                "selisih" => doubleval($this->selisih),
                "kas_ditarik" => doubleval($this->kas_ditarik),
                "sisa_dikasir" => doubleval($this->sisa_dikasir),
                "jumlah_transaksi" => doubleval($this->jumlah_transaksi),
                "uang_tunai" => doubleval($this->uang_tunai),
                "uang_nontunai" => doubleval($this->uang_nontunai),
                "tagihan_utang" => doubleval($this->tagihan_utang),
                "omset" => doubleval($this->omset),
                "untung" => doubleval($this->untung),
                "buka_oleh" => $this->buka_oleh,
                "tutup_oleh" => $this->tutup_oleh,
                'jam_buka' => $this->created_at->isoFormat('Y-MM-DD HH:mm:ss'),
                "jam_tutup" => $this->tutup_at,
                "status" => $this->status,
                "kasir" => $this->kasir,
                "buka_olehs" => $this->buka_olehs,
                "tutup_olehs" => $this->tutup_olehs,

        ];
    }
}
