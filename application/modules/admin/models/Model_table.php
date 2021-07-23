<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_table extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function bindingTrx($where = '', $length = 0, $start = 0, $sort, $type)
    {
        $query = 'is_active,id,name,code,';
        $query = $query . '(SELECT count(*) from `order` where `order`.id_table = `table`.id AND `order`.`is_served` = false AND `order`.`is_paid` = false) as `order`';
        $this->db->select($query);
        $this->db->from("table")->where('deleted_at is null');
        if ($where != '') {
            $this->db->group_start()
                ->like('name', $where)
                ->or_like('code', $where)
                ->group_end();
        }
        $this->db->order_by($sort, $type)
            ->limit($length, $start);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function countTrx($where = '')
    {
        $this->db->from("table")->where('deleted_at is null');
        if ($where != '') {
            $this->db->group_start()
                ->like('name', $where)
                ->or_like('code', $where)
                ->group_end();
        }
        return $this->db->count_all_results();
    }
    public function binding($where = '', $length = 0, $start = 0, $sort, $type)
    {
        $this->db->select('is_active,id,name,code');
        $this->db->from("table")->where('deleted_at is null');
        if ($where != '') {
            $this->db->group_start()
                ->like('name', $where)
                ->or_like('code', $where)
                ->group_end();
        }
        $this->db->order_by($sort, $type)
            ->limit($length, $start);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function count($where = '')
    {
        $this->db->from("table")->where('deleted_at is null');
        if ($where != '') {
            $this->db->group_start()
                ->like('name', $where)
                ->or_like('code', $where)
                ->group_end();
        }
        return $this->db->count_all_results();
    }
    function save($id, $data)
    {
        if ($id != 0) {
            $this->db->trans_start();
            $this->db->where("id", $id);
            $this->db->update("table", $data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                return 0;
            } else {
                return 1;
            }
        } else {
            $this->db->insert('table', $data);
            $insert_id = $this->db->insert_id();
            return  $insert_id;
        }
    }
    function getById($id)
    {
        $this->db->select('*')
            ->from('table')
            ->where('id', $id)
            ->where('deleted_at is null');
        return $this->db->get()->row();
    }
    function getByName($name)
    {
        $this->db->select('*')
            ->from('table')
            ->where('name', $name)
            ->where('deleted_at is null');
        return $this->db->get()->row();
    }
    public function getAll()
    {
        $this->db->select('is_active,id,name,code');
        $this->db->from("table")->where('deleted_at is null');
        $query = $this->db->get();
        return $query->result_array();
    }
}
