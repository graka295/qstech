<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_token extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function getByToken($value)
    {
        $this->db->select('*')
            ->from('token_firebase')
            ->where('value', $value);
        return $this->db->get()->row();
    }
    function save($id, $data)
    {
        if ($id != 0) {
            $this->db->trans_start();
            $this->db->where("id", $id);
            $this->db->update("token_firebase", $data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                return 0;
            } else {
                return 1;
            }
        } else {
            $this->db->insert('token_firebase', $data);
            $insert_id = $this->db->insert_id();
            return  $insert_id;
        }
    }
}
