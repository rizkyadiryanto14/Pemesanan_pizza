<?php $this->load->view('templates/header') ?>
<?php $this->load->view('templates/navbar') ?>
<?php $this->load->view('templates/sidebar') ?>


<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Edit Produk</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
						<li class="breadcrumb-item active">Edit Produk</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<section class="content">
		<div class="container-fluid">
			<div class="card">
				<div class="card-header">
					<a href="<?= base_url('admin/list_produk') ?>" class="btn btn-warning">
						<i class="fas fa-arrow-left"></i>
						Kembali
					</a>
				</div>
				<form action="<?= base_url('admin/update_produk/'. $data_produk['id_produk']) ?>" method="post" enctype="multipart/form-data">
					<div class="card-body">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="nama_produk">Nama Produk</label>
									<input type="text" name="nama_produk" id="nama_produk" class="form-control" value="<?= $data_produk['nama_produk'] ?? '' ?>">
								</div>
								<div class="form-group">
									<label for="id_bahan_baku">Bahan Baku</label>
									<select name="id_bahan_baku" id="id_bahan_baku" class="form-control" required>
										<?php foreach ($bahan_baku as $item) {
											$selected = ($item->id_bahan_baku == $data_produk->id_bahan_baku) ? 'selected' : ''; ?>
											<option value="<?= $item->id_bahan_baku ?>" <?= $selected ?>>
												<?= $item->nama_bahan ?> | Stok: <?= $item->stok_bahan ?>
											</option>
										<?php } ?>
									</select>
								</div>
								<div class="from-group">
									<label for="id_kategori">Kategori</label>
									<select name="id_kategori" id="id_kategori" class="form-control" required>
										<?php foreach ($kategori as $item) {
											$selected= ($item->id_kategori == $data_produk->id_kategori) ? 'selected' : ''; ?>
											<option value="<?= $item->id_kategori ?>"><?= $selected?>
											<?= $item->nama_kategori ?>
											</option>
										<?php }  ?>
									</select>
								</div>
								<div class="form-group">
									<label for="stok">Stok</label>
									<input type="number" name="stok" id="stok" class="form-control" required value="<?= $data_produk['stok'] ?? '' ?>">
								</div>
								<div class="form-group">
									<label for="harga">Harga</label>
									<input type="number" name="harga" id="harga" class="form-control" required value="<?= $data_produk['harga'] ?? '' ?>">
								</div>
								<div class="form-group">
									<label for="keterangan_produk">Keterangan Produk</label>
									<input type="text" name="keterangan_produk" id="keterangan_produk" class="form-control" required value="<?= $data_produk['keterangan_produk'] ?? '' ?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="gambar_produk">Gambar</label>
									<input type="file" name="gambar_produk" id="gambar_produk" class="form-control">
								</div>
								<?php if (!empty($data_produk['gambar_produk'])) : ?>
									<div class="form-group">
										<label>Gambar Saat Ini</label>
										<div>
											<img src="<?= base_url($data_produk['gambar_produk']); ?>" alt="Gambar Produk" style="max-width: 200px; height: auto;">
										</div>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<div class="card-footer">
						<a href="<?= base_url('admin/list_produk') ?>" class="btn btn-secondary">Kembali</a>
						<button class="btn btn-primary" type="submit">Update</button>
					</div>
				</form>
			</div>
		</div>
	</section>
</div>
