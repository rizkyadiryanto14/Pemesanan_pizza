<?php

/**
 * @property $Produk_model
 */

class Home extends CI_Controller
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
		$data['produk'] = $this->Produk_model->get();
		$this->load->view('frontend/home', $data);
	}

	/**
	 * @return void
	 */
	public function contact():void
	{
		$this->load->view('frontend/contact');
	}
}
