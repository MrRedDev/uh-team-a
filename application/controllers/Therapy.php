<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Therapy extends CI_Controller {

	public function __construct()
    {
        parent:: __construct();

        $this->load->database();
        $this->load->helper('url');

        $this->load->library('grocery_CRUD');
    }

    public function therapy_output($output = null)
    {
        $this->load->view('pages/therapy_view.php', $output);
    }

	// Staff table is called frome here
    public function therapy()
    {
        // Loading view home page views, Grocery CRUD Standard Library
       // $this->load->view('templates/header');

        $crud = new grocery_CRUD();

        $this->load->view('templates/header');
        $crud->set_theme('flexigrid');

        //table name exact from database
        $crud->set_table('therapy');
        	        //give focus on name used for operations e.g. Add Order, Delete Order
        $crud->set_subject('Therapy'); 
        $crud->columns('therapyId', 'therapyName', 'tCategory', 'tType', 'tReviewDate', 'isOffered','enabled');
        	        //change column heading name for readability ('columm name', 'name to display in frontend column header')
        $crud->display_as('therapyId', 'Therapy ID Number')
            ->display_as('therapyName', 'Therapy')
            ->display_as('tCategory', 'Therapy Category')
            ->display_as('tType', 'Therapy Type')
            ->display_as('tReviewDate', 'Therapy Review Date')
            ->display_as('isOffered', 'Archived');

        $crud->unset_columns('enabled'); //Remove enabled from view, enabled is only used when disabling data instead of deleting
        $crud->callback_column('enabled', 'Y'); //Insert default value Y when adding new qualification

        $crud->fields('therapyId', 'therapyName', 'tCategory', 'tType', 'tReviewDate', 'isOffered');

        //form validation (could match database columns set to "not null")
        $crud->required_fields('therapyId', 'therapyName', 'tCategory', 'tType', 'tReviewDate', 'isOffered','enabled');
        
        $output = $crud->render();
		$this->therapy_output($output);

        $this->load->view('templates/footer');
    }

}
?>