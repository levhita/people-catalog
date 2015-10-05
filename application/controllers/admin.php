<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	private $cookie = 'kldpditrnyosenflsjks';
	private $valid  = 'mcjudjdfopsjekenj';
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->library('grocery_CRUD');
		$this->load->library('session');
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
		if ($this->session->userdata($this->cookie) && ($this->session->userdata($this->cookie) == $this->valid)) {
			return true;
		}
		return false;
	}
	public function validate()
	{
		if ($this->logged_in()) {
			redirect('/admin/categories', 'refresh');
		}
		
		$password_hash = $this->configurations->get('admin_password');
		$password = $this->input->post('password');
		
		if ( md5($password)==$password_hash ) {
			$this->session->set_userdata($this->cookie, $this->valid);
			redirect('/admin/categories', 'refresh');	
		} else {
			redirect('/admin/login', 'refresh');	
		}
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
		redirect('/admin/categories', 'refresh');
	}
	
	public function categories()
	{
		$this->check_session();

		$this->grocery_crud->set_table('category')
		->columns('id_parent_category', 'name')
		->display_as('id_parent_category','Parent')
		->set_subject('Category')
		->required_fields('name')
		->set_relation('id_parent_category','category','name');
		$output = $this->grocery_crud->render();
		
		$this->layout->view('admin/default', $output);
	}

	public function projects()
	{
		$this->check_session();
		
		$this->grocery_crud->set_table('project')
		->columns('name', 'description', 'active')
		->set_subject('Project')
		->required_fields('name', 'description', 'active')
		->set_relation_n_n('categories', 'project_category', 'category', 'id_project', 'id_category', 'name');
		$output = $this->grocery_crud->render();
		
		$this->layout->view('admin/default', $output);
	}

	public function images()
	{
		$this->check_session();

		$this->output->set_header("HTTP/1.1 200 OK");
		$this->grocery_crud->set_table('image')
		->display_as('id_project','Project')
		->set_subject('Image')
		->required_fields('id_project', 'url')
		->set_relation('id_project','project','name')
		->set_field_upload('url','project_uploads/')
		->order_by('id_project, order');
		
		$this->grocery_crud->callback_after_upload(array($this,'create_thumbnails'));

		$output = $this->grocery_crud->render();
		
		$this->layout->view('admin/default', $output);
	}
	
	public function create_thumbnails($uploader_response, $field_info, $files_to_upload)
	{
		$this->load->library('image_moo');
		$file_uploaded = $field_info->upload_path.'/'.$uploader_response[0]->name; 
		
		$path_parts = pathinfo($file_uploaded);
		$basename = basename($path_parts['basename'],".{$path_parts['extension']}");
		
		//Thumbnail
		$this->image_moo->load($file_uploaded)->resize_crop(730,483)->set_jpeg_quality(90)->save($field_info->upload_path.'/'.$basename."-thumb.jpg", true);
		$this->image_moo->load($file_uploaded)->resize_crop(214,141)->set_jpeg_quality(100)->save($field_info->upload_path.'/'.$basename."-mini-thumb.jpg", true);

		// Fullsize
		//$this->image_moo->load($file_uploaded)->resize_crop(1400,927)->save($file_uploaded, true);
		// 1920*1271
		return true;
	}
	
	public function video_thumbnails($uploader_response, $field_info, $files_to_upload)
	{
		$this->load->library('image_moo');
		$file_uploaded = $field_info->upload_path.'/'.$uploader_response[0]->name; 
		
		$path_parts = pathinfo($file_uploaded);
		$basename = basename($path_parts['basename'],".{$path_parts['extension']}");
		
		// Small Thumbnail
		$this->image_moo->load($file_uploaded)->resize_crop(214,141)->set_jpeg_quality(100)->save($field_info->upload_path.'/'.$basename."-mini-thumb.jpg", true);

		// Big Thumbnail
		//$this->image_moo->load($file_uploaded)->resize_crop(730,483)->set_jpeg_quality(100)->save($file_uploaded, true);
		return true;
	}

	public function videos()
	{
		$this->check_session();

		$this->grocery_crud->set_table('video')
		->display_as('id_project','Project')
		->set_subject('Video')
		->required_fields('id_project', 'video_id', 'thumbnail')
		->set_relation('id_project','project','name')
		->set_field_upload('thumbnail','project_uploads/')
		->order_by('id_project, order');
		
		$this->grocery_crud->callback_after_upload(array($this,'video_thumbnails'));
		
		$output = $this->grocery_crud->render();
		
		$this->layout->view('admin/videos', $output);
	}

	public function assets()
	{
		$this->check_session();

		$this->grocery_crud->set_table('asset')
		->set_subject('Asset')
		->required_fields('name', 'url')
		->set_field_upload('url','asset_uploads/');
		$output = $this->grocery_crud->render();
		
		$this->layout->view('admin/default', $output);
	}

	public function configurations()
	{
		$this->check_session();

		$this->grocery_crud->set_table('configuration')
		->set_subject('Configuration')
		->required_fields('name', 'value');
		$output = $this->grocery_crud->render();
		
		$this->layout->view('admin/default', $output);
	}
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */

