<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_message extends CI_Model
{
    function save($id, $data)
    {
        if ($id != 0) {
            $this->db->trans_start();
            $this->db->where("id", $id);
            $this->db->update("message", $data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                return 0;
            } else {
                return 1;
            }
        } else {
            $this->db->insert('message', $data);
            $insert_id = $this->db->insert_id();
            return  $insert_id;
        }
    }
}
