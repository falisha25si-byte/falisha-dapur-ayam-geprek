<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Pesan dari form Contact Us.
 * Guest: kirim pesan (store). Admin: lihat daftar, baca detail, hapus.
 * Memakai Query Builder (DB::table).
 */
class PesanKontakController extends Controller
{
    public const SUBJEK = ['Pertanyaan Umum', 'Katering & Acara', 'Saran & Masukan', 'Kerja Sama'];

    /**
     * Simpan pesan dari form Contact Us (Guest).
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'       => 'required|min:3|max:100',
            'email'      => 'required|email|max:255',
            'no_telepon' => 'nullable|regex:/^[0-9\-\+\s]{8,20}$/',
            'subjek'     => 'required|in:' . implode(',', self::SUBJEK),
            'pesan'      => 'required|min:10|max:1000',
        ], [
            'required'       => ':attribute wajib diisi.',
            'min'            => ':attribute minimal :min karakter.',
            'max'            => ':attribute maksimal :max karakter.',
            'email'          => 'Format :attribute tidak valid.',
            'in'             => ':attribute yang dipilih tidak valid.',
            'no_telepon.regex' => 'No. telepon hanya boleh berisi angka (8-20 digit).',
        ], [
            'nama' => 'Nama', 'email' => 'Email', 'no_telepon' => 'No. telepon',
            'subjek' => 'Subjek', 'pesan' => 'Pesan',
        ]);

        try {
            DB::table('pesan_kontak')->insert([
                'nama'       => $request->nama,
                'email'      => $request->email,
                'no_telepon' => $request->no_telepon,
                'subjek'     => $request->subjek,
                'pesan'      => $request->pesan,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Pesan gagal dikirim, coba lagi nanti.');
        }

        return redirect()->route('contact')
            ->with('success', 'Terima kasih ' . $request->nama . ', pesanmu sudah terkirim!');
    }

    /**
     * Admin: daftar pesan masuk (terbaru di atas, yang belum dibaca didahulukan).
     */
    public function index(Request $request)
    {
        $data['dataPesan'] = DB::table('pesan_kontak')
            ->when($request->cari, function ($query, $cari) {
                $query->where(function ($q) use ($cari) {
                    $q->where('nama', 'like', "%{$cari}%")
                      ->orWhere('email', 'like', "%{$cari}%")
                      ->orWhere('pesan', 'like', "%{$cari}%");
                });
            })
            ->orderBy('sudah_dibaca')
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('admin.pesan.index', $data);
    }

    /**
     * Admin: baca detail pesan, sekaligus tandai sudah dibaca.
     */
    public function show(string $id)
    {
        $data['dataPesan'] = DB::table('pesan_kontak')->where('pesan_id', $id)->first();
        abort_if(! $data['dataPesan'], 404);

        DB::table('pesan_kontak')->where('pesan_id', $id)->update(['sudah_dibaca' => true, 'updated_at' => now()]);

        return view('admin.pesan.show', $data);
    }

    /**
     * Admin: hapus pesan.
     */
    public function destroy(string $id)
    {
        $hapus = DB::table('pesan_kontak')->where('pesan_id', $id)->delete();

        return redirect()->route('pesan.index')->with(
            $hapus ? 'success' : 'error',
            $hapus ? 'Pesan Berhasil Dihapus!' : 'Pesan tidak ditemukan.'
        );
    }
}
