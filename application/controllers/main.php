<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	private $template_data = array();
	function __construct()
	{
		parent::__construct();
		$this->template_data['_css_files'] = array();
		$this->template_data['_js_files'] = array();
		$this->template_data['_title'] = $this->configurations->get('site_name');
		$this->layout->setLayout('layout_main');
	}

	public function index()
	{
		$this->set_title('Home');
		$this->set_section('home');
		$this->add_js_file('/js/home.js');
		$this->render('main/home');
	}

	public function paper_view()
	{
		$this->set_title('Paper view');
		$this->layout->setLayout('layout_paper_view');
		$this->render();
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

	private function set_section($section){
		$this->template_data['_section'] = $section;
	}
	
	private function render($template='', $data=''){
		if (is_array($data)) {
			$this->template_data = array_merge($this->template_data, $data);
		}
		$this->layout->view($template, $this->template_data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
