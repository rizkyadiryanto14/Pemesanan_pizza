<?php $this->load->view('templates/header') ?>
<?php $this->load->view('templates/navbar') ?>
<?php $this->load->view('templates/sidebar') ?>

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Tambah Produk</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
						<li class="breadcrumb-item active">Tambah Produk</li>
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
				<form action="<?= base_url('admin/store_produk') ?>" method="post" enctype="multipart/form-data">
					<div class="card-body">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="nama_produk">Nama Produk</label>
									<input type="text" name="nama_produk" id="nama_produk" class="form-control" required>
								</div>
								<div class="form-group">
									<label for="id_bahan_baku">Bahan Baku</label>
									<select name="id_bahan_baku" id="id_bahan_baku" class="form-control" required>
										<option selected disabled>Pilih Bahan Baku</option>
										<?php foreach ($bahan_baku as $item) { ?>
										<option value="<?= $item->id_bahan_baku ?>"><?= $item->nama_bahan ?> | <?= $item->stok_bahan ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="form-group">
									<label for="id_kategori">Kategori</label>
									<select name="id_kategori" id="id_kategori" class="form-control" required>
										<option selected disabled>Pilih Kategori</option>
										<?php foreach ($kategori as $item) { ?>
											<option value="<?= $item->id_kategori ?>"><?= $item->nama_kategori ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="form-group">
									<label for="stok">Stok</label>
									<input type="number" name="stok" id="stok" class="form-control" required>
								</div>
								<div class="form-group">
									<label for="harga">Harga</label>
									<input type="number" name="harga" id="harga" class="form-control" required>
								</div>
								<div class="form-group">
									<label for="keterangan_produk">Keterangan Produk</label>
									<input type="text" name="keterangan_produk" id="keterangan_produk" class="form-control" required>
								</div>
							</div>
							<div class="col-md-">
								<div class="form-group">
									<label for="gambar_produk">Gambar</label>
									<input type="file" name="gambar_produk" id="gambar_produk" class="form-control" required>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer">
						<a href="<?= base_url('admin/list_produk') ?>" class="btn btn-secondary">Kembali</a>
						<button class="btn btn-primary" type="submit">Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</section>
</div>

<?php $this->load->view('templates/footer') ?>
