<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Food extends ADMIN_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $this->template("/food/index", null);
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
        $data = $this->MFood->binding($filter, $length, $start, $orderby, $sortOrderAsc);
        //count data
        $count = $this->MFood->count($filter);
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
        $data["category"] = $this->MFood->getAllCategory();
        $this->template("/food/create", $data);
    }
    public function uploadImage()
    {
        $json = array('message' => array(), 'data' => array(), 'success' => true);
        try {
            $action = $this->input->post("action");
            if ($action == "edit") {
                $image = $this->input->post("old_image");
                if (file_exists(PATH_TMP_IMAGE_PRODUCT . $image)) {
                    unlink(PATH_TMP_IMAGE_PRODUCT . $image);
                }
            }
            $randomString = strtoupper(chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)));
            $nameImage = date('YmdHis') . "_" . $randomString . ".png";
            $data = $this->input->post("image");
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            if (!file_exists(PATH_TMP_IMAGE_PRODUCT)) {
                mkdir(PATH_TMP_IMAGE_PRODUCT, 0777, true);
            }
            file_put_contents(PATH_TMP_IMAGE_PRODUCT . $nameImage, $data);
            $json["data"] = array("name_image" => $nameImage);
        } catch (Exception $e) {
            $json["message"] = array($this->lang->line("response_failed_upload"));
            $json["success"] = false;
        }
        echo json_encode($json);
    }
    public function deleteImage()
    {
        $json = array('message' => array(), 'success' => true);
        try {
            $image = $this->input->post("image");
            if (file_exists(PATH_TMP_IMAGE_PRODUCT . $image)) {
                unlink(PATH_TMP_IMAGE_PRODUCT . $image);
            }
        } catch (Exception $e) {
            $json["message"] = array($this->lang->line("response_failed_upload"));
            $json["success"] = false;
        }
        echo json_encode($json);
    }
    public function validate()
    {
        $name = $this->input->post("name");
        $json = array('message' => array(), 'success' => true);
        $users = $this->MFood->getByName($name);
        if ($users) {
            $json["message"] = array(sprintf($this->lang->line("response_already_exist"), $this->lang->line("label_name")));
            $json["success"] = false;
            echo json_encode($json);
            return false;
        }
        echo json_encode($json);
    }
    public function doCreate()
    {
        try {
            $data["name"] = $this->input->post('name');
            $data["price"] = $this->input->post('price');
            $data["id_category"] = $this->input->post('category');
            $data["description"] = $this->input->post('desc');
            $admin = $this->session->userdata("admin");
            $data["created_by"] = $admin["id"];
            $data["created_at"] = date('Y-m-d H:i:s');
            $data["is_active"] = true;
            $photo = $this->input->post("photo_product");
            $id = $this->MFood->insert($data, $photo);
            if ($id) {
                redirect('admin/food');
            } else {
                show_error("Error create food");
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
        $id = $this->MFood->save($id, $user);
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
        $id = $this->MFood->save($id, $user);
        $this->MAdmin->deleteByID($id);
        if (!$id) {
            show_error("Error delete food");
        }
        redirect('admin/food');
    }
    public function update()
    {
        $id = $this->input->get('id');
        $currentData = $this->MFood->getById($id);
        if ($currentData != null && $id != null) {
            $data["photo"] = $this->MFood->getPhotoFood($id);
            $data["category"] = $this->MFood->getAllCategory();
            $data["data"] = $currentData;
            $this->template("/food/update", $data);
        } else {
            show_404();
        }
    }
    public function editUploadImage()
    {
        $json = array('message' => array(), 'data' => array(), 'success' => true);
        try {
            $action = $this->input->post("action");
            $id_product = $this->input->post("id_product");
            $idPhoto = 0;
            $nameImage = "";
            if ($action == "edit") {
                $admin = $this->session->userdata("admin");
                $dataSave["updated_at"] = date('Y-m-d H:i:s');
                $dataSave["updated_by"] = $admin["id"];
                $dataSave["created_by"] = $admin["id"];
                $idPhoto = $this->input->post("old_image");
                $dataImage = $this->MFood->getPhotoById($idPhoto);
                if (file_exists(PATH_IMAGE_PRODUCT . $dataImage->name)) {
                    unlink(PATH_IMAGE_PRODUCT . $dataImage->name);
                }
            }
            $randomString = strtoupper(chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)));
            $nameImage = date('YmdHis') . "_" . $randomString . ".png";
            // upload photo
            $data = $this->input->post("image");
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            if (!file_exists(PATH_IMAGE_PRODUCT)) {
                mkdir(PATH_IMAGE_PRODUCT, 0777, true);
            }
            file_put_contents(PATH_IMAGE_PRODUCT . $nameImage, $data);
            // db
            $dataSave["name"] = $nameImage;
            $dataSave["id_food"] = $id_product;
            $id = $this->MFood->savePhoto($idPhoto, $dataSave);
            if ($id) {
                if ($action == "edit") {
                    $json["data"] = array("name_image" => $nameImage, "id" => $idPhoto);
                } else {
                    $json["data"] = array("name_image" => $nameImage, "id" => $id);
                }
            } else {
                $json["message"] = array($this->lang->line("response_failed_upload"));
                $json["success"] = false;
            }
        } catch (Exception $e) {
            $json["message"] = array($this->lang->line("response_failed_upload"));
            $json["success"] = false;
        }
        echo json_encode($json);
    }
    public function editDeleteImage()
    {
        $json = array('message' => array(), 'success' => true);
        try {
            $image = $this->input->post("image");
            $data = $this->MFood->getPhotoById($image);
            if ($data == null) {
                $json["message"] = array(sprintf($this->lang->line("response_not_found"), $this->lang->line("label_photo")));
                $json["success"] = false;
            } else {
                if (file_exists(PATH_IMAGE_PRODUCT . $data->name)) {
                    unlink(PATH_IMAGE_PRODUCT . $data->name);
                }
                $delete = $this->MFood->deletePhoto($image);
            }
        } catch (Exception $e) {
            $json["message"] = array($this->lang->line("response_failed_upload"));
            $json["success"] = false;
        }
        echo json_encode($json);
    }
    public function validateUpdate()
    {
        $name = $this->input->post("name");
        $id = $this->input->post("id");
        $json = array('message' => array(), 'success' => true);
        $data = $this->MFood->getByName($name);
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
            $data["name"] = $this->input->post('name');
            $data["price"] = $this->input->post('price');
            $data["description"] = $this->input->post('desc');
            $data["recommended"] = $this->input->post('recommended') != "" ? true : false;
            $data["id_category"] = $this->input->post('category');
            $admin = $this->session->userdata("admin");
            $data["updated_by"] = $admin["id"];
            $data["updated_at"] = date('Y-m-d H:i:s');
            $id = $this->MFood->save($id, $data);
            if ($id) {
                redirect('admin/food');
            } else {
                show_error("Error update food");
            }
        } catch (Exception $e) {
            show_error("Error in try catch in " . __LINE__);
        }
    }
}
