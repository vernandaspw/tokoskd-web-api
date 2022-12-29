<div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Bank</h1>

                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active">Bank</li>
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
                                <form wire:submit.prevent='edit'>
                                    <div class="mb-1">
                                        <img src="{{ Storage::url($img) }}" width="300px" alt="">
                                    </div>
                                    <div class="mb-1">
                                        <label for="img">Gambar</label>
                                        <input wire:model='newImg' type="file" class="form-control" placeholder="image">
                                    </div>
                                    <div class="mb-1">
                                        <label for="nama">Nama <span class="text-danger">*wajib</span></label>
                                        <input required wire:model='nama' type="text" class="form-control" placeholder="Nama">
                                    </div>
                                    <div class="mb-1">
                                        <label for="keterangan">Keterangan <span class="text-danger">*wajib</span></label>
                                        <input required wire:model='keterangan' type="text" class="form-control" placeholder="Keterangan">
                                    </div>
                                    <div class="mb-1">
                                        <label for="phone">Nomor hp</label>
                                        <input wire:model='phone' type="tel" class="form-control" placeholder="phone">
                                    </div>
                                    <div class="mb-1">
                                        <label for="tel">Telpon</label>
                                        <input wire:model='tel'  type="tel" class="form-control" placeholder="Telpon">
                                    </div>
                                    <div class="mb-1">
                                        <label for="fax">fax</label>
                                        <input wire:model='fax'  type="tel" class="form-control" placeholder="Fax">
                                    </div>
                                    <div class="mb-1">
                                        <label for="email">email</label>
                                        <input autocomplete="off" wire:model='email' type="email" class="form-control" placeholder="email">
                                    </div>
                                    <div class="mb-1">
                                        <label for="provinsi">Provinsi</label>
                                        <input wire:model='provinsi' type="text" class="form-control" placeholder="Provinsi">
                                    </div>
                                    <div class="mb-1">
                                        <label for="kota">Kota</label>
                                        <input wire:model='kota' type="text" class="form-control" placeholder="Kota">
                                    </div>
                                    <div class="mb-1">
                                        <label for="alamat">Alamat</label>
                                        <input wire:model='alamat' type="text" class="form-control" placeholder="Alamat">
                                    </div>
                                    <div class="mb-1">
                                        <label for="bank">Bank</label>
                                        <input wire:model='bank' type="text" class="form-control" placeholder="Bank">
                                    </div>
                                    <div class="mb-1">
                                        <label for="norek">No Rekening</label>
                                        <input wire:model='norek' type="text" class="form-control" placeholder="No Rekening">
                                    </div>
                                    <div class="mb-1">
                                        <label for="an">Atas Nama</label>
                                        <input wire:model='an' type="text" class="form-control" placeholder="Atas nama">
                                    </div>
                                    <div class="mb-1">
                                        <label for="npwp">NPWP</label>
                                        <input wire:model='npwp' type="text" class="form-control" placeholder="NPWP">
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
                                <form wire:submit.prevent='simpan'>
                                    <div class="mb-1">
                                        <label for="img">Gambar</label>
                                        <input wire:model='img' type="file" class="form-control" placeholder="image">
                                    </div>
                                    <div class="mb-1">
                                        <label for="nama">Nama <span class="text-danger">*wajib</span></label>
                                        <input autofocus='true' required wire:model='nama' type="text" class="form-control" placeholder="Nama">
                                    </div>
                                    <div class="mb-1">
                                        <label for="keterangan">Keterangan <span class="text-danger">*wajib</span></label>
                                        <input required wire:model='keterangan' type="text" class="form-control" placeholder="Keterangan">
                                    </div>
                                    <div class="mb-1">
                                        <label for="phone">Nomor hp</label>
                                        <input wire:model='phone' type="tel" class="form-control" placeholder="phone">
                                    </div>
                                    <div class="mb-1">
                                        <label for="telp">Telpon</label>
                                        <input wire:model='telp'  type="tel" class="form-control" placeholder="Telpon">
                                    </div>
                                    <div class="mb-1">
                                        <label for="fax">fax</label>
                                        <input wire:model='fax'  type="tel" class="form-control" placeholder="Fax">
                                    </div>
                                    <div class="mb-1">
                                        <label for="email">email</label>
                                        <input autocomplete="off" wire:model='email' type="email" class="form-control" placeholder="email">
                                    </div>
                                    <div class="mb-1">
                                        <label for="provinsi">Provinsi</label>
                                        <input wire:model='provinsi' type="text" class="form-control" placeholder="Provinsi">
                                    </div>
                                    <div class="mb-1">
                                        <label for="kota">Kota</label>
                                        <input wire:model='kota' type="text" class="form-control" placeholder="Kota">
                                    </div>
                                    <div class="mb-1">
                                        <label for="alamat">Alamat</label>
                                        <input wire:model='alamat' type="text" class="form-control" placeholder="Alamat">
                                    </div>
                                    <div class="mb-1">
                                        <label for="bank">Bank</label>
                                        <input wire:model='bank' type="text" class="form-control" placeholder="Bank">
                                    </div>
                                    <div class="mb-1">
                                        <label for="norek">No Rekening</label>
                                        <input wire:model='norek' type="text" class="form-control" placeholder="No Rekening">
                                    </div>
                                    <div class="mb-1">
                                        <label for="an">Atas Nama</label>
                                        <input wire:model='an' type="text" class="form-control" placeholder="Atas nama">
                                    </div>
                                    <div class="mb-1">
                                        <label for="npwp">NPWP</label>
                                        <input wire:model='npwp' type="text" class="form-control" placeholder="NPWP">
                                    </div>

                                    <button type="submit" class="btn mb-1 mt-1 btn-success rounded-pill form-control">Simpan</button>
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
                                <h3 class="card-title">Akun</h3>
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
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>Phone/Telp</th>
                                            <th>Alamat</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($akun as $data)
                                        <tr>
                                            <td>
                                                <a href="{{ Storage::url($data->img) }}" target="_blank" rel="noopener noreferrer">
                                                <img src="{{ Storage::url($data->img) }}" width="100px" alt="">
                                                </a>
                                            </td>
                                            <td>{{ $data->nama }}
                                            </td>
                                            <td>{{ $data->phone }}@if($data->phone != null && $data->telp != null)
/
                                            @endif{{ $data->telp }}</td>
                                            <td>{{ $data->alamat }}</td>
                                            <td>{{ $data->keterangan }}</td>
                                            <td>
                                                <button wire:click="editPage('{{ $data->id }}')" type="button" class="btn btn-sm btn-warning rounded-pill px-3">Ubah</button>
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
