{{-- PartialView: JavaScript Guest --}}
<script src="{{ asset('assets-guest/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('assets-guest/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets-guest/js/aos.js') }}"></script>

@if (request()->routeIs('home'))
  {{-- Halaman Home: butuh Swiper, Magnific Popup, dan main.js lengkap --}}
  <script src="{{ asset('assets-guest/js/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('assets-guest/js/jquery.magnific-popup.min.js') }}"></script>
  <script src="{{ asset('assets-guest/js/main.js') }}"></script>
@else
  {{-- Halaman lain (Contact, Login): hanya fungsi umum navbar, search, back-to-top --}}
  <script src="{{ asset('assets-guest/js/guest-common.js') }}"></script>
@endif
