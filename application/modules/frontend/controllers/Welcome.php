<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MX_Controller {
	public function index()
	{
		redirect("admin/dashboard");
	}
}
