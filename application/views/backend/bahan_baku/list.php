<?php $this->load->view('templates/header') ?>
<?php $this->load->view('templates/navbar') ?>
<?php $this->load->view('templates/sidebar') ?>

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Daftar Bahan Baku</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
						<li class="breadcrumb-item active">Daftar Bahan Baku</li>
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
					<button class="btn btn-primary" data-toggle="modal" data-target=".tambah-bahan">
						Tambah Bahan Baku
					</button>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table id="bahanbaku" class="table table-bordered">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama bahan</th>
									<th>Stok Bahan</th>
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


<div class="modal fade tambah-bahan">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="modal-title">
					<h3>Form Tambah Bahan Baku</h3>
				</div>
			</div>
			<form action="<?= base_url('admin/tambah_bahan_baku') ?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<label for="nama_bahan">Nama Bahan</label>
						<input type="text" name="nama_bahan" id="nama_bahan" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="stok_bahan">Stok Bahan</label>
						<input type="text" name="stok_bahan" id="stok_bahan" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="keterangan">Keterangan</label>
						<input type="text" name="keterangan" id="keterangan" class="form-control" required>
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
			<form action="<?= base_url('admin/update_bahan') ?>" method="post">
				<div class="modal-body">
					<input type="hidden" name="id_bahan_baku" id="edit-id-bahan_baku">
					<div class="form-group">
						<label for="edit-nama-bahan">Nama Bahan</label>
						<input type="text" name="nama_bahan" id="edit-nama-bahan" class="form-control">
					</div>
					<div class="form-group">
						<label for="edit-stok-bahan">Stok Bahan</label>
						<input type="text" name="stok_bahan" id="edit-stok-bahan" class="form-control">
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

	$(document).on('click', '.update-bahan', function () {
		var id_bahan_baku = $(this).data('id');

		$.ajax({
			url: "<?php echo site_url('admin/get_bahan_by_id'); ?>",
			type: "POST",
			data: {id_bahan_baku: id_bahan_baku},
			dataType: "json",
			success: function (data) {
				// Populate modal fields
				$('#edit-id-bahan_baku').val(data.id_bahan_baku);
				$('#edit-nama-bahan').val(data.nama_bahan);
				$('#edit-stok-bahan').val(data.stok_bahan);
				$('#edit-keterangan').val(data.keterangan);
			}
		});
	})

	$(document).ready(function () {
		var dataTable = $('#bahanbaku').DataTable({
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				url: "<?php echo site_url('admin/get_data_bahanbaku'); ?>",
				type: "POST"
			},
			"columnDefs": [{
				"targets": [0, 1, 2, 3, 4],
				"orderable": false,
			}],
		});
	});
</script>
<?php $this->load->view('templates/footer') ?>
