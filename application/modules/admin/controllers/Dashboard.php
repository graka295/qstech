<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends ADMIN_Controller
{
	function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$this->template("dashboard/index", null);
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
		$data = $this->MTable->bindingTrx($filter, $length, $start, $orderby, $sortOrderAsc);
		//count data
		$count = $this->MTable->countTrx($filter);
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
		$users = $this->MTable->getById($id);
		if ($users != null && $id != null) {
			$data["title_page"] = $this->lang->line('title_admin');
			$data["data"] = $users;
			$this->template("/dashboard/detail", $data);
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
		$data = $this->MTrx->binding($filter, $length, $start, $orderby, $sortOrderAsc, $idData);
		//count data
		$count = $this->MTrx->count($filter, $idData);
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
	public function changeOrderServed()
	{
		$id = $this->input->post("id");
		$val = $this->input->post("val") == "true" ? true : false;
		$admin = $this->session->userdata("admin");
		$user["updated_by"] = $admin["id"];
		$user["is_served"] = $val;
		$user["updated_at"] = date('Y-m-d H:i:s');
		$id = $this->MTrx->save($id, $user);
		$json = array('message' => array(), 'success' => true);
		if (!$id) {
			$json["message"] = $this->lang->line("response_failed");
			$json["success"] = false;
			echo json_encode($json);
			return false;
		}
		echo json_encode($json);
	}
	public function payment()
	{
		$user["id_table"] = $this->input->post("id_table");
		$user["total"] = $this->input->post("id_table");
		$user["money_paid"] = $this->input->post("id_table");
		$user["money_changes"] = $this->input->post("id_table");
		$admin = $this->session->userdata("admin");
		$user["created_by"] = $admin["id"];
		$user["created_at"] = date('Y-m-d H:i:s');
		$id = $this->MTrx->payment($user);
		if (!$id) {
			$json["message"] = $this->lang->line("response_failed");
			$json["success"] = false;
			echo json_encode($json);
			return false;
		}
		$json = array('message' => array(), 'success' => true);
		echo json_encode($json);
	}
}
