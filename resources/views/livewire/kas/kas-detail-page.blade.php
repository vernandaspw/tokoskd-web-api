<div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="  d-flex align-items-center justify-content-between">
                    <div class="">
                        <h1 class="m-0">Kas detail</h1>

                    </div>
                    <div class="">
                        <div class="float-right">
                            <a href="{{ url('kas/kas-ringkasan', []) }}" class="btn btn-secondary rounded-pill">
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="">
                            @if ($editPage)
                            @else
                            {{-- <button type="button" wire:click="editPage({{ $kas->id }})" class="btn btn-primary rounded-pill">
                                Edit kas
                            </button> --}}
                            @endif
                            <a href="{{ url('kas/kas-transaksi', []) }}" class="btn btn-success rounded-pill">
                                Buat transaksi
                            </a>
                        </div>
                        <div class="">

                        </div>
                    </div>
                </div>
                <hr>

                @if ($editPage)
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
                @else
                <div class="mt-2">
                    <div class="col-xl-3 col-lg-4 col-md-5 col-12">
                        <a href="{{ url('kas/kas', $kas->id) }}" class="card text-dark">
                            <div class="card-body">

                                <div class="d-flex justify-content-between">
                                    <div class="">
                                        <div class="">Urut</div>
                                        <div class="">tipe</div>
                                        <div class="">Nama</div>
                                        <div class="">Saldo</div>
                                    </div>
                                    <div class="text-right">
                                        <div class="">{{ $kas->no == null ? 0 : $kas->no }}</div>
                                        <div class="">{{ $kas->tipe }}</div>
                                        <div class="">{{ $kas->nama }}</div>
                                        <div class="">@uang($kas->saldo)</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="mt-2">
                    <div class="row">
                        <div class="col-6">
                            <div class="card bg-success">
                                <div class="card-body p-3 text-center">
                                    <h4>Masuk</h4>
                                 @uang($saldoMasukTotal)
                                 <div class="mt-2">
                                    Kecuali TF & tutup kasir: @uang($saldoMasuk)
                                 </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card bg-danger">
                                <div class="card-body p-3 text-center">
                                    <h4>Keluar</h4>
                                    @uang($saldoKeluarTotal)
                                    <div class="mt-2">
                                        Kecuali TF & tutup kasir: @uang($saldoKeluar)
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                                        <table class="table table-hover text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <th>ID</th>
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
                                                    <td>{{ \Carbon\Carbon::parse($data->created_at)->isoFormat('D MMMM Y, HH:mm') }}</td>
                                                    <td>{{ $data->id }}
                                                    </td>
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
                                    @if($takeKasTransaksi <= $kasTransaksi->count())
                                        <button type="button" class="mt-3 btn btn-info btn-block" wire:click='takeKasTransaksi()'>
                                            Lanjut
                                        </button>
                                        @endif
                                </div>
                            </div>
                        </div>
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
