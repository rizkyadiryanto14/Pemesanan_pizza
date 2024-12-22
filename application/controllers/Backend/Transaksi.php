<?php

/**
 * @property $Transaksi_model
 * @property $Produk_model
 * @property $upload
 */

class Transaksi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Transaksi_model');
		$this->load->model('Produk_model');
	}

	/**
	 * @return void
	 */
	public function index():void
	{
		$this->load->view('backend/transaksi/list');
	}

	/**
	 * @return void
	 */
	public function insert():void
	{
		$config['upload_path'] = './uploads/bukti_bayar/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = 2048;
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('bukti_bayar')) {
			$this->session->set_flashdata('error', 'gagal mengunggah file : ' . $this->upload->display_errors('', ''));
			redirect(base_url('user/pesanan'));
		}

		$fileData = $this->upload->data();
		$filePath = 'uploads/bukti_bayar/' . $fileData['file_name'];

		$data = [
			'id_produk'			=> $this->input->post('id_produk'),
			'qty'				=> $this->input->post('jumlah'),
			'total_harga'		=> $this->input->post('total_harga'),
			'bukti_transaksi'	=> $filePath,
			'status'			=> 3
		];

		$jumlah = $this->input->post('jumlah');
		$stok_produk = $this->Produk_model->getOneById($this->input->post('id_produk'));
		$stok = $stok_produk['stok'] - $jumlah;

		$data_stok = [
			'stok' => $stok
		];

		$this->Produk_model->update($this->input->post('id_produk'), $data_stok);

		$insert = $this->Transaksi_model->insert($data);

		if ($insert) {
			$this->session->set_flashdata('success', 'Data berhasil ditambahkan');
		}else {
			$this->session->set_flashdata('error', 'Data gagal ditambahkan');
		}
		redirect(base_url('user/pesanan'));
	}

	public function get_data_transaksi(): void
	{
		$fetch_data = $this->Transaksi_model->make_datatables();
		if (is_array($fetch_data)) {
			$data = array();
			$no = 1;
			foreach ($fetch_data as $row) {
				$sub_array = array();
				$sub_array[] = $no++;
				$sub_array[] = $row->nama_produk;
				$sub_array[] ='Rp.'. number_format($row->harga_produk);
				$sub_array[] = $row->qty;
				$sub_array[] = 'Rp.' . number_format($row->total_harga);
				$sub_array[] = '<a href="' . site_url($row->bukti_transaksi) . '" class="btn btn-info btn-xs update">Lihat File</a>';
				if ($this->session->userdata('role') == 2) {
					if ($row->status == 3) {
						$sub_array[] = '<span class="btn btn-danger btn-xs delete">Belum Diverifikasi</span>';
					}elseif ($row->status == 2) {
						$sub_array[] = '<span class="btn btn-warning btn-xs update">Sedang Ditinjau</span>';
					}elseif ($row->status == 1) {
						$sub_array[] = '<span class="btn btn-success btn-xs update">Sudah Diverifikasi</span>';
					}
				}elseif ($this->session->userdata('role') == 1) {
					if ($row->status == 3) {
						$sub_array[] = '<a href="' . site_url('admin/update_status/' . $row->id_transaksi) . '" onclick="return confirm(\'Apakah anda yakin?\')" class="btn btn-danger disabled btn-xs">Belum Diverifikasi</a>
						<a href="' . site_url('admin/update_status_sedang/' . $row->id_transaksi) . '" onclick="return confirm(\'Apakah anda yakin?\')" class="btn btn-warning btn-xs">Sedang Diverifikasi</a>
						<a href="' . site_url('admin/update_status_sudah/' . $row->id_transaksi) . '" onclick="return confirm(\'Apakah anda yakin?\')" class="btn btn-primary btn-xs">Sudah Diverifikasi</a>';
					}elseif ($row->status == 2) {
						$sub_array[] = '<a href="' . site_url('admin/update_status/' . $row->id_transaksi) . '" onclick="return confirm(\'Apakah anda yakin?\')" class="btn btn-warning disabled btn-xs">Sedang Diverifikasi</a>
						<a href="' . site_url('admin/update_status_sudah/' . $row->id_transaksi) . '" onclick="return confirm(\'Apakah anda yakin?\')" class="btn btn-primary btn-xs delete">Sudah Diverifikasi</a>';
					}elseif ($row->status == 1) {
						$sub_array[] = '<a href="' . site_url('admin/update_status/' . $row->id_transaksi) . '" onclick="return confirm(\'Apakah anda yakin?\')" class="btn btn-primary disabled btn-xs">Sudah Diverifikasi</a>';
					}
				}
				if ($this->session->userdata('role') == 1) {
					if ($row->status_pesanan == 0) {
						$sub_array[] = '<a href="' . site_url('admin/update_status_pesanan_dibuat/' . $row->id_transaksi) . '" onclick="return confirm(\'Apakah anda yakin?\')" class="btn btn-warning btn-xs">Sedang Dibuat</a>
						<a href="' . site_url('admin/update_status_pesanan_diantar/' . $row->id_transaksi) . '" onclick="return confirm(\'Apakah anda yakin?\')" class="btn btn-primary btn-xs delete">Proses Pengataran</a>';
					}elseif($row->status_pesanan == 2){
						$sub_array[] = '<a href="' . site_url('admin/update_status_pesanan_diantar/' . $row->id_transaksi) . '" onclick="return confirm(\'Apakah anda yakin?\')" class="btn btn-success btn-xs">Proses Pengantaran</a>';
					}elseif ($row->status_pesanan == 1) {
						$sub_array[] = '<span class="btn btn-primary btn-xs delete">Dalam Proses Pengataran</span>';
					}
				}elseif ($this->session->userdata('role') == 2) {
					if ($row->status_pesanan == 0) {
						$sub_array[] = '<span class="btn btn-danger btn-xs delete">Proses Tinjau</span>';
					}elseif ($row->status_pesanan == 2) {
						$sub_array[] = '<span class="btn btn-warning btn-xs delete">Sedang Dibuat</span>';
					}elseif ($row->status_pesanan == 1) {
						$sub_array[] = '<span class="btn btn-primary btn-xs delete">Dalam Proses Pengataran</span>';
					}
				}
				$sub_array[] = longdate_indo($row->created_at);
				$sub_array[] = '<a href="' . site_url('#' . $row->id_transaksi) . '" class="btn btn-info btn-xs update"><i class="fa fa-edit"></i></a>
                     <a href="' . site_url('#' . $row->id_transaksi) . '" onclick="return confirm(\'Apakah anda yakin?\')" class="btn btn-danger btn-xs delete"><i class="fa fa-trash"></i></a>';
				$data[] = $sub_array;
			}

			$output = array(
				"draw" => intval($_POST["draw"]),
				"recordsTotal" => $this->Transaksi_model->get_all_data(),
				"recordsFiltered" => $this->Transaksi_model->get_filtered_data(),
				"data" => $data
			);
			echo json_encode($output);
		} else {
			echo "Error: Fetch data is not an array.";
		}
	}


	/**
	 * @param $id_transaksi
	 *
	 * @return void
	 */
	public function update_status_pesanan_diantar($id_transaksi):void
	{
		if($id_transaksi){
			$data = [
				'status_pesanan' => 1
			];

			$update_status_pesanan = $this->Transaksi_model->update($id_transaksi, $data);

			if ($update_status_pesanan) {
				$this->session->set_flashdata('success','Pesanan berhasil di verifikasi');
			}else {
				$this->session->set_flashdata('error','Pesanan gagal di verifikasi');
			}
			redirect(base_url('admin/list_transaksi'));
		}else {
			$this->session->set_flashdata('error', 'Data ditemukan');
		}
		redirect(base_url('admin/list_transaksi'));
	}

	/**
	 * @param $id_transaksi
	 *
	 * @return void
	 */
	public function update_status_pesanan_dibuat($id_transaksi):void
	{
		if($id_transaksi){
			$data = [
				'status_pesanan' => 2
			];

			$update_status_pesanan = $this->Transaksi_model->update($id_transaksi, $data);

			if ($update_status_pesanan) {
				$this->session->set_flashdata('success','Pesanan berhasil di verifikasi');
			}else {
				$this->session->set_flashdata('error','Pesanan gagal di verifikasi');
			}
			redirect(base_url('admin/list_transaksi'));
		}else {
			$this->session->set_flashdata('error', 'Data ditemukan');
		}
		redirect(base_url('admin/list_transaksi'));
	}

	/**
	 * @param $id_transaksi
	 *
	 * @return void
	 */
	public function update_status_sudah($id_transaksi):void
	{
		if ($id_transaksi) {
			$data = [
				'status' => 1
			];
			$update_data = $this->Transaksi_model->update($id_transaksi, $data);
			if ($update_data) {
				$this->session->set_flashdata('success', 'Pembayaran berhasil diverifikasi, pesanan dalam proses pengantaran');
			}else {
				$this->session->set_flashdata('error', 'Pembayaran gagal');
			}
			redirect(base_url('admin/list_transaksi'));
		}else {
			$this->session->set_flashdata('error', 'Data Tidak Ditemukan');
		}
		redirect(base_url('admin/list_transaksi'));
	}

	/**
	 * @param $id_transaksi
	 *
	 * @return void
	 */
	public function update_status_sedang($id_transaksi):void
	{
		if ($id_transaksi) {
			$data = [
				'status' => 2
			];
			$update_data = $this->Transaksi_model->update($id_transaksi, $data);
			if ($update_data) {
				$this->session->set_flashdata('success', 'Pembayaran sedang ditinjau');
			}else {
				$this->session->set_flashdata('error', 'Pembayaran gagal');
			}
			redirect(base_url('admin/list_transaksi'));
		}else {
			$this->session->set_flashdata('error', 'Data Tidak Ditemukan');
		}
		redirect(base_url('admin/list_transaksi'));
	}
}
