<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'../vendor/phayes/geophp/geoPHP.inc');

class Crud extends CI_Controller {

	function __construct() {
	  parent::__construct();
		$this->load->database();
		$this->load->library('grocery_CRUD');
	}

	// Callback functions for ID auto-generation
	function generate_id($post_array) {
		$random_id = uniqid($more_entropy = true);
		$post_array['id'] = $random_id;		
		return $post_array;
	}

	function generate_place_id($post_array) {
		$random_id = uniqid($more_entropy = true);
		$post_array['internal_place_id'] = $random_id;
		return $post_array;
	}

	// Callback function to fill bbox columns from GeoJSON
	function add_bounds($post_array) {
		$json = $post_array['geom_kml'];

		if ($json) {
			$geom = geoPHP::load($json, 'json');
			$bbox = $geom->getBBox();
			$post_array['min_lon'] = $bbox['minx'];
			$post_array['min_lat'] = $bbox['miny'];
			$post_array['max_lon'] = $bbox['maxx'];
			$post_array['max_lat'] = $bbox['maxy'];
		}

		return $post_array;
	}
	
	function add_id_and_bounds($post_array) {
		$random_id = uniqid($more_entropy = true);
		$post_array['id'] = $random_id;		
		return $this->add_bounds($post_array);
	}

	public function index() {
		$this->load->view('welcome_message');
	}

	public function routes() {
		$crud = new grocery_CRUD();

		// $crud->callback_before_insert(array($this, 'generate_id'));
		$crud->callback_before_insert(array($this, 'add_id_and_bounds'));
		$crud->callback_before_update(array($this, 'add_bounds'));

		$crud->set_table('route');

		$crud->columns([
			'id', 
			'lower_data',
			'lower_date_error',
			'upper_date',
			'upper_date_error',
			'route_type',
			'geom_kml',
			'description',
			'citation',
			'last_updated',
			'cites'
		]);
		
		$crud->field_type('id', 'invisible');
		$crud->field_type('min_lon', 'invisible');
		$crud->field_type('min_lat', 'invisible');
		$crud->field_type('max_lon', 'invisible');
		$crud->field_type('max_lat', 'invisible');
		$crud->field_type('last_updated', 'invisible');

		$crud->set_relation('route_type', 'route_type', 'id');
		$crud->set_relation_n_n('cites', 'bibliographic_citation', 'bibliography', 'route_id', 'bibliography_id', 'label');
		$crud->unset_texteditor('geom_kml', 'description', 'citation');

		$output = $crud->render();
		$data['title'] = 'Routes';
		$data['link'] = '/map';
		$output->data = $data;

		$this->load->view('crud_template.php', $output);
	}

	public function places() {
		$crud = new grocery_CRUD();

		$crud->callback_before_insert(array($this, 'generate_place_id'));

		$crud->set_table('place');

		$crud->field_type('internal_place_id', 'invisible');
		$crud->field_type('last_updated', 'invisible');

		$crud->unset_texteditor('notes');

		$output = $crud->render();
		$data['title'] = 'Places';
		$output->data = $data;

		$this->load->view('crud_template.php', $output);
	}

	public function network() {
		$crud = new grocery_CRUD();

		$crud->callback_before_insert(array($this, 'generate_id'));

		$crud->set_table('network_edge');

		$crud->field_type('id', 'invisible');
		$crud->field_type('last_updated', 'invisible');

		$crud->set_relation('route_id', 'route', 'id');
		$crud->set_relation('from_place', 'place', 'name');
		$crud->set_relation('to_place', 'place', 'name');
		$crud->unset_texteditor('notes');

		$output = $crud->render();
		$data['title'] = 'Network';
		$output->data = $data;

		$this->load->view('crud_template.php', $output);
	}

	public function named_routes() {
		$crud = new grocery_CRUD();
		
		$crud->set_table('named_route');
		$crud->callback_before_insert(array($this, 'generate_id'));

		$crud->field_type('id', 'invisible');
		$crud->field_type('last_updated', 'invisible');
		
		$crud->set_relation_n_n('has_routes', 'route_is_part_of', 'route', 'named_route_id', 'route_id', 'description');
		$crud->unset_texteditor('notes');

		$output = $crud->render();
		$data['title'] = 'Named Routes';
		$output->data = $data;

		$this->load->view('crud_template.php', $output);
	}

	public function bibliography() {
		$crud = new grocery_CRUD();
		$crud->set_table('bibliography');
		$crud->unset_texteditor('bibtex');

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
