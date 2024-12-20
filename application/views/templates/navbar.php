<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
	<!-- Left navbar links -->
	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
		</li>
	</ul>

	<!-- Right navbar links -->
	<ul class="navbar-nav ml-auto">
		<li class="nav-item dropdown">
			<a class="nav-link" data-toggle="dropdown" href="#">
				<?= $this->session->userdata('username') ?>  <i class="far fa-user"></i>
			</a>
			<div class="dropdown-menu dropdown-menu-right">
				<a href="<?= base_url('logout')?>" class="dropdown-item">
					Logout
				</a>
			</div>
		</li>
	</ul>
</nav>
<!-- /.navbar -->
