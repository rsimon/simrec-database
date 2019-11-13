<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	function __construct() {
	  parent::__construct();
		$this->load->database();
	}

	public function index() {
		$this->load->view('welcome_message');
	}

	public function route($id) {
		$query = $this->db->query('SELECT * FROM route WHERE id = ?', array($id));
		$this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($query->result()));
  }

}
