<?php
namespace App\Helpers;

// require __DIR__ . '/vendor/autoload.php';

use App\Models\Penjualan\Penjualan;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;

class PenjualanCetak
{
    public static function struk($id_penjualan)
    {
        try {
            /**
             * Printer Harus Dishare
             * Nama Printer Contoh: Generic
             */
            $komputer_name = gethostbyaddr($_SERVER['REMOTE_ADDR']);
            $nama_printer = "POS-58";
            // $connector = new WindowsPrintConnector("smb://".$komputer_name."/" . $nama_printer);
            $connector = new WindowsPrintConnector($nama_printer);
            // $connector = new NetworkPrintConnector($nama_printer);
            $printer = new Printer($connector);

            $data = Penjualan::find($id_penjualan);

            $no_order = $data->no_penjualan;
            $waktu = $data->waktu;
            $pelanggan = $data->pelanggan != null ? $data->pelanggan->nama : '-';
            $kasir = $data->kasir != null ? $data->kasir->nama : '-';
            $user = $data->user != null ? $data->user->nama : '-';

            // wajib sahre printer
            // cara pilih printer yang mau digunakan
            // control panel -> devices and printer -> pilih printer -> printer propeties -> sharing menu -> centang share this printer


            function buatBaris1Kolom($kolom1)
            {
                // Mengatur lebar setiap kolom (dalam satuan karakter)
                $lebar_kolom_1 = 39;

                // Melakukan wordwrap(), jadi jika karakter teks melebihi lebar kolom, ditambahkan \n
                $kolom1 = wordwrap($kolom1, $lebar_kolom_1, "\n", true);

                // Merubah hasil wordwrap menjadi array, kolom yang memiliki 2 index array berarti memiliki 2 baris (kena wordwrap)
                $kolom1Array = explode("\n", $kolom1);

                // Mengambil jumlah baris terbanyak dari kolom-kolom untuk dijadikan titik akhir perulangan
                $jmlBarisTerbanyak = count($kolom1Array);

                // Mendeklarasikan variabel untuk menampung kolom yang sudah di edit
                $hasilBaris = array();

                // Melakukan perulangan setiap baris (yang dibentuk wordwrap), untuk menggabungkan setiap kolom menjadi 1 baris
                for ($i = 0; $i < $jmlBarisTerbanyak; $i++) {

                    // memberikan spasi di setiap cell berdasarkan lebar kolom yang ditentukan,
                    $hasilKolom1 = str_pad((isset($kolom1Array[$i]) ? $kolom1Array[$i] : ""), $lebar_kolom_1, " ");

                    // Menggabungkan kolom tersebut menjadi 1 baris dan ditampung ke variabel hasil (ada 1 spasi disetiap kolom)
                    $hasilBaris[] = $hasilKolom1;
                }

                // Hasil yang berupa array, disatukan kembali menjadi string dan tambahkan \n disetiap barisnya.
                return implode($hasilBaris) . "\n";
            }

            function buatBaris3Kolom($kolom1, $kolom2, $kolom3)
            {
                // Mengatur lebar setiap kolom (dalam satuan karakter)
                $lebar_kolom_1 = 13;
                $lebar_kolom_2 = 13;
                $lebar_kolom_3 = 13;

                // Melakukan wordwrap(), jadi jika karakter teks melebihi lebar kolom, ditambahkan \n
                $kolom1 = wordwrap($kolom1, $lebar_kolom_1, "\n", true);
                $kolom2 = wordwrap($kolom2, $lebar_kolom_2, "\n", true);
                $kolom3 = wordwrap($kolom3, $lebar_kolom_3, "\n", true);

                // Merubah hasil wordwrap menjadi array, kolom yang memiliki 2 index array berarti memiliki 2 baris (kena wordwrap)
                $kolom1Array = explode("\n", $kolom1);
                $kolom2Array = explode("\n", $kolom2);
                $kolom3Array = explode("\n", $kolom3);

                // Mengambil jumlah baris terbanyak dari kolom-kolom untuk dijadikan titik akhir perulangan
                $jmlBarisTerbanyak = max(count($kolom1Array), count($kolom2Array), count($kolom3Array));

                // Mendeklarasikan variabel untuk menampung kolom yang sudah di edit
                $hasilBaris = array();

                // Melakukan perulangan setiap baris (yang dibentuk wordwrap), untuk menggabungkan setiap kolom menjadi 1 baris
                for ($i = 0; $i < $jmlBarisTerbanyak; $i++) {

                    // memberikan spasi di setiap cell berdasarkan lebar kolom yang ditentukan,
                    $hasilKolom1 = str_pad((isset($kolom1Array[$i]) ? $kolom1Array[$i] : ""), $lebar_kolom_1, " ");
                    // memberikan rata kanan pada kolom 3 dan 4 karena akan kita gunakan untuk harga dan total harga
                    $hasilKolom2 = str_pad((isset($kolom2Array[$i]) ? $kolom2Array[$i] : ""), $lebar_kolom_2, " ", STR_PAD_LEFT);

                    $hasilKolom3 = str_pad((isset($kolom3Array[$i]) ? $kolom3Array[$i] : ""), $lebar_kolom_3, " ", STR_PAD_LEFT);

                    // Menggabungkan kolom tersebut menjadi 1 baris dan ditampung ke variabel hasil (ada 1 spasi disetiap kolom)
                    $hasilBaris[] = $hasilKolom1 . " " . $hasilKolom2 . " " . $hasilKolom3;
                }

                // Hasil yang berupa array, disatukan kembali menjadi string dan tambahkan \n disetiap barisnya.
                return implode($hasilBaris) . "\n";
            }

            // /** RATA TENGAH */
            // $title = "TEST PRINTER ANTRIAN";
            // $printer->initialize();
            // $printer->setFont(Printer::FONT_B);
            // $printer->setJustification(Printer::JUSTIFY_CENTER);
            // $printer->text("Toko SKD\n");
            // $printer->setLineSpacing(5);
            // $printer->text("\n");

            // $printer->initialize();
            // $printer->setFont(Printer::FONT_B);
            // $printer->setJustification(Printer::JUSTIFY_CENTER);
            // $printer->text("Mulya jaya RT.03 \n");
            // $printer->setLineSpacing(5);
            // $printer->text("\n");

            // $printer->initialize();
            // $printer->setFont(Printer::FONT_B);
            // $printer->setJustification(Printer::JUSTIFY_CENTER);
            // $printer->text("-- Terima Kasih --\n");
            // $printer->text("\n");

            // $printer -> pulse();
            // $printer->cut();

            // /* Close printer */
            // $printer->close();



            function buat2kolom($kolom1, $kolom2)
            {
                // Mengatur lebar setiap kolom (dalam satuan karakter)
                $lebar_kolom_1 = 14;
                $lebar_kolom_2 = 25;

                // Melakukan wordwrap(), jadi jika karakter teks melebihi lebar kolom, ditambahkan \n
                $kolom1 = wordwrap($kolom1, $lebar_kolom_1, "\n", true);
                $kolom2 = wordwrap($kolom2, $lebar_kolom_2, "\n", true);

                // Merubah hasil wordwrap menjadi array, kolom yang memiliki 2 index array berarti memiliki 2 baris (kena wordwrap)
                $kolom1Array = explode("\n", $kolom1);
                $kolom2Array = explode("\n", $kolom2);

                // Mengambil jumlah baris terbanyak dari kolom-kolom untuk dijadikan titik akhir perulangan
                $jmlBarisTerbanyak = max(count($kolom1Array), count($kolom2Array));

                // Mendeklarasikan variabel untuk menampung kolom yang sudah di edit
                $hasilBaris = array();

                // Melakukan perulangan setiap baris (yang dibentuk wordwrap), untuk menggabungkan setiap kolom menjadi 1 baris
                for ($i = 0; $i < $jmlBarisTerbanyak; $i++) {

                    // memberikan spasi di setiap cell berdasarkan lebar kolom yang ditentukan,
                    $hasilKolom1 = str_pad((isset($kolom1Array[$i]) ? $kolom1Array[$i] : ""), $lebar_kolom_1, " ");
                    $hasilKolom2 = str_pad((isset($kolom2Array[$i]) ? $kolom2Array[$i] : ""), $lebar_kolom_2, " ", STR_PAD_LEFT);

                    // Menggabungkan kolom tersebut menjadi 1 baris dan ditampung ke variabel hasil (ada 1 spasi disetiap kolom)
                    $hasilBaris[] = $hasilKolom1 . " " . $hasilKolom2;
                }

                // Hasil yang berupa array, disatukan kembali menjadi string dan tambahkan \n disetiap barisnya.
                return implode($hasilBaris) . "\n";
            }

            function buat4kolom($kolom1, $kolom2, $kolom3, $kolom4)
            {
                // Mengatur lebar setiap kolom (dalam satuan karakter)
                $lebar_kolom_1 = 12;
                $lebar_kolom_2 = 8;
                $lebar_kolom_3 = 8;
                $lebar_kolom_4 = 9;

                // Melakukan wordwrap(), jadi jika karakter teks melebihi lebar kolom, ditambahkan \n
                $kolom1 = wordwrap($kolom1, $lebar_kolom_1, "\n", true);
                $kolom2 = wordwrap($kolom2, $lebar_kolom_2, "\n", true);
                $kolom3 = wordwrap($kolom3, $lebar_kolom_3, "\n", true);
                $kolom4 = wordwrap($kolom4, $lebar_kolom_4, "\n", true);

                // Merubah hasil wordwrap menjadi array, kolom yang memiliki 2 index array berarti memiliki 2 baris (kena wordwrap)
                $kolom1Array = explode("\n", $kolom1);
                $kolom2Array = explode("\n", $kolom2);
                $kolom3Array = explode("\n", $kolom3);
                $kolom4Array = explode("\n", $kolom4);

                // Mengambil jumlah baris terbanyak dari kolom-kolom untuk dijadikan titik akhir perulangan
                $jmlBarisTerbanyak = max(count($kolom1Array), count($kolom2Array), count($kolom3Array), count($kolom4Array));

                // Mendeklarasikan variabel untuk menampung kolom yang sudah di edit
                $hasilBaris = array();

                // Melakukan perulangan setiap baris (yang dibentuk wordwrap), untuk menggabungkan setiap kolom menjadi 1 baris
                for ($i = 0; $i < $jmlBarisTerbanyak; $i++) {

                    // memberikan spasi di setiap cell berdasarkan lebar kolom yang ditentukan,
                    $hasilKolom1 = str_pad((isset($kolom1Array[$i]) ? $kolom1Array[$i] : ""), $lebar_kolom_1, " ");
                    $hasilKolom2 = str_pad((isset($kolom2Array[$i]) ? $kolom2Array[$i] : ""), $lebar_kolom_2, " ");

                    // memberikan rata kanan pada kolom 3 dan 4 karena akan kita gunakan untuk harga dan total harga
                    $hasilKolom3 = str_pad((isset($kolom3Array[$i]) ? $kolom3Array[$i] : ""), $lebar_kolom_3, " ", STR_PAD_LEFT);
                    $hasilKolom4 = str_pad((isset($kolom4Array[$i]) ? $kolom4Array[$i] : ""), $lebar_kolom_4, " ", STR_PAD_LEFT);

                    // Menggabungkan kolom tersebut menjadi 1 baris dan ditampung ke variabel hasil (ada 1 spasi disetiap kolom)
                    $hasilBaris[] = $hasilKolom1 . " " . $hasilKolom2 . " " . $hasilKolom3 . " " . $hasilKolom4;
                }

                // Hasil yang berupa array, disatukan kembali menjadi string dan tambahkan \n disetiap barisnya.
                return implode($hasilBaris) . "\n";
            }

            // Membuat judul
            $printer->initialize();
            $printer->pulse();
            $printer->setFont(Printer::FONT_B);
            $printer->setJustification(Printer::JUSTIFY_CENTER); // Setting teks menjadi rata tengah
            $printer->text("Toko SKD\n");
            $printer->text("\n");

            // Data transaksi
            $printer->initialize();
            $printer->setFont(Printer::FONT_C);
            $printer->text(buat2kolom('No Order : ', $no_order));
            $printer->text(buat2kolom('Waktu : ', date('d-m-y, H:i', strtotime($waktu))));
            $printer->text(buat2kolom('pelanggan : ', $pelanggan));
                  $printer->setLineSpacing(1);
            $printer->text(buat2kolom('Kasir: ', $user));

            // Membuat tabel
            $printer->initialize(); // Reset bentuk/jenis teks
            // $printer->text("----------------------------------------\n");
            $printer->text("========================================\n");
            // dd($data->penjualan_item);
            foreach ($data->penjualan_item as $item) {
                $printer->text(buatBaris1Kolom($item->produk->nama));
                $printer->text(buatBaris3Kolom(number_format($item->qty,0,',','.'). ' ' . strtolower($item->satuan != null ? $item->satuan->satuan : '-') . ' x' , number_format($item->harga_jual,0,',','.'), number_format($item->total_harga_jual,0,',','.') ));
            }
            // $printer->text("----------------------------------------\n");
            $printer->text("========================================\n");
            $printer->initialize(); // Re
            // $printer->setLineSpacing(6);
            $printer->text(buat2kolom("Subtotal", number_format($data->total_harga_jual,0,',','.') ));
            $printer->text(buat2kolom("potongan",  number_format($data->potongan_diskon,0,',','.') ));
            $printer->text(buat2kolom("total_harga", number_format($data->total_harga,0,',','.') ));
            if ($data->tagihan_utang != 0) {
                $printer->text(buat2kolom("tagihan utang", number_format($data->tagihan_utang,0,',','.') ));
            }
            $printer->text("\n");
            // $printer->setLineSpacing(7);
            $printer->text(buat2kolom("total bayar", number_format($data->total_pembayaran,0,',','.')));
            $printer->text(buat2kolom("diterima", number_format($data->diterima,0,',','.')));
            $printer->text(buat2kolom("kembalian", number_format($data->kembali,0,',','.')));
            // Pesan penutup
            $printer->initialize();
            $printer->text("\n");
            // $printer->setLineSpacing(2);
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->text("----------------------------------------\n");
            $printer->text("Terima kasih telah berbelanja\n");
            // $printer->text("www.lalandigital.com\n");

            $printer->feed(3); // mencetak 5 baris kosong agar terangkat (pemotong kertas saya memiliki jarak 5 baris dari toner)
            $printer->close();

        } catch (Exception $e) {
            echo "Couldn't print to this printer: " . $e->getMessage() . "\n";
        }
    }

    public static function nota()
    {

    }

}
