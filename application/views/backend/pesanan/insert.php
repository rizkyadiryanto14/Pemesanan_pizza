<?php $this->load->view('templates/header') ?>
<?php $this->load->view('templates/navbar') ?>
<?php $this->load->view('templates/sidebar') ?>

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Detail Pesanan</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
						<li class="breadcrumb-item active">Detail Pesanan</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<section class="content">
		<div class="container-fluid">
			<?php if (!empty($detail_produk) && is_array($detail_produk)) { ?>
				<?php foreach ($detail_produk as $item) { ?>
					<form action="<?= base_url('user/transaksi') ?>" method="post" enctype="multipart/form-data">
						<div class="card mb-3" data-harga="<?= $item['harga'] ?>">
							<div class="row no-gutters">
								<div class="col-md-4">
									<img src="<?= base_url($item['gambar_produk']) ?>" class="card-img" alt="<?= $item['nama_produk'] ?>">
								</div>
								<div class="col-md-8">
									<div class="card-body">
										<h5 class="card-title"><?= $item['nama_produk'] ?></h5>
										<p class="card-text"><?= $item['keterangan_produk'] ?></p>
										<p class="card-text"><strong>Harga:</strong> Rp<?= number_format($item['harga'], 0, ',', '.') ?></p>
										<p class="card-text"><strong>Stok:</strong> <?= $item['stok'] ?></p>
										<p class="card-text"><small class="text-muted">Dibuat pada: <?= date('d M Y H:i:s', strtotime($item['created_at'])) ?></small></p>
										<div class="form-group">
											<label for="jumlah">Jumlah</label>
											<input type="hidden" name="id_produk" id="id_produk" value="<?= $item['id_produk'] ?>">
											<input type="text" name="jumlah" class="form-control jumlah" oninput="hitungTotal(this)" required>
										</div>
										<div class="form-group">
											<label for="total_harga">Total Harga</label>
											<input type="text" name="total_harga" class="form-control total_harga" readonly>
										</div>
										<div class="form-group">
											<label for="bukti_bayar">Bukti Bayar</label>
											<input type="file" name="bukti_bayar" id="bukti_bayar" class="form-control">
										</div>
									</div>
								</div>
							</div>
							<div class="card-footer">
								<button class="btn btn-primary" type="submit">Pesan Sekarang</button>
							</div>
						</div>
					</form>
				<?php } ?>
			<?php } else { ?>
				<p>Tidak ada detail produk yang tersedia.</p>
			<?php } ?>
		</div>
	</section>
</div>

<script>
	function hitungTotal(elem) {
		var card = elem.closest('.card');
		var harga = parseFloat(card.getAttribute('data-harga'));
		var jumlah = parseInt(elem.value) || 0;
		var totalHarga = harga * jumlah;
		card.querySelector('.total_harga').value = totalHarga.toFixed();
	}
</script>

<?php $this->load->view('templates/footer') ?>
