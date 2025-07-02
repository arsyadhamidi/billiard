<?php

namespace App\Exports;

use App\Models\Booking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class BookingsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $bookings;

    public function __construct($bookings)
    {
        $this->bookings = $bookings->load(['users', 'meja', 'paket']); // Eager load relationships
    }

    public function collection()
    {
        return $this->bookings;
    }

    public function headings(): array
    {
        return [
            'No',
            'Kode Booking',
            'Nama Pelanggan',
            'No Meja',
            'Nama Paket',
            'Tanggal Booking',
            'Waktu Mulai',
            'Waktu Selesai',
            'Status',
            'Total Harga',
            'Bukti Pembayaran'
        ];
    }

    public function map($booking): array
    {
        return [
            $booking->id,
            $booking->kode_booking,
            $booking->users->name ?? '-',
            $booking->meja->no_meja ?? '-',
            $booking->paket->nama ?? '-',
            \Carbon\Carbon::parse($booking->tgl_booking)->format('d-m-Y'), // Better date format
            $booking->waktu_mulai,
            $booking->waktu_selesai,
            $this->getStatusText($booking->status),
            'Rp ' . number_format($booking->total_harga, 0, ',', '.'),
            $booking->bukti_pembayaran ? 'Ada' : 'Tidak Ada'
        ];
    }

    private function getStatusText($status)
    {
        switch ($status) {
            case '1': return 'Dipesan';
            case '2': return 'Sedang Berlangsung';
            case '3': return 'Selesai';
            case '4': return 'Batal';
            default: return 'Tidak Diketahui';
        }
    }
}
