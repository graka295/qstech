<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_suggestions extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function binding($where = '', $length = 0, $start = 0, $sort, $type)
    {
        $this->db->select("*,date_format(created_at, '%d/%m/%Y %H:%i') date_format")->from('suggestions');
        if ($where != '') {
            $this->db->group_start()
                ->like('name', $where)
                ->or_like('title', $where)
                ->or_like('date_format', $where)
                ->group_end();
        }
        $this->db->order_by($sort, $type)
            ->limit($length, $start);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function count($where = '')
    {
        $this->db->select("*,date_format(created_at, '%d/%m/%Y %H:%i') date_format")->from('suggestions');
        if ($where != '') {
            $this->db->group_start()
                ->like('name', $where)
                ->or_like('title', $where)
                ->or_like('date_format', $where)
                ->group_end();
        }
        return $this->db->count_all_results();
    }
    function getById($id)
    {
        $this->db->select("*,date_format(created_at, '%d/%m/%Y %H:%i') date_format")
            ->from('suggestions')
            ->where('id', $id);
        return $this->db->get()->row();
    }
}
