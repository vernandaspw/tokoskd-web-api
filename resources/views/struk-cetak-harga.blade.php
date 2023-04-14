<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nota Kecil</title>
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
                                        font-size: 14px;
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
                                        width: 44mm;
                                        color: black;
                                    }
                                    .btn-print {
                                        display: none;
                                    }
                                    .text-h {
                                        font-size: 14px;
                                    }
                                    .item td {
                                        font-size: 8px;
                                    }
                                    .total td{
                                        height: 2px;
                                        font-size: 8px;
                                    }
                                    .borders{
                                        border-style: none;
                                    border-width: 0px;
                                    }
                                    .head-h{
                                        height: 9px;
                                    }
                                    .totalH{
                                        height: 10px;
                                    }
                                    .totalT{
                                        font-size: 12px;
                                    }
                                    .textItem{
                                        font-size: 10px;
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
     <p class="text-center mb-0 pb-0">-- Tempel pada rak --</p>
     {{-- <div class="mb-1 mt-2" style="border-bottom: solid 1px"></div> --}}
            <div class="v1">
                @forelse ($datas as $data)
                <div class="mb-1 mt-3" style="border-bottom: solid 1px"></div>
                <div class="mt-1 mb-1">
                    <div class="d-flex head-h w-100 mb-2">
                        <div class="col text-center text-h"><b>{{ $data->produk->nama }}</b></div>
                    </div>
                    @foreach ($data->produk->produk_item as $item)
                    <div class="d-flex totalH mb-1">
                        <div class="col text-start totalT">{{ $item->satuan->satuan }}</div>
                        <div class="col-auto text-end totalT">@uang($item->harga_jual)</div>
                    </div>
                    @endforeach

                </div>
                @empty
                Tidak ada produk untuk dicetak harga
                @endforelse
            </div>

            <div class="mt-0">

                {{-- <table class="m-0 heads" style="border: 0;">
                    <tr class="m-0 p-0">
                        <td style="width:20%" class="text-h text-start">No Order</td>
                        <td style="width: 80%" class="text-h text-end">242242424</td>
                    </tr>
                    <tr class="m-0 p-0">
                        <td style="width:20%" class="text-h text-start">Waktu</td>
                        <td style="width: 80%" class="text-h text-end">{{ date('Y-m-d : H:i:s', strtotime(now())) }}</td>
                    </tr>
                    <tr class="m-0 p-0">
                        <td style="width:20%" class="text-h text-start">Kasir</td>
                        <td style="width: 80%" class="text-h text-end">Kasir 1| {{ strtoupper('aaa') }}</td>
                    </tr>
                    <tr class="m-0 p-0">
                        <td style="width:20%" class="text-h text-start">Pelanggan</td>
                        <td style="width: 80%" class="text-h text-end"> ~ </td>
                    </tr>
                </table> --}}
            </div>

            {{-- <div class="mt-1" style="border-bottom: solid 1px"></div> --}}

            {{-- <div class="mt-1 mb-1">
                <ul class="list-group list-group-flush p-0 m-0">
                    <li class="list-group-item p-0 m-0">
                        <div class="textItem">
                            dawdwadwadwadwadwadwdawdwadwa wadawdwad wdwadwad wadwa
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="col text-left textItem">300x @nominal(1000000) (@diskon(20.0)) (liter)</div>
                            <div class="col-auto text-start textItem">@uang(20000000)</div>
                        </div>
                    </li>
                </ul>
            </div> --}}

            {{-- <div class="item mb-1">
                <div class="">
                    <div class="text-left textItem">
                        dawdwadwadwadwadwadwdawdwadwa wadawdwad wdwadwad wadwa
                    </div>
                    <div class="">
                        <div class="d-flex">
                            <div class="col text-left textItem">300x @nominal(1000000) (@diskon(20.0)) (liter)</div>
                            <div class="col-auto text-start textItem">@uang(20000000)</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item mb-1">
                <div class="">
                    <div class="text-left textItem">
                        dawdwadwadwadwadwadwdawdwadwa
                    </div>
                    <div class="">
                        <div class="d-flex">
                            <div class="col text-left textItem">300x @nominal(100000) (@diskon(20.0)) (liter)</div>
                            <div class="col-auto text-start textItem">@uang(20000000)</div>
                        </div>
                    </div>
                </div>
            </div> --}}
            {{-- <div class="item">
                <div class="header" >
                    <p class="textItem" style="line-height: 1px">
                        Nama produk apa saja yang penting jadi lah ya
                    </p>
                </div>
            </div> --}}


            {{-- <table style="width: 100%" class="item text-dark" style="border: 0;">
                @foreach ($data->penjualan_item as $item)
                <tr class="">
                    <td colspan="2" class="">
                        <p  class="textItem">{{ strtolower($item->produk->nama) }} ({{ strtolower($item->satuan->satuan) }})
                        </p>
                    </td>
                </tr>
                <tr style="height: 15px" class="d-flex align-items-start justify-content-between">
                    <td  class="text-left" col>
                    <p  class="textItem ">
                        {{ $item->qty }}x @nominal($item->harga_jual) @if ($item->diskon_persen > 0)@diskon($item->diskon_persen) @endif
                    </p>
                    </td>
                    <td  class="text-right col-auto">
                        <p  class="textItem text-right">@nominal($item->total_harga_jual)</p>
                    </td>
                </tr>
                @endforeach
            </table> --}}



            {{-- <table width="100%" class="m-0 total" style="border: 0;">
                <tr>
                    <td>Total Harga jual:</td>
                    <td class="text-right">@uang(20000000)</td>
                </tr>
                <tr>
                    <td>Potongan diskon:</td>
                    <td class="text-right">@uang(20000000)</td>
                </tr>
                <tr>
                    <td>Total harga:</td>
                    <td class="text-right">@uang(20000000)</td>
                </tr>
                <tr>
                    <td>Tagihan utang:</td>
                    <td class="text-right">@uang(22221)</td>
                </tr>
                <tr>
                    <td>Ongkir:</td>
                    <td class="text-right">@uang(22221)</td>
                </tr>
                <tr>
                    <td>Potongan utang toko:</td>
                    <td class="text-right">@uang(22221)</td>
                </tr>

                <tr>
                    <td>Total Pembayaran:</td>
                    <td class="text-right">@uang(22221)</td>
                </tr>
                <tr>
                    <td>Diterima:</td>
                    <td class="text-right">@uang(2323)</td>
                </tr>
                <tr>
                    <td>Kembali:</td>
                    <td class="text-right">@uang(2242424)</td>
                </tr>
            </table> --}}

            {{-- <div class="mt-1" style="border-bottom: solid 1px"></div> --}}

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
