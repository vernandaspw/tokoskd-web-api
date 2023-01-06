<div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Hutang usaha (hutang saya)</h1>

                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active">Hutang usaha</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <section class="content mb-3">
            <div class="container-fluid">
                {{-- @if($createPage)
                <a wire:click='createPage()' id="back-to-top" href="#" class="btn btn-danger rounded-circle back-to-top shadow" role="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                    </svg>
                </a>
                @else
                <a wire:click='createPage()' id="back-to-top" href="#" class="btn btn-primary rounded-circle back-to-top shadow" role="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                    </svg>
                </a>
                @endif --}}
                @if($createPage)
                {{-- <div class="col-md-3">
                    <h5>
                        <b>Buat hutang baru</b>
                    </h5>
                    <div class="">
                        <div class="mb-2">
                            <label class="mb-0"  for="">Pilih yang berhutang?</label>
                            <select class="form-control" wire:model='siapa' id="">
                                <option value="">Pilih</option>
                                <option value="pelanggan">Pelanggan</option>
                                <option value="supplier">Supplier</option>
                            </select>
                        </div>
                        @if($siapa == 'pelanggan')
                        <div class="">
                            <label class="mb-0" for="">Pilih pelanggan</label>
                            <select class="form-control" wire:model='pelanggan_id' id="">
                                <option value="">Pilih</option>
                            </select>
                        </div>
                        @endif
                        @if($siapa == 'supplier')
                        <div class="">
                            <label class="mb-0" for="">Pilih supplier</label>
                            <select class="form-control" wire:model='supplier_id' id="">
                                <option value="">Pilih</option>
                            </select>
                        </div>
                        @endif
                        <div class="">
                            <label class="mb-0" for="">Pilih supplier</label>
                            <select class="form-control" wire:model='supplier_id' id="">
                                <option value="">Pilih</option>
                            </select>
                        </div>
                    </div>

                </div> --}}
                @else
                <div class="row">
                    <div class="col-md-3">
                        <a href="{{ url('hutang/hutang-pelanggan') }}" class="card
                        @if($total_hutang_pelanggan == 0)
                        bg-success
                        @else
                        bg-danger
                        @endif
                        ">
                            <div class="card-header">
                                Total hutang ke pelanggan
                            </div>
                            <div class="card-body ">
                                <div class="d-flex justify-content-between">
                                    <div class="">
                                        {{ $jml_pelanggan }}
                                    </div>
                                    <div class="">
                                        @uang($total_hutang_pelanggan)
                                    </div>

                                </div>

                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ url('hutang/hutang-supplier', []) }}" class="card
                        @if($total_hutang_supplier == 0)
                        bg-success
                        @else
                        bg-danger
                        @endif
                        ">
                            <div class="card-header">
                                Total hutang ke supplier
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="">
                                        {{ $jml_supplier }}
                                    </div>
                                    <div class="">
                                        @uang($total_hutang_supplier)
                                    </div>
                                </div>

                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <div class="card
                       bg-white

                        ">
                            <div class="card-header">
                                Total hutang saya
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="">
                                        {{ $jml_supplier + $jml_pelanggan }}
                                    </div>
                                    <div class="">
                                        @uang($total_hutang_supplier + $total_hutang_pelanggan)
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data transaksi hutang</h3>
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
                            <table class="table  table-sm table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Pelanggan/Supplier</th>
                                        <th>Jenis</th>
                                        <th>Jumlah</th>
                                        <th>Keterangan</th>
                                        <th>Oleh</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hutang as $data)
                                    <tr>
                                        <td>{{ $data->id }}</td>
                                        <td>
                                            {{ $data->pelanggan ? $data->pelanggan->nama : '' }}
                                            {{ $data->supplier ? $data->supplier->nama : '' }}
                                        </td>
                                        <td>
                                            {{ $data->jenis }}
                                        </td>
                                        <td>
                                            @uang($data->jumlah)
                                        </td>
                                        <td>
                                            {{ $data->keterangan }}
                                        </td>
                                        <td>
                                            {{ $data->user ? $data->user->nama : '' }}
                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if($takeHutang <= $hutang->count())
                            <button type="button" class="mt-3 btn btn-info btn-block" wire:click='takeHutang()'>
                                Lanjut
                            </button>
                            @endif
                    </div>
                </div>
                @endif
            </div>
        </section>
    </div>
</div>


<style>
    .card-text {
        font-size: 14px;
    }

</style>
