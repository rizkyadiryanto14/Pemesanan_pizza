<!DOCTYPE html>
<html lang="en">
<!-- File Header-->
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<title>Pizza Chita</title>
	<meta name="description" content="">
	<meta name="keywords" content="">

	<!-- Favicons -->
	<link href="<?= base_url() ?>assets/images/pizza_chita.png" rel="icon">
	<link href="<?= base_url() ?>assets/images/pizza_chita.png" rel="apple-touch-icon">

	<!-- Fonts -->
	<link href="https://fonts.googleapis.com" rel="preconnect">
	<link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

	<!-- Vendor CSS Files -->
	<link href="<?= base_url() ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/vendor/aos/aos.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

	<!-- Main CSS File -->
	<link href="<?= base_url() ?>assets/css/main.css" rel="stylesheet">

</head>
<!--End File Header-->

<body class="index-page">

<!--Header -->
<header id="header" class="header fixed-top">
	<div class="branding d-flex align-items-center">

		<div class="container position-relative d-flex align-items-center justify-content-between">
			<a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
				<h1 class="sitename">Pizza Chita</h1>
			</a>

			<nav id="navmenu" class="navmenu">
				<ul>
					<li><a href="#hero" class="active">Home<br></a></li>
					<li><a href="#about">Tentang Kami</a></li>
					<li><a href="#menu">Menu</a></li>
					<li><a href="#gallery">Galeri</a></li>
					<li><a href="#contact">Kontak</a></li>
				</ul>
				<i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
			</nav>

			<a class="btn-book-a-table d-none d-xl-block" href="<?= base_url('Auth') ?>">Pesan Sekarang</a>

		</div>

	</div>

</header>
<!--End Header-->

<!--content-->
<main class="main">

	<!-- Hero Section -->
	<section id="hero" class="hero section dark-background">

		<img src="<?= base_url() ?>assets/images/pizza_home.jpg" alt="" data-aos="fade-in">

		<div class="container">
			<div class="row">
				<div class="col-lg-8 d-flex flex-column align-items-center align-items-lg-start">
					<h2 data-aos="fade-up" data-aos-delay="100">Selamat Datang Di <span>Pizza Chita</span></h2>
					<p data-aos="fade-up" data-aos-delay="200">Pizza Ter-Enak Se-Kabupaten Sumbawa</p>
					<div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
						<a href="#menu" class="cta-btn">Menu Kami</a>
					</div>
				</div>
			</div>
		</div>

	</section>

	<!-- About Section -->
	<section id="about" class="about section">
		<div class="container" data-aos="fade-up" data-aos-delay="100">
			<div class="row gy-4">
				<div class="col-lg-6 order-1 order-lg-2">
					<img src="<?= base_url() ?>assets/images/pizza_home.jpg" class="img-fluid about-img"  alt="">
				</div>
				<div class="col-lg-6 order-2 order-lg-1 content">
					<h3>Pizza Chita</h3>
					<p class="fst-italic">
						Pizza Chita didirikan dengan tujuan menghadirkan cita rasa Italia yang autentik ke Kabupaten Sumbawa. Terletak di Jl. Hasanudin No.70, Bugis, Kec. Sumbawa, kami berkomitmen untuk menyajikan pizza berkualitas tinggi yang dibuat dengan bahan-bahan segar dan resep keluarga yang diwariskan dari generasi ke generasi.
					</p>
					<ul>
						<li><i class="bi bi-check2-all"></i> <span>Pizza dengan bahan-bahan segar dan berkualitas tinggi.</span></li>
						<li><i class="bi bi-check2-all"></i> <span>Dibuat dengan resep autentik Italia yang diwariskan dari generasi ke generasi.</span></li>
						<li><i class="bi bi-check2-all"></i> <span>Komitmen untuk memberikan pengalaman kuliner yang luar biasa di Kabupaten Sumbawa.</span></li>
						<li><i class="bi bi-check2-all"></i> <span>Tim yang berdedikasi untuk layanan pelanggan yang ramah dan profesional.</span></li>
					</ul>
					<p>
						Kami di Pizza Chita percaya bahwa makanan yang baik membawa kebahagiaan dan kebersamaan. Setiap pizza yang kami buat adalah perpaduan sempurna antara rasa dan seni, dibuat dengan cinta dan dedikasi untuk memberikan pengalaman kuliner yang tak terlupakan. Kami selalu siap mendengar dari Anda. Jika Anda memiliki pertanyaan, umpan balik, atau hanya ingin mengatakan halo, jangan ragu untuk menghubungi kami.
					</p>

				</div>
			</div>

		</div>

	</section><!-- /About Section -->

	<!-- Why Us Section -->
	<section id="why-us" class="why-us section">

		<!-- Section Title -->
		<div class="container section-title" data-aos="fade-up">
			<h2>Cari Pizza Terbaik Di Sumbawa?</h2>
			<p>Kenapa Harus Memilih Kami?</p>
		</div><!-- End Section Title -->

		<div class="container">

			<div class="row gy-4">

				<div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
					<div class="card-item">
						<span>01</span>
						<h4><a href="" class="stretched-link">Bahan-Bahan Segar</a></h4>
						<p>Kami hanya menggunakan bahan-bahan segar dan berkualitas tinggi untuk memastikan setiap gigitan pizza Anda penuh dengan rasa yang luar biasa.</p>
					</div>
				</div><!-- Card Item -->

				<div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
					<div class="card-item">
						<span>02</span>
						<h4><a href="" class="stretched-link">Resep Autentik Italia</a></h4>
						<p>Setiap pizza dibuat dengan resep autentik Italia yang diwariskan dari generasi ke generasi, memberikan Anda pengalaman kuliner yang otentik.</p>
					</div>
				</div><!-- Card Item -->

				<div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
					<div class="card-item">
						<span>03</span>
						<h4><a href="" class="stretched-link">Layanan Pelanggan Terbaik</a></h4>
						<p>Tim kami berdedikasi untuk memberikan layanan pelanggan yang ramah dan profesional, memastikan kepuasan Anda adalah prioritas utama kami.</p>
					</div>
				</div><!-- Card Item -->

			</div>

		</div>

	</section><!-- /Why Us Section -->

	<!-- Menu Section -->
	<section id="menu" class="menu section">

		<!-- Section Title -->
		<div class="container section-title" data-aos="fade-up">
			<h2>Menu</h2>
			<p>Menu Terbaik Kami</p>
		</div><!-- End Section Title -->

		<div class="container isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

			<div class="row isotope-container" data-aos="fade-up" data-aos-delay="200">
				<?php foreach ($produk as $item) { ?>
						<div class="col-lg-6 menu-item isotope-item filter-starters">
							<img src="<?= base_url($item->gambar_produk) ?>" class="menu-img" alt="">
							<div class="menu-content">
								<a href="#"><?= $item->nama_produk ?></a><span>Rp.<?= number_format($item->harga) ?></span>
							</div>
							<div class="menu-ingredients">
								<?= $item->keterangan_produk ?>
							</div>
						</div><!-- Menu Item -->
				<?php } ?>
			</div><!-- Menu Container -->
		</div>
	</section><!-- /Menu Section -->


	<!-- Gallery Section -->
	<section id="gallery" class="gallery section">

		<!-- Section Title -->
		<div class="container section-title" data-aos="fade-up">
			<h2>Gallery</h2>
			<p>Produk Terbaik Kami</p>
		</div><!-- End Section Title -->

		<div class="container-fluid" data-aos="fade-up" data-aos-delay="100">
			<div class="row g-0">
				<?php foreach ($produk as $item) { ?>
				<div class="col-lg-3 col-md-4">
					<div class="gallery-item">
						<a href="<?= base_url($item->gambar_produk) ?>" class="glightbox" data-gallery="images-gallery">
							<img src="<?= base_url($item->gambar_produk) ?>" alt="" class="img-fluid">
						</a>
					</div>
				</div><!-- End Gallery Item -->
				<?php } ?>
			</div>
		</div>

	</section><!-- /Gallery Section -->

	<!-- Contact Section -->
	<section id="contact" class="contact section">

		<!-- Section Title -->
		<div class="container section-title" data-aos="fade-up">
			<h2>Contact</h2>
			<p>Contact Us</p>
		</div><!-- End Section Title -->

		<div class="mb-5" data-aos="fade-up" data-aos-delay="200">
			<iframe style="border:0; width: 100%; height: 400px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3946.2007416870974!2d117.42402387575947!3d-8.479852385780784!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dcbed5716cfb247%3A0xcddfb1049edc869e!2sPizza%20Chitha%20Sumbawa!5e0!3m2!1sid!2sid!4v1734769792099!5m2!1sid!2sid" frameborder="0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
		</div><!-- End Google Maps -->

		<div class="container" data-aos="fade-up" data-aos-delay="100">

			<div class="row gy-4">

				<div class="col-lg-4">
					<div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
						<i class="bi bi-geo-alt flex-shrink-0"></i>
						<div>
							<h3>Lokasi</h3>
							<p>Brang Biji, Kec. Sumbawa, Kabupaten Sumbawa, Nusa Tenggara Bar. 84318</p>
						</div>
					</div><!-- End Info Item -->

					<div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
						<i class="bi bi-telephone flex-shrink-0"></i>
						<div>
							<h3>Jam Buka</h3>
							<p>Monday-Saturday:<br>09:00  - 21.00</p>
						</div>
					</div><!-- End Info Item -->

					<div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
						<i class="bi bi-telephone flex-shrink-0"></i>
						<div>
							<h3>Kontak</h3>
							<p>087863864865</p>
						</div>
					</div><!-- End Info Item -->

				</div>

				<div class="col-lg-8">
					<form action="#" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
						<div class="row gy-4">

							<div class="col-md-6">
								<input type="text" name="name" class="form-control" placeholder="Your Name" required="">
							</div>

							<div class="col-md-6 ">
								<input type="email" class="form-control" name="email" placeholder="Your Email" required="">
							</div>

							<div class="col-md-12">
								<input type="text" class="form-control" name="subject" placeholder="Subject" required="">
							</div>

							<div class="col-md-12">
								<textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
							</div>

							<div class="col-md-12 text-center">
								<div class="loading">Loading</div>
								<div class="error-message"></div>
								<div class="sent-message">Your message has been sent. Thank you!</div>

								<button type="submit">Send Message</button>
							</div>

						</div>
					</form>
				</div><!-- End Contact Form -->

			</div>

		</div>

	</section><!-- /Contact Section -->

</main>
<!--end content-->

<!--footer-->
<footer id="footer" class="footer">

	<div class="container footer-top">
		<div class="row gy-4">
			<div class="col-lg-4 col-md-6 footer-about">
				<a href="<?= base_url('Home') ?>" class="logo d-flex align-items-center">
					<span class="sitename">Pizza Chita</span>
				</a>
				<div class="footer-contact pt-3">
					<p>Brang Biji, Kec. Sumbawa</p>
					<p> Kabupaten Sumbawa, Nusa Tenggara Bar. 84318</p>
					<p class="mt-3"><strong>Phone:</strong> <span>087863864865</span></p>
				</div>
				<div class="social-links d-flex mt-4">
					<a href="https://www.facebook.com/desta.chitha/?locale=eo_EO" target="_blank"><i class="bi bi-facebook"></i></a>
					<a href="https://www.instagram.com/pizzachithaa/" target="_blank"><i class="bi bi-instagram"></i></a>
				</div>
			</div>

			<div class="col-lg-2 col-md-3 footer-links">
				<h4>Useful Links</h4>
				<ul>
					<li><a href="#hero" class="active">Home<br></a></li>
					<li><a href="#about">Tentang Kami</a></li>
					<li><a href="#menu">Menu</a></li>
					<li><a href="#gallery">Galeri</a></li>
					<li><a href="#contact">Kontak</a></li>
				</ul>
			</div>

			<div class="col-lg-4 col-md-12 footer-newsletter">
				<h4>Kirimin Kami Pesan</h4>
				<p>Subscribe Untuk selalu mendapatkan informasi menarik dari kami</p>
				<form action="#" method="post" class="php-email-form">
					<div class="newsletter-form"><input type="email" name="email"><input type="submit" value="Subscribe"></div>
					<div class="loading">Loading</div>
					<div class="error-message"></div>
					<div class="sent-message">Your subscription request has been sent. Thank you!</div>
				</form>
			</div>

		</div>
	</div>

	<div class="container copyright text-center mt-4">
		<p>© <span>Copyright</span> <strong class="px-1 sitename">Pizza Chita</strong> <span>All Rights Reserved</span></p>
	</div>

</footer>
<!--end footer-->

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/php-email-form/validate.js"></script>
<script src="<?= base_url() ?>assets/vendor/aos/aos.js"></script>
<script src="<?= base_url() ?>assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/swiper/swiper-bundle.min.js"></script>

<!-- Main JS File -->
<script src="<?= base_url() ?>assets/js/main.js"></script>

</body>

</html>
