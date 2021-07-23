<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_report extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function binding($where = '', $length = 0, $start = 0, $sort, $type, $startDate, $endDate)
    {
        $query = "transaction.id as id,transaction.money_changes as money_changes,transaction.money_paid as money_paid,transaction.total as total,table.name as table_name,date_format(transaction.created_at, '%d/%m/%Y %H:%i') created_at";
        $this->db->select($query);
        $this->db->from("transaction");
        $this->db->join("table", "transaction.id_table = table.id");
        $this->MReport->getFilter($where, $startDate, $endDate);
        $this->db->order_by($sort, $type)
            ->limit($length, $start);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function count($where = '', $startDate, $endDate)
    {
        $this->db->from("transaction");
        $this->db->join("table", "transaction.id_table = table.id");
        $this->MReport->getFilter($where, $startDate, $endDate);
        return $this->db->count_all_results();
    }
    public function getFilter($where, $startDate, $endDate)
    {
        if ($startDate != "") {
            $this->db->where('DATE(transaction.created_at) >=', $startDate);
        }
        if ($endDate != "") {
            $this->db->where('DATE(transaction.created_at) <=', $endDate);
        }
        if ($where != '') {
            $this->db->group_start()
                ->like('LOWER(transaction.total)', strtolower($where))
                ->or_like('LOWER(table.name)', strtolower($where))
                ->or_like('LOWER(transaction.money_paid)', strtolower($where))
                ->or_like('LOWER(transaction.money_changes)', strtolower($where))
                ->group_end();
        }
    }
    function getById($id)
    {
        $this->db->select("transaction.id as id,transaction.money_changes as money_changes,transaction.money_paid as money_paid,transaction.total as total,table.name as table_name,date_format(transaction.created_at, '%d/%m/%Y %H:%i') created_at")
            ->from('transaction')
            ->join("table", "transaction.id_table = table.id")
            ->where('transaction.id', $id);
        return $this->db->get()->row();
    }
    public function countBar($year, $month)
    {
        $this->db->from("transaction");
        $this->db->where("YEAR(transaction.created_at) = ", $year);
        $this->db->where("MONTH(transaction.created_at) = ", $month);
        return $this->db->count_all_results();
    }
    public function countPie($year, $month, $table)
    {
        $this->db->from("transaction");
        $this->db->where("YEAR(transaction.created_at) = ", $year);
        $this->db->where("transaction.id_table = ", $table);
        $this->db->where("MONTH(transaction.created_at) = ", $month);
        return $this->db->count_all_results();
    }
}
