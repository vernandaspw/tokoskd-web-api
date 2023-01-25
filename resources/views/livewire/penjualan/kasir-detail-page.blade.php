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
                            {{ $ubahHargaDiskonJual }}
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
                            <button type="submit" class="btn mt-2 btn-success form-control">Simpan</button>
                            @else
                            <div class="mt-2 bg-success form-control">Simpan</div>
                            @endif



                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button wire:click="ubahharga_close()" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="content-wrapper">



        <div class="d-flex ">
            <div class="col-md-6" style="padding-bottom: 450px;">
                <div class="d-flex justify-content-center">
                    <a href="#" wire:click="menuProduk()" class="w-100 border text-center py-3 text-white
                    @if($menuManual == false && $menuBuatBaru == false)
                    bg-primary
                    @endif
                    " style="background-color: #343A40">
                        Produk
                    </a>
                    <a href="#" wire:click="menuManual()" class="w-100 border text-center py-3 text-white
                    @if($menuManual)
                    bg-primary
                    @endif
                    " style="background-color: #343A40">
                        Manual
                    </a>
                    <a href="#" wire:click="menuBuatBaru()" class="w-100 border text-center py-3 text-white
                    @if($menuBuatBaru)
                    bg-primary
                    @endif
                    " style="background-color: #343A40">
                        Buat baru
                    </a>
                </div>


                @if($menuManual)
                Manual
                @elseif($menuBuatBaru)
                Buat baru
                @else
                <div class="produk">
                    <div class="mt-2">
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
                                    <div class="row row-cols-3 text-center">
                                        <div class="col">
                                            <input autofocus wire:model='cariBarcode' type="text" class="form-control" placeholder="Barcode">
                                        </div>
                                        <div class="col">
                                            <input wire:model='cariProduk' type="text" class="form-control" placeholder="Nama produk">
                                        </div>
                                        <div class="col">
                                            <select wire:model='orderBy' class="form-control" id="">
                                                <option value="terbaru">Terbaru</option>
                                                <option value="diskon terbesar">Diskon terbesar</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-2">
                            <div class="container">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm table-hover">
                                        <thead class="bg-secondary">
                                            <tr>
                                                <th scope="col">Nama Produk

                                                </th>
                                                <th scope="col">Stok</th>
                                                <th scope="col">Harga</th>
                                                <th scope="col">Catalog</th>
                                                <th scope="col">Kategori</th>
                                                <th scope="col">Rak</th>
                                                <th scope="col">Tipe</th>

                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white">
                                            @foreach ($produkitem as $data)
                                            <tr>
                                                <td>{{ $data->produk->nama }}
                                                    <div class="">{{ $data->produk->merek != null ? $data->produk->merek->nama : '' }}</div>
                                                </td>
                                                <td>
                                                    @if ($data->produk->tipe == 'nonINV' || $data->produk->tipe == 'jasa')
                                                    Tanpa stok
                                                    @else
                                                    {{ $data->stok_jual }} {{ $data->satuan->satuan }}
                                                    @endif
                                                </td>
                                                <td>

                                                    @if ($data->diskon_start <= date('Y-m-d') && $data->diskon_end >= date('Y-m-d'))
                                                        @if ($data->jam_start != null && $data->jam_end != null)
                                                        @if ($data->jam_start <= date('H:i:s') && $data->jam_end >= date('H:i:s'))
                                                            <a data-placement="right" data-toggle="tooltip" title="Harga Jual awal @uang($data->harga_jual)
Harga pokok @uang($data->harga_pokok)
(masih untung @uang(($data->diskon_harga_jual - ($data->diskon_harga_jual * ($data->diskon_persen/100))) - $data->harga_pokok))">
                                                                <span class="badge badge-danger mr-1 ">{{ $data->diskon_persen }}%</span>
                                                                <span style="text-decoration: line-through; color: red; font-size: 11px">@uang($data->diskon_harga_jual)</span>
                                                                <span style="color: green">@uang($data->diskon_harga_jual - ($data->diskon_harga_jual * ($data->diskon_persen/100)))</span>
                                                            </a>

                                                            @else
                                                            <a data-placement="right" data-toggle="tooltip" title="Harga Jual awal @uang($data->harga_jual)
Harga pokok @uang($data->harga_pokok)
(masih untung @uang($data->harga_jual - $data->harga_pokok))">
                                                                <span>@uang($data->harga_jual)</span>
                                                            </a>
                                                            @endif
                                                            @else
                                                            <a data-toggle="tooltip" title="Harga Jual awal @uang($data->harga_jual)
Harga pokok @uang($data->harga_pokok)
(masih untung @uang(($data->diskon_harga_jual - ($data->diskon_harga_jual * ($data->diskon_persen/100))) - $data->harga_pokok))">
                                                                <span class="badge badge-danger">{{ $data->diskon_persen }}%</span>
                                                                <span style="text-decoration: line-through; color: red; font-size: 11px">@uang($data->diskon_harga_jual)</span>
                                                                <span style="color: green">@uang($data->diskon_harga_jual - ($data->diskon_harga_jual * ($data->diskon_persen/100)))</span>
                                                            </a>
                                                            @endif
                                                            @else
                                                            <a data-placement="right" data-toggle="tooltip" title="Harga Jual awal @uang($data->harga_jual)
Harga pokok @uang($data->harga_pokok)
(masih untung @uang($data->harga_jual - $data->harga_pokok))">
                                                                <span>@uang($data->harga_jual)</span>
                                                            </a>
                                                            @endif


                                                </td>
                                                <td>{{ $data->produk->catalog != null ? $data->produk->catalog->nama : '' }}</td>
                                                <td>{{ $data->produk->kategori != null ? $data->produk->kategori->nama : '' }}</td>
                                                <td>{{ $data->produk->rak != null ? $data->produk->rak->nama : '' }}</td>
                                                <td>{{ $data->produk->tipe }}</td>

                                                <td>
                                                    <button wire:click="addNewCardItem('{{ $data->id }}')" wire:loading.attr="disabled" type="button" class="btn btn-sm btn-primary">
                                                        <img src="{{ asset('assets/cart-plus.svg') }}" alt="">
                                                    </button>
                                                </td>

                                            </tr>
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>




                    </div>
                </div>
                @endif

            </div>

            <div class="" style="background-color: rgb(30, 255, 0); padding: 1px"></div>
            <div class="col-md-6">
                <div class="d-flex p-2 justify-content-between align-items-center">
                    <div class="">
                        {{ $kasir->nama }} (@uang($kasir->kas->saldo)) - {{ auth()->user()->nama }}
                    </div>

                    <div class="">
                        @if(auth()->user()->role == 'superadmin')
                        <button type="button" class="btn btn-primary">
                            Utang Pel <span class="badge badge-light">4</span>
                        </button>
                        <button type="button" class="btn btn-primary">
                            Bill aktif <span class="badge badge-light">4</span>
                        </button>
                        <button type="button" class="btn btn-primary">
                            Belum lunas <span class="badge badge-light">4</span>
                        </button>
                        @endif
                        <button type="button" class="btn btn-secondary">
                            Riwayat
                        </button>
                    </div>
                </div>
                <div class="bg-success d-flex w-100 " style="padding: 1px"></div>

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
                        <div class="d-flex ">
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
                                            <div class="" style="font-size: 20px">
                                                Total Pembayaran
                                            </div>
                                            <div class="" style="font-size: 35px">
                                                @uang($total_pembayaran)
                                            </div>
                                        </b>
                                    </span>
                                </div>
                                <div class="mt-2 d-flex justify-content-end align-items-end">
                                    <button wire:click="resetKasir" type="button" class="btn btn-danger ml-1">Reset</button>
                                    {{-- <button type="button" class="btn btn-info ml-1">Simpan bill</button> --}}


                                    {{-- @if($pelanggan_piutang_usaha <= 100000)
                                    @if ($total_pembayaran <= 100000)
                                    <button type="button" class="btn btn-warning">Bayar nanti</button>
                                        @endif
                                        @endif --}}


                                        {{-- <button type="button" class="btn btn-primary ml-1">Bayar nonTunai</button> --}}
                                        <button wire:click='bayar_tunai_toggle()' type="button" class="btn btn-success ml-1" data-toggle="modal" data-target="#bayar_tunai" data-backdrop="static" data-keyboard="false">Bayar tunai</button>

                                </div>
                            </div>
                        </div>
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
                                    <tr>
                                        <td>{{ $data->produk->nama }}
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
                                            <a wire:click="ubahharga_toggle('{{ $data->id }}')" data-toggle="modal" data-target="#ubahharga" data-backdrop="static" data-keyboard="false" type="button" class="btn border rounded  form-control form-control-sm ">
                                                @uang($data->harga_jual)
                                            </a>
                                        </td>
                                        <td>
                                            @uang($data->potongan_diskon)
                                        </td>
                                        <td>
                                            @uang($data->total_harga)
                                            <div class="text-muted" style="font-size: 10px">@uang($data->untung)</div>
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
                                    <tr>
                                        <td>{{ $data->produk->nama }}
                                            <div class="">{{ $data->produk->merek != null ? $data->produk->merek->nama : '' }}</div>
                                        </td>
                                        <td>
                                            <a wire:click="editItem('{{ $data->id }}')" type="button" class="btn border rounded  form-control form-control-sm ">{{ $data->qty }}
                                                <span class="ml-1">
                                                    {{ $data->satuan->satuan }}
                                                </span>
                                            </a>

                                        </td>
                                        <td>
                                            <a wire:click="ubahharga_toggle('{{ $data->id }}')" data-toggle="modal" data-target="#ubahharga" data-backdrop="static" data-keyboard="false" type="button" class="btn border rounded  form-control form-control-sm ">
                                                @uang($data->harga_jual)
                                            </a>
                                        </td>
                                        <td>
                                            @uang($data->potongan_diskon)
                                        </td>
                                        <td>
                                            @uang($data->total_harga)
                                            <div class="text-muted" style="font-size: 10px">@uang($data->untung)</div>
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
                    <div class="">
                        <div class="card mb-2 bg-primary shadow-none">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="">
                                        <b>Total Pembayaran</b>
                                    </div>
                                    <div class="" style="font-size: 20px">
                                        <b>@uang($total_pembayaran)</b>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @if ($total_pembayaran != 0)
                        <div class="d-flex flex-wrap mb-2">
                            <button type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', {{ $total_pembayaran }})">Uang Pas</button>
                            @if($total_pembayaran <= 10000) <button type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 10000)">@uang(10000)</button>
                            @endif
                            @if($total_pembayaran <= 20000) <button type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 20000)">@uang(20000)</button>
                            @endif
                            @if($total_pembayaran <= 50000) <button type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 50000)">@uang(50000)</button>
                                @endif
                                @if($total_pembayaran <= 100000) <button type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 100000)">@uang(100000)</button>
                                @endif
                                @if($total_pembayaran <= 150000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 150000)">@uang(150000)</button>
                                @endif
                                @if($total_pembayaran <= 200000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 200000)">@uang(200000)</button>
                                @endif
                                @if($total_pembayaran <= 250000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 250000)">@uang(250000)</button>
                                @endif
                                @if($total_pembayaran <= 300000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 300000)">@uang(300000)</button>
                                @endif

                                @if($total_pembayaran <= 400000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 400000)">@uang(400000)</button>
                                @endif

                                @if($total_pembayaran <= 500000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 500000)">@uang(500000)</button>
                                @endif
                                @if($total_pembayaran <= 600000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 600000)">@uang(600000)</button>
                                @endif
                                @if($total_pembayaran <= 800000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 800000)">@uang(800000)</button>
                                @endif
                                @if($total_pembayaran <= 1000000) <button  type="button" class="btn btn-info mr-2 mb-2" wire:click="$set('diterima', 1000000)">@uang(1000000)</button>
                                @endif



                        </div>
                        <div class="card mb-2 bg-secondary shadow-none">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="">
                                        <b>Diterima</b> @uang($diterima != null ? $diterima : 0)
                                    </div>
                                    <div class="" style="font-size: 20px">
                                        <input min="{{ $total_pembayaran }}" wire:model="diterima" type="number" class="" placeholder="Rp...">
                                    </div>
                                </div>
                            </div>
                        </div>
                       @if($total_pembayaran < $diterima)
                       <div class="card mb-2 bg-secondary shadow-none">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="">
                                    <b>Kembali</b>
                                </div>
                                <div class="">
                                    @uang($kembali != null ? $kembali : 0)
                                </div>
                            </div>
                        </div>
                    </div>

                       @endif

                    @endif

                        <div class="mt-2">
                            <div class="d-flex">
                                <button type="button" wire:click='bayar_tunai_cetak_struk()'   class="btn btn-primary form-control mr-1">Simpan dan cetak struk</button>
                                <button type="button" wire:click='bayar_tunai_cetak_nota()'  class="btn btn-info form-control ml-1">Simpan dan cetak Nota</button>
                            </div>
                            <button type="button"  wire:click='bayar_tunai()' class="btn btn-warning mt-2 form-control">Simpan (tanpa cetak struk)</button>
                            {{-- <a type="button" href="{{ url('struk') }}" class="btn btn-warning mt-2 form-control">cetak</a> --}}
                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button wire:click="bayar_tunai_close()" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
            popupCenter(url, title, 1000, 800);
        }

        function popupCenter(url, title, w, h) {
            var left = (screen.width ) ;
            var top = (screen.height ) ;
            var myWindow = window.open(url, title,
            'resizable=yes, width=' + w + ', height=' + h + ', top='
            + top + ', left=' + left);
        }


</script>

@endpush