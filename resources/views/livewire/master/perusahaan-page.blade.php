<div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Perusahaan</h1>

                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active">Perusahaan</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <form wire:submit.prevent='simpan'>
                                    <div class="mb-1">
                                        <label for="img">Logo</label>
                                        <input wire:model='img' type="file" class="form-control" placeholder="email">
                                    </div>
                                    <div class="mb-1">
                                        <label for="nama_toko">Nama</label>
                                        <input autofocus='true' wire:model='nama_toko'  type="text" class="form-control"
                                            placeholder="nama_toko">
                                    </div>
                                    <div class="mb-1">
                                        <label for="provinsi">provinsi</label>
                                        <input wire:model='provinsi'  type="text" class="form-control"
                                            placeholder="provinsi">
                                    </div>
                                    <div class="mb-1">
                                        <label for="daerah">daerah</label>
                                        <input wire:model='daerah'  type="text" class="form-control"
                                            placeholder="daerah">
                                    </div>
                                    <div class="mb-1">
                                        <label for="alamat">alamat</label>
                                        <input wire:model='alamat'  type="text" class="form-control"
                                            placeholder="alamat">
                                    </div>
                                    <div class="mb-1">
                                        <label for="telp">Telepon</label>
                                        <input wire:model='telp'  type="tel" class="form-control"
                                            placeholder="telp">
                                    </div>
                                    <div class="mb-1">
                                        <label for="npwp">npwp</label>
                                        <input wire:model='npwp'  type="text" class="form-control"
                                            placeholder="npwp">
                                    </div>
                                    <button type="submit"
                                        class="btn mb-1 mt-1 btn-success rounded-pill form-control">Simpan</button>

                                </form>
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
