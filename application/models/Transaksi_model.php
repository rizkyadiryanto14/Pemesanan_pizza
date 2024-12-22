<?php

/**
 * @property $db
 */

class Transaksi_model extends CI_Model
{
	public function insert($data)
	{
		return $this->db->insert('transaksi', $data);
	}

	public function getByIdTransaksi($id_transaksi)
	{
		return $this->db->get_where('transaksi', ['id_transaksi' => $id_transaksi])->row_array();
	}

	public function update($id_transaksi, $data)
	{
		$this->db->where('id_transaksi', $id_transaksi);
		return $this->db->update('transaksi', $data);
	}

	function make_query():void
	{
		$this->db->select('transaksi.*, produk.nama_produk as nama_produk, produk.harga as harga_produk')
			->from("transaksi")
			->join('produk', 'produk.id_produk = transaksi.id_produk', 'left');
		if (isset($_POST["search"]["value"])) {
			$this->db->like("nama_produk", $_POST["search"]["value"]);
			$this->db->or_like("total_harga", $_POST["search"]["value"]);
		}
		if (isset($_POST["order"])) {
			$this->db->order_by($_POST['order']['0']['column'], $_POST['order']['0']['dir']);
		} else {
			$this->db->order_by('id_transaksi', 'DESC');
		}
	}

	function make_datatables()
	{
		$this->make_query();
		if ($_POST["length"] != -1) {
			$this->db->limit($_POST['length'], $_POST['start']);
		}
		$query = $this->db->get();
		if ($query === false) {
			// Query gagal, handle error di sini
			return false;
		}

		return $query->result();
	}

	function get_filtered_data()
	{
		$this->make_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	function get_all_data()
	{
		$this->db->select("*");
		$this->db->from("transaksi");
		return $this->db->count_all_results();
	}

}
