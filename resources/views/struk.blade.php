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
                                    // width: 50%;


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
                                        font-size: 8px;
                                    }
                                    .item td {
                                        font-size: 6px;
                                    }
                                    .total td{
                                        height: 2px;
                                        font-size: 7px;
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
                                        font-size: 9px;
                                    }
                                    .textItem{
                                        font-size: 9px;
                                        // height: 9px;
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
                <h5 style="margin-bottom: 1px;">SKD</h5>
                <p class="p-0">jl. kkkk</p>
            </div>

            <div class="mt-2">
                <div class="d-flex justify-content-center head-h">
                    <div class="text-start text-h">
                        {{ date('Y-m-d', strtotime(now())) }}
                    </div>
                    <div class="text-end text-h">
                        {{ date('H:i', strtotime(now())) }}
                    </div>
                </div>
                <div class="d-flex head-h">
                    <div class="col text-start text-h">No Order</div>
                    <div class="col-auto text-end text-h">242242424</div>
                </div>
                <div class="d-flex head-h">
                    <div class="col text-start text-h">Kasir</div>
                    <div class="col-auto text-end text-h">Kasir 1| {{ strtoupper('aaa') }}</div>
                </div>
                <div class="d-flex head-h">
                    <div class="col text-start text-h">Pelanggan</div>
                    <div class="col-auto text-end text-h">{{ strtoupper('pelanggan') }}</div>
                </div>

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

            <div class="mt-1" style="border-bottom: solid 1px"></div>

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
            <table width="100%" class="item" style="border: 0;">
                <tr class="">
                    <td colspan="2" class="">
                        <p  class="textItem">awdwadwadwadddddddddd awdawdwadwa awdwaaaaaaaaaa wadawdawdwa (liter)
                        </p>
                    </td>
                </tr>
                <tr style="height: 15px" class="d-flex align-items-start">
                    <td style="width: 50%" class="text-left">
                    <p  class="textItem ">
                        300x @nominal(100000) @diskon(20.0)
                    </p>
                    </td>
                    <td style="width: 50%" class="text-right">
                        <p  class="textItem">@nominal(1000000)</p>
                    </td>
                </tr>
            </table>

            <div class="" style="border-bottom: solid 1px"></div>
            <div class="d-flex totalH">
                <div class="col text-start totalT">Total Harga jual:</div>
                <div class="col-auto text-end totalT">@uang(200000000)</div>
            </div>
            <div class="d-flex totalH">
                <div class="col text-start totalT">Potongan diskon:</div>
                <div class="col-auto text-end totalT">@uang(20000000)</div>
            </div>
            <div class="d-flex totalH">
                <div class="col text-start totalT">Total harga:</div>
                <div class="col-auto text-end totalT">@uang(20000000)</div>
            </div>
            <div class="d-flex totalH mt-1">
                <div class="col text-start totalT">Tagihan utang:</div>
                <div class="col-auto text-end totalT">@uang(20000000)</div>
            </div>
            <div class="d-flex totalH">
                <div class="col text-start totalT">Ongkir:</div>
                <div class="col-auto text-end totalT">@uang(20000000)</div>
            </div>
            <div class="d-flex totalH">
                <div class="col text-start totalT">Pajak:</div>
                <div class="col-auto text-end totalT">@uang(20000000)</div>
            </div>
            {{-- <div class="d-flex totalH">
                <div class="col      text-start totalT">Potongan utang toko:</div>
                <div class="col-auto text-end totalT ">@uang(20000000)</div>
            </div> --}}
            <div class="d-flex mt-1 justify-content-between totalH">
                <div class="col text-start totalT">Total Pembayaran:</div>
                <div class="col-auto text-end totalT">@uang(20000000)</div>
            </div>
            <div class="d-flex totalH">
                <div class="col text-start totalT">Diterima:</div>
                <div class="col-auto text-end totalT">@uang(20000000)</div>
            </div>
            <div class="d-flex totalH">
                <div class="col text-start totalT">Kembali</div>
                <div class="col-auto text-end totalT">@uang(20000000)</div>
            </div>

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

            <div class="mt-1" style="border-bottom: solid 1px"></div>
            <p class="text-center mb-0 pb-0">-- TERIMA KASIH --</p>
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
