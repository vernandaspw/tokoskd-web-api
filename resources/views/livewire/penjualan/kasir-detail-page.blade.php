<div>

    <!-- Modal-->
    <div class="modal fade show" data-backdrop='true' id="ubahharga" tabindex="-1" aria-labelledby="ubahhargaabel" aria-hidden="true" @if($ubahharga_show) style="display: block;" @endif>
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahhargaabel">Ubah harga produk</h5>
                    <button wire:click="ubahharga_close()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="">
                        <div class="">
                            <label for="" class="m-0">
                                Produk
                            </label>
                            <div class="">
                                {{ $ubahHarga_produkNama }}
                            </div>
                            <div class="">
                                <div class="">
                                    Harga pokok: @uang($ubahHarga_harga_pokok)
                                </div>
                            </div>
                        </div>
                        <hr>
                        <form wire:submit.prevent='simpanUbahHarga'>
                            <div class="">
                                <label class="m-0" for="">Ubah harga jual dasar</label>
                                <div class="input-group ">
                                    <div class="input-group-append">
                                        <span class="input-group-text form-control-sm" id="basic-addon2">@uang($ubahHargaJualDasar != null ? $ubahHargaJualDasar : null)</span>
                                    </div>
                                    <input wire:model='ubahHargaJualDasar' min="0" type="number" class="form-control form-control-sm">

                                </div>
                            </div>
                            <div class="mt-1">
                                <div class="@if($ubahHargaJualDasar != null ? $ubahHargaJualDasar > $ubahHarga_harga_pokok : 0 > $ubahHarga_harga_pokok)
                                text-success
                                @else
                                text-danger
                            @endif">
                                    untung : @uang($ubahHargaJualDasar != null ? $ubahHargaJualDasar - $ubahHarga_harga_pokok : $ubahHarga_harga_pokok)
                                </div>
                            </div>

                           @if($ubahHargaDiskonJual)
                           <div class="mt-1">
                            <label class="m-0" for="">Ubah harga diskon</label>
                            <div class="input-group ">
                                <div class="input-group-append">
                                    <span class="input-group-text form-control-sm" id="basic-addon2">@uang($ubahHargaDiskonJual != null ? $ubahHargaDiskonJual : null)</span>
                                </div>
                                <input wire:model='ubahHargaDiskonJual' type="number" class="form-control form-control-sm">
                            </div>
                        </div>

                        <div class="mt-1">
                            <div class="">
                                Diskon : {{ $ubahPersenDiskon }}%
                            </div>
                            <div class="mt-1">
                                Harga jual setelah diskon : @uang($ubahHargaDiskonJual - ($ubahHargaDiskonJual * ($ubahPersenDiskon/100)))
                            </div>
                        </div>
                        <div class="mt-1">
                            <div class="@if($ubahHargaDiskonJual - ($ubahHargaDiskonJual * ($ubahPersenDiskon/100)) > $ubahHarga_harga_pokok)
                            text-success
                            @else
                            text-danger
                        @endif">
                                untung setelah diskon : @uang(($ubahHargaDiskonJual - ($ubahHargaDiskonJual * ($ubahPersenDiskon/100))) - $ubahHarga_harga_pokok)
                            </div>
                        </div>
                           @endif
                            @if($ubahHargaJualDasar > $ubahHarga_harga_pokok)
                                @if($ubahHargaDiskonJual)
                                @if (($ubahHargaDiskonJual - ($ubahHargaDiskonJual * ($ubahPersenDiskon/100))) > $ubahHarga_harga_pokok)
                                <button type="submit" class="btn mt-2 btn-success form-control">Simpan</button>
                                @else
                                <div class="mt-2 bg-danger text-center form-control">Merugi</div>
                                @endif
                                @else
                                <button type="submit" class="btn mt-2 btn-success form-control">Simpan</button>
                                @endif
                            @else
                            <div class="mt-2 bg-danger text-center form-control">Merugi</div>
                            @endif



                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button wire:click="ubahharga_close()" type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="content-wrapper">



        <div class="d-flex ">
            <div class="col-md-6" style="padding-bottom: 50px;">
                <div class="d-flex justify-content-center">
                    <a href="#" wire:click.prefetch="menuProduk()" class="w-100 border text-center py-3 text-white
                    @if($menuManual == false && $menuBuatBaru == false)
                    bg-primary
                    @endif
                    " style="background-color: #343A40">
                        Produk
                    </a>

                    <a href="#" wire:click.prefetch="menuBuatBaru()" class="w-100 border text-center py-3 text-white
                    @if($menuBuatBaru)
                    bg-primary
                    @endif
                    " style="background-color: #343A40">
                        Buat baru
                    </a>
                    {{-- <a href="#" wire:click="menuManual()" class="w-100 border text-center py-3 text-white
                    @if($menuManual)
                    bg-primary
                    @endif
                    " style="background-color: #343A40">
                        Manual
                    </a> --}}
                </div>


                @if($menuManual)

                @elseif($menuBuatBaru)
                <div class="manual">
                    <div class="mt-2">
                        <div class="mb-1">
                            Tambah produk baru
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <form wire:submit.prevent='simpanProdukBaru'>
                                    <div class="mb-1">
                                        <label for="nama" class="mb-0 mt-1">Nama produk</label>
                                        <input autofocus maxlength="60" required wire:model='produkbaru_nama' type="text" class="form-control form-control-sm" placeholder="Nama">
                                    </div>
                                    <div class="mb-1">
                                        <label for="tipe" class="mb-0 mt-1">tipe <span class="text-danger">*wajib</span></label>
                                        <select required wire:model='produkbaru_tipe' id="tipe" class="form-control form-control-sm">
                                            <option value="">Pilih</option>
                                            <option value="INV">inventory</option>
                                            <option value="nonINV">non inventory</option>
                                            <option value="rakitan">rakitan</option>
                                            <option value="jasa">jasa</option>
                                        </select>
                                    </div>
                                    <div class="mt-2">
                                        <label for="" class="m-0">Satuan</label>
                                        <select required id="satuan_id" wire:model='produkbaru_satuan_id' class="form-control form-control-sm">
                                            <option value="">Pilih</option>
                                            @foreach ($satuans as $data)
                                            <option value="{{ $data->id }}">{{ $data->satuan }}</option>
                                            @endforeach
                                        </select>
                                        <div class="text-muted" style="font-size: 13px">
                                            - item ini adalah item satuan paling dasar
                                            <div>- tambah tambah item baru dimenu produk</div>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <label for="" class="m-0">Konversi satuan</label>
                                        <input required wire:model='produkbaru_konversi' min="1" type="number" required class="form-control form-control-sm" placeholder="konversi satuan..">
                                    </div>
                                    <div class="mt-2">
                                        <label for="" class="m-0">Harga jual : @uang($produkbaru_harga_jual  == null ? 0 : $produkbaru_harga_jual)</label>
                                        <input required wire:model='produkbaru_harga_jual' type="number" required class="form-control form-control-sm" placeholder="harga jual..">
                                    </div>
                                    <div class="">
                                        <label for="" class="m-0">Barcode </label>
                                        <div class="">

                                            <input wire:model='produkbaru_barcode1' type="text" class="form-control form-control-sm" placeholder="barcode 1">
                                        </div>
                                        <div class="">
                                            <input wire:model='produkbaru_barcode2' type="text" class="form-control form-control-sm" placeholder="barcode 2">
                                        </div>
                                        <div class="">
                                            <input wire:model='produkbaru_barcode3' type="text" class="form-control form-control-sm" placeholder="barcode 3">
                                        </div>
                                        <div class="">
                                            <input wire:model='produkbaru_barcode4' type="text" class="form-control form-control-sm" placeholder="barcode 4">
                                        </div>
                                        <div class="">
                                            <input wire:model='produkbaru_barcode5' type="text" class="form-control form-control-sm" placeholder="barcode 5">
                                        </div>
                                        <div class="">
                                            <input wire:model='produkbaru_barcode6' type="text" class="form-control form-control-sm" placeholder="barcode 6">
                                        </div>
                                    </div>


                                    <button type="submit" wire:loading.remove wire:target='simpanProdukBaru' type="button" class="btn mb-1 mt-1 btn-success rounded-pill form-control">Simpan & add cart</button>

                                    <button type="button" wire:click="resetProdukBaru"  class="btn btn-secondary mb-3 rounded-pill form-control">Reset</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="produk">
                    <div class="mt-2">
                        @if($new_item_produk_id)
                        @else
                        <div class="head">
                            <div class="container">
                                <div class="row row-cols-5 text-center">

                                    <div class="col">
                                        <select wire:model='selectCatalog' class="form-control form-control-sm w-100" id="">
                                            <option value="">Pilih Catalog</option>
                                            @foreach ($catalogs as $data)
                                            <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col">
                                        <select wire:model='selectKategori' class="form-control form-control-sm w-100" id="">
                                            <option value="">Pilih Kategori</option>
                                            @foreach ($kategoris as $data)
                                            <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col">
                                        <select wire:model='selectRak' class="form-control form-control-sm w-100" id="">
                                            <option value="">Pilih Rak</option>
                                            @foreach ($raks as $data)
                                            <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col">
                                        <select wire:model='selectMerek' class="form-control form-control-sm w-100" id="">
                                            <option value="">Pilih Merek</option>
                                            @foreach ($mereks as $data)
                                            <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- <div class="col">
                                        <select class="form-control" id="">
                                            <option value="">Grid</option>
                                            <option value="">List</option>
                                        </select>
                                    </div> --}}
                                </div>
                            </div>

                            <div class="mt-2">
                                <div class="container">
                                    <div class="row text-center d-flex justify-content-lg-evenly">
                                        <div class="col">
                                            <input autofocus wire:model='cariBarcode' type="text" class="form-control" placeholder="Cari Barcode/Nama">
                                        </div>
                                        <div class="col">
                                            <input wire:model='cariProduk' type="text" class="form-control" placeholder="Nama produk">
                                        </div>
                                        <div class="col-2">
                                            <select wire:model='orderBy' class="form-control" id="">
                                                <option value="terbaru">Terbaru</option>
                                                <option value="diskon terbesar">Diskon terbesar</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="mt-2">
                            <div class="container">
                                @if($new_item_produk_id)
                                    <form wire:submit.prevent='saveNewItem'>
                                        <div class="">
                                            <b>
                                                <h5>Tambah Item</h5>
                                            </b>
                                        </div>

                                        <div class="">
                                            <label for="" class="m-0">Produk </label>
                                            <div class="">
                                                <input readonly value="{{ $new_item_produk_nama }}" type="text" class="form-control form-control-sm" placeholder="">
                                            </div>
                                            <div class="mt-1">
                                                <div class="">
                                                    Item saat ini : @foreach ($new_item_produks->produk_item as $item)
                                                    <span class="badge badge-primary" style="font-size: 13px">{{ $dasarKovJml }}{{ $item->satuan->satuan }} = {{ $item->konversi }}{{ $dasarKov }}</span>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="mt-2">
                                                <label for="" class="m-0">Satuan</label>
                                                <select required id="satuan_id" wire:model='new_item_satuan_id' class="form-control form-control-sm">
                                                    <option value="">Pilih</option>
                                                    @foreach ($satuans as $data)
                                                    <option value="{{ $data->id }}">{{ $data->satuan }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mt-2">
                                                <label for="" class="m-0">Konversi (dasar saat ini: {{ $dasarKov }} / {{ $dasarKovJml }} )</label>

                                                <input wire:model='new_item_konversi' type="number" class="form-control form-control-sm" placeholder="jumlah konversi..">
                                            </div>

                                            <div class="mt-2">
                                                <label for="" class="m-0">Harga jual : @uang($new_item_harga_jual == null ? 0 : $new_item_harga_jual)</label>
                                                <input wire:model='new_item_harga_jual' type="number" required class="form-control form-control-sm" placeholder="harga jual..">

                                            </div>
                                            <label for="" class="m-0">Barcode</label>
                                            <div class="">
                                                <input wire:model='new_item_barcode1' type="text" class="form-control form-control-sm" placeholder="barcode 1">
                                            </div>
                                            <div class="">
                                                <input wire:model='new_item_barcode2' type="text" class="form-control form-control-sm" placeholder="barcode 2">
                                            </div>
                                            <div class="">
                                                <input wire:model='new_item_barcode3' type="text" class="form-control form-control-sm" placeholder="barcode 3">
                                            </div>
                                            <div class="">
                                                <input wire:model='new_item_barcode4' type="text" class="form-control form-control-sm" placeholder="barcode 4">
                                            </div>
                                            <div class="">
                                                <input wire:model='new_item_barcode5' type="text" class="form-control form-control-sm" placeholder="barcode 5">
                                            </div>
                                            <div class="">
                                                <input wire:model='new_item_barcode6' type="text" class="form-control form-control-sm" placeholder="barcode 6">
                                            </div>
                                        </div>


                                            <button type="submit"  wire:loading.remove wire:loading.attr='disabled' class="mb-1 mt-2 btn-block btn btn-success mb-2">Simpan</button>

                                            <button type="button" wire:click="closeNewItem()" class="mt-1 btn-block btn btn-danger mb-2">Tutup</button>
                                    </form>
                                @elseif($editItemBar_id)
                                <div class="">
                                    <div class="">
                                        <b>
                                            <h5>Tambah/ubah barcode item</h5>
                                        </b>
                                    </div>

                                    <div class="">
                                        <label for="" class="m-0">Produk </label>
                                        <div class="">
                                            <input readonly value="{{ $editItemBar_produk_nama }}" type="text" class="form-control form-control-sm" placeholder="">
                                        </div>
                                        <div class="mt-1">
                                            <div class="">
                                                Item saat ini : @foreach ($editItemBar_produks->produk_item as $item)
                                                {{ $dasarKovJml }}{{ $item->satuan->satuan }}={{ $item->konversi }}{{ $dasarKov }}, |
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <label for="" class="m-0">Satuan</label>
                                            <select disabled id="satuan_id" wire:model='editItemBar_satuan_id' class="form-control form-control-sm">
                                                <option value="">Pilih</option>
                                                @foreach ($satuans as $data)
                                                <option value="{{ $data->id }}">{{ $data->satuan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        {{-- <div class="mt-2">
                                            <label for="" class="m-0">Konversi (dasar saat ini: {{ $dasarKov }} / {{ $dasarKovJml }} )</label>

                                            <input wire:model='new_item_konversi' type="number" class="form-control form-control-sm" placeholder="jumlah konversi..">
                                        </div> --}}
                                        <label for="" class="m-0">Barcode</label>
                                        <div class="">
                                            <input wire:model='editItemBar_barcode1' type="text" class="form-control form-control-sm" placeholder="barcode 1">
                                        </div>
                                        <div class="">
                                            <input wire:model='editItemBar_barcode2' type="text" class="form-control form-control-sm" placeholder="barcode 2">
                                        </div>
                                        <div class="">
                                            <input wire:model='editItemBar_barcode3' type="text" class="form-control form-control-sm" placeholder="barcode 3">
                                        </div>
                                        <div class="">
                                            <input wire:model='editItemBar_barcode4' type="text" class="form-control form-control-sm" placeholder="barcode 4">
                                        </div>
                                        <div class="">
                                            <input wire:model='editItemBar_barcode5' type="text" class="form-control form-control-sm" placeholder="barcode 5">
                                        </div>
                                        <div class="">
                                            <input wire:model='editItemBar_barcode6' type="text" class="form-control form-control-sm" placeholder="barcode 6">
                                        </div>
                                    </div>


                                        <button type="button" wire:click="saveEditBarItem()" wire:loading.remove wire:loading.attr='disabled' class="mb-1 mt-2 btn-block btn btn-success mb-2">Simpan</button>

                                        <button type="button" wire:click="closeEditBarItem()" class="mt-1 btn-block btn btn-danger mb-2">Tutup</button>
                                </div>
                                @else
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm table-hover">
                                        <thead class="bg-secondary">
                                            <tr>
                                                <th scope="col">Nama Produk

                                                </th>

                                                <th scope="col">Harga</th>
                                                <th scope="col">Catalog</th>
                                                <th scope="col">Kategori</th>
                                                {{-- <th scope="col">Rak</th> --}}
                                                <th scope="col">Tipe</th>

                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white">
                                            @foreach ($produkitem as $data)
                                            <tr class="
                                            @if ($data->diskon_start <= date('Y-m-d') && $data->diskon_end >= date('Y-m-d'))
                                                        @if ($data->jam_start != null && $data->jam_end != null)
                                                        @if ($data->jam_start <= date('H:i:s') && $data->jam_end >= date('H:i:s'))
                                                            @if ((($data->diskon_harga_jual - ($data->diskon_harga_jual * ($data->diskon_persen/100))) - $data->harga_pokok) < 0)
                                                            bg-danger
                                                            @endif
                                                            @else
                                                            @if(($data->harga_jual - $data->harga_pokok) < 0)
                                                            bg-danger
                                                            @endif
                                                            @endif
                                                            @else
                                                            @if((($data->diskon_harga_jual - ($data->diskon_harga_jual * ($data->diskon_persen/100))) - $data->harga_pokok) < 0)
                                                            bg-danger
                                                            @endif
                                                            @endif
                                                            @else
                                                            @if(($data->harga_jual - $data->harga_pokok) < 0)
                                                            bg-danger
                                                            @endif
                                                            @endif
                                            "
                                            style="
                                                @if ($data->diskon_start <= date('Y-m-d') && $data->diskon_end >= date('Y-m-d'))
                                                        @if ($data->jam_start != null && $data->jam_end != null)
                                                        @if ($data->jam_start <= date('H:i:s') && $data->jam_end >= date('H:i:s'))
                                                            @if ((($data->diskon_harga_jual - ($data->diskon_harga_jual * ($data->diskon_persen/100))) - $data->harga_pokok) < 0)
                                                            color: white;
                                                            @endif
                                                            @else
                                                            @if(($data->harga_jual - $data->harga_pokok) < 0)
                                                            color: white;
                                                            @endif
                                                            @endif
                                                            @else
                                                            @if((($data->diskon_harga_jual - ($data->diskon_harga_jual * ($data->diskon_persen/100))) - $data->harga_pokok) < 0)
                                                            color: white;
                                                            @endif
                                                            @endif
                                                            @else
                                                            @if(($data->harga_jual - $data->harga_pokok) < 0)
                                                            color: white;
                                                            @endif
                                                            @endif
                                            "
                                            >
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="">{{ $data->produk->nama }}&nbsp;</div>
                                                        @if ($data->produk->tipe == 'nonINV' || $data->produk->tipe == 'jasa')
                                                    -
                                                    @else
                                                    {{-- {{ $data->stok_jual }} \ --}}
                                                    <div class="badge badge-info" style="font-size: 13px">{{ $data->satuan->satuan }}</div>
                                                    @endif
                                                    </div>
                                                    {{-- <div class="">{{ $data->produk->merek != null ? $data->produk->merek->nama : '' }}</div> --}}

                                                    <div class="d-flex">
                                                        <a href="#" wire:click.prevent="new_item('{{ $data->produk->id }}')" class="text-success mr-1">tambah item</a> |
                                                        <a href="#" wire:click.prevent="editItemBarId('{{ $data->id }}')" class="text-info ml-1">+barcode</a>
                                                    </div>
                                                </td>

                                                <td>

                                                    @if ($data->diskon_start <= date('Y-m-d') && $data->diskon_end >= date('Y-m-d'))
                                                        @if ($data->jam_start != null && $data->jam_end != null)
                                                        @if ($data->jam_start <= date('H:i:s') && $data->jam_end >= date('H:i:s'))
                                                            <a data-placement="right" data-toggle="tooltip" title="Harga Jual awal @uang($data->harga_jual)
Harga pokok @uang($data->harga_pokok)
(untung @uang(($data->diskon_harga_jual - ($data->diskon_harga_jual * ($data->diskon_persen/100))) - $data->harga_pokok))">
                                                                <span class="badge badge-danger mr-1 ">{{ $data->diskon_persen }}%</span>
                                                                <span style="text-decoration: line-through; color: red; font-size: 11px; background-color: white">@uang($data->diskon_harga_jual)</span>
                                                                <span style="color: green; background-color: white">@uang($data->diskon_harga_jual - ($data->diskon_harga_jual * ($data->diskon_persen/100)))</span>
                                                            </a>

                                                            @else
                                                            <a data-placement="right" data-toggle="tooltip" title="Harga Jual awal @uang($data->harga_jual)
Harga pokok @uang($data->harga_pokok)
(untung @uang($data->harga_jual - $data->harga_pokok))">
                                                                <span>@uang($data->harga_jual)</span>
                                                            </a>
                                                            @endif
                                                            @else
                                                            <a data-toggle="tooltip" title="Harga Jual awal @uang($data->harga_jual)
Harga pokok @uang($data->harga_pokok)
(untung @uang(($data->diskon_harga_jual - ($data->diskon_harga_jual * ($data->diskon_persen/100))) - $data->harga_pokok))">
                                                                <span class="badge badge-danger">{{ $data->diskon_persen }}%</span>
                                                                <span style="text-decoration: line-through; color: red; font-size: 11px; background-color: white">@uang($data->diskon_harga_jual)</span>
                                                                <span style="color: green; background-color: white;">@uang($data->diskon_harga_jual - ($data->diskon_harga_jual * ($data->diskon_persen/100)))</span>
                                                            </a>
                                                            @endif
                                                            @else
                                                            <a data-placement="right" data-toggle="tooltip" title="Harga Jual awal @uang($data->harga_jual)
Harga pokok @uang($data->harga_pokok)
(untung @uang($data->harga_jual - $data->harga_pokok))">
                                                                <span>@uang($data->harga_jual)</span>
                                                            </a>
                                                            @endif


                                                </td>
                                                <td>{{ $data->produk->catalog != null ? $data->produk->catalog->nama : '' }}</td>
                                                <td>{{ $data->produk->kategori != null ? $data->produk->kategori->nama : '' }}</td>
                                                {{-- <td>{{ $data->produk->rak != null ? $data->produk->rak->nama : '' }}</td> --}}
                                                <td>{{ $data->produk->tipe }}</td>

                                                <td>
                                                    {{-- <button wire:click="laporItem('{{ $data->id }}')" wire:loading.attr="disabled" type="button" class="btn btn-sm btn-warning">
                                                        <div class="px-1">!</div>
                                                    </button> --}}
                                                    <button wire:click="addNewCardItem('{{ $data->id }}')"  type="button" class="btn btn-sm btn-success px-3 py-2">
                                                        <img src="{{ asset('assets/cart-plus.svg') }}" alt="">
                                                    </button>


                                                </td>

                                            </tr>
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-2">
                                    @if($produkitem->count() >= $takeprodukitem)
                                        <button type="button" wire:click="takeprodukitem()" class="btn btn-warning btn-block">Lainnya</button>
                                    @endif
                                </div>
                                @endif



                            </div>
                        </div>




                    </div>
                </div>
                @endif

            </div>

            {{-- <div class="" style="background-color: rgb(30, 255, 0); padding: 1px"></div> --}}
            <div class="col-md-6">
                <div class="d-flex p-2 justify-content-between align-items-center">
                    <div class="">
                        {{ $kasir->nama }} (@uang($kasir->kas->saldo)) - {{ auth()->user()->nama }}
                    </div>

                    <div class="">
                        @if(auth()->user()->role == 'superadmin')
                        {{-- <button type="button" class="btn btn-primary">
                            Utang Pel <span class="badge badge-light">4</span>
                        </button>

                        <button type="button" class="btn btn-primary">
                            Belum lunas <span class="badge badge-light">4</span>
                        </button> --}}
                        @endif
                        <button wire:click.prevent='billPageShow()' type="button" class="btn btn-info">
                            Menu Bill <span class="badge badge-light">{{ $billCount }}</span>
                        </button>
                        {{-- <button type="button" class="btn btn-secondary">
                            Riwayat
                        </button> --}}
                    </div>
                </div>
                <div class="bg-success d-flex w-100 " style="padding: 1px"></div>

                @if($billPage)
                <div class=""><b>Menu bill</b></div>
                <p>
                    Selesaikan dulu yang atas
                </p>
                <div class="mt-2">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>No bill</th>
                                    <th>Pelanggan</th>
                                    <th>Total Pembayaran</th>
                                    <th>Oleh</th>
                                    <th>Waktu</th>
                                    <th wire:loading.remove>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bills as $data)
                                <tr>
                                    <td>{{ $data->no_bill }}</td>
                                    <td>{{ $data->pelanggan != null ? $data->pelanggan->nama : '-' }}</td>
                                    <td>@uang($data->total_pembayaran)</td>
                                    <td>{{ $data->user->nama }}</td>
                                    <td>{{ \Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</td>
                                    <td wire:loading.remove>
                                        <button wire:click.prevent="proses_bill('{{ $data->id }}')" type="button" class="btn btn-primary">Proses Bill</button>
                                        <button wire:click.prevent="hapus_bill('{{ $data->id }}')" type="button" class="btn btn-danger ml-1">Hapus</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @else
                <div class="container bg-white pb-2">
                    <div class="d-flex  mb-2">
                        <div class="col-6">
                            <div class="">
                                <label for="pelanggan_id" class="mb-0 mt-1">Pilih pelanggan</label>
                                <div class="">
                                    <button wire:click="pelanggan_toggle()" data-toggle="modal" data-target="#pelanggan" data-backdrop="static" data-keyboard="false" class="btn btn-outline-secondary btn-sm" type="button">
                                        @if ($pelanggan_id)
                                        {{ $pelanggan_nama }} @if($pelanggan_phone)
                                        -
                                        @endif {{ $pelanggan_phone }}
                                        @else
                                        Pilih Pelanggan
                                        @endif
                                    </button>
                                </div>



                            </div>
                        </div>
                        <div class="col-6 d-flex justify-content-between">
                            <div class="">
                                <label for="">Hutang Pel (piutang usaha)</label>
                                <div class="">
                                    @uang($pelanggan_piutang_usaha != null ? $pelanggan_piutang_usaha : 0)
                                </div>
                            </div>

                            <div class="">
                                <label for="">Hutang usaha</label>
                                <div class="">
                                    @uang($pelanggan_hutang_usaha != null ? $pelanggan_hutang_usaha : 0)
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="" style="background-color: rgb(30, 255, 0); padding: 1px"></div>
                    <div class="mt-2">
                        <div class="d-flex">
                            <div class="col-4 text-start">
                                <div class="d-flex justify-content-between">
                                    <div class="">
                                        <b>Total harga jual</b>
                                    </div>
                                    <div class="">
                                        <b>@uang($total_harga_jual != null ? $total_harga_jual : 0)</b>
                                    </div>
                                </div>
                                @if($total_potongan_diskon)
                                <div class="d-flex justify-content-between">
                                    <div class="">
                                        Potongan diskon
                                    </div>
                                    <div class="">
                                        @uang($total_potongan_diskon != null ? $total_potongan_diskon : 0)
                                    </div>
                                </div>
                                @endif
                                <div class="d-flex justify-content-between">
                                    <div class="">
                                        <b>Total harga</b>
                                    </div>
                                    <div class="">
                                        <b>@uang($total_harga != null ? $total_harga : 0)</b>
                                    </div>
                                </div>
                                @if($tagihan_utang)
                                <div class="d-flex justify-content-between">
                                    <div class="">
                                        Tagihan utang
                                    </div>
                                    <div class="">
                                        @uang($tagihan_utang)
                                    </div>
                                </div>
                                @endif


                                @if($pajak)
                                <div class="d-flex justify-content-between">
                                    <div class="">
                                        Pajak
                                    </div>
                                    <div class="">
                                        @uang($pajak)
                                    </div>
                                </div>
                                @endif

                                <div class="d-flex justify-content-between">
                                    <div class="">
                                        Ongkir
                                    </div>

                                    <div class="">
                                        <input min="0" type="number" class="" style="height: 23px; width: 100px" wire:model='ongkir'>
                                    </div>

                                </div>

                                {{-- @if($total_potongan_utang_toko)
                                <div class="d-flex justify-content-between">
                                    <div class="">
                                        Potongan utang toko
                                    </div>
                                    <div class="">
                                        @uang($total_potongan_utang_toko)
                                    </div>
                                </div>
                                @endif --}}


                            </div>
                            {{-- <div class="col"></div> --}}
                            <div class="col-8 text-end ">
                                <div class="d-flex justify-content-end text-right">
                                    <span>
                                        <b>
                                            <div class="" style="font-size: 19px">
                                                Total Pembayaran
                                            </div>
                                            <div class="" style="font-size: 50px;">
                                                @uang($total_pembayaran)
                                            </div>
                                        </b>
                                    </span>
                                </div>

                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="col-6 text-start">
                                <div class="mt-2 d-flex justify-content-start align-items-start">
                                    <button wire:click="resetKasir" type="button" class="btn btn-danger ml-1">Reset</button>

                                    @if(session('bill_id'))
                                    <button wire:click="updateBill('{{ session('bill_id') }}')" type="button" class="btn btn-info ml-1">Update bill</button>
                                    @else
                                    <button wire:click="addNewBill()" type="button" class="btn btn-info ml-1">Simpan bill</button>
                                    @endif



                                </div>
                            </div>
                            <div class="col-6 text-end">
                                <div class="mt-2 d-flex justify-content-end align-items-end">


                                    {{-- @if($pelanggan_piutang_usaha <= 100000)
                                    @if ($total_pembayaran <= 100000)
                                    <button type="button" class="btn btn-warning">Bayar nanti</button>
                                        @endif
                                        @endif --}}


                                        {{-- <button type="button" class="btn btn-primary ml-1">Bayar nonTunai</button> --}}
                                        <button wire:click.prevent='bayar_simpan()' type="button" class="btn btn-info ml-1 px-4">Simpan</button>
                                    <button wire:click.prevent='bayar_uang_pas()' type="button" class="btn btn-success ml-1 px-4">Uang pas</button>
                                    <button wire:click.prevent='bayar_tunai_toggle()' type="button" class="btn btn-primary ml-1 px-4" data-toggle="modal" data-target="#bayar_tunai" data-backdrop="static" data-keyboard="false">Bayar tunai</button>

                                </div>
                            </div>
                        </div>
                        <hr class="my-1">
                        @if($total_pembayaran > 0)
                        <div class="d-flex flex-wrap mb-0 mt-0">
                                    <button type="button" hidden>awd</button>
                                    <button type="button" hidden>awaw</button>
                                    <button type="button" hidden>awaw</button>
                                    <button type="button" hidden>awaw</button>
                                    <button type="button" hidden>awaw</button>
                                    <button type="button" hidden>awaw</button>
                                    @if($total_pembayaran < 10000) <button type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(10000)">@nominal(10000)</button>
                                    @endif

                                    @if($total_pembayaran < 20000) <button type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(20000)">@nominal(20000)</button>
                                    @endif
                                    @if($total_pembayaran < 30000) <button type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(30000)">@nominal(30000)</button>
                                    @endif
                                    @if($total_pembayaran < 40000) <button type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(40000)">@nominal(40000)</button>
                                    @endif
                                    @if($total_pembayaran < 50000) <button type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(50000)">@nominal(50000)</button>
                                        @endif
                                    @if($total_pembayaran < 60000) <button type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(60000)">@nominal(60000)</button>
                                        @endif
                                    @if($total_pembayaran < 70000) <button type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(70000)">@nominal(70000)</button>
                                        @endif
                                    @if($total_pembayaran < 80000) <button type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(80000)">@nominal(80000)</button>
                                        @endif
                                    @if($total_pembayaran < 90000) <button type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(90000)">@nominal(90000)</button>
                                        @endif
                                        @if($total_pembayaran < 100000) <button type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(100000)">@nominal(100000)</button>
                                            @else
                                            @if($total_pembayaran < 110000 && $total_pembayaran)
                                            <button type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(110000)">@nominal(110000)</button>
                                            @endif
                                            @if($total_pembayaran < 120000 && $total_pembayaran)
                                            <button type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(120000)">@nominal(120000)</button>
                                            @endif
                                            @if($total_pembayaran < 130000 && $total_pembayaran)
                                            <button type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(130000)">@nominal(130000)</button>
                                            @endif
                                            @if($total_pembayaran < 140000 && $total_pembayaran)
                                            <button type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(140000)">@nominal(140000)</button>
                                            @endif
                                            @if($total_pembayaran < 150000 && $total_pembayaran)
                                            <button type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(150000)">@nominal(150000)</button>
                                            @endif
                                            @if($total_pembayaran < 160000)
                                            <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(160000)">@nominal(160000)</button>
                                            @endif
                                            @if($total_pembayaran < 170000)
                                            <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(170000)">@nominal(170000)</button>
                                            @endif
                                            @if($total_pembayaran < 180000)
                                            <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(180000)">@nominal(180000)</button>
                                            @endif
                                            @if($total_pembayaran < 190000)
                                            <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(190000)">@nominal(190000)</button>
                                            @endif
                                            @if($total_pembayaran < 200000)
                                                <button type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(200000)">@nominal(200000)</button>
                                            @else
                                                @if($total_pembayaran < 210000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(210000)">@nominal(210000)</button>
                                                @endif
                                                @if($total_pembayaran < 220000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(220000)">@nominal(220000)</button>
                                                @endif
                                                @if($total_pembayaran < 230000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(230000)">@nominal(230000)</button>
                                                @endif
                                                @if($total_pembayaran < 240000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(240000)">@nominal(240000)</button>
                                                @endif
                                                @if($total_pembayaran < 250000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(250000)">@nominal(250000)</button>
                                                @endif
                                                @if($total_pembayaran < 260000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(260000)">@nominal(260000)</button>
                                                @endif
                                                @if($total_pembayaran < 270000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(270000)">@nominal(270000)</button>
                                                @endif
                                                @if($total_pembayaran < 280000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(280000)">@nominal(280000)</button>
                                                @endif
                                                @if($total_pembayaran < 290000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(290000)">@nominal(290000)</button>
                                                @endif
                                                @if($total_pembayaran < 300000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(300000)">@nominal(300000)</button>
                                                @else
                                                    @if($total_pembayaran < 310000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(310000)">@nominal(310000)</button>
                                                    @endif
                                                    @if($total_pembayaran < 320000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(320000)">@nominal(320000)</button>
                                                    @endif
                                                    @if($total_pembayaran < 330000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(330000)">@nominal(330000)</button>
                                                    @endif
                                                    @if($total_pembayaran < 340000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(340000)">@nominal(340000)</button>
                                                    @endif
                                                    @if($total_pembayaran < 350000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(350000)">@nominal(350000)</button>
                                                    @endif
                                                    @if($total_pembayaran < 360000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(360000)">@nominal(360000)</button>
                                                    @endif
                                                    @if($total_pembayaran < 370000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(370000)">@nominal(370000)</button>
                                                    @endif
                                                    @if($total_pembayaran < 380000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(380000)">@nominal(380000)</button>
                                                    @endif
                                                    @if($total_pembayaran < 390000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(390000)">@nominal(390000)</button>
                                                    @endif
                                                    @if($total_pembayaran < 400000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(400000)">@nominal(400000)</button>
                                                    @else
                                                        @if($total_pembayaran < 410000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(410000)">@nominal(410000)</button>
                                                        @endif
                                                        @if($total_pembayaran < 420000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(420000)">@nominal(420000)</button>
                                                        @endif
                                                        @if($total_pembayaran < 430000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(430000)">@nominal(430000)</button>
                                                        @endif
                                                        @if($total_pembayaran < 440000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(440000)">@nominal(440000)</button>
                                                        @endif
                                                        @if($total_pembayaran < 450000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(450000)">@nominal(450000)</button>
                                                        @endif
                                                        @if($total_pembayaran < 460000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(460000)">@nominal(460000)</button>
                                                        @endif
                                                        @if($total_pembayaran < 470000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(470000)">@nominal(470000)</button>
                                                        @endif
                                                        @if($total_pembayaran < 480000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(480000)">@nominal(480000)</button>
                                                        @endif
                                                        @if($total_pembayaran < 490000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(490000)">@nominal(490000)</button>
                                                        @endif
                                                        @if($total_pembayaran < 500000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(500000)">@nominal(500000)</button>
                                                        @else
                                                            @if($total_pembayaran < 510000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(510000)">@nominal(510000)</button>
                                                            @endif
                                                            @if($total_pembayaran < 520000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(520000)">@nominal(520000)</button>
                                                            @endif
                                                            @if($total_pembayaran < 530000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(530000)">@nominal(530000)</button>
                                                            @endif
                                                            @if($total_pembayaran < 540000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(540000)">@nominal(540000)</button>
                                                            @endif
                                                            @if($total_pembayaran < 550000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(550000)">@nominal(550000)</button>
                                                            @endif
                                                            @if($total_pembayaran < 560000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(560000)">@nominal(560000)</button>
                                                            @endif
                                                            @if($total_pembayaran < 570000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(570000)">@nominal(570000)</button>
                                                            @endif
                                                            @if($total_pembayaran < 580000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(580000)">@nominal(580000)</button>
                                                            @endif
                                                            @if($total_pembayaran < 590000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(590000)">@nominal(590000)</button>
                                                            @endif
                                                            @if($total_pembayaran < 600000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(600000)">@nominal(600000)</button>
                                                            @else
                                                                @if($total_pembayaran < 610000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(610000)">@nominal(610000)</button>
                                                                @endif
                                                                @if($total_pembayaran < 620000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(620000)">@nominal(620000)</button>
                                                                @endif
                                                                @if($total_pembayaran < 630000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(630000)">@nominal(630000)</button>
                                                                @endif
                                                                @if($total_pembayaran < 640000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(640000)">@nominal(640000)</button>
                                                                @endif
                                                                @if($total_pembayaran < 650000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(650000)">@nominal(650000)</button>
                                                                @endif
                                                                @if($total_pembayaran < 660000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(660000)">@nominal(660000)</button>
                                                                @endif
                                                                @if($total_pembayaran < 670000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(670000)">@nominal(670000)</button>
                                                                @endif
                                                                @if($total_pembayaran < 680000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(680000)">@nominal(680000)</button>
                                                                @endif
                                                                @if($total_pembayaran < 690000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(690000)">@nominal(690000)</button>
                                                                @endif
                                                                @if($total_pembayaran < 700000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(700000)">@nominal(700000)</button>
                                                                @else
                                                                    @if($total_pembayaran < 710000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(710000)">@nominal(710000)</button>
                                                                    @endif
                                                                    @if($total_pembayaran < 720000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(720000)">@nominal(720000)</button>
                                                                    @endif
                                                                    @if($total_pembayaran < 730000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(730000)">@nominal(730000)</button>
                                                                    @endif
                                                                    @if($total_pembayaran < 740000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(740000)">@nominal(740000)</button>
                                                                    @endif
                                                                    @if($total_pembayaran < 750000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(750000)">@nominal(750000)</button>
                                                                    @endif
                                                                    @if($total_pembayaran < 760000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(760000)">@nominal(760000)</button>
                                                                    @endif
                                                                    @if($total_pembayaran < 770000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(770000)">@nominal(770000)</button>
                                                                    @endif
                                                                    @if($total_pembayaran < 780000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(780000)">@nominal(780000)</button>
                                                                    @endif
                                                                    @if($total_pembayaran < 790000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(790000)">@nominal(790000)</button>
                                                                    @endif
                                                                    @if($total_pembayaran < 800000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(800000)">@nominal(800000)</button>

                                                                    @else
                                                                        @if($total_pembayaran < 800000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(800000)">@nominal(800000)</button>
                                                                        @endif
                                                                        @if($total_pembayaran < 810000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(810000)">@nominal(810000)</button>
                                                                        @endif
                                                                        @if($total_pembayaran < 820000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(820000)">@nominal(820000)</button>
                                                                        @endif
                                                                        @if($total_pembayaran < 830000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(830000)">@nominal(830000)</button>
                                                                        @endif
                                                                        @if($total_pembayaran < 840000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(840000)">@nominal(840000)</button>
                                                                        @endif
                                                                        @if($total_pembayaran < 850000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(850000)">@nominal(850000)</button>
                                                                        @endif
                                                                        @if($total_pembayaran < 860000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(860000)">@nominal(860000)</button>
                                                                        @endif
                                                                        @if($total_pembayaran < 870000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(870000)">@nominal(870000)</button>
                                                                        @endif
                                                                        @if($total_pembayaran < 880000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(880000)">@nominal(880000)</button>
                                                                        @endif
                                                                        @if($total_pembayaran < 890000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(890000)">@nominal(890000)</button>
                                                                        @endif
                                                                        @if($total_pembayaran < 900000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(900000)">@nominal(900000)</button>

                                                                        @else
                                                                            @if($total_pembayaran < 910000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(910000)">@nominal(910000)</button>
                                                                            @endif
                                                                            @if($total_pembayaran < 920000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(920000)">@nominal(920000)</button>
                                                                            @endif
                                                                            @if($total_pembayaran < 930000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(930000)">@nominal(930000)</button>
                                                                            @endif
                                                                            @if($total_pembayaran < 940000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(940000)">@nominal(940000)</button>
                                                                            @endif
                                                                            @if($total_pembayaran < 950000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(950000)">@nominal(950000)</button>
                                                                            @endif
                                                                            @if($total_pembayaran < 960000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(960000)">@nominal(960000)</button>
                                                                            @endif
                                                                            @if($total_pembayaran < 970000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(970000)">@nominal(970000)</button>
                                                                            @endif
                                                                            @if($total_pembayaran < 980000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(980000)">@nominal(980000)</button>
                                                                            @endif
                                                                            @if($total_pembayaran < 990000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(990000)">@nominal(990000)</button>
                                                                            @endif
                                                                            @if($total_pembayaran < 1000000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(1000000)">@nominal(1000000)</button>
                                                                            @else
                                                                                @if($total_pembayaran < 1100000) <button  type="button" class="btn btn-warning mr-2 mb-2" wire:click.prevent="btnTerima(1100000)">@nominal(1100000)</button>
                                                                                @endif
                                                                            @endif
                                                                        @endif
                                                                    @endif

                                                                @endif

                                                            @endif

                                                        @endif

                                                    @endif


                                                @endif


                                            @endif

                                        @endif
                        </div>
                        @endif

                    </div>
                </div>
                {{-- ======================================================================================= --}}
                {{-- ======================================================================================= --}}
                <div class="mt-2">
                    <div class="container">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm table-hover">
                                <thead class="bg-secondary">
                                    <tr>
                                        <th scope="col">Nama Produk

                                        </th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">Harga jual</th>


                                        <th scope="col">Diskon</th>
                                        <th scope="col">Total Harga</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @foreach ($carditem as $data)
                                    @if($data->id == $itemID)
                                    <tr  @if($data->untung < 0)
                                        class="bg-danger"
                                        style="color:white;"
                                        @endif>
                                        <td>{{ $data->produk != null ? $data->produk->nama : '-' }}
                                            <div class="">{{ $data->produk->merek != null ? $data->produk->merek->nama : '' }}</div>
                                        </td>
                                        <td>
                                            <div class="input-group ">
                                                <input min="1" type="number" wire:model='qtyEdit' style="width: 60px;" class="form-control form-control-sm" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                                <div class="input-group-append">
                                                    <span class="input-group-text form-control-sm" id="basic-addon2">{{ $data->satuan->satuan }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a wire:click="ubahharga_toggle('{{ $data->id }}')" data-toggle="modal" data-target="#ubahharga" data-backdrop="static" data-keyboard="false" type="button" class="btn border rounded  form-control form-control-sm "  @if($data->untung < 0)
                                                color:white;
                                            @endif>
                                                @uang($data->harga_jual)
                                            </a>
                                        </td>
                                        <td>
                                            @uang($data->potongan_diskon)
                                        </td>
                                        <td>
                                            @uang($data->total_harga)
                                            <div class="text-muted" style="font-size: 10px"
                                            @if($data->untung < 0)
                                            color:white;
                                        @endif>@uang($data->untung)</div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-end">
                                                <button wire:click="tambahQty('{{ $data->id }}')" type="button" class="btn btn-sm px-2 btn-success mr-1"><span> + </span></button>
                                                <button wire:click="kurangQty('{{ $data->id }}')" type="button" class="btn btn-sm px-2 btn-warning"><span> - </span></button>
                                                @if($deleteLoading)
                                                <div class="btn btn-sm btn-danger ml-2 px-2 disabled" wire:loading wire:target="deleteItem('{{ $data->id }}')">
                                                    <img src="{{ asset('assets/trash.svg') }}" alt="">
                                                </div>
                                                @else
                                                <button wire:click="deleteItem('{{ $data->id }}')" wire:loading.attr="disabled" class="btn btn-sm btn-danger ml-2 px-2">
                                                    <img src="{{ asset('assets/trash.svg') }}" alt="">
                                                </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @else
                                    <tr class="
                                    @if($data->untung < 0)
                                        bg-danger
                                    @endif
                                    " style="
                                    @if($data->untung < 0)
                                        color:white;
                                    @endif
                                    ">
                                        <td>{{ $data->produk->nama }}
                                            <div class="">{{ $data->produk->merek != null ? $data->produk->merek->nama : '' }}</div>
                                        </td>
                                        <td>
                                            <a wire:click="editItem('{{ $data->id }}')" type="button" class="btn border rounded  form-control form-control-sm " style="
                                                 @if($data->untung < 0)
                                                    color:white;
                                                @endif
                                                ">{{ $data->qty }}
                                                <span class="ml-1">
                                                    {{ $data->satuan->satuan }}
                                                </span>
                                            </a>

                                        </td>
                                        <td>
                                            <a wire:click="ubahharga_toggle('{{ $data->id }}')" data-toggle="modal" data-target="#ubahharga" data-backdrop="static" data-keyboard="false" type="button" class="btn border rounded  form-control form-control-sm " style="
                                                 @if($data->untung < 0)
                                                    color:white;
                                                @endif
                                                ">
                                                @uang($data->harga_jual)
                                            </a>
                                        </td>
                                        <td>
                                            @uang($data->potongan_diskon)
                                        </td>
                                        <td>
                                            @uang($data->total_harga)
                                            <div class="" style="font-size: 10px">@uang($data->untung)</div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-end">
                                                <button wire:click="tambahQty('{{ $data->id }}')" type="button" class="btn btn-sm px-2 btn-success mr-1"><span> + </span></button>
                                                <button wire:click="kurangQty('{{ $data->id }}')" type="button" class="btn btn-sm px-2 btn-warning"><span> - </span></button>
                                                @if($deleteLoading)
                                                <div class="btn btn-sm btn-danger ml-2 px-2 disabled" wire:loading wire:target="deleteItem('{{ $data->id }}')">
                                                    <img src="{{ asset('assets/trash.svg') }}" alt="">
                                                </div>
                                                @else
                                                <button wire:click="deleteItem('{{ $data->id }}')" wire:loading.attr="disabled" class="btn btn-sm btn-danger ml-2 px-2">
                                                    <img src="{{ asset('assets/trash.svg') }}" alt="">
                                                </button>
                                                @endif

                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach


                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
                @endif
            </div>




        </div>

    </div>



    <!-- Modal bayar tunai-->
    <div class="modal fade show" data-backdrop='true' id="bayar_tunai" tabindex="-1" aria-labelledby="bayar_tunaiabel" aria-hidden="true" @if($bayar_tunai_show) style="display: block;" @endif>
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title" id="bayar_tunaiabel">Bayar Tunai</h5>
                    <button wire:click="bayar_tunai_close()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="bayar_tunai_cetak_struk">
                        <div class="">
                            <div class="card mb-2 bg-success shadow-none">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="">
                                            <b>Total Pembayaran</b>
                                        </div>
                                        <div class="" style="font-size: 35px">
                                            <b>@uang($total_pembayaran)</b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($total_pembayaran != 0)
                                <div class="d-flex flex-wrap mb-2">
                                    <button type="button" hidden>awd</button>
                                    <button type="button" hidden>awaw</button>
                                    <button wire:click.prevent='bayar_uang_pas2()' type="button" class="btn btn-success mr-2 mb-2">Uang pas</button>
                                    @if($total_pembayaran < 10000) <button type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima',10000)">@uang(10000)</button>
                                    @endif
                                    @if($total_pembayaran < 20000) <button type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 20000)">@uang(20000)</button>
                                    @endif
                                    @if($total_pembayaran < 30000) <button type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 30000)">@uang(30000)</button>
                                    @endif
                                    @if($total_pembayaran < 40000) <button type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 40000)">@uang(40000)</button>
                                    @endif
                                    @if($total_pembayaran < 50000) <button type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 50000)">@uang(50000)</button>
                                        @endif
                                    @if($total_pembayaran < 60000) <button type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 60000)">@uang(60000)</button>
                                        @endif
                                    @if($total_pembayaran < 70000) <button type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 70000)">@uang(70000)</button>
                                        @endif
                                    @if($total_pembayaran < 80000) <button type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 80000)">@uang(80000)</button>
                                        @endif
                                    @if($total_pembayaran < 90000) <button type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 90000)">@uang(90000)</button>
                                        @endif
                                        @if($total_pembayaran < 100000) <button type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 100000)">@uang(100000)</button>
                                            @else
                                            @if($total_pembayaran < 110000 && $total_pembayaran)
                                            <button type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 110000)">@uang(110000)</button>
                                            @endif
                                            @if($total_pembayaran < 120000 && $total_pembayaran)
                                            <button type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 120000)">@uang(120000)</button>
                                            @endif
                                            @if($total_pembayaran < 130000 && $total_pembayaran)
                                            <button type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 130000)">@uang(130000)</button>
                                            @endif
                                            @if($total_pembayaran < 140000 && $total_pembayaran)
                                            <button type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 140000)">@uang(140000)</button>
                                            @endif
                                            @if($total_pembayaran < 150000 && $total_pembayaran)
                                            <button type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 150000)">@uang(150000)</button>
                                            @endif
                                            @if($total_pembayaran < 160000)
                                            <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 160000)">@uang(160000)</button>
                                            @endif
                                            @if($total_pembayaran < 170000)
                                            <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 170000)">@uang(170000)</button>
                                            @endif
                                            @if($total_pembayaran < 180000)
                                            <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 180000)">@uang(180000)</button>
                                            @endif
                                            @if($total_pembayaran < 190000)
                                            <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 190000)">@uang(190000)</button>
                                            @endif
                                            @if($total_pembayaran < 200000)
                                                <button type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 200000)">@uang(200000)</button>
                                            @else
                                                @if($total_pembayaran < 210000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 210000)">@uang(210000)</button>
                                                @endif
                                                @if($total_pembayaran < 220000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 220000)">@uang(220000)</button>
                                                @endif
                                                @if($total_pembayaran < 230000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 230000)">@uang(230000)</button>
                                                @endif
                                                @if($total_pembayaran < 240000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 240000)">@uang(240000)</button>
                                                @endif
                                                @if($total_pembayaran < 250000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 250000)">@uang(250000)</button>
                                                @endif
                                                @if($total_pembayaran < 260000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 260000)">@uang(260000)</button>
                                                @endif
                                                @if($total_pembayaran < 270000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 270000)">@uang(270000)</button>
                                                @endif
                                                @if($total_pembayaran < 280000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 280000)">@uang(280000)</button>
                                                @endif
                                                @if($total_pembayaran < 290000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 290000)">@uang(290000)</button>
                                                @endif
                                                @if($total_pembayaran < 300000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 300000)">@uang(300000)</button>
                                                @else
                                                    @if($total_pembayaran < 310000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 310000)">@uang(310000)</button>
                                                    @endif
                                                    @if($total_pembayaran < 320000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 320000)">@uang(320000)</button>
                                                    @endif
                                                    @if($total_pembayaran < 330000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 330000)">@uang(330000)</button>
                                                    @endif
                                                    @if($total_pembayaran < 340000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 340000)">@uang(340000)</button>
                                                    @endif
                                                    @if($total_pembayaran < 350000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 350000)">@uang(350000)</button>
                                                    @endif
                                                    @if($total_pembayaran < 360000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 360000)">@uang(360000)</button>
                                                    @endif
                                                    @if($total_pembayaran < 370000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 370000)">@uang(370000)</button>
                                                    @endif
                                                    @if($total_pembayaran < 380000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 380000)">@uang(380000)</button>
                                                    @endif
                                                    @if($total_pembayaran < 390000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 390000)">@uang(390000)</button>
                                                    @endif
                                                    @if($total_pembayaran < 400000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 400000)">@uang(400000)</button>
                                                    @else
                                                        @if($total_pembayaran < 410000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 410000)">@uang(410000)</button>
                                                        @endif
                                                        @if($total_pembayaran < 420000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 420000)">@uang(420000)</button>
                                                        @endif
                                                        @if($total_pembayaran < 430000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 430000)">@uang(430000)</button>
                                                        @endif
                                                        @if($total_pembayaran < 440000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 440000)">@uang(440000)</button>
                                                        @endif
                                                        @if($total_pembayaran < 450000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 450000)">@uang(450000)</button>
                                                        @endif
                                                        @if($total_pembayaran < 460000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 460000)">@uang(460000)</button>
                                                        @endif
                                                        @if($total_pembayaran < 470000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 470000)">@uang(470000)</button>
                                                        @endif
                                                        @if($total_pembayaran < 480000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 480000)">@uang(480000)</button>
                                                        @endif
                                                        @if($total_pembayaran < 490000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 490000)">@uang(490000)</button>
                                                        @endif
                                                        @if($total_pembayaran < 500000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 500000)">@uang(500000)</button>
                                                        @else
                                                            @if($total_pembayaran < 510000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 510000)">@uang(510000)</button>
                                                            @endif
                                                            @if($total_pembayaran < 520000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 520000)">@uang(520000)</button>
                                                            @endif
                                                            @if($total_pembayaran < 530000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 530000)">@uang(530000)</button>
                                                            @endif
                                                            @if($total_pembayaran < 540000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 540000)">@uang(540000)</button>
                                                            @endif
                                                            @if($total_pembayaran < 550000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 550000)">@uang(550000)</button>
                                                            @endif
                                                            @if($total_pembayaran < 560000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 560000)">@uang(560000)</button>
                                                            @endif
                                                            @if($total_pembayaran < 570000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 570000)">@uang(570000)</button>
                                                            @endif
                                                            @if($total_pembayaran < 580000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 580000)">@uang(580000)</button>
                                                            @endif
                                                            @if($total_pembayaran < 590000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 590000)">@uang(590000)</button>
                                                            @endif
                                                            @if($total_pembayaran < 600000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 600000)">@uang(600000)</button>
                                                            @else
                                                                @if($total_pembayaran < 610000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 610000)">@uang(610000)</button>
                                                                @endif
                                                                @if($total_pembayaran < 620000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 620000)">@uang(620000)</button>
                                                                @endif
                                                                @if($total_pembayaran < 630000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 630000)">@uang(630000)</button>
                                                                @endif
                                                                @if($total_pembayaran < 640000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 640000)">@uang(640000)</button>
                                                                @endif
                                                                @if($total_pembayaran < 650000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 650000)">@uang(650000)</button>
                                                                @endif
                                                                @if($total_pembayaran < 660000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 660000)">@uang(660000)</button>
                                                                @endif
                                                                @if($total_pembayaran < 670000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 670000)">@uang(670000)</button>
                                                                @endif
                                                                @if($total_pembayaran < 680000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 680000)">@uang(680000)</button>
                                                                @endif
                                                                @if($total_pembayaran < 690000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 690000)">@uang(690000)</button>
                                                                @endif
                                                                @if($total_pembayaran < 700000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 700000)">@uang(700000)</button>
                                                                @else
                                                                    @if($total_pembayaran < 710000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 710000)">@uang(710000)</button>
                                                                    @endif
                                                                    @if($total_pembayaran < 720000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 720000)">@uang(720000)</button>
                                                                    @endif
                                                                    @if($total_pembayaran < 730000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 730000)">@uang(730000)</button>
                                                                    @endif
                                                                    @if($total_pembayaran < 740000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 740000)">@uang(740000)</button>
                                                                    @endif
                                                                    @if($total_pembayaran < 750000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 750000)">@uang(750000)</button>
                                                                    @endif
                                                                    @if($total_pembayaran < 760000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 760000)">@uang(760000)</button>
                                                                    @endif
                                                                    @if($total_pembayaran < 770000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 770000)">@uang(770000)</button>
                                                                    @endif
                                                                    @if($total_pembayaran < 780000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 780000)">@uang(780000)</button>
                                                                    @endif
                                                                    @if($total_pembayaran < 790000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 790000)">@uang(790000)</button>
                                                                    @endif
                                                                    @if($total_pembayaran < 800000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 800000)">@uang(800000)</button>

                                                                    @else
                                                                        @if($total_pembayaran < 800000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 800000)">@uang(800000)</button>
                                                                        @endif
                                                                        @if($total_pembayaran < 810000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 810000)">@uang(810000)</button>
                                                                        @endif
                                                                        @if($total_pembayaran < 820000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 820000)">@uang(820000)</button>
                                                                        @endif
                                                                        @if($total_pembayaran < 830000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 830000)">@uang(830000)</button>
                                                                        @endif
                                                                        @if($total_pembayaran < 840000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 840000)">@uang(840000)</button>
                                                                        @endif
                                                                        @if($total_pembayaran < 850000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 850000)">@uang(850000)</button>
                                                                        @endif
                                                                        @if($total_pembayaran < 860000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 860000)">@uang(860000)</button>
                                                                        @endif
                                                                        @if($total_pembayaran < 870000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 870000)">@uang(870000)</button>
                                                                        @endif
                                                                        @if($total_pembayaran < 880000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 880000)">@uang(880000)</button>
                                                                        @endif
                                                                        @if($total_pembayaran < 890000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 890000)">@uang(890000)</button>
                                                                        @endif
                                                                        @if($total_pembayaran < 900000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 900000)">@uang(900000)</button>

                                                                        @else
                                                                            @if($total_pembayaran < 910000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 910000)">@uang(910000)</button>
                                                                            @endif
                                                                            @if($total_pembayaran < 920000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 920000)">@uang(920000)</button>
                                                                            @endif
                                                                            @if($total_pembayaran < 930000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 930000)">@uang(930000)</button>
                                                                            @endif
                                                                            @if($total_pembayaran < 940000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 940000)">@uang(940000)</button>
                                                                            @endif
                                                                            @if($total_pembayaran < 950000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 950000)">@uang(950000)</button>
                                                                            @endif
                                                                            @if($total_pembayaran < 960000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 960000)">@uang(960000)</button>
                                                                            @endif
                                                                            @if($total_pembayaran < 970000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 970000)">@uang(970000)</button>
                                                                            @endif
                                                                            @if($total_pembayaran < 980000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 980000)">@uang(980000)</button>
                                                                            @endif
                                                                            @if($total_pembayaran < 990000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 990000)">@uang(990000)</button>
                                                                            @endif
                                                                            @if($total_pembayaran < 1000000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 1000000)">@uang(1000000)</button>
                                                                            @else
                                                                                @if($total_pembayaran < 1100000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 1100000)">@uang(1100000)</button>
                                                                                @endif
                                                                            @endif
                                                                        @endif
                                                                    @endif

                                                                @endif

                                                            @endif

                                                        @endif

                                                    @endif


                                                @endif


                                            @endif

                                        @endif




                                </div>
                                <div class="card mb-2 bg-info shadow-none">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="" style="font-size: 16px">
                                                <b>Diterima : </b> <span >@uang($diterima != null ? $diterima : 0)</span>
                                            </div>
                                            <div class="" style="font-size: 30px">
                                                <input min="{{ $total_pembayaran }}" wire:model="diterima" type="number" class="" placeholder="Rp...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if($total_pembayaran < $diterima)
                                <div class="card mb-2 bg-danger shadow-none">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="">
                                                <b>Kembali</b>
                                            </div>
                                            <div class="" style="font-size: 18px">
                                                @uang($kembali != null ? $kembali : 0)
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @endif


                            <div class="mt-2">
                                <div class="d-flex">
                                    <button type="submit" wire:loading.remove class="btn btn-primary form-control mr-1">Simpan dan cetak struk</button>
                                    {{-- <button type="button" wire:click='bayar_tunai_cetak_nota()'  class="btn btn-info form-control ml-1">Simpan dan cetak Nota</button> --}}
                                </div>
                                <button type="button"  wire:loading   class="btn btn-secondary mt-2 form-control">Loading...</button>
                                {{-- <button type="button"  wire:click.prevent='bayar_tunai()' wire:loading.remove  class="btn btn-warning mt-2 form-control">Simpan (tanpa cetak struk)</button> --}}
                                {{-- <a type="button" href="{{ url('struk') }}" class="btn btn-warning mt-2 form-control">cetak</a> --}}

                            </div>
                            @endif
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button wire:click="bayar_tunai_close()" type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade show " data-backdrop='true' id="pelanggan" tabindex="-1" aria-labelledby="pelangganabel" aria-hidden="true" @if($pelanggan_show) style="display: block;" @endif>
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pelangganabel">Pilih pelanggan</h5>
                    <div class="">
                        @if($tambahPelangganPage)
                        <button wire:click="$set('tambahPelangganPage', null)" type="button" class="btn btn-warning mr-3">Pilih Pelanggan</button>
                        @else
                        <button wire:click="$set('tambahPelangganPage', 'true')" type="button" class="btn btn-primary mr-3">Tambah Pelanggan</button>
                        @endif
                        <button wire:click="pelanggan_toggle()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    @if($tambahPelangganPage)
                    <div class="mb-3">
                        <b>
                            <h5>Tambah Pelanggan</h5>
                        </b>
                    </div>
                    <form wire:submit.prevent='simpanPelanggan'>
                        {{-- <div class="mb-1">
                        <label for="img">Gambar</label>
                        <input wire:model='img' type="file" class="form-control" placeholder="image">
                    </div> --}}
                        <div class="mb-1">
                            <label for="nama">Nama <span class="text-danger">*wajib</span></label>
                            <input maxlength="30" autofocus='true' required wire:model='nama' type="text" class="form-control" placeholder="Nama">
                        </div>

                        <div class="mb-1">
                            <label for="nama">Jenis kelamin <span class="text-danger">*wajib</span></label>
                            <select required class="form-control" wire:model='jk' id="">
                                <option value="">Pilih</option>
                                <option value="l">Laki laki</option>
                                <option value="p">Prempuan</option>
                            </select>
                        </div>

                        <div class="mb-1">
                            <label for="phone">Nomor hp</label>
                            <input wire:model='phone' type="tel" class="form-control" placeholder="phone">
                        </div>

                        <div class="mb-1">
                            <label for="daerah">daerah</label>
                            <input wire:model='daerah' type="tel" class="form-control" placeholder="daerah">
                        </div>

                        <div class="mb-1">
                            <label for="alamat">alamat</label>
                            <input wire:model='alamat' type="text" class="form-control" placeholder="alamat">
                        </div>
                        <div class="mb-1">
                            <label for="email">email</label>
                            <input autocomplete="off" wire:model='email' type="email" class="form-control" placeholder="email">
                        </div>
                        <div class="mb-1">
                            <label for="bank">bank</label>
                            <input wire:model='bank' type="text" class="form-control" placeholder="bank">
                        </div>
                        <div class="mb-1">
                            <label for="norek">No Rekening</label>
                            <input wire:model='norek' type="text" class="form-control" placeholder="No Rekening">
                        </div>
                        <div class="mb-1">
                            <label for="an">Atas Nama</label>
                            <input wire:model='an' type="text" class="form-control" placeholder="Atas nama">
                        </div>

                        <button type="submit" class="btn mb-1 mt-1 btn-success rounded-pill form-control">Simpan</button>
                        <button type="button" wire:click="$set('tambahPelangganPage', null)" class="btn btn-light rounded-pill form-control">Tutup</button>
                    </form>
                    @else
                    <div class="">
                        <input wire:model='CariPelanggan' id="pelangganInput" placeholder="Cari pelanggan.." class="form-control" type="text" autofocus>
                        <ul id="pelangganUL" class="mt-2">
                            @forelse ($pelanggans as $data)
                            <li class="mt-2">
                                <a href="#" class="li" wire:click="pelanggan_id({{ $data->id }})" data-dismiss="modal">
                                    <div class="d-flex justify-content-between">
                                        <div class="">
                                            {{ $data->nama }}-{{ $data->phone }}
                                        </div>
                                        <div class="">
                                            utang:@uang($data->piutang_usaha) | hutang usaha:@uang($data->hutang_usaha)
                                        </div>
                                    </div>
                                </a>
                            </li>
                            @empty
                            Tidak ditemukan
                            @endforelse
                        </ul>
                        @if($pelanggans->count() >= $pelanggan_take)
                        <div class="text-center">
                            <button wire:click='pelanggan_lainnya()' type="button" class="btn btn-warning btn-sm">Lainnya</button>
                        </div>
                        @endif
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button wire:click="pelanggan_toggle()" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>



<style>
    .card-text {
        font-size: 14px;
    }


    /* .table-hover tbody tr:hover td,
    .table-hover tbody tr:hover th {
        background-color: rgb(0, 179, 255);
    } */

</style>


@push('script')
    <script>

    Livewire.on('cetakData', data => {
        console.log(data.url);
        console.log(data.title);

        cetakStruk(data.url, data.title);

    })

        function cetakStruk(url, title) {
            // popupCenter(url, title, 720, 675);
            popupCenter(url, title, 900, 700);
        }

        function popupCenter(url, title, w, h) {
            var left = (screen.width - w) / 2;
            var top = (screen.height - h) / 4;
            var myWindow = window.open(url, title,
            'resizable=yes, width=' + w + ', height=' + h + ', top='
            + top + ', left=' + left);
        }


</script>

@endpush

@push('script')
    <script type="text/javascript">
        window.onload = function(ev) {
            if (window.innerHeight + window.scrollY >= document.body.offsetHeight && window.innerHeight + window
                .pageYOffset >= document.body.offsetHeight) {
                Livewire.emit('take-data');
            }
        }

        window.onscroll = function(ev) {
            if (window.innerHeight + window.scrollY >= document.body.offsetHeight && window.innerHeight + window
                .pageYOffset >= document.body.offsetHeight) {
                Livewire.emit('take-data');
            }
        }
    </script>
@endpush
