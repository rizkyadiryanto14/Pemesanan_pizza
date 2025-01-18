<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="<?= base_url() ?>" class="brand-link">
		<img src="<?= base_url() ?>assets/images/pizza_chita.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
		<span class="brand-text font-weight-light">Pizza Chita</span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel (optional) -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<img src="<?= base_url() ?>assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
			</div>
			<div class="info">
				<a href="#" class="d-block"><?= $this->session->userdata('username') ?></a>
			</div>
		</div>

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<?php if ($this->session->userdata('role') == '1') { ?>
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<li class="nav-item">
					<a href="<?= base_url('dashboard') ?>" class="nav-link">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							Dashboard
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link ">
						<i class="nav-icon fas fa-home"></i>
						<p>
							Master Data
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?= base_url('admin/list_produk') ?>" class="nav-link">
								<i class="fas fa-cutlery nav-icon"></i>
								<p>Produk</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('admin/list_kategori') ?>" class="nav-link">
								<i class="fas fa-adversal nav-icon"></i>
								<p>Kategori Produk</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('admin/list_bahan') ?>" class="nav-link">
								<i class="fas fa-file-video-o nav-icon"></i>
								<p>Bahan Baku</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('admin/list_transaksi') ?>" class="nav-link">
						<i class="nav-icon fas fa-cog nav-icon"></i>
						<p>
							Transaksi
						</p>
					</a>
				</li>
			</ul>
			<?php }elseif ($this->session->userdata('role') == '2') { ?>
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<li class="nav-item">
					<a href="<?= base_url('dashboard') ?>" class="nav-link">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							Dashboard
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('user/pesanan') ?>" class="nav-link">
						<i class="fas fa-table nav-icon"></i>
						<p>Pesan Sekarang</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('user/list_transaksi') ?>" class="nav-link">
						<i class="fas fa-table nav-icon"></i>
						<p>Transaksi</p>
					</a>
				</li>
			</ul>
			<?php } else { ?>
				Anda Tidak Memiliki Akses
			<?php } ?>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>
