<div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit produk</h1>

                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active">Edit produk</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content pb-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <form wire:submit.prevent='simpan'>
                                    <div class="mb-1">
                                        <label for="nama" class="mb-0 mt-1">Nama <span class="text-danger">*wajib</span></label>
                                        <input required wire:model='nama' type="text" class="form-control form-control-sm" placeholder="Nama">
                                    </div>
                                    <div class="mb-1">
                                        <label for="tipe" class="mb-0 mt-1">tipe <span class="text-danger">*wajib</span></label>
                                        <select required wire:model='tipe' id="tipe" class="form-control form-control-sm">
                                            <option value="">Pilih</option>
                                            <option value="INV">inventory</option>
                                            <option value="nonINV">non inventory</option>
                                            <option value="rakitan">rakitan</option>
                                            <option value="jasa">jasa</option>
                                        </select>
                                    </div>

                                    <div class="">
                                        <label for="merek_id" class="mb-0 mt-1">merek</label>
                                        <div class="input-group input-group-sm mb-2">
                                            <div class="input-group-prepend">
                                                <button wire:click="merek_toggle()" data-toggle="modal" data-target="#merek" id="button-merek" data-backdrop="static" data-keyboard="false" class="btn btn-outline-secondary" type="button">Ganti</button>
                                            </div>
                                            <input disabled value="{{ $merek_nama }}" type="text" class="form-control" aria-describedby="button-merek">
                                        </div>
                                        <!-- Modal-->
                                        <div class="modal fade show" data-backdrop='true' id="merek" tabindex="-1" aria-labelledby="merekabel" aria-hidden="true" @if($merek_show) style="display: block;" @endif>
                                            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="merekabel">Pilih merek</h5>
                                                        <button wire:click="merek_toggle()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="">
                                                            <input wire:model='merek_input' id="merekInput" placeholder="Cari merek.." class="form-control" type="text" autofocus>
                                                            <ul id="merekUL" class="mt-2">
                                                                @forelse ($merek as $data)
                                                                <li class="mt-2">
                                                                    <a href="#" class="li" wire:click="merek_id({{ $data->id }})" data-dismiss="modal">{{ $data->nama }}</a>
                                                                </li>
                                                                @empty
                                                                Tidak ditemukan
                                                                @endforelse
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button wire:click="merek_toggle()" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="">
                                        <label for="catalog_id" class="mb-0 mt-1">catalog</label>
                                        <div class="input-group input-group-sm mb-2">
                                            <div class="input-group-prepend">
                                                <button wire:click="catalog_toggle()" data-toggle="modal" data-target="#catalog" id="button-catalog" data-backdrop="static" data-keyboard="false" class="btn btn-outline-secondary" type="button">Ganti</button>
                                            </div>
                                            <input disabled value="{{ $catalog_nama }}" type="text" class="form-control" aria-describedby="button-catalog">
                                        </div>
                                        <!-- Modal-->
                                        <div class="modal fade show" data-backdrop='true' id="catalog" tabindex="-1" aria-labelledby="catalogabel" aria-hidden="true" @if($catalog_show) style="display: block;" @endif>
                                            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="catalogabel">Pilih catalog</h5>
                                                        <button wire:click="catalog_toggle()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="">
                                                            <input wire:model='catalog_input' id="catalogInput" placeholder="Cari catalog.." class="form-control" type="text" autofocus>
                                                            <ul id="catalogUL" class="mt-2">
                                                                @forelse ($catalog as $data)
                                                                <li class="mt-2">
                                                                    <a href="#" class="li" wire:click="catalog_id({{ $data->id }})" data-dismiss="modal">{{ $data->nama }}</a>
                                                                </li>
                                                                @empty
                                                                Tidak ditemukan
                                                                @endforelse
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button wire:click="catalog_toggle()" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="">
                                        <label for="kategori_id" class="mb-0 mt-1">kategori</label>
                                        <div class="input-group input-group-sm mb-2">
                                            <div class="input-group-prepend">
                                                <button wire:click="kategori_toggle()" data-toggle="modal" data-target="#kategori" id="button-kategori" data-backdrop="static" data-keyboard="false" class="btn btn-outline-secondary" type="button">Ganti</button>
                                            </div>
                                            <input disabled value="{{ $kategori_nama }}" type="text" class="form-control" aria-describedby="button-kategori">
                                        </div>
                                        <!-- Modal-->
                                        <div class="modal fade show" data-backdrop='true' id="kategori" tabindex="-1" aria-labelledby="kategoriabel" aria-hidden="true" @if($kategori_show) style="display: block;" @endif>
                                            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="kategoriabel">Pilih kategori</h5>
                                                        <button wire:click="kategori_toggle()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="">
                                                            <input wire:model='kategori_input' id="kategoriInput" placeholder="Cari kategori.." class="form-control" type="text" autofocus>
                                                            <ul id="kategoriUL" class="mt-2">
                                                                @forelse ($kategori as $data)
                                                                <li class="mt-2">
                                                                    <a href="#" class="li" wire:click="kategori_id({{ $data->id }})" data-dismiss="modal">{{ $data->nama }}</a>
                                                                </li>
                                                                @empty
                                                                Tidak ditemukan
                                                                @endforelse
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button wire:click="kategori_toggle()" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="">
                                        <label for="rak_id" class="mb-0 mt-1">rak</label>
                                        <div class="input-group input-group-sm mb-2">
                                            <div class="input-group-prepend">
                                                <button wire:click="rak_toggle()" data-toggle="modal" data-target="#rak" id="button-rak" data-backdrop="static" data-keyboard="false" class="btn btn-outline-secondary" type="button">Ganti</button>
                                            </div>
                                            <input disabled value="{{ $rak_nama }}" type="text" class="form-control" aria-describedby="button-rak">
                                        </div>
                                        <!-- Modal-->
                                        <div class="modal fade show" data-backdrop='true' id="rak" tabindex="-1" aria-labelledby="rakabel" aria-hidden="true" @if($rak_show) style="display: block;" @endif>
                                            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="rakabel">Pilih rak</h5>
                                                        <button wire:click="rak_toggle()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="">
                                                            <input wire:model='rak_input' id="rakInput" placeholder="Cari rak.." class="form-control" type="text" autofocus>
                                                            <ul id="rakUL" class="mt-2">
                                                                @forelse ($rak as $data)
                                                                <li class="mt-2">
                                                                    <a href="#" class="li" wire:click="rak_id({{ $data->id }})" data-dismiss="modal">{{ $data->nama }}</a>
                                                                </li>
                                                                @empty
                                                                Tidak ditemukan
                                                                @endforelse
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button wire:click="rak_toggle()" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-1">
                                        <label class="mb-0 mt-1" for="keterangan">Keterangan</label>
                                        <input wire:model='keterangan' type="text" class="form-control" placeholder="Keterangan">
                                    </div>

                                    <div class="">
                                        <label for="supplier_id" class="mb-0 mt-1">supplier</label>
                                        <div class="input-group input-group-sm mb-2">
                                            <div class="input-group-prepend">
                                                <button wire:click="supplier_toggle()" data-toggle="modal" data-target="#supplier" id="button-supplier" data-backdrop="static" data-keyboard="false" class="btn btn-outline-secondary" type="button">Ganti</button>
                                            </div>
                                            <input disabled value="{{ $supplier_nama }}" type="text" class="form-control" aria-describedby="button-supplier">
                                        </div>
                                        <!-- Modal-->
                                        <div class="modal fade show" data-backdrop='true' id="supplier" tabindex="-1" aria-labelledby="supplierabel" aria-hidden="true" @if($supplier_show) style="display: block;" @endif>
                                            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="supplierabel">Pilih supplier</h5>
                                                        <button wire:click="supplier_toggle()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="">
                                                            <input wire:model='supplier_input' id="supplierInput" placeholder="Cari supplier.." class="form-control" type="text" autofocus>
                                                            <ul id="supplierUL" class="mt-2">
                                                                @forelse ($supplier as $data)
                                                                <li class="mt-2">
                                                                    <a href="#" class="li" wire:click="supplier_id({{ $data->id }})" data-dismiss="modal">{{ $data->nama }}</a>
                                                                </li>
                                                                @empty
                                                                Tidak ditemukan
                                                                @endforelse
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button wire:click="supplier_toggle()" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    @if(($harga_jual == null ? 0 : $harga_jual) >= ($harga_pokok == null ? 0 : $harga_pokok))
                                    <button wire:click.prevent='simpanProduk()' type="button" class="btn mb-1 mt-1 btn-success rounded-pill form-control">Perbarui</button>
                                    <button wire:click.prevent='simpanBaru()' type="button" class="btn mb-1 mt-1 btn-success rounded-pill form-control">Simpan & buat baru</button>
                                    <button wire:click.prevent='simpanClose()' type="button" class="btn mb-1 mt-1 btn-success rounded-pill form-control">Simpan & kembali</button>
                                    {{-- <button wire:click.prevent='simpanEdit()' type="button" class="btn mb-1 mt-1 btn-success rounded-pill form-control">Simpan & Edit</button> --}}

                                    @else
                                    <button type="button" disabled class="btn mb-1 mt-1 btn-danger   rounded-pill form-control">Harga jual merugi</button>
                                    @endif
                                    <button type="reset" class="btn btn-secondary mb-3 rounded-pill form-control">Reset</button>
                                    <button type="button" wire:click="kembali()" class="btn btn-light rounded-pill form-control">Kembali</button>


                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-body">

                                <div class="mb-2 d-flex justify-content-between">
                                    <h5>Produk Item</h5>
                                    <div class="">
                                        @if($tambahItem)


                                        @else
                                        <button type="button" wire:click="tambahItem()" class="btn btn-success">Tambah item</button>
                                        @endif
                                    </div>
                                </div>
                                <div class="">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-sm table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Barcode</th>
                                                    <th>Satuan dasar</th>
                                                    <th>Satuan</th>
                                                    <th>Konversi</th>
                                                    <th>Harga pokok</th>
                                                    <th>Harga jual</th>
                                                    <td>Untung</td>
                                                    <td>Aksi</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($produkItems as $data)
                                                <tr>
                                                    <td>

                                                        <div class="">
                                                            {{ $data->barcode1 }}
                                                        </div>
                                                        <div class="">
                                                            {{ $data->barcode2 }}
                                                        </div>
                                                        <div class="">
                                                            {{ $data->barcode3 }}
                                                        </div>
                                                        <div class="">
                                                            {{ $data->barcode4 }}
                                                        </div>
                                                        <div class="">
                                                            {{ $data->barcode5 }}
                                                        </div>
                                                        <div class="">
                                                            {{ $data->barcode6 }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        {{ $data->satuan_dasar == true ? 'true' : 'false' }}
                                                    </td>

                                                    <td>
                                                        {{ $data->satuan != null ? $data->satuan->satuan : '' }}
                                                    </td>
                                                    <td>
                                                        {{ $data->konversi }}
                                                    </td>
                                                    <td>
                                                        @uang($data->harga_pokok)
                                                    </td>
                                                    <td>
                                                        @uang($data->harga_jual)
                                                    </td>
                                                    <td class="
                                                    @if($data->harga_jual > $data->harga_pokok)
                                                        text-success
                                                        @else
                                                        text-danger
                                                    @endif
                                                    ">
                                                        @uang($data->harga_jual - $data->harga_pokok)
                                                    </td>
                                                    <td>
                                                        <button type="button" wire:click="editItem('{{ $data->id }}')" class="btn btn-sm btn-warning rounded-pill px-3">Ubah</button>
                                                        <button onclick="confirm('Ini akan menghapus catalog di produk item jg') || event.stopImmediatePropagation()" wire:click="hapus('{{ $data->id }}')" type="button" class="btn btn-sm btn-danger rounded-pill px-3">Hapus</button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>


                        </div>
                        <div class="card mt-3">
                            <div class="card-body">
                                @if($editItem)
                                <div class="">
                                    <div class="">
                                        <b>
                                            <h5>Edit Item</h5>
                                        </b>
                                    </div>
                                    <div class="">
                                        <label for="" class="m-0">Barcode </label>
                                        <div class="">

                                            <input wire:model='barcode1' type="text" class="form-control form-control-sm" placeholder="barcode 1">
                                        </div>
                                        <div class="">
                                            <input wire:model='barcode2' type="text" class="form-control form-control-sm" placeholder="barcode 2">
                                        </div>
                                        <div class="">
                                            <input wire:model='barcode3' type="text" class="form-control form-control-sm" placeholder="barcode 3">
                                        </div>
                                        <div class="">
                                            <input wire:model='barcode4' type="text" class="form-control form-control-sm" placeholder="barcode 4">
                                        </div>
                                        <div class="">
                                            <input wire:model='barcode5' type="text" class="form-control form-control-sm" placeholder="barcode 5">
                                        </div>
                                        <div class="">
                                            <input wire:model='barcode6' type="text" class="form-control form-control-sm" placeholder="barcode 6">
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <label for="" class="m-0">Satuan</label>
                                        <select required id="satuan_id" wire:model='satuan_id' class="form-control form-control-sm">
                                            <option value="">Pilih</option>
                                            @foreach ($satuans as $data)
                                            <option value="{{ $data->id }}">{{ $data->satuan }}</option>
                                            @endforeach
                                        </select>
                                        <div class="text-muted" style="font-size: 13px">
                                            - item ini adalah item satuan paling dasar
                                            <div>- tambah item baru setelah klik simpan edit</div>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <label for="" class="m-0">Harga pokok : @uang($harga_pokok == null ? 0 : $harga_pokok)</label>

                                        <input wire:model='harga_pokok' type="number" class="form-control form-control-sm" placeholder="harga pokok..">
                                    </div>
                                    <div class="mt-2">
                                        <label for="" class="m-0">Harga jual : @uang($harga_jual == null ? 0 : $harga_jual)</label>
                                        <input wire:model='harga_jual' type="number" required class="form-control form-control-sm" placeholder="harga jual..">

                                    </div>
                                    <b>
                                        <div class="mt-2 mb-3">
                                            <div class="@if(($harga_jual  == null ? 0 : $harga_jual) - ($harga_pokok == null ? 0 : $harga_pokok) <= 0)
                                    text-danger
                                    @else
                                    text-success 
                                    @endif">Untung @uang(($harga_jual == null ? 0 : $harga_jual) - ($harga_pokok == null ? 0 : $harga_pokok))</div>
                                        </div>
                                    </b>


                                    <button type="button" wire:click="perbaruiItem()" class="mt-1 btn btn-success mb-2">Perbarui</button>
                                    <button type="button" wire:click="tutupEditItem()" class="mt-2 btn btn-white mb-2">Tutup</button>

                                </div>
                                @else
                                <div class="">
                                    @if($tambahItem)
                                    <div class="">
                                        <div class="">
                                            <b>
                                                <h5>Tambah Item</h5>
                                            </b>
                                        </div>
                                        <div class="">
                                            <label for="" class="m-0">Barcode </label>
                                            <div class="">

                                                <input wire:model='barcode1' type="text" class="form-control form-control-sm" placeholder="barcode 1">
                                            </div>
                                            <div class="">
                                                <input wire:model='barcode2' type="text" class="form-control form-control-sm" placeholder="barcode 2">
                                            </div>
                                            <div class="">
                                                <input wire:model='barcode3' type="text" class="form-control form-control-sm" placeholder="barcode 3">
                                            </div>
                                            <div class="">
                                                <input wire:model='barcode4' type="text" class="form-control form-control-sm" placeholder="barcode 4">
                                            </div>
                                            <div class="">
                                                <input wire:model='barcode5' type="text" class="form-control form-control-sm" placeholder="barcode 5">
                                            </div>
                                            <div class="">
                                                <input wire:model='barcode6' type="text" class="form-control form-control-sm" placeholder="barcode 6">
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <label for="" class="m-0">Satuan</label>
                                            <select required id="satuan_id" wire:model='satuan_id' class="form-control form-control-sm">
                                                <option value="">Pilih</option>
                                                @foreach ($satuans as $data)
                                                <option value="{{ $data->id }}">{{ $data->satuan }}</option>
                                                @endforeach
                                            </select>
                                            <div class="text-muted" style="font-size: 13px">
                                                - item ini adalah item satuan paling dasar
                                                <div>- tambah item baru setelah klik simpan edit</div>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <label for="" class="m-0">Harga pokok : @uang($harga_pokok == null ? 0 : $harga_pokok)</label>

                                            <input wire:model='harga_pokok' type="number" class="form-control form-control-sm" placeholder="harga pokok..">
                                        </div>
                                        <div class="mt-2">
                                            <label for="" class="m-0">Harga jual : @uang($harga_jual == null ? 0 : $harga_jual)</label>
                                            <input wire:model='harga_jual' type="number" required class="form-control form-control-sm" placeholder="harga jual..">

                                        </div>
                                        <b>
                                            <div class="mt-2 mb-3">
                                                <div class="@if(($harga_jual  == null ? 0 : $harga_jual) - ($harga_pokok == null ? 0 : $harga_pokok) <= 0)
                                            text-danger
                                            @else
                                            text-success 
                                            @endif">Untung @uang(($harga_jual == null ? 0 : $harga_jual) - ($harga_pokok == null ? 0 : $harga_pokok))</div>
                                            </div>
                                        </b>


                                        <button type="button" wire:click="tutupTambahItem()" class="mt-1 btn btn-danger mb-2">Tutup</button>
                                    </div>

                                    @endif
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>






        </section>
    </div>
</div>


<style>
    .card-text {
        font-size: 14px;
    }

</style>

@push('script')
<script>
    $('#merek').modal('show')

</script>
@endpush
