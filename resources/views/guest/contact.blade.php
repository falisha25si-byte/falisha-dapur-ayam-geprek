@extends('layouts.guest.app')

@section('title', 'Contact Us - Geprekku')

@section('content')
  <section id="contact-section">
    <div class="container">
      <div class="text-center mb-5" data-aos="fade-up">
        <span class="slbl">Get In Touch</span>
        <h2 class="stitle">Contact <span>Us</span></h2>
        <div class="sline"></div>
        <p class="sdesc mx-auto" style="max-width:480px;">Ada pertanyaan, saran, atau ingin pesan untuk acara spesial? Kami senang mendengarnya.</p>
      </div>

      <div class="row g-4">
        <div class="col-lg-4" data-aos="fade-right">
          <div class="ctdark">
            <h4>Let's Talk</h4>
            <p class="ctsub">Kami biasanya membalas dalam 2 jam pada jam operasional.</p>
            <div class="ctitem">
              <div class="cticon"><i class="fas fa-map-marker-alt"></i></div>
              <div class="ctinfo"><strong>Alamat</strong><span>Jl. Umban Sari No. 1, Rumbai,<br />Pekanbaru</span></div>
            </div>
            <div class="ctitem">
              <div class="cticon"><i class="fas fa-phone-alt"></i></div>
              <div class="ctinfo"><strong>Telepon</strong><span>0812-3456-7890</span></div>
            </div>
            <div class="ctitem">
              <div class="cticon"><i class="fas fa-envelope"></i></div>
              <div class="ctinfo"><strong>Email</strong><span>halo@geprekku.id</span></div>
            </div>
            <div class="ctitem">
              <div class="cticon"><i class="fas fa-clock"></i></div>
              <div class="ctinfo"><strong>Jam Buka</strong><span>Rabu - Minggu: 09.00 - 23.00</span></div>
            </div>
            <div class="ctsocrow">
              <a href="#"><i class="fab fa-facebook-f"></i></a>
              <a href="#"><i class="fab fa-instagram"></i></a>
              <a href="#"><i class="fab fa-tiktok"></i></a>
              <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
          </div>
        </div>

        <div class="col-lg-8" data-aos="fade-left">
          <div class="fcard">
            <div class="row g-3">
              <div class="col-sm-6"><label class="flbl">Nama *</label><input type="text" class="fctrl" placeholder="Nama lengkap" /></div>
              <div class="col-sm-6"><label class="flbl">Email *</label><input type="email" class="fctrl" placeholder="kamu@email.com" /></div>
              <div class="col-sm-6"><label class="flbl">No. Telepon</label><input type="tel" class="fctrl" placeholder="0812-0000-0000" /></div>
              <div class="col-sm-6">
                <label class="flbl">Subjek *</label>
                <select class="fctrl">
                  <option>Pertanyaan Umum</option>
                  <option>Katering &amp; Acara</option>
                  <option>Saran &amp; Masukan</option>
                  <option>Kerja Sama</option>
                </select>
              </div>
              <div class="col-12"><label class="flbl">Pesan *</label><textarea class="fctrl" rows="5" placeholder="Tulis pesanmu di sini..."></textarea></div>
              <div class="col-12"><button type="button" class="btn-red"><i class="fas fa-paper-plane"></i> Kirim Pesan</button></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
