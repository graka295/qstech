<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_trx extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function binding($where = '', $length = 0, $start = 0, $sort, $type, $idData)
    {
        $this->db->select("*");
        $this->db->from("order");
        $this->db->where("id_table", $idData);
        $this->db->where("is_paid", false);
        if ($where != '') {
            $this->db->group_start()
                ->like('name_food', $where)
                ->or_like('qty', $where)
                ->or_like('price', $where)
                ->group_end();
        }
        $this->db->order_by($sort, $type)
            ->limit($length, $start);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getTotalPrice($idData)
    {
        $this->db->select_sum('total');
        $this->db->from("order");
        $this->db->where("id_table", $idData);
        $this->db->where("is_paid", false);
        return $this->db->get()->row();
    }
    public function count($where = '', $idData)
    {
        $this->db->from("order");
        $this->db->where("id_table", $idData);
        $this->db->where("is_paid", false);
        if ($where != '') {
            $this->db->group_start()
                ->like('name_food', $where)
                ->or_like('qty', $where)
                ->or_like('price', $where)
                ->group_end();
        }
        return $this->db->count_all_results();
    }
    function save($id, $data)
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
    public function getOrderTable($idTable)
    {
        $this->db->select("*");
        $this->db->from("order");
        $this->db->where("id_table", $idTable);
        $this->db->where("is_paid", false);
        $query = $this->db->get();
        return $query->result_array();
    }
    function payment($data)
    {
        $this->db->trans_start();
        // data transaction
        $this->db->insert('transaction', $data);
        $transaction_id = $this->db->insert_id();
        // insert transaction_order
        $order = $this->getOrderTable($data['id_table']);
        // $transactionOrder = array();
        $idOrder = array();
        foreach ($order as $val) {
            $transactionOrderS["id_order"] = $val['id'];
            $transactionOrderS["id_trx"] = $transaction_id;
            // $transactionOrder = array_push($transactionOrder, $transactionOrderS);
            $this->db->insert('transaction_order', $transactionOrderS);
            $idOrder = array_push($idOrder, $val['id']);
        }
        $this->db->where_in("id", $idOrder);
        $this->db->update("order", array("is_paid" => true));
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return 0;
        } else {
            return 1;
        }
    }
}
