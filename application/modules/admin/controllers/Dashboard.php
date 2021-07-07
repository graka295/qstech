<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends ADMIN_Controller {
	function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$data["title_page"] = $this->lang->line('title_auth');
		$this->template("dashboard/index", $data);
	}
}
