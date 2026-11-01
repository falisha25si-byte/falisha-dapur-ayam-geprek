{{--
  PartialView: Promo Spesial (data dari tabel promo, diambil dengan QUERY BUILDER).
  Variabel: $dataPromo (Collection hasil DB::table('promo')->join('menu', ...)->get())
--}}
<section id="special">
   <div class="spbg"></div>
   <div class="container" style="position:relative;z-index:2;">
      @if ($dataPromo->isNotEmpty())
         @php $promoUtama = $dataPromo->first(); @endphp
         <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
               <div class="sptag"><i class="fas fa-bolt me-1"></i>Promo {{ $promoUtama->diskon_persen }}%</div>
               <h2 class="sptitle">{{ $promoUtama->judul_promo }}<br /><span>{{ $promoUtama->nama_menu }}</span></h2>
               <div class="sp-price">
                  Rp {{ number_format($promoUtama->harga_promo, 0, ',', '.') }}
                  <s>Rp {{ number_format($promoUtama->harga, 0, ',', '.') }}</s>
               </div>
               <p class="spdesc">
                  {{ $promoUtama->deskripsi ?? 'Nikmati ' . $promoUtama->nama_menu . ' dengan harga spesial selama promo berlangsung.' }}
               </p>

               @if ($promoUtama->tanggal_selesai)
                  {{-- hitung mundur sampai akhir hari tanggal_selesai --}}
                  <div class="cdwrap" id="cdWrap" data-end="{{ $promoUtama->tanggal_selesai }}T23:59:59">
                     <div class="cditem"><span class="cdnum" id="cdD">00</span><span class="cdlbl">Hari</span></div>
                     <div class="cditem"><span class="cdnum" id="cdH">00</span><span class="cdlbl">Jam</span></div>
                     <div class="cditem"><span class="cdnum" id="cdM">00</span><span class="cdlbl">Menit</span></div>
                     <div class="cditem"><span class="cdnum" id="cdS">00</span><span class="cdlbl">Detik</span></div>
                  </div>
               @else
                  <p class="sp-unlimited"><i class="fas fa-infinity me-2"></i>Berlaku tanpa batas waktu</p>
               @endif

               <a href="#menu" class="btn-red"><i class="fas fa-shopping-cart"></i>Ambil Promonya</a>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
               <div class="spimgw">
                  <div class="spglow"></div>
                  <div class="sppbdg">
                     <span class="old" style="text-decoration:none;">hemat</span>
                     <span class="np">{{ $promoUtama->diskon_persen }}%</span>
                  </div>
                  {{-- hasil Query Builder berupa stdClass (tanpa accessor), jadi URL foto dibentuk manual --}}
                  <img src="{{ $promoUtama->gambar ? asset('storage/' . $promoUtama->gambar) : asset('assets-guest/img/menu-default.jpg') }}" alt="{{ $promoUtama->nama_menu }}" class="promo-img" />
               </div>
            </div>
         </div>

         {{-- promo aktif lainnya --}}
         @if ($dataPromo->count() > 1)
            <div class="row g-3 mt-4">
               @foreach ($dataPromo->skip(1) as $promo)
                  <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                     <div class="promo-mini">
                        <div class="promo-mini-disc">-{{ $promo->diskon_persen }}%</div>
                        <div>
                           <div class="promo-mini-title">{{ $promo->judul_promo }}</div>
                           <div class="promo-mini-menu">{{ $promo->nama_menu }}</div>
                           <div class="promo-mini-price">
                              <s>Rp {{ number_format($promo->harga, 0, ',', '.') }}</s>
                              Rp {{ number_format($promo->harga_promo, 0, ',', '.') }}
                           </div>
                        </div>
                     </div>
                  </div>
               @endforeach
            </div>
         @endif
      @else
         <div class="text-center py-4" data-aos="fade-up">
            <div class="sptag"><i class="fas fa-bolt me-1"></i>Promo</div>
            <h2 class="sptitle">Promo segera hadir</h2>
            <p class="spdesc">Pantau terus halaman ini untuk promo Geprekku berikutnya.</p>
         </div>
      @endif
   </div>
</section>
