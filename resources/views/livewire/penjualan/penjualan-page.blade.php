<div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-1">
                    <div class="col-sm-6">
                        <h1 class="m-0"><b>Data Penjualan</b></h1>

                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active">Penjualan</li>
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
                                        <input type="text" wire:model="cariProduk" class="form-control float-right" placeholder="Search">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body  p-0">
                                <div class="mb-2">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-lg-6 col-6">
                                                <div class="">
                                                    <h5>
                                                    <b>Hari ini</b>
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-6">
                                                <div class="">
                                                    <h5>
                                                    <b>Bulan ini</b>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            {{-- <div class="col-lg-3 col-12">
                                                <!-- small box -->
                                                <div class="small-box bg-success">
                                                    <div class="inner">
                                                        <h3>@uang($pendapatan_day)</h3>
                                                        <p>Pendapatan</p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="ion ion-bag"></i>
                                                    </div>
                                                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                                </div>
                                            </div> --}}
                                            <div class="col-lg-3 col-12">
                                                <!-- small box -->
                                                <div class="small-box bg-primary">
                                                    <div class="inner">
                                                        <p>Omset</p>
                                                        <h3>@uang($omset_day)</h3>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="ion ion-bag"></i>
                                                    </div>
                                                    <a href="#" class="small-box-footer">Kemarin : @uang($omset_kemarin)</a>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-12">
                                                <!-- small box -->
                                                <div class="small-box bg-success">
                                                    <div class="inner">
                                                        <p>untung</p>
                                                        <h3>@uang($untung_day)</h3>

                                                    </div>
                                                    <div class="icon">
                                                        <i class="ion ion-bag"></i>
                                                    </div>
                                                    <a href="#" class="small-box-footer">Kemarin : @uang($untung_kemarin)</a>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-12">
                                                <!-- small box -->
                                                <div class="small-box bg-primary">
                                                    <div class="inner">
                                                        <p>Omset</p>
                                                        <h3>@uang($omset_month)</h3>

                                                    </div>
                                                    <div class="icon">
                                                        <i class="ion ion-bag"></i>
                                                    </div>
                                                    <a href="#" class="small-box-footer">bulan Kemarin : @uang($omset_Bkemarin)</a>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-12">
                                                <!-- small box -->
                                                <div class="small-box bg-success">
                                                    <div class="inner">
                                                        <p>untung</p>
                                                        <h3>@uang($untung_month)</h3>

                                                    </div>
                                                    <div class="icon">
                                                        <i class="ion ion-bag"></i>
                                                    </div>
                                                    <a href="#" class="small-box-footer">Bulan Kemarin : @uang($untung_Bkemarin)</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-sm table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>No Penjualan</th>
                                                <th>waktu</th>
                                                <th>Pelanggan</th>
                                                <th>Jml produk</th>
                                                <th>Total pembayaran</th>
                                                <th>Kasir</th>
                                                <th>aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody wire:poll>
                                            @foreach ($penjualan as $data)
                                                <tr>
                                                    <td>{{ $data->no_penjualan }}</td>
                                                    <td>
                                                        {{ \Carbon\Carbon::parse($data->waktu)->isoFormat('D MMMM Y, HH:mm') }} -  {{ \Carbon\Carbon::parse($data->waktu)->diffForHumans() }}
                                                    </td>
                                                    <td>{{ $data->pelanggan }}</td>
                                                    <td>{{ $data->penjualan_item->count() }}</td>
                                                    <td>@uang($data->total_pembayaran)</td>
                                                    <td>{{ $data->kasir->nama }} - {{ $data->user->nama }}</td>
                                                    <td>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                   @if($penjualanRow > $take)
                                   <div class="mt-3">
                                    <button type="button" wire:click='take()' class="btn btn-warning btn-block">Lanjut</button>
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
