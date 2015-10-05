<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

	public function projects() {
		$page=$this->input->get('page',1);
		$category=$this->input->get('category','all');
		$order=$this->input->get('order','date');


		$page_size = 12;
		$page--;
		
		if ($category!='all') {
			$categories = $this->get_subcategories($category, 'plain');
			$category_ids = array($category);
			foreach($categories AS $Category) {
				$category_ids[] = $Category->id_category;
			}
		}
		
		$this->db->select('project.id_project')->distinct()
			->from('project')->where('active', 'yes');
		if ($category!='all') {
			$this->db->join('project_category AS PC','project.id_project=PC.id_project')
			->where_in('PC.id_category', $category_ids);
		}
		$query = $this->db->get();
		$project_ids=array();
		foreach ($query->result() as $project) {
			$project_ids[] = $project->id_project;
		}
		$total_rows = count($project_ids);
		$total_pages = ceil($total_rows/$page_size);
		
		$this->db->select('project.*')->distinct()
			->from('project')->where('active', 'yes')
			->limit($page_size, $page*$page_size);
		
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
		foreach ($query->result() as $project)
		{
			$thumbnails = array();
			
			/** Get videos **/
			$this->db->select('*')->from('video')
				 ->where('id_project',$project->id_project)
				 ->order_by('order', 'ASC');
			$videos_query = $this->db->get();
			foreach ($videos_query->result() as $video_data) {
				$thumbnails[] = array('thumbnail'=> $video_data->thumbnail, 'type'=>'video');
			}

			/** Get Images **/
			$this->db->select('*')->from('image')
				 ->where('id_project',$project->id_project)
				 ->order_by('order', 'ASC');
			$images_query = $this->db->get();
			foreach ($images_query->result() as $image_data) {
				$path_parts = pathinfo($image_data->url);
				$basename = basename($path_parts['basename'],".{$path_parts['extension']}");
				$thumbnails[] = array('thumbnail'=> $basename."-thumb.jpg", 'type'=>'image');
			}
						
			$project->thumbnails = $thumbnails;
			$projects[] = $project;
		}

		$page++;
		$data = array('page'=>$page, 'total_rows'=>$total_rows, 'total_pages'=>$total_pages, 'projects'=>$projects);
		$this->render($data);
	}

	public function images($id_project)
	{
		$this->db
		->select('*')
		->from('image')
		->where('id_project',$id_project)
		->order_by('order', 'ASC');
		$query = $this->db->get();
		$data = array();
		foreach ($query->result() as $row)
		{
			$data[] = $row;
		}
		$this->render($data);
	}

	private function render($data){
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
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