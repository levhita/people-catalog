<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Assets
{

    private $ci;
    
    function __construct()
    {
        // In your Contructor add this.
        $this->ci = & get_instance();    // get a reference to CodeIgniter.
    }

    function get($asset_name)
    {
        $row = $this->ci->db->select('url')
            ->get_where('asset', array('name' => $asset_name))
            ->row();
        if(!$row){
            return false;
        }
        $url =$row->url;
        if (!empty($url)) {
            return $url;
        } 
        
        return false;
    }
}
