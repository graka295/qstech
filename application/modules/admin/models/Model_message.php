<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_message extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function binding()
    {
        $this->db->select("*,date_format(date, '%d/%m/%Y %H:%i') date");
        $this->db->from("message");
        $this->db->order_by("message.date",'desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function count()
    {
        $this->db->from("message")->where('is_read = false');
        return $this->db->count_all_results();
    }
    public function readAll()
    {
        $this->db->trans_start();
        $this->db->where("is_read", false);
        $this->db->update("message", array('is_read' => true));
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return 0;
        } else {
            return 1;
        }
    }
}
