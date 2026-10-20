/* JS umum untuk halaman Guest selain Home (Contact & Login).
   main.js tidak dipakai di sini karena bergantung pada elemen khusus halaman Home. */
AOS.init({ duration: 680, once: true, offset: 55 });

// Navbar bayangan + tombol back-to-top
window.addEventListener('scroll', function () {
    document.getElementById('nav').classList.toggle('scrolled', window.scrollY > 60);
    document.getElementById('btt').classList.toggle('show', window.scrollY > 300);
});

// Search overlay
var searchOv = document.getElementById('searchOv');
document.getElementById('navSearchBtn').addEventListener('click', function () {
    searchOv.classList.add('open');
    document.body.style.overflow = 'hidden';
    setTimeout(function () { document.getElementById('searchInput').focus(); }, 220);
});
function closeSearch() {
    searchOv.classList.remove('open');
    document.body.style.overflow = '';
}
document.getElementById('searchClose').addEventListener('click', closeSearch);
searchOv.addEventListener('click', function (e) { if (e.target === searchOv) closeSearch(); });
