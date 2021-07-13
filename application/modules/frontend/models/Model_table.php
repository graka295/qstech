<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_table extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function getByCode($id)
    {
        $this->db->select('*')
            ->from('table')
            ->where('is_active', true)
            ->where('code', $id)
            ->where('deleted_at is null');
        return $this->db->get()->row();
    }
    function getById($id)
    {
        $this->db->select('*')
            ->from('table')
            ->where('is_active', true)
            ->where('id', $id)
            ->where('deleted_at is null');
        return $this->db->get()->row();
    }
    public function getOrderTable($idTable)
    {
        $this->db->select("*");
        $this->db->from("order");
        $this->db->where("id_table", $idTable);
        $this->db->where("is_paid", false);
        $query = $this->db->get();
        return $query->result_array();
    }
    function saveOrder($id, $data)
    {
        if ($id != 0) {
            $this->db->trans_start();
            $this->db->where("id", $id);
            $this->db->update("order", $data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                return 0;
            } else {
                return 1;
            }
        } else {
            $this->db->insert('order', $data);
            $insert_id = $this->db->insert_id();
            return  $insert_id;
        }
    }
    function getAll()
    {
        $this->db->select('*,(SELECT COUNT(*) FROM `order` WHERE `order`.`id_table` = table.id AND `is_paid` = false) as table_order')
            ->from('table');
        $query = $this->db->get();
        return $query->result_array();
    }
}
