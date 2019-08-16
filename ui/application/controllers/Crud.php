<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud extends CI_Controller {

	function __construct() {
	  parent::__construct();
		$this->load->database();
		$this->load->library('grocery_CRUD');
	}

	public function index() {
		$this->load->view('welcome_message');
	}

	public function routes() {
		$crud = new grocery_CRUD();
		$crud->set_table('route');
		$crud->set_relation('route_type','route_type','id');

		$output = $crud->render();
		$data['title'] = 'Routes';
		$output->data = $data;

		$this->load->view('crud_template.php', $output);
	}

	public function places() {
		$crud = new grocery_CRUD();
		$crud->set_table('place');

		$output = $crud->render();
		$data['title'] = 'Places';
		$output->data = $data;

		$this->load->view('crud_template.php', $output);
	}

	public function network() {
		$crud = new grocery_CRUD();
		$crud->set_table('network_edge');
		$crud->set_relation('from_plae','place','name');
		$crud->set_relation('to_place','place','name');

		$output = $crud->render();
		$data['title'] = 'Network';
		$output->data = $data;

		$this->load->view('crud_template.php', $output);
	}

	public function named_routes() {
		$crud = new grocery_CRUD();
		$crud->set_table('named_route');
		$crud->set_relation_n_n('has_routes', 'route_is_part_of', 'route', 'named_route_id', 'route_id', 'id');

		$output = $crud->render();
		$data['title'] = 'Named Routes';
		$output->data = $data;

		$this->load->view('crud_template.php', $output);
	}

	public function bibliography() {
		$crud = new grocery_CRUD();
		$crud->set_table('bibliography');

		$output = $crud->render();
		$data['title'] = 'Bibliography';
		$output->data = $data;

		$this->load->view('crud_template.php', $output);
	}

	public function route_types() {
		$crud = new grocery_CRUD();
		$crud->set_table('route_type');

		$output = $crud->render();
		$data['title'] = 'Route Types';
		$output->data = $data;

		$this->load->view('crud_template.php', $output);
	}

}
