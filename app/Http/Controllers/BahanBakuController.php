<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use Illuminate\Http\Request;

class BahanBakuController extends Controller
{
    /**
     * Pesan error validasi (Bahasa Indonesia).
     */
    private $pesan = [
        'required' => ':attribute wajib diisi.',
        'max'      => ':attribute maksimal :max karakter.',
        'in'       => ':attribute yang dipilih tidak valid.',
        'integer'  => ':attribute harus berupa angka bulat.',
        'numeric'  => ':attribute harus berupa angka.',
        'min'      => ':attribute minimal :min.',
        'date'     => ':attribute harus berupa tanggal.',
    ];

    private $atribut = [
        'nama_bahan'    => 'Nama bahan',
        'satuan'        => 'Satuan',
        'stok'          => 'Stok',
        'harga_satuan'  => 'Harga satuan',
        'supplier'      => 'Supplier',
        'tanggal_masuk' => 'Tanggal masuk',
    ];

    /**
     * Tampilkan list data bahan baku.
     */
    public function index()
    {
        $data['dataBahanBaku'] = BahanBaku::all();
        return view('admin.bahan-baku.index', $data);
    }

    /**
     * Tampilkan form tambah bahan baku.
     */
    public function create()
    {
        return view('admin.bahan-baku.create');
    }

    /**
     * Simpan data bahan baku baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_bahan'    => 'required|max:100',
            'satuan'        => 'required|in:kg,gram,liter,pcs,ikat',
            'stok'          => 'required|integer|min:0',
            'harga_satuan'  => 'required|numeric|min:0',
            'supplier'      => 'nullable|max:100',
            'tanggal_masuk' => 'required|date',
        ], $this->pesan, $this->atribut);

        $data['nama_bahan']    = $request->nama_bahan;
        $data['satuan']        = $request->satuan;
        $data['stok']          = $request->stok;
        $data['harga_satuan']  = $request->harga_satuan;
        $data['supplier']      = $request->supplier;
        $data['tanggal_masuk'] = $request->tanggal_masuk;

        BahanBaku::create($data);

        return redirect()->route('bahan-baku.index')->with('success', 'Penambahan Data Bahan Baku Berhasil!');
    }

    /**
     * Tidak dipakai, diarahkan ke list.
     */
    public function show(string $id)
    {
        return redirect()->route('bahan-baku.index');
    }

    /**
     * Tampilkan form edit bahan baku.
     */
    public function edit(string $id)
    {
        $data['dataBahanBaku'] = BahanBaku::findOrFail($id);
        return view('admin.bahan-baku.edit', $data);
    }

    /**
     * Simpan perubahan data bahan baku.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_bahan'    => 'required|max:100',
            'satuan'        => 'required|in:kg,gram,liter,pcs,ikat',
            'stok'          => 'required|integer|min:0',
            'harga_satuan'  => 'required|numeric|min:0',
            'supplier'      => 'nullable|max:100',
            'tanggal_masuk' => 'required|date',
        ], $this->pesan, $this->atribut);

        $bahanBaku = BahanBaku::findOrFail($id);

        $bahanBaku->nama_bahan    = $request->nama_bahan;
        $bahanBaku->satuan        = $request->satuan;
        $bahanBaku->stok          = $request->stok;
        $bahanBaku->harga_satuan  = $request->harga_satuan;
        $bahanBaku->supplier      = $request->supplier;
        $bahanBaku->tanggal_masuk = $request->tanggal_masuk;

        $bahanBaku->save();

        return redirect()->route('bahan-baku.index')->with('success', 'Perubahan Data Bahan Baku Berhasil!');
    }

    /**
     * Hapus data bahan baku.
     */
    public function destroy(string $id)
    {
        $bahanBaku = BahanBaku::findOrFail($id);

        $bahanBaku->delete();
        return redirect()->route('bahan-baku.index')->with('success', 'Data Bahan Baku Berhasil Dihapus!');
    }
}
