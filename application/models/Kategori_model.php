<?php

/**
 * @property $db
 */

class Kategori_model extends CI_Model
{
	public function get()
	{
		return $this->db->get('kategori_produk')->result();
	}

	public function insert($data)
	{
		return $this->db->insert('kategori_produk', $data);
	}

	public function update($id, $data)
	{
		$this->db->where('id_kategori', $id);
		return $this->db->update('kategori_produk', $data);
	}


	/**
	 * @return void
	 */
	function make_query():void
	{
		$this->db->select('kategori_produk.*')
			->from("kategori_produk");
		if (isset($_POST["search"]["value"])) {
			$this->db->like("nama_kategori", $_POST["search"]["value"]);
			$this->db->or_like("keterangan", $_POST["search"]["value"]);
		}
		if (isset($_POST["order"])) {
			$this->db->order_by($_POST['order']['0']['column'], $_POST['order']['0']['dir']);
		} else {
			$this->db->order_by('id_kategori', 'DESC');
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
		$this->db->from("kategori_produk");
		return $this->db->count_all_results();
	}
}
