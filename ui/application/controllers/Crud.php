<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud extends CI_Controller {

	function __construct()
	{
	  parent::__construct();

		$this->load->database();
		$this->load->library('grocery_CRUD');
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function route()
	{
		$crud = new grocery_CRUD();
		$crud->set_table('route');

		$output = $crud->render();
		$data['title'] = 'Routes';
		$output->data = $data;

		$this->load->view('crud_template.php', $output);
	}

}
