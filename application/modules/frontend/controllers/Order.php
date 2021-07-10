<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends MX_Controller
{
    function __construct()
    {
        $this->load->model("Model_table", "MTable");
        $this->load->model("Model_food", "MFood");
        $this->load->model("Model_token", "MToken");
        $this->load->model("Model_message", "MMessage");
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
                $food = array();
                $foods = $this->MFood->getByFood($val['id']);
                foreach ($foods as $vals) {
                    $vals['photoFood'] = $this->MFood->getPhotoFood($vals['id']);
                    array_push($food, $vals);
                }
                $val['food'] = $food;
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
        $dataTable = $this->MTable->getById($idTable);
        if ($dataTable == null) {
            $json = array('message' => array('meja tidak di temukan'), 'success' => false);
            echo json_encode($json);
            return false;
        }
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
        $dataMessage['value'] = "You have new order form " . $dataTable->name;
        $dataMessage["date"] = date('Y-m-d H:i');
        $this->MMessage->save(0, $dataMessage);
        $idTokn = array();
        $dataToken = $this->MToken->getAll();
        foreach ($dataToken as $val) {
            array_push($idTokn, $val["value"]);
        }
        $this->sendGCM("NEW ORDER", $dataMessage['value'], date('d/m/Y H:i A'), $idTokn);
        $json = array('message' => array(), 'success' => true);
        echo json_encode($json);
    }
    function sendGCM($title, $body, $time, $id)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';

        $fields = array(
            'registration_ids' => $id,
            'data' => array(
                "time" => $time
            ),
            'notification' => array(
                "body" => $body,
                "title" => $title,
                "icon" => base_url() . "/assets/custom/admin/img/logo_1.png"
            )
        );
        $fields = json_encode($fields);

        $headers = array(
            'Authorization: key=' . TOKEN_FIREBASE,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

        $result = curl_exec($ch);
        // echo $result;
        curl_close($ch);
    }
}
