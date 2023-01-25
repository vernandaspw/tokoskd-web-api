<div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Kas</h1>

                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active">Kas</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content mb-3">
            <div class="container-fluid">
                <div class="mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="">
                            @if ($tambahPage)
                            @else
                            <button type="button" wire:click="tambahPage()" class="btn btn-primary rounded-pill">
                                Buat kas
                            </button>
                            @endif
                        </div>
                        <div class="">
                            <a href="{{ url('kas/kas-transaksi', []) }}" class="btn btn-primary rounded-pill">
                                Buat transaksi
                            </a>
                            {{-- <button type="button" wire:click="tambahPage()" class="btn btn-success rounded-pill">
                                Masuk
                            </button>
                            <button type="button" wire:click="tambahPage()" class="btn btn-danger rounded-pill">
                                Keluar
                            </button>
                            <button type="button" wire:click="tambahPage()" class="btn btn-info rounded-pill">
                                Transfer (alokasi)
                            </button> --}}
                        </div>
                    </div>
                </div>

                {{-- @if ($editPage)
                <div class="row">
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <form wire:submit.prevent='edit'>
                                    <div class="mb-1">
                                        <label for="nama">Nama</label>
                                        <input wire:model='nama' required type="text" class="form-control" placeholder="Nama">
                                    </div>
                                    <div class="mb-1">
                                        <label for="phone">Nomor hp</label>
                                        <input wire:model='phone' required type="tel" class="form-control" placeholder="phone">
                                    </div>
                                    <div class="mb-1">
                                        <label for="email">email</label>
                                        <input autocomplete="off" wire:model='email' type="email" class="form-control" placeholder="email">
                                    </div>
                                    <div class="mb-1">
                                        <label for="password">Password</label>
                                        <input autocomplete="off" wire:model='password' type="password" class="form-control" placeholder="password">
                                    </div>
                                    <div class="mb-1">
                                        <label for="role">Role</label>
                                        <select wire:model='role' id="role" class="form-control">
                                            <option value="">Pilih</option>
                                            <option value="admin">Admin</option>
                                            <option value="kepala toko">Kepala toko</option>
                                            <option value="staff">Staff</option>
                                            <option value="checker">Checker</option>
                                            <option value="kasir">kasir</option>
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label for="status">Status</label>
                                        <select wire:model='isaktif' required id="status" class="form-control">
                                            <option value="">Pilih</option>
                                            <option value="1">aktif</option>
                                            <option value="0">tidak aktif</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn mb-1 mt-1 btn-success rounded-pill form-control">Simpan</button>
                                    <button type="button" wire:click="editPageClose()" class="btn btn-light rounded-pill form-control">Tutup</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @else --}}
                @if ($tambahPage)
                <div class="row">
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <form wire:submit.prevent='simpan'>
                                    <h5><b>Buat kas</b></h5>
                                    <div class="mb-1">
                                        <label for="nama">urut</label>
                                        <input wire:model='no' type="text" class="form-control" placeholder="no">
                                    </div>
                                    <div class="mb-1">
                                        <label for="tipe">Tipe</label>
                                        <select wire:model='tipe' required id="tipe" class="form-control">
                                            <option value="">Pilih</option>
                                            <option value="tunai">tunai</option>
                                            <option value="bank">bank</option>
                                            <option value="ewallet">ewallet</option>
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label for="nama">nama</label>
                                        <input wire:model='nama' required type="text" class="form-control" placeholder="nama">
                                    </div>

                                    <div class="mb-1">
                                        <label for="saldo">saldo</label>
                                        <input wire:model='saldo' type="number" class="form-control" placeholder="saldo">
                                    </div>

                                    <div class="mb-1">
                                        <label for="bank">bank</label>
                                        <input wire:model='bank' type="text" class="form-control" placeholder="bank">
                                    </div>
                                    <div class="mb-1">
                                        <label for="norek">Nomor rekening</label>
                                        <input wire:model='norek' type="text" class="form-control" placeholder="norek">
                                    </div>
                                    <div class="mb-1">
                                        <label for="an">Atas nama</label>
                                        <input wire:model='an' type="text" class="form-control" placeholder="an">
                                    </div>


                                    <button type="submit" class="btn mb-1 mt-1 btn-success  rounded-pill form-control">Simpan</button>
                                    <button type="button" wire:click="tambahPage()" class="btn btn-light rounded-pill form-control">Tutup</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="mt-3">
                    <b>Kas Tunai</b>
                </div>
                <div class="row mt-3">

                    @foreach ($kasTunai as $data)
                    <div class="col-xl-3 col-lg-4 col-md-5 col-6">
                        <a href="{{ url('kas/kas', $data->id) }}" class="card bg-white">
                            <div class="card-body">
                                <div class="">{{ $data->no == null ? 0 : $data->no . '.' }} {{ $data->nama }}
                                </div>
                                <div class="">@uang($data->saldo)</div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                <hr>
                <div class="">
                    <b>Kas Tunai dikasir</b>
                </div>
                <div class="row mt-3">
                    @foreach ($kasTunaiKasir as $data)
                    <div class="col-xl-3 col-lg-4 col-md-5 col-6">
                        <a href="{{ url('kas/kas', $data->id) }}" class="card bg-white">
                            <div class="card-body">

                                <div class="">{{ $data->no == null ? 0 : $data->no . '.' }} {{ $data->nama }}
                                </div>
                                <div class="">@uang($data->saldo)</div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                <hr>
                <div class="">
                    <b>Kas Bank</b>
                </div>
                <div class="row mt-3">
                    @foreach ($kasBank as $data)
                    <div class="col-xl-3 col-lg-4 col-md-5 col-6">
                        <a href="{{ url('kas/kas', $data->id) }}" class="card bg-white">
                            <div class="card-body">
                                <div class="">{{ $data->no == null ? 0 : $data->no . '.' }} {{ $data->nama }}
                                </div>
                                <div class="">@uang($data->saldo)</div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                <hr>
                <div class="">
                    <b>Kas e-Wallet</b>
                </div>
                <div class="row mt-3">
                    @foreach ($kasEwallet as $data)
                    <div class="col-xl-3 col-lg-4 col-md-5 col-6">
                        <a href="{{ url('kas/kas', $data->id) }}" class="card text-white bg-success">
                            <div class="card-body">
                                <div class="">{{ $data->no == null ? 0 : $data->no }}</div>
                                <div class="">{{ $data->nama }}</div>
                                <div class="">@uang($data->saldo)</div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                {{-- @endif --}}




                <hr>
                <div class="mt-1">
                    <div class="">
                        <b>Semua transaksi</b>
                    </div>
                    <div class="mt-2">
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
                                        <table class="table  table-sm table-hover text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>KAS</th>
                                                    <th>JENIS</th>
                                                    <th>KATEGORI</th>
                                                    <th>NOMINAL</th>
                                                    <th>KETERANGAN</th>
                                                    <th>OLEH</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($kasTransaksi as $data)
                                                <tr>
                                                    <td>{{ $data->id }}
                                                    </td>
                                                    <td>{{ $data->kas->tipe }} - {{ $data->kas->nama }}</td>
                                                    <td style="font-size: 17px">
                                                        <span class="

                                                        @if ($data->jenis) @if ($data->jenis->nama == 'masuk')
                                                        text-white badge badge-success
                                                        @elseif($data->jenis->nama == 'keluar')
                                                        text-white badge badge-danger
                                                        @else @endif
@else
@endif


                                                        ">
                                                            {{ $data->jenis != null ? $data->jenis->nama : '' }}
                                                        </span>

                                                    </td>
                                                    <td class="


                                                    @if ($data->jenis) @if ($data->jenis->nama == 'masuk')
                                                    text-success
                                                    @elseif($data->jenis->nama == 'keluar')
                                                    text-danger
                                                    @else @endif
@else
@endif


                                                    ">
                                                        {{ $data->kategori != null ? $data->kategori->nama : '' }}
                                                    </td>
                                                    <td>@uang($data->nominal)</td>
                                                    <td>{{ $data->keterangan }}</td>
                                                    <td>{{ $data->user != null ? $data->user->nama : '' }}</td>
                                                    <td>

                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @if ($takeKasTransaksi <= $kasTransaksi->count())
                                        <button type="button" class="mt-3 btn btn-info btn-block" wire:click='takeKasTransaksi()'>
                                            Lanjut
                                        </button>
                                        @endif
                                </div>
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
