@extends('layouts.guest.app')

@section('title', 'Geprekku - Ayam Geprek Sambal Juara')

@section('content')
    <!-- ============================================================
             HERO
             ============================================================ -->
    <section id="hero">
        <div class="hs hs1"></div>
        <div class="hs hs2"></div>
        <div class="hbgtxt">GEPREK</div>
        <div class="container">
            <div class="row align-items-center g-5" style="min-height:88vh;">
                <div class="col-lg-6">
                    <div class="hbadge">
                        <div class="hbi"><i class="fas fa-star"></i></div>
                        <span>Ayam Geprek Favorit Mahasiswa Pekanbaru</span>
                    </div>
                    <h1 class="htitle">Pedasnya <span class="hl">Nampol</span>,<br />Gurihnya Bikin Nagih</h1>
                    <p class="hdesc">Ayam goreng tepung renyah yang digeprek bersama sambal bawang ulek dadakan. Pilih
                        level pedasmu dari 0 sampai 5!</p>
                    <div class="d-flex flex-wrap gap-3 mb-2">
                        <a href="#menu" class="btn-red"><i class="fas fa-utensils"></i>Lihat Menu</a>
                        <!-- FIX 2: Magnific popup video trigger -->
                        <a href="https://www.youtube.com/watch?v=RXv_uIN6e-Y" class="magnific_popup btn-play popup-youtube">
                            <div class="pico"><i class="fas fa-play"></i></div>
                            <span>Cerita Kami</span>
                        </a>
                    </div>
                    <div class="hstats d-flex gap-3 flex-wrap mt-4">
                        <div class="hstat"><span class="snum">850<em>+</em></span><small>Pelanggan Puas</small></div>
                        <div class="sdiv"></div>
                        <div class="hstat"><span class="snum">{{ $jumlahMenu }}<em>+</em></span><small>Pilihan
                                Menu</small></div>
                        <div class="sdiv"></div>
                        <div class="hstat"><span class="snum">15<em>+</em></span><small>Koki Andal</small></div>
                        <div class="sdiv"></div>
                        <div class="hstat"><span class="snum">5<em>lvl</em></span><small>Level Pedas</small></div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div style="position:relative;text-align:center;">
                        <div class="hcircle">
                            <img src="{{ asset('assets-guest/img/banner-img.jpg') }}" alt="Ayam Geprek" />
                        </div>
                        <div class="fcard fc1">
                            <div class="fcoi r"><i class="fas fa-fire"></i></div>
                            <div><span class="fcnum">Hot Deal</span><span class="fcsm">Diskon 30% hari ini</span></div>
                        </div>
                        <div class="fcard fc2">
                            <div class="fcoi y"><i class="fas fa-star"></i></div>
                            <div><span class="fcnum">4.9/5</span><span class="fcsm">2rb+ ulasan</span></div>
                        </div>
                        <div class="fcard fc3">
                            <div class="fcoi g"><i class="fas fa-clock"></i></div>
                            <div><span class="fcnum">15 menit</span><span class="fcsm">Antar cepat</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- MARQUEE -->
    <div class="mqsec">
        <div class="mqtrack">
            <div class="mqitem"><i class="fas fa-circle"></i>Crispy Fried Chicken</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Gourmet Burgers</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Artisan Pizzas</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Fresh Wraps &amp; Rolls</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Loaded Fries</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Ice Cream Shakes</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Grilled Sandwiches</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Crispy Fried Chicken</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Gourmet Burgers</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Artisan Pizzas</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Fresh Wraps &amp; Rolls</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Loaded Fries</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Ice Cream Shakes</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Grilled Sandwiches</div>
        </div>
    </div>
    <!-- CATEGORY -->
    <section id="category">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="slbl">Pilihan Kami</span>
                <h2 class="stitle">Cari Berdasarkan <span>Kategori</span></h2>
                <div class="sline"></div>
                <p class="sdesc mx-auto" style="max-width:480px;">Dari ayam geprek original sampai paket hemat - temukan
                    favoritmu di sini</p>
            </div>
            <div class="row g-3 justify-content-center">
                <div class="col-6 col-sm-4 col-md-3 col-lg-2" data-aos="zoom-in">
                    <div class="catcard active" data-filter="all">
                        <img class="catimg" src="{{ asset('assets-guest/img/category/1.jpg') }}" alt="" />
                        <div class="catnm">Semua Menu</div>
                        <div class="catct">{{ $jumlahMenu }} item</div>
                    </div>
                </div>
                @foreach ($kategoriMenu as $kategori => $jumlah)
                    <div class="col-6 col-sm-4 col-md-3 col-lg-2" data-aos="zoom-in"
                        data-aos-delay="{{ $loop->iteration * 70 }}">
                        <div class="catcard" data-filter="{{ Str::slug($kategori) }}">
                            <img class="catimg"
                                src="{{ asset('assets-guest/img/category/' . ($loop->iteration + 1) . '.jpg') }}"
                                alt="" />
                            <div class="catnm">{{ $kategori }}</div>
                            <div class="catct">{{ $jumlah }} item</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- ABOUT -->
    <section id="about">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-5" data-aos="fade-right">
                    <div class="astack">
                        <div class="aexp"><span class="anum">12+</span><small>Years of<br />Excellence</small></div>
                        <div class="amain"><img src="{{ asset('assets-guest/img/about1.jpg') }}" alt="Restaurant" />
                        </div>
                        <div class="asm"><img src="{{ asset('assets-guest/img/about2.jpg') }}" alt="" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-7" data-aos="fade-left">
                    <span class="slbl">Our Story</span>
                    <h2 class="stitle text-start">Mampir dan Rasakan<br /><span>Geprek Asli</span> Kami</h2>
                    <div class="sline lft"></div>
                    <p class="sdesc mb-4">Geprekku berawal dari warung kecil dekat kampus dengan satu mimpi: ayam geprek
                        enak, pedas, dan ramah di kantong mahasiswa. Sambal kami diulek dadakan setiap pesanan supaya
                        rasanya selalu segar.</p>
                    <div class="mb-4">
                        <div class="fti">
                            <div class="ftico r"><i class="fas fa-leaf"></i></div>
                            <div>
                                <h6>100% Fresh Ingredients</h6>
                                <p>We source locally and sustainably. Every ingredient is hand-picked daily for maximum
                                    freshness.</p>
                            </div>
                        </div>
                        <div class="fti">
                            <div class="ftico y"><i class="fas fa-award"></i></div>
                            <div>
                                <h6>Award-Winning Recipes</h6>
                                <p>Our signature recipes have won national culinary awards 5 years in a row.</p>
                            </div>
                        </div>
                        <div class="fti">
                            <div class="ftico g"><i class="fas fa-shipping-fast"></i></div>
                            <div>
                                <h6>Lightning-Fast Delivery</h6>
                                <p>Order online and get hot, fresh food at your door in under 25 minutes, guaranteed.</p>
                            </div>
                        </div>
                    </div>
                    <a href="#menu" class="btn-red"><i class="fas fa-book-open"></i>View Full Menu</a>
                </div>
            </div>
        </div>
    </section>
    <!-- ============================================================
             MENU - FIX 3 (filter works) + FIX 4 (plus opens popup)
             ============================================================ -->
    <section id="menu">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="slbl">Menu Hari Ini</span>
                <h2 class="stitle">Menu <span>Geprekku</span></h2>
                <div class="sline"></div>
            </div>
            <!-- FIX 3 - filter buttons -->
            <div class="text-center mb-4" data-aos="fade-up">
                <button class="filtbtn active" data-f="all">Semua</button>
                @foreach ($kategoriMenu as $kategori => $jumlah)
                    <button class="filtbtn" data-f="{{ Str::slug($kategori) }}">{{ $kategori }}</button>
                @endforeach
            </div>
            <div class="row g-4" id="mgrid">
                @forelse ($dataMenu as $item)
                    <div class="col-sm-6 col-lg-4 mwrap" data-c="{{ Str::slug($item->kategori) }}" data-aos="fade-up">
                        <div class="mcard"
                            data-img="{{ asset('assets-guest/img/menu/' . (($loop->index % 6) + 1) . '.jpg') }}"
                            data-title="{{ $item->nama_menu }}" data-cat="{{ $item->kategori }}"
                            data-price="Rp {{ number_format($item->harga, 0, ',', '.') }}" data-old=""
                            data-rating="4.9" data-reviews="{{ 20 + $item->menu_id }}" data-cal="-" data-time="15"
                            data-desc="{{ $item->deskripsi }}"
                            data-tags="Level {{ $item->level_pedas }},{{ $item->status }}">
                            <div class="mimg">
                                <img src="{{ asset('assets-guest/img/menu/' . (($loop->index % 6) + 1) . '.jpg') }}"
                                    alt="{{ $item->nama_menu }}" />
                                @if ($item->level_pedas >= 4)
                                    <div class="mbdg hot"><i class="fas fa-fire"></i> Level {{ $item->level_pedas }}
                                    </div>
                                @endif
                                <div class="mhrt"><i class="far fa-heart"></i></div>
                            </div>
                            <div class="mbody">
                                <div class="mcat">{{ $item->kategori }}</div>
                                <div class="mtit">{{ $item->nama_menu }}</div>
                                <div class="mdesc">{{ Str::limit($item->deskripsi, 80) }}</div>
                                <div class="mfoot">
                                    <div>
                                        <div class="mprice">Rp {{ number_format($item->harga, 0, ',', '.') }}</div>
                                        <div class="mstars"><i class="fas fa-pepper-hot"></i> <span
                                                style="color:#bbb;font-size:.7rem;">Level {{ $item->level_pedas }}</span>
                                        </div>
                                    </div>
                                    <button class="madd" title="Lihat Detail"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted">Menu belum tersedia.</div>
                @endforelse
            </div>
            <!-- end #mgrid -->
            <div class="text-center mt-5"><a href="#menu" class="btn-red"><i class="fas fa-th-large"></i>Lihat Semua
                    Menu</a></div>
        </div>
    </section>


    <!-- ============================================================
             FIX 4 - MENU DETAIL POPUP MODAL
             ============================================================ -->
    <div id="menuPop">
        <div class="mpbox">
            <button class="mpclose" id="mpClose"><i class="fas fa-times"></i></button>
            <div class="mpimg"><img id="mpImg" src="" alt="" /></div>
            <div class="mpbody">
                <div id="mpCat"></div>
                <div id="mpTitle"></div>
                <div id="mpStars"></div>
                <div id="mpDesc"></div>
                <div id="mpPrice"></div>
                <div class="mpmeta" id="mpMeta"></div>
                <div class="mpqty">
                    <button class="mpqbtn" id="mpMinus">-</button>
                    <span class="mpqnum" id="mpQnum">1</span>
                    <button class="mpqbtn" id="mpPlus">+</button>
                    <span style="font-size:.82rem;color:#aaa;margin-left:9px;">portion</span>
                </div>
                <div class="mptags" id="mpTags"></div>
                <button class="mpaddcart" id="mpAddCart"><i class="fas fa-shopping-cart"></i>Add to Cart</button>
            </div>
        </div>
    </div>
    <!-- SPECIAL OFFER -->
    <section id="special">
        <div class="spbg"></div>
        <div class="container" style="position:relative;z-index:2;">
            <div class="row align-items-center g-5">
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="sptag"><i class="fas fa-bolt me-1"></i>Limited Time Offer</div>
                    <h2 class="sptitle">Get 30% Off<br />Our Signature<br /><span>Burger</span> Meal</h2>
                    <p class="spdesc">Don't miss our weekend special - grab our award-winning signature burger combo with
                        loaded fries and a premium shake at an unbeatable price.</p>
                    <div class="cdwrap">
                        <div class="cditem"><span class="cdnum" id="cdH">08</span><span
                                class="cdlbl">Hours</span></div>
                        <div class="cditem"><span class="cdnum" id="cdM">45</span><span
                                class="cdlbl">Minutes</span></div>
                        <div class="cditem"><span class="cdnum" id="cdS">30</span><span
                                class="cdlbl">Seconds</span></div>
                    </div>
                    <a href="#menu" class="btn-red"><i class="fas fa-shopping-cart"></i>Grab the Deal</a>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="spimgw">
                        <div class="spglow"></div>
                        <div class="sppbdg"><span class="old">$24.99</span><span class="np">$17.49</span></div>
                        <img src="{{ asset('assets-guest/img/off-img.jpg') }}" alt="Special Burger" />
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ============================================================
             GALLERY - FIX 7 (click opens detail popup)
             ============================================================ -->
    <section id="gallery">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="slbl">Food Showcase</span>
                <h2 class="stitle">Let's See Our <span>Fast Food</span></h2>
                <div class="sline"></div>
            </div>
            <div class="ggrid" data-aos="fade-up">
                <div class="gitem" data-gi="0" data-gimg="{{ asset('assets-guest/img/portfolio/work1.jpg') }}"
                    data-gtitle="Gourmet Burgers"
                    data-gdesc="Our award-winning smash burgers, hand-crafted with 100% premium beef, aged cheddar and house-made sauces.">
                    <img src="{{ asset('assets-guest/img/portfolio/work1.jpg') }}" alt="Burgers" />
                    <div class="gover"><span><i class="fas fa-expand-alt"></i> Gourmet Burgers</span></div>
                </div>
                <div class="gitem" data-gi="1" data-gimg="{{ asset('assets-guest/img/portfolio/work2.jpg') }}"
                    data-gtitle="Wood-Fired Pizza"
                    data-gdesc="Authentic Neapolitan-style pizzas fired at 900deg F in our wood-burning stone oven for the perfect char.">
                    <img src="{{ asset('assets-guest/img/portfolio/work2.jpg') }}" alt="Pizza" />
                    <div class="gover"><span><i class="fas fa-expand-alt"></i> Wood-Fired Pizza</span></div>
                </div>
                <div class="gitem" data-gi="2" data-gimg="{{ asset('assets-guest/img/portfolio/work3.jpg') }}"
                    data-gtitle="Crispy Fried Chicken"
                    data-gdesc="Double-brined, hand-battered chicken fried to golden perfection using our 15-spice secret blend.">
                    <img src="{{ asset('assets-guest/img/portfolio/work3.jpg') }}" alt="Chicken" />
                    <div class="gover"><span><i class="fas fa-expand-alt"></i> Crispy Fried Chicken</span></div>
                </div>
                <div class="gitem" data-gi="3" data-gimg="{{ asset('assets-guest/img/portfolio/work4.jpg') }}"
                    data-gtitle="Sweet Desserts"
                    data-gdesc="Handcrafted desserts - from molten lava cakes to artisan ice cream sundaes and seasonal pastries.">
                    <img src="{{ asset('assets-guest/img/portfolio/work4.jpg') }}" alt="Desserts" />
                    <div class="gover"><span><i class="fas fa-expand-alt"></i> Sweet Desserts</span></div>
                </div>
                <div class="gitem" data-gi="4" data-gimg="{{ asset('assets-guest/img/portfolio/work5.jpg') }}"
                    data-gtitle="Fresh Wraps &amp; Rolls"
                    data-gdesc="Loaded fresh wraps packed with grilled proteins, crunchy vegetables and our house-made sauces.">
                    <img src="{{ asset('assets-guest/img/portfolio/work5.jpg') }}" alt="Wraps" />
                    <div class="gover"><span><i class="fas fa-expand-alt"></i> Fresh Wraps &amp; Rolls</span></div>
                </div>
            </div>
        </div>
    </section>
    <!-- FIX 7 - GALLERY POPUP -->
    <div id="galPop">
        <div class="gpbox">
            <button class="gpclose" id="gpClose"><i class="fas fa-times"></i></button>
            <img id="gpImg" src="" alt="" />
            <div class="gpcap">
                <h5 id="gpTitle"></h5>
                <p id="gpDesc"></p>
            </div>
            <div class="gpnav">
                <button id="gpPrev"><i class="fas fa-chevron-left me-1"></i>Prev</button>
                <button id="gpNext">Next <i class="fas fa-chevron-right ms-1"></i></button>
            </div>
        </div>
    </div>


    <!-- ============================================================
             HISTORY - FIX 8 (alternating left/right text)
             ============================================================ -->
    <section id="history">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="slbl">Our Journey</span>
                <h2 class="stitle">A History of <span>Restaurant</span></h2>
                <div class="sline"></div>
                <p class="sdesc mx-auto" style="max-width:480px;">From humble beginnings to the city's most beloved
                    restaurant - every chapter written with passion.</p>
            </div>
            <div class="timeline" data-aos="fade-up">
                <!-- ODD ? text on LEFT -->
                <div class="tli">
                    <div class="tl-left">
                        <div class="tlyear">2012</div>
                        <h5>Evolution of Restaurants</h5>
                        <p>Geprekku opens its first 20-seat diner on Flavor Street. Within 3 months, lines stretch around
                            the block every evening as word of our food spreads.</p>
                    </div>
                    <div class="tl-center">
                        <div class="tldot"></div>
                    </div>
                    <div class="tl-right">
                        <div class="tlyear">2012</div>
                        <h5>Evolution of Restaurants</h5>
                        <p>Geprekku opens its first 20-seat diner on Flavor Street. Within 3 months, lines stretch around
                            the block every evening as word of our food spreads.</p>
                    </div>
                </div>
                <!-- EVEN ? text on RIGHT -->
                <div class="tli">
                    <div class="tl-left">
                        <div class="tlyear">2015</div>
                        <h5>Fine Dining &amp; The Concept</h5>
                        <p>Expanding the vision - we introduced our signature tasting menu and hired our first
                            Michelin-trained chef, elevating our craft to remarkable new heights.</p>
                    </div>
                    <div class="tl-center">
                        <div class="tldot"></div>
                    </div>
                    <div class="tl-right">
                        <div class="tlyear">2015</div>
                        <h5>Fine Dining &amp; The Concept</h5>
                        <p>Expanding the vision - we introduced our signature tasting menu and hired our first
                            Michelin-trained chef, elevating our craft to remarkable new heights.</p>
                    </div>
                </div>
                <!-- ODD ? text on LEFT -->
                <div class="tli">
                    <div class="tl-left">
                        <div class="tlyear">2019</div>
                        <h5>Modern Fast Food Origins</h5>
                        <p>Launched our signature fast-food line, merging gourmet quality with speed and convenience. Within
                            6 months we won 3 prestigious culinary awards nationally.</p>
                    </div>
                    <div class="tl-center">
                        <div class="tldot"></div>
                    </div>
                    <div class="tl-right">
                        <div class="tlyear">2019</div>
                        <h5>Modern Fast Food Origins</h5>
                        <p>Launched our signature fast-food line, merging gourmet quality with speed and convenience. Within
                            6 months we won 3 prestigious culinary awards nationally.</p>
                    </div>
                </div>
                <!-- EVEN ? text on RIGHT -->
                <div class="tli">
                    <div class="tl-left">
                        <div class="tlyear">2026</div>
                        <h5>National Expansion</h5>
                        <p>Now operating in 8 cities across the US with an online delivery platform handling 10,000+ orders
                            weekly - and growing every single day.</p>
                    </div>
                    <div class="tl-center">
                        <div class="tldot"></div>
                    </div>
                    <div class="tl-right">
                        <div class="tlyear">2026</div>
                        <h5>National Expansion</h5>
                        <p>Now operating in 8 cities across the US with an online delivery platform handling 10,000+ orders
                            weekly - and growing every single day.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- CHEFS -->
    <section id="chefs">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="slbl">The Culinary Team</span>
                <h2 class="stitle">Meet Our Expert <span>Chefs</span></h2>
                <div class="sline"></div>
            </div>
            <div class="row g-4">
                <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="0">
                    <div class="chcard">
                        <div class="chimg">
                            <img src="{{ asset('assets-guest/img/chefs/1.jpg') }}" alt="" />
                            <div class="chsoc"><a href="#"><i class="fab fa-instagram"></i></a><a
                                    href="#"><i class="fab fa-facebook-f"></i></a><a href="#"><i
                                        class="fab fa-twitter"></i></a></div>
                        </div>
                        <div class="chbody">
                            <div class="chnm">Alice Mortal</div>
                            <div class="chrole">Head Chef</div>
                            <div class="chexp">12 years experience</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="80">
                    <div class="chcard">
                        <div class="chimg">
                            <img src="{{ asset('assets-guest/img/chefs/2.jpg') }}" alt="" />
                            <div class="chsoc"><a href="#"><i class="fab fa-instagram"></i></a><a
                                    href="#"><i class="fab fa-facebook-f"></i></a><a href="#"><i
                                        class="fab fa-twitter"></i></a></div>
                        </div>
                        <div class="chbody">
                            <div class="chnm">Michael Corn</div>
                            <div class="chrole">Grill Master</div>
                            <div class="chexp">8 years experience</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="160">
                    <div class="chcard">
                        <div class="chimg">
                            <img src="{{ asset('assets-guest/img/chefs/3.jpg') }}" alt="" />
                            <div class="chsoc"><a href="#"><i class="fab fa-instagram"></i></a><a
                                    href="#"><i class="fab fa-facebook-f"></i></a><a href="#"><i
                                        class="fab fa-twitter"></i></a></div>
                        </div>
                        <div class="chbody">
                            <div class="chnm">Faz Chowdel</div>
                            <div class="chrole">Pastry Chef</div>
                            <div class="chexp">10 years experience</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="240">
                    <div class="chcard">
                        <div class="chimg">
                            <img src="{{ asset('assets-guest/img/chefs/4.jpg') }}" alt="" />
                            <div class="chsoc"><a href="#"><i class="fab fa-instagram"></i></a><a
                                    href="#"><i class="fab fa-facebook-f"></i></a><a href="#"><i
                                        class="fab fa-twitter"></i></a></div>
                        </div>
                        <div class="chbody">
                            <div class="chnm">William Latnum</div>
                            <div class="chrole">Pizza Artisan</div>
                            <div class="chexp">9 years experience</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- HOURS -->
    <section id="hours">
        <div class="hrsbg"></div>
        <div class="container" style="position:relative;z-index:2;">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="slbl" style="color:#a5d6bc;">Opening Hours</span>
                <h2 class="stitle" style="color:#fff;">We're Open <span style="color:var(--secondary);">For You</span>
                </h2>
                <div class="sline"></div>
            </div>
            <div class="row g-4 align-items-start">
                <div class="col-lg-5" data-aos="fade-right">
                    <div class="hrscard">
                        <div class="hrsrow">
                            <span class="hrsday"><i class="fas fa-calendar-day me-2"
                                    style="color:var(--secondary);"></i>Monday - Tuesday</span>
                            <div class="d-flex align-items-center gap-2">
                                <div class="hdot off"></div>
                                <span class="hrstime" style="color:#ff6b6b;">Closed</span>
                            </div>
                        </div>
                        <div class="hrsrow">
                            <span class="hrsday"><i class="fas fa-calendar-day me-2"
                                    style="color:var(--secondary);"></i>Wednesday - Thursday</span>
                            <div class="d-flex align-items-center gap-2">
                                <div class="hdot on"></div>
                                <span class="hrstime">09:00 AM - 10:00 PM</span>
                            </div>
                        </div>
                        <div class="hrsrow">
                            <span class="hrsday"><i class="fas fa-calendar-day me-2"
                                    style="color:var(--secondary);"></i>Friday</span>
                            <div class="d-flex align-items-center gap-2">
                                <div class="hdot on"></div>
                                <span class="hrstime">09:00 AM - 11:00 PM</span>
                            </div>
                        </div>
                        <div class="hrsrow">
                            <span class="hrsday"><i class="fas fa-calendar-day me-2"
                                    style="color:var(--secondary);"></i>Saturday</span>
                            <div class="d-flex align-items-center gap-2">
                                <div class="hdot on"></div>
                                <span class="hrstime">10:00 AM - 11:30 PM</span>
                            </div>
                        </div>
                        <div class="hrsrow">
                            <span class="hrsday"><i class="fas fa-calendar-day me-2"
                                    style="color:var(--secondary);"></i>Sunday</span>
                            <div class="d-flex align-items-center gap-2">
                                <div class="hdot on"></div>
                                <span class="hrstime">11:00 AM - 09:00 PM</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3" data-aos="zoom-in">
                    <div class="hrscta">
                        <i class="fas fa-truck-fast fa-2x mb-3" style="color:rgba(255,255,255,.8);"></i>
                        <h4>Order Online</h4>
                        <p>Get hot food delivered in 25 minutes</p>
                        <a href="#menu" class="btnw">Order Now ?</a>
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-left">
                    <div class="hrscard">
                        <h5
                            style="color:#fff;margin-bottom:18px;font-family:'Poppins',sans-serif;font-size:.95rem;font-weight:700;">
                            <i class="fas fa-map-marker-alt me-2" style="color:var(--secondary);"></i>Find Us</h5>
                        <div class="hrsrow"><span class="hrsday"><i class="fas fa-location-dot me-2"
                                    style="color:var(--secondary);"></i>Address</span><span class="hrstime"
                                style="font-size:.8rem;">42 Flavor Street, NY</span></div>
                        <div class="hrsrow"><span class="hrsday"><i class="fas fa-phone me-2"
                                    style="color:var(--secondary);"></i>Phone</span><span class="hrstime"
                                style="font-size:.8rem;">+1 (800) 123-4567</span></div>
                        <div class="hrsrow"><span class="hrsday"><i class="fas fa-envelope me-2"
                                    style="color:var(--secondary);"></i>Email</span><span class="hrstime"
                                style="font-size:.8rem;">halo@geprekku.id</span></div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- TESTIMONIALS -->
    <section id="testimonials">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="slbl">What People Say</span>
                <h2 class="stitle">Our Customers <span>Feedback</span></h2>
                <div class="sline"></div>
            </div>
            <div class="swiper tesSwiper" data-aos="fade-up">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="tescard">
                            <div class="tesq">"</div>
                            <div class="tess"><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                    class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                            <p class="testxt">Honestly the best burgers I've ever had. The smash burger is incredible -
                                perfectly crispy edges, juicy inside, and those pickles! We come every Friday now.</p>
                            <div class="tesauth">
                                <img src="{{ asset('assets-guest/img/testimonial/1.jpg') }}" alt="" />
                                <div>
                                    <div class="tesnm">Monica Wilber</div>
                                    <div class="tesrl">Regular Customer</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="tescard">
                            <div class="tesq">"</div>
                            <div class="tess"><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                    class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                            <p class="testxt">Ordered delivery and the food arrived hot and fresh in 22 minutes. Portions
                                are generous. Geprekku has become my go-to comfort food spot without question.</p>
                            <div class="tesauth">
                                <img src="{{ asset('assets-guest/img/testimonial/2.jpg') }}" alt="" />
                                <div>
                                    <div class="tesnm">Cameron Fox</div>
                                    <div class="tesrl">Food Blogger</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="tescard">
                            <div class="tesq">"</div>
                            <div class="tess"><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                    class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                            <p class="testxt">The truffle pasta blew my mind. I didn't expect that quality from a fast food
                                place. Great ambiance, super friendly staff. Highly recommended!</p>
                            <div class="tesauth">
                                <img src="{{ asset('assets-guest/img/testimonial/3.jpg') }}" alt="" />
                                <div>
                                    <div class="tesnm">Priya Sharma</div>
                                    <div class="tesrl">Food Enthusiast</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="tescard">
                            <div class="tesq">"</div>
                            <div class="tess"><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                    class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                            <p class="testxt">Catered our office party of 50 people and everything was flawless. Fresh,
                                delicious, on time and well presented. Nashville chicken was the absolute star!</p>
                            <div class="tesauth">
                                <img src="{{ asset('assets-guest/img/testimonial/4.jpg') }}" alt="" />
                                <div>
                                    <div class="tesnm">David Park</div>
                                    <div class="tesrl">Corporate Client</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination mt-4" style="position:static;"></div>
            </div>
        </div>
    </section>

    <!-- RESERVATION FORM -->
    <section id="reservation">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="slbl">Book a Table</span>
                <h2 class="stitle">Make a <span>Reservation</span></h2>
                <div class="sline"></div>
                <p class="sdesc mx-auto" style="max-width:480px;">Reserve your table for a memorable dining experience. We
                    recommend booking 24 hours in advance for weekend evenings.</p>
            </div>
            <div class="row g-4 align-items-start">
                <div class="col-lg-4" data-aos="fade-right">
                    <div style="background:var(--dark);border-radius:18px;padding:36px;">
                        <h4 style="color:#fff;font-size:1.3rem;margin-bottom:8px;">Contact Info</h4>
                        <p style="color:rgba(255,255,255,.55);font-size:.85rem;margin-bottom:26px;">We're happy to help you
                            plan the perfect dining experience.</p>
                        <div class="d-flex flex-column gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <div
                                    style="width:46px;height:46px;border-radius:11px;background:rgba(232,40,26,.2);display:flex;align-items:center;justify-content:center;color:var(--primary);font-size:1.1rem;flex-shrink:0;">
                                    <i class="fas fa-clock"></i></div>
                                <div><strong
                                        style="display:block;color:#ccc;font-size:.78rem;text-transform:uppercase;letter-spacing:.8px;">Opening
                                        Hours</strong><span style="color:#fff;font-size:.87rem;">Wed - Sun, 9 AM - 11
                                        PM</span></div>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <div
                                    style="width:46px;height:46px;border-radius:11px;background:rgba(232,40,26,.2);display:flex;align-items:center;justify-content:center;color:var(--primary);font-size:1.1rem;flex-shrink:0;">
                                    <i class="fas fa-phone-alt"></i></div>
                                <div><strong
                                        style="display:block;color:#ccc;font-size:.78rem;text-transform:uppercase;letter-spacing:.8px;">Call
                                        for Booking</strong><span style="color:#fff;font-size:.87rem;">+1 (800)
                                        123-4567</span></div>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <div
                                    style="width:46px;height:46px;border-radius:11px;background:rgba(232,40,26,.2);display:flex;align-items:center;justify-content:center;color:var(--primary);font-size:1.1rem;flex-shrink:0;">
                                    <i class="fas fa-users"></i></div>
                                <div><strong
                                        style="display:block;color:#ccc;font-size:.78rem;text-transform:uppercase;letter-spacing:.8px;">Group
                                        Dining</strong><span style="color:#fff;font-size:.87rem;">Special menus for 10+
                                        guests</span></div>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <div
                                    style="width:46px;height:46px;border-radius:11px;background:rgba(232,40,26,.2);display:flex;align-items:center;justify-content:center;color:var(--primary);font-size:1.1rem;flex-shrink:0;">
                                    <i class="fas fa-map-marker-alt"></i></div>
                                <div><strong
                                        style="display:block;color:#ccc;font-size:.78rem;text-transform:uppercase;letter-spacing:.8px;">Location</strong><span
                                        style="color:#fff;font-size:.87rem;">42 Flavor Street, NY</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8" data-aos="fade-left">
                    <div class="fcard">
                        <div class="row g-3">
                            <div class="col-sm-6"><label class="flbl">Full Name *</label><input type="text"
                                    class="fctrl" placeholder="John Doe" /></div>
                            <div class="col-sm-6"><label class="flbl">Phone Number *</label><input type="tel"
                                    class="fctrl" placeholder="+1 (800) 000-0000" /></div>
                            <div class="col-sm-6"><label class="flbl">Email Address *</label><input type="email"
                                    class="fctrl" placeholder="you@email.com" /></div>
                            <div class="col-sm-6">
                                <label class="flbl">Number of Guests *</label>
                                <select class="fctrl">
                                    <option>1 Person</option>
                                    <option>2 People</option>
                                    <option>3 - 4 People</option>
                                    <option>5 - 6 People</option>
                                    <option>7 -10 People</option>
                                    <option>10+ People</option>
                                </select>
                            </div>
                            <div class="col-sm-6"><label class="flbl">Date *</label><input type="date"
                                    class="fctrl" /></div>
                            <div class="col-sm-6">
                                <label class="flbl">Time *</label>
                                <select class="fctrl">
                                    <option>09:00 AM</option>
                                    <option>10:00 AM</option>
                                    <option>11:00 AM</option>
                                    <option>12:00 PM</option>
                                    <option>01:00 PM</option>
                                    <option>02:00 PM</option>
                                    <option>06:00 PM</option>
                                    <option>07:00 PM</option>
                                    <option>08:00 PM</option>
                                    <option>09:00 PM</option>
                                    <option>10:00 PM</option>
                                </select>
                            </div>
                            <div class="col-12"><label class="flbl">Special Requests</label>
                                <textarea class="fctrl" rows="3" placeholder="Allergies, dietary needs, special occasions..."></textarea>
                            </div>
                            <div class="col-12"><button class="btn-red w-100 justify-content-center" id="resBtn"><i
                                        class="fas fa-calendar-check"></i>Confirm Reservation</button></div>
                        </div>
                        <div class="sucmsg" id="resOk">
                            <i class="fas fa-check-circle"></i>
                            <p>Table reserved! We'll confirm via email shortly.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- BLOG -->
    <section id="blog">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="slbl">News &amp; Updates</span>
                <h2 class="stitle">Our Latest <span>Blog</span> Posts</h2>
                <div class="sline"></div>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="0">
                    <div class="blcard">
                        <div class="blimg">
                            <img src="{{ asset('assets-guest/img/blog/1.jpg') }}" alt="" />
                            <div class="bldatebdg"><span class="bd">14</span><span class="bm">Mar</span></div>
                        </div>
                        <div class="blbody">
                            <div class="bltag">Food &amp; Health</div>
                            <div class="bltit"><a href="#">Healthy Fast Food: A Myth or Beautiful Reality</a></div>
                            <div class="blmeta"><span><i class="fas fa-user"></i>James Writer</span><span><i
                                        class="fas fa-comment"></i>24 Comments</span></div>
                            <a href="#" class="blmore">Read More <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="80">
                    <div class="blcard">
                        <div class="blimg">
                            <img src="{{ asset('assets-guest/img/blog/2.jpg') }}" alt="" />
                            <div class="bldatebdg"><span class="bd">28</span><span class="bm">Feb</span></div>
                        </div>
                        <div class="blbody">
                            <div class="bltag">Food Science</div>
                            <div class="bltit"><a href="#">Is Fast Food Getting Healthier? Here's What We Found</a>
                            </div>
                            <div class="blmeta"><span><i class="fas fa-user"></i>Sarah Grain</span><span><i
                                        class="fas fa-comment"></i>18 Comments</span></div>
                            <a href="#" class="blmore">Read More <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="160">
                    <div class="blcard">
                        <div class="blimg">
                            <img src="{{ asset('assets-guest/img/blog/3.jpg') }}" alt="" />
                            <div class="bldatebdg"><span class="bd">05</span><span class="bm">Jan</span></div>
                        </div>
                        <div class="blbody">
                            <div class="bltag">Recipes</div>
                            <div class="bltit"><a href="#">Innovative Hot Chickpeas Flake Crackin' Recipe at
                                    Home</a></div>
                            <div class="blmeta"><span><i class="fas fa-user"></i>Chef Marcus</span><span><i
                                        class="fas fa-comment"></i>32 Comments</span></div>
                            <a href="#" class="blmore">Read More <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- NEWSLETTER -->
    <section id="newsletter">
        <div class="nlbg"></div>
        <div class="container">
            <div class="nlw text-center" data-aos="zoom-in">
                <span class="slbl" style="color:rgba(255,255,255,.7);">Stay Connected</span>
                <h2 class="mb-3" style="color:#fff;">Subscribe &amp; Get Exclusive <span
                        style="color:var(--secondary);">Deals</span></h2>
                <p class="mb-4" style="color:rgba(255,255,255,.78);">Get 15% off your first order plus early access to
                    new menu items</p>
                <div class="nl-form-wrap">
                    <input class="nlinput" type="email" id="nlEmail" placeholder="Enter your email address..." />
                    <button class="nlbtn" id="nlBtn"><i class="fas fa-paper-plane me-1"></i>Subscribe</button>
                </div>
                <p style="color:rgba(255,255,255,.45);font-size:.76rem;margin-top:11px;"><i
                        class="fas fa-lock me-1"></i>No spam, unsubscribe anytime.</p>
            </div>
        </div>
    </section>

    <!-- ============================================================
             FIX 6 - CONTACT FORM
             ============================================================ -->
    <section id="contact-section">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="slbl">Get In Touch</span>
                <h2 class="stitle">Contact <span>Us</span></h2>
                <div class="sline"></div>
                <p class="sdesc mx-auto" style="max-width:480px;">Have a question, feedback, or want to plan a special
                    event? We'd love to hear from you.</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4" data-aos="fade-right">
                    <div class="ctdark">
                        <h4>Let's Talk</h4>
                        <p class="ctsub">We typically respond within 2 hours during business hours.</p>
                        <div class="ctitem">
                            <div class="cticon"><i class="fas fa-map-marker-alt"></i></div>
                            <div class="ctinfo"><strong>Address</strong><span>42 Flavor Street, Manhattan,<br />New York,
                                    NY 10001</span></div>
                        </div>
                        <div class="ctitem">
                            <div class="cticon"><i class="fas fa-phone-alt"></i></div>
                            <div class="ctinfo"><strong>Phone</strong><span>+1 (800) 123-4567</span></div>
                        </div>
                        <div class="ctitem">
                            <div class="cticon"><i class="fas fa-envelope"></i></div>
                            <div class="ctinfo"><strong>Email</strong><span>halo@geprekku.id</span></div>
                        </div>
                        <div class="ctitem">
                            <div class="cticon"><i class="fas fa-clock"></i></div>
                            <div class="ctinfo"><strong>Working Hours</strong><span>Wed - Sun: 9 AM - 11 PM</span></div>
                        </div>
                        <div class="ctsocrow">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8" data-aos="fade-left">
                    <div class="fcard">
                        <div class="row g-3">
                            <div class="col-sm-6"><label class="flbl">Your Name *</label><input type="text"
                                    class="fctrl" placeholder="John Doe" /></div>
                            <div class="col-sm-6"><label class="flbl">Email Address *</label><input type="email"
                                    class="fctrl" placeholder="you@email.com" /></div>
                            <div class="col-sm-6"><label class="flbl">Phone Number</label><input type="tel"
                                    class="fctrl" placeholder="+1 (800) 000-0000" /></div>
                            <div class="col-sm-6">
                                <label class="flbl">Subject *</label>
                                <select class="fctrl">
                                    <option>General Inquiry</option>
                                    <option>Catering &amp; Events</option>
                                    <option>Feedback</option>
                                    <option>Partnership</option>
                                    <option>Media &amp; Press</option>
                                </select>
                            </div>
                            <div class="col-12"><label class="flbl">Message *</label>
                                <textarea class="fctrl" rows="5" placeholder="Write your message here..."></textarea>
                            </div>
                            <div class="col-12"><button class="btn-red" id="ctcBtn"><i
                                        class="fas fa-paper-plane"></i>Send Message</button></div>
                        </div>
                        <div class="sucmsg" id="ctcOk">
                            <i class="fas fa-check-circle"></i>
                            <p>Message sent! We'll reply within 2 hours.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
