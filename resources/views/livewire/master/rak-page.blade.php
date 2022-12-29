<div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">rak</h1>

                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active">rak</li>
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
                                        <label for="nama">Nama <span class="text-danger">*wajib</span></label>
                                        <input autofocus='true' required wire:model='nama' type="text" class="form-control" placeholder="Nama">
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
                                <form wire:submit.prevent='simpan'  >
                                    <div class="mb-1">
                                        <label for="nama">Nama <span class="text-danger">*wajib</span></label>
                                        <input autofocus='true' required wire:model='nama' type="text" class="form-control" placeholder="Nama">
                                    </div>
                                    <div class="mb-1">
                                        <label for="keterangan">Keterangan</label>
                                        <input wire:model='keterangan' type="text" class="form-control" placeholder="Keterangan">
                                    </div>
                                    <button  type="submit" class="btn mb-1 mt-1 btn-success rounded-pill form-control">Simpan</button>
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
                                <h3 class="card-title">rak</h3>
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
                                            <th>rak</th>
                                            <th>Keterangan</th>
                                            <th>status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($raks as $data)
                                        <tr>
                                            <td>{{ $data->nama }}
                                            </td>
                                            <td>{{ $data->keterangan }}</td>
                                            <td>
                                                <button wire:click="editPage('{{ $data->id }}')" type="button" class="btn btn-sm btn-warning rounded-pill px-3">Ubah</button>
                                                <button
                                                onclick="confirm('Ini akan menghapus catalog di produk item jg') || event.stopImmediatePropagation()"
                                                wire:click="hapus('{{ $data->id }}')" type="button" class="btn btn-sm btn-danger rounded-pill px-3">Hapus</button>
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
