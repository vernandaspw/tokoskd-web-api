<div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Produk Stok detail</h1>

                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active">Produk stok detail</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="mb-2">
                </div>

                <div class="">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="">
                                    <div class="">
                                        {{ $produk->produk->nama }}
                                    </div>
                                    <div class="">
                                        {{ $produk->satuan->satuan }}
                                    </div>
                                </div>
                                <div class="">
                                    <button type="button" wire:click='editProduk'>Ubah</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="">
                       
                    </div>
                </div>

                <div class="row">
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
                                            <th>Jenis</th>
                                            <th>Kategori</th>
                                            <th>Jumlah</th>
                                            <th>Catatan</th>
                                            <th>tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($stoktransaksi as $data)
                                        <tr>
                                            <td>
                                                <a href="">
                                                    <img src="{{ Storage::url($data->img) }}" width="60" alt="">
                                                </a>
                                                {{ $data->produk->nama }}

                                            </td>
                                            <td>
                                                {{ $data->jenis->nama }}
                                            </td>

                                            <td>
                                                {{ $data->kategori->nama }}
                                            </td>
                                            <td>
                                                {{ $data->jumlah }}
                                            </td>
                                            <td>
                                                {{ $data->catatan }}
                                            </td>
                                            <td>
                                                @if($data->created_at)
                                                {{ \Carbon\Carbon::parse($data->created_at)->isoFormat('D MMMM Y, HH:mm') }} - {{ \Carbon\Carbon::parse($data->created_at)->diffForHumans() }}
                                                @endif
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
