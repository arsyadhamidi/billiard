<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Pemesanan</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 11px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .no-border td {
            border: none !important;
        }

        .header-title {
            font-size: 14px;
            font-weight: bold;
        }

        .sub-title {
            font-size: 12px;
            color: #0073e6;
            font-weight: bold;
        }

        .date-range {
            color: #d00;
            font-weight: bold;
            font-size: 11px;
        }
    </style>
</head>

<body>
    <table class="no-border">
        <tr>
            <td class="text-left">10:50</td>
            <td class="text-right">{{ \Carbon\Carbon::now()->format('d F Y') }}</td>
        </tr>
    </table>

    <div class="text-center" style="margin-top: 10px;">
        <div class="header-title">Data Contoh</div>
        <div class="sub-title">Pemesanan - Rangkuman</div>
        <div class="date-range">
            {{ $startDate->translatedFormat('l, d F Y') }} - {{ $endDate->translatedFormat('l, d F Y') }}
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>No. Pesanan</th>
                <th>Nama Pemesan</th>
                <th>Meja</th>
                <th>Paket</th>
                <th>Mata Uang</th>
                <th class="text-right">Sub Total</th>
                <th class="text-right">Diskon</th>
                <th class="text-right">Pajak</th>
                <th class="text-right">Total</th>
                <th class="text-right">Pembayaran</th>
                <th class="text-right">Saldo</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalSubtotal = 0;
                $totalDiskon = 0;
                $totalPajak = 0;
                $totalPembayaran = 0;
                $totalSaldo = 0;
            @endphp

            @foreach ($bookings as $booking)
                @php
                    $subtotal = $booking->total_harga;
                    $diskon = 0;
                    $pajak = 0;
                    $total = $subtotal;
                    $pembayaran = $booking->bukti_pembayaran ? $subtotal : 0;
                    $saldo = $total - $pembayaran;

                    $totalSubtotal += $subtotal;
                    $totalDiskon += $diskon;
                    $totalPajak += $pajak;
                    $totalPembayaran += $pembayaran;
                    $totalSaldo += $saldo;
                @endphp
                <tr>
                    <td>{{ \Carbon\Carbon::parse($booking->tgl_booking)->format('d/m/y') }}</td>
                    <td>{{ $booking->kode_booking ?? '-' }}</td>
                    <td>{{ $booking->users->name ?? '-' }}</td>
                    <td>{{ $booking->meja->no_meja ?? '-' }}</td>
                    <td>{{ $booking->paket->nama ?? '-' }}</td>
                    <td>IDR</td>
                    <td class="text-right">{{ number_format($subtotal, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($diskon, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($pajak, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($total, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($pembayaran, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($saldo, 0, ',', '.') }}</td>
                </tr>
            @endforeach

        </tbody>
        <tfoot>
            <tr>
                <td colspan="6" class="text-right"><strong>Total :</strong></td>
                <td class="text-right"><strong>{{ number_format($totalSubtotal, 0, ',', '.') }}</strong></td>
                <td class="text-right"><strong>{{ number_format($totalDiskon, 0, ',', '.') }}</strong></td>
                <td class="text-right"><strong>{{ number_format($totalPajak, 0, ',', '.') }}</strong></td>
                <td class="text-right">
                    <strong>{{ number_format($totalSubtotal + $totalPajak - $totalDiskon, 0, ',', '.') }}</strong></td>
                <td class="text-right"><strong>{{ number_format($totalPembayaran, 0, ',', '.') }}</strong></td>
                <td class="text-right"><strong>{{ number_format($totalSaldo, 0, ',', '.') }}</strong></td>
            </tr>
        </tfoot>
    </table>

    <div style="margin-top: 20px;">Halaman : 1</div>
</body>

</html>
