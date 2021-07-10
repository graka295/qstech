<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_food extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function getAllCategory()
    {
        $this->db->select('*')
            ->from('category_food');
        $query = $this->db->get();
        return $query->result_array();
    }
    function getByFood($id)
    {
        $query = 'food.recommended,food.price as price,food.description as desc,food.id as id,food.name as name,food.id_category as id_category,';
        $query = $query . '( SELECT photo_food.name from photo_food WHERE photo_food.id_food = food.id order BY photo_food.id ASC LIMIT 1 ) as photo';
        $this->db->select($query)
            ->from('food')
            ->where('is_active', true)
            ->where('deleted_at is null')
            ->where('id_category', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
    function getById($id)
    {
        $this->db->select('food.recommended,food.price as price,food.description as desc,food.id as id,food.name as name,food.id_category as id_category')
            ->from('food')
            ->where('is_active', true)
            ->where('id', $id);
        return $this->db->get()->row();
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
}
