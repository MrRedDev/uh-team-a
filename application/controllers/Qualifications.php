<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qualifications extends CI_Controller {

	public function __construct()
    {
        parent:: __construct();

        $this->load->database();
        $this->load->helper('url');

        $this->load->library('grocery_CRUD');
    }

    public function qualifications_output($output = null)
    {
        $this->load->view('pages/qualifications_view.php', $output);
    }

	// Staff table is called frome here
    public function qualifications()
    {
        // Loading view home page views, Grocery CRUD Standard Library
       // $this->load->view('templates/header');

        $crud = new grocery_CRUD();

        $this->load->view('templates/header');
        $crud->set_theme('flexigrid');

        //table name exact from database
        $crud->set_table('qualifications');
        	        //give focus on name used for operations e.g. Add Order, Delete Order
        $crud->set_subject('Qualifications'); 
        $crud->columns('qId', 'qName', 'qLevel', 'qAccBody', 'enabled');
        	        //change column heading name for readability ('columm name', 'name to display in frontend column header')
        $crud->display_as('qId', 'Qualification ID Number');
        $crud->display_as('qName', 'Qualification');
        $crud->display_as('qAccBody', 'Accrediting Body');

        $crud->unset_columns('enabled'); //Remove enabled from view, enabled is only used when disabling data instead of deleting
        $crud->callback_insert('enabled', 'Y'); //Insert default value Y when adding

        $crud->fields('qId', 'qName', 'qLevel', 'qAccBody');

        //form validation (could match database columns set to "not null")
        $crud->required_fields('qId', 'qName', 'qLevel', 'qAccBody');
        
        $output = $crud->render();
		$this->qualifications_output($output);

        $this->load->view('templates/footer');
    }

}
?>