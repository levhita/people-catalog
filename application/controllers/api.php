<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

	public function people() {
		$page = $this->input->get('page',1);
		$tags = $this->input->get('tag','all');
		$order = $this->input->get('order','date');

		$page_size = 12;
		$page--;
		
		if ($tags!='all') {
			$tag_ids = $this->get_tag_ids($tags);
		}
		
		$this->db->select('people.idpeople')->distinct()
			->from('people')->where('active', 'yes');
		
		if (!empty($tag_ids)) {
			$this->db->join('people_has_tag AS PHT','people.idpeople=PHT.people_idpeople')
			->where_in('PHT.tag_idtag', $tag_ids);
		}
		
		$query = $this->db->get();
		$people_ids=array();
		foreach ($query->result() as $people) {
			$people_ids[] = $people->idpeople;
		}
		$total_rows  = count($people_ids);
		$total_pages = ceil($total_rows/$page_size);
		
		$this->db->select('people.*')->distinct()
			->from('people')->where('active', 'yes')
			->limit($page_size, $page*$page_size);
		
		if (!empty($tag_ids)) {
			$this->db->join('people_has_tag AS PHT','people.idpeople=PHT.people_idpeople')
			->where_in('PHT.tag_idtag', $tag_ids);
		}

		if ($order=='abc') {
			$this->db->order_by('name', 'ASC');
		} else {
			$this->db->order_by('date', 'DESC');
		}

		$query = $this->db->get();
		
		$people_array = array();
		foreach ($query->result() as $people)
		{
			$contacts = array();
			
			/** Get contacts **/
			$this->db->select('*')->from('contact')
				 ->where('people_idpeople',$people->idpeople)
				 ->where('public', 'yes');
			$contacts_query = $this->db->get();
			foreach ($contacts_query->result() as $contact_data) {
				$contact_data->url = ($contact_data->url=='yes')?true:false;
				$contacts[] = $contact_data;
			}

			/** Get extra **/
			$this->db->select('*')->from('extra')
				 ->where('people_idpeople',$people->idpeople)->limit(1);
			$extra_query = $this->db->get();
			$people->extra = $extra_query->row();
			
			if(!empty($people->picture_url)) {
				$path_parts = pathinfo($people->picture_url);
				$basename = basename($path_parts['basename'],".{$path_parts['extension']}");
			} else{
				$basename = 'default';
			}
			
			$people->picture_url = $basename.".jpg";
			$people->picture_thumbnail = $basename."-thumb.jpg";
			$people->contacts = $contacts;
			
			$people_array[] = $people;
		}

		$page++;
		$data = array('page'=>$page, 'total_rows'=>$total_rows, 'total_pages'=>$total_pages, 'people'=>$people_array);
		$this->render($data);
	}

	private function get_tag_ids($tags){
		$tag_names = explode(',',$tags);
		for($i=0;$i<count($tag_names);$i++){
			$tag_names[$i]=trim($tag_names[$i]);
		}
		$this->db->select('idtag')->from('tag')
			 ->where_in('name', $tag_names);
		$query = $this->db->get();
		
		$tag_ids = array();
		foreach ($query->result() as $tag) {
			$tag_ids[]=$tag->idtag;
		}
		return $tag_ids;
	}

	private function render($data){
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */