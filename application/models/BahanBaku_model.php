<?php

/**
 * @property $db
 */

class BahanBaku_model extends CI_Model
{
	public function get()
	{
		return $this->db->get('bahan_baku')->result();
	}

	public function getById($id)
	{
		return $this->db->get_where('bahan_baku', ['id_bahan_baku' => $id])->row_array();
	}

	public function get_bahan_by_id($id_bahan)
	{
		$this->db->where('id_bahan_baku', $id_bahan);
		return $this->db->get('bahan_baku')->row();
	}

	public function insert($data)
	{
		return $this->db->insert('bahan_baku', $data);
	}

	public function update_data($id, $data)
	{
		$this->db->where('id_bahan_baku', $id);
		return $this->db->update('bahan_baku', $data);
	}

	/**
	 * @return void
	 */
	function make_query():void
	{
		$this->db->select('bahan_baku.*')
			->from("bahan_baku");
		if (isset($_POST["search"]["value"])) {
			$this->db->like("nama_bahan", $_POST["search"]["value"]);
			$this->db->or_like("keterangan", $_POST["search"]["value"]);
		}
		if (isset($_POST["order"])) {
			$this->db->order_by($_POST['order']['0']['column'], $_POST['order']['0']['dir']);
		} else {
			$this->db->order_by('stok_bahan', 'DESC');
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
		$this->db->from("bahan_baku");
		return $this->db->count_all_results();
	}
}
