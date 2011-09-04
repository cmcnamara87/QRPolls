<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Poll extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
	}
	
	public function view($poll_id = "") {
		if($poll_id == "") {
			echo "ERROR: NO POLL FOUND";
			die();
		}
		
		$this->load->model('poll_model');
		
		$this->load->view('poll_view', array(
			'poll' => $this->poll_model->get_poll($poll_id)
		));
	}
	
	public function vote($poll_id = "", $salt = "", $qrcode_id = "") {
		if($poll_id == ""){
			echo "ERROR: NO POLL FOUND";
			die();
		} elseif($salt == "") {
			echo "ERROR: NO OPTION FOUND";
			die();
		} elseif($qrcode_id == "") {
			echo "ERROR: NO OPTION FOUND";
			die();
		}
		$this->load->model('Poll_model');
		$verify = $this->Poll_model->verify_salt($qrcode_id, $salt);
		if(!$verify){
			echo "ERROR: VOTE DID NOT VALIDATE";
			die();
		}
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */