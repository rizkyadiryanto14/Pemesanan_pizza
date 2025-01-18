<?php

/**
 * @author Rizky Adi Ryanto
 * @link github.com/rizkyadiryanto14
 *
 * Controller Transaksi bertanggung jawab atas pengelolaan transaksi dalam aplikasi, termasuk fitur seperti manajemen status transaksi, upload bukti pembayaran, ulasan produk, dan lainnya.
 *
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
		$config['max_size'] = 8192;
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

	public function get_reviews(): void
	{
		$this->load->model('Transaksi_model');
		$reviews = $this->Transaksi_model->get_all_reviews();
		echo json_encode($reviews);
	}


	public function submit_review(): void
	{
		$data = array(
			'id_transaksi' => $this->input->post('id_transaksi'),
			'id_produk' => $this->input->post('id_produk'),
			'id_user' => $this->session->userdata('id_users'),
			'review' => $this->input->post('review'),
			'rating' => $this->input->post('rating'),
		);

		$this->load->model('Transaksi_model');
		$this->Transaksi_model->insert_review($data);

		echo json_encode(array('status' => 'success'));
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
				$sub_array[] = 'Rp.' . number_format($row->harga_produk);
				$sub_array[] = $row->qty;
				$sub_array[] = 'Rp.' . number_format($row->total_harga);
				$sub_array[] = '<a href="' . site_url($row->bukti_transaksi) . '" class="btn btn-info btn-xs update">Lihat File</a>';

				// ini untuk Status transaksi
				if ($row->status == 3) {
					$sub_array[] = '<span class="btn btn-danger btn-xs">Belum Diverifikasi</span>';
					if ($this->session->userdata('role') == 1) {
						$sub_array[] = '<a href="' . site_url('admin/update_status_sedang/' . $row->id_transaksi) . '"  onclick="return confirm(\'Apakah anda yakin?\')"  class="btn btn-info btn-xs update">Sedang Ditinjau</a>
                          <a href="' . site_url('admin/update_status_sudah/' . $row->id_transaksi) . '" onclick="return confirm(\'Apakah anda yakin?\')" class="btn btn-danger btn-xs delete">Sudah Diverifikasi</a>';
					} else {
						$sub_array[] = '<span class="btn btn-secondary btn-xs disabled">Belum Diverifikasi</span>';
					}
				} elseif ($row->status == 2) {
					if ($this->session->userdata('role') == 1) {
						$sub_array[] = '<a href="' . site_url('admin/update_status_sudah/' . $row->id_transaksi) . '" onclick="return confirm(\'Apakah anda yakin?\')" class="btn btn-success btn-xs delete">Sudah Diverifikasi</a>';
					} else {
						$sub_array[] = '<span class="btn btn-success btn-xs">Sedang Ditinjau</span>';
					}
				} elseif ($row->status == 1) {
					$sub_array[] = '<span class="btn btn-success btn-xs"><i class="fas fa-check"></i> Sudah Diverifikasi</span>';
				}

				// sedangkan ini untuk Status pesanan
				if ($row->status_pesanan == 0) {
					if ($this->session->userdata('role') == 1) {
						$sub_array[] = '<a href="' . site_url('admin/update_status_pesanan_dibuat/' . $row->id_transaksi) . '"  onclick="return confirm(\'Apakah anda yakin?\')"  class="btn btn-info btn-xs update">Sedang Dibuat</a>
                          <a href="' . site_url('admin/update_status_pesanan_diantar/' . $row->id_transaksi) . '" onclick="return confirm(\'Apakah anda yakin?\')" class="btn btn-danger btn-xs delete">Dalam Pengantaran</a>';
					} else {
						$sub_array[] = '<span class="btn btn-secondary btn-xs disabled">Tidak dapat mengubah status pesanan</span>';
					}
				} elseif ($row->status_pesanan == 2) {
					if ($this->session->userdata('role') == 1) {
						$sub_array[] = '<a href="' . site_url('admin/update_status_pesanan_diantar/' . $row->id_transaksi) . '" onclick="return confirm(\'Apakah anda yakin?\')" class="btn btn-warning btn-xs delete">Dalam Pengantaran</a>';
					} else {
						$sub_array[] = '<span class="btn btn-warning btn-xs">Dalam Pengantaran</span>';
					}
				} elseif ($row->status_pesanan == 1) {
					$sub_array[] = '<span class="btn btn-success btn-xs">Selesai</span>';
				}


				// Tambahkan kolom ulasan
				if ($this->session->userdata('role') == 2) {
					if ($row->status_pesanan == 1) {
						$review_exists = $this->Transaksi_model->check_review_exists($row->id_transaksi, $this->session->userdata('id_users'));

						if ($review_exists) {
							$sub_array[] = '<span class="btn btn-secondary btn-xs disabled">Ulasan Dikirim</span>';
						} else {
							$sub_array[] = '<button class="btn btn-success btn-xs btn-review" data-id-transaksi="' . $row->id_transaksi . '" data-id-produk="' . $row->id_produk . '">Beri Ulasan</button>';
						}
					} else {
						$sub_array[] = '';
					}
				} elseif ($this->session->userdata('role') == 1) { // Admin
					$review_exists = $this->Transaksi_model->check_review_exists($row->id_transaksi);

					if ($review_exists) {
						$sub_array[] = '<button class="btn btn-info btn-xs btn-view-review" data-id-transaksi="' . $row->id_transaksi . '">Lihat Ulasan</button>';
					} else {
						$sub_array[] = '<span class="btn btn-warning btn-xs">Belum Ada Ulasan</span>';
					}
				}

				$sub_array[] = longdate_indo($row->created_at);

				if ($this->session->userdata('role') == 1) {
					$sub_array[] = '<a href="' . site_url('#' . $row->id_transaksi) . '" class="btn btn-info btn-xs update"><i class="fa fa-edit"></i></a>
            <a href="' . site_url('#' . $row->id_transaksi) . '" onclick="return confirm(\'Apakah anda yakin?\')" class="btn btn-danger btn-xs delete"><i class="fa fa-trash"></i></a>';
				}

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
