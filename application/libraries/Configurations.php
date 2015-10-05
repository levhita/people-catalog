<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Configurations
{

    private $ci;
    
    function __construct()
    {
        // In your Contructor add this.
        $this->ci = & get_instance();    // get a reference to CodeIgniter.
    }

    function get($configuration_name)
    {
        $row = $this->ci->db->select('value')
            ->get_where('configuration', array('name' => $configuration_name))
            ->row();
        if(!$row){
            return false;
        }
        $value = $row->value;
        if (!empty($value)) {
            return $value;
        }
        
        return false;
    }
}
