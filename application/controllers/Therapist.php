<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Therapist extends CI_Controller {

	public function __construct()
    {
        parent:: __construct();

        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('session');

        $this->load->library('grocery_CRUD');
    }

    public function therapist_output($output = null)
    {
        $this->load->helper('form');

        $data['output'] = $output;
        $data['main_content'] = 'site/therapist_view';
        $data['user'] = $this->session->userdata('username');
        $data['al'] = $this->session->userdata('al');
        $this->load->view('includes/template', $data);
    }

	// Staff table is called frome here
    public function therapist()
    {
        // Loading view home page views, Grocery CRUD Standard Library
       // $this->load->view('templates/header');

        $crud = new grocery_CRUD();

        $crud->set_theme('flexigrid');

        //table name exact from database
        $crud->set_table('therapist');
        	        //give focus on name used for operations e.g. Add Order, Delete Order
        $crud->set_subject('Therapist'); 
        $crud->columns('staffNo', 'phoneNo', 'roomNo', 'managerNo', 'enabled');
        	        //change column heading name for readability ('columm name', 'name to display in frontend column header')
        $crud->display_as('staffNo', 'Staff ID Number')
            ->display_as('phoneNo', 'Phone Number')
            ->display_as('roomNo', 'Room Number')
            ->display_as('maanagerNo', 'Manager ID Number');

        $crud->unset_columns('enabled'); //Remove enabled from view, enabled is only used when disabling data instead of deleting
        $crud->callback_column('enabled', 'Y'); //Insert default value Y when adding new Therapist details

        $crud->fields('staffNo', 'phoneNo', 'roomNo', 'managerNo');

        //form validation (could match database columns set to "not null")
        $crud->required_fields('staffNo', 'phoneNo', 'roomNo', 'managerNo', 'enabled');
        
        $output = $crud->render();

		$this->therapist_output($output);
    }

}
?>