# Panduan Project Geprekku (UAS Pemrograman Framework)

Laravel 13 · Template Admin **InApp** · Template Guest **Sarab** · MySQL (Laragon)

---

## 1. Perubahan dari versi sebelumnya

| Sebelumnya | Sekarang (sesuai modul Pertemuan 5–6) |
|---|---|
| Template disajikan sebagai HTML statis di `public/admin` dan `public/guest`, tanpa route | Aset di `public/assets-admin` & `public/assets-guest`, view Blade di `resources/views`, dipanggil lewat **Controller + Route** |
| CSS admin tidak muncul karena `public/admin/dist/` (hasil build Vite) tidak ada | CSS/JS admin sudah di-build dan disalin ke `public/assets-admin/css/main.css` & `js/main.js` |
| Logo belum dipasang | Logo Geprekku tampil di admin (sidebar, banner dashboard, favicon) dan guest (navbar, footer, favicon) |

Sumber SCSS template admin dipindah ke `template-src/inapp-admin/` (di luar `public/`). Cara build ulang ada di bagian 9.

---

## 2. Struktur folder penting

```
app/Http/Controllers/
├─ HomeController.php        → halaman Guest  (route: home, URL /)
├─ DashboardController.php   → halaman Admin  (route: dashboard, URL /dashboard)
├─ MenuController.php        → CRUD menu
├─ PelangganController.php   → CRUD pelanggan
└─ BahanBakuController.php   → CRUD bahan baku
app/Models/  Menu.php · Pelanggan.php · BahanBaku.php
database/migrations/  2026_10_12_10000{1,2,3}_create_*_table.php
database/seeders/GeprekkuSeeder.php   → data contoh
public/assets-admin/   css/main.css · js/main.js · images/logo-geprekku.png · tabler-icons.*
public/assets-guest/   css/ · js/ · img/ · webfonts/ · css/custom-style.css
resources/views/
├─ layouts/admin.blade.php   → kerangka admin (topbar, sidebar, footer)
├─ admin/dashboard.blade.php
├─ admin/menu/        index · create · edit
├─ admin/pelanggan/   index · create · edit
├─ admin/bahan-baku/  index · create · edit
└─ guest/home.blade.php      → landing page Sarab
routes/web.php
```

---

## 3. Cara menjalankan

1. Buat database `geprekku` di Laragon (HeidiSQL → klik kanan → Create new → Database).
2. Di file `.env` ubah: `DB_DATABASE=geprekku`
3. Jalankan:
   ```bash
   php artisan migrate
   php artisan db:seed --class=GeprekkuSeeder   # opsional: isi data contoh
   php artisan serve
   ```
4. Buka:
   - Guest: `http://127.0.0.1:8000/`
   - Admin: `http://127.0.0.1:8000/dashboard`
   - CRUD: `/menu`, `/pelanggan`, `/bahan-baku`

---

## 4. Tema berbeda Admin vs Guest

| | Admin (InApp) | Guest (Sarab) |
|---|---|---|
| Warna utama | Hijau toska `#0F766E`, sidebar gelap `#0E2A27` | Merah cabai `#d7261e` + kuning `#f6b417` |
| Font | Poppins | Playfair Display + Poppins |
| Diatur di | `template-src/inapp-admin/src/assets/scss/_variables.scss` (`$primary`) & `_custom.scss` | `public/assets-guest/css/custom-style.css` |

---

## 5. Tiga tabel master (tanpa relasi)

**menu** — `menu_id` (PK), `nama_menu`, `kategori` (Ayam Geprek/Paket Hemat/Minuman/Tambahan), `harga`, `level_pedas` (0–5), `deskripsi`, `status` (Tersedia/Habis), timestamps

**pelanggan** — `pelanggan_id` (PK), `nama_pelanggan`, `jenis_kelamin` (Laki-laki/Perempuan), `no_hp`, `email` (unique), `tanggal_lahir`, `alamat`, timestamps

**bahan_baku** — `bahan_baku_id` (PK), `nama_bahan`, `satuan` (kg/gram/liter/pcs/ikat), `stok`, `harga_satuan`, `supplier`, `tanggal_masuk`, timestamps

---

## 6. Referensi form & tabel dari template

| Halaman project | Diambil dari template InApp | Bagian yang dipakai |
|---|---|---|
| `admin/*/create.blade.php`, `edit.blade.php` | `create-product.html` ("Add Inventory") | judul + tombol kanan, `card > card-body p-4 > form`, grid `row / col-md-6 mb-3`, `form-label`, `form-control`, `form-select`, tombol `btn-primary` + `btn-secondary` |
| `admin/*/index.blade.php` | `inventory.html` ("Inventory") | judul + tombol "Add", `card table-responsive > table mb-0 text-nowrap table-hover`, `thead table-light`, kolom Action |
| `admin/dashboard.blade.php` | `index.html` (Dashboard) | kartu statistik `bg-opacity-10`, grafik `#salesPurchaseChart`, kartu list `list-group-flush` |
| `layouts/admin.blade.php` | topbar + sidebar `index.html` | `#topbar`, `#sidebar`, `.logo-area`, `#content` |
| `guest/home.blade.php` | `index.html` Sarab | seluruh halaman; section **Category** & **Menu** diisi data tabel `menu` |

Saat presentasi, buka file template asli di `template-src/inapp-admin/src/create-product.html` dan `inventory.html` berdampingan dengan view Blade-nya.

---

## 7. Potongan kode CRUD & alert

### Route (resource)
```php
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('menu', MenuController::class);
Route::resource('pelanggan', PelangganController::class);
Route::resource('bahan-baku', BahanBakuController::class);
```

### Model
```php
class Menu extends Model
{
    protected $table      = 'menu';
    protected $primaryKey = 'menu_id';
    protected $fillable   = ['nama_menu', 'kategori', 'harga', 'level_pedas', 'deskripsi', 'status'];
}
```

### Create — validasi + simpan + redirect dengan flash data
```php
public function store(Request $request)
{
    $request->validate([
        'nama_menu'   => 'required|max:100',
        'kategori'    => 'required|in:Ayam Geprek,Paket Hemat,Minuman,Tambahan',
        'harga'       => 'required|numeric|min:1000',
        'level_pedas' => 'required|integer|between:0,5',
        'deskripsi'   => 'nullable|max:500',
        'status'      => 'required|in:Tersedia,Habis',
    ], $this->pesan, $this->atribut);   // pesan error Bahasa Indonesia

    $data['nama_menu']   = $request->nama_menu;
    $data['kategori']    = $request->kategori;
    $data['harga']       = $request->harga;
    $data['level_pedas'] = $request->level_pedas;
    $data['deskripsi']   = $request->deskripsi;
    $data['status']      = $request->status;

    Menu::create($data);

    return redirect()->route('menu.index')->with('success', 'Penambahan Data Menu Berhasil!');
}
```

### Read
```php
public function index()
{
    $data['dataMenu'] = Menu::all();
    return view('admin.menu.index', $data);
}
```

### Update
```php
public function edit(string $id)
{
    $data['dataMenu'] = Menu::findOrFail($id);
    return view('admin.menu.edit', $data);
}

public function update(Request $request, string $id)
{
    $request->validate([...]);              // rule sama dengan store()

    $menu = Menu::findOrFail($id);
    $menu->nama_menu = $request->nama_menu;
    // ... kolom lain
    $menu->save();

    return redirect()->route('menu.index')->with('success', 'Perubahan Data Menu Berhasil!');
}
```

### Delete
```php
public function destroy(string $id)
{
    $menu = Menu::findOrFail($id);
    $menu->delete();
    return redirect()->route('menu.index')->with('success', 'Data Menu Berhasil Dihapus!');
}
```

### Alert sukses (flash data) — `index.blade.php`
```blade
@if (session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="ti ti-circle-check me-1"></i> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
@endif
```

### Alert error validasi — `create.blade.php` / `edit.blade.php`
```blade
@if ($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
```

### Repopulate form
```blade
{{-- create --}}
<input type="text" name="nama_menu" value="{{ old('nama_menu') }}"
       class="form-control @error('nama_menu') is-invalid @enderror">
@error('nama_menu') <div class="invalid-feedback">{{ $message }}</div> @enderror

{{-- edit --}}
<input type="text" name="nama_menu" value="{{ old('nama_menu', $dataMenu->nama_menu) }}" ...>

{{-- select --}}
<option value="Minuman" {{ old('kategori', $dataMenu->kategori) == 'Minuman' ? 'selected' : '' }}>Minuman</option>
```

### Form edit & hapus (method spoofing + CSRF)
```blade
<form action="{{ route('menu.update', $dataMenu->menu_id) }}" method="POST">
  @csrf
  @method('PUT')
  ...
</form>

<form action="{{ route('menu.destroy', $item->menu_id) }}" method="POST" style="display:inline"
      onsubmit="return confirm('Yakin ingin menghapus?')">
  @csrf
  @method('DELETE')
  <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
</form>
```

---

## 8. Checklist capture untuk tldraw

Untuk setiap tabel (Menu, Pelanggan, Bahan Baku):

1. Form tambah (kosong)
2. Form setelah submit salah → alert merah + pesan per input + isian lama tetap ada (repopulate)
3. List data + alert hijau "Penambahan Data ... Berhasil!"
4. Form edit (terisi data lama)
5. List + alert "Perubahan Data ... Berhasil!"
6. List + alert "Data ... Berhasil Dihapus!"

Tambahan: tampilan awal Guest (logo di navbar), tampilan awal Admin (logo di sidebar + banner), dan bukti refresh (F5) di halaman list tidak memicu "Confirm Form Resubmission" (bukti redirect).

---

## 9. Build ulang CSS admin (jika ingin ganti warna)

```bash
cd template-src/inapp-admin
npm install
# ubah $primary di src/assets/scss/_variables.scss
npm run build
copy dist\assets\css\main.css ..\..\public\assets-admin\css\main.css
copy dist\assets\js\main.js  ..\..\public\assets-admin\js\main.js
```
