<?php

namespace App\Http\Controllers\Admin;

use PDF;
use App\Exports\BookingsExport;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Meja;
use App\Models\Paket;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class AdminBookingCcontroller extends Controller
{
    // In your controller
    public function index(Request $request)
    {
        $bookings = Booking::with(['users', 'meja', 'paket'])
            ->orderBy('id', 'desc');

        if ($request->has('tgl_filter') && $request->tgl_filter) {
            try {
                $dates = explode(' - ', $request->tgl_filter);
                if (count($dates) == 2) {
                    $bookings->whereBetween('tgl_booking', [
                        Carbon::parse($dates[0])->startOfDay(),
                        Carbon::parse($dates[1])->endOfDay()
                    ]);
                }
            } catch (\Exception $e) {
                // Optional: log or flash error
            }
        }

        if ($request->has('export')) {
            $filename = 'Laporan_Pemesanan_' . now()->format('Ymd_His') . '.xlsx';
            return Excel::download(new BookingsExport($bookings->get()), $filename);
        }

        if ($request->has('pdf')) {
            $startDate = isset($dates[0]) ? Carbon::parse($dates[0]) : now();
            $endDate = isset($dates[1]) ? Carbon::parse($dates[1]) : now();

            $pdf = PDF::loadView('admin.booking.export-pdf', [
                'bookings' => $bookings->get(),
                'startDate' => $startDate,
                'endDate' => $endDate
            ])->setPaper('A4', 'portrait');

            return $pdf->stream('Laporan_Pemesanan_' . now()->format('Ymd_His') . '.pdf');
        }


        return view('admin.booking.index', [
            'bookings' => $bookings->paginate(10)
        ]);
    }

    public function create()
    {
        $users = User::where('level_id', '!=', '1')->orderBy('id', 'desc')->get();
        $mejas = Meja::orderBy('id', 'desc')->get();
        $pakets = Paket::orderBy('id', 'desc')->get();

        return view('admin.booking.create', [
            'users' => $users,
            'mejas' => $mejas,
            'pakets' => $pakets,
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'users_id'     => 'required|exists:users,id',
            'meja_id'      => 'required|exists:mejas,id',
            'paket_id'     => 'required|exists:pakets,id',
            'tgl_booking'  => 'required|date',
            'status'       => 'required|in:1,2,3,4',
            'waktu_mulai'  => 'required',
            'waktu_selesai'  => 'required',
            'bukti_pembayaran'  => 'required|mimes:png,jpeg,jpg|max:10248',
        ], [
            'users_id.required'    => 'Pengguna wajib dipilih.',
            'users_id.exists'      => 'Pengguna yang dipilih tidak ditemukan.',

            'meja_id.required'     => 'Meja wajib dipilih.',
            'meja_id.exists'       => 'Meja yang dipilih tidak tersedia.',

            'paket_id.required'    => 'Paket wajib dipilih.',
            'paket_id.exists'      => 'Paket yang dipilih tidak ditemukan.',

            'tgl_booking.required' => 'Tanggal booking wajib diisi.',
            'tgl_booking.date'     => 'Format tanggal booking tidak valid.',

            'status.required'      => 'Status booking wajib diisi.',
            'status.in'            => 'Status booking tidak valid. Pilih antara 1 (Pending), 2 (Dikonfirmasi), 3 (Selesai), atau 4 (Dibatalkan).',

            'waktu_mulai.required'      => 'Waktu Mulai wajib diisi.',
            'waktu_selesai.required'      => 'Waktu Selesai wajib diisi.',

            'bukti_pembayaran.required'      => 'Bukti Pembayaran wajib diisi.',
            'bukti_pembayaran.mimes'      => 'Bukti Pembayaran harus memiliki format PNG, JPG, tau JPEG.',
            'bukti_pembayaran.max'      => 'Bukti Pembayaran maksimal 10 MB.',
        ]);

        $pakets = Paket::where('id', $request->paket_id)->first();
        $mejas = Meja::where('id', $request->meja_id)->first();

        if ($mejas->status != 1) {
            return redirect()->back()->withErrors(['meja_id' => 'Meja yang dipilih sedang tidak tersedia.']);
        }

        $buktiPembayarans = null;

        if ($request->file('bukti_pembayaran')) {
            $buktiPembayarans = $request->file('bukti_pembayaran')->store('bukti_pembayaran');
        }

        // Simpan booking
        Booking::create([
            'users_id' => $request->users_id,
            'meja_id' => $request->meja_id,
            'paket_id' => $request->paket_id,
            'kode_booking' => strtoupper(Str::random(7)),
            'tgl_booking' => $request->tgl_booking,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'status' => $request->status,
            'total_harga' => $pakets->harga,
            'bukti_pembayaran' => $buktiPembayarans,
        ]);

        // Update status meja sesuai status booking
        switch ((int)$request->status) {
            case 1:
                $mejas->update(['status' => 2]);
                break;
            case 2:
                $mejas->update(['status' => 3]);
                break;
            case 3:
            case 4:
                $mejas->update(['status' => 1]);
                break;
        }

        return redirect()->route('data-pemesanan.index')->with('success', 'Selamat ! Anda berhasil membuat data booking!');
    }

    public function edit($id)
    {
        $users = User::where('level_id', '!=', '1')->orderBy('id', 'desc')->get();
        $mejas = Meja::orderBy('id', 'desc')->get();
        $pakets = Paket::orderBy('id', 'desc')->get();
        $bookings = Booking::where('id', $id)->first();

        return view('admin.booking.edit', [
            'users' => $users,
            'mejas' => $mejas,
            'pakets' => $pakets,
            'bookings' => $bookings,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'users_id'     => 'required|exists:users,id',
            'meja_id'      => 'required|exists:mejas,id',
            'paket_id'     => 'required|exists:pakets,id',
            'tgl_booking'  => 'required|date',
            'status'       => 'required|in:1,2,3,4',
            'waktu_mulai'  => 'required',
            'waktu_selesai' => 'required',
            'bukti_pembayaran'  => 'nullable|mimes:png,jpeg,jpg|max:10248',
        ], [
            'users_id.required'    => 'Pengguna wajib dipilih.',
            'users_id.exists'      => 'Pengguna yang dipilih tidak ditemukan.',
            'meja_id.required'     => 'Meja wajib dipilih.',
            'meja_id.exists'       => 'Meja yang dipilih tidak tersedia.',
            'paket_id.required'    => 'Paket wajib dipilih.',
            'paket_id.exists'      => 'Paket yang dipilih tidak ditemukan.',
            'tgl_booking.required' => 'Tanggal booking wajib diisi.',
            'tgl_booking.date'     => 'Format tanggal booking tidak valid.',
            'status.required'      => 'Status booking wajib diisi.',
            'status.in'            => 'Status booking tidak valid.',
            'waktu_mulai.required' => 'Waktu Mulai wajib diisi.',
            'waktu_selesai.required' => 'Waktu Selesai wajib diisi.',

            'bukti_pembayaran.mimes'      => 'Bukti Pembayaran harus memiliki format PNG, JPG, tau JPEG.',
            'bukti_pembayaran.max'      => 'Bukti Pembayaran maksimal 10 MB.',
        ]);

        $booking = Booking::findOrFail($id);
        $paket = Paket::findOrFail($request->paket_id);
        $mejaBaru = Meja::findOrFail($request->meja_id);

        // Jika meja diubah, kembalikan meja lama ke status tersedia
        if ($booking->meja_id != $request->meja_id) {
            $mejaLama = Meja::find($booking->meja_id);
            if ($mejaLama) {
                $mejaLama->update(['status' => 1]); // Set ke tersedia
            }
        }

        $buktiPembayarans = null;
        if ($request->file('bukti_pembayaran')) {
            if ($booking->bukti_pembayaran) {
                Storage::delete($booking->bukti_pembayaran);
            }
            $buktiPembayarans = $request->file('bukti_pembayaran')->store('bukti_pembayaran');
        } else {
            $buktiPembayarans = $booking->bukti_pembayaran;
        }

        // Update data booking
        $booking->update([
            'users_id'     => $request->users_id,
            'meja_id'      => $request->meja_id,
            'paket_id'     => $request->paket_id,
            'tgl_booking'  => $request->tgl_booking,
            'waktu_mulai'  => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'status'       => $request->status,
            'total_harga'  => $paket->harga,
            'bukti_pembayaran'  => $buktiPembayarans,
        ]);

        // Update status meja baru sesuai status booking
        switch ((int)$request->status) {
            case 1:
                $mejaBaru->update(['status' => 2]); // Dipesan
                break;
            case 2:
                $mejaBaru->update(['status' => 3]); // Sedang Berlangsung
                break;
            case 3:
            case 4:
                $mejaBaru->update(['status' => 1]); // Tersedia
                break;
        }

        return redirect()->route('data-pemesanan.index')->with('success', 'Booking berhasil diperbarui!');
    }


    public function destroy($id)
    {
        $bookings = Booking::where('id', $id)->first();

        if ($bookings->bukti_pembayaran) {
            Storage::delete($bookings->bukti_pembayaran);
        }

        $mejas = Meja::where('id', $bookings->meja_id)->first();
        $mejas->update([
            'status' => '1',
        ]);

        $bookings->delete();

        return back()->with('success', 'Selamat ! Anda berhasil menghapus data booking!');
    }
}
