<?php
/**
 * @property $db
 */

class Dashboard_model extends CI_Model
{
	public function get_pesanan_by_kategori()
	{
		$this->db->select('kategori_produk.nama_kategori, SUM(transaksi.qty) as total_qty');
		$this->db->from('transaksi');
		$this->db->join('produk', 'transaksi.id_produk = produk.id_produk', 'left');
		$this->db->join('kategori_produk', 'produk.id_kategori_produk = kategori_produk.id_kategori', 'left');
		$this->db->group_by('kategori_produk.id_kategori');
		$this->db->order_by('total_qty', 'DESC');
		return $this->db->get()->result();
	}


	public function count_produk()
	{
		return $this->db->count_all('produk');
	}

	public function count_kategori()
	{
		return $this->db->count_all('kategori_produk');
	}

	public function count_users()
	{
		$this->db->where('role !=', 1); // Tidak menghitung admin
		return $this->db->count_all_results('users');
	}

	public function count_bahan_baku()
	{
		return $this->db->count_all('bahan_baku');
	}

	public function get_transaksi_data()
	{
		$this->db->select('MONTH(created_at) as month, SUM(total_harga) as total');
		$this->db->group_by('MONTH(created_at)');
		$this->db->order_by('MONTH(created_at)', 'ASC');
		return $this->db->get('transaksi')->result();
	}

}
