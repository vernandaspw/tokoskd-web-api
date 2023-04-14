<div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="  d-flex align-items-center justify-content-between">
                    <div class="">
                        <h1 class="m-0">Transaksi kas</h1>

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
                <div class="mb-3">
                    <div class="d-flex justify-content-start">
                        <button type="button" wire:click="masukPage()" class="btn mr-2 @if($masukPage)
                            btn-success
                            @else
                            btn-outline-success
                            @endif rounded-pill">
                            Masuk
                        </button>
                        <button type="button" wire:click="keluarPage()" class="btn mr-2  @if($keluarPage)
                            btn-danger
                            @else
                            btn-outline-danger
                            @endif rounded-pill">
                            Keluar
                        </button>
                        <button type="button" wire:click="transferPage()" class="btn mr-2  @if($transferPage)
                            btn-info
                            @else
                            btn-outline-info
                            @endif rounded-pill">
                            Transfer (alokasi)
                        </button>
                    </div>
                </div>


                @if($masukPage)
                <div class="row">
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-header bg-success text-center">
                                Masuk
                            </div>
                            <div class="card-body">
                                <form wire:submit.prevent='masuk'>
                                    <div class="d-flex mb-2">
                                        <div class="mr-1 w-100">
                                            <label for="pilih tanggal">Pilih Tanggal</label>
                                            <input type="date" class="form-control" wire:model='pilih_tanggal'>
                                        </div>
                                        <div class="ml-1 w-100">
                                            <label for="pilih tanggal">Pilih Jam</label>
                                            <input type="time" class="form-control" wire:model='pilih_jam'>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label for="kas_id" class="m-0">Kas</label>
                                        <select required wire:model='kas_id' id="kas_id" class="form-control">
                                            <option value="">Pilih</option>
                                            @foreach ($kas as $data)
                                            <option value="{{ $data->id }}">{{ $data->tipe }} - {{ $data->nama }} - @uang($data->saldo)</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <label for="kategori_id" class="m-0">Kategori</label>
                                        <select required wire:model='kategori_id' id="kategori_id" class="form-control">
                                            <option value="">Pilih</option>
                                            @foreach ($kategoriMasuk as $data)
                                            <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <label for="nominal" class="m-0">Nominal</label> @uang($nominal == null ? 0 : $nominal)
                                        <input wire:model='nominal' required type="number" class="form-control" placeholder="nominal">
                                    </div>
                                    <div class="mb-2">
                                        <label for="keterangan" class="m-0">keterangan</label>
                                        <input wire:model='keterangan' type="text" class="form-control" placeholder="keterangan">
                                    </div>
                                    <button type="submit" class="btn mb-1 mt-1 btn-success rounded-pill form-control">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @elseif($keluarPage)
                <div class="row">
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-header bg-danger text-center">
                                Keluar
                            </div>
                            <div class="card-body">
                                <form wire:submit.prevent='keluar'>
                                    <div class="d-flex mb-2">
                                        <div class="mr-1 w-100">
                                            <label for="pilih tanggal">Pilih Tanggal</label>
                                            <input type="date" class="form-control" wire:model='pilih_tanggal'>
                                        </div>
                                        <div class="ml-1 w-100">
                                            <label for="pilih tanggal">Pilih Jam</label>
                                            <input type="time" class="form-control" wire:model='pilih_jam'>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label for="kas_id" class="m-0">Kas</label>
                                        <select required wire:model='kas_id' id="kas_id" class="form-control">
                                            <option value="">Pilih</option>
                                            @foreach ($kas as $data)
                                            <option value="{{ $data->id }}">{{ $data->tipe }} - {{ $data->nama }} - @uang($data->saldo)</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <label for="kategori_id" class="m-0">Kategori</label>
                                        <select required wire:model='kategori_id' id="kategori_id" class="form-control">
                                            <option value="">Pilih</option>
                                            @foreach ($kategoriKeluar as $data)
                                            <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <label for="nominal" class="m-0">Nominal</label> @uang($nominal == null ? 0 : $nominal)
                                        <input wire:model='nominal' required type="number" class="form-control" placeholder="nominal">
                                    </div>
                                    <div class="mb-2">
                                        <label for="keterangan" class="m-0">keterangan</label>
                                        <input wire:model='keterangan' type="text" class="form-control" placeholder="keterangan">
                                    </div>
                                    <button type="submit" class="btn mb-1 mt-1 btn-danger rounded-pill form-control">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @elseif($transferPage)
                <div class="row">
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-header bg-info text-center">
                                Transfer (alokasi)
                            </div>
                            <div class="card-body">
                                <form wire:submit.prevent='transfer'>
                                    <div class="d-flex mb-2">
                                        <div class="mr-1 w-100">
                                            <label for="pilih tanggal">Pilih Tanggal</label>
                                            <input type="date" class="form-control" wire:model='pilih_tanggal'>
                                        </div>
                                        <div class="ml-1 w-100">
                                            <label for="pilih tanggal">Pilih Jam</label>
                                            <input type="time" class="form-control" wire:model='pilih_jam'>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label for="kas_id" class="m-0">Kas asal</label>
                                        <select required wire:model='kas_id' id="kas_id" class="form-control">
                                            <option value="">Pilih</option>
                                            @foreach ($kas as $data)
                                            <option value="{{ $data->id }}">{{ $data->tipe }} - {{ $data->nama }} - @uang($data->saldo)</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <label for="tujuan_id" class="m-0">Tujuan</label>
                                        <select required wire:model='tujuan_id' id="tujuan_id" class="form-control">
                                            <option value="">Pilih</option>
                                            @foreach ($kas as $data)
                                            <option value="{{ $data->id }}">{{ $data->tipe }} - {{ $data->nama }} - @uang($data->saldo)</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-2">

                                        <label for="nominal" class="m-0">Nominal</label>  @uang($nominal == null ? 0 : $nominal)
                                        <input wire:model='nominal' required type="number" class="form-control" placeholder="nominal">
                                    </div>
                                    <div class="mb-2">
                                        <label for="keterangan" class="m-0">keterangan</label>
                                        <input wire:model='keterangan' type="text" class="form-control" placeholder="keterangan">
                                    </div>
                                    <button type="submit" class="btn mb-1 mt-1 btn-info rounded-pill form-control">Transfer</button>
                                </form>
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

