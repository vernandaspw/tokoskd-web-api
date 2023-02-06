<div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-1">
                    <div class="col-sm-6">
                        <h1 class="m-0"><b>Riwayat harga</b></h1>

                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active">riwayat harga</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="mb-1">
                    {{-- @if ($tambahPage)
                    @else
                    <a href="{{ url('produk/produk-create?url=produk/produk-satuan') }}" class="btn btn-primary rounded-pill">
                        Tambah
                    </a>
                    @endif --}}
                </div>


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data</h3>
                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 250px;">
                                        <input type="text" wire:model="cariProduk" class="form-control float-right"
                                            placeholder="Search">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body  p-0">

                                <div class="table-responsive">
                                    <table class="table table-sm table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>Waktu</th>
                                                <th>Oleh</th>
                                                <th>Nama produk</th>
                                                <th>Pembelian</th>
                                                <th>Penjualan</th>
                                                <th>Harga jual awal</th>
                                                <th>Harga jual akhir</th>
                                                <th>Harga beli awal</th>
                                                <th>Harga beli akhir</th>
                                                <th>Keterangan</th>
                                                <th>Status</th>
                                                <th>di Rak</th>
                                                <th>aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody wire:poll>
                                            @foreach ($riwayats as $data)
                                                <tr>
                                                    <td>
                                                        {{ \Carbon\Carbon::parse($data->created_at)->isoFormat('D MMMM Y, HH:mm') }}
                                                        -
                                                        {{ \Carbon\Carbon::parse($data->created_at)->diffForHumans() }}
                                                    </td>
                                                    <td>{{ $data->user->nama }}</td>
                                                    <td>{{ $data->produk->nama }}</td>
                                                    <td>
                                                        {{ $data->pembelian != null ? $data->pembelian->no_pembelian : '-' }}
                                                    </td>
                                                    <td>
                                                        {{ $data->penjualan != null ? $data->penjualan->no_penjualan : '-' }}
                                                    </td>
                                                    <td>
                                                        @uang($data->harga_jual_awal)
                                                    </td>
                                                    <td>
                                                        @uang($data->harga_jual_akhir)
                                                    </td>
                                                    <td>
                                                        @uang($data->harga_beli_awal)
                                                    </td>
                                                    <td>
                                                        @uang($data->harga_beli_akhir)
                                                    </td>
                                                    <td>
                                                        {{ $data->keterangan }}
                                                    </td>
                                                    <td>
                                                        {{ $data->status }}
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="badge @if ($data->ubahdiRak) badge-success
                                                            @else
                                                            badge-danger @endif">
                                                            {{ $data->ubahdiRak == true ? 'sudah' : 'belum' }}</div>
                                                    </td>
                                                    <td>
                                                        aksi
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @if ($riwayatRow > $take)
                                        <div class="mt-3">
                                            <button type="button" wire:click='take()'
                                                class="btn btn-warning btn-block">Lanjut</button>
                                        </div>
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


@push('script')
    <script type="text/javascript">
        window.onload = function(ev) {
            if (window.innerHeight + window.scrollY >= document.body.offsetHeight && window.innerHeight + window
                .pageYOffset >= document.body.offsetHeight) {
                Livewire.emit('take-data');
            }
        }

        window.onscroll = function(ev) {
            if (window.innerHeight + window.scrollY >= document.body.offsetHeight && window.innerHeight + window
                .pageYOffset >= document.body.offsetHeight) {
                Livewire.emit('take-data');
            }
        }
    </script>
@endpush
