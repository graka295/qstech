<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Suggestions extends MX_Controller
{
    function __construct()
    {
        $this->load->model("Model_suggestions", "MSuggestions");
    }
    public function index()
    {
        $this->load->view("suggestions/index", null);
    }
    public function doSuggestions()
    {
        $data["name"] = $this->input->post("name");
        $data["title"] = $this->input->post("title");
        $data["value"] = $this->input->post("desc");
        $data["created_at"] = date("Y-m-d H:i:s");
        $this->MSuggestions->save(0, $data);
        $json = array('message' => array(), 'success' => true);
        echo json_encode($json);
    }
}
