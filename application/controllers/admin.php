<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	private $cookie = 'kldpditrnyosenflsjks';
	private $valid  = 'mcjudjdfopsjekenj';
	
	function __construct()
	{
		parent::__construct();
		//$this->load->library('session');
		$this->load->library('grocery_CRUD');
		$this->layout->setLayout('layout_admin');
	}
	
	public function login(){
		if ($this->logged_in()) {
			redirect('/admin/categories', 'refresh');
		}

		if ($this->session->userdata('l')) {
			redirect('/admin/categories', 'refresh');
		}
		$this->layout->setLayout('layout_login');
		$this->layout->view('admin/login');		
	}

	private function logged_in()
	{
		return true;
		/*if ($this->session->userdata($this->cookie) && ($this->session->userdata($this->cookie) == $this->valid)) {
			return true;
		}
		return false;*/
	}
	public function validate()
	{
		/*if ($this->logged_in()) {
			redirect('/admin/categories', 'refresh');
		}
		
		$password_hash = $this->configurations->get('admin_password');
		$password = $this->input->post('password');
		
		if ( md5($password)==$password_hash ) {
			$this->session->set_userdata($this->cookie, $this->valid);
			redirect('/admin/categories', 'refresh');	
		} else {
			redirect('/admin/login', 'refresh');	
		}*/
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/', 'refresh');
	}
	
	private function check_session()
	{
		if(!$this->logged_in()) {
			redirect('/admin/login', 'refresh');
			die();
		}
	}

	public function index()
	{
		$this->check_session();
		redirect('/admin/people', 'refresh');
	}
	
	public function tags()
	{
		$this->check_session();

		$this->grocery_crud->set_table('tag')
		->columns('name')
		->set_subject('Tags')
		->required_fields('name');
		$crud_data = (array) $this->grocery_crud->render();
		
		$this->layout->view('admin/default', $crud_data);
	}

	public function people()
	{
		$this->check_session();
		$this->config->set_item('grocery_crud_file_upload_allow_file_types', 'peg|jpg|png');
		
		$this->grocery_crud->set_table('people')
		->columns('name', 'description', 'active')
		->set_subject('People')
		->required_fields('name', 'description', 'active')
		->set_field_upload('picture_url','picture_uploads/')
		->set_relation_n_n('tags', 'people_has_tag', 'tag', 'people_idpeople', 'tag_idtag', 'name');
		
		$this->grocery_crud->callback_after_upload(array($this,'create_thumbnails'));
		$this->grocery_crud->callback_after_delete(array($this,'delete_thumbnails'));

		$crud_data = (array) $this->grocery_crud->render();
		
		$this->layout->view('admin/default', $crud_data);
	}

	public function extra()
	{
		$this->check_session();
		
		$this->grocery_crud->set_table('extra')
		->columns('people_idpeople', 'age','degree')
		->display_as('people_idpeople','Name')
		->set_subject('Extra')
		->set_relation('people_idpeople', 'people', 'name');
		
		$crud_data = (array) $this->grocery_crud->render();
		
		$this->layout->view('admin/default', $crud_data);
	}

	public function contact()
	{
		$this->check_session();
		
		$this->grocery_crud->set_table('contact')
		->columns('people_idpeople', 'field','value','url', 'public')
		->display_as('people_idpeople','Name')
		->set_subject('contact')
		->set_relation('people_idpeople', 'people', 'name');
		
		$crud_data = (array) $this->grocery_crud->render();
		
		$this->layout->view('admin/default', $crud_data);
	}


	public function create_thumbnails($uploader_response, $field_info, $files_to_upload)
	{
		$this->load->library('image_moo');
		$file_uploaded = $field_info->upload_path.'/'.$uploader_response[0]->name; 
		
		$path_parts = pathinfo($file_uploaded);
		$basename = basename($path_parts['basename'],".{$path_parts['extension']}");
		
		// Thumbnail
		$this->image_moo->load($file_uploaded)->resize_crop(250,250)->set_jpeg_quality(90)->save($field_info->upload_path.'/'.$basename."-thumb.jpg", true);
		
		// Fullsize
		$this->image_moo->load($file_uploaded)->resize_crop(500,500)->set_jpeg_quality(90)->save($field_info->upload_path.'/'.$basename.'.jpg', true);
		
		// Delete original if it wasn't overwritten.
		if($path_parts['extension']!=='jpg'){
			unlink($file_uploaded);
		}
		
		return true;
	}
	
	public function delete_thumbnails($idpeople){
		$people = $this->db->where('idpeople',$idpeople)->get('people')->row();
  		
  		$path_parts = pathinfo($poeple->picture_url);
  		$basename = basename($path_parts['basename'],".{$path_parts['extension']}");
		
		$thumbnail  = 'picture_uploads/'.$basename."-thumb.jpg";
		$picture 	= 'picture_uploads/'.$basename.'.jpg';
		
		unlink($picture); unlink($thumbnail);
   
	    return true;
	}
	
	public function assets()
	{
		$this->check_session();

		$this->grocery_crud->set_table('asset')
		->set_subject('Asset')
		->required_fields('name', 'url')
		->set_field_upload('url','asset_uploads/');
		$crud_data = (array) $this->grocery_crud->render();
		
		$this->layout->view('admin/default', $crud_data);
	}

	public function configurations()
	{
		$this->check_session();

		$this->grocery_crud->set_table('configuration')
		->set_subject('Configuration')
		->required_fields('name', 'value');
		$crud_data = (array)$this->grocery_crud->render();
		
		$this->layout->view('admin/default', $crud_data);
	}
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */

