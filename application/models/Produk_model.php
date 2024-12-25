<?php

/**
 * @property $db
 */

class Produk_model extends CI_Model
{

	public function get()
	{
		return $this->db->get('produk')->result();
	}

	public function getById($id_produk)
	{
		return $this->db->get_where('produk', ['id_produk' => $id_produk])->result_array();
	}

	public function getOneById($id_produk)
	{
		return $this->db->get_where('produk', ['id_produk' => $id_produk])->row_array();
	}

	public function insert($data)
	{
		return $this->db->insert('produk', $data);
	}

	public function update($id_produk, $data)
	{
		$this->db->where('id_produk', $id_produk);
		return $this->db->update('produk', $data);
	}


	function make_query():void
	{
		$this->db->select('produk.*, bahan_baku.nama_bahan as nama_bahan, kategori_produk.nama_kategori as nama_kategori')
			->from("produk")
			->join('bahan_baku', 'bahan_baku.id_bahan_baku = produk.id_bahan_baku', 'left')
			->join('kategori_produk', 'kategori_produk.id_kategori = produk.id_kategori_produk', 'left');
		if (isset($_POST["search"]["value"])) {
			$this->db->like("nama_produk", $_POST["search"]["value"]);
			$this->db->or_like("bahan_baku.nama_bahan", $_POST["search"]["value"]);
		}
		if (isset($_POST["order"])) {
			$this->db->order_by($_POST['order']['0']['column'], $_POST['order']['0']['dir']);
		} else {
			$this->db->order_by('id_produk', 'DESC');
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
		$this->db->from("produk");
		return $this->db->count_all_results();
	}

	public function listing_bahan_baku()
	{
		return $this->db->get('bahan_baku')->result();
	}

	public function listing_bahan_baku_id($id_bahan_baku)
	{
		return $this->db->get_where('bahan_baku', array('id_bahan_baku' => $id_bahan_baku))->row_array();
	}
}
