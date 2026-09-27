# Dokumentasi — Integrasi Template Admin & Guest (Laravel)

**Project** : `falisha-dapur-ayam-geprek`
**Lokasi**  : `D:\framework\laragon-6.0-minimal\www\falisha-dapur-ayam-geprek`
**Stack**   : Laravel 13 · PHP 8.4 · Vite/SCSS (template admin)

---

## 1. Tujuan

Website ini punya **dua tampilan terpisah** yang dimuat dari folder template berbeda
sesuai peran pengguna:

| URL                                | Template          | Folder fisik di `public/`            |
| ---------------------------------- | ----------------- | ------------------------------------ |
| `http://127.0.0.1:8000/admin`      | InApp (Inventory) | `public/admin/`                      |
| `http://127.0.0.1:8000/guest`      | Sarab (Fast Food) | `public/guest/`                      |

Saat membuka `/admin` tampil dashboard admin, saat membuka `/guest` tampil landing
page restoran.

---

## 2. Arsitektur / Logika Menghubungkan

Penyajian **tidak** memakai route Laravel. Justru inilah kuncinya:

```
┌─────────────────────────────────────────────────────────────┐
│  Server Laravel (php artisan serve)                          │
│  • Arahkan ke folder public/                                 │
│  • SIDAK pipe request ke route kalau folder fisik COCOK      │
└─────────────────────────────────────────────────────────────┘
        │                         │
        ▼                         ▼
  public/admin/              public/guest/
  (template InApp)           (template Sarab)
        │                         │
        ▼                         ▼
  /admin/*                  /guest/*
```

### 🔑 Kenapa tidak pakai route Laravel?

Awalnya dibuat `Route::get('/admin', ...)` + Controller untuk membungkus file HTML.
Ternyata **selalu 404**. Alasannya:

> Server PHP bawaan Laravel (`php artisan serve`) **mendahulukan file/folder fisik**.
> Karena `public/admin/` dan `public/guest/` adalah folder nyata, semua URL
> `/admin/*` dan `/guest/*` langsung dicocokkan ke folder tersebut *sebelum*
> mencapai route Laravel. Folder yang tidak punya `index.html` → dibalas 404 oleh
> server, route tak pernah dieksekusi.

**Solusi:** file HTML + aset ditaruh langsung di folder fisik, sehingga disajikan
sebagai **file statis**. Ini lebih ringan & tanpa mesin Blade.

---

## 3. Yang Ada di Setiap Folder

### 3.1 `public/admin/` — Template InApp (dashboard admin)

```
public/admin/
├─ index.html            <- /admin/  (dashboard utama)
├─ inventory.html        <- /admin/inventory.html
├─ reports.html          <- /admin/reports.html
├─ create-product.html   <- /admin/create-product.html
├─ signin.html           <- /admin/signin.html
├─ signup.html           <- /admin/signup.html
├─ docs.html             <- /admin/docs.html
├─ 404-error.html        <- /admin/404-error.html
├─ dist/                 <- hasil build Vite (jangan diedit manual)
│  └─ assets/
│     ├─ css/main.css
│     ├─ js/main.js
│     └─ images/...
└─ src/                  <- sumber template (SCSS, HTML mentah) — jangan edit
```

**Asal isi:** Template ini pakai ***Vite + SCSS***, jadi TIDAK bisa langsung dipakai
polos — perlu di-build dulu supaya `scss/style.scss` & `bootstrap` jadi CSS siap pakai.

**Alur build admin:**

```bash
cd public/admin
npm install          # sekali saja
npm run build        # hasil → public/admin/dist/
```

Setelah build, **salin** halaman HTML hasil build ke atas `public/` supaya ter-serve:

```bash
cp dist/*.html .        # index.html, inventory.html, reports.html, dst.
# aset sudah berada di dist/assets (dituju path absolut /admin/dist/assets/...)
```

**Cara update template admin** (setelah mengubah `src/`):
```bash
cd public/admin && npm run build
cp dist/*.html .
```

### 3.2 `public/guest/` — Template Sarab (landing page restoran)

```
public/guest/
├─ index.html          <- /guest/  (halaman utama)
├─ css/                <- bootstrap.min.css, style.css, all.min.css, dsb.
├─ js/                 <- bootstrap.bundle.min.js, main.js, dsb.
├─ img/                <- gambar hero, menu, chef, testimonial
├─ webfonts/           <- font icon (FontAwesome)
└─ sarab/              <- SALINAN ORISINAL (backup template bawaan)
```

**Asal isi:** Template ini **HTML statis + CSS/JS siap pakai** (tidak perlu build).
Isi folder `sarab/` dicopy langsung ke `public/guest/` supaya path `css/`, `js/`,
`img/` tersedia di level root folder guest.

```bash
cp -r public/guest/sarab/* public/guest/
# → menyatukan index.html + css + js + img + webfonts ke public/guest/
```

**Catatan:** `sarab/` sengaja dipertahankan sebagai backup orisinal tema.

---

## 4. Perbaikan Bug "Tampilan Guest Mentah (Tanpa CSS)"

### Gejala
Saat membuka `http://127.0.0.1:8000/guest`, halaman tampil polos putih — navbar,
hero, dan warna hilang (kayak HTML tanpa CSS).

### Akar masalah
URL `.../guest` **tanpa garis miring di akhir**. Saat browser membuka `/guest`
(tanpa `/`), folder "aktif" dianggap `root`, sehingga referensi relatif
`css/style.css` di-resolve menjadi **`/css/style.css`** (404) — bukan
`/guest/css/style.css`.

Bukti:
```
/css/style.css         → HTTP 404   ❌
/guest/css/style.css   → HTTP 200   ✅
```

### Solusi — Tag `<base href>`
Tambahkan `<base>` di dalam `<head>` kedua template supaya seluruh path relatif
(link `css/...`, `img/...`, JS, anchor) selalu relatif ke folder yang benar,
**tidak peduli** URL diakhiri `/` atau tidak.

```html
<!-- public/guest/index.html -->
<base href="/guest/">

<!-- public/admin/*.html -->
<base href="/admin/">
```

Dengan `<base>`, referensi `css/style.css` menjadi `guest/css/style.css` di browser.
Verifikasi: `/guest/css/style.css` = 200, halaman render penuh.

> **Rekomendasi konsisten:** gunakan URL dengan slash akhir: `/guest/` dan `/admin/`.

---

## 5. Ringkasan File yang Dibuat / Diubah

| Tindakan | Detail |
| -------- | ------ |
| **Build template admin** | `cd public/admin && npm install && npm run build` |
| **Salin HTML admin** | `dist/*.html` → `public/admin/` |
| **Salin isi template guest** | `sarab/*` (index.html, css, js, img, webfonts) → `public/guest/` |
| **Tambah `<base>` guest** | `public/guest/index.html` → `<base href="/guest/">` |
| **Tambah `<base>` admin** | 8 file `.html` di `public/admin/` → `<base href="/admin/">` |
| **Hapus pendekatan route** | `TemplateController.php` dihapus; `routes/web.php` dikembalikan ke default (hanya route `/`) |

> **Kenapa `routes/web.php` sengaja default?** Karena serve statis ditangani web
> server, route Laravel tak diperlukan lagi untuk dua halaman ini. Route `/`
> tetap menampilkan `welcome`.

---

## 6. Cara Menjalankan

```bash
# 1. Jalankan server Laravel
php artisan serve
# → http://127.0.0.1:8000
```

Lalu buka:
- **Admin** : `http://127.0.0.1:8000/admin`  atau  `http://127.0.0.1:8000/admin/`
- **Guest** : `http://127.0.0.1:8000/guest`   atau  `http://127.0.0.1:8000/guest/`

---

## 7. Catatan / Tips

1. **Jangan hapus `public/admin/dist/`** — aset CSS/JS di-refer secara absolut
   (`/admin/dist/assets/...`) dari halaman HTML.
2. **Jangan commit `public/admin/node_modules/`** ke git — itu hasil `npm install`,
   cukup untuk lokal. Tambahkan ke `.gitignore` bila perlu.
3. **`public/guest/sarab/`** adalah backup orisinal. Kalau template di-reset,
   copy ulang isinya ke `public/guest/`.
4. Folder `Documentation/` dan `README.md` di dalam `public/guest/` & `public/admin/`
   adalah bawaan tema — boleh dihapus bila tidak diinginkan tampil.