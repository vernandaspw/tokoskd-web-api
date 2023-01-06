<div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Piutang (Hutang Pelanggan) <a href="{{ url('piutang', []) }}" class="btn mr-2 btn-secondary">Kembali</a></h1>

                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active">Piutang pelanggan</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <section class="content mb-3">
            <div class="container-fluid">


                <div class="row">

                    <div class="col-md-3">
                        <div class="card
                        @if($total_piutang_pelanggan == 0)
                        bg-success
                        @else
                        bg-danger
                        @endif
                        ">
                            <div class="card-header">
                                Total Piutang (piutang pelanggan)
                            </div>
                            <div class="card-body">
                                @uang($total_piutang_pelanggan)
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card
                        @if($jml_orang == 0)
                        bg-success
                        @else
                        bg-danger
                        @endif
                        ">
                            <div class="card-header">
                                Jumlah pelanggan yg piutang
                            </div>
                            <div class="card-body">
                                {{ $jml_orang }}
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-md-3">
                        <a href="{{ url('piutang/piutang-supplier', []) }}" class="card
                    @if($total_piutang_supplier == 0)
                    bg-success
                    @else
                    bg-danger
                    @endif
                    ">
                    <div class="card-header">
                        Total piutang supplier
                    </div>
                    <div class="card-body">
                        @uang($total_piutang_supplier)
                    </div>
                    </a>
                </div> --}}
            </div>
            <div class="mb-5">
                @if($tambahPage)
                <div class="col-md-3">
                    <h5>
                        <b>Buat piutang baru</b>
                    </h5>
                    <div class="">
                        <form wire:submit.prevent='tambah'>
                            <div class="mb-2">
                                <label class="mb-0"  for="">Pelanggan</label>
                                <input type="text" disabled wire:model='d_nama' class="form-control" name="" id="">
                            </div>
                            <div class="">
                                <label class="mb-0" for="">Hutang pelanggan</label>
                                <input type="text" disabled value="@uang($d_piutang)" class="form-control" name="" id="">
                            </div>
                            <div class="">
                                <label class="mb-0" for="">Pilih kas</label>
                                <select required class="form-control" wire:model='d_kas_id' id="">
                                    <option value="">Pilih</option>
                                    @foreach ($kas as $data)
                                        <option value="{{ $data->id }}">{{ $data->tipe }} - {{ $data->nama }} - @uang($data->saldo)</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="">
                                <label class="mb-0" for="">jumlah (@uang($d_jumlah))</label>
                                <input required type="number" wire:model.lazy='d_jumlah' class="form-control" name="" id="">
                            </div>
                            <div class="">
                                <label class="mb-0" for="">Keterangan</label>
                                <input type="text" wire:model='d_keterangan' class="form-control" name="" id="">
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-success form-control">Simpan</button>
                                <button wire:click='batalTambah' type="button" class="btn btn-danger mt-2 form-control">Batal</button>
                            </div>
                        </form>
                    </div>

                </div>
                @elseif($kurangPage)

                <div class="col-md-3">
                    <h5>
                        <b>Bayar piutang (tagih)</b>
                    </h5>
                    <div class="">
                        <form wire:submit.prevent='kurang'>
                            <div class="mb-2">
                                <label class="mb-0"  for="">Pelanggan</label>
                                <input type="text" disabled wire:model='d_nama' class="form-control" name="" id="">
                            </div>
                            <div class="">
                                <label class="mb-0" for="">Hutang pelanggan</label>
                                <input type="text" disabled value="@uang($d_piutang)" class="form-control" name="" id="">
                            </div>
                            <div class="">
                                <label class="mb-0" for="">Pilih kas</label>
                                <select required class="form-control" wire:model='d_kas_id' id="">
                                    <option value="">Pilih</option>
                                    @foreach ($kas as $data)
                                        <option value="{{ $data->id }}">{{ $data->tipe }} - {{ $data->nama }} - @uang($data->saldo)</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="">
                                <label class="mb-0" for="">jumlah (@uang($d_jumlah))</label>
                                <input required type="number" wire:model.lazy='d_jumlah' class="form-control" name="" id="">
                            </div>
                            <div class="">
                                <label class="mb-0" for="">Keterangan</label>
                                <input type="text" wire:model='d_keterangan' class="form-control" name="" id="">
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-success form-control">Simpan</button>
                                <button wire:click='batalKurang' type="button" class="btn btn-danger mt-2 form-control">Batal</button>
                            </div>
                        </form>
                    </div>

                </div>

                @else
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data piutang (utang pelanggan)</h3>

                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" wire:model='cariNama' class="form-control float-right" placeholder="Search">
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
                                    <th>Pelanggan</th>
                                    <th>Piutang (utang pelanggan)</th>
                                    <th>
                                        aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pelanggan as $data)
                                <tr>
                                    <td>{{ $data->id }}</td>
                                    <td>
                                        {{ $data->nama  }}
                                    </td>
                                    <td>
                                        @uang($data->piutang_usaha)
                                    </td>

                                    <td>
                                        <button wire:click="tambahPage('{{ $data->id }}')" class="btn btn-danger btn-sm">Beri (pel. utang)</button>
                                        <button wire:click="kurangPage('{{ $data->id }}')" class="mr-2 btn btn-success btn-sm">Terima (pel. bayar)</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if($takePelanggan <= $pelanggan->count())
                        <button type="button" class="mt-3 btn btn-info btn-block" wire:click='takePiutang()'>
                            Lanjut
                        </button>
                        @endif
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
