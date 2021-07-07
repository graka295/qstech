<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends ADMIN_Controller
{
	function __construct()
	{
		parent::__construct();
	}
	public function profile()
	{
		$data["title_page"] = $this->lang->line('title_profile');
		$this->template("/user/profile", $data);
	}
	public function changePassword()
	{
		$data["title_page"] = $this->lang->line('title_password');
		$this->template("/user/change-password", $data);
	}
	public function validateChangePassword(){
		$id = $this->input->post("id");
		$currentPassword = $this->input->post("current_password");
		$newPassword= $this->input->post("new_password");
		$confirmPassword= $this->input->post("confirm_password");
		$json = array('message' => array(), 'success' => true);
		if($newPassword != $confirmPassword){
			$json["message"] = $this->lang->line("response_confirm_password_wrong");
			$json["success"] = false;
			echo json_encode($json);
			return false;			
		}
		$users = $this->MAdmin->getById($id);
		if (!$users) {
			$json["message"] = array(sprintf($this->lang->line("response_not_found"), "Account"));
			$json["success"] = false;
			echo json_encode($json);
			return false;
		}
		if (!password_verify($currentPassword, $users->password)) {
			$json["message"] = array($this->lang->line("response_wrong_password"));
			$json["success"] = false;
			echo json_encode($json);
			return false;
		}
		echo json_encode($json);
	}
	public function doChangePassword()
	{
		try {
			$newPassword= $this->input->post("new_password");
			$admin = $this->session->userdata("admin");
			$user["updated_by"] = $admin["id"];
			$user["updated_at"] = date('Y-m-d H:i:s');			
			$user["password"] = password_hash($newPassword, PASSWORD_DEFAULT);
			$id = $this->MAdmin->save($admin["id"],$user);
			if ($id) {
				redirect("admin/auth/logout");
			} else {
				show_error("Error update admin");
			}
		} catch (Exception $e) {
			show_error("Error in try catch in " . __LINE__);
		}
	}
	public function editProfile()
	{
		$data["title_page"] = $this->lang->line('title_edit_profile');
		$this->template("/user/edit-profile", $data);
	}
	public function validateEditProfile()
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
	public function doEditProfile(){
		try {
			$user["first_name"] = $this->input->post('first_name');
			$user["last_name"] = $this->input->post('last_name');
			$user["email"] = $this->input->post('email');
			$user["handphone"] = $this->input->post('no_hp');
			$admin = $this->session->userdata("admin");
			$user["updated_by"] = $admin["id"];
			$user["updated_at"] = date('Y-m-d H:i:s');
			if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
				$users = $this->MAdmin->getById($admin["id"]);
				if (file_exists(PATH_IMAGE_ADMIN.$users->image) && $users->image != "") {
					unlink(PATH_IMAGE_ADMIN.$users->image);
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
					redirect('admin/user/edit-profile');
				}
				$user['image'] = $this->upload->data()['file_name'];
			}
			$id = $this->MAdmin->save($admin["id"],$user);
			if ($id) {
				redirect('admin/user/profile');
			} else {
				show_error("Error update admin");
			}
		} catch (Exception $e) {
			show_error("Error in try catch in " . __LINE__);
		}
	}
}