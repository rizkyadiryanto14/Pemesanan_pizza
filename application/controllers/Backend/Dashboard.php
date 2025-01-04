<?php

/**
 * @property $Dashboard_model
 */
class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Dashboard_model');
	}

	/**
	 * @return void
	 */
	public function index():void
	{
		$data['count_produk'] = $this->Dashboard_model->count_produk();
		$data['count_kategori'] = $this->Dashboard_model->count_kategori();
		$data['count_users'] = $this->Dashboard_model->count_users();
		$data['count_bahan_baku'] = $this->Dashboard_model->count_bahan_baku();
		$data['grafik_transaksi'] = $this->Dashboard_model->get_transaksi_data();
		$data['grafik_kategori'] = $this->Dashboard_model->get_pesanan_by_kategori();
		$this->load->view('backend/dashboard', $data);
	}
}
