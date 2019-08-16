<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Main extends CI_Controller {
 
    function __construct()
    {
        parent::__construct();
 
        $this->load->database();

        $this->load->library('grocery_CRUD');
    }
 
    public function index()
    {
        echo "<h1>Welcome to the world of Codeigniter</h1>";//Just an example to ensure that we get into the function
        die();
    }

    public function route()
    {
        $crud = new grocery_CRUD();
        $crud->set_table('route');
        $output = $crud->render();
        
        $this->_example_output($output);
    }

    function _example_output($output = null)
    {
      $this->load->view('crud_template.php', $output);
    }
}
 
/* End of file Main.php */
/* Location: ./application/controllers/Main.php */