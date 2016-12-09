<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff extends CI_Controller {

	public function __construct()
    {
        parent:: __construct();

        $this->load->database();
        $this->load->helper('url');

        $this->load->library('grocery_CRUD');
    }

	public function view($page = 'staff_view')
  	{

    	if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php'))
    	{
      	// Whoops, we don't have a page for that!
    	  show_404();
   		}

	    $data['title'] = ucfirst($page); // Capitalize the first letter

	    $this->load->view('templates/header', $data);
    	$this->load->view('pages/'.$page, $data);
    	$this->load->view('templates/footer', $data);

  	}

    public function staff_output($output = null)
    {
        $this->load->view('pages/staff_view.php', $output);
    }

	// Staff table is called frome here
    public function staff()
    {
        // Loading view home page views, Grocery CRUD Standard Library
       // $this->load->view('templates/header');

        $crud = new grocery_CRUD();
        $crud->set_theme('flexigrid');

        //table name exact from database
        $crud->set_table('staff');
        	        //give focus on name used for operations e.g. Add Order, Delete Order
        $crud->set_subject('Staff'); 
        $crud->columns('staffNo', 'fName', 'lName', 'enabled', 'staffLogin', 'staffPassword', 'accessLevel');
        	        //change column heading name for readability ('columm name', 'name to display in frontend column header')
        $crud->display_as('staffNo', 'STAFF NO.');
        $crud->display_as('fName', 'First Name');
        $crud->display_as('lName', 'Last Name');
        $crud->display_as('enabled', 'enabled');
        $crud->display_as('staffLogin', 'Username');
        $crud->display_as('staffPassword', 'Password');
        $crud->display_as('sPosition', 'Staff Position');

        $crud->fields('staffNo', 'fName', 'lName', 'enabled', 'staffLogin', 'staffPassword', 'accessLevel');

        //form validation (could match database columns set to "not null")
        $crud->required_fields('staffNo', 'fName', 'lName', 'enabled', 'staffLogin', 'staffPassword', 'accessLevel');

        $output = $crud->render();
        $this->staff_output($output);
    }

}
