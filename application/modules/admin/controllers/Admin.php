<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends ADMIN_Controller
{
	function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$data["title_page"] = $this->lang->line('title_admin');
		$this->template("/admin/index", $data);
	}
	public function binding()
	{
		$filter = $this->input->post('search')["value"];
		$start = $this->input->post('start');
		$length = $this->input->post('length');
		$column = $this->input->post("order")[0]["column"];
		$sortOrderAsc = $this->input->post("order")[0]["dir"];
		$sort = '';
		$type = '';
		//binding data
		$data = $this->MAdmin->binding($filter, $length, $start, $sort, $type);
		//count data
		$count = $this->MAdmin->count($filter);
		$json['data'] = $data;
		$json['draw'] = $this->input->post('draw');
		$json['iTotalRecords'] = $count;
		$json['iTotalDisplayRecords'] = $count;
		$json['$sortOrderAsc'] = $sortOrderAsc;
		$json['$column'] = $column;
		echo json_encode($json);
	}
	public function create()
	{
		$data["title_page"] = $this->lang->line('title_admin');
		$this->template("/admin/create", $data);
	}

	public function validate()
	{
		$email = $this->input->post("email");
		$json = array('message' => array(), 'success' => true);
		$users = $this->MAdmin->getByEmail($email);
		if ($users) {
			$json["message"] = array(sprintf($this->lang->line("response_already_exist"), $this->lang->line("label_email")));
			$json["success"] = false;
			echo json_encode($json);
			return false;
		}
		echo json_encode($json);
	}

	public function doCreate()
	{
		try {
			$user["first_name"] = $this->input->post('first_name');
			$user["last_name"] = $this->input->post('last_name');
			$user["email"] = $this->input->post('email');
			$user["handphone"] = $this->input->post('no_hp');
			$admin = $this->session->userdata("admin");
			$user["created_by"] = $admin["id"];
			$user["created_at"] = date('Y-m-d H:i:s');
			$user["is_active"] = true;
			$password = strtoupper(chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)));
			$user["password"] = password_hash($password, PASSWORD_DEFAULT);
			if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
				$user['image'] = date("Y_m_d_H_i_s");
				$config['file_name'] = $user['image'];
				$config['upload_path'] = PATH_IMAGE_ADMIN;
				$config['allowed_types'] = 'jpg|jpeg|png';
				$this->load->library('upload');
				$this->upload->initialize($config);
				if (!file_exists(PATH_IMAGE_ADMIN)) {
					mkdir(PATH_IMAGE_ADMIN, 0777, true);
				}
				if (!$this->upload->do_upload('image')) {
					// upload failed
					$this->session->set_flashdata('messageError', $this->lang->line("response_failed_upload"));
					redirect('admin/list-admin/create');
				}
				$user['image'] = $this->upload->data()['file_name'];
			}
			$id = $this->MAdmin->save(0, $user);
			if ($id) {
				$this->load->library('mail');
				$dataMail["name"] = $user["first_name"];
				$dataMail["email"] = $user["email"];
				$dataMail["password"] = $password;
				$template = $this->load->view("mail/send-password", array("data" => $dataMail), true);
				$mail = $this->mail->send_mail($user["email"], $this->lang->line("subject_mail_welcome"), $template);
				if (!$mail['success']) {
					// email gagal
					$this->session->set_flashdata('messageError', $this->lang->line("response_failed"));
					redirect('admin/list-admin/create');
				} else {
					redirect('admin/list-admin');
				}
			} else {
				show_error("Error create admin");
			}
		} catch (Exception $e) {
			show_error("Error in try catch in " . __LINE__);
		}
	}
	public function detail()
	{
		$id = $this->input->get('id');
		$users = $this->MAdmin->getById($id);
		if ($users != null && $id != null) {
			$data["title_page"] = $this->lang->line('title_admin');
			$data["users"] = $users;
			$this->template("/admin/detail", $data);
		} else {
			show_404();
		}
	}
	public function update()
	{
		$id = $this->input->get('id');
		$users = $this->MAdmin->getById($id);
		if ($users != null && $id != null) {
			$data["title_page"] = $this->lang->line('title_admin');
			$data["users"] = $users;
			$this->template("/admin/update", $data);
		} else {
			show_404();
		}
	}
	public function validateUpdate()
	{
		$email = $this->input->post("email");
		$id = $this->input->post("id");
		$json = array('message' => array(), 'success' => true);
		$users = $this->MAdmin->getByEmail($email);
		if ($users != null && $users->id != $id) {
			$json["message"] = array(sprintf($this->lang->line("response_already_exist"), $this->lang->line("label_email")));
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
			$user["first_name"] = $this->input->post('first_name');
			$user["last_name"] = $this->input->post('last_name');
			$user["email"] = $this->input->post('email');
			$user["handphone"] = $this->input->post('no_hp');
			$admin = $this->session->userdata("admin");
			$user["updated_by"] = $admin["id"];
			$user["updated_at"] = date('Y-m-d H:i:s');
			if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
				$users = $this->MAdmin->getById($id);
				if (file_exists(PATH_IMAGE_ADMIN . $users->image) && $users->image != "") {
					unlink(PATH_IMAGE_ADMIN . $users->image);
				}
				$user['image'] = date("Y_m_d_H_i_s");
				$config['file_name'] = $user['image'];
				$config['upload_path'] = PATH_IMAGE_ADMIN;
				$config['allowed_types'] = 'jpg|jpeg|png';
				$this->load->library('upload');
				$this->upload->initialize($config);
				if (!file_exists(PATH_IMAGE_ADMIN)) {
					mkdir(PATH_IMAGE_ADMIN, 0777, true);
				}
				if (!$this->upload->do_upload('image')) {
					// upload failed
					$this->session->set_flashdata('messageError', $this->lang->line("response_failed_upload"));
					redirect('admin/list-admin/update?id=' . $id);
				}
				$user['image'] = $this->upload->data()['file_name'];
			}
			$id = $this->MAdmin->save($id, $user);
			if ($id) {
				redirect('admin/list-admin');
			} else {
				show_error("Error update admin");
			}
		} catch (Exception $e) {
			show_error("Error in try catch in " . __LINE__);
		}
	}
	public function deleteData()
	{
		$id = $this->input->post("id");
		$val = $this->input->post("val") == "true" ? true : false; 
		$admin = $this->session->userdata("admin");
		$user["updated_by"] = $admin["id"];
		$user["is_active"] = $val;
		$user["updated_at"] = date('Y-m-d H:i:s');
		$id = $this->MAdmin->save($id, $user);
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
		$this->MAdmin->deleteByID($id);
		redirect('admin/list-admin');
	}
}
