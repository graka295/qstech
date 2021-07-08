<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ADMIN_Controller extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model("Model_admin", "MAdmin");
		$this->load->model("Model_food", "MFood");
		$this->load->model("Model_table", "MTable");
		$this->load->model("Model_trx", "MTrx");
		$user = $this->session->userdata('admin');
		if ($user == null && $user['level'] != "admin") {
			redirect("admin/auth/logout");
		}
		$users = $this->MAdmin->getById($user["id"]);
		if (!$users) {
			redirect("admin/auth/logout");
		}
		$dataUser = array(
			'email'     => $user["email"],
			'first_name'     => $users->first_name,
			'last_name'     => $users->last_name,
			'phone_number'     => $users->handphone,
			'image'     => $users->image != "" ? base_url(PATH_IMAGE_ADMIN.$users->image):"",
			'id'     => $users->id,
			'level'     => 'admin',
		);
		$this->session->set_userdata('admin', $dataUser);
	}
	function template($content, $data = null)
	{
		$data['user'] = $this->session->userdata('admin');
		$data['_content'] = $this->load->view($content, $data, true);
		$data['_side_menu'] = $this->load->view('shared/sidebar', $data, true);
		$data['_top_menu'] = $this->load->view('shared/header', $data, true);
		$data['_bottom_menu'] = $this->load->view('shared/footer', $data, true);
		$this->load->view('shared/content', $data);
	}
}
