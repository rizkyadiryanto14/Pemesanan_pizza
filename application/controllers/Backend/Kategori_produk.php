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
	 * @param $id_kategori
	 *
	 * @return void
	 */
	public function update(): void
	{
		$this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

		if (!$this->form_validation->run()) {
			$this->session->set_flashdata('error', strip_tags(validation_errors()));
		}else {
			$id_kategori = $this->input->post('id_kategori');

			$data = [
				'nama_kategori' => $this->input->post('nama_kategori'),
				'keterangan' => $this->input->post('keterangan')
			];

			$update_kategori = $this->Kategori_model->update($id_kategori, $data);

			if ($update_kategori) {
				$this->session->set_flashdata('success', 'Data berhasil diupdate');
			}else {
				$this->session->set_flashdata('error', 'Data gagal diupdate');
			}
			redirect(base_url('admin/list_kategori'));
		}
	}

	/**
	 * @return void
	 */
	public function get_kategori_by_id():void
	{
		$id_kategori = $this->input->post('id_kategori');
		$kategori = $this->Kategori_model->get_kategori_by_id($id_kategori);
		echo json_encode($kategori);
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
				$sub_array[] = '<button type="button" data-id="' . $row->id_kategori . '" class="btn btn-info btn-xs update" data-toggle="modal" data-target="#edit-modal">
                    <i class="fa fa-edit"></i>
                </button>
                     <a href="' . site_url('admin/delete_kategori/' . $row->id_kategori) . '" onclick="return confirm(\'Apakah anda yakin?\')" class="btn btn-danger btn-xs delete"><i class="fa fa-trash"></i></a>';
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

	/**
	 * @param $id_kategori
	 *
	 * @return void
	 */
	public function delete($id_kategori):void
	{
		if ($id_kategori){
			$delete = $this->Kategori_model->delete($id_kategori);
			if ($delete){
				$this->session->set_flashdata('success', 'Data berhasil dihapus');
			}else{
				$this->session->set_flashdata('error', 'Data gagal dihapus');
			}
			redirect(base_url('admin/list_kategori'));
		}else {
			$this->session->set_flashdata('error', 'Data gagal dihapus');
		}
		redirect(base_url('admin/list_kategori'));
	}
}
