<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Table extends MX_Controller
{
    function __construct()
    {
        $this->load->model("Model_table", "MTable");
    }
    public function index()
    {
        $dataTable = $this->MTable->getAll();
        $data['dataTable'] = $dataTable;
        $this->load->view("table/index", $data);
    }
}
