<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Suggestions extends ADMIN_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $this->template("/suggestions/index", null);
    }
    public function binding()
    {
        $filter = $this->input->post('search')["value"];
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $column = $this->input->post("order")[0]["column"];
        $orderby = strval($this->input->post("columns")[$column]["name"]);
        $sortOrderAsc = $this->input->post("order")[0]["dir"];
        //binding data
        $data = $this->MSuggestions->binding($filter, $length, $start, $orderby, $sortOrderAsc);
        //count data
        $count = $this->MSuggestions->count($filter);
        $json['data'] = $data;
        $json['draw'] = $this->input->post('draw');
        $json['iTotalRecords'] = $count;
        $json['iTotalDisplayRecords'] = $count;
        $json['$sortOrderAsc'] = $sortOrderAsc;
        $json['$column'] = $column;
        echo json_encode($json);
    }
    public function detail()
    {
        $id = $this->input->get('id');
        $suggestions = $this->MSuggestions->getById($id);
        if ($suggestions != null && $id != null) {
            $data["data"] = $suggestions;
            $this->template("/suggestions/detail", $data);
        } else {
            show_404();
        }
    }
}
