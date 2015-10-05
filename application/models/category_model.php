<?php
class category_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_subcategories($id_category, $type='tree', $deep=true){
        $this->db->select('*')->from('category')
             ->where('id_parent_category', $id_category);
        $query = $this->db->get();
        
        $categories = array();
        foreach ($query->result() as $category) {
            if ($deep) {
                if ($type=='tree') {
                    $category->sub_categories = $this->get_subcategories($category->id_category);
                    $categories[]=$category;
                } else {
                    $categories[]=$category;
                    $sub_categories = $this->get_subcategories($category->id_category, $type);
                    foreach($sub_categories AS $sub_category){
                        $categories[]=$sub_category;
                    }
                }
            } else {
                $categories[]=$category;
            }
        }
        return $categories;
    }

}