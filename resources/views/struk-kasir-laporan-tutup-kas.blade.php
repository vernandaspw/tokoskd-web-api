<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan tutup kas</title>
    {{-- <link rel="stylesheet" href="{{ asset('vendor/AdminLTE-3.2.0/dist/css/adminlte.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('vendor/MDB5/css/mdb.min.css') }}">

    <style>
        body {
            background-color: transparent;
            color: black;
        }
    </style>

    <?php
    $style = '
                                <style>
                                    * {
                                        font-family: "consolas", sans-serif;
                                        color: black;
                                        width: 80%;



                                    }
                                    .borders{
                                        border-style: solid;
                                    border-width: 5px;
                                    }
                                    p {
                                        display: block;
                                        margin: 0px;
                                        font-size: 7pt;
                                    }
                                    .text-h {
                                            font-size: 12px;
                                        }
                                    table td {
                                        font-size: 10pt;
                                    }
                                    .text-center {
                                        text-align: center;
                                    }
                                    .text-right {
                                        text-align: right;
                                    }
                                    .totalH{
                                            height: 12px;
                                        }
                                        .totalT{
                                            font-size: 13px;
                                        }

                                    @media print {
                                        @page {
                                            margin: 0;
                                            size: 55mm;
                                            color: black;


                                ';
    ?>
    <?php
    $style .= !empty($_COOKIE['innerHeight']) ? $_COOKIE['innerHeight'] . 'mm; }' : '}';
    ?>
    <?php
    $style .= '
                                        *{
                                            width: 100%;
                                        }
                                        html, body {
                                            width: 48mm;
                                            color: black;
                                        }
                                        .btn-print {
                                            display: none;
                                        }
                                        .text-h {
                                            font-size: 10px;
                                        }
                                        .item td {
                                            font-size: 9px;
                                        }
                                        .total td{
                                            height: 2px;
                                            font-size: 9px;
                                        }
                                        .borders{
                                            border-style: none;
                                        border-width: 0px;
                                        }
                                        .head-h{
                                            height: 10px;
                                        }
                                        .totalH{
                                            height: 10px;
                                        }
                                        .totalT{
                                            font-size: 11px;
                                        }
                                        .textItem{
                                            font-size: 11px;
                                            line-height: 8px;
                                        }


                                    }
                                </style>
                                ';
    ?>

    {!! $style !!}
</head>

<body onload="window.print()">
    <button class="btn btn-print btn-info mb-3 d-print-none" style="width: 100px;"
        onclick="window.print()">Print</button>
    <div class="d-flex justify-content-center pt-1">
        <div class="borders">
            <div class="text-center">
                <h6 style="margin-bottom: 1px;">{{ $data->kasir->nama }}</h6>
                <p class="p-0">Laporan Tutup Kasir</p>
            </div>

            <div class="mt-1">
                {{-- <div class="d-flex justify-content-center head-h w-100">
                    <div class="text-start text-h">
                        {{ date('H:i', strtotime($data->waktu)) }}
                    </div>
                    <div class="text-end text-h">

                    </div>
                </div> --}}
                <div class="mt-1" style="border-bottom: solid 1px"></div>
                <div class="d-flex head-h w-100">
                    <div class="col text-start text-h">Jam buka</div>
                    <div class="col-auto text-end text-h">
                        {{ \Carbon\Carbon::parse($data->created_at)->isoFormat('D-MM-Y, HH:mm') }}</div>
                </div>
                <div class="d-flex head-h w-100">
                    <div class="col text-start text-h">Jam tutup</div>
                    <div class="col-auto text-end text-h">
                        {{ \Carbon\Carbon::parse($data->tutuo_at)->isoFormat('D-MM-Y, HH:mm') }}</div>
                </div>
                <div class="d-flex head-h w-100 mt-1">
                    <div class="col text-start text-h">Buka oleh</div>
                    <div class="col-auto text-end text-h">{{ $data->buka_olehs->nama }}</div>
                </div>
                <div class="d-flex head-h w-100 mt-0">
                    <div class="col text-start text-h">Tutup oleh</div>
                    <div class="col-auto text-end text-h">{{ $data->tutup_olehs->nama }}</div>
                </div>
                <div class="mt-1" style="border-bottom: solid 1px"></div>
                <div class="d-flex head-h w-100 mt-0">
                    <div class="col text-start text-h">Kas awal</div>
                    <div class="col-auto text-end text-h">@uang($data->kas_awal)</div>
                </div>
                <div class="d-flex head-h w-100 mt-0">
                    <div class="col text-start text-h">Uang masuk</div>
                    <div class="col-auto text-end text-h">@uang($data->total_uang_masuk)</div>
                </div>
                <div class="d-flex head-h w-100 mt-0">
                    <div class="col text-start text-h">Uang Keluar</div>
                    <div class="col-auto text-end text-h">@uang($data->total_uang_keluar)</div>
                </div>
                <div class="d-flex head-h w-100 mt-0">
                    <div class="col text-start text-h">Kas akhir buku</div>
                    <div class="col-auto text-end text-h">@uang($data->kas_akhir)</div>
                </div>
                <b>
                    <div class="d-flex head-h w-100 mt-1">
                        <div class="col text-start text-h">Kas tutup</div>
                        <div class="col-auto text-end text-h">@uang($data->kas_tutup)</div>
                    </div>
                    <div class="d-flex head-h w-100 mt-0">
                        <div class="col text-start text-h">Selisih</div>
                        <div class="col-auto text-end text-h">@uang($data->selisih)</div>
                    </div>
                </b>
                <div class="mt-1" style="border-bottom: solid 1px"></div>
                <div class="d-flex head-h w-100 mt-0">
                    <div class="col text-start text-h">Jml Penjualan</div>
                    <div class="col-auto text-end text-h">{{ $data->jumlah_transaksi }}</div>
                </div>
                <div class="d-flex head-h w-100 mt-0">
                    <div class="col text-start text-h">Uang tunai</div>
                    <div class="col-auto text-end text-h">@uang($data->uang_tunai)</div>
                </div>
                <div class="d-flex head-h w-100 mt-0">
                    <div class="col text-start text-h">Uang nontunai</div>
                    <div class="col-auto text-end text-h">@uang($data->uang_nontunai)</div>
                </div>
                <div class="d-flex head-h w-100 mt-0">
                    <div class="col text-start text-h">Tagihan utang</div>
                    <div class="col-auto text-end text-h">@uang($data->tagihan_utang)</div>
                </div>
                <div class="d-flex head-h w-100 mt-0">
                    <div class="col text-start text-h">Omset</div>
                    <div class="col-auto text-end text-h">@uang($data->omset)</div>
                </div>
                <div class="d-flex head-h w-100 mt-0">
                    <div class="col text-start text-h">Untung</div>
                    <div class="col-auto text-end text-h">@uang($data->untung)</div>
                </div>
                <div class="mt-1" style="border-bottom: solid 1px"></div>
                <p class="text-center mb-0 pb-0">-- Segera konfirm terima dilaporan --</p>
            </div>
        </div>

        <script>
            let body = document.body;
            let html = document.documentElement;
            let height = Math.max(
                body.scrollHeight, body.offsetHeight,
                html.clientHeight, html.scrollHeight, html.offsetHeight
            );

            document.cookie = "innerHeight=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            document.cookie = "innerHeight=" + ((height + 50) * 0.264583);

            <
            script src = "{{ asset('vendor/AdminLTE-3.2.0/plugins/jquery/jquery.min.js') }}" >
        </script>
        <!-- jQuery UI 1.11.4 -->
        <script src="{{ asset('vendor/AdminLTE-3.2.0/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('vendor/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('vendor/AdminLTE-3.2.0/dist/js/adminlte.js') }}"></script>
        </script>
</body>

</html>
