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

                @if ($bukaKas_id != null || $tutupKas_id != null)
                    @if ($bukaKas_id)
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-header bg-success">
                                    <div class="d-flex justify-content-between">
                                        <div class="">
                                            Buka kas {{ $namaKasir }}
                                        </div>
                                        <div class="">
                                            Hari ini
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="">
                                        <form wire:submit.prevent='buka_kas_simpan'>
                                            <div class="mb-1">
                                                <label for="" class="m-0">
                                                    Kas Awal hari ini
                                                </label>
                                                <div class="">
                                                    @uang($kasData->saldo)
                                                </div>
                                            </div>
                                            <div class="mt-3">
                                                <button type="submit"
                                                    class="btn form-control btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="mt-2">
                                        <button type="button" wire:click="close()"
                                            class="btn form-control btn-secondary">Kembali</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif($tutupKas_id)
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-header bg-danger">
                                    <div class="d-flex justify-content-between">
                                        <div class="">
                                            Tutup kas {{ $namaKasir }}
                                        </div>
                                        <div class="">
                                            Hari ini
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="">
                                        <form wire:submit.prevent='tutup_kas_simpan'>
                                            <div class="mb-1">
                                                <div class="d-flex justify-content-between">
                                                    <div class="">
                                                        Kas Awal hari ini
                                                    </div>
                                                    <div class="">
                                                        @uang($tutupR->kas_awal)
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="mb-1">
                                                <div class="d-flex justify-content-between">
                                                    <div class="">
                                                        Total uang masuk
                                                    </div>
                                                    <div class="">
                                                        @uang($total_uang_masuk != null ? $total_uang_masuk : 0)
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-1">
                                                <div class="d-flex justify-content-between">
                                                    <div class="">
                                                        Total uang keluar
                                                    </div>
                                                    <div class="">
                                                        @uang($total_uang_keluar != null ? $total_uang_keluar : 0)
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-1">
                                                <div class="d-flex justify-content-between">
                                                    <div class="">
                                                        Kas akhir (kas buku)
                                                    </div>
                                                    <div class="">
                                                        @uang($kas_akhir != null ? $kas_akhir : 0)
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-1">
                                                <label for="" class="p-0 m-0">Kas tutup (cash saat ini)</label>
                                                <input required min="0" type="number" class="form-control"
                                                    wire:model='kas_tutup'>
                                            </div>
                                            <div class="mb-2">
                                                <div class="d-flex justify-content-between">
                                                    <div class="">
                                                        Selisih
                                                    </div>
                                                    <div
                                                        class="@if ($selisih > 0) text-success
                                                @else
                                                text-danger @endif">
                                                        @if ($selisih > 0)
                                                            +
                                                        @else
                                                        @endif @uang($selisih != null ? $selisih : 0)
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="m-2">
                                            <div class="mb-1">
                                                <div class="d-flex justify-content-between">
                                                    <div class="">
                                                        Jml Penjualan
                                                    </div>
                                                    <div class="">
                                                        {{ $jumlah_penjualan }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-1">
                                                <div class="d-flex justify-content-between">
                                                    <div class="">
                                                        Uang tunai
                                                    </div>
                                                    <div class="">
                                                        @uang($uang_tunai != null ? $uang_tunai : 0)
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-1">
                                                <div class="d-flex justify-content-between">
                                                    <div class="">
                                                        Uang nontunai
                                                    </div>
                                                    <div class="">
                                                        @uang($uang_nontunai != null ? $uang_nontunai : 0)
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-1">
                                                <div class="d-flex justify-content-between">
                                                    <div class="">
                                                        omset
                                                    </div>
                                                    <div class="">
                                                        @uang($omset != null ? $omset : 0)
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-1">
                                                <div class="d-flex justify-content-between">
                                                    <div class="">
                                                        untung
                                                    </div>
                                                    <div class="">
                                                        @uang($untung != null ? $untung : 0)
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-1">
                                                <div class="d-flex justify-content-between">
                                                    <div class="">
                                                        Tagihan utang
                                                    </div>
                                                    <div class="">
                                                        @uang($tagihan_utang != null ? $tagihan_utang : 0)
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-3">
                                                <button type="submit" class="btn form-control btn-primary">Tutup kas &
                                                    cetak</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="mt-2">
                                        <button type="button" wire:click="close()"
                                            class="btn form-control btn-secondary">Kembali</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="card mt-3">
                        <div class="card-header bg-secondary"><b>Riwayat Tutup Kas</b></div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Kas awal</th>
                                            <th>Uang masuk</th>
                                            <th>Uang Keluar</th>
                                            <th>Kas akhir</th>
                                            <th>Kas tutup</th>
                                            <th>Selisih</th>
                                            <th>Jml transaksi</th>
                                            <th>Buka - Tutup</th>
                                            <th>status </th>
                                            <th>Aksi </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($KasirReport as $data)
                                            <tr>
                                                <td>
                                                    @if ($data->kas_awal)
                                                        @uang($data->kas_awal)
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($data->total_uang_masuk != 0)
                                                        @uang($data->total_uang_masuk)
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($data->total_uang_keluar != 0)
                                                        @uang($data->total_uang_keluar)
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($data->kas_akhir != 0)
                                                        @uang($data->kas_akhir)
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($data->kas_tutup != 0)
                                                        @uang($data->kas_tutup)
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($data->selisih != 0)
                                                        @uang($data->selisih)
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($data->jumlah_transaksi != 0)
                                                        @uang($data->jumlah_transaksi)
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $data->created_at }}
                                                    @if ($data->tutup_at)
                                                        - {{ $data->tutup_at }}
                                                    @endif
                                                    <div class="">
                                                        {{ $data->buka_olehs->nama }}
                                                        @if ($data->tutup_olehs)
                                                            - {{ $data->tutup_olehs->nama }}
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    {{ $data->status }}
                                                </td>
                                                <td>
                                                    @if (auth()->user()->role != 'staff')
                                                        @if ($data->status == 'pending')
                                                            <button
                                                                onclick="confirm('Pastikan telah menerima uang sesuai dengan jumlah pada kas tutup?') || event.stopImmediatePropagation()"
                                                                wire:click="terimaKasTutup('{{ $data->id }}')"
                                                                type="button" class="btn btn-success">Terima uang</button>
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @elseif($laporan_id)
                    <div class="card mt-3">
                        <div class="card-header bg-secondary"><b>Riwayat Tutup Kas</b></div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Kas awal</th>
                                            <th>Uang masuk</th>
                                            <th>Uang Keluar</th>
                                            <th>Kas akhir</th>
                                            <th>Kas tutup</th>
                                            <th>Selisih</th>
                                            <th>Jml transaksi</th>
                                            <th>Buka - Tutup</th>
                                            <th>status </th>
                                            <th>Aksi </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($KasirReport as $data)
                                            <tr>
                                                <td>
                                                    @if ($data->kas_awal)
                                                        @uang($data->kas_awal)
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($data->total_uang_masuk != 0)
                                                        @uang($data->total_uang_masuk)
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($data->total_uang_keluar != 0)
                                                        @uang($data->total_uang_keluar)
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($data->kas_akhir != 0)
                                                        @uang($data->kas_akhir)
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($data->kas_tutup != 0)
                                                        @uang($data->kas_tutup)
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($data->selisih != 0)
                                                        @uang($data->selisih)
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($data->jumlah_transaksi != 0)
                                                        @uang($data->jumlah_transaksi)
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $data->created_at }}
                                                    @if ($data->tutup_at)
                                                        - {{ $data->tutup_at }}
                                                    @endif
                                                    <div class="">
                                                        {{ $data->buka_olehs->nama }}
                                                        @if ($data->tutup_olehs)
                                                            - {{ $data->tutup_olehs->nama }}
                                                        @endif
                                                    </div>
                                                </td>

                                                <td>
                                                    {{ $data->status }}
                                                </td>
                                                <td>
                                                    @if (auth()->user()->role != 'staff')
                                                        @if ($data->status == 'pending')
                                                            <button
                                                                onclick="confirm('Pastikan telah menerima uang sesuai dengan jumlah pada kas tutup?') || event.stopImmediatePropagation()"
                                                                wire:click="terimaKasTutup('{{ $data->id }}')"
                                                                type="button" class="btn btn-success">Terima</button>
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="mb-3">
                        @if (auth()->user()->role == 'superadmin' || auth()->user()->role == 'admin')
                            @if ($createPage)
                            @else
                                <button class="btn btn-primary" wire:click='createPage()'>Buat kasir baru</button>
                            @endif
                        @endif
                    </div>

                    @if ($createPage)
                        <div class="col-md-3">
                            <div class="">Buat kasir baru</div>
                            <form wire:submit.prevent='create()'>
                                <div class="">
                                    <div class="mb-1">
                                        <label class="mb-0 mt-1" for="keterangan">nama</label>
                                        <input autofocus wire:model='nama' type="text" class="form-control"
                                            placeholder="nama">
                                    </div>
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                    <button type="button" class="btn btn-white"
                                        wire:click='createPage()'>Tutup</button>
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
                                            <input autofocus wire:model='nama' type="text" class="form-control"
                                                placeholder="nama">
                                        </div>
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                        <button type="button" class="btn btn-white"
                                            wire:click='editPageClose()'>Tutup</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="">
                            <h5><b>Kasir aktif</b></h5>
                        </div>
                        <div class="card mt-2" style="width: 350px">
                            <div class="card-body">
                                <div class=" @if($total_selisih > 0)
                                    text-success
                                    @else
                                    text-danger
                                @endif">
                                    Selisih total : @uang($total_selisih)
                                </div>
                            </div>
                        </div>
                        <div class="mb-5 row">
                            @forelse ($kasiractive as $data)
                                <div class="col-xl-4 col-lg-6 col-md-6 col-12">
                                    <div class="card bg-white">
                                        <div class="card-header">

                                            <div class="d-flex justify-content-between">
                                                <div class="">
                                                    {{ $data->nama }}
                                                </div>
                                                <div class="">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="">

                                            </div>
                                            <div class="">
                                                @uang($data->kas->saldo)

                                            </div>
                                            <div class="mt-2 @if($data->kas->saldo_selisih > 0)
                                                text-success
                                                @else
                                                text-danger
                                            @endif">
                                               Selisih : @uang($data->kas->saldo_selisih) @if($data->kas->saldo_selisih > 0)
                                                + @else -
                                                @endif
                                            </div>

                                        </div>
                                        <div class="card-footer">


                                            <div class="d-flex justify-content-between">
                                                <div class="">

                                                </div>
                                                <div class="">
                                                    @php
                                                        $dayReport = $data
                                                            ->kasir_report()
                                                            ->whereDate('created_at', date('Y-m-d'))
                                                            ->where('status', 'open')
                                                            ->first();
                                                        $dayReportPending = $data
                                                            ->kasir_report()
                                                            ->whereDate('created_at', date('Y-m-d'))
                                                            ->where('status', 'pending')
                                                            ->first();
                                                    @endphp
                                                    <button wire:click="laporanShow('{{ $data->id }}')"
                                                        class="btn btn-primary px-2">
                                                        Laporan
                                                    </button>

                                                    @if ($dayReport)
                                                        <button
                                                            wire:click="tutup_kas_toggle('{{ $data->id }}', '{{ $dayReport->id }}')"
                                                            class="btn btn-danger">
                                                            Tutup kas
                                                        </button>
                                                        <button wire:click="kasir_detail('{{ $data->id }}')"
                                                            class="btn btn-success px-4">
                                                            Mode kasir
                                                        </button>
                                                    @elseif($dayReportPending)
                                                        (Pending)
                                                    @else
                                                        <button wire:click="buka_kas_toggle('{{ $data->id }}')"
                                                            class="btn btn-success">
                                                            Buka kas
                                                        </button>
                                                    @endif


                                                </div>
                                            </div>
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

                                        </div>
                                    </div>
                                </div>
                            @empty
                                Belum ada
                            @endforelse
                        </div>
                    @endif
                @endif
                <div class="card mt-3">
                    <div class="card-header bg-secondary"><b>Riwayat Tutup Kas</b></div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th>Kasir</th>
                                        <th>Kas awal</th>
                                        <th>Uang masuk</th>
                                        <th>Uang Keluar</th>
                                        <th>Kas akhir</th>
                                        <th>Kas tutup</th>
                                        <th>Selisih</th>
                                        <th>Jml transaksi</th>
                                        <th>Buka - Tutup</th>
                                        <th>status </th>
                                        <th>Aksi </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($KasirReportAll as $data)
                                        <tr>
                                            <td>
                                                {{ $data->kasir->nama }}
                                            </td>
                                            <td>
                                                @if ($data->kas_awal)
                                                    @uang($data->kas_awal)
                                                @endif
                                            </td>
                                            <td>
                                                @if ($data->total_uang_masuk != 0)
                                                    @uang($data->total_uang_masuk)
                                                @endif
                                            </td>
                                            <td>
                                                @if ($data->total_uang_keluar != 0)
                                                    @uang($data->total_uang_keluar)
                                                @endif
                                            </td>
                                            <td>
                                                @if ($data->kas_akhir != 0)
                                                    @uang($data->kas_akhir)
                                                @endif
                                            </td>
                                            <td>
                                                @if ($data->kas_tutup != 0)
                                                    @uang($data->kas_tutup)
                                                @endif
                                            </td>
                                            <td>
                                                @if ($data->selisih != 0)
                                                    @uang($data->selisih)
                                                @endif
                                            </td>
                                            <td>
                                                @if ($data->jumlah_transaksi != 0)
                                                    @uang($data->jumlah_transaksi)
                                                @endif
                                            </td>
                                            <td>
                                                {{ $data->created_at }}
                                                @if ($data->tutup_at)
                                                    - {{ $data->tutup_at }}
                                                @endif
                                                <div class="">
                                                    {{ $data->buka_olehs->nama }}
                                                    @if ($data->tutup_olehs)
                                                        - {{ $data->tutup_olehs->nama }}
                                                    @endif
                                                </div>
                                            </td>

                                            <td>
                                                {{ $data->status }}
                                            </td>
                                            <td>
                                                @if (auth()->user()->role != 'staff')
                                                    @if ($data->status == 'pending')
                                                        <button
                                                            onclick="confirm('Pastikan telah menerima uang sesuai dengan jumlah pada kas tutup?') || event.stopImmediatePropagation()"
                                                            wire:click="terimaKasTutup('{{ $data->id }}')"
                                                            type="button" class="btn btn-success">Terima</button>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-2">
                            @if($KasirReportAll->count() >= $take_report)
                            <button type="button" class="btn btn-warning btn-block" wire:click="take_report()">Lainnya</button>
                            @endif
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
    <script>
        Livewire.on('cetakStrukTutup', data => {
            console.log(data.url);
            console.log(data.title);

            cetakStruk(data.url, data.title);

        })

        function cetakStruk(url, title) {
            // popupCenter(url, title, 720, 675);
            popupCenter(url, title, 900, 700);
        }

        function popupCenter(url, title, w, h) {
            var left = (screen.width - w) / 2;
            var top = (screen.height - h) / 4;
            var myWindow = window.open(url, title,
                'resizable=yes, width=' + w + ', height=' + h + ', top=' +
                top + ', left=' + left);
        }
    </script>
@endpush
