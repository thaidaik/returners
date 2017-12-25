<?php
class Characters_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

    /**
    * Get character by his is
    * @param int $character_id 
    * @return array
    */
    public function get_character_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('characters');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }

    /**
    * Fetch characters data from the database
    * possibility to mix search, filter and order
    * @param int $manufacuture_id 
    * @param string $search_string 
    * @param strong $order
    * @param string $order_type 
    * @param int $limit_start
    * @param int $limit_end
    * @return array
    */
    public function get_characters($manufacture_id=null, $search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
    {
	    
		$this->db->select('*');
		/* $this->db->select('characters.name');
		$this->db->select('characters.image');
		$this->db->select('characters.info');
		$this->db->select('characters.status');
		$this->db->select('manufacturers.name as manufacture_name'); */
		$this->db->from('characters');
		
		/* if($manufacture_id != null && $manufacture_id != 0){
			$this->db->where('manufacture_id', $manufacture_id);
		} */
		if($search_string){
			$this->db->like('characters.name', $search_string);
		}

		$this->db->join('stories', 'characters.id = stories.character_id', 'left');
		$this->db->group_by('characters.id');

		if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('id', $order_type);
		}
		$this->db->limit($limit_start, $limit_end);
		//$this->db->limit('4', '4');
		$query = $this->db->get();
		
		return $query->result_array(); 	
    }

    /**
    * Count the number of rows
    * @param int $manufacture_id
    * @param int $search_string
    * @param int $order
    * @return int
    */
    function count_characters($manufacture_id=null, $search_string=null, $order=null)
    {
		$this->db->select('*');
		$this->db->from('characters');
		/* if($manufacture_id != null && $manufacture_id != 0){
			$this->db->where('manufacture_id', $manufacture_id);
		} */
		if($search_string){
			$this->db->like('characters.name', $search_string);
		}
		if($order){
			$this->db->order_by($order, 'Asc');
		}else{
		    $this->db->order_by('id', 'Asc');
		}
		$query = $this->db->get();
		return $query->num_rows();        
    }

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_character($data)
    {
		$insert = $this->db->insert('characters', $data);
	    return $insert;
	}

    /**
    * Update character
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_character($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('characters', $data);
		$report = array();
		$report['error'] = $this->db->_error_number();
		$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

    /**
    * Delete character
    * @param int $id - character id
    * @return boolean
    */
	function delete_character($id){
		$this->db->where('id', $id);
		$this->db->delete('characters'); 
	}
 
}
?>	
