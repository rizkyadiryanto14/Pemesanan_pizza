<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/navbar'); ?>
<?php $this->load->view('templates/sidebar'); ?>

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Daftar Kategori Produk</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
						<li class="breadcrumb-item active">Daftar Kategori Produk</li>
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
					<button class="btn btn-primary" data-toggle="modal" data-target=".tambah-data">
						<i class="fas fa-plus"></i>
						Tambah Kategori Produk
					</button>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table id="kategori_produk" class="table table-bordered">
							<thead>
							<tr>
								<th>No</th>
								<th>Nama</th>
								<th>Keterangan</th>
								<th>Waktu</th>
								<th>Action</th>
							</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<div class="modal fade tambah-data">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">
					Form Tambah Kategori Produk
				</h3>
			</div>
			<form action="<?= base_url('admin/store_kategori') ?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<label for="nama_kategori">Nama Kategori</label>
						<input type="text" name="nama_kategori" id="nama_kategori" class="form-control">
					</div>
					<div class="form-group">
						<label for="keterangan">Keterangan</label>
						<input type="text" name="keterangan" id="keterangan" class="form-control">
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button class="btn btn-primary" type="submit">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Kategori Produk</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('admin/update_kategori') ?>" method="post">
				<div class="modal-body">
					<input type="hidden" name="id_kategori" id="edit-id-kategori">
					<div class="form-group">
						<label for="edit-nama-kategori">Nama Kategori</label>
						<input type="text" name="nama_kategori" id="edit-nama-kategori" class="form-control">
					</div>
					<div class="form-group">
						<label for="edit-keterangan">Keterangan</label>
						<input type="text" name="keterangan" id="edit-keterangan" class="form-control">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Update</button>
				</div>
			</form>
		</div>
	</div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

<script>
	$(document).on('click', '.update', function () {
		var id_kategori = $(this).data('id');

		$.ajax({
			url: "<?php echo site_url('admin/get_kategori_by_id'); ?>",
			type: "POST",
			data: {id_kategori: id_kategori},
			dataType: "json",
			success: function (data) {
				// Populate modal fields
				$('#edit-id-kategori').val(data.id_kategori);
				$('#edit-nama-kategori').val(data.nama_kategori);
				$('#edit-keterangan').val(data.keterangan);
			}
		});
	})

	$(document).ready(function () {
		var dataTable = $('#kategori_produk').DataTable({
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				url: "<?php echo site_url('admin/get_data_kategori'); ?>",
				type: "POST"
			},
			"columnDefs": [{
				"targets": [0, 1, 2, 3, 4],
				"orderable": false,
			}],
		});
	});
</script>
<?php $this->load->view('templates/footer'); ?>

