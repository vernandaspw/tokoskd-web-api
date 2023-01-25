<div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Produk Stok</h1>

                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active">Kategori</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="mb-2">
                    @if ($tambahPage)
                    @else
                    <button type="button" wire:click="tambahPage()" class="btn btn-primary rounded-pill">
                        Tambah
                    </button>
                    @endif
                </div>

                @if ($editPage)
                <div class="row">
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <form wire:submit.prevent='edit' onkeydown="return event.key != 'Enter';">
                                    <div class="mb-1">
                                        <label for="catalog">Nama <span class="text-danger">*wajib</span></label>
                                        <select required class="form-control" wire:model='catalog' id="catalog">
                                            <option value="">Pilih</option>
                                            @foreach ($catalogs as $data)
                                            <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label for="nama">Nama <span class="text-danger">*wajib</span></label>
                                        <input required wire:model='nama' type="text" class="form-control" placeholder="Nama">
                                    </div>
                                    <div class="mb-1">
                                        <label for="keterangan">Keterangan</label>
                                        <input wire:model='keterangan' type="text" class="form-control" placeholder="Keterangan">
                                    </div>



                                    <button type="submit" class="btn mb-1 mt-1 btn-success rounded-pill form-control">Simpan</button>
                                    <button type="button" wire:click="editPageClose()" class="btn btn-light rounded-pill form-control">Tutup</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                @if ($tambahPage)
                <div class="row">
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <form wire:submit.prevent='simpan'>
                                    <div class="mb-1">
                                        <label for="catalog">Nama <span class="text-danger">*wajib</span></label>
                                        <select required class="form-control" wire:model='catalog' id="catalog">
                                            <option value="">Pilih</option>
                                            @foreach ($catalogs as $data)
                                            <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label for="nama">Nama <span class="text-danger">*wajib</span></label>
                                        <input required wire:model='nama' type="text" class="form-control" placeholder="Nama">
                                    </div>
                                    <div class="mb-1">
                                        <label for="keterangan">Keterangan</label>
                                        <input wire:model='keterangan' type="text" class="form-control" placeholder="Keterangan">
                                    </div>
                                    <button type="submit" class="btn mb-1 mt-1 btn-success rounded-pill form-control">Simpan</button>
                                    <button type="button" wire:click="tambahPage()" class="btn btn-light rounded-pill form-control">Tutup</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <div class="row">
                    (incoming : filter)
                </div>
                <div class="row">
                    @if($masuk_show)
                    <div class="col-md-4">
                        <div class="card ">
                            <div class="card-header bg-success">
                                <b>
                                    <h5>Stok masuk</h5>
                                </b>
                            </div>
                            <div class="card-body pb-5">
                                <div class="">
                                    <form wire:submit.prevent='simpanMasuk'>
                                        <div class="">
                                            Produk : {{ $namaProduk }}
                                        </div>
                                        <div class="">
                                            Stok beli/akan datane : {{ $stokBeli }} {{ $satuanNama }}
                                        </div>
                                        <div class="">
                                            Stok buku : {{ $stokBuku }} {{ $satuanNama }}
                                        </div>
                                        <div class="mb-1">
                                            <label for="" class="mb-0">Pilih kategori</label>
                                            <select required class="form-control form-control-sm" wire:model='stok_kategori_id' id="">
                                                <option value="">Pilih</option>
                                                @foreach ($stok_kategori as $data)
                                                <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-1">
                                            <label for="" class="m-0">Jumlah</label>
                                            <input required type="number" placeholder="jumlah stok" wire:model='jumlahstok' class="form-control form-control-sm">
                                        </div>
                                        <div class="mt-2">
                                            <label for="" class="m-0">catatan</label>
                                            <input type="text" placeholder="(optional)" wire:model='catatan' class="form-control form-control-sm">
                                        </div>

                                        <div class="form-check mt-1">
                                            <input wire:model='perlu_ubah_harga' class="form-check-input" type="checkbox" value="" id="ubahharga">
                                            <label class="form-check-label" for="ubahharga">
                                                Ingatkan untuk ubah harga
                                            </label>
                                        </div>
                                        @if($perlu_ubah_harga)
                                        <div class="">
                                            <label class="m-0" for="">Harga pokok saat ini : @uang($harga_pokok)</label>
                                        </div>
                                        
                                        <div class="mb-1">
                                            <label for="" class="m-0">Harga beli baru</label>
                                            <input placeholder="(optional)" type="number" class="form-control form-control-sm" wire:model='harga_pokok_akhir'>
                                        </div>
                                        <div class="">
                                            <label class="m-0" for="">Harga jual saat ini : @uang($harga_jual)</label>
                                        </div>
                                        <div class="">
                                            <label for="" class="m-0">Harga jual baru</label>
                                            <input placeholder="(optional)" type="number" class="form-control form-control-sm" wire:model='harga_jual_akhir'>
                                        </div>
                                        @endif





                                        <button type="submit" class="btn btn-success form-control mt-3">Simpan</button>
                                        <button wire:click='masukTutup()' type="button" class="btn mt-1 btn-secondary form-control">Kembali</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @elseif($keluar_show)
                    <div class="col-md-4">
                        <div class="card ">
                            <div class="card-header bg-danger">
                                <b>
                                    <h5>Stok keluar</h5>
                                </b>
                            </div>
                            <div class="card-body pb-5">
                                <div class="">
                                    <form wire:submit.prevent='simpanKeluar'>
                                        <div class="">
                                            Produk : {{ $namaProduk }}
                                        </div>
                                        <div class="">
                                            Stok beli/akan datane : {{ $stokBeli }} {{ $satuanNama }}
                                        </div>
                                        <div class="">
                                            Stok buku : {{ $stokBuku }} {{ $satuanNama }}
                                        </div>
                                        <div class="mb-1">
                                            <label for="" class="mb-0">Pilih kategori</label>
                                            <select required class="form-control form-control-sm" wire:model='stok_kategori_id' id="">
                                                <option value="">Pilih</option>
                                                @foreach ($stok_kategori as $data)
                                                <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-1">
                                            <label for="" class="m-0">Jumlah</label>
                                            <input required type="number" placeholder="jumlah stok" wire:model='jumlahstok' class="form-control form-control-sm">
                                        </div>
                                        <div class="mt-2">
                                            <label for="" class="m-0">catatan</label>
                                            <input type="text" placeholder="(optional)" wire:model='catatan' class="form-control form-control-sm">
                                        </div>

                                        <button type="submit" class="btn btn-success form-control mt-3">Simpan</button>
                                        <button wire:click='keluarTutup()' type="button" class="btn mt-1 btn-secondary form-control">Kembali</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @elseif($revisi_show)
                    <div class="col-md-4">
                        <div class="card ">
                            <div class="card-header bg-warning">
                                <b>
                                    <h5>Stok Revisi</h5>
                                </b>
                            </div>
                            <div class="card-body pb-5">
                                <div class="">
                                    <form wire:submit.prevent='simpanRevisi'>
                                        <div class="">
                                            Produk : {{ $namaProduk }}
                                        </div>
                                        <div class="">
                                            Stok beli/akan datane : {{ $stokBeli }} {{ $satuanNama }}
                                        </div>
                                        <div class="">
                                            Stok buku : {{ $stokBuku }} {{ $satuanNama }}
                                        </div>
                                        <div class="mb-1">
                                            <label for="" class="m-0">Jumlah stok saat ini</label>
                                            <input required type="number" placeholder="jumlah stok" wire:model='jumlahstok' class="form-control form-control-sm">
                                        </div>
                                        <div class="mt-2">
                                            <label for="" class="m-0">catatan</label>
                                            <input type="text" placeholder="(optional)" wire:model='catatan' class="form-control form-control-sm">
                                        </div>

                                        <button type="submit" class="btn btn-success form-control mt-3">Simpan</button>
                                        <button wire:click='revisiTutup()' type="button" class="btn mt-1 btn-secondary form-control">Kembali</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data produk item</h3>
                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" wire:model='produkNama' class="form-control float-right" placeholder="Search">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body table-responsive p-0">
                                <table class="table table-sm table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Produk</th>
                                            <th>Tipe</th>


                                            <th>konversi</th>
                                            <th>Stok minimum</th>
                                            <th>Stok beli (incoming)</th>
                                            <th>Stok terjual</th>
                                            <th>Stok siap jual</th>
                                            <th>Stok buku</th>
                                            <th>Satuan</th>
                                            <th>Stok Opname</th>

                                            <th>SO terakhir</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($produkItems as $data)
                                        @if($opnameID == $data->id)
                                        <tr>
                                            <td>
                                                <a href="">
                                                    <img src="{{ Storage::url($data->img) }}" width="60" alt="">
                                                </a>
                                                {{ $data->produk->nama }}

                                            </td>
                                            <td>
                                                {{ $data->produk->tipe }}
                                            </td>


                                            <td>{{ $data->konversi }}</td>
                                            <td>
                                                {{ $data->stok_minimum }}
                                            </td>
                                            <td>
                                                {{ $data->stok_beli }}
                                            </td>
                                            <td>
                                                {{ $data->stok_terjual }}
                                            </td>
                                            <td>
                                                {{ $data->stok_jual }}
                                            </td>
                                            <td>
                                                {{ $data->stok_buku }}
                                            </td>
                                            <td>
                                                {{ $data->satuan->satuan }}
                                            </td>
                                            <td>
                                                {{-- <button wire:click="opnameShow('{{ $data->id }}')" type="button" class="btn btn-sm btn-secondary">Opname</button> --}}
                                                <div class="d-flex align-items-center">
                                                    <form wire:submit.prevent="simpanOpname('{{ $data->id }}')">
                                                        <input wire:model='opname_stok_fisik' type="number" class="form-control-sm" placeholder="stok akhir/fisik" style="width: 124px">
                                                        <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                                                    </form>
                                                </div>
                                            </td>
                                            <td>
                                                @if($data->opname_at)
                                                {{ \Carbon\Carbon::parse($data->opname_at)->isoFormat('D MMMM Y, HH:mm') }} - {{ \Carbon\Carbon::parse($data->opname_at)->diffForHumans() }}
                                                @endif
                                            </td>
                                            <td>
                                                {{-- <a href="{{ url('produk/produk-stok-detail', $data->id) }}" type="button" class="btn btn-sm btn-info rounded-pill px-3">Detail</a> --}}
                                                <button wire:click="masuk_toggle('{{ $data->id }}')" type="button" class="btn btn-sm btn-success rounded-pill px-3">Masuk</button>
                                                <button wire:click="keluar_toggle('{{ $data->id }}')" type="button" class="btn btn-sm btn-danger rounded-pill px-3">Keluar</button>
                                                <button wire:click="revisi_toggle('{{ $data->id }}')" type="button" class="btn btn-sm btn-warning rounded-pill px-3">Revisi</button>
                                            </td>
                                        </tr>
                                        @else
                                        <tr>
                                            <td>
                                                <a href="">
                                                    <img src="{{ Storage::url($data->img) }}" width="60" alt="">
                                                </a>
                                                {{ $data->produk->nama }}

                                            </td>
                                            <td>
                                                {{ $data->produk->tipe }}
                                            </td>


                                            <td>{{ $data->konversi }}</td>
                                            <td>
                                                {{ $data->stok_minimum }}
                                            </td>
                                            <td>
                                                {{ $data->stok_beli }}
                                            </td>
                                            <td>
                                                {{ $data->stok_terjual }}
                                            </td>
                                            <td>
                                                {{ $data->stok_jual }}
                                            </td>
                                            <td>
                                                {{ $data->stok_buku }}
                                            </td>
                                            <td>
                                                {{ $data->satuan->satuan }}
                                            </td>
                                            <td>
                                                <button wire:click="opnameShow('{{ $data->id }}')" type="button" class="btn btn-sm rounded-pill btn-secondary">Opname</button>
                                                {{-- <div class="d-flex align-items-center">
                <form wire:submit.prevent='simpanOpname'>
                    <input type="number" class="form-control-sm" placeholder="stok akhir" style="width: 100px">
                    <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                </form>
            </div> --}}
                                            </td>
                                            <td>
                                                @if($data->opname_at)
                                                {{ \Carbon\Carbon::parse($data->opname_at)->isoFormat('D MMMM Y, HH:mm') }} - {{ \Carbon\Carbon::parse($data->opname_at)->diffForHumans() }}
                                                @endif
                                            </td>
                                            <td>
                                                {{-- <a href="{{ url('produk/produk-stok-detail', $data->id) }}" type="button" class="btn btn-sm btn-info rounded-pill px-3">Detail</a> --}}
                                                <button wire:click="masuk_toggle('{{ $data->id }}')" type="button" class="btn btn-sm btn-success rounded-pill px-3">Masuk</button>
                                                <button wire:click="keluar_toggle('{{ $data->id }}')" type="button" class="btn btn-sm btn-danger rounded-pill px-3">Keluar</button>
                                                <button wire:click="revisi_toggle('{{ $data->id }}')" type="button" class="btn btn-sm btn-warning rounded-pill px-3">Revisi</button>
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
                    @endif
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
