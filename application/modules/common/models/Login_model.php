<?php

class Login_model extends CI_Model
{
	protected $table = "tbl_register";
	// protected $emp_table = "user_mgmt";

	public function __construct()
	{
		parent::__construct();
	}
	// public function find($id = NULL)
	// {
	// 	$query = $this->db->get_where($this->table, array('lu_id' => $id));
	// 	return $query->row();
	// }

	public function getByEmpEmail($email = NULL)
	{
		$query = $this->db->get_where($this->table, array('email_id' => $email));
		$row = $query->num_rows();
		if ($row == 1) {
			return $query->row();
		} else {
			return false;
		}
	}
	public function getByData($ume = NULL)
	{
		$query = $this->db->query("SELECT * From tbl_register where username='$ume' or mobile_no='$ume' or email_id='$ume'");
		$row = $query->num_rows();
		if ($row == 1) {
			return $query->row();
		} else {
			return false;
		}
	}
	public function getByEmpId($emp_id = NULL)
	{
		$query = $this->db->get_where($this->table, array('emp_id' => $emp_id));
		return $query->row();
	}
	public function update_last_login($lu_id = NULL, $data = NULL)
	{
		return $this->db->update($this->table, $data, array('id' => $lu_id));
	}
	public function change_pass($lu_id = NULL, $data = NULL)
	{
		return $this->db->update($this->table, $data, array('u_id' => $lu_id));
	}
	public function add_token($data = NULL)
	{
		return $this->db->insert('tbl_token', $data);
	}
	public function add($data = NULL)
	{
		return $this->db->insert($this->table, $data);
	}
	public function get_token($token = NULL)
	{
		$this->db->order_by("t_created_on", "desc");
		$query = $this->db->get_where('tbl_token', array('t_token' => $token));
		return $query->row();
	}
}
