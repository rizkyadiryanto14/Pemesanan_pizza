<?php

/**
 * @property $BahanBaku_model
 */

class BahanBaku extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('BahanBaku_model');
	}

	/**
	 * @return void
	 */
	public function index():void
	{
		$this->load->view('backend/bahan_baku/list');
	}

	/**
	 * @return void
	 */
	public function store():void
	{
		$data = [
			'nama_bahan' => $this->input->post('nama_bahan'),
			'stok_bahan' => $this->input->post('stok_bahan'),
			'keterangan' => $this->input->post('keterangan')
		];

		$insert = $this->BahanBaku_model->insert($data);
		if($insert){
			$this->session->set_flashdata('success', 'Data berhasil ditambahkan');
		}else {
			$this->session->set_flashdata('error', 'Data gagal ditambahkan');
		}
		redirect(base_url('admin/list_bahan'));
	}

	/**
	 * @return void
	 */
	public function get_data_bahanbaku(): void
	{
		$fetch_data = $this->BahanBaku_model->make_datatables();
		if (is_array($fetch_data)) {
			$data = array();
			$no = 1;
			foreach ($fetch_data as $row) {
				$sub_array = array();
				$sub_array[] = $no++;
				$sub_array[] = $row->nama_bahan;
				$sub_array[] = $row->stok_bahan;
				$sub_array[] = $row->keterangan;
				$sub_array[] = longdate_indo($row->created_at);
				$sub_array[] = '<a href="' . site_url('#' . $row->id_bahan_baku) . '" class="btn btn-info btn-xs update"><i class="fa fa-edit"></i></a>
                     <a href="' . site_url('#' . $row->id_bahan_baku) . '" onclick="return confirm(\'Apakah anda yakin?\')" class="btn btn-danger btn-xs delete"><i class="fa fa-trash"></i></a>';
				$data[] = $sub_array;
			}

			$output = array(
				"draw" => intval($_POST["draw"]),
				"recordsTotal" => $this->BahanBaku_model->get_all_data(),
				"recordsFiltered" => $this->BahanBaku_model->get_filtered_data(),
				"data" => $data
			);
			echo json_encode($output);
		} else {
			echo "Error: Fetch data is not an array.";
		}
	}

	/**
	 * @param $id_bahan_baku
	 *
	 * @return void
	 */
	public function delete($id_bahan_baku):void
	{
		if ($id_bahan_baku){
			$delete = $this->BahanBaku_model->delete($id_bahan_baku);
			if ($delete){
				$this->session->set_flashdata('success', 'Data berhasil dihapus');
			}else {
				$this->session->set_flashdata('error', 'Data gagal dihapus');
			}
			redirect(base_url('admin/list_bahan'));
		}else{
			$this->session->set_flashdata('error', 'Data gagal dihapus');
		}
		redirect(base_url('admin/list_bahan'));
	}
}
