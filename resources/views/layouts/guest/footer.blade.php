{{-- PartialView: footer + tombol back-to-top Guest --}}
      <!-- FOOTER -->
      <footer>
         <div class="container">
            <div class="row g-5">
               <div class="col-lg-4">
                  <div class="d-flex align-items-center gap-2 mb-2">
                     <img src="{{ asset('assets-guest/img/logo-geprekku.png') }}" alt="Logo Geprekku" class="footer-logo">
                     <div class="fnm">Geprek<span>ku</span></div>
                  </div>
                  <p class="fdesc">Ayam geprek renyah dengan sambal ulek dadakan. Cepat, pedas, dan ramah di kantong.</p>
                  <div class="fsoc">
                     <a href="#"><i class="fab fa-facebook-f"></i></a>
                     <a href="#"><i class="fab fa-instagram"></i></a>
                     <a href="#"><i class="fab fa-twitter"></i></a>
                     <a href="#"><i class="fab fa-youtube"></i></a>
                     <a href="#"><i class="fab fa-tiktok"></i></a>
                  </div>
               </div>
               <div class="col-sm-6 col-lg-2">
                  <div class="ftit">Quick Links</div>
                  <ul class="flinks ps-0">
                     <li><a href="{{ route('home') }}#hero"><i class="fas fa-chevron-right"></i>Home</a></li>
                     <li><a href="{{ route('home') }}#about"><i class="fas fa-chevron-right"></i>About Us</a></li>
                     <li><a href="{{ route('home') }}#menu"><i class="fas fa-chevron-right"></i>Our Menu</a></li>
                     <li><a href="{{ route('home') }}#reservation"><i class="fas fa-chevron-right"></i>Reservation</a></li>
                     <li><a href="{{ route('home') }}#blog"><i class="fas fa-chevron-right"></i>Blog</a></li>
                     <li><a href="{{ route('contact') }}"><i class="fas fa-chevron-right"></i>Contact</a></li>
                  </ul>
               </div>
               <div class="col-sm-6 col-lg-2">
                  <div class="ftit">Our Menu</div>
                  <ul class="flinks ps-0">
                     <li><a href="{{ route('home') }}#menu"><i class="fas fa-chevron-right"></i>Burgers</a></li>
                     <li><a href="{{ route('home') }}#menu"><i class="fas fa-chevron-right"></i>Pizza</a></li>
                     <li><a href="{{ route('home') }}#menu"><i class="fas fa-chevron-right"></i>Fried Chicken</a></li>
                     <li><a href="{{ route('home') }}#menu"><i class="fas fa-chevron-right"></i>Wraps &amp; Rolls</a></li>
                     <li><a href="{{ route('home') }}#menu"><i class="fas fa-chevron-right"></i>Pasta</a></li>
                     <li><a href="{{ route('home') }}#menu"><i class="fas fa-chevron-right"></i>Desserts</a></li>
                  </ul>
               </div>
               <div class="col-lg-4">
                  <div class="ftit">Get In Touch</div>
                  <div class="fci">
                     <div class="fciico"><i class="fas fa-map-marker-alt"></i></div>
                     <div class="fciinfo"><strong>Address</strong>Jl. Umban Sari No. 1, Rumbai, Pekanbaru</div>
                  </div>
                  <div class="fci">
                     <div class="fciico"><i class="fas fa-phone-alt"></i></div>
                     <div class="fciinfo"><strong>Telepon</strong>0812-3456-7890</div>
                  </div>
                  <div class="fci">
                     <div class="fciico"><i class="fas fa-envelope"></i></div>
                     <div class="fciinfo"><strong>Email</strong>halo@geprekku.id</div>
                  </div>
                  <div class="fci">
                     <div class="fciico"><i class="fas fa-clock"></i></div>
                     <div class="fciinfo"><strong>Hours</strong>Wed - Sun: 09 AM - 11 PM</div>
                  </div>
               </div>
            </div>
         </div>
         <div class="fbot">
            <div class="container">
               <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                  <p>&copy; {{ date('Y') }} <span>Geprekku</span>. Template Sarab by <a target="_blank" class="mx-0 fw-bold text-success" href="https://bestwpware.com/">Bestwpware</a>. Made with <span><i class="fas fa-heart"></i></span>  <br>Distributed by <a target="_blank" class="mx-0 fw-bold text-success" href="https://themewagon.com">ThemeWagon</a></p>
                  <div><a href="#">Privacy Policy</a><a href="#">Terms</a><a href="#">Cookies</a></div>
               </div>
            </div>
         </div>
      </footer>
      <!-- Floating cart -->
      <!-- <div class="cartfl"><i class="fas fa-shopping-cart"></i><span>My Cart</span><div class="ccount" id="cartCount">0</div></div> -->
      <!-- Back to top -->
      <button id="btt" onclick="window.scrollTo({top:0,behavior:'smooth'})"><i class="fas fa-chevron-up"></i></button>
    
