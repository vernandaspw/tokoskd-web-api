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
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Produk</th>
                                            <th>Tipe</th>
                                            <th>Satuan</th>
                                            <th>Merek</th>
                                            <th>Catalog</th>
                                            <th>Kategori</th>
                                            <th>Rak</th>
                                            <th>Supplier</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($produks as $data)
                                        <tr>
                                            <td>
                                                {{ $data->nama }}</td>
                                            <td>{{ $data->tipe }}</td>
                                            <td>@foreach ($data->produk_item as $item)
                                                {{ $item->satuan->satuan }}
                                                @endforeach
                                            </td>
                                            <td>
                                                {{ $data->merek != null ? $data->merek->nama : '' }}
                                            </td>
                                            <td>
                                                {{ $data->catalog != null ? $data->catalog->nama : '' }}
                                            </td>
                                            <td>
                                                {{ $data->kategori != null ? $data->kategori->nama : '' }}
                                            </td>
                                            <td>
                                                {{ $data->rak != null ? $data->rak->nama : '' }}
                                            </td>
                                            <td>
                                                {{ $data->supplier != null ? $data->supplier->nama : '' }}
                                            </td>
                                            <td>
                                                <a href="{{ url('produk/produk-edit?url=produk/produk-satuan') }}" type="button" class="btn btn-sm btn-warning rounded-pill px-3">Ubah</a>
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
            </div>
        </section>
    </div>
</div>


<style>
    .card-text {
        font-size: 14px;
    }

</style>
