<?php
defined('BASEPATH') or exit('No direct script access allowed');

class report extends ADMIN_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $this->template("report/index", null);
    }
    public function binding()
    {
        $filter = $this->input->post('search')["value"];
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $column = $this->input->post("order")[0]["column"];
        $orderby = strval($this->input->post("columns")[$column]["name"]);
        $sortOrderAsc = $this->input->post("order")[0]["dir"];
        $startDate = $this->input->post('startDate');
        $endDate = $this->input->post('endDate');
        //binding data
        $data = $this->MReport->binding($filter, $length, $start, $orderby, $sortOrderAsc, $startDate, $endDate);
        //count data
        $count = $this->MReport->count($filter, $startDate, $endDate);
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
        $users = $this->MReport->getById($id);
        if ($users != null && $id != null) {
            $data["data"] = $users;
            $this->template("/report/detail", $data);
        } else {
            show_404();
        }
    }
    public function bindingOrder()
    {
        $filter = $this->input->post('search')["value"];
        $start = $this->input->post('start');
        $idData = $this->input->post('idTable');
        $length = $this->input->post('length');
        $column = $this->input->post("order")[0]["column"];
        $orderby = strval($this->input->post("columns")[$column]["name"]);
        $sortOrderAsc = $this->input->post("order")[0]["dir"];
        //binding data
        $data = $this->MTrx->bindingReport($filter, $length, $start, $orderby, $sortOrderAsc, $idData);
        //count data
        $count = $this->MTrx->countReport($filter, $idData);
        $json['data'] = $data;
        $json['draw'] = $this->input->post('draw');
        $json['iTotalRecords'] = $count;
        $json['iTotalDisplayRecords'] = $count;
        $json['$sortOrderAsc'] = $sortOrderAsc;
        $json['$column'] = $column;
        $totalPrice = $this->MTrx->getTotalPrice($idData);
        $json['totalPrice'] = $totalPrice->total;
        echo json_encode($json);
    }
    function cartBar()
    {
        $year = $this->input->post("year");
        $json = array('message' => array(), 'success' => true, 'data' => array());
        $dataTmp = array();
        for ($i = 1; $i <= 12; $i++) {
            $data["name"] = $i;
            // $data["val"] = rand(10, 100);
            $data["val"] = $this->MReport->countBar($year, $i);

            array_push($dataTmp, $data);
        }
        $json['data'] = $dataTmp;
        echo json_encode($json);
    }
    function cartPie()
    {
        $year = $this->input->post("year");
        $month = $this->input->post("month");
        $json = array('message' => array(), 'success' => true, 'data' => array());
        $dataTmp = array();
        $dataTable = $this->MTable->getAll();
        foreach ($dataTable as $val) {
            $data["name"] = $val["name"];
            // $data["val"] = rand(10, 100);
            $data["val"] = $this->MReport->countPie($year, $month, $val["id"]);

            array_push($dataTmp, $data);
        }
        $json['data'] = $dataTmp;
        echo json_encode($json);
    }
}
