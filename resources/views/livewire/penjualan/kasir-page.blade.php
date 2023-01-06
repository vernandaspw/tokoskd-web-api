<div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Pilih kasir</h1>

                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active">kasir</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="mb-3">
                    @if($createPage)
                    @else
                    <button class="btn btn-primary" wire:click='createPage()'>Buat kasir baru</button>
                    @endif
                </div>

                @if($createPage)
                <div class="col-md-3">
                    <div class="">Buat kasir baru</div>
                    <form wire:submit.prevent='create()'>
                        <div class="">
                            <div class="mb-1">
                                <label class="mb-0 mt-1" for="keterangan">nama</label>
                                <input autofocus wire:model='nama' type="text" class="form-control" placeholder="nama">
                            </div>
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <button type="button" class="btn btn-white" wire:click='createPage()'>Tutup</button>
                        </div>
                    </form>
                </div>
                @elseif($editPage)
                <div class="">
                    <div class="col-md-3">
                        <div class="">Edit kasir</div>
                        <form wire:submit.prevent='edit()'>
                            <div class="">
                                <div class="mb-1">
                                    <label class="mb-0 mt-1" for="keterangan">nama</label>
                                    <input autofocus wire:model='nama' type="text" class="form-control" placeholder="nama">
                                </div>
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <button type="button" class="btn btn-white" wire:click='editPageClose()'>Tutup</button>
                            </div>
                        </form>
                    </div>
                </div>
                @else
                <div class="">
                    <h5><b>Kasir aktif</b></h5>
                </div>
                <div class="mb-5 row">
                    @forelse ($kasiractive as $data)
                    <div class="col-xl-3 col-lg-4 col-md-5 col-6">
                        <div class="card bg-white">
                            <div class="card-header">
                                {{ $data->nama }}
                            </div>
                            <div class="card-body">
                                <div class="">

                                </div>
                                <div class="">
                                    @uang($data->kas->saldo)
                                </div>

                            </div>
                            <div class="card-footer">
                                <button class="btn btn-success">
                                    Buka
                                </button>
                                {{-- <button class="btn btn-warning">
                    Riwayat
                </button> --}}
                                <button class="btn btn-warning">
                                    Ubah
                                </button>
                                <button class="btn btn-info">
                                    Laporan
                                </button>
                                <button class="btn btn-secondary">
                                    View
                                </button>
                            </div>
                        </div>
                    </div>
                    @empty
                    Belum ada
                    @endforelse
                </div>

                <hr>

                <div class="mt-3">
                    <h5>
                        <b>Kasir Arsip (tidak digunakan)</b>
                    </h5>
                </div>
                <div class="row">
                    @forelse ($kasirdeactive as $data)
                    <div class="col-xl-3 col-lg-4 col-md-5 col-6">
                        <div class="card bg-white">
                            <div class="card-header">
                                {{ $data->nama }}
                            </div>
                            <div class="card-body">
                                <div class="">

                                </div>
                                <div class="">
                                    @uang($data->kas->saldo)
                                </div>

                            </div>
                            <div class="card-footer">
                                <button class="btn btn-success">
                                    Buka
                                </button>
                                {{-- <button class="btn btn-warning">
                    Riwayat
                </button> --}}
                                <button class="btn btn-warning">
                                    Ubah
                                </button>
                                <button class="btn btn-info">
                                    Laporan
                                </button>
                                <button class="btn btn-secondary">
                                    View
                                </button>
                            </div>
                        </div>
                    </div>
                    @empty
                    Belum ada
                    @endforelse
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
