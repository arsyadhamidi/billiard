<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pemesanan</title>
    <style>
        @font-face {
            font-family: 'Poppins';
            font-style: normal;
            font-weight: normal;
            src: url('{{ public_path('fonts/Poppins/Poppins-Regular.ttf') }}') format('truetype');
        }

        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>

</head>

<body>
    <table style="width: 100%">
        <tr>
            <td>
                <img src="{{ public_path('images/logo.png') }}" width="100" alt="">
            </td>
            <td style="text-align: right">
                <h4>DATA PEMESANAN</h4>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="font-size: 11px; background-color: grey; padding: 4px 3px; color: white;">
                Harap membawa dokumen ini saat datang ke RK87 Billiard. Jangan lupa membawa identitas diri dan tunjukkan
                kode booking Anda kepada petugas.
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <table style="width: 100%; border: 1px solid gainsboro; margin-top: 10px; padding: 5px 15px;">
                    <tr>
                        <th style="width: 20%; font-size: 14px; text-align: left;">Kode Pemesanan</th>
                        <th style="width: 3%; text-align: center;">:</th>
                        <td style="text-align: left; font-size: 14px; width: 5%;">{{ $bookings->kode_booking ?? '0' }}
                        </td>
                        <td style="text-align: right; font-size: 14px;">
                            <b>Jenis</b> :
                            Pemesanan
                        </td>
                        <td style="text-align: right; font-size: 14px;">
                            <b>Tanggal</b> :
                            {{ \Carbon\Carbon::parse($bookings->tgl_booking)->translatedFormat('d F Y') }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <table style="width: 100%; border: 1px solid gainsboro; margin-top: 3px; padding: 2px 15px;">
                    <tr>
                        <td>
                            <table style="width: 100%">
                                <tr>
                                    <th style="width: 40%; font-size: 14px; text-align: left;">Nama Lengkap
                                    </th>
                                    <th style="width: 3%; text-align: center;">:</th>
                                    <td style="text-align: left; font-size: 14px;">
                                        {{ $users->name ?? '0' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 40%; font-size: 14px; text-align: left;">E-Mail
                                    </th>
                                    <th style="width: 3%; text-align: center;">:</th>
                                    <td style="text-align: left; font-size: 14px;">
                                        {{ $users->email ?? '-' }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td style="text-align: right;">
                            <h2 style="color: orange;">
                                <b>
                                    @if ($bookings->status == '1')
                                        DIPESAN
                                    @elseif($bookings->status == '2')
                                        SEDANG BERLANGSUNG
                                    @elseif($bookings->status == '3')
                                        SELESAI
                                    @elseif($bookings->status == '4')
                                        BATAL
                                    @else
                                        TIDAK TERSEDIA
                                    @endif
                                </b>
                            </h2>
                            <p style="font-size: 12px; margin-top: -20px;"><b>RK87 Billiard</b> -
                                #{{ $bookings->id ?? '1' }}</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table style="width: 100%; margin-top: 10px;">
        <tr>
            <td style="background-color: #FF520D; color: white; font-weight: 700; padding: 5px 15px;">
                DETAIL PEMESANAN
            </td>
        </tr>
    </table>

    <table style="width: 100%; margin-top: 10px; border-collapse: collapse;">
        <tr>
            <th style="width: 30%; text-align: left; font-size: 14px; padding: 5px 0px;">Nama Billiard</th>
            <th style="text-align: left; font-size: 14px; padding: 5px 0px;">RK87 Billiard</th>
        </tr>
        <tr>
            <th style="width: 30%; text-align: left; font-size: 14px; padding: 5px 0px; vertical-align: top;">Alamat RK87 Billiard</th>
            <th style="text-align: left; font-size: 14px; padding: 5px 0px;">
                Jl. Rohana Kudus No.Kel no.87, Kp. Jao, Kec. Padang Bar., Kota Padang, Sumatera Barat
            </th>
        </tr>
        <tr>
            <td colspan="2">
                <hr style="border: none; border-top: 1px dotted grey;">
            </td>
        </tr>
        <tr>
            <td style="width: 30%; text-align: left; font-size: 14px; padding: 5px 0px;">Paket</td>
            <td style="text-align: left; font-size: 14px; padding: 5px 0px;">{{ $bookings->paket->nama ?? '-' }}</td>
        </tr>
        <tr>
            <td style="width: 30%; text-align: left; font-size: 14px; padding: 5px 0px;">Meja</td>
            <td style="text-align: left; font-size: 14px; padding: 5px 0px;">Meja {{ $bookings->meja->no_meja ?? '-' }}
            </td>
        </tr>
        <tr>
            <td style="width: 30%; text-align: left; font-size: 14px; padding: 5px 0px;">Lokasi</td>
            <td style="text-align: left; font-size: 14px; padding: 5px 0px;">
                {{ $bookings->meja->lokasi ?? '-' }}</td>
        </tr>
        <tr>
            <td style="width: 30%; text-align: left; font-size: 14px; padding: 5px 0px;">Tanggal Pemesanan</td>
            <td style="text-align: left; font-size: 14px; padding: 5px 0px;">
                {{ \Carbon\Carbon::parse($bookings->tgl_booking)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td style="width: 30%; text-align: left; font-size: 14px; padding: 5px 0px;">Waktu Mulai</td>
            <td style="text-align: left; font-size: 14px; padding: 5px 0px;">{{ $bookings->waktu_mulai ?? '-' }} WIB</td>
        </tr>
        <tr>
            <td style="width: 30%; text-align: left; font-size: 14px; padding: 5px 0px;">Waktu Selesai</td>
            <td style="text-align: left; font-size: 14px; padding: 5px 0px;">{{ $bookings->waktu_selesai ?? '-' }} WIB</td>
        </tr>
    </table>

    <table style="width: 100%; margin-top: 20px;">
        <tr>
            <td style="background-color: #FF520D; color: white; font-weight: 700; padding: 5px 15px;">
                METODE PEMBAYARAN
            </td>
        </tr>
    </table>

    <table style="width: 100%; border: 1px solid gainsboro; margin-top: 10px; padding: 5px 15px;">
        <tr>
            <th style="font-size: 12px; width: 20%; text-align: left;">Tipe Pembayaran</th>
            <td style="font-size: 12px; text-align: left;">TRANSFER BCA, BRI</td>
        </tr>
    </table>

    <table style="width: 100%">
        <tr>
            <td style="width: 70%"></td>
            <td style="text-align: center;">
                <p>Padang, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                <br>
                <br>
                <br>
                <p>
                    RK87 Billiard
                </p>
            </td>
        </tr>
    </table>

    <table style="width: 100%; position: absolute; bottom: 0; margin-top: -40px;">
        <tr>
            <td style="font-size: 11px; background-color: grey; padding: 4px 3px; color: white; text-align: center;">
                Apabila perlu bantuan , mohon hubungi RK87 Billiard di <b>CUSTOMER SERVICE</b> +6282287632611 <br><b>Email</b>:rk87billiard
            </td>
        </tr>
        <tr>
            <td style="text-align: center; font-size: 11px;">
                <b>RK87 Billiard</b>
                <p style="margin-top: -1px;">
                    Jl. Rohana Kudus No.Kel no.87, Kp. Jao, Kec. Padang Bar., Kota Padang, Sumatera Barat
                </p>
            </td>
        </tr>
    </table>
</body>

</html>
