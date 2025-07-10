<?php

/**
 * @property $Produk_model
 */

class Pesanan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Produk_model');
	}

	/**
	 * @return void
	 */
	public function index():void
	{
		$data['produk']	= $this->Produk_model->get();
		$this->load->view('backend/pesanan/list', $data);
	}


	/**
	 * @param $id_produk
	 *
	 * @return void
	 */
	public function insert($id_produk):void
	{
		$data['detail_produk']	= $this->Produk_model->getById($id_produk);
		$this->load->view('backend/pesanan/insert', $data);
	}
}
