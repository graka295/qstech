<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Table extends ADMIN_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $this->template("/table/index", null);
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
        $data = $this->MTable->binding($filter, $length, $start, $orderby, $sortOrderAsc);
        //count data
        $count = $this->MTable->count($filter);
        $json['data'] = $data;
        $json['draw'] = $this->input->post('draw');
        $json['iTotalRecords'] = $count;
        $json['iTotalDisplayRecords'] = $count;
        $json['$sortOrderAsc'] = $sortOrderAsc;
        $json['$column'] = $column;
        echo json_encode($json);
    }
    public function deleteData()
    {
        $id = $this->input->post("id");
        $val = $this->input->post("val") == "true" ? true : false;
        $admin = $this->session->userdata("admin");
        $user["updated_by"] = $admin["id"];
        $user["is_active"] = $val;
        $user["updated_at"] = date('Y-m-d H:i:s');
        $id = $this->MTable->save($id, $user);
        $json = array('message' => array(), 'success' => true);
        if (!$id) {
            $json["message"] = $this->lang->line("response_failed");
            $json["success"] = false;
            echo json_encode($json);
            return false;
        }
        echo json_encode($json);
    }
    public function delete()
    {
        $id = $this->input->get('id');
        $admin = $this->session->userdata("admin");
        $user["deleted_by"] = $admin["id"];
        $user["deleted_at"] = date('Y-m-d H:i:s');
        $id = $this->MTable->save($id, $user);
        if (!$id) {
            show_error("Error delete table");
        }
        redirect('admin/table');
    }
    public function create()
    {
        $this->template("/table/create", null);
    }
    public function validate()
    {
        $name = $this->input->post("name");
        $json = array('message' => array(), 'success' => true);
        $users = $this->MTable->getByName($name);
        if ($users) {
            $json["message"] = array(sprintf($this->lang->line("response_already_exist"), "Name"));
            $json["success"] = false;
            echo json_encode($json);
            return false;
        }
        echo json_encode($json);
    }

    public function doCreate()
    {
        try {
            $user["name"] = $this->input->post('name');
            $user["description"] = $this->input->post('desc');
            $admin = $this->session->userdata("admin");
            $user["code"] = mt_rand(100000, 999999);
            $user["created_by"] = $admin["id"];
            $user["created_at"] = date('Y-m-d H:i:s');
            $user["is_active"] = true;
            $id = $this->MTable->save(0, $user);
            if ($id) {
                redirect('admin/table');
            } else {
                show_error("Error create table");
            }
        } catch (Exception $e) {
            show_error("Error in try catch in " . __LINE__);
        }
    }
    public function update()
    {
        $id = $this->input->get('id');
        $currentData = $this->MTable->getById($id);
        if ($currentData != null && $id != null) {
            $data["data"] = $currentData;
            $this->template("/table/update", $data);
        } else {
            show_404();
        }
    }
    public function validateUpdate()
    {
        $name = $this->input->post("name");
        $id = $this->input->post("id");
        $json = array('message' => array(), 'success' => true);
        $data = $this->MTable->getByName($name);
        if ($data != null && $data->id != $id) {
            $json["message"] = array(sprintf($this->lang->line("response_already_exist"), $this->lang->line("label_name")));
            $json["success"] = false;
            echo json_encode($json);
            return false;
        }
        echo json_encode($json);
    }
    public function doUpdate()
    {
        try {
            $id = $this->input->post('id');
            $user["name"] = $this->input->post('name');
            $user["description"] = $this->input->post('desc');
            $admin = $this->session->userdata("admin");
            $user["created_by"] = $admin["id"];
            $user["created_at"] = date('Y-m-d H:i:s');
            $user["is_active"] = true;
            $id = $this->MTable->save($id, $user);
            if ($id) {
                redirect('admin/table');
            } else {
                show_error("Error create table");
            }
        } catch (Exception $e) {
            show_error("Error in try catch in " . __LINE__);
        }
    }
}
