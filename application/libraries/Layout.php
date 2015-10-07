<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Layout
{

    var $obj;
    var $layout;

    function __construct()
    {
        $this->obj =& get_instance();
        $this->layout = 'layout_main';
    }

    function setLayout($layout)
    {
      $this->layout = $layout;
    }

    function view($view='', $data = null, $return=false)
    {
        if ( is_array($data) ) {
            $loadedData = $data;
        } else {
            $loadedData = array();
        }
        
        if ( !empty($view) ) {
            $loadedData['_content_for_layout'] = $this->obj->load->view($view, $loadedData, true);
        } else {
            $loadedData['_content_for_layout'] = '';
        }
        
        if ($return) {
            $output = $this->obj->load->view('layouts/' . $this->layout, $loadedData, true);
            return $output;
        } else {
            $this->obj->load->view('layouts/' . $this->layout, $loadedData, false);
        }
    }
}
