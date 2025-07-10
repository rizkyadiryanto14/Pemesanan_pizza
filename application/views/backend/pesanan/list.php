<?php $this->load->view('templates/header') ?>
<?php $this->load->view('templates/navbar') ?>
<?php $this->load->view('templates/sidebar') ?>

<style>
	.card-img-container {
		height: 200px;
		overflow: hidden;
		display: flex;
		justify-content: center;
		align-items: center;
		background-color: #f8f9fa;
	}

	.card-img-top {
		height: 100%;
		width: auto;
		object-fit: cover;
	}

</style>

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Daftar Produk</h1>
				</div>
				<!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
						<li class="breadcrumb-item active">Daftar Produk</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<?php if (!empty($produk)) {
					foreach ($produk as $item) { ?>
						<div class="col-md-4 col-sm-6 mb-4 d-flex align-items-stretch">
							<div class="card" style="width: 100%;">
								<div class="card-img-container">
									<img src="<?= base_url($item->gambar_produk) ?>" class="card-img-top" alt="...">
								</div>
								<div class="card-body">
									<h5 class="card-title"><?= $item->nama_produk ?> | Rp. <?= number_format($item->harga) ?></h5>
									<p class="card-text"><?= $item->keterangan_produk ?></p>
									<a href="<?= base_url('user/pesan_sekarang/' . $item->id_produk) ?>" class="btn btn-primary">Pesan Sekarang</a>
								</div>
							</div>
						</div>
					<?php }
				} else { ?>
					<p>Tidak ada detail produk yang tersedia.</p>
				<?php } ?>
			</div>
		</div>
	</section>
</div>

<?php $this->load->view('templates/footer') ?>
