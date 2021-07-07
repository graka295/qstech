<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model("Model_admin", "MAdmin");
	}
	public function index()
	{
		$admin = $this->session->userdata("admin");
		if ($admin != null && $admin['level'] == "admin") {
			redirect("admin/dashboard");
		} else {
			$this->load->view("auth/login");
		}
	}
	public function validate()
	{
		$email = $this->input->post("email");
		$password = $this->input->post("password");
		$json = array('message' => array(), 'success' => true);
		$users = $this->MAdmin->getByEmail($email);
		if (!$users) {
			$json["message"] = array(sprintf($this->lang->line("response_not_found"), $this->lang->line("label_email")));
			$json["success"] = false;
			echo json_encode($json);
			return false;
		}
		if (!password_verify($password, $users->password)) {
			$json["message"] = array($this->lang->line("response_wrong_password"));
			$json["success"] = false;
			echo json_encode($json);
			return false;
		}
		echo json_encode($json);
	}
	public function forgotPassword()
	{
		$email = $this->input->post("email");
		$json = array('message' => array($this->lang->line("response_success_forgot_password")), 'success' => true);
		$users = $this->MAdmin->getByEmail($email);
		if (!$users) {
			$json["message"] = array(sprintf($this->lang->line("response_not_found"), $this->lang->line("label_email")));
			$json["success"] = false;
			echo json_encode($json);
			return false;
		}
		$password = strtoupper(chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)));
		$data["password"] = password_hash($password, PASSWORD_DEFAULT);
		$id = $this->MAdmin->save($users->id, $data);
		if (!$id) {
			$json["message"] = array($this->lang->line("response_failed"));
			$json["success"] = false;
			echo json_encode($json);
			return false;
		}

		$dataMail["name"] = $users->first_name;
		$dataMail["email"] = $users->email;
		$dataMail["password"] = $password;
		$template = $this->load->view("mail/forgot-password", array("data" => $dataMail), true);
		$mail = $this->mail->send_mail($email, $this->lang->line("subject_mail_forgot_password"), $template);
		if (!$mail['success']) {
			// email gagal
			$json["message"] = array($mail['message']);
			$json["success"] = false;
			echo json_encode($json);
			return false;
		}
		echo json_encode($json);
	}
	public function login()
	{
		$email = $this->input->post("email");
		$users = $this->MAdmin->getByEmail($email);
		if (!$users) {
			show_404();
		}
		$dataUser = array(
			'email'     => $email,
			'first_name'     => $users->first_name,
			'last_name'     => $users->last_name,
			'id'     => $users->id,
			'level'     => 'admin',
		);
		$this->session->set_userdata('admin', $dataUser);
		redirect("admin/dashboard");
	}
	public function logout()
	{
		$this->session->unset_userdata('admin');
		redirect("admin");
	}
	public function showforgotPassword()
	{
		$this->load->view("auth/forgot-password");
	}
}
