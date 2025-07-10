<?php

/**
 * @property $Produk_model
 * @property $BahanBaku_model
 * @property $Kategori_model
 * @property $upload
 * @property $load
 * @property $input
 */

class Produk extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Produk_model');
		$this->load->model('BahanBaku_model');
		$this->load->model('Kategori_model');
	}

	/**
	 * @return void
	 */
	public function index():void
	{
		$this->load->view('backend/produk/list');
	}

	/**
	 * @return void
	 */
	public function insert():void
	{
		$data['bahan_baku']	= $this->Produk_model->listing_bahan_baku();
		$data['kategori']	= $this->Kategori_model->get();
		$this->load->view('backend/produk/tambah_produk', $data);
	}

	/**
	 * @return void
	 */
	public function store():void
	{

		$config['upload_path'] = './uploads/produk/';
		$config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx|xls|xlsx|txt';
		$config['max_size'] = 8192;
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('gambar_produk')) {
			$this->session->set_flashdata('error', 'Gagal mengunggah file: ' . $this->upload->display_errors('', ''));
			redirect(base_url('admin/list_produk'));
			return;
		}

		$fileData = $this->upload->data();
		$filePath = 'uploads/produk/' . $fileData['file_name'];

		$data = [
			'nama_produk' => $this->input->post('nama_produk'),
			'keterangan_produk' => $this->input->post('keterangan_produk'),
			'id_bahan_baku'	=> $this->input->post('id_bahan_baku'),
			'id_kategori_produk'	=> $this->input->post('id_kategori'),
			'stok'=> $this->input->post('stok'),
			'gambar_produk' => $filePath,
			'harga' => $this->input->post('harga'),
		];

		$operasi = $this->Produk_model->listing_bahan_baku_id($this->input->post('id_bahan_baku'));

		if ($operasi['stok_bahan'] <= 0) {
			$this->session->set_flashdata('error', 'Stok bahan baku tidak cukup');
			redirect(base_url('admin/list_produk'));
		}else {
			$stok_bahan = $operasi['stok_bahan'] - 1;
			$data_bahan = [
				'stok_bahan' => $stok_bahan
			];
			$this->BahanBaku_model->update_data($data['id_bahan_baku'], $data_bahan);
		}

		$insert = $this->Produk_model->insert($data);

		if ($insert) {
			$this->session->set_flashdata('success', 'Data berhasil ditambahkan');
		}else {
			$this->session->set_flashdata('error', 'Data gagal ditambahkan');
		}
		redirect(base_url('admin/list_produk'));
	}

	/**
	 * @param int $id ID Produk yang akan diupdate
	 * @return void
	 */
	public function update(int $id): void
	{
		$old_product = $this->Produk_model->getOneById($id);
		if (!$old_product) {
			$this->session->set_flashdata('error', 'Data produk tidak ditemukan.');
			redirect(base_url('admin/list_produk'));
			return;
		}

		$data = [
			'nama_produk' => $this->input->post('nama_produk'),
			'keterangan_produk' => $this->input->post('keterangan_produk'),
			'id_bahan_baku'    => $this->input->post('id_bahan_baku'),
			'id_kategori_produk'   => $this->input->post('id_kategori'),
			'stok'=> $this->input->post('stok'),
			'harga' => $this->input->post('harga'),
		];

		if (!empty($_FILES['gambar_produk']['name'])) {
			$config['upload_path']   = './uploads/produk/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['max_size']      = 8192;
			$config['encrypt_name']  = TRUE;

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('gambar_produk')) {
				if (file_exists($old_product['gambar_produk'])) {
					unlink($old_product['gambar_produk']);
				}

				$fileData = $this->upload->data();
				$data['gambar_produk'] = 'uploads/produk/' . $fileData['file_name'];
			} else {
				$this->session->set_flashdata('error', 'Gagal mengunggah file: ' . $this->upload->display_errors('', ''));
				redirect(base_url('admin/produk/edit/' . $id));
				return;
			}
		}

		$new_bahan_id = $this->input->post('id_bahan_baku');
		$old_bahan_id = $old_product['id_bahan_baku'];

		if ($new_bahan_id != $old_bahan_id) {
			$bahan_lama = $this->Produk_model->listing_bahan_baku_id($old_bahan_id);
			$stok_bahan_lama = $bahan_lama['stok_bahan'] + 1;
			$this->BahanBaku_model->update_data($old_bahan_id, ['stok_bahan' => $stok_bahan_lama]);

			$bahan_baru = $this->Produk_model->listing_bahan_baku_id($new_bahan_id);
			if ($bahan_baru['stok_bahan'] <= 0) {
				$this->session->set_flashdata('error', 'Stok bahan baku baru tidak cukup.');
				redirect(base_url('admin/produk/edit/' . $id));
				return;
			}
			$stok_bahan_baru = $bahan_baru['stok_bahan'] - 1;
			$this->BahanBaku_model->update_data($new_bahan_id, ['stok_bahan' => $stok_bahan_baru]);
		}

		$update = $this->Produk_model->update($id, $data);

		if ($update) {
			$this->session->set_flashdata('success', 'Data berhasil diupdate');
		} else {
			$this->session->set_flashdata('error', 'Data gagal diupdate');
		}
		redirect(base_url('admin/list_produk'));
	}


	public function edit($id)
	{
		$data['bahan_baku']	= $this->Produk_model->listing_bahan_baku();
		$data['kategori']	= $this->Kategori_model->get();
		$data['data_produk'] = $this->Produk_model->getOneById($id);
		$this->load->view('backend/produk/edit_produk', $data);
	}

	public function get_data_produk(): void
	{
		$fetch_data = $this->Produk_model->make_datatables();
		if (is_array($fetch_data)) {
			$data = array();
			$no = 1;
			foreach ($fetch_data as $row) {
				$sub_array = array();
				$sub_array[] = $no++;
				$sub_array[] = $row->nama_produk;
				$sub_array[] = $row->nama_kategori;
				$sub_array[] = $row->nama_bahan;
				$sub_array[] = $row->stok;
				$sub_array[] = '<a href="' . site_url('#' . $row->id_produk) . '" class="btn btn-info btn-xs update">
                   <img src="' . base_url($row->gambar_produk) . '" alt="Edit" style="width:70px; height:70px;">
                </a>';
				$sub_array[] = $row->harga;
				$sub_array[] = $row->keterangan_produk;
				$sub_array[] = longdate_indo($row->created_at);
				$sub_array[] = '<a href="' . site_url('admin/edit_produk/' . $row->id_produk) . '" class="btn btn-info btn-xs update"><i class="fa fa-edit"></i></a>
                     <a href="' . site_url('admin/delete_produk/' . $row->id_produk) . '" onclick="return confirm(\'Apakah anda yakin?\')" class="btn btn-danger btn-xs delete"><i class="fa fa-trash"></i></a>';
				$data[] = $sub_array;
			}

			$output = array(
				"draw" => intval($_POST["draw"]),
				"recordsTotal" => $this->Produk_model->get_all_data(),
				"recordsFiltered" => $this->Produk_model->get_filtered_data(),
				"data" => $data
			);
			echo json_encode($output);
		} else {
			echo "Error: Fetch data is not an array.";
		}
	}


	public function delete($id)
	{
		$delete = $this->Produk_model->delete_data($id);

		if ($delete) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
		}else {
			$this->session->set_flashdata('error', 'Data gagal dihapus');
		}
		redirect(base_url('admin/list_produk'));
	}
}
