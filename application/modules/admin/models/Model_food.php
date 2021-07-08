<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_food extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function binding($where = '', $length = 0, $start = 0, $sort, $type)
    {
        $query = "food.id as id," .
            "category_food.name as category_food," .
            "food.recommended as recommended," .
            "food.name as name," .
            "food.price as price," .
            "food.is_active as is_active";
        $this->db->select($query);
        $this->db->from("food");
        $this->db->join("category_food", "category_food.id = food.id_category");
        $this->MFood->getFilter($where);
        $this->db->order_by($sort, $type)
            ->limit($length, $start);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function count($where = '')
    {
        $this->db->from("food");
        $this->db->join("category_food", "category_food.id = food.id_category");
        $this->MFood->getFilter($where);
        return $this->db->count_all_results();
    }
    public function getFilter($where)
    {
        $this->db->where('deleted_at is null');
        if ($where != '') {
            $this->db->group_start()
                ->like('LOWER(food.name)', strtolower($where))
                ->or_like('LOWER(food.price)', strtolower($where))
                ->or_like('LOWER(category_food.name)', strtolower($where))
                ->group_end();
        }
    }
    public function getAllCategory()
    {
        $this->db->select('category_food.id as id, category_food.name as name');
        $this->db->from("category_food");
        $this->db->order_by("name", "ASC");
        $query = $this->db->get();
        return $query->result_array();
    }
    function getByName($name)
    {
        $this->db->select('*')
            ->from('food')
            ->where('LOWER(name)', strtolower($name))
            ->where('deleted_at is null');
        return $this->db->get()->row();
    }
    function insert($data, $photo)
    {
        $this->db->trans_start();
        // data product
        $this->db->insert('food', $data);
        $insert_id = $this->db->insert_id();
        // photo
        foreach ($photo as $val) {
            if (file_exists(PATH_TMP_IMAGE_PRODUCT . $val)) {
                if (!file_exists(PATH_IMAGE_PRODUCT)) {
                    mkdir(PATH_IMAGE_PRODUCT, 0777, true);
                }
                rename(PATH_TMP_IMAGE_PRODUCT . $val, PATH_IMAGE_PRODUCT . $val);
                $dataPhoto = array(
                    "id_food" => $insert_id,
                    "name" => $val,
                    "created_by" => $data["created_by"],
                    "created_at" => date('Y-m-d H:i:s')
                );
                $this->db->insert('photo_food', $dataPhoto);
            }
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return 0;
        } else {
            return 1;
        }
    }
    function save($id, $data)
    {
        if ($id != 0) {
            $this->db->trans_start();
            $this->db->where("id", $id);
            $this->db->update("food", $data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                return 0;
            } else {
                return 1;
            }
        } else {
            $this->db->insert('food', $data);
            $insert_id = $this->db->insert_id();
            return  $insert_id;
        }
    }
    public function getPhotoFood($idPhoto)
    {
        $this->db->select('photo_food.id as id,photo_food.id_food as id_food,photo_food.name as name');
        $this->db->from("photo_food");
        $this->db->where("id_food", $idPhoto);
        $this->db->order_by("id", "asc");
        $query = $this->db->get();
        return $query->result_array();
    }
    function getById($id)
    {
        $this->db->select('food.recommended,food.price as price,food.description as desc,food.id as id,food.name as name,food.id_category as id_category')
            ->from('food')
            ->where('id', $id);
        return $this->db->get()->row();
    }
    function getPhotoById($id)
    {
        $this->db->select('photo_food.id as id,photo_food.name as name')
            ->from('photo_food')
            ->where('id', $id);
        return $this->db->get()->row();
    }
    public function deletePhoto($id)
    {
        $this->db->where('id', $id);
        $this->db->delete("photo_food");
        return $this->db->affected_rows();
    }
    function savePhoto($id, $data)
    {
        if ($id != 0) {
            $this->db->trans_start();
            $this->db->where("id", $id);
            $this->db->update("photo_food", $data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                return 0;
            } else {
                return 1;
            }
        } else {
            $this->db->insert('photo_food', $data);
            $insert_id = $this->db->insert_id();
            return  $insert_id;
        }
    }
}
