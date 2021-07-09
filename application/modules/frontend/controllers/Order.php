<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends MX_Controller
{
    function __construct()
    {
        $this->load->model("Model_table", "MTable");
        $this->load->model("Model_food", "MFood");
    }
    public function index()
    {
        $codeTable = $this->input->get('codeTable');
        $dataTable = $this->MTable->getByCode($codeTable);
        if ($dataTable != null && $codeTable != null) {
            $data["table"] = $dataTable;
            $data["orderTable"] = $this->MTable->getOrderTable($dataTable->id);
            $categoryFood = $this->MFood->getAllCategory();
            $categoryFoods = array();
            foreach ($categoryFood as $val) {
                $val['food'] = $this->MFood->getByFood($val['id']);
                array_push($categoryFoods, $val);
            }
            $data['menu'] = $categoryFoods;
            $this->load->view("order/index", $data);
        } else {
            show_404();
        }
    }
    public function orderFood()
    {
        $idTable = $this->input->post("idTable");
        $orderData = $this->input->post("orderData");
        foreach ($orderData as $val) {
            $currentData = $this->MFood->getById($val['id']);
            if ($currentData == null) {
                continue;
            }
            $dataSave["id_table"] = $idTable;
            $dataSave["id_food"] = $val['id'];
            $dataSave["qty"] = $val['qty'];
            $dataSave["note"] = $val['note'];
            $dataSave["name_food"] = $currentData->name;
            $dataSave["price"] = $currentData->price;
            $dataSave["total"] = $val['qty'] * $currentData->price;
            $dataSave["created_at"] = date('Y-m-d H:i:s');
            $this->MTable->saveOrder(0, $dataSave);
        }
        $json = array('message' => array(), 'success' => true);
        echo json_encode($json);
    }
}
