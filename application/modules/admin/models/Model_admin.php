<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_admin extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }

  function getByEmail($email)
  {
    $this->db->select('*')
      ->from('admin')
      ->where('is_active', true)
      ->where('email', $email);
    return $this->db->get()->row();
  }
  public function binding($where = '', $length = 0, $start = 0, $sort, $type)
  {
    $this->db->select('is_active,id,email, CONCAT(first_name, " ", COALESCE(last_name,"")) as name');
    $this->db->from("admin");
    if ($where != '') {
      $this->db->group_start()
        ->like('CONCAT(first_name, " ", COALESCE(last_name,""))', $where)
        ->or_like("email", $where)
        ->group_end();
    }
    $this->db->order_by($sort, $type)
      ->limit($length, $start);
    $query = $this->db->get();
    return $query->result_array();
  }
  public function count($where = '')
  {
    $this->db->from("admin");
    if ($where != '') {
      $this->db->group_start()
        ->like('CONCAT(first_name, " ", COALESCE(last_name,""))', $where)
        ->or_like("email", $where)
        ->group_end();
    }
    return $this->db->count_all_results();
  }
  function save($id, $data)
  {
    if ($id != 0) {
      $this->db->trans_start();
      $this->db->where("id", $id);
      $this->db->update("admin", $data);
      $this->db->trans_complete();
      if ($this->db->trans_status() === FALSE) {
        return 0;
      } else {
        return 1;
      }
    } else {
      $this->db->insert('admin', $data);
      $insert_id = $this->db->insert_id();
      return  $insert_id;
    }
  }
  function getById($id)
  {
    $this->db->select('*')
      ->from('admin')
      ->where('is_active', true)
      ->where('id', $id);
    return $this->db->get()->row();
  }
  function deleteByID($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('admin');
  }
}
