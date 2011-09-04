<?php
class Poll_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_poll($poll_id) {
    	// Get Out the poll
    	$this->db->select('*');
		$this->db->from('poll');
		$this->db->where('id', $poll_id);
		$query = $this->db->get();
		
		$poll = $query->result_array();
		
		$this->db->select('*');
		$this->db->from('options');
		$this->db->where('poll_id', $poll_id);
		$query = $this->db->get();
		$options = $query->result_array();
//		$poll['options'] = $options;
		
		foreach($options as &$option) {
			
		}
		
		return $poll;
    }
    
	function get_polls() {
		$this->db->select('*');
		$this->db->from('poll');
		$query = $this->db->get();
		
		$polls = $query->result_array();
		
		foreach($polls as &$poll) {
			$this->db->select('*');
			$this->db->from('options');
			$this->db->where('poll_id', $poll['id']);
			$query = $this->db->get();
			$poll['options'] = $query->result_array();
		}
		
		return $polls;
	}
	
	function verfiy_salt($qrcode_id, $salt) {
		$this->db->select("*");
		$this->db->from('qrcode');
		$this->db->where('id', $qrcode_id);
		$query = $this->db->get();
		$qrcode = $query->result_array();
		if($qrcode['salt'] == $salt) {
			return true;	
		} else {
			return false;
		}
	}

}