<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_token extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function getAll()
    {
        $this->db->select('*')
            ->from('token_firebase');
        $query = $this->db->get();
        return $query->result_array();
    }
}
