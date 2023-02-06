<div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid d-flex justify-content-between">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div>
                </div>
                <div class="">
                    Filter
                </div>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            @if(auth()->user()->role == 'superadmin' || auth()->user()->role == 'admin')
            <div class="container-fluid">
                <div class="row">

                    <div class="col-lg-3 col-12">
                        <div class="small-box bg-primary mb-2">
                            <div class="inner pb-3">
                                <div class="text-center mb-1">
                                    <b>Kas Saldo</b>
                                </div>
                                @foreach ($kasSaldo as $data)
                                <div class="d-flex justify-content-between">
                                    <div class="">
                                        <div class="">
                                            {{ $data->nama }}
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="">
                                            @uang($data->saldo != null ? $data->saldo : 0)
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            {{-- <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a> --}}
                        </div>
                    </div>
                    <div class="col-lg-3 col-12">
                        <div class="small-box bg-primary mb-2">
                            <div class="inner pb-0">
                                <div class="text-center mb-1">
                                    <b>Utang Piutang</b> (belum)
                                </div>
                                <div class="d-flex justify-content-around">
                                    <div class="">
                                        <h5>@uang(1313)</h5>
                                        <p>Utang saya</p>
                                    </div>
                                    <div class="">
                                    </div>
                                    <div class="">
                                        <h5>@uang(3141)</h5>
                                        <p>Piutang</p>
                                    </div>
                                </div>
                                <hr class="my-0  bg-white w-50">
                                <div class="pb-2 mt-2">
                                    <h6>@uang(10000)</h6>
                                </div>
                            </div>
                            {{-- <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a> --}}
                        </div>
                    </div>
                    <div class="col-lg-3 col-12">
                        <div class="small-box bg-primary mb-2">
                            <div class="inner pb-3">
                                <div class="text-center mb-1">
                                    <b>Totoal Persediaan</b> (belum)
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="">
                                        <div class="">
                                            Jumlah
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="">
                                            @uang(22425 != null ? 2525 : 0)
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a> --}}
                        </div>
                    </div>

                </div>
                <hr>
                <div class="col-md-3">
                    <div class="">
                        <label for="">Tanggal</label>
                        <input type="date" class="form-control" wire:model='date'>
                    </div>
                </div>
                <hr>
                <div class="">
                    <h5>Hari ini</h5>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-12">
                        <div class="small-box bg-success mb-2">
                            <div class="inner pb-0">
                                <div class="text-center mb-1">
                                    <b>Arus Kas</b> (belum)
                                </div>
                                <div class="d-flex pb-0 justify-content-around">
                                    <div class="">
                                        <h5>@uang(20000)</h5>
                                        <p>Masuk</p>
                                    </div>
                                    <div class="">
                                    </div>
                                    <div class="">
                                        <h5>@uang(10000)</h5>
                                        <p>Keluar</p>
                                    </div>
                                </div>
                                <hr class="my-0  bg-white w-50">
                                <div class="pb-2 mt-2">
                                    <h6>@uang(10000)</h6>
                                </div>
                            </div>
                            {{-- <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a> --}}
                        </div>
                    </div>
                    <div class="col-lg-3 col-12">
                        <div class="small-box bg-success mb-2">
                            <div class="inner pb-0">
                                <div class="text-center mb-1">
                                    <b>Arus penjualan</b> (belum)
                                </div>
                                <div class="d-flex justify-content-around">
                                    <div class="">
                                        <h5>@uang(31312)</h5>
                                        <p>Harga jual</p>
                                    </div>
                                    <div class="">
                                    </div>
                                    <div class="">
                                        <h5>@uang(232234)</h5>
                                        <p>Harga beli</p>

                                    </div>
                                </div>
                                <hr class="my-0  bg-white w-50">
                                <div class="pb-2 mt-2">
                                    <h6>@uang(10000)</h6>
                                </div>
                            </div>
                            {{-- <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a> --}}
                        </div>
                    </div>
                    <div class="col-lg-3 col-12">
                        <div class="small-box bg-success mb-2">
                            <div class="inner pb-0">
                                <div class="text-center mb-1">
                                    <b>Arus transaksi</b> (belum)
                                </div>
                                <div class="d-flex justify-content-around">
                                    <div class="">
                                        <h5>@uang(224124)</h5>
                                        <p>Penjualan</p>
                                    </div>
                                    <div class="">
                                    </div>
                                    <div class="">
                                        <h5>@uang(212123)</h5>
                                        <p>Pembelian</p>

                                    </div>
                                </div>
                                <hr class="my-0  bg-white w-50">
                                <div class="pb-2 mt-2">
                                    <h6>@uang(10000)</h6>
                                </div>
                            </div>
                            {{-- <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a> --}}
                        </div>
                    </div>
                    <div class="col-lg-3 col-12">
                        <div class="small-box bg-success mb-2">
                            <div class="inner pb-0">
                                <div class="text-center mb-1">
                                    <b>Laba bersih</b> (belum)
                                </div>
                                <div class="d-flex pb-0 justify-content-around">
                                    <div class="">
                                        <h5>@uang(20000)</h5>
                                        <p>Pendapatan</p>
                                    </div>
                                    <div class="">
                                    </div>
                                    <div class="">
                                        <h5>@uang(10000)</h5>
                                        <p>Pengeluaran</p>
                                    </div>
                                </div>
                                <hr class="my-0  bg-white w-50">
                                <div class="pb-2 mt-2">
                                    <h6>@uang(10000)</h6>
                                </div>
                            </div>
                            {{-- <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a> --}}
                        </div>
                    </div>

                </div>

                <hr>





                {{-- <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>150</h3>
                                <p>New Orders</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>53<sup style="font-size: 20px">%</sup></h3>

                                <p>Bounce Rate</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>44</h3>

                                <p>User Registrations</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>65</h3>

                                <p>Unique Visitors</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div> --}}
                <hr>
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="">
                            <b>Tren Saldo Kas 30 hari terakhir</b>
                            {{-- kas masuk - kas keluar --}}
                        </div>
                        <div>
                            <canvas id="TrenSaldoHari" height="90"></canvas>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="">
                            <b>Tren Saldo Kas 12 Bulan terakhir</b>
                        </div>
                        <div>
                            <canvas id="TrenSaldoBulan" height="90"></canvas>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="">
                            <b>Arus Kas 30 hari terakhir</b>
                        </div>
                        <div>
                            <canvas id="ArusKasHari" height="90"></canvas>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="">
                            <b>Arus Kas 12 Bulan terakhir</b>
                        </div>
                        <div>
                            <canvas id="ArusKasBulan" height="90"></canvas>
                        </div>
                    </div>
                </div>
                <hr>

                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="">
                            <b>Arus Penjualan 30 hari terakhir</b>
                        </div>
                        <div>
                            <canvas id="ArusPenjualanHari" height="90"></canvas>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="">
                            <b>Arus Penjualan 12 Bulan terakhir</b>
                        </div>
                        <div>
                            <canvas id="ArusPenjualanBulan" height="90"></canvas>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="">
                            <b>Arus transaksi 30 hari terakhir</b>
                        </div>
                        <div>
                            <canvas id="" height="90"></canvas>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="">
                            <b>Arus transaksi 12 Bulan terakhir</b>
                        </div>
                        <div>
                            <canvas id="" height="90"></canvas>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="">
                            <b>Laba bersih 30 hari terakhir</b>
                        </div>
                        <div>
                            <canvas id="" height="90"></canvas>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="">
                            <b>Laba bersih 12 Bulan terakhir</b>
                        </div>
                        <div>
                            <canvas id="" height="90"></canvas>
                        </div>
                    </div>
                </div>
                <hr>



            </div>
            @elseif(auth()->user()->role == 'staff')
            @endif
        </section>
    </div>


</div>


<style>
    .card-text {
        font-size: 14px;
    }
</style>



@push('script')
    <script src="{{ asset('vendor/chart-4.2.0/dist/chart.umd.js') }}"></script>

    <script>
        new Chart(document.getElementById('ArusKasHari'), {
            type: 'bar',
            data: {
                labels: [
                    "{{ date('d', strtotime('-30 day')) }}",
                    "{{ date('d', strtotime('-29 day')) }}",
                    "{{ date('d', strtotime('-28 day')) }}",
                    "{{ date('d', strtotime('-27 day')) }}",
                    "{{ date('d', strtotime('-26 day')) }}",
                    "{{ date('d', strtotime('-25 day')) }}",
                    "{{ date('d', strtotime('-24 day')) }}",
                    "{{ date('d', strtotime('-23 day')) }}",
                    "{{ date('d', strtotime('-22 day')) }}",
                    "{{ date('d', strtotime('-21 day')) }}",
                    "{{ date('d', strtotime('-20 day')) }}",
                    "{{ date('d', strtotime('-19 day')) }}",
                    "{{ date('d', strtotime('-18 day')) }}",
                    "{{ date('d', strtotime('-17 day')) }}",
                    "{{ date('d', strtotime('-16 day')) }}",
                    "{{ date('d', strtotime('-15 day')) }}",
                    "{{ date('d', strtotime('-14 day')) }}",
                    "{{ date('d', strtotime('-13 day')) }}",
                    "{{ date('d', strtotime('-12 day')) }}",
                    "{{ date('d', strtotime('-11 day')) }}",
                    "{{ date('d', strtotime('-10 day')) }}",
                    "{{ date('d', strtotime('-09 day')) }}",
                    "{{ date('d', strtotime('-08 day')) }}",
                    "{{ date('d', strtotime('-07 day')) }}",
                    "{{ date('d', strtotime('-06 day')) }}",
                    "{{ date('d', strtotime('-05 day')) }}",
                    "{{ date('d', strtotime('-04 day')) }}",
                    "{{ date('d', strtotime('-03 day')) }}",
                    "{{ date('d', strtotime('-02 day')) }}",
                    "{{ date('d', strtotime('-01 day')) }}",
                    "{{ date('d') }}"
                ],
                datasets: [{
                        label: 'Masuk',
                        data: [
                            {{ $KasTMasukminD30 }},
                            {{ $KasTMasukminD29 }},
                            {{ $KasTMasukminD28 }},
                            {{ $KasTMasukminD27 }},
                            {{ $KasTMasukminD26 }},
                            {{ $KasTMasukminD25 }},
                            {{ $KasTMasukminD24 }},
                            {{ $KasTMasukminD23 }},
                            {{ $KasTMasukminD22 }},
                            {{ $KasTMasukminD21 }},
                            {{ $KasTMasukminD20 }},
                            {{ $KasTMasukminD19 }},
                            {{ $KasTMasukminD18 }},
                            {{ $KasTMasukminD17 }},
                            {{ $KasTMasukminD16 }},
                            {{ $KasTMasukminD15 }},
                            {{ $KasTMasukminD14 }},
                            {{ $KasTMasukminD13 }},
                            {{ $KasTMasukminD12 }},
                            {{ $KasTMasukminD11 }},
                            {{ $KasTMasukminD10 }},
                            {{ $KasTMasukminD09 }},
                            {{ $KasTMasukminD08 }},
                            {{ $KasTMasukminD07 }},
                            {{ $KasTMasukminD06 }},
                            {{ $KasTMasukminD05 }},
                            {{ $KasTMasukminD04 }},
                            {{ $KasTMasukminD03 }},
                            {{ $KasTMasukminD02 }},
                            {{ $KasTMasukminD01 }},
                            {{ $KasTMasukminD00 }},
                        ],
                        borderColor: '#7fff00',
                        backgroundColor: '#00ff00',
                        borderWidth: 1
                    },
                    {
                        label: 'Keluar',
                        data: [
                            {{ $KasTKeluarminD30 }},
                            {{ $KasTKeluarminD29 }},
                            {{ $KasTKeluarminD28 }},
                            {{ $KasTKeluarminD27 }},
                            {{ $KasTKeluarminD26 }},
                            {{ $KasTKeluarminD25 }},
                            {{ $KasTKeluarminD24 }},
                            {{ $KasTKeluarminD23 }},
                            {{ $KasTKeluarminD22 }},
                            {{ $KasTKeluarminD21 }},
                            {{ $KasTKeluarminD20 }},
                            {{ $KasTKeluarminD19 }},
                            {{ $KasTKeluarminD18 }},
                            {{ $KasTKeluarminD17 }},
                            {{ $KasTKeluarminD16 }},
                            {{ $KasTKeluarminD15 }},
                            {{ $KasTKeluarminD14 }},
                            {{ $KasTKeluarminD13 }},
                            {{ $KasTKeluarminD12 }},
                            {{ $KasTKeluarminD11 }},
                            {{ $KasTKeluarminD10 }},
                            {{ $KasTKeluarminD09 }},
                            {{ $KasTKeluarminD08 }},
                            {{ $KasTKeluarminD07 }},
                            {{ $KasTKeluarminD06 }},
                            {{ $KasTKeluarminD05 }},
                            {{ $KasTKeluarminD04 }},
                            {{ $KasTKeluarminD03 }},
                            {{ $KasTKeluarminD02 }},
                            {{ $KasTKeluarminD01 }},
                            {{ $KasTKeluarminD00 }},
                        ],
                        borderColor: '#FF6384',
                        backgroundColor: '#ff4d4d',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        new Chart(document.getElementById('ArusKasBulan'), {
            type: 'bar',
            data: {
                labels: [
                    "{{ date('F,Y', strtotime('-12 month')) }}",
                    "{{ date('F,Y', strtotime('-11 month')) }}",
                    "{{ date('F,Y', strtotime('-10 month')) }}",
                    "{{ date('F,Y', strtotime('-09 month')) }}",
                    "{{ date('F,Y', strtotime('-08 month')) }}",
                    "{{ date('F,Y', strtotime('-07 month')) }}",
                    "{{ date('F,Y', strtotime('-06 month')) }}",
                    "{{ date('F,Y', strtotime('-05 month')) }}",
                    "{{ date('F,Y', strtotime('-04 month')) }}",
                    "{{ date('F,Y', strtotime('-03 month')) }}",
                    "{{ date('F,Y', strtotime('-02 month')) }}",
                    "{{ date('F,Y', strtotime('-01 month')) }}",
                    "{{ date('F,Y') }}"
                ],
                datasets: [{
                        label: 'Masuk',
                        data: [
                            {{ $KasTMasukminM12 }},
                            {{ $KasTMasukminM11 }},
                            {{ $KasTMasukminM10 }},
                            {{ $KasTMasukminM09 }},
                            {{ $KasTMasukminM08 }},
                            {{ $KasTMasukminM07 }},
                            {{ $KasTMasukminM06 }},
                            {{ $KasTMasukminM05 }},
                            {{ $KasTMasukminM04 }},
                            {{ $KasTMasukminM03 }},
                            {{ $KasTMasukminM02 }},
                            {{ $KasTMasukminM01 }},
                            {{ $KasTMasukminM00 }},
                        ],
                        borderColor: '#7fff00',
                        backgroundColor: '#00ff00',
                        borderWidth: 1
                    },
                    {
                        label: 'Keluar',
                        data: [
                            {{ $KasTKeluarminM12 }},
                            {{ $KasTKeluarminM11 }},
                            {{ $KasTKeluarminM10 }},
                            {{ $KasTKeluarminM09 }},
                            {{ $KasTKeluarminM08 }},
                            {{ $KasTKeluarminM07 }},
                            {{ $KasTKeluarminM06 }},
                            {{ $KasTKeluarminM05 }},
                            {{ $KasTKeluarminM04 }},
                            {{ $KasTKeluarminM03 }},
                            {{ $KasTKeluarminM02 }},
                            {{ $KasTKeluarminM01 }},
                            {{ $KasTKeluarminM00 }},
                        ],
                        borderColor: '#FF6384',
                        backgroundColor: '#ff4d4d',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // ========================================================
        // ArusPenjualanHari

        new Chart(document.getElementById('ArusPenjualanHari'), {
            type: 'bar',
            data: {
                labels: [
                    "{{ date('d', strtotime('-30 day')) }}",
                    "{{ date('d', strtotime('-29 day')) }}",
                    "{{ date('d', strtotime('-28 day')) }}",
                    "{{ date('d', strtotime('-27 day')) }}",
                    "{{ date('d', strtotime('-26 day')) }}",
                    "{{ date('d', strtotime('-25 day')) }}",
                    "{{ date('d', strtotime('-24 day')) }}",
                    "{{ date('d', strtotime('-23 day')) }}",
                    "{{ date('d', strtotime('-22 day')) }}",
                    "{{ date('d', strtotime('-21 day')) }}",
                    "{{ date('d', strtotime('-20 day')) }}",
                    "{{ date('d', strtotime('-19 day')) }}",
                    "{{ date('d', strtotime('-18 day')) }}",
                    "{{ date('d', strtotime('-17 day')) }}",
                    "{{ date('d', strtotime('-16 day')) }}",
                    "{{ date('d', strtotime('-15 day')) }}",
                    "{{ date('d', strtotime('-14 day')) }}",
                    "{{ date('d', strtotime('-13 day')) }}",
                    "{{ date('d', strtotime('-12 day')) }}",
                    "{{ date('d', strtotime('-11 day')) }}",
                    "{{ date('d', strtotime('-10 day')) }}",
                    "{{ date('d', strtotime('-09 day')) }}",
                    "{{ date('d', strtotime('-08 day')) }}",
                    "{{ date('d', strtotime('-07 day')) }}",
                    "{{ date('d', strtotime('-06 day')) }}",
                    "{{ date('d', strtotime('-05 day')) }}",
                    "{{ date('d', strtotime('-04 day')) }}",
                    "{{ date('d', strtotime('-03 day')) }}",
                    "{{ date('d', strtotime('-02 day')) }}",
                    "{{ date('d', strtotime('-01 day')) }}",
                    "{{ date('d') }}"
                ],
                datasets: [
                    {
                        label: 'Harga pokok',
                        data: [
                            {{ $total_harga_pokokPenjualanD30 }},
                            {{ $total_harga_pokokPenjualanD29 }},
                            {{ $total_harga_pokokPenjualanD28 }},
                            {{ $total_harga_pokokPenjualanD27 }},
                            {{ $total_harga_pokokPenjualanD26 }},
                            {{ $total_harga_pokokPenjualanD25 }},
                            {{ $total_harga_pokokPenjualanD24 }},
                            {{ $total_harga_pokokPenjualanD23 }},
                            {{ $total_harga_pokokPenjualanD22 }},
                            {{ $total_harga_pokokPenjualanD21 }},
                            {{ $total_harga_pokokPenjualanD20 }},
                            {{ $total_harga_pokokPenjualanD19 }},
                            {{ $total_harga_pokokPenjualanD18 }},
                            {{ $total_harga_pokokPenjualanD17 }},
                            {{ $total_harga_pokokPenjualanD16 }},
                            {{ $total_harga_pokokPenjualanD15 }},
                            {{ $total_harga_pokokPenjualanD14 }},
                            {{ $total_harga_pokokPenjualanD13 }},
                            {{ $total_harga_pokokPenjualanD12 }},
                            {{ $total_harga_pokokPenjualanD11 }},
                            {{ $total_harga_pokokPenjualanD10 }},
                            {{ $total_harga_pokokPenjualanD09 }},
                            {{ $total_harga_pokokPenjualanD08 }},
                            {{ $total_harga_pokokPenjualanD07 }},
                            {{ $total_harga_pokokPenjualanD06 }},
                            {{ $total_harga_pokokPenjualanD05 }},
                            {{ $total_harga_pokokPenjualanD04 }},
                            {{ $total_harga_pokokPenjualanD03 }},
                            {{ $total_harga_pokokPenjualanD02 }},
                            {{ $total_harga_pokokPenjualanD01 }},
                            {{ $total_harga_pokokPenjualanD00 }},

                        ],
                        borderColor: '#a52a2a',
                        backgroundColor: '#dc143c',
                        borderWidth: 1
                    },
                    {
                        label: 'Harga jual',
                        data: [
                            {{ $total_harga_jualPenjualanD30 }},
                            {{ $total_harga_jualPenjualanD29 }},
                            {{ $total_harga_jualPenjualanD28 }},
                            {{ $total_harga_jualPenjualanD27 }},
                            {{ $total_harga_jualPenjualanD26 }},
                            {{ $total_harga_jualPenjualanD25 }},
                            {{ $total_harga_jualPenjualanD24 }},
                            {{ $total_harga_jualPenjualanD23 }},
                            {{ $total_harga_jualPenjualanD22 }},
                            {{ $total_harga_jualPenjualanD21 }},
                            {{ $total_harga_jualPenjualanD20 }},
                            {{ $total_harga_jualPenjualanD19 }},
                            {{ $total_harga_jualPenjualanD18 }},
                            {{ $total_harga_jualPenjualanD17 }},
                            {{ $total_harga_jualPenjualanD16 }},
                            {{ $total_harga_jualPenjualanD15 }},
                            {{ $total_harga_jualPenjualanD14 }},
                            {{ $total_harga_jualPenjualanD13 }},
                            {{ $total_harga_jualPenjualanD12 }},
                            {{ $total_harga_jualPenjualanD11 }},
                            {{ $total_harga_jualPenjualanD10 }},
                            {{ $total_harga_jualPenjualanD09 }},
                            {{ $total_harga_jualPenjualanD08 }},
                            {{ $total_harga_jualPenjualanD07 }},
                            {{ $total_harga_jualPenjualanD06 }},
                            {{ $total_harga_jualPenjualanD05 }},
                            {{ $total_harga_jualPenjualanD04 }},
                            {{ $total_harga_jualPenjualanD03 }},
                            {{ $total_harga_jualPenjualanD02 }},
                            {{ $total_harga_jualPenjualanD01 }},
                            {{ $total_harga_jualPenjualanD00 }},

                        ],
                        borderColor: '#1e90ff',
                        backgroundColor: '#00bfff',
                        borderWidth: 1
                    },
                    {
                        label: 'Omset',
                        data: [
                            {{ $omsetPendapatanD30 }},
                            {{ $omsetPendapatanD29 }},
                            {{ $omsetPendapatanD28 }},
                            {{ $omsetPendapatanD27 }},
                            {{ $omsetPendapatanD26 }},
                            {{ $omsetPendapatanD25 }},
                            {{ $omsetPendapatanD24 }},
                            {{ $omsetPendapatanD23 }},
                            {{ $omsetPendapatanD22 }},
                            {{ $omsetPendapatanD21 }},
                            {{ $omsetPendapatanD20 }},
                            {{ $omsetPendapatanD19 }},
                            {{ $omsetPendapatanD18 }},
                            {{ $omsetPendapatanD17 }},
                            {{ $omsetPendapatanD16 }},
                            {{ $omsetPendapatanD15 }},
                            {{ $omsetPendapatanD14 }},
                            {{ $omsetPendapatanD13 }},
                            {{ $omsetPendapatanD12 }},
                            {{ $omsetPendapatanD11 }},
                            {{ $omsetPendapatanD10 }},
                            {{ $omsetPendapatanD09 }},
                            {{ $omsetPendapatanD08 }},
                            {{ $omsetPendapatanD07 }},
                            {{ $omsetPendapatanD06 }},
                            {{ $omsetPendapatanD05 }},
                            {{ $omsetPendapatanD04 }},
                            {{ $omsetPendapatanD03 }},
                            {{ $omsetPendapatanD02 }},
                            {{ $omsetPendapatanD01 }},
                            {{ $omsetPendapatanD00 }},

                        ],
                        borderColor: '#ffa500',
                        backgroundColor: '#ffff00',
                        borderWidth: 1
                    },
                    {
                        label: 'untung',
                        data: [
                            {{ $untungPendapatanD30 }},
                            {{ $untungPendapatanD29 }},
                            {{ $untungPendapatanD28 }},
                            {{ $untungPendapatanD27 }},
                            {{ $untungPendapatanD26 }},
                            {{ $untungPendapatanD25 }},
                            {{ $untungPendapatanD24 }},
                            {{ $untungPendapatanD23 }},
                            {{ $untungPendapatanD22 }},
                            {{ $untungPendapatanD21 }},
                            {{ $untungPendapatanD20 }},
                            {{ $untungPendapatanD19 }},
                            {{ $untungPendapatanD18 }},
                            {{ $untungPendapatanD17 }},
                            {{ $untungPendapatanD16 }},
                            {{ $untungPendapatanD15 }},
                            {{ $untungPendapatanD14 }},
                            {{ $untungPendapatanD13 }},
                            {{ $untungPendapatanD12 }},
                            {{ $untungPendapatanD11 }},
                            {{ $untungPendapatanD10 }},
                            {{ $untungPendapatanD09 }},
                            {{ $untungPendapatanD08 }},
                            {{ $untungPendapatanD07 }},
                            {{ $untungPendapatanD06 }},
                            {{ $untungPendapatanD05 }},
                            {{ $untungPendapatanD04 }},
                            {{ $untungPendapatanD03 }},
                            {{ $untungPendapatanD02 }},
                            {{ $untungPendapatanD01 }},
                            {{ $untungPendapatanD00 }},

                        ],
                        borderColor: '#32cd32',
                        backgroundColor: '#00ff00',
                        borderWidth: 1
                    },

                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // ArusPenjualanBulan

        new Chart(document.getElementById('ArusPenjualanBulan'), {
            type: 'bar',
            data: {
                labels: [
                    "{{ date('F,Y', strtotime('-12 month')) }}",
                    "{{ date('F,Y', strtotime('-11 month')) }}",
                    "{{ date('F,Y', strtotime('-10 month')) }}",
                    "{{ date('F,Y', strtotime('-09 month')) }}",
                    "{{ date('F,Y', strtotime('-08 month')) }}",
                    "{{ date('F,Y', strtotime('-07 month')) }}",
                    "{{ date('F,Y', strtotime('-06 month')) }}",
                    "{{ date('F,Y', strtotime('-05 month')) }}",
                    "{{ date('F,Y', strtotime('-04 month')) }}",
                    "{{ date('F,Y', strtotime('-03 month')) }}",
                    "{{ date('F,Y', strtotime('-02 month')) }}",
                    "{{ date('F,Y', strtotime('-01 month')) }}",
                    "{{ date('F,Y') }}"
                ],
                datasets: [
                    {
                        label: 'Harga pokok',
                        data: [
                            {{ $total_harga_pokokPenjualanB12 }},
                            {{ $total_harga_pokokPenjualanB11 }},
                            {{ $total_harga_pokokPenjualanB10 }},
                            {{ $total_harga_pokokPenjualanB09 }},
                            {{ $total_harga_pokokPenjualanB08 }},
                            {{ $total_harga_pokokPenjualanB07 }},
                            {{ $total_harga_pokokPenjualanB06 }},
                            {{ $total_harga_pokokPenjualanB05 }},
                            {{ $total_harga_pokokPenjualanB04 }},
                            {{ $total_harga_pokokPenjualanB03 }},
                            {{ $total_harga_pokokPenjualanB02 }},
                            {{ $total_harga_pokokPenjualanB01 }},
                            {{ $total_harga_pokokPenjualanB00 }},
                        ],
                        borderColor: '#a52a2a',
                        backgroundColor: '#dc143c',
                        borderWidth: 1
                    },
                    {
                        label: 'Harga jual',
                        data: [
                            {{ $total_harga_jualPenjualanB12 }},
                            {{ $total_harga_jualPenjualanB11 }},
                            {{ $total_harga_jualPenjualanB10 }},
                            {{ $total_harga_jualPenjualanB09 }},
                            {{ $total_harga_jualPenjualanB08 }},
                            {{ $total_harga_jualPenjualanB07 }},
                            {{ $total_harga_jualPenjualanB06 }},
                            {{ $total_harga_jualPenjualanB05 }},
                            {{ $total_harga_jualPenjualanB04 }},
                            {{ $total_harga_jualPenjualanB03 }},
                            {{ $total_harga_jualPenjualanB02 }},
                            {{ $total_harga_jualPenjualanB01 }},
                            {{ $total_harga_jualPenjualanB00 }},
                        ],
                        borderColor: '#1e90ff',
                        backgroundColor: '#00bfff',
                        borderWidth: 1
                    },
                    {
                        label: 'Omset',
                        data: [
                            {{ $omsetPenjualanB12 }},
                            {{ $omsetPenjualanB11 }},
                            {{ $omsetPenjualanB10 }},
                            {{ $omsetPenjualanB09 }},
                            {{ $omsetPenjualanB08 }},
                            {{ $omsetPenjualanB07 }},
                            {{ $omsetPenjualanB06 }},
                            {{ $omsetPenjualanB05 }},
                            {{ $omsetPenjualanB04 }},
                            {{ $omsetPenjualanB03 }},
                            {{ $omsetPenjualanB02 }},
                            {{ $omsetPenjualanB01 }},
                            {{ $omsetPenjualanB00 }},
                        ],
                        borderColor: '#ffa500',
                        backgroundColor: '#ffff00',
                        borderWidth: 1
                    },
                    {
                        label: 'Untung',
                        data: [
                            {{ $untungPenjualanB12 }},
                            {{ $untungPenjualanB11 }},
                            {{ $untungPenjualanB10 }},
                            {{ $untungPenjualanB09 }},
                            {{ $untungPenjualanB08 }},
                            {{ $untungPenjualanB07 }},
                            {{ $untungPenjualanB06 }},
                            {{ $untungPenjualanB05 }},
                            {{ $untungPenjualanB04 }},
                            {{ $untungPenjualanB03 }},
                            {{ $untungPenjualanB02 }},
                            {{ $untungPenjualanB01 }},
                            {{ $untungPenjualanB00 }},
                        ],
                        borderColor: '#32cd32',
                        backgroundColor: '#00ff00',
                        borderWidth: 1
                    },

                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

    </script>
@endpush
