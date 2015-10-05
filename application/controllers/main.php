<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	private $template_data = array();
	function __construct()
	{
		parent::__construct();
		$this->template_data['_css_files'] = array();
		$this->template_data['_js_files'] = array();
		$this->template_data['_title'] = 'Neurona Creativa';
		$this->template_data['_categories'] = $this->get_categories();
		$this->template_data['_fluid'] = false;
		$this->layout->setLayout('layout_main');
	}

	public function index()
	{
		$cover = rand(1,$this->configurations->get('home_covers'));
		$data=array(
			'home_cover_static'=>$this->assets->get('home_cover_static_'.$cover),
			'home_cover_webm'=>$this->assets->get('home_cover_webm_'.$cover),
			'home_cover_mp4'=>$this->assets->get('home_cover_mp4_'.$cover),
		);
		$this->layout->setLayout('layout_home');
		$this->add_js_file('/js/home.js');
		$this->render('main/home', $data);
	}

	public function servicios()
	{
		
		$data = array('header_services'=>$this->assets->get('header_services'));

		$this->add_js_file('/js/services.js');
		$this->set_title('Servicios');
		$this->set_section('servicios');
		$this->set_fluid(true);
		$this->render('main/servicios', $data);
	}
	
	public function como()
	{
		$this->set_title('¿Cómo lo Hacemos?');
		$this->set_section('como');
		$this->add_css_file('/css/how.css');
		$this->set_fluid(true);
		$this->render('main/como');
	}

	public function proyecto($short_url)
	{
		/** Get Project Data **/
		$this->db->select('*')->from('project')
		->where('short_url',$short_url)->limit(1);
		$query = $this->db->get();
		$project = $query->row();
		$this->set_section('proyectos');
		$this->set_title('Projecto: ' .  $project->name);
		
		/** Get Images **/
		$this->db->select('*')->from('image')
		  ->where('id_project',$project->id_project)
		  ->order_by('order', 'ASC');
		$images_query = $this->db->get();
		$images = array();
		foreach ($images_query->result() as $image_data) {
			$images[] = $image_data;
		}
		$project->images = $images;
		
		/** Get videos **/
		$this->db->select('*')->from('video')
		->where('id_project', $project->id_project)
		->order_by('order', 'ASC');
		$videos_query = $this->db->get();
		$videos = array();
		foreach ($videos_query->result() as $video_data) {
			$videos[] = $video_data;
		}
		$project->videos = $videos;

		/** Get Categories **/
		$this->db->select('C.name, C.id_category')->from('category AS C')
		->join('project_category AS PC', 'PC.id_category=C.id_category')
		->where('PC.id_project', $project->id_project);
		$categories_query = $this->db->get();
		$categories = array();
		foreach ($categories_query->result() as $category_data) {
			$categories[] = (object)array('name'=>$category_data->name, 'id_category'=>$category_data->id_category);
		}
		$project->categories = $categories;
		
		$this->add_js_file('/js/jquery-migrate-1.2.1.min.js');
		$this->add_js_file('/slick/slick.js');
		$this->add_css_file('/slick/slick.css');
		$this->add_css_file('/slick/slick-theme.css');
		$this->add_js_file('/js/project.js');
		$this->add_css_file('/css/project.css');
		$this->set_fluid(true);
		
		$category = ($val=$this->input->get('category',true))?$val:'all';
		$order    = ($val=$this->input->get('order',true))?$val:'time';

		$next_prev = $this->nextPrevious($project->id_project, $category, $order);
		$prev_link = $next_prev['prev']."?category=".$category."&order=".$order;
		$next_link = $next_prev['next']."?category=".$category."&order=".$order;
		
		$this->render('main/proyecto', array('project'=>$project, 'prev_link'=>$prev_link, 'next_link'=>$next_link));

	}

	public function proyectos()
	{
		$this->add_js_file('/js/jquery-migrate-1.2.1.min.js');
		$this->add_js_file('/slick/slick.js');
		$this->add_css_file('/slick/slick.css');
		$this->add_css_file('/slick/slick-theme.css');
		$this->add_css_file('/css/projects.css');
		$this->add_js_file('/js/projects.js');
		$this->add_js_file('/js/handlebars.js');
		$this->add_js_file('/js/jquery.ba-bbq.min.js');
		
		$this->set_title('Proyectos');
		$this->set_section('proyectos');
		$this->set_fluid(true);
		$this->render('main/proyectos');
	}

	public function contacto()
	{
		/** move all config to email config and app config **/
		$this->load->library('form_validation');
		
		$data = array('success'=>false);

		if( count($_POST) && empty($_POST['interest']) ){
			$error = false;
			if(empty($_POST['name'])){
				$error = true;
				$data['name_error'] = true;
			}
			if(empty($_POST['email'])){
				$error = true;
				$data['email_error'] = true;
			}
			if(empty($_POST['message'])){
				$error = true;
				$data['message_error'] = true;
			}
			if ($error) {
				$data['name'] = $_POST['name'];
				$data['email'] = $_POST['email'];
				$data['phone'] = $_POST['phone'];
				$data['company'] = $_POST['company'];
				$data['message'] = $_POST['message'];
			
				$data['success'] = 'warning';
			} else {
				$config = Array(
					'protocol'  => 'smtp',
					'smtp_host' => $this->configurations->get('smtp_host'), //'ssl://smtp.googlemail.com',
					'smtp_port' => $this->configurations->get('smtp_port'), //'465',
					'smtp_user' => $this->configurations->get('smtp_user'), //'argel.arias@levhita.net',
					'smtp_pass' => $this->configurations->get('smtp_pass'), //'',
					'mailtype'  => 'text',
					'starttls'  => true,
					'newline'   => "\r\n"
					);

				$this->load->library('email',$config);
				$this->form_validation->set_rules('name', 'Name', 'trim|xss_clean|prep_for_form');
				$this->form_validation->set_rules('email', 'Email Address', 'trim|xss_clean|prep_for_form');
				$this->form_validation->set_rules('phone', 'Telephone', 'trim|xss_clean|prep_for_form');
				$this->form_validation->set_rules('message', 'Message', 'trim|xss_clean|prep_for_form');
				$this->form_validation->set_rules('company', 'Company', 'trim|xss_clean|prep_for_form');
				if ($this->form_validation->run() == true) {
					$this->email->from($config['smtp_user'], "Contacto Neurona Creativa");
					$this->email->to($this->configurations->get('contact_email'));
					$this->email->reply_to($_POST['email'], $_POST['name']);
					$this->email->subject('Contacto Sitio Web Neurona Creativa');

					$this->email->message(
						"Nombre: {$_POST["name"]}\r\n"
						. "Email: {$_POST["email"]}\r\n"
						. "Teléfono: {$_POST["phone"]}\r\n"
						. "Compañia: {$_POST["company"]}\r\n"
						. "\r\n------------------Inicio de Mensaje-----------------\r\n{$_POST["message"]}\r\n-------------------Fin de Mensaje-------------------"
						);
					if($this->email->send() ) {
						$data['success'] = 'success';
					} else {
						$data['name'] = $_POST['name'];
						$data['email'] = $_POST['email'];
						$data['phone'] = $_POST['phone'];
						$data['company'] = $_POST['company'];
						$data['message'] = $_POST['message'];
										
						$data['success'] = 'error';
					}
				} else {
					$data['success'] = 'warning';
				}   
			}
		}

		$this->set_title('Contacto');
		$this->set_section('contacto');
		$this->add_js_file('/js/contact.js');
		$this->render('main/contacto', $data);
	}

	private function add_js_file($file) {
		$this->template_data['_js_files'][] = $file;
	}

	private function add_css_file($file) {
		$this->template_data['_css_files'][] = $file;
	}

	private function set_title($title){
		$this->template_data['_title'] = $this->template_data['_title'] . " : " . $title;
	}
	private function set_fluid($fluid){
		$this->template_data['_fluid'] = $fluid;
	}

	private function set_section($section){
		$this->template_data['_section'] = $section;
	}
	
	private function render($template, $data=''){
		

		$footer_texts = array();
		$footer_texts_count = $this->configurations->get('footer_texts');
		for ($i=1;$i<=$footer_texts_count;$i++) {
			$footer_texts[] = $this->configurations->get('footer_text_'.$i);
		}
		$this->template_data['_footer_texts'] = $footer_texts;

		if (is_array($data)) {
			$this->template_data = array_merge($this->template_data, $data);
		}
		
		$this->layout->view($template, $this->template_data);
	}
	private function get_categories() {
		$this->db->select('C.*')->from('category AS C')
		->where('C.id_parent_category', null);
		$categories_query = $this->db->get();
		$categories = array();
		foreach ($categories_query->result() as $category) {
			$category->sub_categories = $this->Category_model->get_subcategories($category->id_category);
			$categories[] = $category;
		}
		return $categories;
	}

	private function nextPrevious($current_id, $category, $order) {
		
		if ($category!='all') {
			$categories = $this->get_subcategories($category, 'plain');
			$category_ids = array($category);
			foreach($categories AS $Category) {
				$category_ids[] = $Category->id_category;
			}
		}
		
		$this->db->select('project.*')->distinct()
			->from('project')->where('active', 'yes');

		if ($category!='all') {
			$this->db->join('project_category AS PC','project.id_project=PC.id_project')
			->where_in('PC.id_category', $category_ids);
		}

		if ($order=='abc') {
			$this->db->order_by('name', 'ASC');
		} else {
			$this->db->order_by('date', 'DESC');
		}

		$query = $this->db->get();
		
		$projects = array();
		foreach ($query->result() as $project) {
			$projects[] = $project;
		}
		$prev=''; $next='';
		if (count($projects)>1) {
			for($i=0; $i<count($projects); $i++){
				if($projects[$i]->id_project==$current_id){
					
					if ($i==0) {
						$prev = $projects[count($projects)-1]->short_url;
						$next = $projects[$i+1]->short_url;
					} else if($i==(count($projects)-1)) {
						$prev = $projects[$i-1]->short_url;
						$next = $projects[0]->short_url;
					} else {
						$prev = $projects[$i-1]->short_url;
						$next = $projects[$i+1]->short_url;
					}
				}
			}
		} else {
			$prev = $next = $projects[0]->short_url;
		}
		return array('prev'=>$prev, 'next'=>$next);
	}
	
	private function get_subcategories($id_category, $type='tree', $deep=true){
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

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
