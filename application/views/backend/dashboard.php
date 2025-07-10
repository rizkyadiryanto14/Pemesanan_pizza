<?php $this->load->view('templates/header') ?>
<?php $this->load->view('templates/navbar') ?>
<?php $this->load->view('templates/sidebar') ?>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0">Dashboard</h1>
					</div><!-- /.col -->
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
							<li class="breadcrumb-item active">Dashboard</li>
						</ol>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.container-fluid -->
		</div>
		<!-- /.content-header -->

		<!-- Main content -->
		<section class="content">
			<div class="container-fluid">
				<div class="row">
					<!-- Statistik -->
					<div class="col-lg-3 col-6">
						<div class="small-box bg-info">
							<div class="inner">
								<h3><?= $count_produk ?></h3>
								<p>Produk</p>
							</div>
							<div class="icon">
								<i class="ion ion-bag"></i>
							</div>
							<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>

					<div class="col-lg-3 col-6">
						<div class="small-box bg-success">
							<div class="inner">
								<h3><?= $count_kategori ?></h3>
								<p>Kategori Produk</p>
							</div>
							<div class="icon">
								<i class="ion ion-stats-bars"></i>
							</div>
							<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>

					<div class="col-lg-3 col-6">
						<div class="small-box bg-warning">
							<div class="inner">
								<h3><?= $count_users ?></h3>
								<p>User Registrations</p>
							</div>
							<div class="icon">
								<i class="ion ion-person-add"></i>
							</div>
							<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>

					<div class="col-lg-3 col-6">
						<div class="small-box bg-danger">
							<div class="inner">
								<h3><?= $count_bahan_baku ?></h3>
								<p>Bahan Baku</p>
							</div>
							<div class="icon">
								<i class="ion ion-pie-graph"></i>
							</div>
							<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
						</div>
					</div>
				</div>

				<?php if ($this->session->userdata('role') == 1) { ?>
				<!-- Grafik -->
				<div class="row">
					<div class="col-md-6">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">Grafik Transaksi Bulanan</h3>
							</div>
							<div class="card-body">
								<canvas id="grafik-transaksi"></canvas>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">Jumlah Pesanan Berdasarkan Kategori Produk</h3>
							</div>
							<div class="card-body">
								<canvas id="grafik-kategori"></canvas>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>

			</div>
		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
	// Data untuk Grafik Pesanan Berdasarkan Kategori
	const labelsKategori = [
		<?php foreach ($grafik_kategori as $data): ?>
		'<?= $data->nama_kategori ?>',
		<?php endforeach; ?>
	];

	const dataKategori = {
		labels: labelsKategori,
		datasets: [{
			label: 'Jumlah Pesanan',
			data: [
				<?php foreach ($grafik_kategori as $data): ?>
				<?= $data->total_qty ?>,
				<?php endforeach; ?>
			],
			backgroundColor: [
				'rgba(255, 99, 132, 0.2)',
				'rgba(54, 162, 235, 0.2)',
				'rgba(255, 206, 86, 0.2)',
				'rgba(75, 192, 192, 0.2)',
				'rgba(153, 102, 255, 0.2)',
				'rgba(255, 159, 64, 0.2)'
			],
			borderColor: [
				'rgba(255, 99, 132, 1)',
				'rgba(54, 162, 235, 1)',
				'rgba(255, 206, 86, 1)',
				'rgba(75, 192, 192, 1)',
				'rgba(153, 102, 255, 1)',
				'rgba(255, 159, 64, 1)'
			],
			borderWidth: 1
		}]
	};

	const configKategori = {
		type: 'pie', // Menggunakan grafik pie untuk kategori
		data: dataKategori,
		options: {
			responsive: true,
			plugins: {
				legend: {
					position: 'top',
				},
				title: {
					display: true,
					text: 'Jumlah Pesanan Berdasarkan Kategori'
				}
			}
		}
	};

	// Render Grafik
	const ctxKategori = document.getElementById('grafik-kategori').getContext('2d');
	new Chart(ctxKategori, configKategori);
</script>



<script>
	// Data untuk Grafik
	const labels = [
		<?php foreach ($grafik_transaksi as $data): ?>
		'Bulan <?= $data->month ?>',
		<?php endforeach; ?>
	];

	const data = {
		labels: labels,
		datasets: [{
			label: 'Total Transaksi',
			data: [
				<?php foreach ($grafik_transaksi as $data): ?>
				<?= $data->total ?>,
				<?php endforeach; ?>
			],
			backgroundColor: 'rgba(54, 162, 235, 0.2)',
			borderColor: 'rgba(54, 162, 235, 1)',
			borderWidth: 1
		}]
	};

	const config = {
		type: 'bar',
		data: data,
		options: {
			scales: {
				y: {
					beginAtZero: true
				}
			}
		}
	};

	// Render Grafik
	const ctx = document.getElementById('grafik-transaksi').getContext('2d');
	new Chart(ctx, config);
</script>
<?php $this->load->view('templates/footer') ?>
