<?php

/**
 * @property $input
 * @property $Kategori_model
 */

class Kategori_produk extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Kategori_model');
	}

	/**
	 * @return void
	 */
	public function index():void
	{
		$this->load->view('backend/kategori_produk/list');
	}

	/**
	 * @return void
	 */
	public function insert():void
	{
		$data = [
			'nama_kategori' => $this->input->post('nama_kategori'),
			'keterangan' => $this->input->post('keterangan')
		];

		$insert_kategori = $this->Kategori_model->insert($data);

		if($insert_kategori){
			$this->session->set_flashdata('success', 'Data berhasil ditambahkan');
		}else {
			$this->session->set_flashdata('error', 'Data gagal ditambahkan');
		}
		redirect(base_url('admin/list_kategori'));
	}

	/**
	 * @return void
	 */
	public function get_data_kategori(): void
	{
		$fetch_data = $this->Kategori_model->make_datatables();
		if (is_array($fetch_data)) {
			$data = array();
			$no = 1;
			foreach ($fetch_data as $row) {
				$sub_array = array();
				$sub_array[] = $no++;
				$sub_array[] = $row->nama_kategori;
				$sub_array[] = $row->keterangan;
				$sub_array[] = longdate_indo($row->created_at);
				$sub_array[] = '<a href="' . site_url('#' . $row->id_kategori) . '" class="btn btn-info btn-xs update"><i class="fa fa-edit"></i></a>
                     <a href="' . site_url('#' . $row->id_kategori) . '" onclick="return confirm(\'Apakah anda yakin?\')" class="btn btn-danger btn-xs delete"><i class="fa fa-trash"></i></a>';
				$data[] = $sub_array;
			}

			$output = array(
				"draw" => intval($_POST["draw"]),
				"recordsTotal" => $this->Kategori_model->get_all_data(),
				"recordsFiltered" => $this->Kategori_model->get_filtered_data(),
				"data" => $data
			);
			echo json_encode($output);
		} else {
			echo "Error: Fetch data is not an array.";
		}
	}
}
