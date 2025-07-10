<?php $this->load->view('templates/header') ?>
<?php $this->load->view('templates/navbar') ?>
<?php $this->load->view('templates/sidebar') ?>

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Daftar Transaksi</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
						<li class="breadcrumb-item active">Daftar Transaksi</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Daftar Transaksi</h3>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table id="transaksi" class="table table-bordered">
									<thead>
									<tr>
										<th>No</th>
										<th>Produk</th>
										<th>Harga Satuan</th>
										<th>Jumlah</th>
										<th>Total Harga</th>
										<th>Bukti Transaksi</th>
										<th>Status</th>
										<th>Status Pesanan</th>
										<th>Review/Ulasan</th>
										<th>Waktu Transaksi</th>
										<?php if ($this->session->userdata('role') == 1) { ?>
										<th>Action</th>
										<?php } ?>
									</tr>
									</thead>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<!-- Modal untuk Ulasan -->
<div class="modal fade" id="modal-review" tabindex="-1" role="dialog" aria-labelledby="modal-review-label" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-review-label">Beri Ulasan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form-review">
				<div class="modal-body">
					<input type="hidden" name="id_transaksi" id="id-transaksi-review">
					<input type="hidden" name="id_produk" id="id-produk-review">
					<div class="form-group">
						<label for="review-text">Ulasan</label>
						<textarea name="review" id="review-text" class="form-control" required></textarea>
					</div>
					<div class="form-group">
						<label for="rating">Rating</label>
						<select name="rating" id="rating" class="form-control" required>
							<option value="1">1 - Sangat Buruk</option>
							<option value="2">2 - Buruk</option>
							<option value="3">3 - Cukup</option>
							<option value="4">4 - Baik</option>
							<option value="5">5 - Sangat Baik</option>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="submit" class="btn btn-primary">Kirim</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal untuk Menampilkan Ulasan -->
<div class="modal fade" id="modal-reviews" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Ulasan Produk</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="modal-reviews-content"></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
	$(document).ready(function() {
		// Initialize DataTables
		var dataTable = $('#transaksi').DataTable({
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				url: "<?php echo site_url('user/get_data_transaksi'); ?>",
				type: "POST"
			},
			"columnDefs": [{
				"targets": [0, 1, 2, 3, 4],
				"orderable": false,
			}],
			"createdRow": function(row, data, dataIndex) {
				// Check if status_pesanan is "Dalam Proses Pengantaran" or "Selesai"
				if (data[7] === "Dalam Proses Pengantaran") {
					$('td', row).eq(9).html('<button class="btn btn-success btn-xs btn-review" data-id-transaksi="' + data[0] + '" data-id-produk="' + data[1] + '">Beri Ulasan</button>');
				} else if (data[7] === "Selesai") {
					$('td', row).eq(9).html('<button class="btn btn-info btn-xs btn-view-review" data-id-transaksi="' + data[0] + '">Lihat Ulasan</button>');
				}
			}
		});

		// Open Review Modal
		$(document).on('click', '.btn-review', function() {
			var idTransaksi = $(this).data('id-transaksi');
			var idProduk = $(this).data('id-produk');

			$('#id-transaksi-review').val(idTransaksi);
			$('#id-produk-review').val(idProduk);
			$('#modal-review').modal('show');
		});

		// Submit Review
		$('#form-review').on('submit', function(e) {
			e.preventDefault();

			$.ajax({
				url: "<?php echo site_url('user/submit_review'); ?>",
				type: "POST",
				data: $(this).serialize(),
				success: function(response) {
					$('#modal-review').modal('hide');
					alert('Ulasan berhasil dikirim!');
					dataTable.ajax.reload();
				},
				error: function() {
					alert('Gagal mengirim ulasan.');
				}
			});
		});

		// Open View Reviews Modal
		$(document).on('click', '.btn-view-review', function() {
			var idTransaksi = $(this).data('id-transaksi');

			$.ajax({
				url: "<?php echo site_url('admin/get_reviews'); ?>",
				type: "POST",
				data: { id_transaksi: idTransaksi },
				success: function(response) {
					var reviews = JSON.parse(response);
					var html = '';
					reviews.forEach(function(review) {
						html += '<p><strong>' + review.username + ':</strong> ' + review.review + ' (' + review.rating + ' bintang)</p>';
					});

					$('#modal-reviews-content').html(html);
					$('#modal-reviews').modal('show');
				}
			});
		});
	});
</script>
<?php $this->load->view('templates/footer') ?>
