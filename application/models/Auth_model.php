<?php

/**
 * @property $db
 */

class Auth_model extends CI_Model
{
	public function getUsername($email)
	{
		return $this->db->get_where('users', array('email' => $email))->row_array();
	}

	public function insert($data)
	{
		return $this->db->insert('users', $data);
	}

	public function delete($id_users)
	{
		$this->db->where('id_users', $id_users);
		return $this->db->delete('users');
	}
}
