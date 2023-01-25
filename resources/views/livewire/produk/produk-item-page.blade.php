<div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Produk satuan</h1>

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
                    <a href="{{ url('produk/produk-create?url=produk/produk-satuan') }}" class="btn btn-primary rounded-pill">
                        Tambah
                    </a>
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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data</h3>
                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
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
                                            <th>Produk item</th>
                                            <th>Tipe</th>
                                            <th>Merek</th>
                                            <th>Catalog</th>
                                            <th>Kategori</th>
                                            <th>Rak</th>

                                            <th>Satuan</th>
                                            <th>Konversi</th>
                                            <th>Harga pokok</th>
                                            <th>Harga jual</th>
                                            <td>Untung</td>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($produkItems as $data)
                                        <tr>
                                            <td>
                                                <a href="">
                                                    <img src="{{ Storage::url($data->img) }}" width="60" alt="">
                                                </a>
                                                {{ $data->produk->nama }}</td>
                                            <td>{{ $data->produk->tipe }}</td>
                                            <td>

                                                {{ $data->produk->merek != null ? $data->produk->merek->nama : ''  }}
                                            </td>
                                            <td>
                                                {{ $data->produk->catalog != null ? $data->produk->catalog->nama : '' }}
                                            </td>
                                            <td>
                                                {{ $data->produk->kategori != null ? $data->produk->kategori->nama : '' }}
                                            </td>
                                            <td>
                                                {{ $data->produk->rak != null ? $data->produk->rak->nama : '' }}
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
                                                <a href="{{ url('produk/produk-edit/'. $data->produk->id  .'?url=produk/produk-item') }}" class="btn btn-sm btn-warning rounded-pill px-3">Ubah</a>
                                                <button onclick="confirm('Ini akan menghapus catalog di produk item jg') || event.stopImmediatePropagation()" wire:click="hapus('{{ $data->id }}')" type="button" class="btn btn-sm btn-danger rounded-pill px-3">Hapus</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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
