{{--
  PartialView: Ulasan Pelanggan (data dari tabel ulasan, diambil dengan ELOQUENT ORM).
  Variabel: $dataUlasan (Collection model Ulasan + relasi pelanggan & menu)
--}}
<section id="testimonials">
   <div class="container">
      <div class="text-center mb-5" data-aos="fade-up">
         <span class="slbl">Kata Mereka</span>
         <h2 class="stitle">Ulasan <span>Pelanggan</span></h2>
         <div class="sline"></div>
      </div>

      @if ($dataUlasan->isNotEmpty())
         <div class="swiper tesSwiper" data-aos="fade-up">
            <div class="swiper-wrapper">
               @foreach ($dataUlasan as $item)
                  <div class="swiper-slide">
                     <div class="tescard">
                        <div class="tesq">"</div>
                        <div class="tess">
                           @for ($i = 1; $i <= 5; $i++)
                              <i class="{{ $i <= $item->rating ? 'fas' : 'far' }} fa-star"></i>
                           @endfor
                        </div>
                        <p class="testxt">{{ $item->komentar }}</p>
                        <div class="tesauth">
                           {{-- avatar inisial nama pelanggan --}}
                           <div class="tes-avatar">{{ Str::upper(Str::substr($item->pelanggan->nama_pelanggan, 0, 1)) }}</div>
                           <div>
                              <div class="tesnm">{{ $item->pelanggan->nama_pelanggan }}</div>
                              <div class="tesrl">Ulasan untuk {{ $item->menu->nama_menu }} &bull; {{ $item->tanggal_ulasan->translatedFormat('d M Y') }}</div>
                           </div>
                        </div>
                     </div>
                  </div>
               @endforeach
            </div>
            <div class="swiper-pagination mt-4" style="position:static;"></div>
         </div>
      @else
         <p class="text-center text-muted">Belum ada ulasan. Jadilah yang pertama mencoba Geprekku!</p>
      @endif
   </div>
</section>
